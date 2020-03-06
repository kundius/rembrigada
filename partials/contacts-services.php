<section class="section-contacts">
    <div class="container container_alt">
        <div class="section-contacts-grid">
            <div class="section-contacts__item">
                <div class="contacts">
                    <h3 class="contacts__title">Контакты</h3>
                    <div class="contacts__text" itemscope itemtype="http://schema.org/LocalBusiness">
                        <meta itemprop="name" content="<?php echo get_bloginfo('blogname') ?>" />
                        <meta itemprop="priceRange" content="2500-6000RUB" />
                        <meta itemprop="description" content="<?php echo get_bloginfo('description') ?>" />
                        <meta itemprop="image" content="<?php echo get_bloginfo('template_url') ?>/dist/img/logo.png" />
                        <a href="<?php the_field('ymap_link', 'options') ?>" class="contacts__row" itemprop="address" target="_blank">
                            <?php the_field('address', 'options') ?>
                        </a>
                        <div class="contacts__row contacts-phones">
                          <div class="contacts-phones__list">
                            <?php foreach (get_field('phones', 'options') as $row): ?>
                              <div itemprop="telephone">Тел.: <?php echo $row['number'] ?></div>
                            <?php endforeach ?>
                          </div>
                          <div class="contacts-phones__messengers">
                            <div class="contacts-messengers">
                                <a class="contacts-messengers__item contacts-messengers__item_telegram" href="tg://resolve?domain=<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone_telegram', 'options')) ?>">
                                    <?php icon('telegram', 1.2) ?>
                                </a>
                                <a class="contacts-messengers__item contacts-messengers__item_whatsapp" href="whatsapp://send?text=Hello&phone=<?php echo preg_replace("/[ \(\)\-]/", "", get_field('phone_whatsapp', 'options')) ?>">
                                    <?php icon('whatsapp', 1.3) ?>
                                </a>
                            </div>
                          </div>
                        </div>
                        <div class="contacts__row">
                            <a href="mailto:<?php the_field('email', 'options') ?>"><?php the_field('email', 'options') ?></a>
                        </div>
                    </div>
                    <div class="contacts__time">
                        <?php icon('clock', 1.25) ?>
                        <?php the_field('schedule', 'options') ?>
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
    <img class="section-contacts__bg" src="<?php echo get_bloginfo('template_url') ?>/dist/img/map-bg.jpg" loading="lazy" />
</section>
