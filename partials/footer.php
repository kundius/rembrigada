<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer__copyright">
                © 2019, Rembrigada116.ru - Ремонт квартир <br> и коттеджей в Казани. Все права защищены.
            </div>
            <div class="footer-social">
                <a href="#" class="footer-social__vk"><?php icon('vk', 1.25) ?></a>
                <a href="#" class="footer-social__inst"><?php icon('instagram', 1.25) ?></a>
                <a href="#" class="footer-social__ok"><?php icon('ok', 1.25) ?></a>
                <a href="#" class="footer-social__youtube"><?php icon('youtube', 1.25) ?></a>
            </div>
            <div class="footer__requisites">
                ИНН 163300422218<br>
                ОГРНИП 313169008600154
            </div>
            <div class="footer__counters">
                <img src="https://via.placeholder.com/90x32" alt="">
            </div>
            <div class="footer__sitemap">
                <a href="#">Карта сайта</a>
            </div>
            <div class="footer__agreement">
                <a href="#">Пользовательское соглашение</a>
            </div>
            <div class="footer__policy">
                <a href="#">Политика конфиденциальности и обработки персональных данных</a>
            </div>
            <div class="footer__hr1"></div>
            <div class="footer__hr2"></div>
            <div class="footer__hr3"></div>
        </div>
    </div>
</footer>

<div class="modal modal_callback" id="callback" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="Обратный звонок">
            <button class="modal__close" aria-label="Закрыть модальное окно" data-micromodal-close></button>
            <div class="callback">
                <div class="callback__grid">
                    <div class="callback__cell">
                        <div class="callback__image">
                            <img src="<?php echo get_bloginfo('template_url') ?>/dist/img/our-work-send.jpg" alt="">
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
                                        <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/img/apartments.svg" alt=""></div>
                                    </div>
                                    <div class="callback-item__title">
                                        Ремонт квартир
                                    </div>
                                </div>
                                <div class="callback-item">
                                    <div class="callback-item__image">
                                        <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/img/houses.svg" alt=""></div>
                                    </div>
                                    <div class="callback-item__title">
                                        Ремонт домов
                                    </div>
                                </div>
                                <div class="callback-item">
                                    <div class="callback-item__image">
                                        <div><img src="<?php echo get_bloginfo('template_url') ?>/dist/img/commercial.svg" alt=""></div>
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
            <!-- <div class="callback">
                <div class="callback__grid">
                    <div class="callback__cell">
                        <div class="callback__image">
                            <img src="<?php echo get_bloginfo('template_url') ?>/dist/img/callback.jpg" alt="">
                        </div>
                    </div>
                    <div class="callback__cell">
                        <form action="#" class="callback-form">
                            <div class="callback-form__title">Заказать<br> Обратный звонок</div>
                            <div class="callback-form__desc">Заполните форму, и наш специалист свяжется с Вами в течении 15 минут</div>
                            <div class="callback-form__fields">
                                <div class="callback-form__row">
                                    <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
                                </div>
                                <div class="callback-form__row">
                                    <input type="email" name="your-email" value="" class="form-input" placeholder="E-mail" />
                                </div>
                                <div class="callback-form__row">
                                    <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон*">
                                </div>
                                <div class="callback-form__row">
                                    <label class="callback-form__rules">
                                        <input type="checkbox" name="rules" value="1" class="form-checkbox" />
                                        <span></span>
                                        Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
                                    </label>
                                </div>
                                <div class="callback-form__row">
                                    <button type="submit" class="form-submit"><span></span><span>Отправить</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_bloginfo('template_url') ?>/dist/main.js"></script>
<?php wp_footer() ?>