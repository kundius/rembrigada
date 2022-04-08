<?php
$posts_per_page = -1;
$paged = get_query_var('paged') ?: 1;
$projects = new WP_Query(array(
  'post_type' => 'project',
  'posts_per_page' => $posts_per_page,
  'paged' => $paged,
  'orderby' => ['parent' => 'DESC', 'menu_order' => 'ASC']
));
?>
<?php while($projects->have_posts()): $projects->the_post(); ?>
<div class="works-item">
    <div class="works-item__title">
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
    </div>
    <div class="works-item__grid">
        <div class="works-item__cell">
            <?php if ($gallery = get_field('gallery')): ?>
            <div class="works-item-images<?php if (count($gallery) == 1): ?> works-item-images_single<?php endif; ?>">
                <?php foreach (array_splice($gallery, 0, 8) as $key => $item): ?>
                <div class="works-item-image">
                    <a href="<?php echo $item['sizes']['large'] ?>" data-fslightbox="project-<?php echo get_the_ID() ?>" class="works-item-image__wrapper">
                        <span class="works-item-image__inner" style="background-image: url('<?php echo $item['sizes'][$key == 0 ? 'w800h600' : 'w150h100'] ?>')"></span>
                        <span class="works-item-image__loupe"><?php icon('loupe') ?></span>
                    </a>
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
                <!-- <div class="works-item-info__title">
                    Особенности проекта:
                </div> -->
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
            </div>
            <?php if ($time_works = get_field('time_works')): ?>
            <div class="works-item-deadline">
                <div class="works-item-deadline__label">
                    Сроки:
                </div>
                <div class="works-item-deadline__value">
                    <?php echo $time_works ?>
                </div>
                <!-- <a href="<?php the_permalink() ?>" class="works-item-deadline__link">посмотреть весь проект</a> -->
                <?php if ($review = get_field('review')): ?>
                    <!-- <button class="works-item-deadline__link" data-basiclightbox="#review-<?php echo $review->ID ?>">посмотреть отзыв</button> -->
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="works-item-pricing">
                <?php if (get_field('price_works') || get_field('price_material')): ?>
                    <div class="works-item-pricing__title">Стоимость:</div>
                <?php endif; ?>
                <div class="works-item-pricing__text">
                    <?php if ($price_works = get_field('price_works')): ?>
                    <div>Ремонтные работы: <strong><?php echo $price_works ?> руб.</strong></div>
                    <?php endif; ?>
                    <?php if ($price_material = get_field('price_material')): ?>
                    <div>Черновые материалы с доставкой: <strong><?php echo $price_material ?> руб.</strong></div>
                    <?php endif; ?>
                </div>
                <button
                    data-order
                    data-order-title="Рассчитайте подобный"
                    data-order-submit="Рассчитать подобный"
                    data-order-subject="Портфолио / <?php the_title() ?>"
                    class="landing-button works-item-pricing__button"
                ><span>Рассчитать стоимость своего ремонта</span></button>
            </div>
        </div>
    </div>
</div>
<?php endwhile; ?>

<?php if ($projects->max_num_pages > $posts_per_page): ?>
<div class="pagination">
  <?php
  echo paginate_links([
    'current' => $paged,
    'total' => $projects->max_num_pages,
  ]);
  ?>
</div>
<?php endif; ?>
