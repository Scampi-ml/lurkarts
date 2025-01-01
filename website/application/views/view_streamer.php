<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
	<div class="section mt-5 pb-0">
		<div class="container pt-5">
			<div class="row g-5"> 
				<div class="col-lg-6 text-center"><img class="img-fluid rounded-5" src="<?= base_url('assets/images/streamers/'.$streamer->id.'.webp') ?>" alt=""></div>
				<div class="col-lg-6 text-center text-lg-start">
					<h2 class="text-10 text-white fw-600 mb-4"><?= $streamer->display_name ?></h2>
					<p class="text-white fw-500 mb-1">
						<a href="https://www.twitch.tv/<?= $streamer->name; ?>">twitch.tv/<?= $streamer->display_name; ?></a>
					</p>
					<br>
					<table class="table table-borderless text-white">
						<tbody>
							<tr>
								<td>Raffles</td>
								<td><a href="<?= site_url('raffles/streamer/'.$streamer->name) ?>"><i class="far fa-chart-bar"></i></a>&nbsp;&nbsp;&nbsp;<?= $count_raffles_by_streamer_id; ?></td>
							</tr>
							<tr>
								<td>Raffle Winners</td>
								<td><a href="<?= site_url('raffles/winners/'.$streamer->name) ?>"><i class="far fa-chart-bar"></i></a>&nbsp;&nbsp;&nbsp;<?= $count_raffle_wins_by_streamer_id; ?></td>
							</tr>
							<tr>
								<td>Raffle Rejects</td>
								<td><a href="<?= site_url('raffles/rejects/'.$streamer->name) ?>"><i class="far fa-chart-bar"></i></a>&nbsp;&nbsp;&nbsp;<?= $count_raffle_rejects_by_streamer_id; ?></td>
							</tr>
							<tr>
								<td >Raffle Users</td>
								<td><a href="<?= site_url('raffles/users/'.$streamer->name) ?>"><i class="far fa-chart-bar"></i></a>&nbsp;&nbsp;&nbsp;<?= $count_raffle_users_by_streamer_id; ?></td>
							</tr>									
						</tbody>
					</table>
					<br>
					<br>
					<div class="d-grid"><a class="btn btn-primary btn-lg rounded-pill" href="<?= site_url('cards/?streamer='.$streamer->name) ?>">View Cards</a></div>
				</div>
			</div>
		</div>
	</div>
</div>