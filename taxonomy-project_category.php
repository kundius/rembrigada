<?php
$term = get_term_by('slug', get_query_var('project_category'), 'project_category');
$categories = get_categories([
    'taxonomy' => 'project_category',
    'hide_empty' => false,
    'parent' => 3
]);
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>
            
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>

            <?php if (count($categories) > 0): ?>
            <section class="works-cats-section">
                <h1 class="works-cats-section__title"><span><?php single_cat_title() ?></span></h1>
                <div class="works-cats-section__items">
                    <?php foreach ($categories as $category): ?>
                    <a href="<?php echo get_category_link($category->term_id) ?>" class="works-cats-section__item">
                        <?php echo $category->name ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>

            <?php if (have_posts()): ?>
            <section class="works-section">
                <div class="container container_alt">
                    <?php while(have_posts()): the_post(); ?>
                    <div class="works-item">
                        <div class="works-item__title"><?php the_title() ?></div>
                        <div class="works-item__grid">
                            <div class="works-item__cell">
                                <?php if ($gallery = get_field('gallery')): ?>
                                <div class="works-item-images">
                                    <?php foreach ($gallery as $item): ?>
                                    <div class="works-item-image<?php if (count($gallery) == 1): ?> works-item-image_single<?php endif; ?>">
                                        <div class="works-item-image__file" style="background-image: url('<?php echo $item['sizes']['w800h480'] ?>')"></div>
                                        <span class="works-item-image__loupe"><?php icon('loupe') ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="works-item__cell">
                                <?php if ($address = get_field('address')): ?>
                                <div class="works-item-object">
                                    <div class="works-item-object__label">
                                        Объект:
                                    </div>
                                    <div class="works-item-object__value">
                                        <?php echo $address ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="works-item-info">
                                    <div class="works-item-info__title">
                                        Особенности проекта:
                                    </div>
                                    <?php if ($area = get_field('area')): ?>
                                    <div class="works-item-info__row">
                                        <div class="works-item-info__label">
                                            Площадь:
                                        </div>
                                        <div class="works-item-info__area">
                                            <?php echo $area ?> <span>м<sup>2</sup></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($customer = get_field('customer')): ?>
                                    <div class="works-item-info__row">
                                        <div class="works-item-info__label">
                                            Клиент:
                                        </div>
                                        <div class="works-item-info__value">
                                            <?php echo $customer ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($time_works = get_field('time_works')): ?>
                                <div class="works-item-deadline">
                                    <div class="works-item-deadline__label">
                                        Сроки:
                                    </div>
                                    <div class="works-item-deadline__value">
                                        <?php echo $time_works ?>
                                    </div>
                                    <?php if ($review = get_field('review')): ?>
                                        <a href="#" class="works-item-deadline__link" data-basiclightbox="#review-<?php echo $review->ID ?>">посмотреть отзыв</a>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <div class="works-item-pricing">
                                    <div class="works-item-pricing__title">Стоимость:</div>
                                    <div class="works-item-pricing__text">
                                        <?php if ($price_works = get_field('price_works')): ?>
                                        <div>Ремонтные работы: <strong>200 000 руб.</strong></div>
                                        <?php endif; ?>
                                        <?php if ($price_material = get_field('price_material')): ?>
                                        <div>Черновые материалы с доставкой: <strong>200 000 руб.</strong></div>
                                        <?php endif; ?>
                                    </div>
                                    <button class="works-item-pricing__button">Рассчитать стоимость своего ремонта</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php the_posts_pagination([
                        'prev_text' => 'Предыдущая',
                        'next_text' => 'Следующая'
                    ]) ?>
                </div>
            </section>
            <?php endif; ?>

            <?php get_template_part('partials/contacts', 'services') ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>