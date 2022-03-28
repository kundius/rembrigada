<!DOCTYPE html>
<html lang="ru" itemscope itemtype="http://schema.org/WebSite">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>

            <section class="page-bg-headline" style="background-image: url('<?php echo get_field('headline_background')['url'] ?>')">
                <div class="page-bg-headline__inner">
                    <h1 class="page-bg-headline__title"><?php the_title() ?></h1>
                    <?php if ($description = get_field('headline_description')): ?>
                    <div class="page-bg-headline__description"><?php echo $description ?></div>
                    <?php endif; ?>
                    <?php if ($more = get_field('headline_more')): ?>
                    <?php $more_title = $more['title'] ? $more['title'] : 'Хочу узнать детали' ?>
                    <?php $more_link = $more['link'] ? $more['link'] : '#callback' ?>
                    <div class="page-bg-headline__more">
                        <a class="page-bg-headline__more-link" href="<?php echo $more_link ?>"><?php echo $more_title ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

            <div class="intro-advantages">
                <div class="container">
                    <div class="intro-advantages__list">
                        <?php foreach (get_field('advantages', 'options') as $advantage): ?>
                        <div class="intro-advantages__cell">
                            <div class="intro-advantage">
                                <div class="intro-advantage__image">
                                    <img src="<?php echo $advantage['image']['url'] ?>" alt="" loading="lazy">
                                </div>
                                <div class="intro-advantage__title">
                                    <?php echo $advantage['title'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php the_content() ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>
