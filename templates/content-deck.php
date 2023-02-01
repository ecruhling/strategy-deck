<article <?php post_class( 'container-fluid d-flex flex-wrap align-content-between' ); ?>>
	<div class="row flex-1-1-100 align-items-center px-md-3 px-lg-4 py-md-2" id="deck-header">
		<div class="col-md-6 pt-3 pb-md-3">
			<h1 class="mb-0"><?= get_the_title(); ?></h1>
		</div>
		<div class="col-md-6 pt-3 pb-md-3">
			<div class="row align-items-center">
				<div class="col-md-9">
					<p class="mb-0">Select the adjectives that best describe the project.</p>
				</div>
				<div class="col-md-3 text-md-end">
					<button class="deck-reset">RESET</button>
				</div>
			</div>
		</div>
	</div>
	<form class="row d-flex px-0 flex-1-1-100 mx-0 justify-content-center align-items-center form-check">
		<?php the_content(); ?>
		<button type="submit">Submit</button>
	</form>
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
