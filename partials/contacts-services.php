<section class="section-contacts js-section-offset">
    <div class="container container_alt">
        <div class="section-contacts-call js-section-offset-inner">
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
                        <input type="checkbox" name="rules" value="1" class="form-checkbox" />
                        <span></span>
                        Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
                    </label>
                </div>
            </form>
        </div>

        <div class="section-contacts-grid">
            <div class="section-contacts__item">
                <div class="contacts">
                    <h3 class="contacts__title">Контакты</h3>
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
    <img class="section-contacts__bg" src="<?php echo get_bloginfo('template_url') ?>/dist/img/map-bg.jpg" loading="lazy" />
</section>