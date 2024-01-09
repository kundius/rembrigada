<?php $data = get_field('works', 'option'); ?>
<section class="landing-works">
  <div class="container">
    <?php if (!empty($data['title'])): ?>
    <div class="landing-works__title"><?php echo $data['title'] ?></div>
    <?php endif; ?>
    <?php if (!empty($data['description'])): ?>
    <div class="landing-works__description"><?php echo $data['description'] ?></div>
    <?php endif; ?>
    <div class="landing-works__grid">
      <?php foreach ($data['list'] as $item): ?>
      <div class="landing-works__cell">
        <div class="landing-works-item">
          <div class="landing-works-item__gallery">
            <div class="landing-works-gallery js-landing-works-gallery">
              <?php foreach ($item['gallery'] as $slide): ?>
              <div class="landing-works-gallery__slide">
                <img
                  class="landing-works-gallery__image"
                  src="<?php echo $slide['sizes']['w468h364'] ?>"
                  alt="<?php echo esc_html($slide['title']) ?>"
                />
              </div>
              <?php endforeach; ?>
            </div>
            <div class="landing-works-item__labels">
              <div class="landing-works-item__area"><?php echo $item['area'] ?></div>
              <div class="landing-works-item__term"><?php echo $item['term'] ?></div>
            </div>
          </div>
          <div class="landing-works-item__inner">
            <div class="landing-works-item__title"><?php echo $item['name'] ?></div>
            <div class="landing-works-item__address"><?php echo $item['address'] ?></div>
            <div class="landing-works-item__price"><?php echo $item['price'] ?></div>
            <?php if (!empty($item['button']['text'])): ?>
            <a href="<?php echo $data['button']['link'] ?>" class="landing-works-item__button">
              <?php echo $item['button']['text'] ?>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php if (!empty($data['more']['text'])): ?>
    <div class="landing-works__more">
      <a href="<?php echo $data['more']['link'] ?>" class="landing-works__more-link">
        <?php echo $data['more']['text'] ?>
      </a>
    </div>
    <?php endif; ?>
  </div>
</section>
