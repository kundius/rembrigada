<?php
/*
Template Name: Услуги - Раздел
*/
$services = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => get_the_ID(),
    'order' => 'ASC',
    'orderby' => 'menu_order'
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

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part('partials/page-headline') ?>

            <?php if ($mask = get_field('mask')): ?>
                <div class="services-section-mask">
                    <?php echo $mask ?>
                </div>
            <?php endif; ?>

            <div class="services-section-content">
                <div class="container container_tiny">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>

            <?php if ($types = get_field('types')): ?>
                <div class="services-section-types">
                    <div class="container">
                        <?php if ($types_title = get_field('types_title')): ?>
                        <div class="services-section-types__title"><?php echo $types_title ?></div>
                        <?php endif; ?>
                        <div class="services-section-types__grid">
                            <?php foreach($types as $type): ?>
                            <div class="services-section-types__cell">
                                <div class="services-section-type">
                                    <?php if ($type['image']): ?>
                                    <div class="services-section-type__image">
                                        <img src="<?php echo $type['image']['url'] ?>" alt="">
                                    </div>
                                    <?php endif; ?>
                                    <div class="services-section-type__title"><?php echo $type['title'] ?></div>
                                    <div class="services-section-type__content"><?php echo $type['content'] ?></div>
                                    <div class="services-section-type__signature"><?php echo $type['signature'] ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($results = get_field('results')): ?>
                <div class="services-section-results">
                    <div class="container container_alt">
                        <?php if ($results_title = get_field('results_title')): ?>
                        <div class="services-section-results__title"><?php echo $results_title ?></div>
                        <?php endif; ?>
                        <div class="services-section-results__grid">
                            <?php foreach($results as $result): ?>
                            <div class="services-section-results__cell">
                                <div class="services-section-result">
                                    <?php if ($result['image']): ?>
                                    <div class="services-section-result__image">
                                        <span></span>
                                        <img src="<?php echo $result['image']['url'] ?>" alt="" class="js-img-to-svg">
                                    </div>
                                    <?php endif; ?>
                                    <div class="services-section-result__title">
                                        <span><?php echo $result['title'] ?></span>
                                    </div>
                                    <div class="services-section-result__content"><?php echo $result['description'] ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <section class="section-contacts js-section-offset">
                <div class="container container_alt">
                    <div class="services-calculation js-section-offset-inner">
                        <div class="services-calculation__desc">
                            Готовы двигаться дальше? Тогда пришло время посмотреть, как мы делаем ремонт, и рассчитать предварительную стоимость вашего ремонта →
                        </div>
                        <div class="services-calculation__grid">
                            <div class="services-calculation__cell">
                                <div class="services-calculation__image">
                                    <img src="<?php echo get_bloginfo('template_url') ?>/dist/img/our-work-send.jpg" alt="">
                                    <a href="<?php echo get_category_link(3) ?>" class="services-calculation__works" target="_blank">
                                        <span>Наши работы</span>
                                    </a>
                                </div>
                            </div>
                            <div class="services-calculation__cell">
                                <form action="/wp-json/contact-form-7/v1/contact-forms/380/feedback" method="post" class="services-calculation-form js-form">
                                    <div class="services-calculation-form__title">Рассчитать предварительную стоимость</div>
                                    <div class="services-calculation-form__desc">Заполните форму, и наш специалист свяжется с Вами в течение 15 минут</div>
                                    <div class="services-calculation-form__fields">
                                        <div class="services-calculation-form__row">
                                            <span class="wpcf7-form-control-wrap your-email">
                                                <input type="email" name="your-email" value="" class="form-input" placeholder="E-mail*" />
                                            </span>
                                        </div>
                                        <div class="services-calculation-form__row">
                                            <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон">
                                        </div>
                                        <div class="services-calculation-form__row">
                                            <label class="services-calculation-form__rules">
                                                <input type="checkbox" name="rules" value="1" class="form-checkbox" />
                                                <span></span>
                                                Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
                                            </label>
                                        </div>
                                        <div class="services-calculation-form__row">
                                            <input type="hidden" name="referrer" value="<?php the_title() ?>">
                                            <button type="submit" class="form-submit"><span></span><span>Отправить</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="section-contacts-grid">
                        <div class="section-contacts__item">
                            <div class="contacts">
                                <h3 class="contacts__title">Контакты</h3>
                                <div class="contacts__text" itemscope itemtype="http://schema.org/LocalBusiness">
                                    <meta itemprop="name" content="<?php echo get_bloginfo('blogname') ?>" />
                                    <meta itemprop="priceRange" content="2500-6000RUB" />
                                    <meta itemprop="description" content="<?php echo get_bloginfo('description') ?>" />
                                    <meta itemprop="image" content="<?php echo get_bloginfo('template_url') ?>/dist/img/logo.png" />
                                    <a href="<?php the_field('ymap_link', 'options') ?>" class="contacts__row" itemprop="address" target="_blank">
                                        <?php the_field('address', 'options') ?>
                                    </a>
                                    <div class="contacts__row contacts-phones">
                                      <div class="contacts-phones__list">
                                        <?php foreach (get_field('phones', 'options') as $row): ?>
                                          <div itemprop="telephone">Тел.: <?php echo $row['number'] ?></div>
                                        <?php endforeach ?>
                                      </div>
                                      <div class="contacts-phones__messengers">
                                        <div class="contacts-messengers">
                                            <a class="contacts-messengers__item contacts-messengers__item_telegram" href="tg://resolve?domain=<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone_telegram', 'options')) ?>">
                                                <?php icon('telegram', 1.2) ?>
                                            </a>
                                            <a class="contacts-messengers__item contacts-messengers__item_whatsapp" href="whatsapp://send?text=Hello&phone=<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone_whatsapp', 'options')) ?>">
                                                <?php icon('whatsapp', 1.3) ?>
                                            </a>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="contacts__row">
                                        <a href="mailto:<?php the_field('email', 'options') ?>"><?php the_field('email', 'options') ?></a>
                                    </div>
                                </div>
                                <div class="contacts__time">
                                    <?php icon('clock', 1.25) ?>
                                    <?php the_field('schedule', 'options') ?>
                                </div>
                            </div>
                        </div>
                        <div class="section-contacts__item hidden@s">
                            <?php
                            $list = new WP_Query(array(
                                'post_type' => 'page',
                                'post_parent' => 11,
                                'order' => 'ASC',
                                'orderby' => 'menu_order',
                                'post__not_in' => [38]
                            ));
                            ?>
                            <div class="contacts">
                                <div class="contacts__title">Услуги</div>
                                <div class="contacts__text">
                                    <ul>
                                        <?php while($list->have_posts()): $list->the_post(); ?>
                                            <li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                                <div class="contacts__time">
                                    <?php icon('info', 1.25) ?>
                                    Может быть полезно:
                                    <a href="<?php echo get_category_link(8) ?>">Статьи о ремонте</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A3fd55e7ae5de7ab5fde09516821ffdbb169f60b6d0a2fb8f43b6c532684a4fb4&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
            </section>

            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>
