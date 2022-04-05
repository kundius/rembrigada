<?php $get_estimate = get_field('get-estimate', 'option'); ?>
<section class="landing-get-estimate">
  <div class="container container_medium">
    <?php if (!empty($get_estimate['title'])): ?>
    <h2 class="landing-get-estimate__title">
      <?php echo $get_estimate['title'] ?>
    </h2>
    <?php endif; ?>
    <div class="landing-get-estimate__layout">
      <div class="landing-get-estimate__layout-expert">
        <div class="get-estimate-expert">
          <div class="get-estimate-expert__image">
            <img src="<?php echo $get_estimate['expert']['image']['url'] ?>" alt="">
          </div>
          <div class="get-estimate-expert__body">
            <?php if (!empty($get_estimate['expert']['name'])): ?>
            <div class="get-estimate-expert__name">
              <?php echo $get_estimate['expert']['name'] ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($get_estimate['expert']['stats'])): ?>
            <div class="get-estimate-expert__stats">
              <?php echo $get_estimate['expert']['stats'] ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($get_estimate['expert']['description'])): ?>
            <div class="get-estimate-expert__description">
              <?php echo $get_estimate['expert']['description'] ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="landing-get-estimate__layout-form">
        <form action="/wp-json/contact-form-7/v1/contact-forms/4198/feedback" method="post" class="get-estimate-form js-form">
          <input type="hidden" name="subject" value="<?php echo $get_estimate['title'] ?>">
          <div class="get-estimate-form__row">
            <input type="text" name="your-name" value="" class="get-estimate-form__input" placeholder="Имя" />
          </div>
          <div class="get-estimate-form__row">
            <span class="wpcf7-form-control-wrap your-phone">
              <input type="tel" name="your-phone" value="" class="get-estimate-form__input" placeholder="Телефон*">
            </span>
          </div>
          <div class="get-estimate-form__row">
            <button type="submit" class="get-estimate-form__submit landing-button<?php if ($get_estimate['button']['glare']): ?> landing-button_glare<?php endif; ?>">
              <?php echo $get_estimate['button']['text'] ?>
            </button>
          </div>
          <label class="get-estimate-form__rules">
            <input type="checkbox" name="rules" value="1" class="form-checkbox" />
            <span></span>
            Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
          </label>
        </form>
      </div>
    </div>
  </div>
</section>
