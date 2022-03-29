<?php $services = get_field('services', 'option'); ?>
<section class="type-of-repair">
  <div class="container">
    <div class="type-of-repair__title"><?php echo $services['title'] ?></div>
    <div class="type-of-repair__grid">
      <?php foreach ($services['items'] as $service): ?>
      <div class="type-of-repair__cell">
        <div class="type-of-repair-item">
            <div class="type-of-repair__title"><?php echo $service['name'] ?></div>
            <div class="type-of-repair-item__inner">
                <div class="repair-img-label">
                    <a href="<?php the_permalink() ?>">
                        <?php if ($image = $service['image']): ?>
                        <img class="repair-img" src="<?php echo $image ?>" alt="" loading="lazy">
                        <?php else: ?>
                        <img class="repair-img" src="https://via.placeholder.com/468x364" alt="" loading="lazy">
                        <?php endif; ?>
                    </a>
                    <?php if ($price = $service['price']): ?>
                    <div class="label">
                        <p>
                            <?php echo $price['prefix'] ?>
                            <span><?php echo $price['amount'] ?></span>
                            <?php echo $price['unit'] ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
