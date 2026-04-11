<?php $global_faq = get_field('faq', 'option'); ?>
<?php $faq = get_field('content-faq'); ?>
<div class="wp-block-landing-faq">
  <section class="landing-faq">
    <div class="container container_medium">
      <?php if (!empty($global_faq['title'])): ?>
      <div class="landing-faq__title"><?php echo $global_faq['title'] ?></div>
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

      <?php if (!empty($global_faq['description'])): ?>
      <div class="landing-faq__description"><?php echo $global_faq['description'] ?></div>
      <?php endif; ?>

      <?php if (!empty($global_faq['button']['text'])): ?>
      <div class="landing-faq__request">
        <button
          data-order
          data-order-title="<?php echo $global_faq['form']['title'] ?>"
          data-order-submit="<?php echo $global_faq['form']['submit'] ?>"
          data-order-subject="<?php echo $global_faq['title'] ?>"
          data-order-description="<?php echo $global_faq['form']['description'] ?>"
          data-order-success-title="<?php echo $global_faq['form']['success']['title'] ?>"
          data-order-success-description="<?php echo $global_faq['form']['success']['description'] ?>"
          data-order-with-message="true"
          class="landing-button<?php if ($global_faq['button']['glare']): ?> landing-button_glare<?php endif; ?>"
        ><?php echo $global_faq['button']['text'] ?></button>
      </div>
      <?php endif; ?>
    </div>
  </section>
</div>