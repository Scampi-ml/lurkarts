<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
    <div class="container pt-5">
        <div class="position-relative d-flex text-center my-4 py-4">
            <h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Inventory</h2>
            <p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Inventory<span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span>
            </p>
        </div>
    </div>
    <div class="container">
	<?php if( ! $streamers){ ?>
			<div class="section min-vh-100 d-flex">
				<div class="container text-center my-auto pt-5">
					<h3 class="text-6 text-light mb-3">Oops! no data found!</h3>
					<button onclick="history.back()" class="btn btn-outline-light rounded-pill m-2">Back</button > 
				</div>
			</div>
	<?php } else { ?>
		<div class="container text-center my-auto pt-5">
			<h4 class="text-6 text-light mb-3">Inventory for <?= $rank_name ?></h4>
		</div>
		<br>
		<p class="mb-2" style="color:red;">
			<b>NOTE:</b> This is informative data! Check for the correct data in <i>#bot-commands</i> =>  and type <i>!inventory yourname</i>.
		</p>		
		<?php foreach($streamers as $streamer) { ?>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h2 class="title-blog text-white text-7"><?= $streamer->display_name; ?></h2>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					<?php foreach($streamer->cards as $streamer_card) { ?>
						<?php if($streamer_card->win_amount > 0) { ?>
							- <strike class="text-muted"><?= $streamer_card->card_name ?></strike> <small>(X<?= $streamer_card->win_amount ?> )</small><br>
						<?php } else { ?>
							- <?= $streamer_card->card_name ?><br>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<br>	
		<?php } ?>
	<?php } ?>
    </div>
</div>