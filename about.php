<?php
/*
Template Name: О нас
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

            <div class="page-menu">
                <div class="container container_tiny">
                    <?php wp_nav_menu([
                        'theme_location' => 'aboutmenu',
                        'container' => false,
                        'menu_class' => 'page-menu-list'
                    ]) ?>
                </div>
            </div>

            <div class="services-content">
                <div class="container container_tiny">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
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
