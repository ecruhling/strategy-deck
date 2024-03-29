<div id="app">
	<style>
	body > #error {
	  display: none !important;
	}
  .visually-hidden,
  .visually-hidden-focusable:not(:focus):not(:focus-within) {
	position: absolute !important;
	width: 1px !important;
	height: 1px !important;
	padding: 0 !important;
	margin: -1px !important;
	overflow: hidden !important;
	clip: rect(0, 0, 0, 0) !important;
	white-space: nowrap !important;
	border: 0 !important;
  }
	</style>
	<article <?php post_class( 'container-fluid d-flex flex-wrap align-content-between justify-content-center' ); ?>>
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
						<button class="btn btn-deck pb-1" id="deck-reset" data-html2canvas-ignore>RESET</button>
						<button class="btn btn-deck p-0 m-0" id="deck-print" data-html2canvas-ignore data-title="<?= sanitize_title(get_the_title()); ?>">
							<span class="visually-hidden">DOWNLOAD</span>
						</button>
					</div>
				</div>
			</div>
		</div>
		<form class="row d-flex px-0 flex-1-1-100 mx-0 justify-content-center align-items-center form-check py-3" id="deck-form">
			<?php the_content(); ?>
		</form>
		<div class="row flex-1-1-100 px-md-3 px-lg-4 pb-3">
			<div class="col-md-6">
				<a class="logo-resource--strategy-deck d-block" href="/">
				<span class="visually-hidden">
					Resource
				</span>
				</a>
			</div>
		</div>
	</article>
</div>
