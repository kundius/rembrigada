<!DOCTYPE html>
<html lang="ru" itemscope itemtype="http://schema.org/WebSite">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
            
            <?php get_template_part('partials/page-headline') ?>

            <div class="section-landing content">
                <?php the_content() ?>
            </div>

            <?php endwhile; else: ?>
                <p>Извините, ничего не найдено.</p>
            <?php endif; ?>

            <?php get_template_part('partials/footer') ?>
        </div>
    </body>
</html>
