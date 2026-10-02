<?php
/**
 * Квиз (ACF-блок acf/quiz).
 * Источник: quiz_source = custom (поля блока) | common (опции).
 * Отправка: фиксированные поля CF7 referrer / quiz_result / your-phone / rules.
 */
$quiz = function_exists('rembrigada_get_quiz_data') ? rembrigada_get_quiz_data() : null;
if (empty($quiz) || empty($quiz['steps'])) {
    return;
}
$steps = $quiz['steps'];
$uid = 'q' . wp_unique_id();
$goal = isset($quiz['goal']) ? $quiz['goal'] : '';
$finish_button = !empty($quiz['finish_button']) ? $quiz['finish_button'] : 'Отправить';
?>
<section class="landing-quiz" id="quiz-<?php echo esc_attr($uid); ?>">
  <div class="container container_medium">
    <?php if (!empty($quiz['title'])): ?>
    <h2 class="landing-quiz__title">
      <?php echo wp_kses_post($quiz['title']); ?>
    </h2>
    <?php endif; ?>

    <div class="quiz" data-quiz>
      <div class="quiz-steps" data-quiz-steps aria-hidden="true"></div>

      <form action="/wp-json/contact-form-7/v1/contact-forms/4295/feedback" method="post" class="quiz-layout js-form" data-quiz-form data-ym-goal="<?php echo esc_attr($goal); ?>">
        <input type="hidden" name="referrer" value="<?php echo esc_attr(get_the_title()); ?>">
        <input type="hidden" name="quiz_result" value="" data-quiz-result>

        <div class="quiz-layout__screens">
          <div class="quiz-screens" data-quiz-screens>

            <?php foreach ($steps as $si => $step): ?>
            <div class="quiz-screens__item" data-quiz-screen data-step-key="<?php echo esc_attr($step['key']); ?>" data-step-type="<?php echo esc_attr($step['type']); ?>" data-step-index="<?php echo esc_attr((string) $si); ?>">
              <div class="quiz-content">
                <div class="quiz-content__image">
                  <?php if (!empty($step['image'])): ?>
                  <img src="<?php echo esc_url($step['image']); ?>" alt="" loading="lazy">
                  <?php endif; ?>
                </div>
                <div class="quiz-content__form">
                  <div class="quiz-form">
                    <div class="quiz-form__title">
                      <div class="quiz-form__title-marker" data-quiz-marker><?php echo esc_html((string) ($si + 1)); ?></div>
                      <div class="quiz-form__title-content">
                        <div class="quiz-form__title-text">
                          <?php echo wp_kses_post($step['question']); ?>
                        </div>
                        <?php if (!empty($step['description'])): ?>
                        <div class="quiz-form__title-desc">
                          <?php echo wp_kses_post($step['description']); ?>
                        </div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="quiz-form__fields">
                      <?php foreach ($step['options'] as $oi => $option): ?>
                      <div class="quiz-form__fields-item">
                        <label class="quiz-form__fields-label<?php echo $step['type'] === 'checkbox' ? ' quiz-form__fields-label_checkbox' : ''; ?>">
                          <input
                            type="<?php echo esc_attr($step['type']); ?>"
                            name="q_<?php echo esc_attr($step['key']); ?><?php echo $step['type'] === 'checkbox' ? '[]' : ''; ?>"
                            value="<?php echo esc_attr(wp_strip_all_tags($option['title'])); ?>"
                            data-option-title="<?php echo esc_attr(wp_strip_all_tags($option['title'])); ?>"
                            data-option-next="<?php echo esc_attr($option['next']); ?>"
                          >
                          <span class="quiz-form__fields-marker" aria-hidden="true"></span>
                          <span class="quiz-option">
                            <span class="quiz-option__title"><?php echo wp_kses_post($option['title']); ?></span>
                            <?php if (!empty($option['desc'])): ?>
                            <span class="quiz-option__desc"><?php echo wp_kses_post($option['desc']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($option['with_input'])): ?>
                            <input
                              type="text"
                              class="quiz-option__input"
                              data-option-input
                              placeholder="<?php echo esc_attr($option['input_placeholder'] !== '' ? $option['input_placeholder'] : 'Ваш вариант'); ?>"
                              autocomplete="off"
                            >
                            <?php endif; ?>
                          </span>
                        </label>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="quiz-form__error" data-quiz-error hidden>Выберите вариант, чтобы продолжить</div>
                    <div class="quiz-buttons">
                      <?php if ($si !== 0): ?>
                      <button type="button" class="quiz-buttons__item quiz-screens__previous" data-quiz-previous>Назад</button>
                      <?php endif; ?>
                      <button type="button" class="quiz-buttons__item quiz-screens__next" data-quiz-next disabled>Следующий шаг</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>

            <div class="quiz-screens__item" data-quiz-screen data-step-key="__finish" data-step-type="finish">
              <div class="quiz-form">
                <div class="quiz-form__title">
                  <div class="quiz-form__title-marker">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="14px" viewBox="0 0 20 14"><path fill="currentColor" d="M19.982,2.683 L10.333,13.977 L10.0,13.587 L9.667,13.977 L0.20,2.683 L2.294,0.21 L10.1,9.43 L17.708,0.21 L19.982,2.683 Z"/></svg>
                  </div>
                  <div class="quiz-form__title-content">
                    <?php if (!empty($quiz['finish_title'])): ?>
                    <div class="quiz-form__title-text">
                      <?php echo wp_kses_post($quiz['finish_title']); ?>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($quiz['finish_desc'])): ?>
                    <div class="quiz-form__title-desc">
                      <?php echo wp_kses_post($quiz['finish_desc']); ?>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="quiz-form__feedback">
                  <div class="quiz-feedback">
                    <div class="quiz-feedback__phone">
                      <span class="wpcf7-form-control-wrap your-phone">
                        <input type="tel" name="your-phone" value="" class="quiz-feedback__input" placeholder="Телефон">
                      </span>
                    </div>
                    <div class="quiz-feedback__submit">
                      <button type="submit" class="landing-button">
                        <?php echo wp_kses_post($finish_button); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26px" height="26px" viewBox="0 0 26 26"><path fill="currentColor" d="M14.69,25.875 L23.857,25.875 C24.384,25.875 24.812,25.447 24.812,24.920 L24.812,16.614 L14.69,16.614 L14.69,25.875 ZM1.798,24.920 C1.798,25.447 2.226,25.875 2.754,25.875 L12.716,25.875 L12.716,16.614 L1.798,16.614 L1.798,24.920 ZM1.630,9.287 C1.103,9.287 0.675,9.715 0.675,10.242 L0.675,12.393 C0.675,12.921 1.103,13.348 1.630,13.348 L1.798,13.348 L1.798,15.261 L12.716,15.261 L12.716,9.287 L1.630,9.287 ZM21.831,1.834 C21.831,1.834 17.645,-3.992 13.547,6.6 C9.448,-3.992 5.262,1.834 5.262,1.834 C2.135,7.101 9.113,8.276 12.626,8.537 C12.618,8.561 12.610,8.585 12.602,8.610 C12.602,8.610 12.963,8.614 13.547,8.590 C14.131,8.614 14.491,8.610 14.491,8.610 C14.483,8.585 14.475,8.561 14.467,8.537 C17.980,8.276 24.958,7.101 21.831,1.834 ZM25.719,10.242 C25.719,9.715 25.292,9.287 24.764,9.287 L14.69,9.287 L14.69,15.261 L24.812,15.261 L24.812,13.346 C25.317,13.321 25.719,12.905 25.719,12.393 L25.719,10.242 ZM14.179,7.758 C17.563,1.423 18.681,4.193 18.681,4.193 C19.652,6.720 14.179,7.758 14.179,7.758 ZM8.413,4.193 C8.413,4.193 9.527,1.432 12.898,7.728 C12.895,7.736 12.892,7.745 12.889,7.753 C12.496,7.675 7.480,6.621 8.413,4.193 Z"/></svg>
                      </button>
                    </div>
                    <label class="quiz-feedback__rules">
                      <input type="checkbox" name="rules" value="1" class="form-checkbox">
                      <span></span>
                      <span>Прочитал(-а) <a href="https://rembrigada116.ru/polzovatelskoe-soglashenie" target="_blank">Пользовательское соглашение</a> и соглашаюсь с <a href="https://rembrigada116.ru/privacy-policy" target="_blank">Политикой обработки персональных данных</a></span>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="quiz-screens__item" data-quiz-screen data-step-key="__success" data-step-type="success">
              <div class="quiz-form">
                <div class="quiz-form__title">
                  <div class="quiz-form__title-marker">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 34 35"><path fill-rule="evenodd" fill="#fff" d="M18.407,34.625 L31.286,34.625 C31.980,34.625 32.542,34.62 32.542,33.368 L32.542,22.440 L18.407,22.440 L18.407,34.625 ZM2.261,33.368 C2.261,34.62 2.824,34.625 3.518,34.625 L16.626,34.625 L16.626,22.440 L2.261,22.440 L2.261,33.368 ZM2.40,12.799 C1.346,12.799 0.783,13.362 0.783,14.56 L0.783,16.886 C0.783,17.580 1.346,18.143 2.40,18.143 L2.261,18.143 L2.261,20.659 L16.626,20.659 L16.626,12.799 L2.40,12.799 ZM28.620,2.992 C28.620,2.992 23.112,-4.674 17.719,8.481 C12.327,-4.674 6.818,2.992 6.818,2.992 C2.704,9.922 11.886,11.468 16.509,11.811 C16.498,11.844 16.487,11.876 16.477,11.908 C16.477,11.908 16.951,11.914 17.719,11.882 C18.488,11.914 18.962,11.908 18.962,11.908 C18.951,11.876 18.941,11.844 18.930,11.811 C23.553,11.468 32.735,9.922 28.620,2.992 Z"/></svg>
                  </div>
                  <div class="quiz-form__title-content">
                    <div class="quiz-form__title-text">Заявка отправлена</div>
                    <div class="quiz-form__title-desc">Спасибо! Мы свяжемся с вами в ближайшее время.</div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="quiz-layout__info">
          <div class="quiz-info">
            <?php if (!empty($quiz['bonus_title'])): ?>
            <div class="quiz-info__title">
              <?php echo wp_kses_post($quiz['bonus_title']); ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($quiz['bonus_items'])): ?>
            <div class="quiz-info__items">
              <?php foreach ($quiz['bonus_items'] as $item): ?>
              <div class="quiz-info__item">
                <?php if (!empty($item['image'])): ?>
                <div class="quiz-info__item-icon">
                  <img src="<?php echo esc_url($item['image']); ?>" alt="" loading="lazy">
                </div>
                <?php endif; ?>
                <?php if (!empty($item['title'])): ?>
                <div class="quiz-info__item-title">
                  <?php echo wp_kses_post($item['title']); ?>
                </div>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
