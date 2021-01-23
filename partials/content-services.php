<?php
$services = new WP_Query(array(
  'post_type' => 'page',
  // 'post_parent' => 11,
  'order' => 'ASC',
  'orderby' => 'menu_order',
  'meta_query'	=> array(
    array(
      'key'	 	=> 'show_at_home',
      'value'	  	=> '1',
      'compare' 	=> '=',
    )
  )
));
?>

<?php if ($services->have_posts()): ?>
<section class="type-of-repair">
    <?php while($services->have_posts()): $services->the_post(); ?>
    <div class="type-of-repair__cell">
      <div class="type-of-repair-item">
          <div class="type-of-repair__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
          <div class="type-of-repair-item__inner">
              <div class="repair-img-label">
                  <a href="<?php the_permalink() ?>">
                      <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), array(468, 364))): ?>
                      <img class="repair-img" src="<?php echo $image ?>" alt="<?php the_title() ?>" loading="lazy">
                      <?php else: ?>
                      <img class="repair-img" src="https://via.placeholder.com/468x364" alt="" loading="lazy">
                      <?php endif; ?>
                  </a>
                  <?php if ($price = get_field('price', get_the_ID())): ?>
                  <div class="label">
                      <p>
                          <?php echo $price['prefix'] ?>
                          <span><?php echo $price['amount'] ?></span>
                          <?php echo $price['unit'] ?>
                      </p>
                  </div>
                  <?php endif; ?>
              </div>
          </div>
      </div>
    </div>
    <?php endwhile; ?>
</section>
<?php endif; wp_reset_query(); ?>
