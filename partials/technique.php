<div class="technique">
    <div class="container">
        <?php if ($title = get_field('technique_title')): ?>
        <div class="technique__title"><?php echo $title ?></div>
        <?php endif; ?>

        <?php if ($text = get_field('technique_text')): ?>
        <div class="technique__text"><?php echo $text ?></div>
        <?php endif; ?>

        <?php if ($list = get_field('technique_list')): ?>
        <div class="technique__items">
          <div class="technique__grid">
              <?php foreach($list as $item): ?>
            <div class="technique__cell">
                <div class="techniques__item"><?php echo $item['text'] ?></div>
            </div>
              <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
    </div>
</div>
