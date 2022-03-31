<?php $like_work = get_field('like-work', 'option'); ?>
<section class="landing-like-work">
  <div class="container container_medium">
    <?php if (!empty($like_work['title'])): ?>
    <div class="landing-like-work__title"><?php echo $like_work['title'] ?></div>
    <?php endif; ?>

    <div class="landing-like-work__grid">
      <?php foreach ($like_work['items'] as $like_work_item): ?>
      <div class="landing-like-work__cell">
        <div class="like-work-item">
          <div class="like-work-item__body">
            <?php if (!empty($like_work_item['title'])): ?>
            <div class="like-work-item__title">
              <?php echo $like_work_item['title'] ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($like_work_item['description'])): ?>
            <div class="like-work-item__desc">
              <?php echo $like_work_item['description'] ?>
            </div>
            <?php endif; ?>
          </div>
          <div class="like-work-item__image">
              <?php if ($image = $like_work_item['image']): ?>
              <img src="<?php echo $image['sizes']['w468h364'] ?>" alt="" loading="lazy">
              <?php else: ?>
              <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
              <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
