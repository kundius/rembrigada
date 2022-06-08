<div class="section-contacts-call">
    <div class="section-contacts-call__title">Заказать Обратный звонок</div>
    <div class="section-contacts-call__desc">Заполните форму, и наш специалист свяжется с Вами в течении 15 минут</div>
    <form action="/wp-json/contact-form-7/v1/contact-forms/379/feedback" method="post" class="section-contacts-call__form js-form">
        <div>
            <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
        </div>
        <div>
            <span class="wpcf7-form-control-wrap your-phone">
                <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон">
            </span>
        </div>
        <div>
            <input type="hidden" name="referrer" value="<?php the_title() ?>">
            <button type="submit" class="form-submit-holey"><span></span><span>Отправить</span></button>
        </div>
        <div>
            <label class="section-contacts-call__rules">
                <input type="checkbox" name="rules" checked value="1" class="form-checkbox" />
                <span></span>
                Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
            </label>
        </div>
    </form>
</div>
