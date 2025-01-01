<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?= meta($html_meta_data) ?>
		<title><?= $html_title ?><?= $html_title_after ?></title>
		<link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>" />
		<link rel="manifest" href="<?= base_url('assets/favicon/site.webmanifest') ?>">
		<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/favicon/apple-touch-icon.png') ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/favicon/favicon-32x32.png') ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/favicon/favicon-16x16.png') ?>">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="dns-prefetch" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link rel="dns-prefetch" href="https://fonts.gstatic.com" crossorigin>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="dns-prefetch" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://cdn.jsdelivr.net">
		<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
		<link rel="preconnect" href="https://cdnjs.cloudflare.com">
		<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
		<link rel="preconnect" href="https://media.giphy.com">
		<link rel="dns-prefetch" href="https://media.giphy.com">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">		
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/stylesheet.min.css') ?>">
		<?php if (ENVIRONMENT == 'production') { ?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-3E6XEL5CH6"></script>
		<script type="text/javascript">
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'G-3E6XEL5CH6');
		</script>
		<script type="text/javascript">
			(function(c,l,a,r,i,t,y){
				c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
				t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
				y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
			})(window, document, "clarity", "script", "mkpn9z98i3");
		</script>
		<?php }	?>
	</head>
	<body data-bs-spy="scroll" data-bs-target="#header-nav" data-bs-smooth-scroll="true" data-bs-offset="0" class="hero-bg" style="background-image:url('<?= base_url('assets/images/bg.webp') ?>');">
		<div class="preloader preloader-dark">
			<div class="lds-ellipsis">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
		<div id="main-wrapper">
			<header id="header" class="sticky-top-slide">
				<nav class="primary-menu navbar navbar-expand-lg navbar-dark bg-transparent fw-500">
					<div class="container position-relative">
						<div class="col-auto col-lg-auto">
							<a class="logo" href="<?= site_url('home') ?>" title="Lurkarts"> <img src="<?= base_url('assets/images/logo.webp') ?>" alt="LurkArts"> </a> 
						</div>
						<div class="col col-lg-10 navbar-accordion">
							<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav"><span></span><span></span><span></span></button>
							<div id="header-nav" class="collapse navbar-collapse justify-content-end">
								<ul class="navbar-nav">
									<li class="nav-item"><a class="nav-link <?php if($cc == 'home'){echo 'active';} ?>" href="<?= site_url('home') ?>">Home</a></li>
									<li class="nav-item"><a class="nav-link <?php if($cc == 'streamers'){echo 'active';} ?>" href="<?= site_url('streamers') ?>">Streamers</a></li>
									<li class="nav-item"><a class="nav-link <?php if($cc == 'cards'){echo 'active';} ?>" href="<?= site_url('cards') ?>">Cards</a></li>
									<li class="nav-item"><a class="nav-link <?php if($cc == 'raffles'){echo 'active';} ?>" href="<?= site_url('raffles') ?>">Raffles</a></li>
									<li class="nav-item"><a class="nav-link <?php if($cc == 'ranking'){echo 'active';} ?>" href="<?= site_url('ranking') ?>">Ranking</a></li>
									<li class="nav-item"><a class="nav-link <?php if($cc == 'latest'){echo 'active';} ?>" href="<?= site_url('latest') ?>">Latest</a></li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#">More</a>
                                        <ul class="dropdown-menu">
											<li><a class="dropdown-item" href="<?= site_url('faq') ?>">FAQ</a></li>
											<li><a class="dropdown-item" href="<?= site_url('changelog') ?>">Changelog</a></li>
											<li><a class="dropdown-item" href="<?= site_url('beta') ?>">Beta</a></li>
                                        </ul>
                                    </li>
									<li class="align-items-center h-auto mt-2 mt-lg-0 ms-lg-3">
										<a class="btn btn-light rounded-pill d-inline-block" href="https://discord.gg/UjKvqh6NYg">
											<span class="me-1"><i class="fab fa-discord"></i></span> Discord
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</nav>
			</header>
			<?= $html_content ?>
			<footer id="footer" class="section footer-dark">
				<div class="container">
					<p class="text-center mb-4">
						Copyright © <script>document.write(new Date().getFullYear())</script> <a href="#" class="fw-500">LurkArts</a>. All Rights Reserved.
						<br>
						Created with <i class="fa fa-heart" style="color:red"></i> by <a href="https://scampi.me/">Scampi_ml</a>
					</p>
				</div>
			</footer>
		</div>
		<a id="back-to-top" data-bs-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.min.js"></script> 
		<script type="text/javascript" src="<?= base_url('assets/js/theme.js') ?>"></script>
		<?php if($cc == 'home'){ ?>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
		<script type="text/javascript">
			//<![CDATA[
			window.onload = function () { 
				var scene = document.getElementById('scene');
				var parallaxInstance = new Parallax(scene);
			}
			//]]>
		</script>
		<?php } ?>
	</body>
</html>