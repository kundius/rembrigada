<?php
/*
Template Name: Отзывы
*/
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$reviews = new WP_Query(array(
    'post_type' => 'review',
    'paged' => $paged,
    'posts_per_page' => 10
));
?>
<!DOCTYPE html>
<html lang="ru" itemscope itemtype="http://schema.org/WebSite">
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

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
            <section class="page-headline">
                <div class="container">
                    <h1 class="page-headline__title"><span><?php the_title() ?></span></h1>
                </div>
            </section>

            <?php if ($reviews->have_posts()): ?>
            <div class="reviews-section">
                <div class="container container_alt">
                    <?php while($reviews->have_posts()): $reviews->the_post(); ?>
                    <div class="reviews-item">
                        <div class="reviews-item__layout">
                            <div class="reviews-item__left">
                                <?php if (get_field('type', get_the_ID()) == 'video'): ?>
                                <div  class="reviews-item__video">
                                    <iframe src="https://www.youtube.com/embed/<?php the_field('video') ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <?php else: ?>
                                <div class="reviews-item__image">
                                    <?php if ($image = get_field('image', get_the_ID())): ?>
                                    <img src="<?php echo $image['sizes']['w560h308'] ?>" alt="<?php the_title() ?>">
                                    <button data-basiclightbox="#review-image-<?php echo get_the_ID() ?>" class="reviews-item__image-view">
                                        <?php icon('loupe') ?>
                                    </button>
                                    <?php else: ?>
                                    <img src="https://via.placeholder.com/560x308" alt="">
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="reviews-item__right">
                                <div class="reviews-item__title"><?php the_title() ?></div>
                                <div class="reviews-item__address"><?php the_field('address') ?></div>
                                <div class="reviews-item__info">
                                    <div class="reviews-item__icon"><?php icon('quotes') ?></div>
                                    <?php if (has_excerpt()): ?>
                                    <div class="reviews-item__desc"><?php the_excerpt() ?></div>
                                    <button data-basiclightbox="#review-<?php echo get_the_ID() ?>" class="reviews-item__more">читать отзыв полностью</button>
                                    <?php else: ?>
                                    <div class="reviews-item__desc"><?php the_content() ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden" id="review-<?php echo get_the_ID() ?>">
                        <div class="modal modal_review">
                            <button class="modal__close" data-basiclightbox-close></button>
                            <div class="reviews-item__title"><?php the_title() ?></div>
                            <div class="reviews-item__address"><?php the_field('address') ?></div>
                            <div class="reviews-item__info">
                                <div class="reviews-item__icon"><?php icon('quotes') ?></div>
                                <div class="reviews-item__desc">
                                    <?php the_content() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($image = get_field('image', get_the_ID())): ?>
                    <div class="hidden" id="review-image-<?php echo get_the_ID() ?>">
                        <div class="modal" style="text-align: center">
                            <img src="<?php echo $image['url'] ?>" alt="<?php the_title() ?>">
                        </div>
                        <button class="modal__close" data-basiclightbox-close></button>
                    </div>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php
                        $GLOBALS['wp_query']->max_num_pages = $reviews->max_num_pages;
                        the_posts_pagination([
                            'prev_text' => 'Предыдущая',
                            'next_text' => 'Следующая'
                        ]);
                    ?>
                </div>
            </div>
            <?php endif; wp_reset_query(); ?>

            <div class="container container_tiny">
                <div class="content">
                    <?php the_content() ?>
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
