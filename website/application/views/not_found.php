<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
	<div class="section min-vh-100 d-flex">
		<div class="container text-center my-auto pt-5">
			<h2 class="text-25 fw-600 text-white mb-0">404</h2>
			<h3 class="text-6 text-light mb-3">Oops! The page you requested was not found!</h3>
			<p class="text-3 text-white-50">The page you are looking for was moved, removed, renamed or might never existed.</p>
			<a href="<?= site_url('home') ?>" class="btn btn-primary rounded-pill m-2">Home</a>
			<button onclick="history.back()" class="btn btn-outline-light rounded-pill m-2">Back</button>
		</div>
	</div>
</div>