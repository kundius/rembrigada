<?php
/*
Template Name: Тип ремонта
*/
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
<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>
            
            <div class="breadcrumbs breadcrumbs_light" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
            <section class="page-headline">
                <div class="container">
                    <h1 class="page-headline__title"><span><?php the_title() ?></span></h1>
                </div>
            </section>

            <div class="container container_alt">
                <div class="repair-main">
                    <div class="repair-main__thumbnail">
                        <div class="repair-thumbnail">
                            <div class="repair-thumbnail__inner">
                                <img src="<?php the_post_thumbnail_url(get_the_ID(), array(400, 400)) ?>" alt="">
                            </div>
                        </div>
                        <div class="repair-thumbnail-title">
                            <?php the_title() ?>
                        </div>
                    </div>
                    <div class="repair-main__description">
                        <div class="repair-description">
                            <?php the_field('description') ?>
                        </div>
                    </div>
                    <div class="repair-main__estimate">
                        <div class="repair-estimate">
                            <div class="repair-estimate-price">
                                <div class="repair-estimate-price__label">
                                    Средняя цена<br>
                                    за работы составляет:
                                </div>
                                <div class="repair-estimate-price__value">
                                    <?php the_field('price') ?>
                                </div>
                            </div>
                            <?php if ($terms = get_field('terms')): ?>
                            <div class="repair-estimate-terms">
                                <div class="repair-estimate-terms__label">
                                    Ориентировочные<br>
                                    сроки выполнения:
                                </div>
                                <?php foreach ($terms as $term): ?>
                                    <div class="repair-estimate-term">
                                        <div class="repair-estimate-term__time">
                                            <?php echo $term['time'] ?>
                                        </div>
                                        <div class="repair-estimate-term__area">
                                            <?php echo $term['area'] ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

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

                <?php if ($projects = get_field('objects_list')): ?>
                <div class="repair-projects-section">
                    <div class="repair-projects-section__slider">
                        <div class="repair-slider js-repair-slider">
                            <div class="repair-slider__nav">
                                <div class="slide-nav">
                                    <button class="slide-nav__button slide-nav__button_prev js_prev" aria-controls="tns1" tabindex="-1" data-controls="prev"></button>
                                    <button class="slide-nav__button slide-nav__button_next js_next" aria-controls="tns1" tabindex="-1" data-controls="next"></button>
                                </div>
                            </div>

                            <div class="repair-slider__slides js_slides">
                                <?php foreach ($projects as $project): ?>
                                <div class="repair-slider-item">
                                    <a href="<?php the_permalink($project->ID) ?>" class="project-item">
                                        <?php if ($image = get_the_post_thumbnail_url($project->ID, array(468, 500))): ?>
                                        <img class="project-item__image" src="<?php echo $image ?>" alt="<?php echo $project->post_title ?>">
                                        <?php else: ?>
                                        <img class="project-item__image" src="https://via.placeholder.com/468x500" alt="">
                                        <?php endif; ?>
                                        <span class="project-item__info">
                                            <span class="project-item__title"><span><?php echo $project->post_title ?></span></span>
                                            <span class="project-item__hr"></span>
                                            <?php if ($project->post_excerpt): ?>
                                            <span class="project-item__desc">
                                                <?php echo sanitize_text_field($project->post_excerpt) ?>
                                            </span>
                                            <?php endif; ?>
                                            <span class="project-item__more"><span>Подробнее</span></span>
                                        </span>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="repair-projects-section__title">
                        Уже Выполненные объекты
                    </div>
                    <div class="repair-projects-section__text">
                        <?php the_field('objects_text') ?>
                        <a href="<?php echo get_category_link(3) ?>">Смотреть ещё</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="container container_tiny">
                <div class="content">
                    <?php the_content() ?>
                </div>
            </div>

            <?php $background = get_field('cost_background') ?>
            <div class="repair-cost-section" style="background-image: url('<?php echo $background['url'] ?>')">
                <div class="container container_alt">
                    <div class="repair-cost-section__title"><?php the_field('cost_title') ?></div>
                    <div class="repair-cost-section__desc"><?php the_field('cost_desc') ?></div>
                    <?php if ($list = get_field('cost_list')): ?>
                    <div class="repair-cost-section__list">
                        <?php foreach ($list as $item): ?>
                        <div class="repair-cost-section__item">
                            <span></span>
                            <?php echo $item['text'] ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="repair-cost-section__signature">
                        <?php the_field('cost_signature') ?>
                    </div>
                </div>
            </div>

            <div class="repair-stages-section">
                <div class="container container_alt">
                    <div class="repair-stages-section__title"><?php the_field('stages_title') ?></div>
                    <?php if ($list = get_field('stages_list')): ?>
                    <div class="repair-stages-section__list">
                        <div class="repair-stages-section__grid">
                            <?php foreach ($list as $item): ?>
                            <div class="repair-stages-section__cell">
                                <div class="repair-stages-section__item">
                                    <?php echo $item['text'] ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php get_template_part('partials/scheme') ?>
            <?php get_template_part('partials/contacts', 'services') ?>
            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>