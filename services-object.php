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
            
            <?php if ($background = get_field('headline_background')): ?>
            <section class="page-bg-headline" style="background-image: url('<?php echo $background['url'] ?>')">
                <div class="page-bg-headline__inner">
                    <h1 class="page-bg-headline__title"><?php the_title() ?></h1>
                    <?php if ($description = get_field('headline_description')): ?>
                    <div class="page-bg-headline__description"><?php echo $description ?></div>
                    <?php endif; ?>
                    <?php if ($more = get_field('headline_more')): ?>
                    <?php $more_title = $more['title'] ? $more['title'] : 'Хочу узнать детали' ?>
                    <div class="page-bg-headline__more">
                        <a class="page-bg-headline__more-link" href="<?php echo $more['link']  ?>"><?php echo $more_title ?  ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <div class="breadcrumbs breadcrumbs_light" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>
            <?php else: ?>
            <div class="breadcrumbs breadcrumbs_light" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>
            <section class="page-headline">
                <div class="container">
                    <h1 class="page-headline__title"><span><?php the_title() ?></span></h1>
                </div>
            </section>
            <?php endif; ?>

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
