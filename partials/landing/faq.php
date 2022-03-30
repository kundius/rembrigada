<?php $faq = get_field('faq', 'option'); ?>
<section class="landing-faq">
  <div class="container container_medium">
    <?php if (!empty($faq['title'])): ?>
    <div class="landing-faq__title"><?php echo $faq['title'] ?></div>
    <?php endif; ?>

    <div class="landing-faq__list faq-items">
      <?php foreach ($faq['items'] as $item): ?>
      <div class="faq-item">
        <div class="faq-item__question">
          <div class="faq-item__question-content">
            <?php echo $item['question'] ?>
          </div>
        </div>
        <div class="faq-item__answer">
          <div class="faq-item__answer-content">
            <?php echo $item['answer'] ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if (!empty($faq['description'])): ?>
    <div class="landing-faq__description"><?php echo $faq['description'] ?></div>
    <?php endif; ?>

    <?php if (!empty($faq['request'])): ?>
    <div class="landing-faq__request">
      <button class="landing-button"><?php echo $faq['request'] ?></button>
    </div>
    <?php endif; ?>
  </div>
</section>
