<?php $about_team = get_field('about-team', 'option'); ?>
<section class="landing-about-team">
  <div class="container container_medium">
    <?php if (!empty($about_team['title'])): ?>
    <div class="landing-about-team__title"><?php echo $about_team['title'] ?></div>
    <?php endif; ?>
    <?php if (!empty($about_team['content'])): ?>
    <div class="landing-about-team__content"><?php echo $about_team['content'] ?></div>
    <?php endif; ?>
  </div>
</section>
