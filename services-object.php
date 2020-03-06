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
                <div class="container container_tiny">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>

            <div class="technique">
                <div class="container">
                    <?php if ($title = get_field('technique_title')): ?>
                    <div class="technique__title"><?php echo $title ?></div>
                    <?php endif; ?>

                    <?php if ($text = get_field('technique_text')): ?>
                    <div class="technique__text"><?php echo $text ?></div>
                    <?php endif; ?>

        			<?php if ($list = get_field('technique_list')): ?>
                    <div class="technique__items">
	                    <div class="technique__grid">
	                        <?php foreach($list as $item): ?>
		                    <div class="technique__cell">
		                        <div class="techniques__item"><?php echo $item['text'] ?></div>
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
