<?php $data = get_field('masters', 'option'); ?>
<section class="content-masters">
  <div class="container">
    <?php if (!empty($data['title'])): ?>
    <div class="content-masters__title"><?php echo $data['title'] ?></div>
    <?php endif; ?>
    <div class="content-masters__grid">
      <?php foreach ($data['items'] as $item): ?>
      <div class="content-masters__cell">
        <div class="content-masters-item">
          <div class="content-masters-item__image">
            <?php if ($image = $item['image']): ?>
            <img src="<?php echo $image['sizes']['w468h364'] ?>" alt="" loading="lazy">
            <?php else: ?>
            <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
            <?php endif; ?>
          </div>
          <div class="content-masters-item__inner">
            <div class="content-masters-item__name"><?php echo $item['name'] ?></div>
            <div class="content-masters-item__specialization"><?php echo $item['specialization'] ?></div>
            <div class="content-masters-item__experience"><?php echo $item['experience'] ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
