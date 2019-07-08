<?php
/*
Template Name: Контакты
*/
?>
<!DOCTYPE html>
<html>
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
                    <div class="p-contacts">
                        <p><?php the_field('address', 'options') ?></p>
                        <div class="p-contacts__grid">
                            <div class="p-contacts__cell"><?php the_field('phones', 'options') ?></div>
                            <div class="p-contacts__cell"><?php the_field('requisites', 'options') ?></div>
                        </div>
                        <p>
                            <a href="mailto:<?php the_field('email', 'options') ?>"><?php the_field('email', 'options') ?></a>
                        </p>
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
                                    <input type="checkbox" name="rules" value="1" class="form-checkbox" />
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