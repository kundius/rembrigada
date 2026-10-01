<?php
/**
 * Одноразовый скрипт: перенос фото отзывов из поля `image` в `review_gallery`.
 *
 * Шаг 1 (копирование): ?step=copy — добавляет ID картинки в начало галереи, поле `image` НЕ трогает.
 * Шаг 2 (удаление):    ?step=clear — очищает `image`, ТОЛЬКО если это фото уже есть в галерее.
 * К любому шагу можно добавить &dry=1 — отчет без записи.
 *
 * Доступ: только администратор (manage_options) + nonce. Без nonce показывает ссылки с nonce.
 * После окончания работ файл УДАЛИТЬ.
 */

require_once dirname(__FILE__, 4) . '/wp-load.php';

if (!function_exists('get_field')) {
  wp_die('ACF не активен.');
}

auth_redirect();
if (!current_user_can('manage_options')) {
  wp_die('Нет доступа.');
}

$nonce_action = 'migrate-review-images';
$nonce = isset($_GET['nonce']) ? (string) $_GET['nonce'] : '';
$step = isset($_GET['step']) ? (string) $_GET['step'] : '';
$dry = !empty($_GET['dry']);

$self = strtok($_SERVER['REQUEST_URI'], '?');
$link = function ($params) use ($self, $nonce_action) {
  $params['nonce'] = wp_create_nonce($nonce_action);
  return $self . '?' . http_build_query($params);
};

header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Миграция фото отзывов</title>';
echo '<style>body{font-family:sans-serif;max-width:900px;margin:40px auto;padding:0 20px}table{border-collapse:collapse;width:100%}td,th{border:1px solid #ccc;padding:6px 10px;text-align:left;font-size:14px}.ok{color:green}.skip{color:#888}.warn{color:#b00;font-weight:bold}.links a{display:inline-block;margin:0 12px 12px 0}</style>';
echo '</head><body><h1>Миграция фото отзывов</h1>';

if (!in_array($step, array('copy', 'clear'), true) || !wp_verify_nonce($nonce, $nonce_action)) {
  echo '<p>Выберите действие (ссылки одноразовые, с nonce):</p><div class="links">';
  echo '<a href="' . esc_url($link(array('step' => 'copy', 'dry' => 1))) . '">1. Копирование — превью (dry)</a>';
  echo '<a href="' . esc_url($link(array('step' => 'copy'))) . '">1. Копирование — выполнить</a><br>';
  echo '<a href="' . esc_url($link(array('step' => 'clear', 'dry' => 1))) . '">2. Удаление image — превью (dry)</a>';
  echo '<a href="' . esc_url($link(array('step' => 'clear'))) . '">2. Удаление image — выполнить</a>';
  echo '</div><p>Порядок: сначала шаг 1 (проверка на сайте), потом шаг 2. После окончания файл удалить.</p>';
  echo '</body></html>';
  exit;
}

$normalize_id = function ($value) {
  if (is_array($value)) {
    return isset($value['ID']) ? (int) $value['ID'] : 0;
  }
  return (int) $value;
};

$normalize_gallery = function ($gallery) {
  $ids = array();
  if (empty($gallery) || !is_array($gallery)) {
    return $ids;
  }
  foreach ($gallery as $item) {
    $id = is_array($item) ? (isset($item['ID']) ? (int) $item['ID'] : 0) : (int) $item;
    if ($id > 0 && !in_array($id, $ids, true)) {
      $ids[] = $id;
    }
  }
  return $ids;
};

$query = new WP_Query(array(
  'post_type' => 'review',
  'posts_per_page' => -1,
  'post_status' => 'any',
  'orderby' => 'ID',
  'order' => 'ASC',
));

$stats = array('copied' => 0, 'cleared' => 0, 'skipped' => 0, 'failed' => 0);

echo '<h2>Шаг: ' . esc_html($step) . ($dry ? ' (DRY-RUN, без записи)' : ' (ЗАПИСЬ)') . '</h2>';
echo '<table><tr><th>ID</th><th>Заголовок</th><th>Результат</th></tr>';

while ($query->have_posts()) {
  $query->the_post();
  $post_id = get_the_ID();
  $title = get_the_title();
  $image_id = $normalize_id(get_field('image', $post_id));
  $gallery_ids = $normalize_gallery(get_field('review_gallery', $post_id));
  $result = '';
  $class = 'skip';

  if ($step === 'copy') {
    if ($image_id <= 0) {
      $result = 'пропуск: нет картинки';
      $stats['skipped']++;
    } elseif (in_array($image_id, $gallery_ids, true)) {
      $result = 'пропуск: уже есть в галерее';
      $stats['skipped']++;
    } elseif ($dry) {
      $result = 'будет скопировано в галерею (dry)';
      $stats['copied']++;
      $class = 'ok';
    } else {
      $updated = update_field('review_gallery', array_merge(array($image_id), $gallery_ids), $post_id);
      if ($updated) {
        $result = 'скопировано в галерею';
        $stats['copied']++;
        $class = 'ok';
      } else {
        $result = 'ОШИБКА записи';
        $stats['failed']++;
        $class = 'warn';
      }
    }
  } else {
    if ($image_id <= 0) {
      $result = 'пропуск: поле image уже пустое';
      $stats['skipped']++;
    } elseif (!in_array($image_id, $gallery_ids, true)) {
      $result = 'пропуск: фото НЕТ в галерее — оставлено (защита)';
      $stats['skipped']++;
      $class = 'warn';
    } elseif ($dry) {
      $result = 'будет очищено (dry)';
      $stats['cleared']++;
      $class = 'ok';
    } else {
      $updated = update_field('image', '', $post_id);
      if ($updated !== false) {
        $result = 'поле image очищено';
        $stats['cleared']++;
        $class = 'ok';
      } else {
        $result = 'ОШИБКА записи';
        $stats['failed']++;
        $class = 'warn';
      }
    }
  }

  echo '<tr><td>' . (int) $post_id . '</td><td>' . esc_html($title) . '</td><td class="' . $class . '">' . esc_html($result) . '</td></tr>';
}
wp_reset_postdata();

echo '</table>';
echo '<h3>Итого: затронуто ' . (int) ($stats['copied'] + $stats['cleared']) . ', пропущено ' . (int) $stats['skipped'] . ', ошибок ' . (int) $stats['failed'] . '</h3>';
echo '</body></html>';
