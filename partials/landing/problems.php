<?php $promlems = get_field('problems', 'option'); ?>
<section class="landing-problems">
  <div class="container container_medium">
    <?php if (!empty($promlems['title'])): ?>
    <div class="landing-problems__title"><?php echo $promlems['title'] ?></div>
    <?php endif; ?>

    <div class="landing-problems__grid">
      <?php foreach ($promlems['items'] as $problem): ?>
      <div class="landing-problems__cell">
        <div class="landing-problem">
          <div class="landing-problem__image">
              <?php if ($image = $problem['image']): ?>
              <img src="<?php echo $image['url'] ?>" alt="" loading="lazy">
              <?php else: ?>
              <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
              <?php endif; ?>
          </div>
          <div class="landing-problem__title">
            <?php echo $problem['title'] ?>
          </div>
          <div class="landing-problem__desc">
            <?php echo $problem['description'] ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if (!empty($promlems['description'])): ?>
    <div class="landing-problems__description"><?php echo $promlems['description'] ?></div>
    <?php endif; ?>

    <?php if (!empty($promlems['button']['text'])): ?>
    <div class="landing-problems__request">
      <button
        data-order
        data-order-title="<?php echo $promlems['form']['title'] ?>"
        data-order-submit="<?php echo $promlems['form']['submit'] ?>"
        data-order-subject="<?php echo $promlems['title'] ?>"
        data-order-description="<?php echo $promlems['form']['description'] ?>"
        data-order-success-title="<?php echo $promlems['form']['success']['title'] ?>"
        data-order-success-description="<?php echo $promlems['form']['success']['description'] ?>"
        class="landing-button<?php if ($promlems['button']['glare']): ?> landing-button_glare<?php endif; ?>"
      ><?php echo $promlems['button']['text'] ?></button>
    </div>
    <?php endif; ?>
  </div>
</section>
