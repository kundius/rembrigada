<?php if ($list = get_field('content-price')): ?>
    <div class="content-price">
        <div class="content-price__tabs">
            <?php foreach($list as $key => $row): ?>
            <div class="content-price__tab">
                <?php echo $row['title'] ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="content-price__contents">
            <?php foreach($list as $key => $row): ?>
            <div class="content-price__content">
                <?php echo $row['content'] ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>