<section class="intro-advantages">
  <div class="container">
    <div class="intro-advantages__list">
      <?php foreach (get_field('advantages', 'options') as $advantage): ?>
      <div class="intro-advantages__cell">
        <div class="intro-advantage">
          <div class="intro-advantage__image">
            <img src="<?php echo $advantage['image']['url'] ?>" alt="" loading="lazy">
          </div>
          <div class="intro-advantage__title">
            <?php echo $advantage['title'] ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
