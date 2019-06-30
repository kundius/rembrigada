<?php
$list = get_field('list');
echo '<div class="list-reasons">';
foreach ($list as $item) {
    echo '<div class="list-reasons__item">' . esc_html($item['text']) . '</div>';
}
echo '</div>';
