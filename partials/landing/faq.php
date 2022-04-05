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
      <button
        data-order
        data-order-title="<?php echo $faq['form']['title'] ?>"
        data-order-submit="<?php echo $faq['form']['submit'] ?>"
        data-order-subject="<?php echo $faq['title'] ?>"
        data-order-description="<?php echo $faq['form']['description'] ?>"
        data-order-success-title="<?php echo $faq['form']['success']['title'] ?>"
        data-order-success-description="<?php echo $faq['form']['success']['description'] ?>"
        data-order-with-message="true"
        class="landing-button<?php if ($faq['button']['glare']): ?> landing-button_glare<?php endif; ?>"
      ><?php echo $faq['button']['text'] ?></button>
    </div>
    <?php endif; ?>
  </div>
</section>
