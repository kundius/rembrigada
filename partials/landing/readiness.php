<?php $readiness = get_field('readiness', 'option'); ?>
<section class="landing-readiness">
  <div class="container container_medium">
    <?php if (!empty($readiness['title'])): ?>
    <div class="landing-readiness__title">
      <?php echo $readiness['title'] ?>
    </div>
    <?php endif; ?>
    <?php if (!empty($readiness['description'])): ?>
    <div class="landing-readiness__description">
      <?php echo $readiness['description'] ?>
    </div>
    <?php endif; ?>
    <form action="/wp-json/contact-form-7/v1/contact-forms/4198/feedback" method="post" class="readiness-form js-form">
      <input type="hidden" name="subject" value="<?php echo $readiness['title'] ?>">
      <div class="readiness-form__phone">
        <span class="wpcf7-form-control-wrap your-phone">
          <input type="tel" name="your-phone" value="" class="readiness-form__input" placeholder="Телефон*">
        </span>
      </div>
      <div class="readiness-form__submit">
        <button type="submit" class="landing-button"><?php echo $readiness['request'] ?></button>
      </div>
      <label class="readiness-form__rules">
        <input type="checkbox" name="rules" value="1" class="form-checkbox" />
        <span></span>
        Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
      </label>
    </form>
  </div>
</section>
