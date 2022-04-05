<?php
$services = new WP_Query(array(
  'post_type' => 'page',
  'post_parent' => get_the_ID(),
  'order' => 'ASC',
  'orderby' => 'menu_order'
));
?>
<?php if ($services->have_posts()): ?>
<div class="services">
  <?php while($services->have_posts()): $services->the_post(); ?>
  <div class="services-item">
    <div class="services-item__image">
      <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), array(400, 400))): ?>
      <img src="<?php echo $image ?>" alt="<?php the_title() ?>">
      <?php endif; ?>
    </div>

    <div class="services-item__content">
      <div class="services-item__title">
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
      </div>
      <?php
      $children = new WP_Query(array(
        'post_type' => 'page',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'post_parent' => get_the_ID()
      ));
      ?>
      <?php if ($children->have_posts()): ?>
      <div class="services-item__children">
        <?php while($children->have_posts()): $children->the_post(); ?>
        <div class="services-item__children-item">
          <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
        </div>
        <?php endwhile; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endwhile; ?>
</div>
<?php endif; wp_reset_query(); ?>
