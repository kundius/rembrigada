<section class="section-contacts">
    <div class="container container_alt">
        <div class="section-contacts-grid">
            <div class="section-contacts__item">
                <div class="contacts">
                    <div class="contacts__title">Контакты</div>
                    <div class="contacts__text">
                        <p><?php the_field('address', 'options') ?></p>
                        <p><?php the_field('phones', 'options') ?></p>
                        <p>
                            <a href="mailto:<?php the_field('email', 'options') ?>"><?php the_field('email', 'options') ?></a>
                        </p>
                    </div>
                    <div class="contacts__time">
                        <?php icon('clock', 1.25) ?>
                        <?php the_field('schedule', 'options') ?>
                    </div>
                </div>
            </div>
            <div class="section-contacts__item">
                <form action="/wp-json/contact-form-7/v1/contact-forms/5/feedback" method="post" class="contacts-form js-form">
                    <div class="contacts-form__row">
                        <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
                    </div>
                    <div class="contacts-form__row">
                        <span class="wpcf7-form-control-wrap your-email">
                            <input type="email" name="your-email" value="" class="form-input" placeholder="E-mail*" />
                        </span>
                    </div>
                    <div class="contacts-form__row">
                        <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон">
                    </div>
                    <div class="contacts-form__row">
                        <textarea name="message" class="form-textarea" placeholder="Текст сообщения" style="height: 100%;"></textarea>
                    </div>
                    <div class="contacts-form__row">
                        <label class="contacts-form__rules">
                            <input type="checkbox" name="rules" value="1" class="form-checkbox" />
                            <span></span>
                            Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
                        </label>
                    </div>
                    <div class="contacts-form__row">
                        <input type="hidden" name="referrer" value="<?php the_title() ?>">
                        <button type="submit" class="form-submit"><span></span><span>Отправить</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A3fd55e7ae5de7ab5fde09516821ffdbb169f60b6d0a2fb8f43b6c532684a4fb4&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
</section>