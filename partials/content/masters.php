<?php $data = get_field('masters', 'option'); ?>
<div class="content-masters content-masters-swiper">
  <div class="swiper">
    <div class="swiper-wrapper">
      <?php foreach ($data['items'] as $item): ?>
      <div class="swiper-slide">
        <div class="content-masters-item">
          <div class="content-masters-item__image">
            <?php if ($image = $item['image']): ?>
            <img src="<?php echo $image['sizes']['w468h364'] ?>" alt="" loading="lazy">
            <?php else: ?>
            <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
            <?php endif; ?>
          </div>
          <div class="content-masters-item__inner">
            <div class="content-masters-item__name"><?php echo $item['name'] ?></div>
            <div class="content-masters-item__specialization"><?php echo $item['specialization'] ?></div>
            <div class="content-masters-item__experience"><?php echo $item['experience'] ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>
