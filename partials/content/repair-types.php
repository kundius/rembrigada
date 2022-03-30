<?php if ($list = get_field('repair_types', 'option')): ?>
<div class="content-repair-types">
  <?php foreach ($list as $item): ?>
  <div class="content-repair-types__cell">
    <div class="content-repair-type">
      <?php if ($item['image']): ?>
      <div class="content-repair-type__image">
        <img src="<?php echo $item['image']['sizes']['w800h600'] ?>" alt="">
      </div>
      <?php endif; ?>

      <div class="content-repair-type__headline">
        <?php if ($item['title']): ?>
        <div class="content-repair-type__headline-title">
          <?php echo $item['title'] ?>
        </div>
        <?php endif; ?>

        <?php if ($item['title_desc']): ?>
        <div class="content-repair-type__headline-desc">
          <?php echo $item['title_desc'] ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="content-repair-type__body">
        <div class="content-repair-type__price">
          <?php if ($item['price_title']): ?>
          <div class="content-repair-type__price-label">
            <?php echo $item['price_title'] ?>
          </div>
          <?php endif; ?>

          <?php if ($item['price']): ?>
          <div class="content-repair-type__price-value">
            <?php echo $item['price'] ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="content-repair-type__content">
          <?php if ($item['content_title']): ?>
          <div class="content-repair-type__content-label">
            <?php echo $item['content_title'] ?>
          </div>
          <?php endif; ?>

          <?php if ($item['content']): ?>
          <div class="content-repair-type__content-value">
            <div class="content-repair-type__collapse">
              <div class="content-repair-type__collapse-wrap">
                <div class="content-repair-type__collapse-content">
                  <?php echo $item['content'] ?>
                </div>
              </div>
              <div class="content-repair-type__collapse-toggle">
                <button>
                  <span>Смотреть весь список</span>
                  <span>Свернуть список</span>
                </button>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>

        <div class="content-repair-type__order">
          <button data-basiclightbox="#callback" class="content-repair-type__order-button">Заказать замер</button>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>