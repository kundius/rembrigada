<section class="section-contacts">
    <div class="container container_alt">
        <div class="section-contacts-grid">
            <div class="section-contacts__item">
                <div class="contacts">
                    <div class="contacts__title">Контакты</div>
                    <div class="contacts__text">
                        <p>Казань, ул. Четаева, 27</p>
                        <p>
                            Тел:  +7 (843) 260-11-00<br>
                            Тел:  +7 (987) 230‑17-34
                        </p>
                        <p>
                            <a href="mailto:rembrigada116@yandex.ru">Rembrigada116@yandex.ru</a>
                        </p>
                    </div>
                    <div class="contacts__time">
                        <?php icon('clock', 1.25) ?>
                        Пн-пт 9:00 – 21:00;&#8195;сб 9:00 – 19:00
                    </div>
                </div>
            </div>
            <div class="section-contacts__item">
                <form action="http://rembrigada116.domenart-studio.ru/wp-json/contact-form-7/v1/contact-forms/5/feedback" method="post" class="contacts-form js-form">
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
                        <span class="wpcf7-form-control-wrap rules">
                            <label class="contacts-form__rules">
                                <input type="checkbox" name="rules" value="1" class="form-checkbox" />
                                <span></span>
                                Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
                            </label>
                        </span>
                    </div>
                    <div class="contacts-form__row">
                        <span class="wpcf7-form-control-wrap submit">
                            <button type="submit" class="form-submit"><span></span><span>Отправить</span></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>