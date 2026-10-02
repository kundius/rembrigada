<?php
// Список отзывов — дизайн user-review-list из renovation-wp-theme.
$review_block = isset($args['attributes']) ? $args['attributes'] : array();
if (function_exists('rembrigada_normalize_review_attributes')) {
  $review_block = rembrigada_normalize_review_attributes($review_block);
} else {
  $review_block = array(
    'what' => (isset($review_block['what']) && $review_block['what'] === 'selected' && !empty($review_block['ids'])) ? 'selected' : 'all',
    'ids' => isset($review_block['ids']) ? array_values(array_filter(array_map('intval', (array) $review_block['ids']))) : array(),
    'showButton' => !empty($review_block['showButton']),
    'showMoreButton' => !isset($review_block['showMoreButton']) || !empty($review_block['showMoreButton']),
  );
}
if ($review_block['what'] === 'selected') {
  $reviews = new WP_Query(array(
    'post_type' => 'review',
    'posts_per_page' => count($review_block['ids']),
    'post__in' => $review_block['ids'],
    'orderby' => 'post__in',
  ));
} else {
  $reviews = new WP_Query(array(
    'post_type' => 'review',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
  ));
}
?>
<?php if ($reviews->have_posts() || !empty($review_block['showButton'])): ?>
<section class="user-reviews">
  <?php if ($reviews->have_posts()): ?>
  <div class="user-reviews-list">
    <?php while ($reviews->have_posts()): $reviews->the_post(); ?>
    <div class="user-reviews-list__item">
      <?php get_template_part('partials/review-item', null, array('post_id' => get_the_ID())); ?>
    </div>
    <?php endwhile; ?>
  </div>
  <?php endif; ?>
  <?php if (!empty($review_block['showMoreButton']) || !empty($review_block['showButton'])): ?>
  <div class="user-reviews__more">
    <?php if (!empty($review_block['showMoreButton'])): ?>
    <a href="<?php the_permalink(17) ?>" class="btn-plus btn-plus--arrow">Ещё отзывы</a>
    <?php endif; ?>
    <?php if (!empty($review_block['showButton'])): ?>
    <button type="button" data-basiclightbox="#review-modal" class="btn-plus">Добавить отзыв</button>
    <?php endif; ?>
  </div>
  <?php endif; ?>
</section>
<?php endif; wp_reset_query(); ?>
