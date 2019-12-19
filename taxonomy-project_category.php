<?php
$term = get_term_by('slug', get_query_var('project_category'), 'project_category');
$categories = get_categories([
    'taxonomy' => 'project_category',
    'hide_empty' => false,
    'parent' => 3
]);
global $wp_query;
$queried_term = get_queried_object();
$projects = new WP_Query(array(
  'post_type' => 'project',
  'posts_per_page' => 10,
  'paged' => get_query_var('paged') ?: 1,
  'orderby' => ['parent' => 'DESC', 'menu_order' => 'ASC'],
	'tax_query' => [[
    'taxonomy' => 'project_category',
    'terms' => $queried_term->term_id
  ]]
));
$wp_query = $projects;
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>

            <?php if (count($categories) > 0): ?>
            <section class="works-cats-section">
                <h1 class="works-cats-section__title"><span><?php single_cat_title() ?></span></h1>
                <div class="works-cats-section__items">
                    <?php foreach ($categories as $category): ?>
                    <a href="<?php echo get_category_link($category->term_id) ?>" class="works-cats-section__item">
                        <?php echo $category->name ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>

            <?php if (have_posts()): ?>
            <section class="works-section">
                <div class="container container_alt">
                    <?php while(have_posts()): the_post(); ?>
                    <div class="works-item">
                        <div class="works-item__title"><?php the_title() ?></div>
                        <div class="works-item__grid">
                            <div class="works-item__cell">
                                <?php if ($gallery = get_field('gallery')): ?>
                                <div class="works-item-images<?php if (count($gallery) == 1): ?> works-item-images_single<?php endif; ?>">
                                    <?php foreach (array_splice($gallery, 0, 8) as $item): ?>
                                    <div class="works-item-image">
                                        <a href="<?php echo $item['url'] ?>" data-fslightbox="project-<?php echo get_the_ID() ?>" class="works-item-image__wrapper">
                                            <span class="works-item-image__inner" style="background-image: url('<?php echo $item['sizes']['w800h600'] ?>')"></span>
                                            <span class="works-item-image__loupe"><?php icon('loupe') ?></span>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="works-item__cell">
                                <?php if ($address = get_field('address')): ?>
                                <div class="works-item-object">
                                    <div class="works-item-object__label">
                                        Объект:
                                    </div>
                                    <div class="works-item-object__value">
                                        <?php echo $address ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="works-item-info">
                                    <!-- <div class="works-item-info__title">
                                        Особенности проекта:
                                    </div> -->
                                    <?php if ($area = get_field('area')): ?>
                                    <div class="works-item-info__row">
                                        <div class="works-item-info__label">
                                            Площадь:
                                        </div>
                                        <div class="works-item-info__area">
                                            <?php echo $area ?> <span>м<sup>2</sup></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($time_works = get_field('time_works')): ?>
                                <div class="works-item-deadline">
                                    <div class="works-item-deadline__label">
                                        Сроки:
                                    </div>
                                    <div class="works-item-deadline__value">
                                        <?php echo $time_works ?>
                                    </div>
                                    <a href="<?php the_permalink() ?>" class="works-item-deadline__link">посмотреть весь проект</a>
                                    <?php if ($review = get_field('review')): ?>
                                        <!-- <button class="works-item-deadline__link" data-basiclightbox="#review-<?php echo $review->ID ?>">посмотреть отзыв</button> -->
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <div class="works-item-pricing">
                                    <?php if (get_field('price_works') || get_field('price_material')): ?>
                                        <div class="works-item-pricing__title">Стоимость:</div>
                                    <?php endif; ?>
                                    <div class="works-item-pricing__text">
                                        <?php if ($price_works = get_field('price_works')): ?>
                                        <div>Ремонтные работы: <strong><?php echo $price_works ?> руб.</strong></div>
                                        <?php endif; ?>
                                        <?php if ($price_material = get_field('price_material')): ?>
                                        <div>Черновые материалы с доставкой: <strong><?php echo $price_material ?> руб.</strong></div>
                                        <?php endif; ?>
                                    </div>
                                    <a href="#callback" class="works-item-pricing__button"><span>Рассчитать стоимость своего ремонта</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php the_posts_pagination([
                        'prev_text' => 'Предыдущая',
                        'next_text' => 'Следующая'
                    ]) ?>
                </div>
            </section>
            <?php endif; ?>

            <?php get_template_part('partials/contacts', 'services') ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>
