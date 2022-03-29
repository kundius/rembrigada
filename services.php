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

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part('partials/page-headline') ?>

            <div class="services-content">
                <div class="container container_small">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>

            <?php if ($complementary = get_field('complementary')): ?>
            <section class="services-others">
                <div class="container container_medium">
                    <div class="services-others__title">Дополнительные услуги</div>
                    <div class="services-others__list">
                        <?php foreach($complementary as $item): ?>
                        <?php if ($item['link']): ?>
                        <a href="<?php echo $item['link'] ?>" class="services-others-item">
                        <?php else: ?>
                        <div class="additional-services-item">
                        <?php endif; ?>
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
                        <?php if ($item['link']): ?>
                        </a>
                        <?php else: ?>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php if (get_field('show_scheme')): get_template_part('partials/scheme'); endif; ?>
            <?php if (get_field('show_contacts')): get_template_part('partials/contacts', 'services'); endif; ?>
            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>
