<?php $decision = get_field('decision', 'option'); ?>
<section class="landing-decision">
  <div class="container">
    <div class="landing-decision__layout">
      <div class="landing-decision__layout-body">
        <div class="landing-decision__title"><?php echo $decision['title'] ?></div>
        <div class="landing-decision__description"><?php echo $decision['description'] ?></div>
        <div class="landing-decision__request">
          <button data-basiclightbox="#callback" class="landing-button landing-button_large"><?php echo $decision['request'] ?></button>
        </div>
      </div>
    </div>
  </div>
</section>
