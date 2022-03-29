<?php $get_estimate = get_field('get-estimate', 'option'); ?>
<section class="landing-get-estimate">
  <div class="container container_medium">
    <div class="landing-get-estimate__title">
      <?php echo $get_estimate['title'] ?>
    </div>
    <div class="landing-get-estimate__layout">
      <div class="landing-get-estimate__layout-expert">
        <div class="get-estimate-expert">
          <div class="get-estimate-expert__image">
            <img src="<?php echo $get_estimate['expert']['image']['url'] ?>" alt="">
          </div>
          <div class="get-estimate-expert__body">
            <div class="get-estimate-expert__name">
              <?php echo $get_estimate['expert']['name'] ?>
            </div>
            <div class="get-estimate-expert__stats">
              <?php echo $get_estimate['expert']['stats'] ?>
            </div>
            <div class="get-estimate-expert__description">
              <?php echo $get_estimate['expert']['description'] ?>
            </div>
          </div>
        </div>
      </div>
      <div class="landing-get-estimate__layout-form">
        <form action="/wp-json/contact-form-7/v1/contact-forms/379/feedback" method="post" class="get-estimate-form js-form">
          <div class="get-estimate-form__row">
            <input type="text" name="your-name" value="" class="form-input" placeholder="Имя" />
          </div>
          <div class="get-estimate-form__row">
            <span class="wpcf7-form-control-wrap your-phone">
              <input type="tel" name="your-phone" value="" class="form-input" placeholder="Телефон*">
            </span>
          </div>
          <div class="get-estimate-form__row">
            <input type="hidden" name="referrer" value="<?php echo wp_get_document_title() ?>">
            <button type="submit" class="get-estimate-form__submit"><?php echo $get_estimate['request'] ?></button>
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
