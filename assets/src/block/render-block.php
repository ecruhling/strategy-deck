<?php
/** @var BLOCK $attributes */
$id = esc_attr($attributes['id']);
$post_id = esc_attr(get_the_ID());
$word = esc_html($attributes['word']);
$style = $attributes['style'];
$wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'wp-block-strategydeck-deck-card',
]);
?>

<div id="<?= $id; ?>" <?= $wrapper_attributes; ?>
		 style="color:<?= $style['color']['text']; ?>;background-color:<?= $style['color']['background']; ?>;"
		 data-id="<?= $id; ?>" data-post_id="<?= $post_id; ?>">
	<label class="form-check-label" for="<?= $id; ?>-input">
		<?= $word; ?>
	</label>
	<input id="<?= $id; ?>-input" name="<?= $id; ?>-input" type="checkbox">
</div>

