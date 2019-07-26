<?php
$term = get_term_by('slug', get_query_var('project_category'), 'project_category');
// $projects = new WP_Query(array(
//     'post_type' => 'project',
//     'posts_per_page' => 1,
//     'tax_query' => [[
//         'taxonomy' => 'project_category',
//         'terms' => $term->term_id,
//         'include_children' => false
//     ]]
// ));
$categories = get_categories([
    'taxonomy' => 'project_category',
    'hide_empty' => false,
    'parent' => $term->term_id
]);
?>
<!DOCTYPE html>
<html>
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <?php get_template_part('partials/header'); ?>
            
            <div class="breadcrumbs breadcrumbs_absolute" typeof="BreadcrumbList" vocab="https://schema.org/">
                <div class="container">
                    <?php bcn_display() ?>
                </div>
            </div>
            
            <section class="page-headline">
                <div class="container">
                    <h1 class="page-headline__title"><span><?php single_cat_title() ?></span></h1>
                </div>
            </section>

            <?php if (count($categories) > 0): ?>
            <section class="projects-cats-section">
                <div class="container container_tiny">
                    <div class="projects-cats-section__text"><?php echo $term->description ?></div>
                </div>
                <div class="container container_alt">
                    <div class="projects-cats-section__grid">
                        <?php foreach ($categories as $category): ?>
                        <div class="projects-cats-section__cell">
                            <a href="<?php echo get_category_link($category->term_id) ?>" class="project-cat">
                                <?php if ($image = get_field('image', 'project_category_' . $category->term_id)): ?>
                                <img class="project-cat__image" src="<?php echo $image['sizes']['w800h600'] ?>" alt="">
                                <?php else: ?>
                                <img class="project-cat__image" src="https://via.placeholder.com/800x600" alt="">
                                <?php endif; ?>
                                <span class="project-cat__info">
                                    <span class="project-cat__title"><span><?php echo $category->name ?></span></span>
                                    <?php if ($category->description): ?>
                                    <span class="project-cat__desc"><?php echo $category->description ?></span>
                                    <?php endif; ?>
                                    <span class="project-cat__more"><span>Подробнее</span></span>
                                </span>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php elseif (have_posts()): ?>
            <section class="projects-section">
                <div class="container container_tiny">
                    <div class="projects-section__text"><?php echo $term->description ?></div>
                </div>
                <div class="container container_alt">
                    <div class="projects-section__grid">
                        <?php while(have_posts()): the_post(); ?>
                        <div class="projects-section__cell">
                            <a href="<?php the_permalink() ?>" class="project-item">
                                <?php if ($image = get_the_post_thumbnail_url(get_the_ID(), array(800, 600))): ?>
                                <img class="project-item__image" src="<?php echo $image ?>" alt="<?php the_title() ?>">
                                <?php else: ?>
                                <img class="project-item__image" src="https://via.placeholder.com/468x500" alt="">
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
                    <?php the_posts_pagination([
                        'prev_text' => 'Предыдущая',
                        'next_text' => 'Следующая'
                    ]) ?>
                </div>
            </section>
            <?php endif; ?>

            <?php get_template_part('partials/contacts', 'services') ?>
            <?php get_template_part('partials/footer'); ?>
        </div>
    </body>
</html>