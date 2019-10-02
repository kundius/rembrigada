<div class="project-details">
    <?php if ($address = get_field('address')): ?>
    <div class="project-details__address">
        <?php echo $address ?>
    </div>
    <?php endif; ?>
    <div class="project-details__info">
        <?php if ($area = get_field('area')): ?>
        <div class="project-details__area">
            <div class="project-details__area-label">Площадь</div>
            <div class="project-details__area-value">
                <?php echo $area ?> <span>м<sup>2</sup></span>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($customer = get_field('customer')): ?>
        <div class="project-details__customer">
            <div class="project-details__customer-label">
                <?php icon('user', .75) ?> Клиент
            </div>
            <div class="project-details__customer-value">
                <?php echo $customer ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="project-details__estimate">
        <?php if ($price_works = get_field('price_works')): ?>
        <div class="project-details__estimate-item">
            <div class="project-details__estimate-label">Цена за работы:</div>
            <div class="project-details__estimate-value"><?php echo $price_works ?></div>
        </div>
        <?php endif; ?>
        <?php if ($price_material = get_field('price_material')): ?>
        <div class="project-details__estimate-item">
            <div class="project-details__estimate-label">Цена материала:</div>
            <div class="project-details__estimate-value"><?php echo $price_material ?></div>
        </div>
        <?php endif; ?>
        <?php if ($time_works = get_field('time_works')): ?>
        <div class="project-details__estimate-item">
            <div class="project-details__estimate-label">Сроки работы:</div>
            <div class="project-details__estimate-value"><?php echo $time_works ?></div>
        </div>
        <?php endif; ?>
    </div>
    <?php if ($review = get_field('review')): ?>
    <div class="project-details__more">
        <button class="btn-more" data-basiclightbox="#review-<?php echo $review->ID ?>">Смотреть отзыв</button>
    </div>
    <?php endif; ?>
</div>
