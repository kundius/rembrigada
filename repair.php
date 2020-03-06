<?php
/*
Template Name: Тип ремонта
*/
?>
<!DOCTYPE html>
<html lang="ru" itemscope itemtype="http://schema.org/WebSite">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part('partials/page-headline') ?>

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

                <?php /* get_template_part('partials/repair-services'); */ ?>

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

            <?php /* get_template_part('partials/repair-cost-section'); */ ?>

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

            <?php if (get_field('show_scheme')): get_template_part('partials/scheme'); endif; ?>
            <?php if (get_field('show_contacts')): get_template_part('partials/contacts', 'services'); endif; ?>
            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>
