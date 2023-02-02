<?php
/** @var BLOCK $attributes */
$id = esc_attr($attributes['id']);
$word = esc_html($attributes['word']);
$style = $attributes['style'];
$wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'wp-block-strategydeck-deck-card',
]);
?>

<div class="deck-card-container" id="<?= $id; ?>">
	<div <?= $wrapper_attributes; ?> style="color:<?= $style['color']['text']; ?>;background-color:<?= $style['color']['background']; ?>;">
		<label class="form-check-label" for="<?= $id; ?>-input">
			<?= $word; ?>
		</label>
		<input id="<?= $id; ?>-input" name="<?= $id; ?>-input" value="" type="checkbox">
	</div>
</div>

