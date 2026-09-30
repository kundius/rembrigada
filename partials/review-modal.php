<?php
$form_title = function_exists('rembrigada_get_option') ? rembrigada_get_option('review_form_title', 'Добавить отзыв') : 'Добавить отзыв';
$form_desc = function_exists('rembrigada_get_option') ? rembrigada_get_option('review_form_desc', '') : '';
$form_button = function_exists('rembrigada_get_option') ? rembrigada_get_option('review_form_button', 'Отправить') : 'Отправить';
$form_goal = function_exists('rembrigada_get_option') ? rembrigada_get_option('review_form_goal', '') : '';
$success_title = function_exists('rembrigada_get_option') ? rembrigada_get_option('review_success_title', 'Спасибо! Ваш отзыв отправлен') : 'Спасибо! Ваш отзыв отправлен';
$success_desc = function_exists('rembrigada_get_option') ? rembrigada_get_option('review_success_desc', 'Он появится на сайте после проверки.') : 'Он появится на сайте после проверки.';
if ($form_title === '') {
  $form_title = 'Добавить отзыв';
}
if ($form_button === '') {
  $form_button = 'Отправить';
}
?>
<div id="review-modal" class="hidden">
  <div class="modal modal_review modal_review-form">
    <button class="modal__close" data-basiclightbox-close></button>
    <div class="reviews-item__title"><?php echo esc_html($form_title); ?></div>
    <?php if ($form_desc !== ''): ?>
    <div class="review-form__desc"><?php echo esc_html($form_desc); ?></div>
    <?php endif; ?>
    <form
      action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
      method="post"
      class="review-form"
      data-review-form
      data-review-form-action="review_form"
      <?php if ($form_goal !== ''): ?>data-review-form-goal="<?php echo esc_attr($form_goal); ?>"<?php endif; ?>
    >
      <input type="hidden" name="submitted" value="">
      <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('review-nonce'); ?>">
      <input type="hidden" name="page" value="<?php echo esc_attr(wp_get_document_title()); ?>">
      <input type="hidden" name="subject" value="<?php echo esc_attr($form_title); ?>">
      <input type="hidden" name="g-recaptcha-response" value="" data-recaptcha-response>

      <div class="review-form__errors" data-review-form-errors></div>

      <div class="review-form__grid">
        <label class="review-text-field">
          <span class="review-text-field__label">Ваше имя</span>
          <input class="review-text-field__input" type="text" name="your-name" value="" placeholder="" autocomplete="name">
        </label>

        <div class="field-rating">
          <span class="field-rating__label">Ваша оценка</span>
          <div class="field-rating__input">
            <input type="radio" id="review-star5" name="rating" value="5" checked>
            <label for="review-star5" aria-label="5 из 5">★</label>
            <input type="radio" id="review-star4" name="rating" value="4">
            <label for="review-star4" aria-label="4 из 5">★</label>
            <input type="radio" id="review-star3" name="rating" value="3">
            <label for="review-star3" aria-label="3 из 5">★</label>
            <input type="radio" id="review-star2" name="rating" value="2">
            <label for="review-star2" aria-label="2 из 5">★</label>
            <input type="radio" id="review-star1" name="rating" value="1">
            <label for="review-star1" aria-label="1 из 5">★</label>
          </div>
        </div>

        <div class="review-form__full">
          <label class="review-textarea-field">
            <span class="review-textarea-field__label">Ваш отзыв<span>*</span></span>
            <textarea class="review-textarea-field__input" name="message" placeholder="" required></textarea>
          </label>
        </div>

        <div class="review-form__full">
          <div class="review-form__photos-title">Фотографии, если есть</div>
          <div class="gallery-field" data-gallery-field>
            <button type="button" class="gallery-field__add" data-gallery-field-add>
              <span class="gallery-field__add-icon">+</span>
              <span class="gallery-field__add-label">Добавить фото</span>
            </button>
          </div>
        </div>

        <div class="review-form__full">
          <label class="review-form__rules">
            <input type="checkbox" name="rules" value="1" class="form-checkbox" checked />
            <span></span>
            Прочитал(-а) <a href="<?php the_permalink(231) ?>" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="<?php the_permalink(3) ?>" target="_blank">Политикой обработки персональных данных</a>
          </label>
        </div>

        <div class="review-form__full review-form__submit">
          <button type="submit" class="landing-button"><?php echo esc_html($form_button); ?></button>
        </div>
      </div>

      <div class="review-form-success">
        <div class="review-form-success__title"><?php echo nl2br(esc_html($success_title)); ?></div>
        <div class="review-form-success__desc"><?php echo nl2br(esc_html($success_desc)); ?></div>
        <button type="button" class="btn-plus" data-review-form-reset data-basiclightbox-close>Закрыть</button>
      </div>
    </form>
  </div>
</div>
