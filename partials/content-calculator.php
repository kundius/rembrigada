<form action="/wp-json/contact-form-7/v1/contact-forms/1752/feedback" id="intro-calc" method="post" class="intro-calc js-intro-calc js-form">
    <input name="price" type="hidden" value="">
    <div class="intro-calc__title">
        Узнайте стоимость ремонта сейчас:
    </div>
    <div class="intro-calc__layout">
        <div class="intro-calc__row-object">
            <div class="intro-calc__label">Что ремонтируем?</div>
            <select name="object" class="js-selectys">
                <option value="apartment">Квартира</option>
                <option value="cottage">Коттедж</option>
                <option value="office">Офис</option>
                <option value="bathroom">Ванная "под ключ"</option>
                <option value="kitchen">Кухня</option>
            </select>
        </div>
        <div class="intro-calc__row-type">
            <div class="intro-calc__label">Вид ремонта:</div>
            <div class="intro-calc__types">
                <label class="intro-calc__type">
                    <input type="radio" name="type" value="cosmetic" checked />
                    <span>
                        <span></span>
                        Косметический
                    </span>
                </label>
                <label class="intro-calc__type">
                    <input type="radio" name="type" value="capital" />
                    <span>
                        <span></span>
                        Капитальный
                    </span>
                </label>
                <label class="intro-calc__type">
                    <input type="radio" name="type" value="european" />
                    <span>
                        <span></span>
                        Евроремонт
                    </span>
                </label>
            </div>
        </div>
        <div class="intro-calc__row-area">
            <div class="intro-calc__label">Площадь <span>(м<sup>2</sup>)</span></div>
            <input class="js-rangeys" type="range" name="area" min="0" max="250" value="0" />
        </div>
        <div class="intro-calc__row-price">
            <div class="intro-calc__price">
                <div class="intro-calc__price-label">
                    Итого:
                </div>
                <div class="intro-calc__price-value">
                    <span class="js-intro-calc-price"></span> ₽
                </div>
            </div>
        </div>
        <div class="intro-calc__row-phone">
            <div class="intro-calc__label-alt">Введите телефон</div>
            <span class="wpcf7-form-control-wrap your-phone">
                <input class="intro-calc__phone" name="your-phone" type="text" placeholder="+7" value="">
            </span>
        </div>
        <div class="intro-calc__row-submit">
            <button type="submit" class="intro-calc__submit btn-arrow">
                Получить смету
            </button>
        </div>
    </div>
</form>
