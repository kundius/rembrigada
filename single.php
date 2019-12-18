<!DOCTYPE html>
<html lang="ru" itemscope itemtype="http://schema.org/WebSite">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper" itemscope itemtype="http://schema.org/Article">
            <?php get_template_part('partials/header'); ?>

            <div class="breadcrumbs breadcrumbs_light" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
            <meta itemprop="author" content="<?php echo get_bloginfo('blogname') ?>" />
            <meta itemprop="dateModified" content="<?php echo the_modified_date('Y-m-d') ?>" />
            <meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d') ?>" />
            <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                <meta itemprop="image" content="<?php echo get_bloginfo('template_url') ?>/dist/img/logo.png" />
                <meta itemprop="name" content="<?php echo get_bloginfo('blogname') ?>">
            </div>

            <section class="single-headline">
                <div class="container container_alt">
                    <div class="single-headline__date">
                        <?php get_the_date('d') ?>
                        <span><?php get_the_date('F') ?>`<?php get_the_date('y') ?></span>
                    </div>
                    <h1 class="single-headline__title" itemprop="headline"><span><?php the_title() ?></span></h1>
                </div>
            </section>

            <!-- <div class="bg-category-name">Всё о ремонте</div> -->
            <!-- <section class="vertical-social container">
                <a href="#" class="vk"></a>
                <a href="#" class="fb"></a>
                <a href="#" class="telegram"></a>
                <a href="#" class="ok"></a>
                <a href="#" class="pinterest"></a>
                <a href="#" class="twitter"></a>
            </section> -->
            <section class="news-details">
                <div class="container container_alt">
                    <div class="type-news-date-author-comments-num">
                        <div class="type-news">
                            <?php icon('category', .75) ?>
                            <?php the_category(',') ?>
                        </div>
                        <div class="date-author-comments-num">
                            <span><?php icon('date', .75) ?> Опубликовано: <?php get_the_date() ?></span>
                            <span><?php icon('user', .75) ?> <?php the_author() ?></span>
                            <span><?php icon('comments', .75) ?> <?php echo get_comments_number() ?></span>
                        </div>
                    </div>

                    <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), 'large')): ?>
                    <a itemprop="url" href="<?php the_permalink() ?>" class="news-details__entry" style="display: none">
                        <img itemprop="image" src="<?php echo $image ?>" alt="<?php the_title() ?>">
                    </a>
                    <?php endif; ?>

                    <div class="content" itemprop="articleBody">
                        <?php the_content(); ?>
                    </div>

                    <div class="news-details__tags">
                        <?php the_tags('', ''); ?>
                    </div>
                </div>
            </section>

            <section class="article-foot">
                <div class="container container_alt">
                    <div class="article-foot__inner">
                        <div class="article-foot__social">
                            <p>Понравился проект?<br> Поделись с друзьями:</p>
                            <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                            <script src="https://yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,pinterest,twitter,telegram" data-image="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large') ?>"></div>
                        </div>
                        <div class="article-foot__comments">
                            <?php icon('comments', 1.25) ?> <?php echo get_comments_number() ?>
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
                if ($related = get_field('related')) {
                    $also_query = new wp_query([
                        'orderby'=> 'rand',
                        'caller_get_posts'=> 1,
                        'post__in' => $related,
                        'post__not_in' => [$post->ID],
                        'showposts'=> 5
                    ]);
                } else {
                    $tags = wp_get_post_tags($post->ID);
                    if ($tags) {
                        $tag_ids = [];
                        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                        $also_query = new wp_query([
                            'tag__in' => $tag_ids,
                            'orderby'=> 'rand',
                            'caller_get_posts'=> 1,
                            'post__not_in' => [$post->ID],
                            'showposts'=> 5
                        ]);
                    }
                }
            ?>

            <?php if ($also_query && $also_query->have_posts()): ?>
            <section class="interested-news">
                <div class="container container_alt">
                    <div class="interested-news__title">Вам может быть интересно:</div>
                    <div class="interested-news__grid">
                        <?php while($also_query->have_posts()): $also_query->the_post(); ?>
                        <div class="interested-news__cell">
                            <div class="interested-news-item">
                                <div class="interested-news-item__date"><?php get_the_date(); ?></div>
                                <a href="<?php the_permalink() ?>" class="interested-news-item__title">
                                    <h4><?php the_title() ?></h4>
                                    <hr>
                                </a>
                                <div class="interested-news-item__desc">
                                <?php the_excerpt() ?>
                                </div>
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

            <section class="comments">
                <div class="container container_alt">
                    <?php comments_template(); ?>
                </div>
            </section>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php get_template_part('partials/contacts'); ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>
