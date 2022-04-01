<?php if ($list = get_field('content-portfolio')): ?>
<div class="wp-block-content-portfolio">
    <div class="works">
        <?php foreach($list as $item): $fields = get_fields($item->ID); ?>
        <div class="works-item">
            <div class="works-item__title"><?php echo $item->post_title ?></div>
            <div class="works-item__grid">
            <div class="works-item__cell">
                <?php if ($gallery = $fields['gallery']): ?>
                <div class="works-item-images<?php if (count($gallery) == 1): ?> works-item-images_single<?php endif; ?>">
                <?php foreach (array_splice($gallery, 0, 8) as $key => $item): ?>
                <div class="works-item-image">
                    <a href="<?php echo $item['sizes']['large'] ?>" data-fslightbox="project-<?php echo $item->ID ?>" class="works-item-image__wrapper">
                        <span class="works-item-image__inner" style="background-image: url('<?php echo $item['sizes'][$key == 0 ? 'w800h600' : 'w150h100'] ?>')"></span>
                        <span class="works-item-image__loupe"><?php icon('loupe') ?></span>
                    </a>
                </div>
                <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="works-item__cell">
                <?php if ($fields['address']): ?>
                <div class="works-item-object">
                <div class="works-item-object__label">
                    Объект:
                </div>
                <div class="works-item-object__value">
                    <?php echo $fields['address'] ?>
                </div>
                </div>
                <?php endif; ?>
                <div class="works-item-info">
                <!-- <div class="works-item-info__title">
                    Особенности проекта:
                </div> -->
                <?php if ($fields['area']): ?>
                <div class="works-item-info__row">
                    <div class="works-item-info__label">
                    Площадь:
                    </div>
                    <div class="works-item-info__area">
                    <?php echo $fields['area'] ?> <span>м<sup>2</sup></span>
                    </div>
                </div>
                <?php endif; ?>
                </div>
                <?php if ($fields['time_works']): ?>
                <div class="works-item-deadline">
                <div class="works-item-deadline__label">
                    Сроки:
                </div>
                <div class="works-item-deadline__value">
                    <?php echo $fields['time_works'] ?>
                </div>
                </div>
                <?php endif; ?>
                <div class="works-item-pricing">
                <?php if ($fields['price_works'] || $fields['price_material']): ?>
                    <div class="works-item-pricing__title">Стоимость:</div>
                <?php endif; ?>
                <div class="works-item-pricing__text">
                    <?php if ($fields['price_works']): ?>
                    <div>Ремонтные работы: <strong><?php echo $fields['price_works'] ?> руб.</strong></div>
                    <?php endif; ?>
                    <?php if ($fields['price_material']): ?>
                    <div>Черновые материалы с доставкой: <strong><?php echo $fields['price_material'] ?> руб.</strong></div>
                    <?php endif; ?>
                </div>
                <button
                    data-order
                    data-order-title="Рассчитайте подобный"
                    data-order-submit="Рассчитать подобный"
                    data-order-subject="Портфолио / <?php echo $item->post_title ?>"
                    class="works-item-pricing__button"
                ><span>Рассчитать стоимость своего ремонта</span></button>
                </div>
            </div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="works__more">
            <a href="<?php echo get_category_link(3) ?>" class="landing-button">Больше работ</a>
        </div>
    </div>
</div>
<?php endif; ?>
