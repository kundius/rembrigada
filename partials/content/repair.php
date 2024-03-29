<?php $data = get_field('repair', 'option'); ?>
<div class="content-repair">
  <div class="content-repair__grid">
    <?php foreach ($data['list'] as $item): ?>
    <div class="content-repair__cell">
      <div class="content-repair-item">
        <div class="content-repair-item__image">
          <?php if ($image = $item['image']): ?>
          <img src="<?php echo $image['sizes']['w468h364'] ?>" alt="" loading="lazy">
          <?php else: ?>
          <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
          <?php endif; ?>
          <div class="content-repair-item__labels">
            <div class="content-repair-item__term"><?php echo $item['term'] ?></div>
          </div>
        </div>
        <div class="content-repair-item__inner">
          <div class="content-repair-item__title">
            <?php if (!empty($item['button']['link'])): ?>
            <a href="<?php echo $item['button']['link'] ?>">
            <?php endif; ?>
            <?php echo $item['name'] ?>
            <?php if (!empty($item['button']['link'])): ?>
            </a>
            <?php endif; ?>
          </div>
          <div class="content-repair-item__description"><?php echo $item['description'] ?></div>
          <div class="content-repair-item__price"><?php echo $item['price'] ?></div>
          <?php if (!empty($item['button']['text'])): ?>
          <a href="<?php echo $item['button']['link'] ?>" class="content-repair-item__button">
            <?php echo $item['button']['text'] ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
