<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
	<div class="section mt-5 pb-0">
		<div class="container pt-5">
			<div class="row g-5"> 
				<div class="col-lg-6 text-center">
					<?php if($card->external != NULL) { ?>
					<img class="img-fluid rounded-5" src="<?= $card->external ?>" alt="external">
					<?php } else { ?>
					<img class="img-fluid rounded-5" src="<?= base_url('assets/cards_by_id/'.$card->id.'.gif') ?>" alt="">
					<?php } ?>
				</div>
				<div class="col-lg-6 text-center text-lg-start">
					<h2 class="text-10 text-white fw-600 mb-4"><?= $card->card_name ?></h2>
					<p class="text-white fw-500 mb-1">
						<span class="text-light fw-normal">Streamer :</span> <a href="<?= site_url('streamers/'.$streamer->name) ?>"><?= $streamer->display_name ?></a>
					</p>
					<br>
					<table class="table table-borderless text-white">
						<tbody>
							<tr>
								<td>Rarity</td>
								<td><?= ucfirst($card->rarity) ?></td>
							</tr>
							<tr>
								<td>Card Holders</td>
								<td><a href="<?= site_url('cards/holders/'.urlencode($card->card_name)) ?>"><i class="far fa-chart-bar"></i></a>&nbsp;&nbsp;&nbsp;<?= $count_cards_by_winner_name; ?></td>
							</tr>
							<tr>
								<td>Last Winner</td>
								<td>
									<?php if( ! $get_last_winner_by_card_name){?>
										N/A
									<?php } else { ?>
										<a href="https://www.twitch.tv/<?= $get_last_winner_by_card_name->user; ?>"><?= ucfirst($get_last_winner_by_card_name->user) ?></a>
									<?php } ?>
								</td>
							</tr>								
						</tbody>
					</table>
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>