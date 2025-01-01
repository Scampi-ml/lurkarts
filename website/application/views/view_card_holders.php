<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if( ! $card_holders_by_winner_name){ ?>
<div id="content" role="main">
	<div class="section min-vh-100 d-flex">
		<div class="container text-center my-auto pt-5">
			<h3 class="text-6 text-light mb-3">Oops! no card holders found!</h3>
			<button onclick="history.back()" class="btn btn-outline-light rounded-pill m-2">Back</button > 
		</div>
	</div>
</div>
<?php } else { ?>
	<div id="content" role="main">
		<section id="about" class="section">
			<div class="container">
				<div class="position-relative d-flex text-center mb-5">
					<h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Card Holders</h2>
					<p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Card holders for <?= ucfirst($card->card_name) ?> <span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span></p>
				</div>
				<div class="row text-center">
					<table class="table-responsive table-borderless text-white">
						<tbody>
							<?php foreach($card_holders_by_winner_name as $key => $val) { ?>
								<tr>
									<td><?= $val ?>x <a href="https://www.twitch.tv/<?= $key; ?>"><?= ucfirst($key) ?></a></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
<?php } ?>