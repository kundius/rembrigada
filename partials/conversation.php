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

                <!-- Калькулятор дизайна -->
                <div class="conversion__item">
                  <div class="conversion__item-title">Калькулятор дизайна</div>
                  <div class="conversion__item-content">
                    <a class="conversion__item-btn conversion__item-btn--calculator-design" href="#">
                      <i class="fa fa-calculator-design"></i>
                    </a>
                  </div>
                </div>

                <!-- Калькулятор ремонта -->
                <div class="conversion__item">
                  <div class="conversion__item-title">Калькулятор ремонта</div>
                  <div class="conversion__item-content">
                    <a class="conversion__item-btn conversion__item-btn--calculator-renovation call-wqec" 
                        data-wqec-section-id="4928" 
                        href="#">
                      <i class="fa fa-calculator-renovation"></i>
                    </a>
                  </div>
                </div>

                <!-- Позвонить -->
                <div class="conversion__item">
                  <div class="conversion__item-title">
                    Позвонить нам 
                    <span>Ежедневно <br>9:00–20:00</span>
                  </div>
                  <div class="conversion__item-content">
                    <a class="conversion__item-btn conversion__item-btn--phone" 
                        href="tel:<?php echo $raw_phone ?>" 
                        title="Позвонить нам">
                      <span class="icon icon-phone"></span>
                    </a>
                  </div>
                </div>

                <!-- Обратный звонок -->
                <div class="conversion__item">
                  <div class="conversion__item-title">Заказать обратный <br>звонок</div>
                  <div class="conversion__item-content">
                    <a class="conversion__item-btn conversion__item-btn--phone-back b24-web-form-popup-btn-45 btn-loader" 
                        data-load="click" 
                        href="/contacts/" 
                        title="Обратный звонок">
                      <i class="fa fa-phone-back"></i>
                    </a>
                  </div>
                </div>

                <!-- Написать -->
                <div class="conversion__item">
                  <div class="conversion__item-title">
                    Написать нам 
                    <span>Email и Обратная связь</span>
                  </div>
                  <div class="conversion__item-content">
                    <a href="mailto:vira@eremont.ru?subject=Обращение с сайта eremont.ru.+7 (495) 357-11-67" 
                        class="conversion__item-btn conversion__item-btn--email" 
                        title="Написать нам">
                      <i class="fa fa-email"></i>
                    </a>
                    <a class="conversion__item-btn conversion__item-btn--form b24-web-form-popup-btn-27 btn-loader" 
                        data-load="click" 
                        href="/contacts/" 
                        title="Обратная связь">
                      <i class="fa fa-form"></i>
                    </a>
                  </div>
                </div>

                <!-- Чат -->
                <div class="conversion__item">
                  <div class="conversion__item-title">
                    Начать чат 
                    <span>Телеграм и WhatsApp</span>
                  </div>
                  <div class="conversion__item-content">
                    <a href="https://t.me/viraartstroy?text=Здравствуйте!..." 
                        class="conversion__item-btn conversion__item-btn--telegram" 
                        target="_blank" 
                        title="Написать в Телеграм">
                      <i class="fa fa-telegram"></i>
                    </a>
                    <a href="https://wa.me/74953571488?text=Здравствуйте!..." 
                        class="conversion__item-btn conversion__item-btn--whatsapp" 
                        target="_blank" 
                        title="Написать в WhatsApp">
                      <i class="fa fa-whatsapp"></i>
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