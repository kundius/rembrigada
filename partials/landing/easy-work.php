<?php $easy_work = get_field('easy-work', 'option'); ?>
<section class="landing-easy-work">
  <div class="container container_medium">
    <?php if (!empty($easy_work['title'])): ?>
    <div class="landing-easy-work__title"><?php echo $easy_work['title'] ?></div>
    <?php endif; ?>

    <div class="landing-easy-work__list">
      <?php foreach ($easy_work['items'] as $key => $item): ?>
      <div class="easy-work-item">
        <div class="easy-work-item__cell">
          <div class="easy-work-item__image">
            <?php if ($image = $item['image']): ?>
            <img src="<?php echo $image['url'] ?>" alt="" loading="lazy">
            <?php else: ?>
            <img src="https://via.placeholder.com/282x282" alt="" loading="lazy">
            <?php endif; ?>
            <div class="easy-work-item__image-number"><?php echo $key + 1 ?></div>
          </div>
        </div>
        <div class="easy-work-item__cell">
          <?php if (!empty($item['title'])): ?>
          <div class="easy-work-item__title"><?php echo $item['title'] ?></div>
          <?php endif; ?>
          <?php if (!empty($item['description'])): ?>
          <div class="easy-work-item__description"><?php echo $item['description'] ?></div>
          <?php endif; ?>
          <?php if (!empty($item['request'])): ?>
          <div class="easy-work-item__request">
            <button
              data-order
              data-order-title="<?php echo $item['title'] ?>"
              data-order-submit="<?php echo $item['title'] ?>"
              data-order-subject="<?php echo $easy_work['title'] ?> / <?php echo $item['title'] ?>"
              class="landing-button<?php if ($easy_work['button']['glare']): ?> landing-button_glare<?php endif; ?>"
            ><?php echo $easy_work['button']['text'] ?></button>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if (!empty($easy_work['request'])): ?>
    <div class="landing-easy-work__request">
      <button
        data-order
        data-order-title="<?php echo $easy_work['form']['title'] ?>"
        data-order-submit="<?php echo $easy_work['form']['submit'] ?>"
        data-order-subject="<?php echo $easy_work['title'] ?>"
        data-order-description="<?php echo $easy_work['form']['description'] ?>"
        data-order-success-title="<?php echo $easy_work['form']['success']['title'] ?>"
        data-order-success-description="<?php echo $easy_work['form']['success']['description'] ?>"
        class="landing-button landing-button_large<?php if ($easy_work['button']['glare']): ?> landing-button_glare<?php endif; ?>"
      ><?php echo $easy_work['button']['text'] ?></button>
    </div>
    <?php endif; ?>
  </div>
</section>
