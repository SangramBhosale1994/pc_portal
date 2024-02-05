<?php
	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	{
		//Tell the browser to redirect to the HTTPS URL.
		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
		//Prevent the rest of the script from executing.
		exit;
	}

	$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<!-- <script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-155220702-1');
	</script> -->
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-208516648-2');
	</script>

	<script>
		let website_rootpath = '<?=$config->urls->httpRoot?>resume/';
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->


	<title>#21DaysAllyChallenge | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

	<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="21 Days Ally Challenge | Pride Circle">
	<meta property="og:image" content="<?= $rootpath;?>images/slide-7.jpg">
	<meta property="og:description" content="#21DaysAllyChallenge">
	<meta property="og:url" content="https://www.thepridecircle.com/21daysallychallenge/">

	<meta name="twitter:title" content="21 Days Ally Challenge | Pride Circle">
	<meta name="twitter:description" content="#21DaysAllyChallenge">
	<meta name="twitter:image" content="<?= $rootpath;?>images/slide-7.jpg">
	<meta name="twitter:card" content="21DaysAllyChallenge">

	<meta property="og:site_name" content="Pride Circle">
	<meta name="twitter:image:alt" content="21DaysAllyChallenge">
	<!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css">
	<!-- Fonts Style CSS -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<style>
body{
	font-family: 'Roboto', sans-serif;
}

#navbar-md-logo{
	position: relative;
	left: 0;
	top: 0;
}

#carouselExampleIndicators{
	-webkit-box-shadow: 2px 2px 3px 3px #ddd;
	-moz-box-shadow:    2px 2px 3px 3px #ddd;
	box-shadow:         2px 2px 3px 3px #ddd;
}
#slider_container{
	margin-top: 5.5rem;
}

		.carousel-control-prev-icon {
 background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23999' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E") !important;
}

.carousel-control-next-icon {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23999' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E") !important;
}

 /* Fixed/sticky icon bar (vertically aligned 50% from the top of the screen) */
.icon-bar {
  position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

/* Style the icon bar links */
.icon-bar a {
  display: block;
  text-align: center;
  padding: 14px;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}

.mobile-icon-bar a{
	height: 50px;
	width: 50px;
	border-radius: 50px;
	text-align: center;
	padding: 10px;
	transition: all 0.3s ease;
	color: white;
	font-size: 20px;
}

/* Style the social media icons with color, if you want */
.icon-bar a:hover {
  background-color: #000;
}

.about_us_social_link {
  background: #73777f;
  color: white;
}

.facebook {
  background: #3B5998;
  color: white;
}

.twitter {
  background: #55ACEE;
  color: white;
}

.google {
  background: #dd4b39;
  color: white;
}

.linkedin {
  background: #007bb5;
  color: white;
}

.youtube {
  background: #bb0000;
  color: white;
}

/* Style for the navbar */
#navbar, .shodow{
	-webkit-box-shadow: 0 3px 6px -6px black;
	-moz-box-shadow: 0 3px 6px -6px black;
	box-shadow: 0 3px 6px -6px black;
}

#navbar .nav-link{
	color: #000;
}

.underline-button {
	font: bold 14px/1.4 'Open Sans', arial, sans-serif;
	color: #000;
	text-transform: uppercase;
	text-decoration: none;
	letter-spacing: 0.10em;

	display: inline-block;
	position: relative;
}
@media only screen and (max-width: 576px) {
	.underline-button {
		padding-top: 1.2rem;
	}
}
.underline-button.active,.underline-button[aria-expanded=true],.underline-button:hover{
	text-decoration: none;
	color: rgb(66,139,202) !important;
}
.underline-button:after {
	background: none repeat scroll 0 0 transparent;
	bottom: 0;
	content: "";
	display: block;
	height: 2px;
	left: 40%;
	position: absolute;
	background: #000;
	transition: width 0.3s ease 0s, left 0.3s ease 0s;
	width: 20%;
}
.underline-button.active:after,.underline-button[aria-expanded=true]:after,.underline-button:hover:after {
	width: 100%;
	left: 0;
	background: rgba(66,139,202, 1);
}
/* Style for navbar End */

/* Gleam iframe styles */
.e-widget-wrapper{
	border: 5px solid rgba(66,139,202, 1);
	padding-bottom: 0px;
	margin-bottom: 0px;
}

.sign-up-indicator{
	background-color: rgba(66,139,202, 1);
	width: 540px;
}


@media only screen and (max-width: 990px) {
	.sign-up-indicator{
		width: 450px;
	}
}

@media only screen and (max-width: 767px) {
	.sign-up-indicator{
		width: 510px;
	}
}

@media only screen and (max-width: 575px) {
	.sign-up-indicator{
		width: 100%;
	}
}
/* Gleam iframe styles END */

/* Collapse style */
.collapse-card-body{
	background-color: rgba(66,139,202, 0.1)
}
/* Collapse style END*/

	</style>
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $rootpath;?>scripts/jquery.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js" type="text/javascript" async></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous" async></script>
	<!-- ---------- JS LINKS END ---------- -->

	<!-- Meta Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js%27');
	fbq('init', '297156267641785');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=297156267641785&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Meta Pixel Code -->

</head>
<body>
	<nav id="navbar" class="[ navbar fixed-top navbar-expand-lg navbar-light bg-white ]">
		<img id="navbar-md-logo" class="[ ml-5 ][ d-none d-md-inline-block ]" src="<?=$rootpath?>images/pride_circle_logo_square.jpg" style="width:50px; height:auto"  alt="">

		<div class="[ container ]">
			<a class=" [ navbar-brand ][ d-sm-inline-block d-md-none ]" href="#">
				<img src="<?=$rootpath?>images/pride_circle_logo_square.jpg" style="width:50px; height:auto"  alt="">

				<strong class="">
					<span style="color:#FF6666">#</span><span style="color:#FFCC66">21</span><span style="color:#99CC99">Days</span><span style="color:#66CCFF">Ally</span><span style="color:#BFA6D0">Challenge</span>
				</strong>
			</a>

			<button id="navbar-toggler" class="[ m-0 p-0 ][ border-0 navbar-toggler ]" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="[ collapse navbar-collapse ]" id="navbarNav">
				<ul class="[ w-100 ][ d-flex align-items-center justify-content-md-around flex-sm-row justify-content-sm-center ][ navbar-nav ]">
					<li class="nav-item active">
					<a target="_blank" class="nav-link ( underline-button )" href="https://www.thepridecircle.com/">About Us</a>
					</li>
					<li class="nav-item">
					<a class="nav-link ( underline-button )" href="#to-participate">TESTIMONIALS</a>
					</li>
					<li class="nav-item">
					<a class="nav-link ( underline-button )" href="#winners">WINNERS</a>
					</li>

					<li class="nav-item">
					<a class="nav-link ( underline-button )" href="<?= $rootpath;?>files/Pride circle report.pdf">Impact Report<sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup></a>
					</li>

					<!-- <li class="nav-item">
					<a class="nav-link ( underline-button )" href="#resources">Resources</a>
					</li> -->

					<li class="nav-item">
					<a class="nav-link ( underline-button )" href="#partners">Partners</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="[ d-none d-md-block ]( icon-bar )">
		<a target="_blank" href="https://www.facebook.com/PrideCircles/" class="facebook"><i class="fa fa-facebook"></i></a>

		<a target="_blank" href="https://twitter.com/pride_circle" class="twitter"><i class="fa fa-twitter"></i></a>

		<a target="_blank" href="https://www.instagram.com/pride_circle/" class="google"><i class="fa fa-instagram"></i></a>

		<a target="_blank" href="https://www.linkedin.com/groups/10392130/" class="linkedin"><i class="fa fa-linkedin"></i></a>

		<a target="_blank" href="https://www.youtube.com/channel/UCoaAZWnpjFXcCQ5Und9mi0Q" class="youtube"><i class="fa fa-youtube"></i></a>

		<a target="_blank" href="mailto:contact@thepridecircle.com?subject=21DaysAllyChallenge" class="about_us_social_link" title="contact@thepridecircle.com"><i class="fa fa-envelope"></i></a>
	</div>

	<div id="slider_container" class="[ px-md-5 pb-5 ][ container ]">
		<div id="carouselExampleIndicators" class="[ carousel slide ]" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-1.jpg" alt="First slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-2.jpg" alt="First slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-3.jpg" alt="First slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-4.jpg" alt="First slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-5.jpg" alt="First slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-6.jpg" alt="First slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-7.jpg" alt="Second slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-8.jpg" alt="Third slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-9.jpg" alt="Third slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-10.jpg" alt="Third slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-11.jpg" alt="Third slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-12.jpg" alt="Third slide">
				</div>

				<div class="carousel-item">
					<img class="d-block w-100" src="<?= $rootpath;?>images/slide-13.jpg" alt="Third slide">
				</div>
			</div>

			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only [ rounded-circle bg-danger  ]">Previous</span>
			</a>

			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>

		<div class="[ pt-md-1 pr-md-2 ][ text-right ]">
			<a href="<?=$page->ally_challenge_slides_to_download->httpUrl?>" class="[ text-primary ]" style="font-size: 1.2rem"><i class="[ fa fa-cloud-download-alt ]"></i> Download These Slides</a>
		</div>
	</div>

	<div id="to-participate" class="[ pt-5 pb-2 ][ container ]">
		<div class="[ pt-4 pb-2 ][ text-center ]">
			<h1>TESTIMONIALS</h1>
		</div>

		<div class="[ mt-3 ][ row ]">
			
			<div class="[ offset-md-3 col-md-6 ]">
				<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/M823wFpgXtA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>

		<div class="[ mt-3 ][ row ]">
			<div class="[ offset-md-3 col-md-6 ]">
				<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/u3g9_7BV5Os" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>

		<div class="[ mt-3 ][ row ]">
			<div class="[ offset-md-3 col-md-6 ]">
				<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/R50emlrC_S8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
	</div>

	<div id="play-here" class="[ pt-5 pb-2 ][ container ]">
		<div class="[ pt-4 pb-2 ][ text-center ]">
			<h1>REGISTER</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 mt-3 ][ row ]">
			<div class="[ col-md-4 ][ text-center ]">
				<a class="[ pb-2 ]( underline-button )" target="_blank" href="<?= $page->ally_challenge_get_started->httpUrl?>">Get Started</a>
			</div>

			<div class="[ col-md-4 ][ text-center ]">
				<a class="[ px-4 pb-2 ]( underline-button )" target="_blank" href="<?= $page->ally_challenge_faq->httpUrl?>">FAQ</a>
			</div>

			<div class="[ col-md-4 ][ text-center ]">
				<a class="[ pb-2 ]( underline-button )" target="_blank" href="<?= $page->ally_challenge_t_and_c->httpUrl?>">Terms & Conditions</a>
			</div>
		</div>

		<div class="[ row pt-5 ]">
			<!-- <div class="[ col-12 ][ text-center ]">
				The registrations are still OPEN. Deadline to sign up, refer and complete the 21 challenges is 11:59 AM IST on July 1.
			</div>
			<div class="[ pt-2 ][ col-12 ][ text-center ]">
				A new challenge will get unlocked on weekdays (Monday-Friday) at 12:00 PM IST
			</div> -->
		</div>
	</div>

	<div class="[ container ]">
		<div class="[ row ]">
			<div class="[ offset-md-2 col-md-8 ][ pt-3 pb-3 ]">
				<a class="e-widget no-button generic-loader" href="https://gleam.io/6ruFZ/21daysallychallenge" rel="nofollow">#21DaysAllyChallenge</a>
				<script type="text/javascript" src="https://widget.gleamjs.io/e.js" async="true"></script>
				<div class="[ mx-auto py-2 ][ text-center text-white ]( sign-up-indicator )">
					<i class="[ pb-2 ][ fas fa-2x fa-arrow-up ]"></i>
					<br>
					<strong>LOGIN USING EMAIL/SOCIAL MEDIA ACCOUNT</strong>
				</div>
			</div>
		</div>

		<div class="[ row ]">
			<!-- <div class="[ col-12 ][ text-center ]">
				Write to us on <a href="mailto:contact@thepridecircle.com?subject=21DaysOfAllyChallenge" class="[ text-primary ]">contact@thepridecircle.com</a> if you want to register your organization/group for the challenge
			</div> -->
		</div>
	</div>

	<div id="leaderboard" class="[ pt-5 pb-2 ][ container ]">
		<div class="[ pt-4 pb-2 ][ text-center ]">
			<h1>LEADERBOARD</h1>
		</div>

		<div class="[ text-center ]">
			<strong>
				12,750 Allies
			</strong>
			<br>
			<br>

			<div>
				<strong class="[ px-3 py-2 ][ bg-danger rounded ][ text-white ]">The #21DaysAllyChallenge is now over.</strong>

				<br>
				<br>

				<div class="[ pb-1 ]"> We are grateful to all of you for the overwhelming participation.</div>

				<div class="[ pb-1 ]">
					12,750 allies from 58 countries (30% of the world) and 108 organizations made it a truly Global Movement & Pride Month Celebration.
				</div>

				<!-- <div class="[ pb-1 ]">
					We will be announcing the final scores on the Leaderboard and the Winners on <strong>15 July 2020</strong>
				</div> -->
			</div>
		</div>

		<br>
		<br>

		<div>
			<ul class="[ py-3 ][ nav ][ d-flex justify-content-around ]" id="myTab" role="tablist">
				<li class="[ nav-item text-center ]">
					<a class="[ px-5 ][ nav-link active ]( underline-button )" id="individual-tab" data-toggle="tab" href="#individual-panel" role="tab" aria-controls="individual-panel" aria-selected="true">INDIVIDUAL</a>
				</li>
				<li class="[ nav-item text-center ]">
				<a class="[ px-5 ][ nav-link ]( underline-button )" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ORGANIZATION/GROUP</a>
				</li>
			</ul>

			<div style="margin:auto; width:100%; height:18rem; border:2px solid rgb(66,139,202); overflow-y: scroll; padding-top:0px !important;" class="[ p-md-2 pt-md-none ][ tab-content ]" id="myTabContent">
				<div class="[ tab-pane fade show active ][ text-center ]" id="individual-panel" role="tabpanel" aria-labelledby="individual-tab">
					<table class="table">
						<thead>
							<tr style="border-top: 2px solid #fff">
								<th scope="col">Rank</th>
								<th scope="col">Name</th>
								<th scope="col">Score</th>
								<th scope="col">Country</th>
							</tr>
						</thead>

						<tbody>
							<?php
								$individual_leaderboard_array = $pages->get("name=ally-challenge-leaderboard-update")->ally_challenge_leaderboard_individual;

								$counter = 0;

								foreach (json_decode($individual_leaderboard_array, true) as $individual_leader) {
									$counter++;
							?>

							<tr>
								<th scope="row"><?=$counter?></th>
								<td><?=$individual_leader["contestant_name"] ?></td>
								<td><?=$individual_leader["contestant_score"] ?></td>
								<td><?=$individual_leader["contestant_country"] ?></td>
							</tr>

							<?php
								}
							?>
						</tbody>
					</table>

					<!-- <h3 class="[ pt-5 mt-5 text-muted ]">The final scores and winners will be announced on 15th July 2020</h3> -->
				</div>

				<div class="[ tab-pane fade ][ text-center ]" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<table class="table">
						<thead>
							<tr style="border-top: 2px solid #fff">
								<th scope="col">Rank</th>
								<th scope="col">Name</th>
								<th scope="col">Score</th>
								<th scope="col">Allies</th>
							</tr>
						</thead>

						<tbody>
							<?php
								$group_leaderboard_array = $pages->get("name=ally-challenge-leaderboard-update")->ally_challenge_leaderboard_group;

								$counter = 0;

								foreach (json_decode($group_leaderboard_array, true) as $group_leader) {
									$counter++;
							?>

							<tr>
								<th scope="row"><?php if($counter == 11){echo "10";} else{echo $counter;}?></th>
								<td><?=$group_leader["company_name"] ?></td>
								<td><?=$group_leader["contestant_score"] ?></td>
								<td><?=$group_leader["ally_count"] ?></td>
							</tr>

							<?php
								}
							?>
						</tbody>
					</table>

					<!-- <h3 class="[ pt-5 mt-5 text-muted ]">The final scores and winners will be announced on 15th July 2020</h3> -->
				</div>
			</div>

			<div class="[ pt-3 ][ text-center ]">
				<!-- The Leaderboard gets refreshed everyday at 12:00pm IST. -->
			</div>
		</div>
	</div>

	<div id="winners" class="[ pt-5 px-md-5  ][ container text-center ]">
		<div class="[ pt-4 pb-4 ]">
			<h1>WINNERS</h1>
		</div>

		<div class="[ my-5 ][ row ]">
			<div class="[ offset-md-2 col-md-8 ]">
				<img class="[ img-fluid ]" src="<?=$rootpath?>/images/winners_companies.jpg">
			</div>
		</div>

		<div class="[ my-5 ][ row ]">
			<div class="[ offset-md-2 col-md-8 ]">
				<img class="[ img-fluid ]" src="<?=$rootpath?>/images/winners_individuals.jpg">
			</div>
		</div>

		<div class="[ my-5 ][ row ]">
			<div class="[ offset-md-2 col-md-8 ]">
				<img class="[ img-fluid ]" src="<?=$rootpath?>/images/winners_referrals.jpg">
			</div>
		</div>
	</div>

<!-- <div id="resources" class="[ py-5 container ]">
	<div class="[ pt-4 pb-2 ][ text-center ]">
		<h1>RESOURCES</h1>
	</div>

	<div class="accordion" id="resource-accordion"> -->
		<?php
			$loop_counter = 0;
			/* Loop for listing the resources for challenges */
			foreach ($page->ally_challenge_resources as $resource) {
				$loop_counter++;

				$collapse_class = "";
				$aria_expanded = "flase";

				/* Only first element is opened initially */
				if($loop_counter == 1){
					//$collapse_class = " show ";
					//$aria_expanded = "true";
				}
		?>

		<!-- <div id="<?=$resource->ally_challenge_resource_locator?>-menu" class="[ card ][ border-0 ]">
			<div class="[ card-header ][ bg-white border-0 ][ text-center ]" id="<?=$resource->ally_challenge_resource_locator?>-heading">
				<button class="[ btn btn-link ]( underline-button )" type="button" data-toggle="collapse" data-target="#<?=$resource->ally_challenge_resource_locator?>" aria-expanded="<?=$aria_expanded?>" aria-controls="<?=$resource->ally_challenge_resource_locator?>">
				<?=$resource->title;?>
				</button>
			</div>

			<div id="<?=$resource->ally_challenge_resource_locator?>" class="collapse <?=$collapse_class?>" aria-labelledby="<?=$resource->ally_challenge_resource_locator?>-heading" data-parent="#resource-accordion">
				<div class="[ card-body ]( collapse-card-body )">
					<?=$resource->ally_challenge_resource_description?>
				</div>
			</div>
		</div> -->

		<?php
			}
		?>


	<!-- </div>
</div> -->

	<!-- script for redirection on tag -->
	<script>
		$(document).ready(function(){
			var url_of_page = window.location.href;
			var last_index = url_of_page.lastIndexOf('#');
			var id_of_section = url_of_page.substring(last_index + 1);

			let accordion_menu = document.getElementById(id_of_section+"-menu");
			if(accordion_menu){
				//accordion_menu.collapse('hide');
				$('#'+id_of_section).collapse('show');

				$('body, html').animate({
					scrollTop: $("#resources").offset().top
				}, 600);
			}
		})
	</script>

	<div class="[ py-5 px-5 ][ container ][ d-block d-md-none ]">
		<div class="[ pt-4 pb-3 ][ text-center ]">
			<h1>FOLLOW US</h1>
		</div>

		<div class="[ mb-5 ][ d-flex justify-content-around ]( mobile-icon-bar )">
			<a target="_blank" href="https://www.facebook.com/PrideCircles/" class="facebook"><i class="fa fa-fw fa-facebook"></i></a>

			<a target="_blank" href="https://twitter.com/pride_circle" class="twitter"><i class="fa fa-fw fa-twitter"></i></a>

			<a target="_blank" href="https://www.instagram.com/pride_circle/" class="google"><i class="fa fa-fw fa-instagram"></i></a>
		</div>

		<div class="[  d-flex justify-content-around ]( mobile-icon-bar )">
			<a target="_blank" href="https://www.linkedin.com/groups/10392130/" class="linkedin"><i class="fa fa-fw fa-linkedin"></i></a>

			<a target="_blank" href="https://www.youtube.com/channel/UCoaAZWnpjFXcCQ5Und9mi0Q" class="youtube"><i class="fa fa-fw fa-youtube"></i></a>

			<a target="_blank" href="mailto:contact@thepridecircle.com?subject=21DaysAllyChallenge" class="about_us_social_link"><i class="fa fa-fw fa-envelope"></i></a>
		</div>
	</div>

	<div id="partners" class="[ mt-3 py-5 ][ container ]">
		<div class="[ pt-4 pb-5 pb-md-0  ][ text-center ]">
			<h1>POWERED BY</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-center ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/powered-by-cognizant.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/powered-by-dell.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:80px; height:auto" src="<?= $rootpath;?>images/powered-by-ig.png" alt="">
			</div>


		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/powered-by-msd.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath;?>images/powered-by-northern-trust.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?= $rootpath;?>images/powered-by-novartis.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/powered-by-ubs.png" alt="">
			</div>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:70px" src="<?= $rootpath;?>images/powered-by-uniliver.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:80px" src="<?= $rootpath;?>images/powered-by-wf.jpg" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/powered-by-zs.png" alt="">
			</div>
		</div>
	</div>

	<div class="[ mt-3 py-5 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>REWARDS PARTNERS</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/rewards-capgemini.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath;?>images/rewards-hidesign.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:160px; height:auto" src="<?= $rootpath;?>images/rewards-indeed.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:140px; height:auto" src="<?= $rootpath;?>images/rewards-infosys.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/rewards-intuit.png" alt="">
			</div>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/rewards-nielsen.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:290px; height:auto" src="<?= $rootpath;?>images/rewards-pb.png" alt="">
			</div>


			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/rewards-sodexo.jpg" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/powered-by-ubs.png" alt="">
			</div>
		</div>
	</div>

	<div class="[ mt-3 py-5 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>INTERNATIONAL PARTNERS</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-center ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?= $rootpath;?>images/international-felgtb.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:160px; height:auto" src="<?= $rootpath;?>images/HRCFoundation.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:160px; height:auto" src="<?= $rootpath;?>images/international-lcw.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:80px; height:auto" src="<?= $rootpath;?>images/international-mygwork.png" alt="">
			</div>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">


			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:180px; height:auto" src="<?= $rootpath;?>images/OutEqual.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:130px; height:auto" src="<?= $rootpath;?>images/international-out-at-work.jpg" alt="">
			</div>


			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/Shanghai Pride.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:180px; height:auto" src="<?= $rootpath;?>images/Stonewall-white.jpg" alt="">
			</div>
		</div>
	</div>

	<div class="[ mt-3 py-5 ][ container ]">
		<div class="[ pt-4 pb-5 ][ text-center ]">
			<h1>PARTICIPATING ORGANIZATIONS</h1>
		</div>

		<div class="[ row ]">
			<div class="[ col-md-1 ]">
			</div>

			<?php
				/* Get all the companies */
				$participating_companies_array = array_filter(array_map('trim', explode(",", $page->participating_companies_list)));

				/* Sort alphabetically */
				natcasesort($participating_companies_array);
//print_r($participating_companies_array);
				/* Counters */
				$company_counter = 1;
				$row_counter = 1;

				foreach($participating_companies_array as $company_name){
			?>
			<div class="[ py-2 py-md-4 ][ col-md-2 text-center ]">
				<strong><?=$company_name?></strong>
			</div>

			<?php
					if($company_counter == 5){
						$row_counter++;
						$company_counter = 0;
			?>

				<div class="[ col-md-1 ]">
				</div>
			</div>

			<div class="[ row ]">
				<div class="[ col-md-1 ]">
				</div>

			<?php
					}

					$company_counter++;
				}
			?>

			<div class="[ col-md-1 ]">
			</div>
		</div>

		<!-- <div class="[ d-md-flex justify-content-md-around ]">
			<div>
				<img class="[ img-fluid ]" src="<?= $rootpath;?>images/participating_org.png" alt="">
			</div>
		</div> -->
	</div>

	<div class="[ mt-3 py-5 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>OUTREACH PARTNERS</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/outreach-acme.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/outreach-beunic.jpg" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:130px; height:auto" src="<?= $rootpath;?>images/outreach-cab.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath;?>images/outreach-hh.jpg" alt="">
			</div>
		</div>

		<div class="[ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/outreach-iimally.jpg" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/outreach-linkedin.PNG" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath;?>images/outreach-litfest.jpg" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:90px; height:auto" src="<?= $rootpath;?>images/outreach-mdi.jpg" alt="">
			</div>
		</div>

		<div class="[ d-md-flex justify-content-md-center ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath;?>images/outreach-qknit.jpg" alt="">
			</div>

            <div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/outreach_solidarity.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/outreach-school.jpg" alt="">
			</div>
		</div>
	</div>

	<div class="[ mt-3 py-5 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>YOUTH DIGITAL PARTNER</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/youth_partner_yka.jpg" alt="">
			</div>
		</div>
	</div>

	<div class="[ mt-3 py-5 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>PR PARTNER</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/pr-avian-we.jpg" alt="">
			</div>
		</div>

<!-- 	<div class="[ mt-3 py-5 ][ container ]">
		<a href="https://twitter.com/intent/tweet?button_hashtag=21daysallychallenge&ref_src=twsrc%5Etfw" class="twitter-hashtag-button" data-show-count="false">Tweet #21daysallychallenge</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	</div> -->

		<div class="[ py-5 ]( shodow )">

		</div>

		<div class="[ pb-4 ][ container ]">
			<div class="[ row pt-3 ]">
				<div class="[ offset-md-2 col-md-4 ][ text-center ]">
					<a href="https://www.thepridecircle.com/site/templates/assets/PrivacyPolicy-PrideCircle.pdf" target="_blank" class="[ text-secondary ]" title="">Pride Circle Privacy Policy</a>
				</div>

				<div class="[ col-md-4 ][ text-center ]">
					<a href="https://gleam.io/privacy" target="_blank"  class="[ text-secondary ]" title="">Gleam Privacy Policy</a>
				</div>

				<div class="[ pt-4 ][ col-md-12 ][ text-center ]">
					<img src="<?=$rootpath?>images/pride_circle_logo_square.jpg" style="width:70px; height:auto"  alt="">
				</div>

				<div class="[ pt-3 ][ col-12 ][ text-center ]">
					Copyright © 2020 Pride Circle
				</div>

				<!-- <div class="[ pt-3 ][ col-12 ][ text-center ]">
					Developed by <a href="mailto:todkar.amrut27897@gmail.com">ProAutomater</a>
				</div> -->
			</div>
		</div>
	</div>

	<!-- Page-specific JS -->

	<script src="<?= $rootpath;?>scripts/tweetjs.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		$(document).on("click", "#navbarNav .nav-link", function(){
			if(!$("#navbar-toggler").hasClass("collapsed")){
				$("#navbar-toggler").addClass("collapsed");
				$("#navbar-toggler").attr("aria-expanded", "false");
				$("#navbarNav").removeClass("show");
			}
		})

// 		/* For tweet embedding */
// 		TweetJs.Search("21daysallychallenge", function (data) {

// //console.log(JSON.stringify(data.statuses[0]))
// 			/* array of tweets to be filled up */
// 			let tweet_object = [];
// tweet_object.push("tweet");
// 			for (let key in data.statuses) {
// 				temp_tweet = data.statuses[key];
// 				let tweet = {};
// //console.log(JSON.stringify(temp_tweet))
// 				tweet.text = temp_tweet.text;
// 				let temp_urls = temp_tweet.entities.urls[0];
// 				tweet.link = temp_urls;
// console.log(temp_urls);
// 				tweet.username = temp_tweet.user.name;
// 				tweet.image = temp_tweet.user.profile_image_url_https;

// 				tweet_object.push(tweet);
// 			}


// console.log(JSON.stringify(tweet_object))
// 		});
// 	/* For tweet embedding END */
	})
</script>

	<script>
  window.intercomSettings = {
    app_id: "q55fbh8u"
  };
</script>

<script>
// We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/q55fbh8u'
(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/q55fbh8u';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>

	<!-- ---------- JS LINKS END ---------- -->

	<!-- Linkedin code -->
<script type="text/javascript"> _linkedin_partner_id = "3744588"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3744588&fmt=gif" /> </noscript>
	<!-- End Linkedin code -->
</body>
</html>