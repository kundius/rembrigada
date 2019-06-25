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
            <section class="single-headline">
                <div class="container container_alt">
                    <div class="single-headline__date">23<span>ноября`19</span></div>
                    <h1 class="single-headline__title"><span><?php the_title() ?></span></h1>
                </div>
            </section>

            <div class="bg-category-name">Всё о ремонте</div>
        <!-- <section class="vertical-social container">
            <a href="#" class="vk"></a>
            <a href="#" class="fb"></a>
            <a href="#" class="telegram"></a>
            <a href="#" class="ok"></a>
            <a href="#" class="pinterest"></a>
            <a href="#" class="twitter"></a>
        </section> -->
            <section class="news-details">
                <div class="container container_tiny">
                    <div class="type-news-date-author-comments-num">
                        <div class="type-news">
                            <?php icon('category', .75) ?>
                            <?php the_category(',') ?>
                        </div>
                        <div class="date-author-comments-num">
                            <span><?php icon('date', .75) ?> Опубликовано: <?php the_modified_date(); ?></span>
                            <span><?php icon('user', .75) ?> <?php the_author() ?></span>
                            <span><?php icon('comments', .75) ?> <?php echo get_comments_number() ?></span>
                        </div>
                    </div>

                    <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), 'large')): ?>
                    <div class="news-details__entry">
                        <img src="<?php echo $image ?>" alt="<?php the_title() ?>">
                    </div>
                    <?php endif; ?>

                    <div class="content">
                        <?php the_content(); ?>
                    </div>

                    <div class="news-details__tags">
                        <?php the_tags('', ''); ?>
                    </div>
                </div>
            </section>
            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

        <section class="social-page">
            <div class="container">
                <div class="social">
                    <p>Понравился проект? <br> Поделись с друзьями:</p>
                    <a href="#" class="vk"></a>
                    <a href="#" class="fb"></a>
                    <a href="#" class="telegram"></a>
                    <a href="#" class="ok"></a>
                    <a href="#" class="pinterest"></a>
                    <a href="#" class="twitter"></a>
                </div>
                <div class="social-comments">
                    <a href="#">19</a>
                </div>
                <div class="page">
                    <a href="#" class="prev-page">Предыдущая</a>
                    <a href="#" class="next-page">Следующая</a>
                </div>
            </div>
        </section>
        <section class="interested-news">
            <div class="container">
                <p>Вам может быть интересно:</p>
                <div class="interested-news-list">
                    <div class="interested-news-item">
                        <p class="date">11 ноября 2019</p>
                        <a href="#" class="interested-news-title">
                            <h4>Монтаж электропроводки — дело серьезное, или Как сделать проводку в квартире своими руками</h4>
                            <hr>
                        </a>
                        <p>Электропроводка — это надолго и всерьез. Если, конечно, монтаж электропроводки сделан качественно и правильно.</p>
                        <img src="img/interested-news1.jpg" alt="">
                    </div>
                    <div class="interested-news-item">
                        <p class="date">10 ноября 2019</p>
                        <div class="interested-news-title">
                            <h4>Наш любимый способ штукатурки стен декоративной штукатуркой</h4>
                            <hr>
                        </div>
                        <p>В нашей компании особую любовь среди прочих способов финальной обработки стен заслужила декоративная штукатурка...</p>
                        <img src="img/interested-news2.jpg" alt="">
                    </div>
                    <div class="interested-news-item">
                        <p class="date">09 ноября 2017</p>
                        <div class="interested-news-title">
                            <h4>Лучшие 8 с половиной приемов зонирования комнат</h4>
                            <hr>
                        </div>
                        <img src="img/interested-news3.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="comments">
            <div class="container">
                <p class="comments-title">Комментарии <span>(19)</span></p>
                <div class="comments-list">
                    <div class="comments-item">
                        <div class="comments-author-date">
                            <div class="img-author">
                                <img src="" alt="">
                                <p class="comments-author">Автор <span>комментария</span></p>
                            </div>
                            <p class="comments-date">07 апреля 2019, 20:52</p>
                        </div>
                        <p class="comments-text">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для</p>
                        <a href="#">ответить</a>
                    </div>
                    <div class="comments-item comments-answer">
                        <div class="comments-author-date">
                            <div class="img-author">
                                <img src="" alt="">
                                <p class="comments-author">Автор <span>комментария</span></p>
                            </div>
                            <p class="comments-date">07 апреля 2019, 20:52</p>
                        </div>
                        <p class="comments-text">Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной</p>
                        <a href="#">ответить</a>
                    </div>
                </div>
                <div class="add-comments">
                    <h5>Добавить комментарий</h5>
                    <label for="author">
                        <p>Автор</p>
                        <input type="text" name="name" id="author" placeholder="Автор">
                    </label>
                    <label for="email">
                        <p>E-mail<span>*</span></p>
                        <input type="email" name="email" id="email" placeholder="mail@mail.com" required>
                    </label>
                    <label for="comments-text">
                        <div class="comments-transform">
                            <div class="comments-text-transform">
                                <a href="#" class="bold"></a>
                                <a href="#" class="italic"></a>
                                <a href="#" class="underline"></a>
                                <a href="#" class="line-through"></a>
                            </div>
                            <div class="comments-additional-transform">
                                <a href="#" class="reply"></a>
                                <a href="#" class="code"></a>
                                <a href="#" class="link"></a>
                                <a href="#" class="document"></a>
                            </div>
                        </div>
                        <textarea name="comments-text" id="comments-text" cols="30" rows="10" placeholder="Текст комментария"></textarea>
                    </label>
                    <label for="check">
                        <p>Введите сумму <span>1+5</span></p>
                        <input type="number" name="check" id="check">
                    </label>
                    <div class="preview-add-comments-btn">
                        <a href="#" class="preview">Предпросмотр</a>
                        <a href="#" class="add-comments-btn more-btn">
                            <p>Отправить</p>
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

            <div class="section-main">
                <div class="container">
                    <div class="layout">
                        <div class="layout__sidebar">
                            <?php get_sidebar() ?>
                        </div>
                        <div class="layout__content">
                            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
                                <h1><?php the_title(); ?></h1>
                                <?php the_content(); ?>
                                <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                                <script src="//yastatic.net/share2/share.js"></script>
                                <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir"></div>
                            <?php endwhile; else: ?>
                                <p>Извините, ничего не найдено.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php get_template_part('partials/contacts'); ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>