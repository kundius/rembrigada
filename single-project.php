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

            <div class="js-project-details">
                <div class="container container_alt">
                    <div class="project-meta">
                        <div class="project-meta__category">
                            <?php icon('category', .75) ?>
                            <?php the_terms(get_the_ID(), 'project_category') ?>
                        </div>
                        <div class="project-meta__date">
                            <?php icon('date', .75) ?>
                            Опубликовано: <?php the_modified_date() ?>
                        </div>
                        <div class="project-meta__arrows">
                            <button class="js_prev">js_prev</button>
                            <button class="js_next">js_next</button>
                        </div>
                    </div>
                    <div class="project-layout">
                        <div class="project-layout__left">
                            <?php if ($gallery = get_field('gallery')): ?>
                            <div class="project-gallery-layout">
                                <div class="project-gallery-layout__left">
                                    <div class="project-gallery-slides js_slides">
                                        <?php foreach ($gallery as $item): ?>
                                        <div class="project-gallery-item">
                                            <div class="project-gallery-item__inner">
                                                <img src="<?php echo $item['sizes']['w800h480'] ?>" alt="">
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
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
                            <div class="project-details">
                                <?php if ($address = get_field('address')): ?>
                                <div class="project-details__address">
                                    <?php echo $address ?>
                                </div>
                                <?php endif; ?>
                                <?php if ($area = get_field('area')): ?>
                                <div class="project-details__area">
                                    <div class="project-details__area-label">Площадь</div>
                                    <div class="project-details__area-value">
                                        <?php echo $area ?> м<sup>2</sup>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($customer = get_field('customer')): ?>
                                <div class="project-details__customer">
                                    <div class="project-details__customer-label">
                                        <?php icon('user', .75) ?> Клиент
                                    </div>
                                    <div class="project-details__customer-value">
                                        <?php echo $customer ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="project-details__estimate">
                                    <?php if ($price_works = get_field('price_works')): ?>
                                    <div class="project-estimate">
                                        <div class="project-estimate__label">Цена за работы:</div>
                                        <div class="project-estimate__value"><?php echo $price_works ?></div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($price_material = get_field('price_material')): ?>
                                    <div class="project-estimate">
                                        <div class="project-estimate__label">Цена материала:</div>
                                        <div class="project-estimate__value"><?php echo $price_material ?></div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($time_works = get_field('time_works')): ?>
                                    <div class="project-estimate">
                                        <div class="project-estimate__label">Сроки работы:</div>
                                        <div class="project-estimate__value"><?php echo $time_works ?></div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container container_tiny">
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </div>

            <section class="article-foot">
                <div class="container container_alt">
                    <div class="article-foot__inner">
                        <div class="article-foot__social">
                            <p>Понравился проект?<br> Поделись с друзьями:</p>
                            <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                            <script src="https://yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,telegram"></div>
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
                <div class="container container_alt">
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

            <?php get_template_part('partials/contacts', 'services'); ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>