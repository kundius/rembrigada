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
            
            <a href="https://x-landing.ru/remont/index.html#anchor" class="scroll-up"></a>

            <main>
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
                                <a href="<?php the_permalink() ?>" class="news-item__image">
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

                            <div class="objects-slider-nav">
                                <button class="js_prev objects-slider-prev"></button>
                                <button class="js_next objects-slider-next"></button>
                            </div>
                        </div>
                        
                        <div class="completed-objects__more">
                            <a href="https://x-landing.ru/remont/index.html#" class="btn-arrow">Больше работ</a>
                        </div>
                    </div>
                </section>
                <?php endif; wp_reset_query(); ?>

                <!-- Экран "Схема работы" -->
                <section class="scheme-of-work">
                    <div class="container">
                        <p class="section-title">Схема работы</p>
                        <hr class="section-hr">
                        <div class="scheme-of-work-list">
                            <div class="scheme-of-work-item">
                                <img src="./index_files/smartphone.png" alt="" data-pagespeed-url-hash="1075662114" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                <p>1. Звонок или заявка</p>
                            </div>
                            <div class="scheme-of-work-item">
                                <img src="./index_files/measuring-tape.png" alt="" data-pagespeed-url-hash="3087095749" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                <p>2. Выезд замерщика</p>
                            </div>
                            <div class="scheme-of-work-item">
                                <img src="./index_files/calculator.png" alt="" data-pagespeed-url-hash="1422314343" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                <p>3. Расчет сметы</p>
                            </div>
                            <div class="scheme-of-work-item">
                                <img src="./index_files/contract.png" alt="" data-pagespeed-url-hash="65157367" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                <p>4. Подписание договора</p>
                            </div>
                            <div class="scheme-of-work-item">
                                <img src="./index_files/paint-roller.png" alt="" data-pagespeed-url-hash="645180590" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                <p>5. Ремонтные работы</p>
                            </div>
                            <div class="scheme-of-work-item">
                                <img src="./index_files/agreement.png" alt="" data-pagespeed-url-hash="1376562455" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                <p>6. Готовый результат</p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Экран "Заказ бесплатной консультации" -->
                <section class="free-consultation container">
                    <div class="consultation-img">
                        <img src="./index_files/consultation-img.jpg" alt="" data-pagespeed-url-hash="322018112" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    </div>
                    <div class="free-consultation-desc">
                        <h3>Заказать <br> бесплатную консультацию</h3>
                        <hr>
                        <p>Помните!</p>
                        <p>Цена хорошего ремонта намного ниже, чем цена плохого. Потому что при <br> плохом ремонте вы сначала заплатите за него, а потом за исправление его <br> последствий.</p>
                        <a href="https://x-landing.ru/remont/index.html#" class="more-btn"><p>Узнать больше</p><span></span></a>
                    </div>
                </section>
                <!-- Экран "О компании" -->
                <section class="about-company">
                    <div class="container">
                        <h3>О компании Рембригада 116</h3>
                        <hr>
                        <p>Важно. Очень важно доверять друг другу, даже если речь всего лишь о ремонте помещений. Ну а если это ремонт помещений в Казани, то доверять нужно стократ больше.</p>
                        <p>Слишком много разных фирм по ремонту, слишком много обещаний сделать все качественно, не находите?</p>
                        <p>Поэтому мы сейчас расскажем, что для нас значит действительно качественный ремонт помещений, а вы сделаете выводы.</p>
                    </div>
                </section>
                <!-- Экран "Отзывы клиентов" -->
                <section class="client-feedback container">
                    <p class="section-title">Отзывы наших клиентов</p>
                    <hr class="section-hr">
                    <div class="video-feedback-list">
                        <div class="video-feedback-item">
                            <iframe src="./index_files/2t5DEXttVD0.html" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>
                        <div class="video-feedback-item">
                            <iframe src="./index_files/2t5DEXttVD0(1).html" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>
                    </div>
                    <div class="text-feedback-list">
                        <div class="text-feedback-item">
                            <img src="./index_files/feedback1.jpg" alt="" data-pagespeed-url-hash="1930201353" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                            <div class="text-feedback">
                                <h4>г. Казань, улица Лаврентьева, дом 4</h4>
                                <p>Спасибо большое Рембригаде116 за капитальный ремонт квартиры.  Хочу отметить высокий профессионализм работников, ответственность, добросовестное отношение к выполнению обязательств.  Качественно были выполнены все виды работ, включая демонтаж, отделка и вывоз мусора...</p>
                                <a href="https://x-landing.ru/remont/index.html#">читать отзыв полностью</a>
                            </div>
                        </div>
                        <div class="text-feedback-item">
                            <img src="./index_files/feedback2.jpg" alt="" data-pagespeed-url-hash="2224701274" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                            <div class="text-feedback">
                                <h4>г. Казань, улица Фучика, дом 121</h4>
                                <p>Выражаю огромную благодарность  Рембригаде116 и руководителю Виктору за качественный ремонт.  Была поставлена задача и сроки, сделать ремонт в комнате, выровнять пол, стены, потолок, с  чем ребята справились на отлично.  Подошли к своей работе ответственно, аккуратно, чисто, быстро, профессионально.  Я осталась... очень довольна выполненной качественной работой.  Виктор всегда был на связи,...</p>
                                <a href="https://x-landing.ru/remont/index.html#">читать отзыв полностью</a>
                            </div>
                        </div>
                    </div>
                    <a href="https://x-landing.ru/remont/index.html#" class="more-btn"><p>Ещё отзывы</p><span></span></a>
                </section>
                <!-- Экран "Дополнительные услуги" -->
                <section class="complementary-services">
                    <div class="container">
                        <p class="section-title">Дополнительные услуги</p>
                        <hr class="section-hr">
                        <div class="complementary-services-list">
                            <a href="https://x-landing.ru/remont/index.html#" class="complementary-services-item">
                                <div class="services-img">
                                    <img src="./index_files/celling.png" alt="" data-pagespeed-url-hash="23054613" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                </div>
                                <p>Натяжные потолки</p>
                            </a>
                            <a href="https://x-landing.ru/remont/index.html#" class="complementary-services-item">
                                <div class="services-img">
                                    <img src="./index_files/window.png" alt="" data-pagespeed-url-hash="787429909" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                </div>
                                <p>Пластиковые окна</p>
                            </a>
                            <a href="https://x-landing.ru/remont/index.html#" class="complementary-services-item">
                                <div class="services-img">
                                    <img src="./index_files/door.png" alt="" data-pagespeed-url-hash="2083560583" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                </div>
                                <p>Входные двери</p>
                            </a>
                            <a href="https://x-landing.ru/remont/index.html#" class="complementary-services-item">
                                <div class="services-img">
                                    <img src="./index_files/door1.png" alt="" data-pagespeed-url-hash="3098657824" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                </div>
                                <p>Межкомнатные двери</p>
                            </a>
                            <a href="https://x-landing.ru/remont/index.html#" class="complementary-services-item">
                                <div class="services-img">
                                    <img src="./index_files/polusuhaja-stjazhka.png" alt="" data-pagespeed-url-hash="960811980" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                </div>
                                <p>Полусухая стяжка</p>
                            </a>
                            <a href="https://x-landing.ru/remont/index.html#" class="complementary-services-item">
                                <div class="services-img">
                                    <img src="./index_files/trowel.png" alt="" data-pagespeed-url-hash="3781972418" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                </div>
                                <p>Механизированная штукатурка</p>
                            </a>
                            <a href="https://x-landing.ru/remont/index.html#" class="complementary-services-item">
                                <div class="services-img">
                                    <img src="./index_files/drawer.png" alt="" data-pagespeed-url-hash="2244215006" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                </div>
                                <p>Мебель под заказ</p>
                            </a>
                            <a href="https://x-landing.ru/remont/index.html#" class="complementary-services-item">
                                <div class="services-img">
                                    <img src="./index_files/air-conditioner.png" alt="" data-pagespeed-url-hash="1783902794" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                                </div>
                                <p>Кондиционеры</p>
                            </a>
                        </div>
                    </div>
                </section>
                <!-- Экран "Карта, Контакты и Форма подвала" -->
                <section class="contacts-footer-form">
                    <div class="container">
                        <div class="contacts">
                            <h3>Контакты</h3>
                            <p>Казань, ул. Четаева, 27</p>
                            <div class="contacts-footer-form-phone">
                                <a href="tel:+78432601100">Тел:  +7 (843) 260-11-00</a>
                                <a href="tel:+79872301734">Тел:  +7 (987) 230‑17-34</a>
                            </div>
                            <a href="mailto:rembrigada116@yandex.ru">Rembrigada116@yandex.ru</a>
                            <hr>
                            <p>Пн-пт 9:00 – 21:00;<span>сб 9:00 – 19:00</span></p>
                        </div>
                        <form action="https://x-landing.ru/remont/index.html#" class="footer-form">
                            <div class="footer-form-input">
                                <input type="text" name="name" id="name" placeholder="Имя" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
                                <input type="email" name="email" id="email" placeholder="E-mail*" required="">
                                <input type="tel" name="tel" id="tel" placeholder="Телефон">
                            </div>
                            <textarea name="footer-form-msg" id="footer-form-msg" cols="30" rows="10" placeholder="Текст сообщения"></textarea>
                            <a href="https://x-landing.ru/remont/index.html#" class="more-btn"><p>Отправить</p><span></span></a>
                            <input type="checkbox" name="agreements" id="agreements">
                            <label for="agreements" class="agreements-label"><span><div class="checked"></div></span>Прочитал(-а) <a href="https://x-landing.ru/remont/index.html#">Пользовательское соглашение</a> и соглашаюсь с <a href="https://x-landing.ru/remont/index.html#">Политикой обработки персональных данных</a></label>
                        </form>
                    </div>
                </section>
            </main>
            <!-- Подвал сайта -->
            <footer class="footer">
                <div class="container">
                    <p>© 2019, Rembrigada116.ru - Ремонт квартир <br> и коттеджей в Казани. Все права защищены.</p>
                    <div class="social-network">
                        <a href="https://x-landing.ru/remont/index.html#" class="vk"></a>
                        <a href="https://x-landing.ru/remont/index.html#" class="inst"></a>
                        <a href="https://x-landing.ru/remont/index.html#" class="ok"></a>
                        <a href="https://x-landing.ru/remont/index.html#" class="youtube"></a>
                    </div>
                    <div class="inn">
                        <p>ИНН 163300422218</p>
                        <p>ОГРНИП 313169008600154</p>
                    </div>
                    <div class="yandex-statistics"></div>
                    <div class="add-banner"></div>
                    <hr>
                    <div class="site-map-user-agreement-privacy-policy">
                        <a href="https://x-landing.ru/remont/index.html#">Карта сайта</a>
                        <hr class="site-map-hr">
                        <a href="https://x-landing.ru/remont/index.html#">Пользовательское соглашение</a>
                        <a href="https://x-landing.ru/remont/index.html#">Политика конфиденциальности и обработки персональных данных</a>
                        <div class="mobile-banner"></div>
                    </div>
                    <hr class="social-hr">
                </div>
            </footer>
            <!-- Поп-ап "Заказать обратный звонок" -->
            <div class="pop-up-callback">
                <div class="pop-up-callback-img">
                    <img src="./index_files/pop-up-callback-img.jpg" alt="" data-pagespeed-url-hash="3142889274" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
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
                    <label for="pop-up-agreements" class="pop-up-agreements-label"><span><div class="checked"></div></span>Прочитал(-а) <a href="https://x-landing.ru/remont/index.html#">Пользовательское соглашение</a> и соглашаюсь с <a href="https://x-landing.ru/remont/index.html#">Политикой обработки персональных данных</a></label>
                    <a href="https://x-landing.ru/remont/index.html#" class="more-btn"><p>Отправить</p><span></span></a>
                </div>
                <div class="close-pop-up"></div>
            </div>
            <!-- Поп-ап "Заявка отправлена -->
            <div class="pop-up-callback-send">
                <div class="pop-up-callback-send-our-work">
                    <img src="./index_files/our-work-send.jpg" alt="" data-pagespeed-url-hash="3225574192" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    <a href="https://x-landing.ru/remont/index.html#"><p>Наши работы</p></a>
                </div>
                <div class="pop-up-callback-send-ok">
                    <h3>Ваша заявка успешно отправлена</h3>
                    <p>Наш специалист свяжется с Вами в течении 15 минут, а пока вы можете ознакомиться с видами ремонта, которые мы делаем и как мы его делаем.</p>
                    <div class="pop-up-callback-category-list">
                        <a href="https://x-landing.ru/remont/index.html#" class="pop-up-callback-category-item">
                            <img src="./index_files/apartments.png" alt="" data-pagespeed-url-hash="195874146" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                            <h4>Ремонт квартир</h4>
                        </a>
                        <a href="https://x-landing.ru/remont/index.html#" class="pop-up-callback-category-item">
                            <img src="./index_files/house.png" alt="" data-pagespeed-url-hash="3849573793" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                            <h4>Ремонт домов</h4>
                        </a>
                        <a href="https://x-landing.ru/remont/index.html#" class="pop-up-callback-category-item">
                            <img src="./index_files/commerce-apartments.png" alt="" data-pagespeed-url-hash="1255214204" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                            <h4><span>Ремонт коммерческой недвижимости</span><span>Ремонт коммерч. недвиж-ти</span></h4>
                        </a>
                    </div>
                </div>
                <div class="close-pop-up"></div>
            </div>
            <script src="./index_files/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <script src="./index_files/swiper.min.js"></script>
            <script>$(".turnkey-repair").click(function(){$(this).toggleClass("turnkey-repair-active");if($('.dropdown-menu-second-level').is(':visible')){$('.dropdown-menu-second-level').slideUp("slow");}else{$('.dropdown-menu-second-level').slideDown("slow");}});</script>
            <script>$(".menu-toggle").click(function(){$(this).toggleClass("menu-toggle-active");$('header>.container>img').toggleClass("logo-active");$('header>.container>nav').toggleClass("header-nav-active");$('header>.container>.callback').toggleClass("callback-none");});</script>
            <script>$(".amenities.dropdown-list").click(function(){$(this).toggleClass("dropdown-list-active");$('.amenities-list>.dropdown-menu-first-level').toggleClass("dropdown-menu-first-level-active");});</script>
            <script>$(".callback>button").click(function(){$('.pop-up-callback').toggleClass("pop-up-callback-active");});$(".pop-up-callback>.close-pop-up").click(function(){$('.pop-up-callback').removeClass("pop-up-callback-active");});</script>
            <script>var swiper=new Swiper('.header-slider>.swiper-container',{pagination:{el:'.header-slider>.swiper-container>.container>.swiper-pagination',clickable:true,},navigation:{nextEl:'.header-slider>.swiper-container>.container>.swiper-button-next',prevEl:'.header-slider>.swiper-container>.container>.swiper-button-prev',},autoplay:{delay:7000,},});</script>
            <script>var swiper=new Swiper('.completed-objects>.container>.swiper-container',{slidesPerView:3,spaceBetween:40,loop:true,navigation:{nextEl:'.completed-objects>.container>.swiper-container>.swiper-button-next',prevEl:'.completed-objects>.container>.swiper-container>.swiper-button-prev',},breakpoints:{992:{spaceBetween:15,},768:{slidesPerView:2,},576:{slidesPerView:1,},}});</script>
            <script>$(".completed-objects>.container>.swiper-container>.swiper-wrapper>.project1").hover(function(){if($('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project1-desc').is(':visible')){$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project1-desc').slideUp("slow");}else{$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project1-desc').slideDown("slow");$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project1-desc').css({display:'flex'});}});$(".completed-objects>.container>.swiper-container>.swiper-wrapper>.project2").hover(function(){if($('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project2-desc').is(':visible')){$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project2-desc').slideUp("slow");}else{$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project2-desc').slideDown("slow");$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project2-desc').css({display:'flex'});}});$(".completed-objects>.container>.swiper-container>.swiper-wrapper>.project3").hover(function(){if($('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project3-desc').is(':visible')){$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project3-desc').slideUp("slow");}else{$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project3-desc').slideDown("slow");$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project3-desc').css({display:'flex'});}});$(".completed-objects>.container>.swiper-container>.swiper-wrapper>.project4").hover(function(){if($('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project4-desc').is(':visible')){$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project4-desc').slideUp("slow");}else{$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project4-desc').slideDown("slow");$('.completed-objects>.container>.swiper-container>.swiper-wrapper>.swiper-slide>.project4-desc').css({display:'flex'});}});</script>
            <script>$(window).scroll(function(){if($(window).scrollTop()>800){$('.scroll-up').show()}else{$('.scroll-up').hide()}})</script>

            <?php if ($slideshow = get_field('slideshow')): ?>
            <div class="slideshow js-slideshow">
                <div class="slideshow-frame js_frame">
                    <ul class="slideshow-slides js_slides">
                        <?php foreach ($slideshow as $slide): ?>
                        <li class="slideshow-slide js_slide" style="background-image:url('<?php echo $slide['image']['url'] ?>')">
                            <div class="slideshow-slide__info">
                                <div class="slideshow-slide__title js-split-words"><?php echo $slide['title'] ?></div>
                                <br>
                                <div class="slideshow-slide__desc js-split-words"><?php echo $slide['desc'] ?></div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <ul class="slideshow-dots js_dots"></ul>
            </div>
            <?php endif; ?>

            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>