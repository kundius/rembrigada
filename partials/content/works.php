<?php $data = get_field('works', 'option'); ?>
<div class="content-works">
  <div class="content-works__grid">
    <?php foreach ($data['list'] as $item): ?>
    <div class="content-works__cell">
      <div class="content-works-item">
        <div class="content-works-item__gallery content-works-swiper">
          <div class="swiper">
            <div class="swiper-wrapper">
              <?php foreach ($item['gallery'] as $slide): ?>
              <div class="swiper-slide">
                <?php if ($image = $item['image']): ?>
                <img src="<?php echo $slide['sizes']['w468h364'] ?>" alt="<?php echo esc_html($slide['title']) ?>" loading="lazy">
                <?php else: ?>
                <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
          <div class="content-works-item__labels">
            <div class="content-works-item__area"><?php echo $item['area'] ?></div>
            <div class="content-works-item__term"><?php echo $item['term'] ?></div>
          </div>
        </div>
        <div class="content-works-item__inner">
          <div class="content-works-item__title"><?php echo $item['name'] ?></div>
          <div class="content-works-item__address"><?php echo $item['address'] ?></div>
          <div class="content-works-item__price"><?php echo $item['price'] ?></div>
          <?php if (!empty($item['button']['text'])): ?>
          <a href="<?php echo $data['button']['link'] ?>" class="content-works-item__button">
            <?php echo $item['button']['text'] ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php if (!empty($data['more']['text'])): ?>
  <div class="content-works__more">
    <a href="<?php echo $data['more']['link'] ?>" class="content-works__more-link">
      <?php echo $data['more']['text'] ?>
    </a>
  </div>
  <?php endif; ?>
</div>
