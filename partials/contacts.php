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
                <form action="#" class="contacts-form">
                    <div class="contacts-form__row">
                        <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
                    </div>
                    <div class="contacts-form__row">
                        <input type="email" name="your-email" value="" class="form-input" placeholder="E-mail*" />
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
                        <button type="submit" class="form-submit"><span></span><span>Отправить</span></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- <form action="#" class="footer-form">
            <div class="footer-form-input">
                <input type="text" name="name" id="name" placeholder="Имя" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                <input type="email" name="email" id="email" placeholder="E-mail*" required="">
                <input type="tel" name="tel" id="tel" placeholder="Телефон">
            </div>
            <textarea name="footer-form-msg" id="footer-form-msg" cols="30" rows="10" placeholder="Текст сообщения"></textarea>
            <a href="#" class="more-btn"><p>Отправить</p><span></span></a>
            <input type="checkbox" name="agreements" id="agreements">
            <label for="agreements" class="agreements-label"><span><div class="checked"></div></span>Прочитал(-а) <a href="#">Пользовательское соглашение</a> и соглашаюсь с <a href="#">Политикой обработки персональных данных</a></label>
        </form> -->
    </div>
</section>