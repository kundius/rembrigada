<?php if ($list = get_field('repair_types', 'option')): ?>
<div class="content-repair-types">
  <?php foreach ($list as $item): ?>
  <div class="content-repair-types__cell">
    <div class="content-repair-types-item">
      <?php if ($item['image']): ?>
      <div class="content-repair-types-item__image">
        <img src="<?php echo $item['image']['sizes']['w800h600'] ?>" alt="">
      </div>
      <?php endif; ?>

      <div class="content-repair-types-item__headline">
        <?php if ($item['title']): ?>
        <div class="content-repair-types-item__headline-title">
          <?php echo $item['title'] ?>
        </div>
        <?php endif; ?>

        <?php if ($item['title_desc']): ?>
        <div class="content-repair-types-item__headline-desc">
          <?php echo $item['title_desc'] ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="content-repair-types-item__body">
        <div class="content-repair-types-item__price">
          <?php if ($item['price_title']): ?>
          <div class="content-repair-types-item__price-label">
            <?php echo $item['price_title'] ?>
          </div>
          <?php endif; ?>

          <?php if ($item['price']): ?>
          <div class="content-repair-types-item__price-value">
            <?php echo $item['price'] ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="content-repair-types-item__content">
          <?php if ($item['content_title']): ?>
          <div class="content-repair-types-item__content-label">
            <?php echo $item['content_title'] ?>
          </div>
          <?php endif; ?>

          <?php if ($item['content']): ?>
          <div class="content-repair-types-item__content-value">
            <div class="content-repair-types-item__collapse">
              <div class="content-repair-types-item__collapse-wrap">
                <div class="content-repair-types-item__collapse-content">
                  <?php echo $item['content'] ?>
                </div>
              </div>
              <div class="content-repair-types-item__collapse-toggle">
                <button class="content-repair-types-item__collapse-toggle-button">
                  <span>Смотреть весь список</span>
                  <span>Свернуть список</span>
                </button>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>

        <div class="content-repair-types-item__order">
          <button data-basiclightbox="#callback" class="content-repair-types-item__order-button">Заказать замер</button>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>
