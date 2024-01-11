<?php $raw_phone = preg_replace("/[ \(\)\-]/", "", get_field('phone', 'options')) ?>
<div class="header-placeholder"></div>
<header class="header">
    <div class="container">
        <a href="/" class="header__logo"><img src="<?php echo get_bloginfo('template_url') ?>/dist/images/logo-dark.png" alt="<?php echo get_bloginfo('description') ?>"></a>

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

        <div class="header-m-messengers">
            <!-- <a class="header-m-messengers__item header-m-messengers__item_telegram" href="tg://resolve?domain=<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone_telegram', 'options')) ?>">
                <?php icon('telegram', 0.7) ?>
            </a> -->
            <a class="header-m-messengers__item header-m-messengers__item_price" href="/price" target="_blank">
                Цены
            </a>
            <a class="header-m-messengers__item header-m-messengers__item_instagram" href="https://instagram.com/rembrigada116?igshid=YmMyMTA2M2Y=" target="_blank">
                <?php icon('instagram', 0.8) ?>
            </a>
            <a class="header-m-messengers__item header-m-messengers__item_whatsapp" href="whatsapp://send?text=Hello&phone=<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone_whatsapp', 'options')) ?>">
                <?php icon('whatsapp', 0.8) ?>
            </a>
            <a class="header-m-messengers__item header-m-messengers__item_phone" href="tel:<?php echo $raw_phone ?>">
                <?php icon('phone', 0.7) ?>
            </a>
        </div>

        <a href="tel:<?php echo $raw_phone ?>" class="header-phone js-header-callback">
            <div class="header-phone__number">
                <span class="header-phone__icon">
                    <?php icon('phone') ?>
                </span>
                <?php the_field('phone', 'options') ?>
            </div>
            <div class="header-phone__label">Перезвоните мне</div>
        </a>
    </div>
</header>
