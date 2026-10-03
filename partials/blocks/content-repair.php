<?php
/**
 * Стоимость ремонта (ACF-блок acf/repair-cost).
 * Источник посекционный: repair_override = ['list'] — список из вставки,
 * иначе — общие опции (группа repair). Вёрстка как у старого partials/content/repair.
 */
$list = function_exists('rembrigada_get_repair_data') ? rembrigada_get_repair_data() : array();
if (empty($list)) {
    return;
}
?>
<div class="content-repair">
  <div class="content-repair__grid">
    <?php foreach ($list as $item): ?>
    <?php if (!is_array($item)) continue; ?>
    <div class="content-repair__cell">
      <div class="content-repair-item">
        <div class="content-repair-item__image">
          <?php if (!empty($item['image'])): ?>
          <?php $image = is_array($item['image']) ? $item['image'] : array(); ?>
          <img src="<?php echo esc_url(!empty($image['sizes']['w468h364']) ? $image['sizes']['w468h364'] : (!empty($image['url']) ? $image['url'] : '')); ?>" alt="" loading="lazy">
          <?php else: ?>
          <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
          <?php endif; ?>
          <div class="content-repair-item__labels">
            <div class="content-repair-item__term"><?php echo isset($item['term']) ? wp_kses_post($item['term']) : ''; ?></div>
          </div>
        </div>
        <div class="content-repair-item__inner">
          <div class="content-repair-item__title">
            <?php if (!empty($item['button']['link'])): ?>
            <a href="<?php echo esc_url($item['button']['link']); ?>">
            <?php endif; ?>
            <?php echo isset($item['name']) ? wp_kses_post($item['name']) : ''; ?>
            <?php if (!empty($item['button']['link'])): ?>
            </a>
            <?php endif; ?>
          </div>
          <div class="content-repair-item__description"><?php echo isset($item['description']) ? wp_kses_post($item['description']) : ''; ?></div>
          <div class="content-repair-item__price"><?php echo isset($item['price']) ? wp_kses_post($item['price']) : ''; ?></div>
          <?php if (!empty($item['button']['text'])): ?>
          <a href="<?php echo esc_url(!empty($item['button']['link']) ? $item['button']['link'] : '#'); ?>" class="content-repair-item__button">
            <?php echo wp_kses_post($item['button']['text']); ?>
          </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
