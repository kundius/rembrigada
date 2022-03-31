<?php if ($scheme = get_field('scheme', 'option')): ?>
<div class="content-scheme">
  <?php foreach ($scheme['items'] as $item): ?>
  <div class="content-scheme__cell">
    <div class="content-scheme-item">
      <?php if ($item['image']): ?>
      <div class="content-scheme-item__image">
        <img src="<?php echo $item['image']['url'] ?>" alt="">
      </div>
      <?php endif; ?>

      <?php if ($item['title']): ?>
      <div class="content-scheme-item__title">
        <?php echo $item['title'] ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php endif; ?>
