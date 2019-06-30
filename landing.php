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
$complementary = new WP_Query(array(
    'post_type' => 'page',
    'post_parent' => 38,
    'order' => 'ASC',
    'orderby' => 'menu_order'
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
<html>
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <div id="anchor"></div>
            
            <a href="#anchor" class="scroll-up"></a>

            <?php if ($slideshow = get_field('slideshow')): ?>
            <div class="slideshow js-slideshow">
                <div class="slideshow-frame js_frame">
                    <ul class="slideshow-slides js_slides">
                        <?php foreach ($slideshow as $slide): ?>
                        <li class="slideshow-slide js_slide" style="background-image:url('<?php echo $slide['image']['url'] ?>')">
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
                        </li>
                        <?php endforeach; ?>
                    </ul>
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
                <ul class="slideshow-dots js_dots"></ul>
                <a href="#content" class="slideshow__down"></a>
            </div>
            <?php endif; ?>

            <section class="site-desc-container" id="content">
                <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
                <div class="site-desc">
                    <h1><?php the_title(); ?></h1>
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
                                <img class="repair-img" src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                <?php else: ?>
                                <img class="repair-img" src="https://via.placeholder.com/468x364" alt="">
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
                <div class="container">
                    <p>Нам доверяют потому что</p>
                    <h3>При ремонте мы учитываем <br> все детали</h3>
                    <div class="details-list">
                        <div class="details-item">
                            <span></span>
                            <p>Даем до 3-х лет гарантии. <br> Распространяется на все <br> работы и фиксирована в <br> договоре.</p>
                        </div>
                        <div class="details-item">
                            <span></span>
                            <p>Стоимость и строки не сдвигаются. <br> Они фиксированы в договоре - мы <br> платим штрафы, если просрочим.</p>
                        </div>
                        <div class="details-item">
                            <span></span>
                            <p>Контроль качества. <br> Каждый объект ведет прораб. <br> Фотоотчёт в любое время. <br> Сдача проводится независимым <br> специалистом.</p>
                        </div>
                        <div class="details-item">
                            <span></span>
                            <p>Наши мастера официально <br> оформлены в штат, имеют <br> минимальный опыт в отделке - <br> от 5 лет. Граждане России.</p>
                        </div>
                        <div class="details-item">
                            <span></span>
                            <p>Внимание к деталям при ремонте <br> Любые консультации во время <br> работы. Не конфликтуем с <br> соседями. Соблюдаем график. <br> Вывозим мусор после ремонта.</p>
                        </div>
                        <div class="details-item">
                            <span></span>
                            <p>Работаем с вашим и нашим <br> материалом. Снижение сметы <br> за счёт скидок от производителя. <br> Собственные склады в Казани. <br> Доставляем материал сами.</p>
                        </div>
                    </div>
                </div>
            </section>

            <?php if ($projects->have_posts()): ?>
            <section class="completed-objects">
                <div class="container">
                    <div class="completed-objects__title">Выполненные объекты</div>
                    
                    <hr class="section-hr">

                    <div class="objects-slider js-objects-slider">
                        <div class="objects-slider-nav">
                            <button class="js_prev objects-slider-prev"></button>
                            <button class="js_next objects-slider-next"></button>
                        </div>

                        <div class="objects-slider-frame js_frame">
                            <ul class="objects-slider-slides js_slides">
                                <?php while($projects->have_posts()): $projects->the_post(); ?>
                                <li class="objects-slider-slide js_slide">
                                    <a href="<?php the_permalink() ?>" class="project-item">
                                        <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), array(468, 500))): ?>
                                        <img class="project-item__image" src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                        <?php else: ?>
                                        <img class="project-item__image" src="https://via.placeholder.com/468x500" alt="">
                                        <?php endif; ?>
                                        <span class="project-item__info">
                                            <span class="project-item__title"><span><?php the_title() ?></span></span>
                                            <span class="project-item__hr"></span>
                                            <?php if (has_excerpt()): ?>
                                            <span class="project-item__desc"><?php the_excerpt() ?></span>
                                            <?php endif; ?>
                                            <span class="project-item__more"><span>Подробнее</span></span>
                                        </span>
                                    </a>
                                </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="completed-objects__more">
                        <a href="#" class="btn-arrow">Больше работ</a>
                    </div>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>

            <?php get_template_part('partials/scheme') ?>
            
            <section class="free-consultation container">
                <div class="consultation-img">
                    <img src="<?php echo get_bloginfo('template_url') ?>/dist/img/consultation-img.jpg" alt=""  >
                </div>
                <div class="free-consultation-desc">
                    <h3>Заказать <br> бесплатную консультацию</h3>
                    <hr>
                    <p>Помните!</p>
                    <p>Цена хорошего ремонта намного ниже, чем цена плохого. Потому что при <br> плохом ремонте вы сначала заплатите за него, а потом за исправление его <br> последствий.</p>
                    <a href="#" class="more-btn"><p>Узнать больше</p><span></span></a>
                </div>
            </section>
            
            <section class="about-company">
                <div class="container">
                    <h3>О компании Рембригада 116</h3>
                    <hr>
                    <p>Важно. Очень важно доверять друг другу, даже если речь всего лишь о ремонте помещений. Ну а если это ремонт помещений в Казани, то доверять нужно стократ больше.</p>
                    <p>Слишком много разных фирм по ремонту, слишком много обещаний сделать все качественно, не находите?</p>
                    <p>Поэтому мы сейчас расскажем, что для нас значит действительно качественный ремонт помещений, а вы сделаете выводы.</p>
                </div>
            </section>

            <?php if ($reviews->have_posts()): ?>
            <section class="client-feedback">
                <div class="container container_alt">
                    <div class="client-feedback__title">Отзывы наших клиентов</div>
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
                                    <img src="<?php echo $image['sizes']['w560h308'] ?>" alt="<?php the_title() ?>">
                                    <?php else: ?>
                                    <img src="https://via.placeholder.com/560x308" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="client-feedback-item__info">
                                    <div class="client-feedback-item__icon"><?php icon('quotes') ?></div>
                                    <div class="client-feedback-item__address"><?php the_field('address') ?></div>
                                    <?php if (has_excerpt()): ?>
                                    <div class="client-feedback-item__desc"><?php the_excerpt() ?></div>
                                    <button class="client-feedback-item__more">читать отзыв полностью</button>
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

            <?php if ($complementary->have_posts()): ?>
            <section class="additional-services">
                <div class="container container_alt">
                    <div class="additional-services__title">Дополнительные услуги</div>
                    <div class="additional-services__list">
                        <?php while($complementary->have_posts()): $complementary->the_post(); ?>
                        <a href="<?php the_permalink() ?>" class="additional-services-item">
                            <span class="additional-services-item__image">
                                <span>
                                    <?php if ($image = get_the_post_thumbnail_url(get_the_ID())): ?>
                                    <img src="<?php echo $image ?>" alt="<?php the_title() ?>" class="js-img-to-svg">
                                    <?php else: ?>
                                    <img src="https://via.placeholder.com/100x100" alt="">
                                    <?php endif; ?>
                                </span>
                            </span>
                            <span class="additional-services-item__name"><?php the_title() ?></span>
                        </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php endif; wp_reset_query(); ?>

            <?php get_template_part('partials/contacts'); ?>
            
            <!-- Поп-ап "Заказать обратный звонок" -->
            <div class="pop-up-callback">
                <div class="pop-up-callback-img">
                    <img src="./index_files/pop-up-callback-img.jpg" alt=""  >
                </div>
                <div class="pop-up-callback-order">
                    <h3>Заказать <br> Обратный звонок</h3>
                    <p>Заполните форму, и наш специалист свяжется <br> с Вами в течении 15 минут</p>
                    <div class="pop-up-callback-input">
                        <input type="text" name="name" id="name" placeholder="Имя">
                        <input type="email" name="email" id="email" placeholder="E-mail">
                        <input type="tel" name="tel" id="tel" placeholder="Телефон*" required="">
                    </div>
                    <input type="checkbox" name="pop-up-agreements" id="pop-up-agreements">
                    <label for="pop-up-agreements" class="pop-up-agreements-label"><span><div class="checked"></div></span>Прочитал(-а) <a href="#">Пользовательское соглашение</a> и соглашаюсь с <a href="#">Политикой обработки персональных данных</a></label>
                    <a href="#" class="more-btn"><p>Отправить</p><span></span></a>
                </div>
                <div class="close-pop-up"></div>
            </div>
            <!-- Поп-ап "Заявка отправлена -->
            <div class="pop-up-callback-send">
                <div class="pop-up-callback-send-our-work">
                    <img src="./index_files/our-work-send.jpg" alt=""  >
                    <a href="#"><p>Наши работы</p></a>
                </div>
                <div class="pop-up-callback-send-ok">
                    <h3>Ваша заявка успешно отправлена</h3>
                    <p>Наш специалист свяжется с Вами в течении 15 минут, а пока вы можете ознакомиться с видами ремонта, которые мы делаем и как мы его делаем.</p>
                    <div class="pop-up-callback-category-list">
                        <a href="#" class="pop-up-callback-category-item">
                            <img src="./index_files/apartments.png" alt=""  >
                            <h4>Ремонт квартир</h4>
                        </a>
                        <a href="#" class="pop-up-callback-category-item">
                            <img src="./index_files/house.png" alt=""  >
                            <h4>Ремонт домов</h4>
                        </a>
                        <a href="#" class="pop-up-callback-category-item">
                            <img src="./index_files/commerce-apartments.png" alt=""  >
                            <h4><span>Ремонт коммерческой недвижимости</span><span>Ремонт коммерч. недвиж-ти</span></h4>
                        </a>
                    </div>
                </div>
                <div class="close-pop-up"></div>
            </div>

            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>