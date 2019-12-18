<?php
/*
Template Name: Услуги
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

            <div class="services-content">
                <div class="container container_tiny">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>

            <?php if ($complementary = get_field('complementary')): ?>
            <section class="services-others">
                <div class="container container_alt">
                    <div class="services-others__title">Дополнительные услуги</div>
                    <div class="services-others__list">
                        <?php foreach($complementary as $item): ?>
                        <a href="<?php echo $item['link'] ?>" class="services-others-item">
                            <span class="services-others-item__image">
                                <span>
                                    <?php if ($image = $item['image']): ?>
                                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $item['title'] ?>" class="js-img-to-svg">
                                    <?php else: ?>
                                    <img src="https://via.placeholder.com/100x100" alt="">
                                    <?php endif; ?>
                                </span>
                            </span>
                            <span class="services-others-item__name"><?php echo $item['title'] ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php get_template_part('partials/contacts', 'services') ?>

            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>
