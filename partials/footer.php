<footer class="footer">
    <div class="container">
        <?php wp_nav_menu([
            'theme_location' => 'footermenu',
            'container' => false,
            'menu_class' => 'footer-menu'
        ]); ?>
        <div class="footer-grid">
            <div class="footer__copyright">
                <?php the_field('copyright', 'options') ?>
            </div>
            <div class="footer-social">
                <a href="https://vk.com/remont_kvartir_kazann" class="footer-social__vk" target="_blank"><?php icon('vk', 1.25) ?></a>
                <a href="https://twitter.com/Rembrigada116" class="footer-social__twitter" target="_blank"><?php icon('twitter', 1.25) ?></a>
                <a href="https://www.instagram.com/rembrigada116" class="footer-social__inst" target="_blank"><?php icon('instagram', 1.25) ?></a>
                <!--<a href="#" class="footer-social__ok" target="_blank"><?php icon('ok', 1.25) ?></a>-->
                <a href="https://www.youtube.com/channel/UCtBVuN9WYMvtfWkdrc2XBBA" class="footer-social__youtube" target="_blank"><?php icon('youtube', 1.25) ?></a>
            </div>
            <div class="footer__requisites">
                <?php the_field('requisites', 'options') ?>
            </div>
            <div class="footer__counters">
                <?php the_field('counters', 'options') ?>
                <a href="https://domenart-studio.ru/" target="_blank">
                    <img src="<?php echo get_bloginfo('template_url') ?>/dist/images/creator.png" alt="" loading="lazy">
                </a>
            </div>
            <div class="footer__sitemap">
                <a href="<?php the_permalink(452) ?>">Карта сайта</a>
            </div>
            <div class="footer__agreement">
                <a href="<?php the_permalink(231) ?>">Пользовательское соглашение</a>
            </div>
            <div class="footer__policy">
                <a href="<?php the_permalink(3) ?>">Политика конфиденциальности и обработки персональных данных</a>
            </div>
            <div class="footer__hr1"></div>
            <div class="footer__hr2"></div>
            <div class="footer__hr3"></div>
        </div>
    </div>
</footer>

<div id="callback" class="hidden">
    <div class="modal modal_callback">
        <button class="modal__close" data-basiclightbox-close></button>
        <form action="/wp-json/contact-form-7/v1/contact-forms/379/feedback" method="post" class="callback js-form">
            <div class="callback__form">
                <div class="callback__grid">
                    <div class="callback__cell">
                        <div class="callback__image">
                            <img src="<?php echo get_bloginfo('template_url') ?>/dist/images/callback.jpg" alt="" loading="lazy">
                        </div>
                    </div>
                    <div class="callback__cell">
                        <div class="callback-form">
                            <div class="callback-form__title">Заказать<br> Обратный звонок</div>
                            <div class="callback-form__desc">Заполните форму, и наш специалист свяжется с Вами в течение 15 минут</div>
                            <div class="callback-form__fields">
                                <div class="callback-form__row">
                                    <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
                                </div>
                                <div class="callback-form__row">
                                    <span class="wpcf7-form-control-wrap your-email">
                                        <input type="email" name="your-email" value="" class="form-input" placeholder="E-mail" />
                                    </span>
                                </div>
                                <div class="callback-form__row">
                                    <span class="wpcf7-form-control-wrap your-phone">
                                        <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон*">
                                    </span>
                                </div>
                                <div class="callback-form__row">
                                    <label class="callback-form__rules">
                                        <input type="checkbox" name="rules" checked value="1" class="form-checkbox" />
                                        <span></span>
                                        Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
                                    </label>
                                </div>
                                <div class="callback-form__row">
                                    <input type="hidden" name="referrer" value="<?php echo wp_get_document_title() ?>">
                                    <button type="submit" class="form-submit"><span></span><span>Отправить</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="callback__success">
                <div class="callback__grid">
                    <div class="callback__cell">
                        <div class="callback__image">
                            <img src="<?php echo get_bloginfo('template_url') ?>/dist/images/our-work-send.jpg" alt="" loading="lazy">
                            <a href="<?php the_permalink(15) ?>" class="callback__works">
                                <span>Наши работы</span>
                            </a>
                        </div>
                    </div>
                    <div class="callback__cell">
                        <div class="callback-form">
                            <div class="callback-form__title">Ваша заявка успешно отправлена</div>
                            <div class="callback-form__desc">Наш специалист свяжется с Вами в течении 15 минут, а пока вы можете ознакомиться с видами ремонта, которые мы делаем и как мы его делаем.</div>
                            <div class="callback-items">
                                <div class="callback-item">
                                    <div class="callback-item__image">
                                        <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/apartments.svg" alt="" loading="lazy"></div>
                                    </div>
                                    <div class="callback-item__title">
                                        Ремонт квартир
                                    </div>
                                </div>
                                <div class="callback-item">
                                    <div class="callback-item__image">
                                        <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/houses.svg" alt="" loading="lazy"></div>
                                    </div>
                                    <div class="callback-item__title">
                                        Ремонт домов
                                    </div>
                                </div>
                                <div class="callback-item">
                                    <div class="callback-item__image">
                                        <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/commercial.svg" alt="" loading="lazy"></div>
                                    </div>
                                    <div class="callback-item__title">
                                        Ремонт коммерческой недвижимости
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="order" class="hidden">
    <div class="modal modal_order">
        <button class="modal__close" data-basiclightbox-close></button>
        <form action="/wp-json/contact-form-7/v1/contact-forms/4198/feedback" method="post" class="order-form js-form">
            <input type="hidden" name="subject" value="Заявка на расчет">

            <div class="order-form__title">Заявка на расчет</div>
            <div class="order-form__desc"></div>
            <div class="order-form__fields">
                <div class="order-form__row">
                    <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
                </div>
                <div class="order-form__row">
                    <span class="wpcf7-form-control-wrap your-phone">
                        <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон*">
                    </span>
                </div>
                <div class="order-form__row order-form__message">
                    <textarea name="message" class="form-textarea" placeholder="Сообщение"></textarea>
                </div>
                <div class="order-form__row order-form__submit">
                    <button type="submit" class="landing-button">Отправить</button>
                </div>
                <div class="order-form__row">
                    <label class="order-form__rules">
                        <input type="checkbox" name="rules" checked value="1" class="form-checkbox" />
                        <span></span>
                        Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и&nbsp;соглашаюсь с&nbsp;<a href="<?php the_permalink(3) ?>" target="_blank">Политикой конфиденциальности</a>
                    </label>
                </div>
            </div>
                            
            <div class="order-form__success">
                <div class="order-form__title">Ваша заявка успешно отправлена</div>
                <div class="order-form__desc"></div>
                <div class="callback-items">
                    <div class="callback-item">
                        <div class="callback-item__image">
                            <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/apartments.svg" alt="" loading="lazy"></div>
                        </div>
                        <div class="callback-item__title">
                            Ремонт квартир
                        </div>
                    </div>
                    <div class="callback-item">
                        <div class="callback-item__image">
                            <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/houses.svg" alt="" loading="lazy"></div>
                        </div>
                        <div class="callback-item__title">
                            Ремонт домов
                        </div>
                    </div>
                    <div class="callback-item">
                        <div class="callback-item__image">
                            <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/commercial.svg" alt="" loading="lazy"></div>
                        </div>
                        <div class="callback-item__title">
                            Ремонт коммерческой недвижимости
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<button class="scrollup js-scroll"></button>

<script src="<?php echo get_bloginfo('template_url') ?>/dist/scripts/scripts.js"></script>
<?php wp_footer() ?>
