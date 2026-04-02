<?php $raw_phone = preg_replace("/[ \(\)\-]/", "", get_field('phone', 'options')) ?>

<div class="conversion" data-conversion>
  
  <!-- Контейнер виджета -->
  <div class="conversion__container">
    <div class="conversion__content">
      <div class="conversion__content-inner">
        <div class="conversion__content-scroller">
          <div class="conversion__content-container">
            <div class="conversion__content-container-inner">
              <div class="conversion__grid">

                <!-- Позвонить -->
                <!-- <div class="conversion__item">
                  <div class="conversion__item-title">
                    Позвонить нам 
                    <span>Ежедневно <br>9:00–20:00</span>
                  </div>
                  <div class="conversion__item-content">
                    <a class="conversion__item-btn conversion__item-btn--phone-call" 
                        href="tel:<?php echo $raw_phone ?>" 
                        title="Позвонить нам">
                      <span class="icon icon-phone"></span>
                    </a>
                  </div>
                </div> -->

                <!-- Обратный звонок -->
                <div class="conversion__item">
                  <div class="conversion__item-title">Заказать обратный <br>звонок</div>
                  <div class="conversion__item-content">
                    <a class="conversion__item-btn conversion__item-btn--phone-back" 
                        data-load="click" 
                        href="#callback" 
                        title="Обратный звонок">
                      <span class="icon icon-phone"></span>
                    </a>
                  </div>
                </div>

                <!-- Калькулятор ремонта -->
                <div class="conversion__item">
                  <div class="conversion__item-title">Цены</div>
                  <div class="conversion__item-content">
                    <a class="conversion__item-btn conversion__item-btn--calc" 
                        href="/price">
                      <span class="icon icon-calc"></span>
                    </a>
                  </div>
                </div>

                <!-- Чат -->
                <div class="conversion__item conversion__item--wide">
                  <div class="conversion__item-title">
                    Начать чат 
                    <span>MAX, VK, Телеграм и WhatsApp</span>
                  </div>
                  <div class="conversion__item-content">
                    <a href="<?php echo esc_html(get_field('max_link', 'options')) ?>" 
                        class="conversion__item-btn conversion__item-btn--max" 
                        target="_blank" 
                        title="Написать в MAX">
                      <span class="icon icon-max"></span>
                    </a>
                    <a href="<?php echo esc_html(get_field('telegram_link', 'options')) ?>" 
                        class="conversion__item-btn conversion__item-btn--telegram" 
                        target="_blank" 
                        title="Написать в Телеграм">
                      <span class="icon icon-telegram"></span>
                    </a>
                    <a href="<?php echo esc_html(get_field('whatsapp_link', 'options')) ?>" 
                        class="conversion__item-btn conversion__item-btn--whatsapp" 
                        target="_blank" 
                        title="Написать в WhatsApp">
                      <span class="icon icon-whatsapp"></span>
                    </a>
                    <a href="<?php echo esc_html(get_field('vk_link', 'options')) ?>" 
                        class="conversion__item-btn conversion__item-btn--vk" 
                        target="_blank" 
                        title="Написать в VK">
                      <span class="icon icon-vk"></span>
                    </a>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="conversion__content-backdrop"></div>
    </div>
    <div class="conversion__backdrop" data-conversion-backdrop></div>
  </div>

  <!-- Кнопка-триггер -->
  <button class="conversion__btn" data-conversion-btn type="button">
    <div class="conversion__btn-wave"></div>

    <span class="conversion__btn-icon" data-conversion-btn-icon="phone">
      <span class="icon icon-phone"></span>
    </span>

    <span class="conversion__btn-icon" data-conversion-btn-icon="max">
      <span class="icon icon-max"></span>
    </span>

    <span class="conversion__btn-icon" data-conversion-btn-icon="telegram">
      <span class="icon icon-telegram"></span>
    </span>

    <span class="conversion__btn-icon" data-conversion-btn-icon="whatsapp">
      <span class="icon icon-whatsapp"></span>
    </span>

    <span class="conversion__btn-icon" data-conversion-btn-icon="vk">
      <span class="icon icon-vk"></span>
    </span>

    <span class="conversion__btn-icon" data-conversion-btn-icon="email">
      <span class="icon icon-email"></span>
    </span>

    <span class="conversion__btn-close">
      <span class="icon icon-close"></span>
    </span>
  </button>

</div>