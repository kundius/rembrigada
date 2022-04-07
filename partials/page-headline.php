<?php $headline = get_field('headline') ?>
<?php if ($headline['background']): ?>
<section class="page-bg-headline" style="background-image: url('<?php echo $headline['background']['url'] ?>')">
    <div class="container">
        <div class="page-bg-headline__inner">
            <?php if (!empty($headline['before-title'])): ?>
            <div class="page-bg-headline__before-title"><?php echo $headline['before-title'] ?></div>
            <?php endif; ?>

            <h1 class="page-bg-headline__title">
                <?php // the_title() ?>
                Сделаем качественный премиальный ремонт Вашей квартиры точно в срок и сохраним Вашу нервную систему
            </h1>

            <?php if (!empty($headline['after-title']['text'])): ?>
            <div class="page-bg-headline__after-title<?php if (!empty($headline['after-title']['line'])): ?> page-bg-headline__after-title_line<?php endif; ?>">
                <?php echo $headline['after-title']['text'] ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($headline['items'])): ?>
            <div class="page-bg-headline__items">
                <?php foreach ($headline['items'] as $item): ?>
                <div class="page-bg-headline__item">
                    <div class="page-bg-headline__item-image">
                        <img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['title'] ?>" />
                    </div>
                    <div class="page-bg-headline__item-info">
                        <div class="page-bg-headline__item-title">
                            <?php echo $item['title'] ?>
                        </div>
                        <div class="page-bg-headline__item-description">
                            <?php echo $item['description'] ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($headline['button']['text'])): ?>
            <?php if ($headline['button']['action'] == 'calc'): ?>
            <a
                href="#quiz"
                class="page-bg-headline__button<?php if (!empty($headline['button']['glare'])): ?> page-bg-headline__button_glare<?php endif; ?>"
            >
                <span class="page-bg-headline__button-icon">
                    <?php icon('calc', 1.4) ?>
                </span>
                <span class="page-bg-headline__button-text">
                    <?php echo $headline['button']['text'] ?>
                </span>
            </a>
            <?php endif; ?>
            <?php if ($headline['button']['action'] == 'order'): ?>
            <button
                data-order
                data-order-title="<?php echo $headline['form']['title'] ?>"
                data-order-submit="<?php echo $headline['form']['submit'] ?>"
                data-order-subject="<?php echo the_title() ?>"
                data-order-description="<?php echo $headline['form']['description'] ?>"
                data-order-success-title="<?php echo $headline['form']['success']['title'] ?>"
                data-order-success-description="<?php echo $headline['form']['success']['description'] ?>"
                class="page-bg-headline__button<?php if (!empty($headline['button']['glare'])): ?> page-bg-headline__button_glare<?php endif; ?>"
            >
                <span class="page-bg-headline__button-text">
                    <?php echo $headline['button']['text'] ?>
                </span>
            </button>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if (!is_front_page()): ?>
<div class="breadcrumbs breadcrumbs_light" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container">
        <?php bcn_display() ?>
    </div>
</div>
<?php endif; ?>
<?php else: ?>
<?php if (!is_front_page()): ?>
<div class="breadcrumbs breadcrumbs_light" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container">
        <?php bcn_display() ?>
    </div>
</div>
<?php endif; ?>
<section class="page-headline">
    <div class="container">
        <h1 class="page-headline__title"><span><?php the_title() ?></span></h1>
    </div>
</section>
<?php endif; ?>
