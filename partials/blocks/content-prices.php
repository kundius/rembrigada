<?php if ($prices = get_field('content-prices')): ?>
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
<?php endif; ?>