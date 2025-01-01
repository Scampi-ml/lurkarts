<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
    <div class="container pt-5">
        <div class="position-relative d-flex text-center my-4 py-4">
            <h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Ranking</h2>
            <p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Ranking <span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span>
            </p>
        </div>
    </div>
    <div class="container">
	<?php if( ! $users){ ?>
			<div class="section min-vh-100 d-flex">
				<div class="container text-center my-auto pt-5">
					<h3 class="text-6 text-light mb-3">Oops! no raffle users found!</h3>
					<button onclick="history.back()" class="btn btn-outline-light rounded-pill m-2">Back</button > 
				</div>
			</div>
	<?php } else { ?>
			<div class="row text-center border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<?php $plrynr = 1; ?>
				<table class="table-responsive table-borderless text-white">
					<tbody>
						<?php foreach($users as $key => $val) { ?>
						<tr>	
							<td>
								<center>
									<?php if ($plrynr == 1) { ?>
										<?= $plrynr ?> <sup>st</sup>
									<?php } else if ($plrynr == 2) { ?>
										<?= $plrynr ?> <sup>nd</sup>
									<?php } else if ($plrynr == 3) { ?>
										<?= $plrynr ?> <sup>th</sup>
									<?php } else { ?>
										<?= $plrynr ?>
									<?php } ?>
								</center>
							</td>
							<td><a href="<?= site_url('ranking/'.urlencode($key)) ?>"><?= ucfirst($key) ?></a></td>
							<td><?= $val ?>x</td>
						</tr>
						<?php $plrynr++; ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
	<?php } ?>
    </div>
</div>