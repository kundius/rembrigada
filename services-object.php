<?php
/*
Template Name: Услуги - Объект
*/
?>
<!DOCTYPE html>
<html>
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

        	<?php get_template_part('partials/scheme') ?>
            <?php get_template_part('partials/contacts', 'services') ?>
            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>