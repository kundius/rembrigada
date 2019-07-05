<?php
/*
Template Name: Услуги - Раздел
*/
$services = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => get_the_ID(),
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

            <?php if ($mask = get_field('mask')): ?>
                <div class="services-section-mask">
                    <?php echo $mask ?>
                </div>
            <?php endif; ?>

            <?php if ($prices = get_field('prices')): ?>
                <div class="services-section-repairs">
                    <div class="container container_alt">
                        <div class="services-section-repairs__list">
                            <?php foreach($prices as $key => $price): ?>
                                <div class="services-section-repair js-repair-item" data-details="#details-<?php echo $key ?>">
                                    <div class="services-section-repair__image js-repair-toggle" title="Кликните, чтобы прочитать более подробнуинформацию">
                                        <div class="services-section-repair__image-inner">
                                            <img src="<?php echo $price['image']['url'] ?>" alt="">
                                        </div>
                                    </div>
                                    <?php if ($price['price']): ?>
                                        <div class="services-section-repair__price">
                                            <?php echo $price['price']['prefix'] ?>
                                            <span><?php echo $price['price']['amount'] ?></span>
                                            <?php echo $price['price']['unit'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="services-section-repair__title js-repair-toggle js-repair-title" title="Кликните, чтобы прочитать более подробнуинформацию">
                                        <div class="services-section-repair__title-inner"><span><?php echo $price['name'] ?></span></div>
                                    </div>
                                    <div class="services-section-repair__more js-repair-toggle js-repair-more">
                                        <span>Узнать больше</span>
                                    </div>
                                </div>
                                <div class="repair-details" id="details-<?php echo $key ?>">
                                    <div class="repair-details__arrow js-repair-arrow"></div>
                                    <button class="repair-details__close js-repair-close"></button>
                                    <div class="repair-details__grid">
                                        <div class="repair-details__cell">
                                            <div class="repair-details-price">
                                                <div class="repair-details-price__label">
                                                    Средняя цена<br>
                                                    за работы составляет:
                                                </div>
                                                <div class="repair-details-price__value">
                                                    <?php echo $price['price']['prefix'] ?>
                                                    <span><?php echo $price['price']['amount'] ?></span>
                                                    <?php echo $price['price']['unit'] ?>
                                                </div>
                                            </div>
                                            <div class="repair-details-deadlines">
                                                <div class="repair-details-deadlines__label">
                                                    Ориентировочные сроки выполнения:
                                                </div>
                                                <div class="repair-details-deadlines__list">
                                                    <?php foreach($price['deadlines'] as $deadline): ?>
                                                    <div class="repair-details-deadline">
                                                        <div class="repair-details-deadline__time">
                                                            <?php echo $deadline['time'] ?>
                                                        </div>
                                                        <div class="repair-details-deadline__area">
                                                            <?php echo $deadline['area'] ?>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="repair-details__cell">
                                            <div class="repair-details-text">
                                                <div class="repair-details-text__label">Что входит:</div>
                                                <div class="repair-details-text__value">
                                                    <?php echo $price['text'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="services-section-content">
                <div class="container container_tiny">
                    <div class="content">
                        <?php the_content() ?>
                    </div>
                </div>
            </div>

            <?php if ($types = get_field('types')): ?>
                <div class="services-section-types">
                    <div class="container">
                        <?php if ($types_title = get_field('types_title')): ?>
                        <div class="services-section-types__title"><?php echo $types_title ?></div>
                        <?php endif; ?>
                        <div class="services-section-types__grid">
                            <?php foreach($types as $type): ?>
                            <div class="services-section-types__cell">
                                <div class="services-section-type">
                                    <?php if ($type['image']): ?>
                                    <div class="services-section-type__image">
                                        <img src="<?php echo $type['image']['url'] ?>" alt="">
                                    </div>
                                    <?php endif; ?>
                                    <div class="services-section-type__title"><?php echo $type['title'] ?></div>
                                    <div class="services-section-type__content"><?php echo $type['content'] ?></div>
                                    <div class="services-section-type__signature"><?php echo $type['signature'] ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($results = get_field('results')): ?>
                <div class="services-section-results">
                    <div class="container container_alt">
                        <?php if ($results_title = get_field('results_title')): ?>
                        <div class="services-section-results__title"><?php echo $results_title ?></div>
                        <?php endif; ?>
                        <div class="services-section-results__grid">
                            <?php foreach($results as $result): ?>
                            <div class="services-section-results__cell">
                                <div class="services-section-result">
                                    <?php if ($result['image']): ?>
                                    <div class="services-section-result__image">
                                        <span></span>
                                        <img src="<?php echo $result['image']['url'] ?>" alt="" class="js-img-to-svg">
                                    </div>
                                    <?php endif; ?>
                                    <div class="services-section-result__title">
                                        <span><?php echo $result['title'] ?></span>
                                    </div>
                                    <div class="services-section-result__content"><?php echo $result['description'] ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <section class="section-contacts js-section-offset">
                <div class="container container_alt">
                    <div class="services-calculation js-section-offset-inner">
                        <div class="services-calculation__desc">
                            Готовы двигаться дальше? Тогда пришло время посмотреть, как мы делали косметический ремонт, и рассчитать предварительную стоимость вашего ремонта →
                        </div>
                        <div class="services-calculation__grid">
                            <div class="services-calculation__cell">
                                <div class="services-calculation__image">
                                    <img src="<?php echo get_bloginfo('template_url') ?>/dist/img/our-work-send.jpg" alt="">
                                    <a href="<?php the_permalink(15) ?>" class="services-calculation__works">
                                        <span>Наши работы</span>
                                    </a>
                                </div>
                            </div>
                            <div class="services-calculation__cell">
                                <form action="/wp-json/contact-form-7/v1/contact-forms/380/feedback" method="post" class="services-calculation-form js-form">
                                    <div class="services-calculation-form__title">Рассчитать предварительную стоимость</div>
                                    <div class="services-calculation-form__desc">Заполните форму, и наш специалист свяжется с Вами в течении 15 минут</div>
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
                                                <input type="checkbox" name="rules" value="1" class="form-checkbox" />
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