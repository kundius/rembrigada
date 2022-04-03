<?php $measurement = get_field('measurement', 'option'); ?>
<section class="landing-measurement">
  <div class="container">
    <?php if (!empty($measurement['title'])): ?>
    <div class="landing-measurement__title">
      <span><?php echo $measurement['title'] ?></span>
    </div>
    <?php endif; ?>
    <?php if (!empty($measurement['request'])): ?>
    <div class="landing-measurement__request">
      <button
        data-order
        data-order-title="<?php echo $measurement['form']['title'] ?>"
        data-order-submit="<?php echo $measurement['form']['submit'] ?>"
        data-order-subject="<?php echo $measurement['title'] ?>"
        data-order-description="<?php echo $measurement['form']['description'] ?>"
        data-order-success-title="<?php echo $measurement['form']['success']['title'] ?>"
        data-order-success-description="<?php echo $measurement['form']['success']['description'] ?>"
        class="landing-button"
      >
        <?php echo $measurement['request'] ?>
      </button>
    </div>
    <?php endif; ?>
</section>
