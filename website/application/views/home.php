<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
	<section id="home">
		<div class="hero-wrap">
			<div class="hero-content section pb-0 d-flex min-vh-100">
				<div class="container py-5 my-auto">
					<div class="row gy-5 g-lg-4">
						<div class="col-md-6 my-auto text-center text-md-start pt-5 pt-md-0 order-2 order-md-1">
							<h1 class="text-17 fw-600 text-white">LurkArts</h1>
							<p class="text-4 text-light mb-4">
								Lurkarts is a FREE tradable card game for Twitch lurkers.<br> 
								You get cards by joining the random raffles in streamers their Twitch chat.
							</p>
						</div>
						<div class="col-md-6 pb-5 pb-md-0 order-1 order-md-2">
							<div id="scene" data-relative-input="true" class="scene">
								<div data-depth="0.6" class="ms-5 mt-md-n5"><img class="img-fluid rounded-4 shadow-lg" src="<?= base_url('assets/home/03.webp') ?>" alt="local"></div>
								<div data-depth="0.3" class="top-50 start-0 ms-n3 mt-md-5"><img class="img-fluid rounded-4 shadow-lg" src="<?= base_url('assets/home/01.webp') ?>" alt="local"></div>
								<div data-depth="0.4" class="top-50 start-50 mt-n4"><img class="img-fluid rounded-4 shadow-lg" src="<?= base_url('assets/home/02.webp') ?>" alt="local"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="mt-5">
		<div class="container">
			<div class="row g-4">
				<div class="col-6 col-lg-3">
					<div class="hero-wrap py-3">
						<div class="hero-mask rounded-4 opacity-7 bg-dark"></div>
						<div class="hero-content text-center py-4 px-3">
							<h4 class="text-11 text-white fw-600 mb-0"><?= $count_streamers ?></h4>
							<div class="text-4 text-light">Streamers</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="hero-wrap py-3">
						<div class="hero-mask rounded-4 opacity-7 bg-dark"></div>
						<div class="hero-content text-center py-4 px-3">
							<h4 class="text-11 text-white fw-600 mb-0"><?= $count_cards ?></h4>
							<div class="text-4 text-light">Cards</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="hero-wrap py-3">
						<div class="hero-mask rounded-4 opacity-7 bg-dark"></div>
						<div class="hero-content text-center py-4 px-3">
							<h4 class="text-11 text-white fw-600 mb-0"><?= $count_raffels ?></h4>
							<div class="text-4 text-light">Raffles</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-3">
					<div class="hero-wrap py-3">
						<div class="hero-mask rounded-4 opacity-7 bg-dark"></div>
						<div class="hero-content text-center py-4 px-3">
							<h4 class="text-11 text-white fw-600 mb-0"><?= $count_user ?></h4>
							<div class="text-4 text-light">Users</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<section id="join" class="section pb-0">
		<div class="container">
			<div class="position-relative d-flex text-center">
				<h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 lh-1 mb-0 mb-n1">don’t miss</h2>
			</div>
			<div class="bg-primary text-center shadow-lg rounded-4 p-5 mt-n3">
				<div class="text-15 text-white lh-1 mb-2"><i class="fab fa-discord"></i></div>
				<h3 class="text-11 text-white fw-600 mb-3">Join Our Community</h3>
				<a class="btn btn-light rounded-pill" href="https://discord.gg/UjKvqh6NYg">Join Discord</a> 
			</div>
		</div>
	</section>
</div>