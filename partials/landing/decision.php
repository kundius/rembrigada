<?php $decision = get_field('decision', 'option'); ?>
<section class="landing-decision">
  <div class="container">
    <div class="landing-decision__layout">
      <div class="landing-decision__layout-body">
        <?php if (!empty($decision['title'])): ?>
        <div class="landing-decision__title"><?php echo $decision['title'] ?></div>
        <?php endif; ?>
        <?php if (!empty($decision['description'])): ?>
        <div class="landing-decision__description"><?php echo $decision['description'] ?></div>
        <?php endif; ?>
        <?php if (!empty($decision['request'])): ?>
        <div class="landing-decision__request">
          <button
            data-order
            data-order-title="<?php echo $decision['form']['title'] ?>"
            data-order-submit="<?php echo $decision['form']['submit'] ?>"
            data-order-subject="<?php echo $decision['title'] ?>"
            data-order-description="<?php echo $repair_types['form']['description'] ?>"
            data-order-success-title="<?php echo $repair_types['form']['success']['title'] ?>"
            data-order-success-description="<?php echo $repair_types['form']['success']['description'] ?>"
            class="landing-button landing-button_large"
          ><?php echo $decision['request'] ?></button>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
