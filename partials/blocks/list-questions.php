<?php
$list = get_field('list');
echo '<div class="list-questions">';
foreach ($list as $item) {
	echo '<div class="list-questions__item">';
	echo '<div class="list-questions__question">' . esc_html($item['question']) . '</div>';
	echo '<div class="list-questions__answer">' . esc_html($item['answer']) . '</div>';
	echo '</div>';
}
echo '</div>';
