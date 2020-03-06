<?php
$services = new WP_Query(array(
  'post_type' => 'page',
  'post_parent' => 11,
  'order' => 'ASC',
  'orderby' => 'menu_order',
  'meta_query'    => array(
      array(
          'key'       => 'show_at_home',
          'value'     => '1',
          'compare'   => '=',
      )
  )
));
?>
<?php if ($services->have_posts()): ?>
<div class="repair-services">
    <?php while($services->have_posts()): $services->the_post(); ?>
    <div class="repair-services__column">
        <div class="repair-services__title">
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
        <div class="repair-subservices">
            <?php while($children->have_posts()): $children->the_post(); ?>
                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>
</div>
<?php endif; wp_reset_query(); ?>
