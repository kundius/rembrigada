<section class="section-contacts">
    <div class="container container_alt">
        <div class="section-contacts-call">
            <div class="section-contacts-call__title">Заказать Обратный звонок</div>
            <div class="section-contacts-call__desc">Заполните форму, и наш специалист свяжется с Вами в течении 15 минут</div>
            <form action="#" class="section-contacts-call__form">
                <div>
                    <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
                </div>
                <div>
                    <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон">
                </div>
                <div>
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
</section>