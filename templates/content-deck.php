<article <?php post_class('container-fluid py-2 d-flex flex-wrap align-content-between'); ?>>
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
	<div class="row flex-1-1-100">
		<div class="col-12">
			<?php the_content(); ?>
		</div>
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
