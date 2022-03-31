<section class="landing-measurement">
  <div class="container">
    <?php if ($title = get_field('measurement_title', 'option')): ?>
    <div class="landing-measurement__title">
      <span><?php echo $title ?></span>
    </div>
    <?php endif; ?>
    <?php if ($request = get_field('measurement_request', 'option')): ?>
    <div class="landing-measurement__request">
      <button data-basiclightbox="#callback" class="landing-button">
        <?php echo $request ?>
      </button>
    </div>
    <?php endif; ?>
</section>
