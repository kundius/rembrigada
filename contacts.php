<?php
/*
Template Name: Контакты
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

            <section class="page-headline">
                <div class="container">
                    <h1 class="page-headline__title"><span><?php the_title() ?></span></h1>
                </div>
            </section>

            <div class="p-contacts-section">
                <div class="p-contacts-section__content">
                    <div class="p-contacts" itemscope itemtype="http://schema.org/LocalBusiness">
                        <div class="p-contacts__row">
                            <a href="<?php the_field('ymap_link', 'options') ?>" itemprop="address" target="_blank">
                                <?php the_field('address', 'options') ?>
                            </a>
                        </div>
                        <div class="p-contacts__row p-contacts-phones">
                            <div class="p-contacts-phones__list">
                                <?php foreach (get_field('phones', 'options') as $row): ?>
                                    <div itemprop="telephone">Тел.: <?php echo $row['number'] ?></div>
                                <?php endforeach ?>
                            </div>
                            <div class="p-contacts-phones__messengers">
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
                        <div class="p-contacts__row">
                          <?php the_field('requisites', 'options') ?>
                        </div>
                        <div class="p-contacts__row">
                            <a href="mailto:<?php the_field('email', 'options') ?>"><?php the_field('email', 'options') ?></a>
                        </div>
                        <meta itemprop="name" content="<?php echo get_bloginfo('blogname') ?>" />
                        <meta itemprop="priceRange" content="2500-6000RUB" />
                        <meta itemprop="description" content="<?php echo get_bloginfo('description') ?>" />
                        <meta itemprop="image" content="<?php echo get_bloginfo('template_url') ?>/dist/img/logo-light.png" />
                    </div>
                    <div class="p-contacts-time">
                        <?php icon('clock', 1.25) ?>
                        <?php the_field('schedule', 'options') ?>
                    </div>
                    <form action="/wp-json/contact-form-7/v1/contact-forms/5/feedback" method="post" class="p-contacts-form js-form">
                        <div class="p-contacts-form__title">Обратная связь</div>
                        <div class="p-contacts-form__grid">
                            <div class="p-contacts-form__row">
                                <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
                            </div>
                            <div class="p-contacts-form__row">
                                <span class="wpcf7-form-control-wrap your-email">
                                    <input type="email" name="your-email" value="" class="form-input" placeholder="E-mail*" />
                                </span>
                            </div>
                            <div class="p-contacts-form__row">
                                <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон">
                            </div>
                            <div class="p-contacts-form__row">
                                <textarea name="message" class="form-textarea" placeholder="Текст сообщения" style="height: 100%;"></textarea>
                            </div>
                            <div class="p-contacts-form__row">
                                <label class="p-contacts-form__rules">
                                    <input type="checkbox" name="rules" checked value="1" class="form-checkbox" />
                                    <span></span>
                                    Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
                                </label>
                            </div>
                            <div class="p-contacts-form__row">
                                <input type="hidden" name="referrer" value="<?php the_title() ?>">
                                <button type="submit" class="form-submit"><span></span><span>Отправить</span></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="p-contacts-section__map">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A3fd55e7ae5de7ab5fde09516821ffdbb169f60b6d0a2fb8f43b6c532684a4fb4&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
                </div>
            </div>

            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>
