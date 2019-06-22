<!DOCTYPE html>
<html>
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <div class="section-main">
                <div class="container">
                    <div class="layout">
                        <div class="layout__sidebar">
                            <?php get_sidebar() ?>
                        </div>
                        <div class="layout__content">
                            <h1><?php single_cat_title() ?></h1>
                            <?php if (have_posts()) : ?>
                                <div class="articles">
                                    <?php  while ( have_posts() ) : the_post(); ?>
                                        <div class="articles-item">
                                            <?php if ($image = get_the_post_thumbnail_url()): ?>
                                                <a href="<?php the_permalink() ?>" class="articles-item__image">
                                                    <img src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                                </a>
                                            <?php endif; ?>
                                            <div class="articles-item__info">
                                                <div class="articles-item__title">
                                                    <a href="<?php the_permalink() ?>">
                                                        <?php the_title() ?>
                                                    </a>
                                                </div>

                                                <div class="articles-item__meta">
                                                    <div class="articles-item__date">
                                                        <?php icon('calendar', .8) ?>
                                                        <?php the_modified_date(); ?>
                                                    </div>
                                                </div>

                                                <div class="articles-item__excerpt"><?php the_excerpt() ?></div>

                                                <a href="<?php the_permalink() ?>" class="btn articles-item__more">Подробнее</a>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <?php the_posts_pagination() ?>
                            <?php else: ?>
                                <div class="page-content">
                                    <p>Извините, ничего не найдено.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>