<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
    <div class="container pt-5">
        <div class="position-relative d-flex text-center my-4 py-4">
            <h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Latest</h2>
            <p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Latest <span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span>
            </p>
        </div>
    </div>
    <div class="container">
	<?php if( ! $latest_actions){ ?>
			<div class="section min-vh-100 d-flex">
				<div class="container text-center my-auto pt-5">
					<h3 class="text-6 text-light mb-3">Oops! no data found!</h3>
					<button onclick="history.back()" class="btn btn-outline-light rounded-pill m-2">Back</button > 
				</div>
			</div>
	<?php } else { ?>
			<div class="row border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<table class="table-responsive table-borderless text-white">
					<tbody>
						<?php foreach($latest_actions as $action) { ?>
						<tr>	
							<td>
								<?php if ($action['type'] == 'raffles') { ?>
									[  <?= utc($action['created_at']) ?> ] => <a href="<?= site_url('streamers/'.strtolower($action['display_name'])) ?>"><?= $action['display_name'] ?></a> had a <a href="<?= site_url('raffles/detail/'.$action['raffle_id']) ?>">raffle</a>.
								<?php } else if ($action['type'] == 'raffle_winners') { ?>
									[  <?= utc($action['created_at']) ?> ] => <a href="https://www.twitch.tv/<?= $action['user'] ?> "><?= ucfirst($action['user']) ?></a> has won the raffle by <a href="<?= site_url('streamers/'.strtolower($action['display_name'])) ?>"><?= $action['display_name'] ?></a> with <a href="<?= site_url('cards/view/'.urlencode($action['card_name'])) ?>"><?= $action['card_name'] ?></a>.
								<?php } else if ($action['type'] == 'raffle_rejects') { ?>
									[  <?= utc($action['created_at']) ?> ] => <a href="https://www.twitch.tv/<?= $action['user'] ?> "><?= ucfirst($action['user']) ?></a> was late to the raffle at <a href="<?= site_url('streamers/'.strtolower($action['display_name'])) ?>"><?= $action['display_name'] ?></a>.
								<?php } else { ?>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
	<?php } ?>
    </div>
</div>