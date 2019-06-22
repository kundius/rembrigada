<header class="header">
    <div class="container">
        <a href="/" class="header__logo"><img src="<?php echo get_bloginfo('template_url') ?>/dist/img/logo.png" alt="<?php echo get_bloginfo('description') ?>"></a>

        <div class="header-toggle">
            <div class="header-toggle__icon"></div>
            <div class="header-toggle__label header-toggle__label_open">Меню</div>
            <div class="header-toggle__label header-toggle__label_close">Закрыть</div>
        </div>

        <nav class="navigation">
            <a href="/"><img class="navigation__logo" src="<?php echo get_bloginfo('template_url') ?>/dist/img/logo.png" alt="<?php echo get_bloginfo('description') ?>"></a>
            <button class="navigation__callback"><?php icon('phone') ?></button>

            <?php wp_nav_menu([
                'theme_location' => 'mainmenu',
                'container' => false,
                'menu_class' => 'navigation-list'
            ]); ?>

            <div class="navigation__contacts">
                <a href="tel:+88432601100">8 (843) 260-11-00</a>
                <p>Ежедневно с 9:00 до 20:00</p>
            </div>
        </nav>

        <div class="header-callback">
            <a href="tel:+88432601100" class="header-callback__phone">8 (843) 260-11-00</a>
            <button class="header-callback__button">
                <?php icon('phone') ?>
                <span>Заказать обратный звонок</span>
            </button>
        </div>
    </div>
</header>