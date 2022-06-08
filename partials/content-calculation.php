<div class="services-calculation">
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
                            <input type="checkbox" name="rules" checked value="1" class="form-checkbox" />
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
