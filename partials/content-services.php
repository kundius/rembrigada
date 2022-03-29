<?php $services = get_field('services', 'option'); ?>
<section class="type-of-repair">
  <div class="container">
    <div class="type-of-repair__title"><?php echo $services['title'] ?></div>
    <div class="type-of-repair__grid">
      <?php foreach ($services['items'] as $service): ?>
      <div class="type-of-repair__cell">
        <div class="type-of-repair-item">
          <div class="type-of-repair-item__title"><?php echo $service['name'] ?></div>
          <div class="type-of-repair-item__inner">
            <div class="type-of-repair-item__image">
              <?php if ($image = $service['image']): print_r($service['image']); ?>
              <img src="<?php echo $image ?>" alt="" loading="lazy">
              <?php else: ?>
              <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
              <?php endif; ?>
            </div>
            <?php if ($price = $service['price']): ?>
            <div class="type-of-repair-item__label">
              <?php echo $price['prefix'] ?>
              <span><?php echo $price['amount'] ?></span>
              <?php echo $price['unit'] ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
