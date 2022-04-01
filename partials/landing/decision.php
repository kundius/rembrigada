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
          <button data-order="<?php echo $decision['title'] ?>" class="landing-button landing-button_large"><?php echo $decision['request'] ?></button>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
