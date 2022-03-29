<?php
/*
Template Name: Услуги - Объект
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

            <div class="services-section-content">
                <div class="container container_small">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>
            
            <?php /* get_template_part('partials/technique'); */ ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php if (get_field('show_scheme')): get_template_part('partials/scheme'); endif; ?>
            <?php if (get_field('show_contacts')): get_template_part('partials/contacts', 'services'); endif; ?>
            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>
