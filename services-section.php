<?php
/*
Template Name: Услуги - Раздел
*/
$services = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => get_the_ID(),
    'order' => 'ASC',
    'orderby' => 'menu_order'
));
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

            <?php if ($mask = get_field('mask')): ?>
                <div class="services-section-mask">
                    <?php echo $mask ?>
                </div>
            <?php endif; ?>

            <div class="services-section-content">
                <div class="container container_tiny">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>

            <?php if ($types = get_field('types')): ?>
                <div class="services-section-types">
                    <div class="container">
                        <?php if ($types_title = get_field('types_title')): ?>
                        <div class="services-section-types__title"><?php echo $types_title ?></div>
                        <?php endif; ?>
                        <div class="services-section-types__grid">
                            <?php foreach($types as $type): ?>
                            <div class="services-section-types__cell">
                                <div class="services-section-type">
                                    <?php if ($type['image']): ?>
                                    <div class="services-section-type__image">
                                        <img src="<?php echo $type['image']['url'] ?>" alt="">
                                    </div>
                                    <?php endif; ?>
                                    <div class="services-section-type__title"><?php echo $type['title'] ?></div>
                                    <div class="services-section-type__content"><?php echo $type['content'] ?></div>
                                    <div class="services-section-type__signature"><?php echo $type['signature'] ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($results = get_field('results')): ?>
                <div class="services-section-results">
                    <div class="container container_alt">
                        <?php if ($results_title = get_field('results_title')): ?>
                        <div class="services-section-results__title"><?php echo $results_title ?></div>
                        <?php endif; ?>
                        <div class="services-section-results__grid">
                            <?php foreach($results as $result): ?>
                            <div class="services-section-results__cell">
                                <div class="services-section-result">
                                    <?php if ($result['image']): ?>
                                    <div class="services-section-result__image">
                                        <span></span>
                                        <img src="<?php echo $result['image']['url'] ?>" alt="" class="js-img-to-svg">
                                    </div>
                                    <?php endif; ?>
                                    <div class="services-section-result__title">
                                        <span><?php echo $result['title'] ?></span>
                                    </div>
                                    <div class="services-section-result__content"><?php echo $result['description'] ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php if (get_field('show_scheme')): get_template_part('partials/scheme'); endif; ?>
            <?php if (get_field('show_contacts')): get_template_part('partials/contacts', 'services'); endif; ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>
