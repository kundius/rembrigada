<?php $promlems = get_field('problems', 'option'); ?>
<section class="landing-problems">
  <div class="container">
    <div class="landing-problems__title"><?php echo $promlems['title'] ?></div>

    <div class="landing-problems__grid">
      <?php foreach ($promlems['items'] as $problem): ?>
      <div class="landing-problems__cell">
        <div class="landing-problem">
          <div class="landing-problem__image">
              <?php if ($image = $problem['image']): ?>
              <img src="<?php echo $image['sizes']['w468h364'] ?>" alt="" loading="lazy">
              <?php else: ?>
              <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
              <?php endif; ?>
          </div>
          <div class="landing-problem__title">
            <?php echo $problem['title'] ?>
          </div>
          <div class="landing-problem__desc">
            <?php echo $problem['desc'] ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="landing-problems__description"><?php echo $promlems['description'] ?></div>

    <div class="landing-problems__request">
      <button data-basiclightbox="#callback" class="landing-button"><?php echo $promlems['request'] ?></button>
    </div>
  </div>
</section>
