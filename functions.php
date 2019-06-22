<?php
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

add_action('after_setup_theme', function() {
	register_nav_menus( array(
		'mainmenu' => 'Основное меню'
	) );
});

add_theme_support( 'post-thumbnails', array( 'post' ) );
add_theme_support( 'post-thumbnails', array( 'page' ) );

function icon($name, $scale = 1) {
	$width = $scale * 20;
	$height = $scale * 20;
	echo '<svg class="inline-svg-icon" width="' . $width . '" height="' . $height . '"><use xlink:href="' . get_bloginfo('template_url') . '/dist/img/sprite.svg#' . $name . '"></use></svg>';
}

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Параметры',
		'menu_title'	=> 'Параметры',
		'menu_slug' 	=> 'acf-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

add_shortcode('services', function($atts) {
	$services = new WP_Query(array(
		'post_type' => 'page',
		'post_parent' => get_the_ID()
	));

	if ($services->have_posts()): ?>
		<div class="directions">
			<?php while($services->have_posts()): $services->the_post(); ?>
				<div>
					<div class="directions-item">
						<div class="directions-item__image-wrapper">
							<div class="directions-item__image" style="background-image:url('<?php echo the_post_thumbnail_url('medium') ?>')"></div>
							<div class="directions-item__more">Подробнее</div>
						</div>
						<div class="directions-item__title"><?php the_title() ?></div>
						<a href="<?php the_permalink() ?>" class="directions-item__link"></a>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif; wp_reset_query();
});

