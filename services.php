<?php
/*
Template Name: Услуги
*/
$services = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => get_the_ID(),
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post__not_in' => [38]
));
$complementary = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => 38,
    'order' => 'ASC',
    'orderby' => 'menu_order'
));
?>
<!DOCTYPE html>
<html>
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>
            
            <div class="breadcrumbs breadcrumbs_light" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
            <section class="page-headline">
                <div class="container">
                    <h1 class="page-headline__title"><span><?php the_title() ?></span></h1>
                </div>
            </section>

            <div class="services-content">
                <div class="container container_tiny">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>

            <?php if ($services->have_posts()): ?>
            <section class="services">
                <div class="container container_alt">
                    <?php while($services->have_posts()): $services->the_post(); ?>
                    <div class="services-item">
                        <div class="services-item__headline">
                            <a class="services-item__title" href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            <?php if ($price = get_field('price', get_the_ID())): ?>
                            <div class="services-item__price">
                                <?php echo $price['prefix'] ?>
                                <span><?php echo $price['amount'] ?></span>
                                <?php echo $price['unit'] ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="services-item__body">
                            <div class="services-item__image">
                                <a href="<?php the_permalink() ?>">
                                    <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), array(400, 400))): ?>
                                    <img src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                    <?php else: ?>
                                    <img src="https://via.placeholder.com/400x400" alt="">
                                    <?php endif; ?>
                                </a>
                            </div>

                            <div class="services-item__info">
                                <?php if (has_excerpt()): ?>
                                <div class="services-item__desc"><?php the_excerpt() ?></div>
                                <?php endif; ?>
                                <?php
                                    $children = new WP_Query(array(
                                        'post_type' => 'page',
                                        'order' => 'ASC',
                                        'orderby' => 'menu_order',
                                        'post_parent' => get_the_ID()
                                    ));
                                ?>
                                <?php if ($children->have_posts()): ?>
                                <div class="services-item__children">
                                    <?php while($children->have_posts()): $children->the_post(); ?>
                                        <div class="services-item-child">
                                            <a class="services-item-child__name" href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                            <a class="services-item-child__more" href="<?php the_permalink() ?>">подробнее о ремонте <span></span></a>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>

            <?php if ($complementary->have_posts()): ?>
            <section class="services-others">
                <div class="container container_alt">
                    <div class="services-others__title">Дополнительные услуги</div>
                    <div class="services-others__list">
                        <?php while($complementary->have_posts()): $complementary->the_post(); ?>
                        <a href="<?php the_permalink() ?>" class="services-others-item">
                            <span class="services-others-item__image">
                                <span>
                                    <?php if ($image = get_the_post_thumbnail_url(get_the_ID())): ?>
                                    <img src="<?php echo $image ?>" alt="<?php the_title() ?>" class="js-img-to-svg">
                                    <?php else: ?>
                                    <img src="https://via.placeholder.com/100x100" alt="">
                                    <?php endif; ?>
                                </span>
                            </span>
                            <span class="services-others-item__name"><?php the_title() ?></span>
                        </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

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

            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>