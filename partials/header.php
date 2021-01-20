<?php $raw_phone = preg_replace("/[ \(\)\-]/", "", get_field('phone', 'options')) ?>
<!-- <div class="header-placeholder"></div> -->
<header class="header">
    <div class="container">
        <div class="header-toggle">
            <div class="header-toggle__icon"></div>
            <div class="header-toggle__label header-toggle__label_open">Меню</div>
            <div class="header-toggle__label header-toggle__label_close">Закрыть</div>
        </div>

        <a href="/" class="header__logo"><img src="<?php echo get_bloginfo('template_url') ?>/dist/img/logo.png" alt="<?php echo get_bloginfo('description') ?>"></a>

        <nav class="navigation">
            <a href="/"><img class="navigation__logo" src="<?php echo get_bloginfo('template_url') ?>/dist/img/logo.png" alt="<?php echo get_bloginfo('description') ?>"></a>
            <a href="tel:<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone', 'options')) ?>" class="navigation__callback js-header-callback">
                <?php icon('phone') ?>
            </a>

            <?php wp_nav_menu([
                'theme_location' => 'mainmenu',
                'container' => false,
                'menu_class' => 'navigation-list'
            ]); ?>

            <div class="navigation__contacts">
                <a href="tel:<?php echo $raw_phone ?>"><?php the_field('phone', 'options') ?></a>
                <p>Ежедневно с 9:00 до 20:00</p>
            </div>
        </nav>

        <!-- <div class="header-messengers">
            <a class="header-messengers__item header-messengers__item_telegram" href="tg://resolve?domain=<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone_telegram', 'options')) ?>">
                <?php icon('telegram', 0.7) ?>
            </a>
            <a class="header-messengers__item header-messengers__item_whatsapp" href="whatsapp://send?text=Hello&phone=<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone_whatsapp', 'options')) ?>">
                <?php icon('whatsapp', 0.8) ?>
            </a>
        </div> -->

        <div class="header__fbtns">
            <a href="mailto:<?php the_field('email', 'options') ?>" class="header__fbtn">
                <span class="header__fbtn-icon">
                    <?php icon('email') ?>
                </span>
                <span class="header__fbtn-label">
                    Написать<br /> письмо
                </span>
            </a>

            <button class="header__fbtn js-header-callback">
                <span class="header__fbtn-icon">
                    <?php icon('phone') ?>
                </span>
                <span class="header__fbtn-label">
                    Обратный<br /> звонок
                </span>
            </button>

            <a href="tel:<?php echo $raw_phone ?>" class="header__phone js-header-callback">
                <?php the_field('phone', 'options') ?>
            </a>
        </div>
    </div>
</header>
