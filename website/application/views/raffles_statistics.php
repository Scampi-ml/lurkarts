<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
	<section id="roadmap" class="section">
		<div class="container">
			<div class="position-relative d-flex text-center mb-5">
				<h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Raffles</h2>
				<p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Raffles <span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span>
				</p>
			</div>
			<div class="roadmap text-white">
				<div class="row gy-3 mb-5">
					<div class="col-md-6">
						<div class="step-pr shadow mx-auto ms-md-auto me-md-5">
							<div class="text-11 fw-600 text-primary me-n2"><?= $count_all_raffles; ?></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-center text-md-start ms-md-5">
							<h2 class="text-white fw-600 mb-3">Raffles</h2>
							<p class="text-light">The number of raffles that are currenty recorded.</p>
						</div>
					</div>
				</div>
				<div class="row gy-4 mb-5">
					<div class="col-md-6 order-1 order-md-2">
						<div class="step-pr alternate shadow mx-auto me-md-auto ms-md-5">
							<div class="text-11 fw-600 text-primary me-n2"><?= $count_all_raffles_users; ?></div>
						</div>
					</div>
					<div class="col-md-6 order-2 order-md-1">
						<div class="text-center text-md-end me-md-5">
							<h2 class="text-white fw-600 mb-3">Raffle Users</h2>
							<p class="text-light">Users who enterd the raffles by typing !lurkarts in the chat.</p>
						</div>
					</div>
				</div>
				<div class="row gy-4 mb-5">
					<div class="col-md-6">
						<div class="step-pr shadow mx-auto ms-md-auto me-md-5">
							<div class="text-11 fw-600 text-primary me-n2"><?= $count_unique_raffle_users; ?></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-center text-md-start ms-md-5">
							<h2 class="text-white fw-600 mb-3">Unique Raffle Users</h2>
							<p class="text-light">Unique Users who enterd the raffles by typing !lurkarts in the chat.</p>
						</div>
					</div>
				</div>
				<div class="row gy-4 mb-5">
					<div class="col-md-6 order-1 order-md-2">
						<div class="step-pr alternate shadow mx-auto me-md-auto ms-md-5">
							<div class="text-11 fw-600 text-primary me-n2"><?= $count_all_raffles_winners; ?></div>
						</div>
					</div>
					<div class="col-md-6 order-2 order-md-1">
						<div class="text-center text-md-end me-md-5">
							<h2 class="text-white fw-600 mb-3">Raffles Winners</h2>
							<p class="text-light">Users who won a card during the raffle.</p>
						</div>
					</div>
				</div>
				<div class="row gy-4 mb-5">
					<div class="col-md-6">
						<div class="step-pr shadow mx-auto ms-md-auto me-md-5">
							<div class="text-11 fw-600 text-primary me-n2"><?= $count_unique_raffle_winners; ?></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-center text-md-start ms-md-5">
							<h2 class="text-white fw-600 mb-3">Unique Raffles Winners</h2>
							<p class="text-light">Unique users who won a card during the raffle.</p>
						</div>
					</div>
				</div>
				<div class="row gy-4">
					<div class="col-md-6 order-1 order-md-2">
						<div class="step-pr alternate shadow mx-auto me-md-auto ms-md-5">
							<div class="text-11 fw-600 text-primary me-n2"><?= $count_all_raffles_rejects; ?></div>
						</div>
					</div>
					<div class="col-md-6 order-2 order-md-1">
						<div class="text-center text-md-end me-md-5">
							<h2 class="text-white fw-600 mb-3">Raffle Rejects</h2>
							<p class="text-light">Users who tried to enter the raffle, but just missed the timer.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>