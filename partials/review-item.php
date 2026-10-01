<?php
// Карточка отзыва — порт user-review-item из renovation-wp-theme.
// Использование: get_template_part('partials/review-item', null, ['post_id' => get_the_ID()]);
// Внутри цикла: get_template_part('partials/review-item');
$review_id = isset($args['post_id']) ? (int) $args['post_id'] : get_the_ID();
if (!$review_id) {
  return;
}
$review_title = get_the_title($review_id);
$rating = (int) get_field('rating', $review_id);
if ($rating < 1 || $rating > 5) {
  $rating = 5;
}
$avatar = get_field('image', $review_id);
$review_content = apply_filters('the_content', get_post_field('post_content', $review_id));

$normalize_gallery = function ($gallery) {
  $ids = array();
  if (empty($gallery) || !is_array($gallery)) {
    return $ids;
  }
  foreach ($gallery as $item) {
    $id = is_array($item) ? (isset($item['ID']) ? (int) $item['ID'] : 0) : (int) $item;
    if ($id > 0) {
      $ids[] = $id;
    }
  }
  return $ids;
};
$gallery_ids = $normalize_gallery(get_field('review_gallery', $review_id));

$reply_content = get_field('reply_content', $review_id);
$reply_date_raw = get_field('reply_date', $review_id);
$reply_date = '';
if ($reply_date_raw) {
  $timestamp = is_numeric($reply_date_raw) ? (int) $reply_date_raw : strtotime($reply_date_raw);
  if ($timestamp) {
    $reply_date = date_i18n('j F', $timestamp);
  }
}
$reply_gallery_ids = $normalize_gallery(get_field('reply_gallery', $review_id));
$reply_author = function_exists('rembrigada_get_option') ? rembrigada_get_option('review_reply_author', '') : '';
$reply_avatar = function_exists('rembrigada_get_option') ? rembrigada_get_option('review_reply_avatar', null) : null;
?>
<div class="user-reviews-item">
  <div class="user-reviews-item__head">
    <div class="user-reviews-item__avatar">
      <?php if ($avatar): ?>
      <img src="<?php echo esc_url($avatar['sizes']['w400h400'] ?? $avatar['url']); ?>" alt="<?php echo esc_attr($review_title); ?>" loading="lazy">
      <?php else: ?>
      <?php echo esc_html(mb_substr($review_title, 0, 1)); ?>
      <?php endif; ?>
    </div>
    <div>
      <div class="user-reviews-item__author"><?php echo esc_html($review_title); ?></div>
      <div class="user-reviews-item__date"><?php echo esc_html(get_the_date('j F', $review_id)); ?></div>
    </div>
  </div>
  <div class="user-reviews-item__rating">
    <?php for ($i = 1; $i <= 5; $i++): ?>
    <span class="icon icon-star<?php if ($i <= $rating): ?> is-on<?php endif; ?>"></span>
    <?php endfor; ?>
  </div>
  <div class="user-reviews-item__text"><?php echo $review_content; ?></div>
  <?php if ($gallery_ids): ?>
  <div class="user-reviews-item__gallery">
    <?php foreach ($gallery_ids as $attachment_id): ?>
    <a href="<?php echo esc_url(wp_get_attachment_image_url($attachment_id, 'full')); ?>" data-fslightbox="review-gallery-<?php echo $review_id; ?>">
      <?php echo wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <?php if ($reply_content): ?>
  <div class="user-reviews-item__reply">
    <div class="user-reviews-item__head">
      <div class="user-reviews-item__avatar">
        <?php if ($reply_avatar): ?>
        <img src="<?php echo esc_url($reply_avatar['sizes']['w400h400'] ?? $reply_avatar['url']); ?>" alt="<?php echo esc_attr($reply_author); ?>" loading="lazy">
        <?php else: ?>
        <?php echo esc_html(mb_substr($reply_author, 0, 1)); ?>
        <?php endif; ?>
      </div>
      <div>
        <div class="user-reviews-item__author"><?php echo esc_html($reply_author); ?></div>
        <?php if ($reply_date !== ''): ?>
        <div class="user-reviews-item__date"><?php echo esc_html($reply_date); ?></div>
        <?php endif; ?>
      </div>
    </div>
    <div class="user-reviews-item__text"><?php echo wpautop(esc_html($reply_content)); ?></div>
    <?php if ($reply_gallery_ids): ?>
    <div class="user-reviews-item__gallery">
      <?php foreach ($reply_gallery_ids as $attachment_id): ?>
      <a href="<?php echo esc_url(wp_get_attachment_image_url($attachment_id, 'full')); ?>" data-fslightbox="review-gallery-<?php echo $review_id; ?>">
        <?php echo wp_get_attachment_image($attachment_id, 'thumbnail'); ?>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
  <?php endif; ?>
</div>
