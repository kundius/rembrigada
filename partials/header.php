<?php $raw_phone = preg_replace("/[ \(\)\-]/", "", get_field('phone', 'options')) ?>
<div class="header-placeholder"></div>
<header class="header">
    <div class="container">
        <a href="/" class="header__logo">
            РЕМБРИГАДА<span>116</span>
        </a>

        <div class="header-toggle">
            <div class="header-toggle__icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header-toggle__label">Меню</div>
        </div>

        <nav class="navigation">
            <a href="/"><img class="navigation__logo" src="<?php echo get_bloginfo('template_url') ?>/dist/images/logo-light.png" alt="<?php echo get_bloginfo('description') ?>"></a>

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
        
        <button class="navigation-close"></button>

        <a href="tel:<?php echo $raw_phone ?>" class="header-phone js-header-callback">
            <div class="header-phone__number">
                <span class="header-phone__icon">
                    <?php icon('phone') ?>
                </span>
                <div class="header-phone__value">
                    <?php the_field('phone', 'options') ?>
                </div>
            </div>
            <div class="header-phone__desc">Ежедневно с 9:00 до 20:00</div>
            <div class="header-phone__label">Перезвоните мне</div>
        </a>

        <a href="tel:<?php echo $raw_phone ?>" class="header-callback js-header-callback">
            <?php icon('phone') ?>
        </a>
    </div>
</header>
