<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if( ! $get_raffle_from_raffle_id){ ?>
<div id="content" role="main">
	<div class="section min-vh-100 d-flex">
		<div class="container text-center my-auto pt-5">
			<h3 class="text-6 text-light mb-3">Oops! no raffle found!</h3>
			<button onclick="history.back()" class="btn btn-outline-light rounded-pill m-2">Back</button > 
		</div>
	</div>
</div>
<?php } else { ?>
	<div id="content" role="main">
		<section id="content" class="section">
			<div class="container">
				<div class="position-relative d-flex text-center mb-5">
					<h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Raffle</h2>
					<p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Raffle <span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span></p>
				</div>
			</div>
			<div class="container text-center my-auto pt-5">
				<?php if($get_raffle_from_raffle_id->raffle_stop === NULL) { ?>
					<h4 class="text-6 text-light mb-3">
						Raffle details for <?= $get_streamer_by_id->display_name ?>
						from <?= utc($get_raffle_from_raffle_id->raffle_start) ?>
					</h4>
					<br>
					<div class="hero-wrap p-3">
						<div class="hero-mask rounded-4 opacity-3 bg-dark"></div>
						<div class="hero-content">
							<div class="row g-0 text-center text-sm-start">
								<div class="col-12 col-sm">
									<p class="mb-2" style="color:red;">
										<b>NOTE:</b> The raffle did not end as expected.</i>
									</p>
								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<h4 class="text-6 text-light mb-3">
					Raffle details for <?= $get_streamer_by_id->display_name ?>  
					from <?= utc($get_raffle_from_raffle_id->raffle_start) ?> -> <?= utc($get_raffle_from_raffle_id->raffle_stop) ?>
					</h4>
				<?php } ?>
			</div>
		</section>
		<div class="container mb-5">
			<div class="row g-4">
				<div class="col-6 col-lg-6">
					<div class="hero-wrap py-3">
						<div class="hero-mask rounded-4 opacity-7 bg-dark"></div>
						<div class="hero-content text-center py-4 px-3">
							<h4 class="text-11 text-white fw-600 mb-0">
								<?= count($get_raffle_users_from_raffle_id) ?>
							</h4>
							<div class="text-4 text-light">
								<?php if(count($get_raffle_users_from_raffle_id) == 1 ){ ?>
									User joined
								<?php } else { ?>
									Users joined
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-6">
					<div class="hero-wrap py-3">
						<div class="hero-mask rounded-4 opacity-7 bg-dark"></div>
						<div class="hero-content text-center py-4 px-3">
							<h4 class="text-11 text-white fw-600 mb-0">
								<?= count($get_raffle_wins_from_raffle_id) ?>
							</h4>
							<div class="text-4 text-light">
								<?php if(count($get_raffle_wins_from_raffle_id) == 1 ){ ?>
									Winner
								<?php } else { ?>
									Winners
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if ( ! $get_raffle_wins_from_raffle_id) { ?>
			<div class="container text-center my-auto pt-5">
				<h4 class="text-6 text-light mb-3">No Winners</h4>
			</div>
		<?php } else { ?>
		<div class="container">
			<div class="col-lg-12">
				<?php if (isset($get_raffle_wins_from_raffle_id[0])) { ?>
				<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4 mb-4">
					<div class="row g-0">
						<div class="col-md-5">
						<?php if($get_raffle_wins_from_raffle_id[0]->external != NULL) { ?>
							<img class="rounded-4" style="max-width:20%;" src="<?= $get_raffle_wins_from_raffle_id[0]->external ?>" alt="external">
						<?php } else { ?>
							<img class="rounded-4" style="max-width:20%;" src="<?= base_url('assets/cards_by_id/'.$get_raffle_wins_from_raffle_id[0]->card_id.'.gif') ?>" alt="local">
						<?php } ?>
						</div>
						<div class="col-md-7">
							<div class="card-body pb-0 pt-3 pt-md-0 ps-0 ps-md-4 pe-0">
								<h4 class="title-blog text-6 pt-5">
									<a href="https://www.twitch.tv/<?= $get_raffle_wins_from_raffle_id[0]->user; ?>"><?= ucfirst($get_raffle_wins_from_raffle_id[0]->user) ?></a>
									<span class="text-white text-4"> &nbsp;&nbsp; got &nbsp;&nbsp; </span>
									<a href="<?= site_url('cards/view/'.urlencode($get_raffle_wins_from_raffle_id[0]->card_name)) ?>"><?= $get_raffle_wins_from_raffle_id[0]->card_name ?></a>
								</h4>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if (isset($get_raffle_wins_from_raffle_id[1])) { ?>
				<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4 mb-4">
					<div class="row g-0">
						<div class="col-md-5">
						<?php if($get_raffle_wins_from_raffle_id[1]->external != NULL) { ?>
							<img class="rounded-4" style="max-width:20%;" src="<?= $get_raffle_wins_from_raffle_id[1]->external ?>" alt="external">
						<?php } else { ?>
							<img class="rounded-4" style="max-width:20%;" src="<?= base_url('assets/cards_by_id/'.$get_raffle_wins_from_raffle_id[1]->card_id.'.gif') ?>" alt="local">
						<?php } ?>						
						</div>
						<div class="col-md-7">
							<div class="card-body pb-0 pt-3 pt-md-0 ps-0 ps-md-4 pe-0">
								<h4 class="title-blog text-6 pt-5">
									<a href="https://www.twitch.tv/<?= $get_raffle_wins_from_raffle_id[1]->user; ?>"><?= ucfirst($get_raffle_wins_from_raffle_id[1]->user) ?></a>
									<span class="text-white text-4"> &nbsp;&nbsp; got &nbsp;&nbsp; </span>
									<a href="<?= site_url('cards/view/'.urlencode($get_raffle_wins_from_raffle_id[1]->card_name)) ?>"><?= $get_raffle_wins_from_raffle_id[1]->card_name ?></a>									
								</h4>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		<div class="container">
			<div class="col-lg-12">
				<div class="container text-center my-auto pt-5">
					<div class="row">
						<?php if( ! $get_raffle_users_from_raffle_id) { ?>
							<div class="container text-center my-auto pt-5">
								<h3 class="text-6 text-light mb-3">Oops! No users joined the raffle.</h3>
							</div>
						<?php } else { ?>
							<table class="table-responsive table-borderless text-white">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">User</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 0; ?>
									<?php foreach($get_raffle_users_from_raffle_id as $raffle_users) { ?>
									<tr>
										<th scope="row"><?= $i ?></th>
										<td><a href="https://www.twitch.tv/<?= $raffle_users->user; ?>"><?= ucfirst($raffle_users->user) ?></a></td>
									</tr>
									<?php $i++; ?>
									<?php } ?>
								</tbody>
							</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<section id="content" class="section">
			<div class="container">
				<div class="row">
					<div class="hero-wrap">
						<div class="hero-mask rounded-4 opacity-3 bg-dark"></div>
						<div class="hero-content">
							<div class="container text-center my-auto pt-3">
								<div class="mb-4">
									<label class="form-label text-white" for="yourName">Permalink</label>
									<input type="text" class="form-control rounded-4" value="<?= site_url('raffles/detail/') . $get_raffle_from_raffle_id->raffle_id ?>" disabled>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php } ?>