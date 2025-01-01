<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if( ! $get_raffles_by_streamer_id){ ?>
<div id="content" role="main">
	<div class="section min-vh-100 d-flex">
		<div class="container text-center my-auto pt-5">
			<h3 class="text-6 text-light mb-3">Oops! no raffles found!</h3>
			<button onclick="history.back()" class="btn btn-outline-light rounded-pill m-2">Back</button > 
		</div>
	</div>
</div>
<?php } else { ?>
	<div id="content" role="main">
		<section id="about" class="section">
			<div class="container">
				<div class="position-relative d-flex text-center mb-5">
					<h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Raffle</h2>
					<p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Raffles for <?= $streamer->display_name ?> <span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span></p>
				</div>
				<div class="row">
					<table class="table-responsive table-borderless text-white">
						<thead>
							<tr>
								<th scope="col">Raffle Id</th>
								<th scope="col">Raffle Times</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($get_raffles_by_streamer_id as $raffle) { ?>
							<tr>
								<td><a href="<?= site_url('raffles/detail/'.$raffle->raffle_id) ?>"><?= $raffle->raffle_id ?></a></td>
								<td><?= utc($raffle->raffle_start) ?>&nbsp;&nbsp; -> &nbsp;&nbsp;<?= utc($raffle->raffle_stop) ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
<?php } ?>