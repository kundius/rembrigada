<?php
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

add_filter('style_loader_tag', 'sj_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'sj_remove_type_attr', 10, 2);
function sj_remove_type_attr ($tag) {
	return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
}

add_post_type_support( 'page', 'excerpt' );

add_action('after_setup_theme', function() {
	register_nav_menus([
		'mainmenu' => 'Основное меню',
		'footermenu' => 'Меню в подвале',
		'servicesmenu' => 'Меню с услугами',
		'aboutmenu' => 'Меню о компании',
		'sitemap' => 'Карта сайта'
	]);
});

add_theme_support('title-tag');
add_theme_support('post-thumbnails', array('post', 'page', 'project'));
add_image_size('w150h100', 150, 100, true);
add_image_size('w468h364', 468, 364, true);
add_image_size('w468h500', 468, 500, true);
add_image_size('w800h600', 800, 600, true);
add_image_size('w800h480', 800, 480, true);
add_image_size('w560h308', 560, 308, false);
add_image_size('w400h400', 400, 400, true);

function srcset($image, $wh) {
	$wh = !empty($wh) ? $wh : ['thumbnail', 'medium', 'large', 'w150h100', 'w560h308', 'w468h364', 'w560h308', 'w468h500', 'w800h600', 'w800h480'];

	$srcset = [];
	foreach ($wh as $size) {
		$srcset[] = $image['sizes'][$size] . ' ' . $image['sizes'][$size . '-width'] . 'w';
	}
	$srcset[] = $image['url'] . ' ' . $image['width'] . 'w';

	$sizes = [];
	foreach ($wh as $size) {
		$sizes[] = '(max-width: ' . $image['sizes'][$size . '-width'] . 'px) ' . $image['sizes'][$size . '-width'] . 'px';
	}
	$sizes[] = $image['width'] . 'px';

	return 'srcset="' . implode(', ', $srcset) . '" ' . 'sizes="' . implode(', ', $sizes) . '"';
}

function icon($name, $scale = 1) {
	$width = $scale * 20;
	$height = $scale * 20;
	echo '<svg class="inline-svg-icon" width="' . $width . '" height="' . $height . '"><use xlink:href="' . get_bloginfo('template_url') . '/dist/images/sprite.svg#' . $name . '"></use></svg>';
}

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Параметры',
		'menu_title'	=> 'Параметры',
		'menu_slug' 	=> 'acf-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_page(array(
		'page_title' 	=> 'Блоки содержимого',
		'menu_title'	=> 'Блоки содержимого',
		'menu_slug' 	=> 'acf-content-blocks',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}


class Sitemap_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		$object = $item->object;
		$type = $item->type;
		$title = $item->title;
		$permalink = $item->url;
		$custom_hildren = '';

		if ($type == 'taxonomy' && $object == 'category') {
			$posts = new WP_Query([
			    'post_type' => 'post',
				'tax_query' => [[
			        'taxonomy' => 'category',
			        'terms'    => [$item->object_id]
			    ]]
			]);
			if ($posts->have_posts()) {
				$item->classes[] = 'menu-item-has-children';
				$custom_hildren .= '<ul>';
				while ($posts->have_posts()) {
					$posts->the_post();
					$custom_hildren .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$custom_hildren .= '</ul>';
			}
			wp_reset_query();
		}

		if ($type == 'post_type' && $object == 'page') {
			$pages = new WP_Query([
			    'post_type' => 'page',
			    'post_parent' => $item->object_id
			]);
			if ($pages->have_posts()) {
				$item->classes[] = 'menu-item-has-children';
				$custom_hildren .= '<ul>';
				while ($pages->have_posts()) {
					$pages->the_post();
					$subpages = new WP_Query([
					    'post_type' => 'page',
					    'post_parent' => get_the_ID()
					]);
					$cls = '';
					if ($subpages->have_posts()) {
						$cls .= 'menu-item-has-children';
					}
					$custom_hildren .= '<li class="' . $cls . '"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
					if ($subpages->have_posts()) {
						$custom_hildren .= '<ul>';
						while ($subpages->have_posts()) {
							$subpages->the_post();
							$custom_hildren .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
						}
						$custom_hildren .= '</ul>';
					}
					wp_reset_query();
					$custom_hildren .= '</li>';
				}
				$custom_hildren .= '</ul>';
			}
			wp_reset_query();
		}

		$output .= "<li class='" .  implode(" ", $item->classes) . "'>";
		if ($permalink && $permalink != '#') {
			$output .= '<a href="' . $permalink . '">';
		} else {
			$output .= '<span>';
		}
		$output .= $title;
		if ($permalink && $permalink != '#') {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}

		if ($custom_hildren) {
			$output .= $custom_hildren;
		}
	}
}

function template_part( $atts, $content = null ){
	$tp_atts = shortcode_atts(array(
		 'path' =>  null,
		 'what' => null,
		 'ids' => null,
		 'show_button' => null,
		 'showButton' => null,
		 'show_more' => null,
		 'showMoreButton' => null,
	), $atts);
	$args = array();
	if ($tp_atts['what'] !== null && $tp_atts['what'] !== '') {
		$args['attributes']['what'] = $tp_atts['what'];
	}
	$raw_ids = $tp_atts['ids'];
	if ($raw_ids !== null && $raw_ids !== '') {
		$args['attributes']['ids'] = array_values(array_filter(array_map('intval', preg_split('/[\s,;]+/', (string) $raw_ids))));
	}
	$raw_button = $tp_atts['show_button'] !== null && $tp_atts['show_button'] !== '' ? $tp_atts['show_button'] : $tp_atts['showButton'];
	if ($raw_button !== null && $raw_button !== '') {
		$args['attributes']['showButton'] = in_array(strtolower((string) $raw_button), array('1', 'true', 'yes', 'on'), true);
	}
	$raw_more = $tp_atts['show_more'] !== null && $tp_atts['show_more'] !== '' ? $tp_atts['show_more'] : $tp_atts['showMoreButton'];
	if ($raw_more !== null && $raw_more !== '') {
		$args['attributes']['showMoreButton'] = in_array(strtolower((string) $raw_more), array('1', 'true', 'yes', 'on'), true);
	}
	ob_start();
	if (!empty($args)) {
		get_template_part($tp_atts['path'], null, $args);
	} else {
		get_template_part($tp_atts['path']);
	}
	$ret = ob_get_contents();
	ob_end_clean();
	return $ret;
}
add_shortcode('template_part', 'template_part');

/**
 * Отзывы: нормализация атрибутов блока (JS <-> PHP).
 * what: all|selected, ids: int[], showButton: bool.
 */
function rembrigada_normalize_review_attributes($attributes) {
	$attributes = is_array($attributes) ? $attributes : array();
	$what = isset($attributes['what']) ? (string) $attributes['what'] : 'all';
	if ($what !== 'selected') {
		$what = 'all';
	}
	$ids = array();
	if (isset($attributes['ids'])) {
		if (is_string($attributes['ids'])) {
			$attributes['ids'] = preg_split('/[\s,;]+/', $attributes['ids']);
		}
		if (is_array($attributes['ids'])) {
			$ids = array_values(array_filter(array_map('intval', $attributes['ids'])));
		}
	}
	if ($what === 'selected' && empty($ids)) {
		$what = 'all';
	}
	return array(
		'what' => $what,
		'ids' => $ids,
		'showButton' => !empty($attributes['showButton']),
		// Кнопка «Ещё отзывы» включена по умолчанию (старые блоки без атрибута).
		'showMoreButton' => !isset($attributes['showMoreButton']) || !empty($attributes['showMoreButton']),
	);
}

function rembrigada_render_landing_reviews($attributes) {
	ob_start();
	get_template_part('partials/landing/reviews', null, array(
		'attributes' => rembrigada_normalize_review_attributes($attributes),
	));
	return ob_get_clean();
}

function rembrigada_render_content_reviews($attributes) {
	ob_start();
	get_template_part('partials/content/reviews', null, array(
		'attributes' => rembrigada_normalize_review_attributes($attributes),
	));
	return ob_get_clean();
}

function rembrigada_register_review_blocks() {
	if (!function_exists('register_block_type')) {
		return;
	}
	$review_block_attributes = array(
		'what' => array('type' => 'string', 'default' => 'all'),
		'ids' => array('type' => 'array', 'default' => array(), 'items' => array('type' => 'number')),
		'showButton' => array('type' => 'boolean', 'default' => false),
		'showMoreButton' => array('type' => 'boolean', 'default' => true),
	);
	register_block_type('landing/reviews', array(
		'attributes' => $review_block_attributes,
		'render_callback' => 'rembrigada_render_landing_reviews',
	));
	register_block_type('content/reviews', array(
		'attributes' => $review_block_attributes,
		'render_callback' => 'rembrigada_render_content_reviews',
	));
}
add_action('init', 'rembrigada_register_review_blocks');

/**
 * Опция: сначала 'option', потом 'options' (в теме используются оба варианта).
 */
function rembrigada_get_option($key, $default = '') {
	$value = function_exists('get_field') ? get_field($key, 'option') : null;
	if ($value === null || $value === false || $value === '') {
		$fallback = function_exists('get_field') ? get_field($key, 'options') : null;
		if ($fallback !== null && $fallback !== false && $fallback !== '') {
			return $fallback;
		}
	}
	if ($value === null || $value === false) {
		return $default;
	}
	return $value;
}


// add_shortcode('calculation', function($atts) {
// 	get_template_part('partials/content-calculation');
// });

// add_shortcode('callback', function($atts) {
// 	get_template_part('partials/content-callback');
// });

add_shortcode('sitemap', function($atts) {
	if (!has_nav_menu('sitemap')) return;

	$output = '';

	$output .= wp_nav_menu([
		'theme_location' => 'sitemap',
		'menu_class' => 'sitemap',
		'walker' => new Sitemap_Walker()
	]);

	$output .= '<div class="sitemap-rules">';
	$output .= '<div class="sitemap-rules__grid">';
	$output .= '<div class="sitemap-rules__cell">';
	$output .= '<a href="' . get_the_permalink(231) . '">Пользовательское соглашение</a>';
	$output .= '</div>';
	$output .= '<div class="sitemap-rules__cell">';
	$output .= '<a href="' . get_the_permalink(3) . '">Политика конфиденциальности и обработка персональных данных</a>';
	$output .= '</div>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
});

add_shortcode('repairs', function($atts) {
	// $repairs = get_field('repairs', 'options');
	$repairs = new WP_Query(array(
	    'post_type' => 'page',
	    'post_parent' => 403,
	    'order' => 'ASC',
	    'orderby' => 'menu_order'
	));

	$output = '';
	if ($repairs->have_posts()):
		$output .= '<div class="repairs">';
		while($repairs->have_posts()): $repairs->the_post();
			$image = get_the_post_thumbnail_url(get_the_ID(), array(400, 400));
			$output .= '<div class="repairs-item">';
			$output .= '<a href="' . get_the_permalink() . '" class="repairs-item__image" title="Кликните, чтобы прочитать более подробную информацию">';
			$output .= '<span class="repairs-item__image-inner">';
			$output .= '<img src="' . $image . '" alt="">';
			$output .= '</span>';
			$output .= '</a>';
			$output .= '<a href="' . get_the_permalink() . '" class="repairs-item__title" title="Кликните, чтобы прочитать более подробную информацию">';
			$output .= '<span class="repairs-item__title-inner"><span>' . get_the_title() . '</span></span>';
			$output .= '</a>';
			$output .= '</div>';
		endwhile;
		$output .= '</div>';
	endif; wp_reset_query();
	return $output;
});

add_shortcode('service-info', function($atts) {
	$longtitle = get_field('longtitle');
	if (empty($longtitle)) {
		$longtitle = get_the_title();
	}
	$price = get_field('price');
	$image = get_the_post_thumbnail_url(get_the_ID(), array(400, 400));
	$services = new WP_Query(array(
		'post_type' => 'page',
		'post_parent' => get_the_ID(),
		'order' => 'ASC',
		'orderby' => 'menu_order'
	));

	$output = '<div class="services-section-info">';
	$output .= '<div class="services-section-info__headline">';
	$output .= '<div class="services-section-info__title">' . $longtitle . '</div>';
	if ($price) {
		$output .= '<div class="services-section-info__price">' . $price['prefix'] . '<span>' . $price['amount'] . '</span>' . $price['unit'] . '</div>';
	}
	$output .= '</div>';
	$output .= '<div class="services-section-info__grid">';
	$output .= '<div class="services-section-info__cell">';
	if ($image) {
		$output .= '<div class="services-section-info__image">';
		$output .= '<img src="' . $image . '">';
		$output .= '</div>';
	}
	$output .= '</div>';
	$output .= '<div class="services-section-info__cell">';
	if (has_excerpt()) {
		$output .= '<div class="services-section-info__desc">' . get_the_excerpt() . '</div>';
	}
	if ($services->have_posts()) {
		$output .= '<div class="services-section-info__list">';
		while($services->have_posts()): $services->the_post();
			$output .= '<a href="' . get_the_permalink() . '" class="services-section-info__item">' . get_the_title() . '</a>';
		endwhile;
		$output .= '</div>';
	}
	wp_reset_query();
	$output .= '</div>';
	$output .= '</div>';
	$output .= '<form action="/wp-json/contact-form-7/v1/contact-forms/380/feedback" method="post" class="services-section-info__form js-form">';
	$output .= '<div>';
	$output .= '<span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" class="form-input" placeholder="E-mail*" /></span>';
	$output .= '</div>';
	$output .= '<div>';
	$output .= '<input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон">';
	$output .= '</div>';
	$output .= '<div>';
	$output .= '<input type="hidden" name="referrer" value="' . $longtitle . '">';
	$output .= '<button type="submit" class="form-submit-holey"><span></span><span>Отправить</span></button>';
	$output .= '</div>';
	$output .= '<div>';
	$output .= '<label class="services-section-info__form-rules">';
	$output .= '<input type="checkbox" name="rules" value="1" class="form-checkbox" />';
	$output .= '<span></span>';
	$output .= 'Прочитал(-а) <a href="' . get_permalink(231) . '" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="' . get_permalink(3) . '" target="_blank">Политикой обработки персональных данных</a>';
	$output .= '</label>';
	$output .= '</div>';
	$output .= '</form>';
	$output .= '</div>';
	return $output;
});

// add_action('init', function() {
// 	register_taxonomy('project_category', '', array(
// 		'label'                 => '',
// 		'labels'                => array(
// 			'name'              => 'Категории',
// 			'singular_name'     => 'Категория',
// 			'search_items'      => 'Искать категории',
// 			'all_items'         => 'Все категории',
// 			'view_item '        => 'Смотреть категорию',
// 			'parent_item'       => 'Родительская категория',
// 			'parent_item_colon' => 'Родительская категория:',
// 			'edit_item'         => 'Редактировать категорию',
// 			'update_item'       => 'Изменить категорию',
// 			'add_new_item'      => 'Добавить новую категорию',
// 			'new_item_name'     => 'Название новой категории',
// 			'menu_name'         => 'Категории'
// 		),
// 		'description'           => '',
// 		'public'                => true,
// 		'hierarchical'          => true,
// 		'meta_box_cb'           => 'post_categories_meta_box'
// 	));
// });

add_action('init', function() {
	register_post_type('project', array(
		'labels'             => array(
			'name'               => 'Проекты',
			'singular_name'      => 'Проект',
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавить новый проект',
			'edit_item'          => 'Редактировать проект',
			'new_item'           => 'Новый проект',
			'view_item'          => 'Посмотреть проект',
			'search_items'       => 'Найти проект',
			'not_found'          => 'Проектов не найдено',
			'not_found_in_trash' => 'В корзине проектов не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Проекты'
		),
		'public'             => true,
		// 'publicly_queryable' => false,
		'menu_icon'			 => 'dashicons-portfolio',
		'menu_position'      => 21,
		'taxonomies' 		 => ['post_tag'],
		'supports'           => array('title', 'editor', 'thumbnail', 'excerpt')
	));
	register_post_type('review', array(
		'labels'             => array(
			'name'               => 'Отзывы',
			'singular_name'      => 'Отзыв',
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавить новый отзыв',
			'edit_item'          => 'Редактировать отзыв',
			'new_item'           => 'Новый отзыв',
			'view_item'          => 'Посмотреть отзыв',
			'search_items'       => 'Найти отзыв',
			'not_found'          => 'Отзывов не найдено',
			'not_found_in_trash' => 'В корзине отзывов не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Отзывы'
		),
		'public'             => true,
		'show_in_rest'       => true,
		'rest_base'          => 'review',
		'menu_icon'			 => 'dashicons-format-status',
		'menu_position'      => 22,
		'supports'           => array('title', 'editor', 'excerpt')
	));
});

// add_action('init', function() {
// 	register_taxonomy_for_object_type('project_category', 'project');
// });

function be_register_blocks() {
    if( ! function_exists('acf_register_block') )
        return;
    acf_register_block( array(
        'name' => 'list-reasons',
        'title' => 'Список причин',
        'render_template' => 'partials/blocks/list-reasons.php',
        'category' => 'formatting',
        'icon' => 'editor-ul',
        'mode' => 'edit'
    ));
    acf_register_block( array(
        'name' => 'list-questions',
        'title' => 'Список вопрос-ответ',
        'render_template' => 'partials/blocks/list-questions.php',
        'category' => 'formatting',
        'icon' => 'editor-ul',
        'mode' => 'edit'
    ));
    acf_register_block( array(
        'name' => 'content-prices',
        'title' => 'Содержимое - Цены',
        'render_template' => 'partials/blocks/content-prices.php',
        'category' => 'formatting',
        'icon' => 'editor-ul',
        'mode' => 'edit'
    ));
    acf_register_block( array(
        'name' => 'content-price',
        'title' => 'Содержимое - Прайс',
        'render_template' => 'partials/blocks/content-price.php',
        'category' => 'formatting',
        'icon' => 'editor-ul',
        'mode' => 'edit'
    ));
    acf_register_block( array(
        'name' => 'content-portfolio',
        'title' => 'Содержимое - Портфолио',
        'render_template' => 'partials/blocks/content-portfolio.php',
        'category' => 'formatting',
        'icon' => 'editor-ul',
        'mode' => 'edit'
    ));
    acf_register_block( array(
        'name' => 'content-faq',
        'title' => 'Содержимое - FAQ',
        'render_template' => 'partials/blocks/content-faq.php',
        'category' => 'formatting',
        'icon' => 'editor-ul',
        'mode' => 'edit'
    ));
    acf_register_block( array(
        'name' => 'content-scrollable',
        'title' => 'Содержимое - Прокручиваемый текст',
        'render_template' => 'partials/blocks/content-scrollable.php',
        'category' => 'formatting',
        'icon' => 'editor-ul',
        'mode' => 'edit'
    ));
}
add_action('acf/init', 'be_register_blocks' );

remove_action('wp_head', 'rel_canonical');

function seo_canonical() {
	if ( ! is_singular() ) {
		return;
	}

	$id = get_queried_object_id();

	if ( 0 === $id ) {
		return;
	}

	$url = wp_get_canonical_url( $id );

	if ( ! empty( $url ) ) {
		echo '<link rel="canonical" itemprop="url" href="' . esc_url( $url ) . '" />' . "\n";
	}
}

function seo() {
	$title = '';
	$description = '';
	$keywords = '';

	if (is_archive()) {
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		if ($term) {
			$title = get_field('title', $term->taxonomy . '_' . $term->term_id);
			if (empty($title)) {
				$title = $term->name;
			}
			$description = get_field('description', $term->taxonomy . '_' . $term->term_id);
			$keywords = get_field('keywords', $term->taxonomy . '_' . $term->term_id);
		} elseif (is_post_type_archive()) {
			$title = get_queried_object()->labels->name;
		} elseif (is_day()) {
			$title = sprintf(__('Daily Archives: %s', 'roots'), get_the_date());
		} elseif (is_month()) {
			$title = sprintf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
		} elseif (is_year()) {
			$title = sprintf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
		} elseif (is_author()) {
			$author = get_queried_object();
			$title = sprintf(__('Author Archives: %s', 'roots'), $author->display_name);
		} else {
			$title = single_cat_title('', false);
		}
	} elseif (is_search()) {
		$title = sprintf(__('Search Results for %s', 'roots'), get_search_query());
	} elseif (is_404()) {
		$title = 'Not Found';
	} else {
		$title = get_field('seo_title');
		if (empty($title)) {
			$title = get_the_title();
		}
		$description = get_field('seo_description');
		$keywords = get_field('seo_keywords');
	}

	echo '<title>' . $title . '</title>';
	if (!empty($description)) {
		echo '<meta name="keywords" content="' . $keywords . '">';
	}
	if (!empty($keywords)) {
		echo '<meta name="description" content="' . $description . '">';
	}
}


add_action('enqueue_block_editor_assets', 'callback_block_assets');
function callback_block_assets() {
	// Общие классы превью-карточек блоков (blocks/block-card.css).
	wp_enqueue_style(
		'block-card-style',
		get_template_directory_uri() . '/blocks/block-card.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/block-card.css')
	);

	wp_enqueue_script(
 		'block-callback-script',
		get_template_directory_uri() . '/blocks/callback.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/callback.js')
	);

	wp_enqueue_style(
		'block-callback-style',
		get_template_directory_uri() . '/blocks/callback.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/callback.css')
	);

	wp_enqueue_script(
 		'block-calculation-script',
		get_template_directory_uri() . '/blocks/calculation.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/calculation.js')
	);

	wp_enqueue_style(
		'block-calculation-style',
		get_template_directory_uri() . '/blocks/calculation.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/calculation.css')
	);

	wp_enqueue_script(
 		'block-calculator-script',
		get_template_directory_uri() . '/blocks/calculator.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/calculator.js')
	);

	wp_enqueue_style(
		'block-calculator-style',
		get_template_directory_uri() . '/blocks/calculator.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/calculator.css')
	);

	wp_enqueue_script(
 		'block-timing-table-script',
		get_template_directory_uri() . '/blocks/timing-table.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/timing-table.js')
	);

	wp_enqueue_style(
		'block-timing-table-style',
		get_template_directory_uri() . '/blocks/timing-table.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/timing-table.css')
	);

	wp_enqueue_script(
 		'block-cost-table-script',
		get_template_directory_uri() . '/blocks/cost-table.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/cost-table.js')
	);

	wp_enqueue_style(
		'block-cost-table-style',
		get_template_directory_uri() . '/blocks/cost-table.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/cost-table.css')
	);

	wp_enqueue_script(
 		'block-stages-table-script',
		get_template_directory_uri() . '/blocks/stages-table.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/stages-table.js')
	);

	wp_enqueue_style(
		'block-stages-table-style',
		get_template_directory_uri() . '/blocks/stages-table.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/stages-table.css')
	);

	wp_enqueue_script(
 		'block-repair-types-script',
		get_template_directory_uri() . '/blocks/content/repair-types.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/content/repair-types.js')
	);

	wp_enqueue_style(
		'block-repair-types-style',
		get_template_directory_uri() . '/blocks/content/repair-types.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/content/repair-types.css')
	);

	wp_enqueue_script(
 		'block-scheme-script',
		get_template_directory_uri() . '/blocks/content/scheme.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/content/scheme.js')
	);

	wp_enqueue_style(
		'block-scheme-style',
		get_template_directory_uri() . '/blocks/content/scheme.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/content/scheme.css')
	);

	wp_enqueue_script(
 		'block-content-services-script',
		get_template_directory_uri() . '/blocks/content/services.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/content/services.js')
	);

	wp_enqueue_style(
		'block-content-services-style',
		get_template_directory_uri() . '/blocks/content/services.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/content/services.css')
	);

	wp_enqueue_script(
 		'block-content-projects-script',
		get_template_directory_uri() . '/blocks/content/projects.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/content/projects.js')
	);

	wp_enqueue_style(
		'block-content-projects-style',
		get_template_directory_uri() . '/blocks/content/projects.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/content/projects.css')
	);

	wp_enqueue_script(
 		'block-content-reviews-script',
		get_template_directory_uri() . '/blocks/content/reviews.js',
		array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-data', 'wp-api-fetch'),
		filemtime(dirname(__FILE__) . '/blocks/content/reviews.js')
	);

	wp_enqueue_style(
		'block-content-reviews-style',
		get_template_directory_uri() . '/blocks/content/reviews.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/content/reviews.css')
	);

	wp_enqueue_script(
 		'block-landing-services-script',
		get_template_directory_uri() . '/blocks/landing/services.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/services.js')
	);

	wp_enqueue_style(
		'block-landing-services-style',
		get_template_directory_uri() . '/blocks/landing/services.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/services.css')
	);

	wp_enqueue_script(
 		'block-landing-contacts-script',
		get_template_directory_uri() . '/blocks/landing/contacts.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/contacts.js')
	);

	wp_enqueue_style(
		'block-landing-contacts-style',
		get_template_directory_uri() . '/blocks/landing/contacts.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/contacts.css')
	);

	wp_enqueue_script(
 		'block-quiz-script',
		get_template_directory_uri() . '/blocks/landing/quiz.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/quiz.js')
	);

	wp_enqueue_style(
		'block-quiz-style',
		get_template_directory_uri() . '/blocks/landing/quiz.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/quiz.css')
	);

	wp_enqueue_script(
 		'block-about-team-script',
		get_template_directory_uri() . '/blocks/landing/about-team.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/about-team.js')
	);

	wp_enqueue_style(
		'block-about-team-style',
		get_template_directory_uri() . '/blocks/landing/about-team.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/about-team.css')
	);

	wp_enqueue_script(
 		'block-reviews-script',
		get_template_directory_uri() . '/blocks/landing/reviews.js',
		array('wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-data', 'wp-api-fetch'),
		filemtime(dirname(__FILE__) . '/blocks/landing/reviews.js')
	);

	wp_enqueue_style(
		'block-reviews-style',
		get_template_directory_uri() . '/blocks/landing/reviews.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/reviews.css')
	);

	wp_enqueue_script(
 		'block-advantages-script',
		get_template_directory_uri() . '/blocks/landing/advantages.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/advantages.js')
	);

	wp_enqueue_style(
		'block-advantages-style',
		get_template_directory_uri() . '/blocks/landing/advantages.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/advantages.css')
	);

	wp_enqueue_script(
 		'block-readiness-script',
		get_template_directory_uri() . '/blocks/landing/readiness.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/readiness.js')
	);

	wp_enqueue_style(
		'block-readiness-style',
		get_template_directory_uri() . '/blocks/landing/readiness.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/readiness.css')
	);

	wp_enqueue_script(
 		'block-problems-script',
		get_template_directory_uri() . '/blocks/landing/problems.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/problems.js')
	);

	wp_enqueue_style(
		'block-problems-style',
		get_template_directory_uri() . '/blocks/landing/problems.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/problems.css')
	);

	wp_enqueue_script(
 		'block-measurement-script',
		get_template_directory_uri() . '/blocks/landing/measurement.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/measurement.js')
	);

	wp_enqueue_style(
		'block-measurement-style',
		get_template_directory_uri() . '/blocks/landing/measurement.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/measurement.css')
	);

	wp_enqueue_script(
 		'block-get-estimate-script',
		get_template_directory_uri() . '/blocks/landing/get-estimate.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/get-estimate.js')
	);

	wp_enqueue_style(
		'block-get-estimate-style',
		get_template_directory_uri() . '/blocks/landing/get-estimate.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/get-estimate.css')
	);

	wp_enqueue_script(
 		'block-faq-script',
		get_template_directory_uri() . '/blocks/landing/faq.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/faq.js')
	);

	wp_enqueue_style(
		'block-faq-style',
		get_template_directory_uri() . '/blocks/landing/faq.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/faq.css')
	);

	wp_enqueue_script(
 		'block-decision-script',
		get_template_directory_uri() . '/blocks/landing/decision.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/decision.js')
	);

	wp_enqueue_style(
		'block-decision-style',
		get_template_directory_uri() . '/blocks/landing/decision.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/decision.css')
	);

	wp_enqueue_script(
 		'block-easy-work-script',
		get_template_directory_uri() . '/blocks/landing/easy-work.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/easy-work.js')
	);

	wp_enqueue_style(
		'block-easy-work-style',
		get_template_directory_uri() . '/blocks/landing/easy-work.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/easy-work.css')
	);

	wp_enqueue_script(
 		'block-like-work-script',
		get_template_directory_uri() . '/blocks/landing/like-work.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/landing/like-work.js')
	);

	wp_enqueue_style(
		'block-like-work-style',
		get_template_directory_uri() . '/blocks/landing/like-work.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/landing/like-work.css')
	);

	wp_enqueue_script(
 		'block-works-script',
		get_template_directory_uri() . '/blocks/content/works.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/content/works.js')
	);

	wp_enqueue_style(
		'block-works-style',
		get_template_directory_uri() . '/blocks/content/works.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/content/works.css')
	);

	wp_enqueue_script(
 		'block-masters-script',
		get_template_directory_uri() . '/blocks/content/masters.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/content/masters.js')
	);

	wp_enqueue_style(
		'block-masters-style',
		get_template_directory_uri() . '/blocks/content/masters.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/content/masters.css')
	);

	wp_enqueue_script(
 		'block-repair-script',
		get_template_directory_uri() . '/blocks/content/repair.js',
		array('wp-blocks', 'wp-element'),
		filemtime(dirname(__FILE__) . '/blocks/content/repair.js')
	);

	wp_enqueue_style(
		'block-repair-style',
		get_template_directory_uri() . '/blocks/content/repair.css',
		array('wp-edit-blocks'),
		filemtime(dirname(__FILE__) . '/blocks/content/repair.css')
	);
}

/**
 * Форма "Добавить отзыв" (порт из renovation-wp-theme, пост-тип review переиспользуется).
 * Создает черновик review: title=имя, content=текст, rating + review_gallery (ACF, создаются вручную).
 */
function rembrigada_calc_mail_attachment_path($tmp_name, $original_name) {
	$safe = preg_replace('/[\/\\\\\\x00]/', '_', (string) $original_name);
	$safe = trim($safe, ' .');
	if ($safe === '') {
		$safe = 'file';
	}
	$dir = sys_get_temp_dir();
	$dest = $dir . DIRECTORY_SEPARATOR . $safe;
	$i = 1;
	while (file_exists($dest)) {
		$p = pathinfo($safe);
		$base = isset($p['filename']) && $p['filename'] !== '' ? $p['filename'] : 'file';
		$ext = isset($p['extension']) && $p['extension'] !== '' ? '.' . $p['extension'] : '';
		$dest = $dir . DIRECTORY_SEPARATOR . $base . '_' . $i . $ext;
		$i++;
	}
	return copy($tmp_name, $dest) ? $dest : $tmp_name;
}

function rembrigada_create_attachment_from_upload($upload, $post_id = 0) {
	require_once(ABSPATH . 'wp-admin/includes/media.php');
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	$attachment_id = media_handle_sideload($upload, $post_id);
	if (is_wp_error($attachment_id)) {
		return 0;
	}
	return (int) $attachment_id;
}

function rembrigada_get_recaptcha_secret() {
	if (defined('REMBRIGADA_RECAPTCHA_SECRET') && REMBRIGADA_RECAPTCHA_SECRET) {
		return REMBRIGADA_RECAPTCHA_SECRET;
	}
	$secret = (string) apply_filters('rembrigada_recaptcha_secret', '');
	if ($secret !== '') {
		return $secret;
	}
	// Ключи интеграции reCAPTCHA в Contact Form 7 + общие варианты.
	$candidates = array('wpcf7_recaptcha_secret', 'wpcf7_recaptcha', 'wpcf7_service_recaptcha', 'recaptcha_secret');
	foreach ($candidates as $key) {
		$value = get_option($key);
		if (is_array($value) && !empty($value['secret'])) {
			return $value['secret'];
		}
		if (is_string($value) && strlen($value) > 20) {
			return $value;
		}
	}
	return '';
}

function rembrigada_verify_recaptcha($token) {
	$token = (string) $token;
	if ($token === '') {
		return false;
	}
	$secret = rembrigada_get_recaptcha_secret();
	if ($secret === '') {
		// Секрет не настроен (ключи CF7 не найдены): не блокируем отправку.
		return true;
	}
	$response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', array(
		'timeout' => 10,
		'body' => array('secret' => $secret, 'response' => $token),
	));
	if (is_wp_error($response)) {
		return false;
	}
	$data = json_decode(wp_remote_retrieve_body($response), true);
	if (empty($data['success'])) {
		return false;
	}
	// Для reCAPTCHA v3 отсекаем ботов по score.
	if (isset($data['score']) && (float) $data['score'] < 0.3) {
		return false;
	}
	return true;
}

add_action('wp_ajax_review_form', 'rembrigada_review_form_callback');
add_action('wp_ajax_nopriv_review_form', 'rembrigada_review_form_callback');
function rembrigada_review_form_callback() {
	$errors = array();
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'review-nonce')) {
		wp_send_json_error(array('nonce' => 'Данные отправлены с неподдерживаемого адреса. Обновите страницу.'));
	}
	if (!empty($_POST['submitted'])) {
		$errors['submitted'] = 'Что?';
	}
	$name = isset($_POST['your-name']) ? sanitize_text_field($_POST['your-name']) : '';
	$message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
	$rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;
	if (empty($message)) {
		$errors['message'] = 'Напишите Ваш отзыв.';
	}
	if ($rating < 1 || $rating > 5) {
		$rating = 5;
	}
	if (empty($_POST['rules'])) {
		$errors['rules'] = 'Подтвердите согласие на обработку персональных данных.';
	}
	$recaptcha_token = isset($_POST['g-recaptcha-response']) ? (string) $_POST['g-recaptcha-response'] : '';
	$recaptcha_configured = rembrigada_get_recaptcha_secret() !== '';
	if ($recaptcha_configured && $recaptcha_token === '') {
		$errors['recaptcha'] = 'Не пройдена проверка reCAPTCHA. Попробуйте еще раз.';
	} elseif ($recaptcha_token !== '' && !rembrigada_verify_recaptcha($recaptcha_token)) {
		$errors['recaptcha'] = 'Не пройдена проверка reCAPTCHA. Попробуйте еще раз.';
	}
	if ($errors) {
		wp_send_json_error($errors);
	}

	$post_id = wp_insert_post(array(
		'post_title' => $name !== '' ? $name : 'Новый отзыв',
		'post_content' => $message,
		'post_status' => 'draft',
		'post_type' => 'review',
		'post_author' => 1,
	));
	if (!$post_id || is_wp_error($post_id)) {
		wp_send_json_error(array('post' => 'Не удалось сохранить отзыв. Попробуйте позже.'));
	}

	if (function_exists('update_field')) {
		update_field('rating', $rating, $post_id);
	} else {
		update_post_meta($post_id, 'rating', $rating);
	}

	$gallery_ids = array();
	$attachments = array();
	$tmp_copies = array();
	if (!empty($_FILES['gallery'])) {
		$files = $_FILES['gallery'];
		$flat = array();
		if (is_array($files['name'])) {
			$count = count($files['name']);
			for ($i = 0; $i < $count; $i++) {
				$flat[] = array(
					'name' => $files['name'][$i],
					'full_path' => isset($files['full_path'][$i]) ? $files['full_path'][$i] : $files['name'][$i],
					'type' => $files['type'][$i],
					'tmp_name' => $files['tmp_name'][$i],
					'error' => $files['error'][$i],
					'size' => $files['size'][$i],
				);
			}
		} elseif (!empty($files['tmp_name'])) {
			$flat[] = $files + array('full_path' => $files['name']);
		}
		foreach ($flat as $file) {
			if (!isset($file['error']) || (int) $file['error'] !== UPLOAD_ERR_OK) {
				continue;
			}
			if (!is_uploaded_file($file['tmp_name'])) {
				continue;
			}
			$dest = rembrigada_calc_mail_attachment_path($file['tmp_name'], $file['name']);
			$attachments[] = $dest;
			if ($dest !== $file['tmp_name']) {
				$tmp_copies[] = $dest;
			}
			$attachment_id = rembrigada_create_attachment_from_upload($file, $post_id);
			if ($attachment_id) {
				$gallery_ids[] = $attachment_id;
			}
		}
		if ($gallery_ids) {
			if (function_exists('update_field')) {
				update_field('review_gallery', $gallery_ids, $post_id);
			} else {
				update_post_meta($post_id, 'review_gallery', $gallery_ids);
			}
		}
	}

	$admin_url = get_site_url() . '/wp-admin/post.php?post=' . $post_id . '&action=edit';
	$email_to = get_option('admin_email');
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$rows = array();
	$rows[] = 'Имя: ' . esc_html($name);
	$rows[] = 'Оценка: ' . esc_html((string) $rating);
	$rows[] = 'Сообщение: ' . esc_html($message);
	$rows[] = 'Страница: ' . (isset($_POST['page']) ? esc_html(sanitize_text_field($_POST['page'])) : '');
	$rows[] = 'Отзыв в админке: <a href="' . esc_url($admin_url) . '">' . esc_html($admin_url) . '</a>';
	wp_mail($email_to, isset($_POST['subject']) ? sanitize_text_field($_POST['subject']) : 'Новый отзыв', implode("<br>\n", $rows), $headers, $attachments);
	foreach ($tmp_copies as $tmp_copy) {
		@unlink($tmp_copy);
	}
	wp_send_json_success();
}

add_filter('navigation_markup_template', 'navigation_template', 10, 2);
function navigation_template ($template, $class) {
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
	<nav class="%1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}
