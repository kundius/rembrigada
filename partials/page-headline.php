<?php if ($background = get_field('headline_background')): ?>
<section class="page-bg-headline" style="background-image: url('<?php echo $background['url'] ?>')">
    <div class="page-bg-headline__inner">
        <h1 class="page-bg-headline__title"><?php the_title() ?></h1>
        <?php if ($description = get_field('headline_description')): ?>
        <div class="page-bg-headline__description"><?php echo $description ?></div>
        <?php endif; ?>
        <?php if ($more = get_field('headline_more')): ?>
        <?php $more_title = $more['title'] ? $more['title'] : 'Хочу узнать детали' ?>
        <?php $more_link = $more['link'] ? $more['link'] : '#callback' ?>
        <div class="page-bg-headline__more">
            <a class="page-bg-headline__more-link" href="<?php echo $more_link ?>"><?php echo $more_title ?></a>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php else: ?>
<div class="breadcrumbs breadcrumbs_light" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container">
        <?php bcn_display() ?>
    </div>
</div>
<section class="page-headline">
    <div class="container">
        <h1 class="page-headline__title"><span><?php the_title() ?></span></h1>
    </div>
</section>
<?php endif; ?>
