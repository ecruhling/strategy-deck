<article <?php post_class( 'container-fluid py-2 d-flex flex-wrap align-content-between' ); ?>>
	<div class="row flex-1-1-100">
		<div class="col-md-6 order-md-2">
			<div class="row">
				<div class="col-md-6">
					Select the adjectives that best describe the project.
				</div>
				<div class="col-md-6 text-md-end">
					<button class="deck-reset">RESET</button>
				</div>
			</div>
		</div>
		<div class="col-md-6 order-md-1">
			<h1><?= get_the_title(); ?></h1>
		</div>
	</div>
	<form class="row flex-1-1-100 mx-0 justify-content-center align-items-center form-check">
		<?php the_content(); ?>
	</form>
	<div class="form-check">
		<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
		<label class="form-check-label" for="flexCheckDefault">
			Default checkbox
		</label>
	</div>
	<div class="form-check">
		<label class="form-check-label" for="flexCheckChecked" id="test">
			Checked checkbox
		</label>
		<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
	</div>
	<div class="row flex-1-1-100">
		<div class="col-md-6">
			<a class="logo-resource--strategy-deck d-block" href="/">
				<span class="visually-hidden">
					Resource
				</span>
			</a>
		</div>
	</div>
</article>
