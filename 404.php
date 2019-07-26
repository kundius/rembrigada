<?php
$referer = '/';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
}
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <?php get_template_part('partials/head'); ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="page-not-found-section">
                <?php get_template_part('partials/header'); ?>
                <section class="page-not-found">
                    <h1>404</h1>
                    <div class="page-not-found-desc">
                        <h2>Cтраница не найдена</h2>
                        <p>Возможно, она была удалена или вы где-то ошиблись. Позвоните нам или вернитесь назад, чтобы поискать в другом месте</p>
                        <a href="<?php echo $referer ?>" class="prev-page">Вернуться</a>
                    </div>
                </section>
                <?php get_template_part('partials/footer') ?>
            </div>
        </div>
    </body>
</html>