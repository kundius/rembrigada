<?php $about_team = get_field('about-team', 'option'); ?>
<section class="landing-about-team">
  <div class="container container_medium">
    <?php if (!empty($about_team['title'])): ?>
    <div class="landing-about-team__title"><?php echo $about_team['title'] ?></div>
    <?php endif; ?>
    <div class="landing-about-team__items">
      <?php foreach ($about_team['items'] as $item): ?>
      <div class="about-team-item">
        <div class="about-team-item__body">
          <div class="about-team-item__title"><?php echo $item['title'] ?></div>
          <div class="about-team-item__description"><?php echo $item['description'] ?></div>
        </div>
        <div class="about-team-item__image">
          <?php if ($image = $item['image']): ?>
          <img src="<?php echo $image['url'] ?>" alt="" loading="lazy">
          <?php else: ?>
          <img src="https://via.placeholder.com/468x364" alt="" loading="lazy">
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
