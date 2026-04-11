<?php $global_faq = get_field('faq', 'option'); ?>
<?php $faq = get_field('content-faq'); ?>

<?php $title = $faq['title'] ?: $global_faq['title']; ?>
<?php $items = $faq['items'] ?: $global_faq['items']; ?>
<?php $description = $faq['description'] ?: $global_faq['description']; ?>
<?php $button = $faq['button'] ?: $global_faq['button']; ?>
<?php $form = $faq['form'] ?: $global_faq['form']; ?>

<div class="wp-block-landing-faq">
  <section class="landing-faq">
    <div class="container container_medium">
      <?php if (!empty($title)): ?>
      <div class="landing-faq__title"><?php echo $title ?></div>
      <?php endif; ?>

      <div class="landing-faq__list faq-items">
        <?php foreach ($items as $item): ?>
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

      <?php if (!empty($description)): ?>
      <div class="landing-faq__description"><?php echo $description ?></div>
      <?php endif; ?>

      <?php if (!empty($button['text'])): ?>
      <div class="landing-faq__request">
        <button
          data-order
          data-order-title="<?php echo $form['title'] ?>"
          data-order-submit="<?php echo $form['submit'] ?>"
          data-order-subject="<?php echo $faq['title'] ?>"
          data-order-description="<?php echo $form['description'] ?>"
          data-order-success-title="<?php echo $form['success']['title'] ?>"
          data-order-success-description="<?php echo $form['success']['description'] ?>"
          data-order-with-message="true"
          class="landing-button<?php if ($button['glare']): ?> landing-button_glare<?php endif; ?>"
        ><?php echo $button['text'] ?></button>
      </div>
      <?php endif; ?>
    </div>
  </section>
</div>