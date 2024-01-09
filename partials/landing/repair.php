<?php $data = get_field('repair', 'option'); ?>
<section class="landing-repair">
  <div class="container">
    <?php if (!empty($data['title'])): ?>
    <div class="landing-repair__title"><?php echo $data['title'] ?></div>
    <?php endif; ?>
    <div class="landing-repair__grid">
      <?php foreach ($data['list'] as $item): ?>
      <div class="landing-repair__cell">
        <div class="landing-repair-item">
          <div class="landing-repair-item__image">
            <?php if ($image = $item['image']): ?>
            <img src="<?php echo $image['sizes']['w468h364'] ?>" alt="" loading="lazy">
            <?php else: ?>
            <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
            <?php endif; ?>
            <div class="landing-repair-item__labels">
              <div class="landing-repair-item__term"><?php echo $repair['term'] ?></div>
            </div>
          </div>
          <div class="landing-repair-item__inner">
            <div class="landing-repair-item__title"><?php echo $repair['name'] ?></div>
            <div class="landing-repair-item__description"><?php echo $repair['description'] ?></div>
            <div class="landing-repair-item__price"><?php echo $repair['price'] ?></div>
            <?php if (!empty($data['button']['text'])): ?>
            <a href="<?php echo $data['button']['link'] ?>" class="landing-repair-item__button">
              <?php echo $data['button']['text'] ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
