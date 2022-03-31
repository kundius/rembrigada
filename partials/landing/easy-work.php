<?php $easy_work = get_field('easy-work', 'option'); ?>
<section class="landing-easy-work">
  <div class="container">
    <?php if (!empty($easy_work['title'])): ?>
    <div class="landing-easy-work__title"><?php echo $easy_work['title'] ?></div>
    <?php endif; ?>

    <div class="landing-easy-work__list">
      <?php foreach ($easy_work['items'] as $item): ?>
      <div class="easy-work-item">
        <div class="easy-work-item__cell">
          left
        </div>
        <div class="easy-work-item__cell">
          right
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if (!empty($easy_work['request'])): ?>
    <div class="landing-easy-work__request">
      <button data-basiclightbox="#callback" class="landing-button landing-button_large"><?php echo $easy_work['request'] ?></button>
    </div>
    <?php endif; ?>
  </div>
</section>
