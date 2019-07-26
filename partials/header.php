<div class="header-placeholder"></div>
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
            <button class="navigation__callback" data-micromodal-trigger="callback">
                <?php icon('phone') ?>
            </button>

            <?php wp_nav_menu([
                'theme_location' => 'mainmenu',
                'container' => false,
                'menu_class' => 'navigation-list'
            ]); ?>

            <div class="navigation__contacts">
                <a href="tel:<?php the_field('phone', 'options') ?>"><?php the_field('phone', 'options') ?></a>
                <p>Ежедневно с 9:00 до 20:00</p>
            </div>
        </nav>

        <a href="tel:<?php the_field('phone', 'options') ?>" class="header-callback">
            <span class="header-callback__phone"><?php the_field('phone', 'options') ?></span>
            <button class="header-callback__button js-header-callback" data-micromodal-trigger="callback">
                <?php icon('phone') ?>
                <span>Заказать обратный звонок</span>
            </button>
        </a>
    </div>
</header>