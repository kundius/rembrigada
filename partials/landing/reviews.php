<?php
$reviews = new WP_Query(array(
  'post_type' => 'review',
  'posts_per_page' => 4
));
?>
<?php if ($reviews->have_posts()): ?>
<section class="client-feedback">
  <div class="container container_medium">
    <h3 class="client-feedback__title">Отзывы наших клиентов</h3>
    <div class="client-feedback-grid">
      <?php while($reviews->have_posts()): $reviews->the_post(); ?>
      <div class="client-feedback-grid__item">
        <div class="client-feedback-item">
          <?php if (get_field('type', get_the_ID()) == 'video'): ?>
          <div class="client-feedback-item__video">
            <iframe src="https://www.youtube.com/embed/<?php the_field('video') ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
          </div>
          <?php else: ?>
          <div class="client-feedback-item__image">
            <?php if ($image = get_field('image', get_the_ID())): ?>
            <img src="<?php echo $image['sizes']['w560h308'] ?>" alt="<?php the_title() ?>" loading="lazy">
            <?php else: ?>
            <img src="https://via.placeholder.com/560x308" alt="" loading="lazy">
            <?php endif; ?>
          </div>
          <div class="client-feedback-item__info">
            <div class="client-feedback-item__icon"><?php icon('quotes') ?></div>
            <div class="client-feedback-item__address"><?php the_field('address') ?></div>
            <?php if (has_excerpt()): ?>
            <div class="client-feedback-item__desc"><?php the_excerpt() ?></div>
            <button data-basiclightbox="#review-<?php echo get_the_ID() ?>" class="client-feedback-item__more">читать отзыв полностью</button>
            <div id="review-<?php echo get_the_ID() ?>" class="hidden">
              <div class="modal modal_review">
                <button class="modal__close" data-basiclightbox-close></button>
                <div class="reviews-item__title"><?php the_title() ?></div>
                <div class="reviews-item__address"><?php the_field('address') ?></div>
                <div class="reviews-item__info">
                  <div class="reviews-item__icon"><?php icon('quotes') ?></div>
                  <div class="reviews-item__desc">
                    <?php the_content() ?>
                  </div>
                </div>
              </div>
            </div>
            <?php else: ?>
            <div class="client-feedback-item__desc"><?php the_content() ?></div>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <div class="client-feedback__more">
      <a href="<?php the_permalink(17) ?>" class="btn-plus">Ещё отзывы</a>
    </div>
  </div>
</section>
<?php endif; wp_reset_query(); ?>
