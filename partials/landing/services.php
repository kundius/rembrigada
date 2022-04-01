<?php $services = get_field('services', 'option'); ?>
<section class="landing-services">
  <div class="container">
    <?php if (!empty($services['title'])): ?>
    <div class="landing-services__title"><?php echo $services['title'] ?></div>
    <?php endif; ?>
    <div class="landing-services__grid">
      <?php foreach ($services['items'] as $service): ?>
      <div class="landing-services__cell">
        <div class="landing-service">
          <div class="landing-service__title"><?php echo $service['name'] ?></div>
          <div class="landing-service__inner">
            <div class="landing-service__image">
              <?php if ($image = $service['image']): ?>
              <img src="<?php echo $image['sizes']['w468h364'] ?>" alt="" loading="lazy">
              <?php else: ?>
              <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
              <?php endif; ?>
            </div>
            <?php if ($price = $service['price']): ?>
            <div class="landing-service__label">
              <?php echo $price['prefix'] ?>
              <span><?php echo $price['amount'] ?></span>
              <?php echo $price['unit'] ?>
            </div>
            <?php endif; ?>
          </div>
          <div class="landing-service__request">
            <button data-order data-order-subject="<?php echo $price['subject'] ?>" data-order-section="<?php echo $services['title'] ?> / <?php echo $price['name'] ?>" class="landing-button"><?php echo $price['request'] ?></button>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
