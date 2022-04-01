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
      <button data-order data-order-subject="<?php echo $measurement['subject'] ?>" data-order-section="<?php echo $measurement['title'] ?>" class="landing-button">
        <?php echo $measurement['request'] ?>
      </button>
    </div>
    <?php endif; ?>
</section>
