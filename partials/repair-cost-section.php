<?php $background = get_field('cost_background') ?>
<div class="repair-cost-section" style="background-image: url('<?php echo $background['url'] ?>')">
    <div class="container container_alt">
        <div class="repair-cost-section__title"><?php the_field('cost_title') ?></div>
        <div class="repair-cost-section__desc"><?php the_field('cost_desc') ?></div>
        <?php if ($list = get_field('cost_list')): ?>
        <div class="repair-cost-section__list">
            <?php foreach ($list as $item): ?>
            <div class="repair-cost-section__item">
                <span></span>
                <?php echo $item['text'] ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div class="repair-cost-section__signature">
            <?php the_field('cost_signature') ?>
        </div>
    </div>
</div>
