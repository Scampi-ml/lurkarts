<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
	<section id="team" class="section">
		<div class="container"> 
			<div class="position-relative d-flex text-center mb-5">
				<h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Streamers</h2>
				<p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Streamers<span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span> </p>
			</div>
			<div class="row g-4">
				<?php foreach($streamers as $streamer) { ?>
					<div class="col-sm-6 col-lg-3">
						<div class="team bg-dark rounded-4 d-inline-block text-center">
							<a href="<?= site_url('streamers/'.$streamer->name) ?>">
								<img class="img-fluid rounded-4" alt="" src="<?= base_url('assets/images/streamers/'.$streamer->id.'.webp') ?>">
								<h3 class="text-white"><?= $streamer->display_name ?></h3>
							</a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
</div>