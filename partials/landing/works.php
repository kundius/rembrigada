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
      <?php foreach ($data['items'] as $item): ?>
      <div class="landing-works__cell">
        <div class="landing-works-item">
          <div class="landing-works-item__gallery">
            <div class="slideshow js-slideshow">
                <div class="slideshow-slides js_slides">
                  <?php foreach ($item['gallery'] as $slide): ?>
                  <div class="slideshow-slide">
                    <img
                      class="slideshow-slide__image js-image-cover tns-lazy-img"
                      <?php echo srcset($slide['image'], ['w468h364', 'w800h600'], true) ?>
                      data-src="<?php echo $slide['image']['url'] ?>"
                      alt="<?php echo esc_html($slide['title']) ?>"
                    />
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="slideshow-nav js_dots"></div>
            </div>
            <div class="landing-works-item__labels">
              <div class="landing-works-item__area"><?php echo $works['area'] ?></div>
              <div class="landing-works-item__term"><?php echo $works['term'] ?></div>
            </div>
          </div>
          <div class="landing-works-item__inner">
            <div class="landing-works-item__title"><?php echo $works['name'] ?></div>
            <div class="landing-works-item__address"><?php echo $works['address'] ?></div>
            <div class="landing-works-item__price"><?php echo $works['price'] ?></div>
            <?php if (!empty($data['button']['text'])): ?>
            <a href="<?php echo $data['button']['link'] ?>" class="landing-works-item__button">
              <?php echo $data['button']['text'] ?>
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
