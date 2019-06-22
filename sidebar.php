<?php
$news = new WP_Query(array(
    'posts_per_page' => 3,
    'cat' => 2
));
?>
<?php if ($news->have_posts()): ?>
<div class="widget">
    <div class="widget__title">Последние новости</div>
    <div class="widget__body">
        <div class="widget-news">
            <?php while($news->have_posts()): $news->the_post(); ?>
                <div class="widget-news-item">
                    <?php if ($image = get_the_post_thumbnail_url()): ?>
                        <a href="<?php the_permalink() ?>" class="widget-news-item__image">
                            <img src="<?php echo $image ?>" alt="<?php the_title() ?>">
                        </a>
                    <?php endif; ?>
                    <div class="widget-news-item__date"><?php the_date() ?></div>
                    <a href="<?php the_permalink() ?>" class="widget-news-item__title">
                        <?php the_title() ?>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php endif; wp_reset_query(); ?>