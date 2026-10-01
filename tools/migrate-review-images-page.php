<?php
/**
 * ВРЕМЕННЫЙ инструмент: перенос фото отзывов из поля `image` в `review_gallery`.
 * Страница: Инструменты → Фото отзывов в галерею. Только manage_options.
 * После окончания работ УДАЛИТЬ этот файл и require из functions.php.
 */

function rembrigada_migrate_review_images_menu() {
  add_management_page(
    'Фото отзывов в галерею',
    'Фото отзывов в галерею',
    'manage_options',
    'migrate-review-images',
    'rembrigada_migrate_review_images_page'
  );
}
add_action('admin_menu', 'rembrigada_migrate_review_images_menu');

function rembrigada_migrate_review_images_normalize_id($value) {
  if (is_array($value)) {
    return isset($value['ID']) ? (int) $value['ID'] : 0;
  }
  return (int) $value;
}

function rembrigada_migrate_review_images_normalize_gallery($gallery) {
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
}

function rembrigada_migrate_review_images_run($step, $dry) {
  $rows = array();
  $stats = array('done' => 0, 'skipped' => 0, 'failed' => 0);

  $query = new WP_Query(array(
    'post_type' => 'review',
    'posts_per_page' => -1,
    'post_status' => 'any',
    'orderby' => 'ID',
    'order' => 'ASC',
  ));

  while ($query->have_posts()) {
    $query->the_post();
    $post_id = get_the_ID();
    $image_id = rembrigada_migrate_review_images_normalize_id(get_field('image', $post_id));
    $gallery_ids = rembrigada_migrate_review_images_normalize_gallery(get_field('review_gallery', $post_id));
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
        $stats['done']++;
        $class = 'ok';
      } else {
        $updated = update_field('review_gallery', array_merge(array($image_id), $gallery_ids), $post_id);
        if ($updated) {
          $result = 'скопировано в галерею';
          $stats['done']++;
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
        $stats['done']++;
        $class = 'ok';
      } else {
        $updated = update_field('image', '', $post_id);
        if ($updated !== false) {
          $result = 'поле image очищено';
          $stats['done']++;
          $class = 'ok';
        } else {
          $result = 'ОШИБКА записи';
          $stats['failed']++;
          $class = 'warn';
        }
      }
    }

    $rows[] = array($post_id, get_the_title(), $result, $class);
  }
  wp_reset_postdata();

  return array($rows, $stats);
}

function rembrigada_migrate_review_images_page() {
  if (!function_exists('get_field')) {
    echo '<div class="wrap"><h1>Фото отзывов в галерею</h1><p>ACF не активен.</p></div>';
    return;
  }

  $ran = false;
  $rows = array();
  $stats = array();
  $step = '';
  $dry = false;

  if (!empty($_POST['migrate_step'])) {
    check_admin_referer('migrate-review-images');
    $step = in_array($_POST['migrate_step'], array('copy', 'clear'), true) ? $_POST['migrate_step'] : '';
    $dry = !empty($_POST['migrate_dry']);
    if ($step !== '') {
      list($rows, $stats) = rembrigada_migrate_review_images_run($step, $dry);
      $ran = true;
    }
  }

  echo '<div class="wrap"><h1>Фото отзывов в галерею</h1>';
  echo '<p><strong>Шаг 1</strong> — копирование `image` в начало `review_gallery` (поле `image` не трогается). ';
  echo '<strong>Шаг 2</strong> — только после проверки на сайте: очистка `image`, и только где фото уже есть в галерее.</p>';

  $actions = array(
    array('copy', true, '1. Копирование — превью (dry)'),
    array('copy', false, '1. Копирование — выполнить'),
    array('clear', true, '2. Удаление image — превью (dry)'),
    array('clear', false, '2. Удаление image — выполнить'),
  );
  foreach ($actions as $action) {
    echo '<form method="post" style="display:inline-block;margin:0 12px 12px 0;">';
    wp_nonce_field('migrate-review-images');
    echo '<input type="hidden" name="migrate_step" value="' . esc_attr($action[0]) . '">';
    if ($action[1]) {
      echo '<input type="hidden" name="migrate_dry" value="1">';
    }
    submit_button($action[2], $action[1] ? 'secondary' : 'primary', '', false);
    echo '</form>';
  }

  if ($ran) {
    echo '<h2>Шаг: ' . esc_html($step) . ($dry ? ' (DRY-RUN, без записи)' : ' (ЗАПИСЬ)') . '</h2>';
    echo '<table class="widefat striped"><thead><tr><th>ID</th><th>Заголовок</th><th>Результат</th></tr></thead><tbody>';
    foreach ($rows as $row) {
      $color = $row[3] === 'ok' ? 'color:green' : ($row[3] === 'warn' ? 'color:#b00;font-weight:bold' : 'color:#888');
      echo '<tr><td>' . (int) $row[0] . '</td><td>' . esc_html($row[1]) . '</td><td style="' . $color . '">' . esc_html($row[2]) . '</td></tr>';
    }
    echo '</tbody></table>';
    echo '<p><strong>Итого: затронуто ' . (int) $stats['done'] . ', пропущено ' . (int) $stats['skipped'] . ', ошибок ' . (int) $stats['failed'] . '</strong></p>';
  }

  echo '</div>';
}
