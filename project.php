<?php
/*
Template Name: Проект
*/
function get_prev_id($list, $id) {
    foreach ($list as $key => $value) {
        if ($value['id'] == $id) {
            if ($key == 0) {
                return $list[count($list) - 1]['id'];
            } else {
                return $list[$key - 1]['id'];
            }
        }
    }
}
function get_next_id($list, $id) {
    foreach ($list as $key => $value) {
        if ($value['id'] == $id) {
            if ($key == count($list) - 1) {
                return $list[0]['id'];
            } else {
                return $list[$key + 1]['id'];
            }
        }
    }
}
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

            <?php if ($review = get_field('review')): ?>
            <div id="review-<?php echo $review->ID ?>" class="hidden">
                <div class="modal modal_review">
                    <button class="modal__close" data-basiclightbox-close></button>
                    <div class="reviews-item__title"><?php echo $review->post_title ?></div>
                    <div class="reviews-item__address"><?php the_field('address', $review->ID) ?></div>
                    <div class="reviews-item__info">
                        <div class="reviews-item__icon"><?php icon('quotes') ?></div>
                        <div class="reviews-item__desc">
                            <?php echo $review->post_content ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="js-project-details">
                <div class="container container_medium">
                    <div class="project-meta">
                        <div class="project-meta__category">
                            <?php icon('category', .75) ?>
                            <?php the_terms(get_the_ID(), 'project_category') ?>
                        </div>
                        <div class="project-meta__date">
                            <?php icon('date', .75) ?>
                            <span>Опубликовано: </span><?php the_modified_date() ?>
                        </div>
                    </div>
                    <div class="project-layout">
                        <div class="project-layout__left">
                            <?php if ($gallery = get_field('gallery')): ?>
                            <div class="project-gallery-layout">
                                <div class="project-gallery-layout__left">
                                    <div class="project-gallery-slides">
                                        <div class="js_slides">
                                            <?php foreach ($gallery as $item): ?>
                                            <div class="project-gallery-item">
                                                <div class="project-gallery-item__inner">
                                                    <img src="<?php echo $item['sizes']['w800h480'] ?>" alt="">
                                                    <a href="<?php echo $item['sizes']['large'] ?>" data-fslightbox="project-<?php echo get_the_ID() ?>" class="project-gallery-item__view">
                                                        <?php icon('loupe') ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="project-gallery-controls">
                                            <button class="project-gallery-controls__previous js_prev"></button>
                                            <div class="project-gallery-controls__text">
                                                <span class="js_index">01</span>
                                                <span>/</span>
                                                <span><?php echo count($gallery) ?></span>
                                            </div>
                                            <button class="project-gallery-controls__next js_next"></button>
                                        </div>
                                    </div>
                                    <?php foreach ($gallery as $item): ?>
                                    <div class="hidden" id="project-<?php echo $item['id'] ?>">
                                        <div class="modal modal_large">
                                            <button class="modal__close" data-basiclightbox-close></button>
                                            <div class="project-modal-layout">
                                                <div class="project-modal-layout__left">
                                                    <div class="project-modal-details__title">
                                                        <?php the_title() ?>
                                                    </div>
                                                    <?php get_template_part('partials/project/details') ?>
                                                </div>
                                                <div class="project-modal-layout__middle">
                                                    <div class="project-modal__image">
                                                        <img src="<?php echo $item['sizes']['large'] ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="project-modal-layout__right">
                                                    <div class="project-modal__nav">
                                                        <div class="slide-nav">
                                                            <button class="slide-nav__button slide-nav__button_prev js-project-modal-nav" data-basiclightbox="#project-<?php echo get_prev_id($gallery, $item['id']) ?>"></button>
                                                            <button class="slide-nav__button slide-nav__button_next js-project-modal-nav" data-basiclightbox="#project-<?php echo get_next_id($gallery, $item['id']) ?>"></button>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="project-modal__title"><?php echo $item['title'] ?></div>
                                                        <?php if ($item['description']): ?>
                                                        <div class="project-modal__desc"><?php echo $item['description'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="project-gallery-layout__right">
                                    <div class="project-gallery-nav">
                                        <div class="js_nav">
                                            <?php foreach ($gallery as $item): ?>
                                            <div class="project-gallery-nav__item">
                                                <img src="<?php echo $item['sizes']['w150h100'] ?>" alt="">
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <button class="project-gallery-nav__next js_nav_next">next</button>
                                        <button class="project-gallery-nav__prev js_nav_prev">prev</button>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="project-layout__right">
                            <?php get_template_part('partials/project/details') ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container container_small">
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </div>

            <section class="article-foot">
                <div class="container container_medium">
                    <div class="article-foot__inner">
                        <div class="article-foot__social">
                            <p>Понравился проект?<br> Поделись с друзьями:</p>
                            <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                            <script src="https://yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,pinterest,twitter,telegram" data-image="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large') ?>"></div>
                        </div>
                        <div class="article-foot__neighbors">
                            <?php previous_post_link('%link', 'Предыдущая<i></i>') ?>
                            <span></span>
                            <?php next_post_link('%link', 'Следующая<i></i>') ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php
                $also_query = null;
                $tags = wp_get_post_tags($post->ID);
                if ($tags) {
                    $tag_ids = [];
                    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                    $also_query = new wp_query([
                        'tag__in' => $tag_ids,
                        'orderby'=> 'rand',
                        'caller_get_posts'=> 1,
                        'post__not_in' => [$post->ID],
                        'showposts'=> 5,
                        'tax_query' => [[
                            'taxonomy' => 'project_category',
                            'terms' => [3]
                        ]]
                    ]);
                }
            ?>

            <?php if ($also_query && $also_query->have_posts()): ?>
            <section class="interested-news interested-news_dark">
                <div class="container container_medium">
                    <div class="interested-news__title">Вам может быть интересно:</div>
                    <div class="interested-news__grid">
                        <?php while($also_query->have_posts()): $also_query->the_post(); ?>
                        <div class="interested-news__cell">
                            <div class="interested-news-item">
                                <div class="interested-news-item__date">
                                    <?php the_terms(get_the_ID(), 'project_category') ?>
                                </div>
                                <a href="<?php the_permalink() ?>" class="interested-news-item__title">
                                    <h4><?php the_title() ?></h4>
                                    <hr>
                                </a>
                                <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), 'medium')): ?>
                                <a href="<?php the_permalink() ?>">
                                    <img class="interested-news-item__image" src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>
