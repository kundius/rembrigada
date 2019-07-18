<?php
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

add_post_type_support( 'page', 'excerpt' );

add_action('after_setup_theme', function() {
	register_nav_menus([
		'mainmenu' => 'Основное меню',
		'aboutmenu' => 'Меню о компании',
		'sitemap' => 'Карта сайта'
	]);
});

add_theme_support('post-thumbnails', array('post', 'page', 'project'));
add_image_size('w150h100', 150, 100, true);
add_image_size('w468h364', 468, 364, true);
add_image_size('w468h500', 468, 500, true);
add_image_size('w800h600', 800, 600, true);
add_image_size('w800h480', 800, 480, true);
add_image_size('w560h308', 560, 308, false);
add_image_size('w400h400', 400, 400, true);

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

add_action('init', function() {
	register_taxonomy('project_category', '', array(
		'label'                 => '',
		'labels'                => array(
			'name'              => 'Категории',
			'singular_name'     => 'Категория',
			'search_items'      => 'Искать категории',
			'all_items'         => 'Все категории',
			'view_item '        => 'Смотреть категорию',
			'parent_item'       => 'Родительская категория',
			'parent_item_colon' => 'Родительская категория:',
			'edit_item'         => 'Редактировать категорию',
			'update_item'       => 'Изменить категорию',
			'add_new_item'      => 'Добавить новую категорию',
			'new_item_name'     => 'Название новой категории',
			'menu_name'         => 'Категории'
		),
		'description'           => '',
		'public'                => true,
		'hierarchical'          => true,
		'meta_box_cb'           => 'post_categories_meta_box'
	));
});

add_action('init', function() {
	register_post_type('project', array(
		'labels'             => array(
			'name'               => 'Проекты',
			'singular_name'      => 'Проект',
			'add_new'            => 'Добавить новый',
			'add_new_item'       => 'Добавить новый проект',
			'edit_item'          => 'Редактировать преокт',
			'new_item'           => 'Новый проект',
			'view_item'          => 'Посмотреть проект',
			'search_items'       => 'Найти проект',
			'not_found'          => 'Проектов не найдено',
			'not_found_in_trash' => 'В корзине проектов не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Проекты'
		),
		'public'             => true,
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
			'edit_item'          => 'Редактировать преокт',
			'new_item'           => 'Новый отзыв',
			'view_item'          => 'Посмотреть отзыв',
			'search_items'       => 'Найти отзыв',
			'not_found'          => 'Отзывов не найдено',
			'not_found_in_trash' => 'В корзине отзывов не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Отзывы'
		),
		'public'             => true,
		'menu_icon'			 => 'dashicons-format-status',
		'menu_position'      => 22,
		'supports'           => array('title', 'editor', 'excerpt')
	));
});

add_action('init', function() {
	register_taxonomy_for_object_type('project_category', 'project');
});

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
}
add_action('acf/init', 'be_register_blocks' );


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
		$title = __e('Not Found', 'roots');
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
