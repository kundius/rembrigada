<!DOCTYPE html>
<html>
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>

            <div class="section-main">
                <div class="container">
                    <div class="layout">
                        <div class="layout__sidebar">
                            <?php get_sidebar() ?>
                        </div>
                        <div class="layout__content">
                            <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
                                <h1><?php the_title(); ?></h1>
                                <?php the_content(); ?>
                            <?php endwhile; else: ?>
                                <p>Извините, ничего не найдено.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>