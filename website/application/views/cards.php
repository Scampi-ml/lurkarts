<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
	<div class="container pt-5">
		<div class="position-relative d-flex text-center my-0 py-1">
			<h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Cards</h2>
			<p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0"><?= $total_rows ?> Cards<span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span> </p>
		</div>
	</div>
    <div class="container">
		<div class="row g-5"> 
			<aside class="col-lg-4 col-xl-3"> 
				<div class="shadow-sm rounded mb-4">
					<h4 class="text-5 text-white fw-400">Streamers</h4>
					<hr class="border-secondary opacity-75">
					<ul class="list-item list-item-dark">
						<?php foreach($streamers as $streamer) { ?>
						<li>
							<a href="<?= site_url('cards/?streamer='.$streamer->name) ?>">
							<?php if(isset($current_user) && $current_user == $streamer->name){?>
								&nbsp;&nbsp;<b><u><?= $streamer->display_name ?></u></b>
							<?php } else { ?>
								<?= $streamer->display_name ?>
							<?php } ?>
							</a>
						</li>
						<?php } ?>
						<li><a href="<?= site_url('cards') ?>">All Streamers</a></li>						
					</ul>
				</div>
				<div class="shadow-sm rounded mb-4">
					<h4 class="text-5 text-white fw-400">Rarity</h4>
					<hr class="border-secondary opacity-75">
					<ul class="list-item list-item-dark">
						<?php foreach($rarities as $rarity) { ?>
						<li>
							<a href="<?= site_url('cards/?rarity='.$rarity) ?>">
							<?php if(isset($current_rarity) && $current_rarity == $rarity){?>
								&nbsp;&nbsp;<b><u><?= ucfirst($rarity) ?></u></b>
							<?php } else { ?>
								<?= ucfirst($rarity) ?>
							<?php } ?>
							</a>
						</li>
						<?php } ?>
						<li><a href="<?= site_url('cards') ?>">Any Rarity</a></li>
					</ul>
				</div>
			</aside>
			<div class="col-lg-9">
				<div class="row g-4">
					<?php if(isset($cards) && !empty($cards)){ ?>
					<?php foreach($cards as $card){ ?>
					<div class="col-sm-6 col-md-4">
						<div class="position-relative bg-dark-2 shadow rounded-4"> 
							<?php if($card->external != NULL) { ?>
							<img class="img-fluid d-flex rounded-4 rounded-bottom-0" src="<?= $card->external ?>" alt="">
							<?php } else { ?>
							<img class="img-fluid d-flex rounded-4 rounded-bottom-0" src="<?= base_url('assets/cards_by_id/'.$card->id.'.gif') ?>" alt="">
							<?php } ?>						
							<div class="p-4">
								<div class="d-flex align-items-center"> 
									<a href="<?= site_url('cards/view/'.urlencode($card->card_name)) ?>" class="overflow-hidden stretched-link me-2">
										<h4 class="text-3 link-light text-truncate mb-0"><?= $card->card_name; ?></h4>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php } else {  ?>
						No cards found
					<?php } ?>
				</div>
				<?php if(isset($pagination_links) && !empty($pagination_links)){ ?>
					<?= $pagination_links ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>