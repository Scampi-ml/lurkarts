<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="content" role="main">
    <div class="container pt-5">
        <div class="position-relative d-flex text-center my-5 py-5">
            <h2 class="text-24 text-white-50 opacity-1 text-uppercase fw-600 w-100 mb-0">Changelog</h2>
            <p class="text-9 text-white fw-600 position-absolute w-100 align-self-center lh-base mb-0">Changelog <span class="heading-separator-line border-bottom border-3 border-primary d-block mx-auto"></span>
            </p>
        </div>
    </div>
    <div class="container">
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>8 July, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: Latest page<br>
					- Changed: moved the faq to the dropdown menu<br>
				</div>
			</div>
        </div>	
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>6 July, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Fixed: 404 logging<br>
				</div>
			</div>
        </div>		
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>27 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Changed: all png images are now webp... faster images?<br>
					- Changed: preconnect CDN... faster loading?<br>
					- Changed: footer link points to my website instead twitch<br>
					- Removed: tooltips in theme.js, its not being used<br>
					- Removed: card images, used giphy CDN, its way faster and saves me bandwidth win - win<br>
				</div>
			</div>
        </div>		
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>24 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- HOTFIX: raffles/detail, it was expecting a array while FALSE was given, send a empty array now<br>
					- HOTFIX: raffles/detail, no winners did not had any styling... silly me<br>
				</div>
			</div>
        </div>				
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>24 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- HOTFIX: all timestamps are in UTC, time was not converted properly<br>	
					- Added: improved error logging<br>
					- Changed: warning message on changelog moved to the bottom<br>
					- Fixed: show_404 not calling the custom 404 page, but the default one<br>
					- Fixed: usernames below 5 characters where invalid => RTFM! - Feel free to beta test :)<br>
					- Fixed: usernames where above 25 characters where allowed => RTFM!<br>
				</div>
			</div>
        </div>			
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>23 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Changed: table layouts, make things pretty<br>
					- Changed: name to display name<br>
					- Changed: raffle detail page, winner or winners depending on the count<br>
					- Changed: raffle detail page, Users joined or User joined depending on the count<br>
					- Updated: jquery to 3.7.1<br>
					- Removed: the words "cards" from ranking<br>
				</div>
			</div>
        </div>			
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>21 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: added ranking page<br>
					- Added: added sub page "inventory", i might change some things in there<br>
					- Fixed: responsive tables<br>
				</div>
			</div>
        </div>		
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>19 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: 9 cards for MEGAsticky<br>
					- Added: 7 cards for Naruske<br>
					- Added: 3 cards for Abulic<br>
				</div>
			</div>
        </div>
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>6 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: rarity to card page<br>
					- Changed: changed local image card files to giphy CDN links, should speed up ALLOT, but still big ass gifs....<br>
					- Changed: preloader delay from 100 to 1<br>
					- Changed: fadeOut from slow to fast<br>
					- Changed: 3 home images to .png<br>
					- Changed: streamers page sorted by name<br>
					- Changed: streamers image Foxieke<br>
					- Changed: streamers image Espe_be<br>
				</div>
			</div>
        </div>		
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>8 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: card Trucker Rigor<br>
				</div>
			</div>
        </div>			
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>6 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: more info on beta page<br>
					- Added: faq item<br>
					- Added: card holders per card<br>
					- Added: raffle winners per streamer<br>
					- Added: raffle rejects per streamer<br>
					- Added: raffle users per streamer<br>
					- Added: excluded google analytics from DEVELOPMENT environment<br>
					- Added: excluded clarity analytics from DEVELOPMENT environment<br>
					- Changed: code clean-up <br>
					- Fixed: typo in beta page<br>
					- Fixed: typo in changelog page<br>
					- Fixed: correctly capitalized streamer name in streamers page<br>
					- Fixed: correctly capitalized streamer name in raffels/streamer page<br>
					- Fixed: correctly capitalized streamer name in raffels/detail page<br>
					- Fixed: correctly capitalized streamer name in raffels/winners page<br>
					- Fixed: correctly capitalized streamer name in raffels/rejects page<br>
					- Fixed: correctly capitalized streamer name in raffels/users page<br>
					- Fixed: error logging for validation in raffels page<br>
					- Fixed: typo in raffels page (Thx to 1St8ment)<br>
					- Removed: discord button on beta page<br>
				</div>
			</div>
        </div>			
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>5 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- HOTFIX: font-awsome was not working after clean up, changed to CDN<br>
					- Changed: bootstrap css to CDN<br>
					- Changed: bootstrap js to CDN<br>
					- Changed: jquery to CDN<br>
					- Changed: parallax to CDN<br>
					- Changed: from TEST to PRODUCTION server<br>
				</div>
			</div>
        </div>			
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>3 June, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: header caching<br>
					- Added: china & russia block, i mean ... why you pull so much data?<br>
					- Changed: code clean-up <br>
					- Changed: CSS clean-up<br>
					- Changed: poppins front comes from google now, speeds up things<br>
					- Updated: bootstrap to 5.3<br>
					- Fixed: parallax map<br>
					- Fixed: bootstrap map<br>
					- Fixed: unminified css <br>
					- Removed: CF Web Analytics, google might be next<br>
				</div>
			</div>
        </div>			
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>31 May, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: 404 page <small>(Why didnt i add this in the beginning?)</small><br>
					- Added: remote error logging<br>
					- Changed: note above, made it smaller<br>
					- Changed: robots<br>
					- Changed: preloader delay to 100<br>
					- Fixed: favicon.ico not showing for firefox<br>
					- Fixed: error reporting<br>
					- Fixed: instagram link in changelog<br>
					- Fixed: various security issues<br>
					- Fixed: missing images<br>
					- Fixed: raffle detail link<br>
					- Fixed: raffle removed unwanted link<br>
					- Fixed: Anne-elfics gave a 404 error<br>					
					- Removed: render time in the footer for cleaner look<br>
				</div>
			</div>
        </div>				
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>22 May, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- Added: 5 cards for Foxieke<br>
					- Added: 7 cards for xlobster_<br>
					- Added: 6 cards for Rigor_tv<br>
					- Added: 3 cards for Annelytics<br>
					- Added: FAQ item => <a href="https://www.instagram.com/lurkarts_">Instagram</a><br>
				</div>
			</div>
        </div>		
		<br>
		<div class="col-lg-8 col-xl-12">
			<div class="blog-post blog-post-dark border border-secondary border-opacity-75 shadow rounded-4 p-4">
				<h6><span class="text-white-50 text-2 fw-400"><em>19 April, 2024</em></span></h6>
				<hr class="my-2">
				<div class="post-comment post-comment-dark">
					- HOTFIX: changed the way date/times where imported. All database stamps are in UTC<br>				
					- Added: raffle details and statistics<br>
					- Added: page "raffels"<br>
					- Added: page "beta"<br>
					- Changed: added "Raffles for ..." at the /raffles/streamer/... page<br>
					- Changed: code clean-up <br>
					- Changed: incompleted data at raffle detail page<br>
					- Changed: converted UTC to "belgium" timezone<br>
				</div>
			</div>
        </div>
		<br>
		<div class="hero-wrap p-3">
			<div class="hero-mask rounded-4 opacity-3 bg-dark"></div>
			<div class="hero-content">
				<div class="row g-0 text-center text-sm-start">
					<div class="col-12 col-sm">
						<p class="mb-2" style="color:red;">
							<b>NOTE:</b> These updates only apply to this website. For official updates please check the discord under <i>#update-log</i>.
						</p>
					</div>
				</div>
			</div>
		</div>		
    </div>
</div>