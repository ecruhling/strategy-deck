<?php
/** @var BLOCK $attributes */
$id = esc_attr($attributes['id']);
$post_id = esc_attr(get_the_ID());
$word = esc_html($attributes['word']);
$checked = $attributes['checked'];
$wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'wp-block-strategydeck-deck-card',
]);
?>

<div id="<?= $id; ?>" <?= $wrapper_attributes; ?>
		 data-id="<?= $id; ?>" data-post_id="<?= $post_id; ?>">
	<input data-checked="<?= json_encode($checked); ?>" id="<?= $id; ?>-input" name="<?= $id; ?>-input" type="checkbox" <?= $checked ? 'checked' : ''; ?>>
	<label class="form-check-label" for="<?= $id; ?>-input">
		<?= $word; ?>
	</label>
</div>

