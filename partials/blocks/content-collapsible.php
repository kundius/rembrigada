<?php if ($text = get_field('content-collapsible')): ?>
<div class="content-collapsible">
    <div class="content-collapsible__body">
        <div class="content-collapsible__inner">
            <?php echo $text ?>
        </div>
    </div>
    <button class="content-collapsible__button"></button>
</div>
<?php endif; ?>
