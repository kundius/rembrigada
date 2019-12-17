<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <div class="breadcrumbs breadcrumbs_absolute" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>

            <section class="page-headline">
                <div class="container">
                    <h1 class="page-headline__title"><span><?php single_cat_title() ?></span></h1>
                </div>
            </section>

            <section class="news-list">
                <div class="container container_alt">
                    <?php if (have_posts()) : ?>
                    <div class="news-list__grid">
                        <?php  while ( have_posts() ) : the_post(); ?>
                        <div class="news-list__cell">
                            <div class="news-item">
                                <div class="news-item-meta">
                                    <span><?php icon('date', .75) ?> Опубликовано: <?php the_modified_date(); ?></span>
                                    <span><?php icon('user', .75) ?> <?php the_author() ?></span>
                                    <span><?php icon('comments', .75) ?> <?php echo get_comments_number() ?></span>
                                </div>
                                <div class="news-item__image">
                                    <a href="<?php the_permalink() ?>">
                                        <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), array(800, 480))): ?>
                                        <img src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                        <?php else: ?>
                                        <img src="https://via.placeholder.com/800x480" alt="">
                                        <?php endif; ?>
                                    </a>
                                    <div class="news-item__category">
                                        <?php the_category(',') ?>
                                    </div>
                                </div>
                                <a href="<?php the_permalink() ?>" class="news-item__title">
                                    <h3><?php the_title() ?></h3>
                                    <hr>
                                </a>
                                <div class="news-item__desc">
                                    <?php the_excerpt() ?>
                                </div>
                                <a href="<?php the_permalink() ?>" class="news-item__more">читать дальше</a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php the_posts_pagination([
                        'prev_text' => 'Предыдущая',
                        'next_text' => 'Следующая'
                    ]) ?>
                    <?php else: ?>
                    <div class="page-content">
                        <p>Извините, ничего не найдено.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

            <?php get_template_part('partials/contacts'); ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>
