<?php
/*
Template Name: Главная
*/

$services = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => 11,
    'order' => 'ASC',
    'orderby' => 'menu_order',
	'meta_query'	=> array(
		array(
			'key'	 	=> 'show_at_home',
			'value'	  	=> '1',
			'compare' 	=> '=',
		)
	)
));
$projects = new WP_Query(array(
    'post_type' => 'project',
    'posts_per_page' => 12,
	'tax_query' => [[
        'taxonomy' => 'project_category',
        'terms'    => [3]
    ]]
));
$reviews = new WP_Query(array(
    'post_type' => 'review',
    'posts_per_page' => 4
));
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <?php get_template_part('partials/preloader'); ?>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <?php if ($slideshow = get_field('slideshow')): ?>
            <div class="slideshow js-slideshow">
                <div class="slideshow-slides js_slides">
                    <?php foreach ($slideshow as $slide): ?>
                    <div class="slideshow-slide">
                        <img
                            class="slideshow-slide__image js-image-cover tns-lazy-img"
                            <?php echo srcset($slide['image'], ['w468h364', 'w800h600'], true) ?>
                            data-src="<?php echo $slide['image']['url'] ?>"
                            alt="<?php echo esc_html($slide['title']) ?>"
                        />
                        <div class="slideshow-slide__container container">
                            <div class="slideshow-slide__info">
                                <?php if ($slide['price']): ?>
                                    <div class="slideshow-slide__price"><?php echo $slide['price'] ?></div>
                                <?php endif; ?>
                                <?php if ($slide['title']): ?>
                                    <div class="slideshow-slide__title">
                                        <span><?php echo $slide['title'] ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($slide['subtitle']): ?>
                                    <div class="slideshow-slide__subtitle">
                                        <span><?php echo $slide['subtitle'] ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($slide['url']): ?>
                                    <a href="<?php echo $slide['url'] ?>" class="slideshow-slide__url">
                                        <p>Подробнее</p>
                                        <span></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="slideshow-nav">
                    <button class="slideshow-nav__previous js_prev"></button>
                    <div class="slideshow-nav__text">
                        <span class="js_index">01</span>
                        <span>/</span>
                        <span><?php echo count($slideshow) ?></span>
                    </div>
                    <button class="slideshow-nav__next js_next"></button>
                </div>
                <button data-target="#content" class="slideshow__down js-scroll"></button>
            </div>
            <?php endif; ?>

            <?php if ($intro = get_field('intro')): ?>
            <div class="intro">
                <div class="container">
                    <div class="intro__layout">
                        <div class="intro__left">
                            <h1 class="intro__title"><?php echo $intro['title'] ?></h1>
                            <div class="intro__description"><?php echo $intro['description'] ?></div>
                            <button data-micromodal-trigger="callback" class="intro__button">
                                <span>Получить</span>
                                <span></span>
                            </button>
                        </div>
                        <div class="intro__right">
                            <div class="intro-calc">
                                <div class="intro-calc__title">
                                    Узнайте стоимость ремонта сейчас:
                                </div>
                                <div class="intro-calc__layout">
                                    <div class="intro-calc__layout-left">
                                        <div class="intro-calc__row-object">
                                            <div class="intro-calc__label">Что ремонтируем?</div>
                                            <select name="object" class="js-selectys">
                                                <option value="">Квартира</option>
                                                <option value="">Коттедж</option>
                                                <option value="">Офис</option>
                                                <option value="">Ванная "под ключ"</option>
                                                <option value="">Кухня</option>
                                            </select>
                                        </div>
                                        <div class="intro-calc__row-area">
                                            <div class="intro-calc__label">Площадь <span>(м<sub>2</sub>)</span></div>
                                            <input type="range" min="0" max="250" value="1" />
                                        </div>
                                        <div class="intro-calc__row-phone">
                                            <div class="intro-calc__label-alt">Введите телефон</div>
                                            <input class="intro-calc__phone" type="text" placeholder="+7" value="">
                                        </div>
                                    </div>
                                    <div class="intro-calc__layout-right">
                                        <div class="intro-calc__row-type">
                                            <div class="intro-calc__label">Вид ремонта:</div>
                                            <label class="intro-calc__type">
                                                <input type="radio" name="type" value="Косметический" />
                                                <span></span>
                                                Косметический
                                            </label>
                                            <label class="intro-calc__type">
                                                <input type="radio" name="type" value="Капитальный" />
                                                <span></span>
                                                Капитальный
                                            </label>
                                            <label class="intro-calc__type">
                                                <input type="radio" name="type" value="Евроремонт" />
                                                <span></span>
                                                Евроремонт
                                            </label>
                                        </div>
                                        <div class="intro-calc__price">
                                            <div class="intro-calc__price-label">
                                                Итого:
                                            </div>
                                            <div class="intro-calc__price-value">
                                                <span>161 919</span> Р
                                            </div>
                                        </div>
                                        <button class="intro-calc__submit btn-arrow">
                                            Получить смету
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img
                    class="intro__image js-image-cover lazyload"
                    <?php echo srcset($intro['image'], ['w468h364', 'w800h600'], true) ?>
                    data-src="<?php echo $intro['image']['url'] ?>"
                    alt="<?php echo esc_html($intro['image']['alt']) ?>"
                />
            </div>
            <div class="intro-advantages">
                <div class="container">
                    <div class="intro-advantages__list">
                        <?php foreach ($intro['advantages'] as $advantage): ?>
                        <div class="intro-advantages__cell">
                            <div class="intro-advantage">
                                <div class="intro-advantage__image">
                                    <img data-src="<?php echo $advantage['image']['url'] ?>" class="lazyload" alt="">
                                </div>
                                <div class="intro-advantage__title">
                                    <?php echo $advantage['title'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <section class="site-desc-container" id="content">
                <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
                <div class="site-desc">
                    <div class="site-desc__title"><?php the_title(); ?></div>
                    <hr class="section-hr">
                    <?php the_content(); ?>
                </div>
                <?php endwhile; endif; ?>
            </section>

            <?php if ($services->have_posts()): ?>
            <section class="type-of-repair">
                <div class="container">
                    <?php while($services->have_posts()): $services->the_post(); ?>
                    <div class="type-of-repair-item">
                        <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                        <div class="repair-img-label">
                            <a href="<?php the_permalink() ?>">
                                <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), array(468, 364))): ?>
                                <img class="repair-img lazylazyload" data-src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                <?php else: ?>
                                <img class="repair-img lazylazyload" data-src="https://via.placeholder.com/468x364" alt="">
                                <?php endif; ?>
                            </a>
                            <?php if ($price = get_field('price', get_the_ID())): ?>
                            <div class="label">
                                <p>
                                    <?php echo $price['prefix'] ?>
                                    <span><?php echo $price['amount'] ?></span>
                                    <?php echo $price['unit'] ?>    
                                </p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php
                            $children = new WP_Query(array(
                                'post_type' => 'page',
                                'order' => 'ASC',
                                'orderby' => 'menu_order',
                                'post_parent' => get_the_ID()
                            ));
                        ?>
                        <?php if ($children->have_posts()): ?>
                        <div class="repair-list">
                            <?php while($children->have_posts()): $children->the_post(); ?>
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            <?php endwhile; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>

            <section class="all-details">
                <?php if ($image = get_field('details_image')): ?>
                <img
                    class="all-details__image js-image-cover lazylazyload"
                    <?php echo srcset($image, ['w468h364', 'w800h600'], true) ?>
                    data-src="<?php echo $image['url'] ?>"
                    alt="<?php echo $image['alt'] ?>"
                />
                <?php endif; ?>
                <div class="container">
                    <p><?php the_field('details_desc') ?></p>
                    <h3><?php the_field('details_title') ?></h3>
                    <?php if ($list = get_field('details_list')): ?>
                    <div class="details-list">
                        <?php foreach ($list as $item): ?>
                        <div class="details-item">
                            <span></span>
                            <p><?php echo $item['text'] ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

            <?php if ($projects->have_posts()): ?>
            <section class="completed-objects">
                <div class="container">
                    <h3 class="completed-objects__title">Выполненные объекты</h3>
                    
                    <hr class="section-hr">

                    <div class="objects-slider js-objects-slider">
                        <div class="objects-slider-nav">
                            <button class="js_prev objects-slider-prev"></button>
                            <button class="js_next objects-slider-next"></button>
                        </div>

                        <div class="objects-slider-slides js_slides">
                            <?php while($projects->have_posts()): $projects->the_post(); ?>
                            <div class="objects-slider-slide">
                                <a href="<?php the_permalink() ?>" class="project-item">
                                    <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), array(468, 500))): ?>
                                    <img class="project-item__image lazyload" data-src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                    <?php else: ?>
                                    <img class="project-item__image lazyload" data-src="https://via.placeholder.com/468x500" alt="">
                                    <?php endif; ?>
                                    <span class="project-item__info">
                                        <span class="project-item__title"><span><?php the_title() ?></span></span>
                                        <span class="project-item__hr"></span>
                                        <?php if (has_excerpt()): ?>
                                        <span class="project-item__desc">
                                            <?php echo sanitize_text_field(get_the_excerpt()) ?>
                                        </span>
                                        <?php endif; ?>
                                        <span class="project-item__more"><span>Подробнее</span></span>
                                    </span>
                                </a>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    
                    <div class="completed-objects__more">
                        <a href="<?php echo get_category_link(3) ?>" class="btn-arrow">Больше работ</a>
                    </div>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>

            <?php get_template_part('partials/scheme') ?>
            
            <section class="free-consultation container">
                <div class="consultation-img">
                    <img class="lazyload" data-src="<?php echo get_bloginfo('template_url') ?>/dist/img/consultation-img.jpg" alt="">
                </div>
                <div class="free-consultation-desc">
                    <h3>Заказать <br> бесплатную консультацию</h3>
                    <hr>
                    <p>Помните!</p>
                    <p>Цена хорошего ремонта намного ниже, чем цена плохого. Потому что при <br> плохом ремонте вы сначала заплатите за него, а потом за исправление его <br> последствий.</p>
                    <a class="more-btn" data-micromodal-trigger="callback"><p>Узнать больше</p><span></span></a>
                </div>
            </section>
            
            <section class="about-company">
                <?php if ($image = get_field('about_image')): ?>
                <img
                    class="about-company__image js-image-cover lazyload"
                    <?php echo srcset($image, ['w468h364', 'w800h600'], true) ?>
                    data-src="<?php echo $image['url'] ?>"
                    alt="<?php echo $image['alt'] ?>"
                />
                <?php endif; ?>
                <div class="container">
                    <h3><?php the_field('about_title') ?></h3>
                    <hr>
                    <?php the_field('about_desc') ?>
                </div>
            </section>

            <?php if ($reviews->have_posts()): ?>
            <section class="client-feedback">
                <div class="container container_alt">
                    <h3 class="client-feedback__title">Отзывы наших клиентов</h3>
                    <div class="client-feedback-grid">
                        <?php while($reviews->have_posts()): $reviews->the_post(); ?>
                        <div class="client-feedback-grid__item">
                            <div class="client-feedback-item">
                                <?php if (get_field('type', get_the_ID()) == 'video'): ?>
                                <div class="client-feedback-item__video">
                                    <iframe src="https://www.youtube.com/embed/<?php the_field('video') ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <?php else: ?>
                                <div class="client-feedback-item__image">
                                    <?php if ($image = get_field('image', get_the_ID())): ?>
                                    <img class="lazyload" data-src="<?php echo $image['sizes']['w560h308'] ?>" alt="<?php the_title() ?>">
                                    <?php else: ?>
                                    <img class="lazyload" data-src="https://via.placeholder.com/560x308" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="client-feedback-item__info">
                                    <div class="client-feedback-item__icon"><?php icon('quotes') ?></div>
                                    <div class="client-feedback-item__address"><?php the_field('address') ?></div>
                                    <?php if (has_excerpt()): ?>
                                    <div class="client-feedback-item__desc"><?php the_excerpt() ?></div>
                                    <button data-micromodal-trigger="review-<?php echo get_the_ID() ?>" class="client-feedback-item__more">читать отзыв полностью</button>
                                    <div class="modal modal_review" id="review-<?php echo get_the_ID() ?>" aria-hidden="true">
                                        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                                            <div class="modal__container" role="dialog" aria-modal="true">
                                                <button class="modal__close" aria-label="Закрыть модальное окно" data-micromodal-close></button>
                                                <div class="reviews-item__title"><?php the_title() ?></div>
                                                <div class="reviews-item__address"><?php the_field('address') ?></div>
                                                <div class="reviews-item__info">
                                                    <div class="reviews-item__icon"><?php icon('quotes') ?></div>
                                                    <div class="reviews-item__desc">
                                                        <?php the_content() ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="client-feedback-item__desc"><?php the_content() ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="client-feedback__more">
                        <a href="<?php the_permalink(17) ?>" class="btn-plus">Ещё отзывы</a>
                    </div>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>

            <?php if ($complementary = get_field('complementary', 11)): ?>
            <section class="additional-services">
                <div class="container container_alt">
                    <h3 class="additional-services__title">Дополнительные услуги</h3>
                    <div class="additional-services__list">
                        <?php foreach($complementary as $item): ?>
                        <a href="<?php echo $item['link'] ?>" class="additional-services-item">
                            <span class="additional-services-item__image">
                                <span>
                                    <?php if ($image = $item['image']): ?>
                                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $item['title'] ?>" class="js-img-to-svg">
                                    <?php else: ?>
                                    <img src="https://via.placeholder.com/100x100" alt="">
                                    <?php endif; ?>
                                </span>
                            </span>
                            <span class="additional-services-item__name"><?php echo $item['title'] ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

            <?php get_template_part('partials/contacts'); ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>
