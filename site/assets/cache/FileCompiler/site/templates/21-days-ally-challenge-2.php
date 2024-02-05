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
					<a class="nav-link ( underline-button )" href="#to-participate">To participate</a>
					</li>
					<li class="nav-item">
					<a class="nav-link ( underline-button )" href="#play-here">Sign Up</a>
					</li>

					<li class="nav-item">
					<a class="nav-link ( underline-button )" href="#leaderboard">Leaderboard</a>
					</li>

					<li class="nav-item">
					<a class="nav-link ( underline-button )" href="#resources">Resources</a>
					</li>

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
			<a href="<?= $rootpath?>files/21DaysAllyChallenge_slides.pdf" class="[ text-primary ]" style="font-size: 1.2rem"><i class="[ fa fa-cloud-download-alt ]"></i> Download These Slides</a>
		</div>
	</div>

	<div id="to-participate" class="[ pt-5 pb-2 ][ container ]">
		<div class="[ pt-4 pb-2 ][ text-center ]">
			<h1>TO PARTICIPATE (TUTORIAL)</h1>
		</div>

		<div class="[ mt-3 ][ row ]">
			<div class="[ offset-md-3 col-md-6 ]">
				<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/x7nQr7W9QvI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>

			<!-- <div class="[ col-md-6 ]">
				<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/x7nQr7W9QvI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div> -->
		</div>
	</div>

	<div id="play-here" class="[ pt-5 pb-2 ][ container ]">
		<div class="[ pt-4 pb-2 ][ text-center ]">
			<h1>SIGN UP</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 mt-3 ][ row ]">
			<div class="[ col-md-4 ][ text-center ]">
				<a class="[ pb-2 ]( underline-button )" target="_blank" href="<?= $rootpath?>files/Quick_Pointers_21DaysAllyChallenge.pdf">Get Started</a>
			</div>

			<div class="[ col-md-4 ][ text-center ]">
				<a class="[ px-4 pb-2 ]( underline-button )" target="_blank" href="<?= $rootpath;?>files/faq_21DaysAllyChallenge.pdf">FAQ</a>
			</div>

			<div class="[ col-md-4 ][ text-center ]">
				<a class="[ pb-2 ]( underline-button )" target="_blank" href="<?= $rootpath;?>files/T&C_21DaysAllyChallenge.pdf">Terms & Conditions</a>
			</div>
		</div>
	</div>

	<div class="[ container ]">
		<div class="[ row ]">
			<div class="[ offset-md-2 col-md-8 ][ pt-5 pb-3 ]">
				<a class="e-widget no-button generic-loader" href="https://gleam.io/6ruFZ/21daysallychallenge" rel="nofollow">#21DaysAllyChallenge</a>
				<script type="text/javascript" src="https://widget.gleamjs.io/e.js" async="true"></script>
			</div>
		</div>
	</div>

	<div id="leaderboard" class="[ pt-5 pb-2 ][ container ]">
		<div class="[ pt-4 pb-2 ][ text-center ]">
			<h1>LEADERBOARD</h1>
		</div>
		<div class="[ d-flex justify-content-around ]">
<div class="">

</div>
		</div>
		<div>
			<ul class="[ py-3 ][ nav ][ d-flex justify-content-around ]" id="myTab" role="tablist">
				<li class="[ nav-item text-center ]">
					<a class="[ px-5 ][ nav-link active ]( underline-button )" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">INDIVIDUAL</a>
				</li>
				<li class="[ nav-item text-center ]">
				<a class="[ px-5 ][ nav-link ]( underline-button )" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ORGANIZATION/GROUP</a>
				</li>
			</ul>

			<div style="margin:auto; width:100%; height:18rem; border:2px solid rgb(66,139,202);" class="[ p-md-2 ][ tab-content ]" id="myTabContent">
				<div class="[ tab-pane fade show active ][ text-center ]" id="home" role="tabpanel" aria-labelledby="home-tab">
					<h4 class="[ mt-5 pt-5 ][ text-muted ]">The Leaderboard Will Be Live From June 1</h4>
				</div>

				<div class="[ tab-pane fade ][ text-center ]" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<h4 class="[ mt-5 pt-5 ][ text-muted ]">The Leaderboard Will Be Live From June 1</h4>
				</div>

				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">asdaa...</div>
			</div>

		</div>
	</div>

<div id="resources" class="[ py-5 container ]">
	<div class="[ pt-4 pb-2 ][ text-center ]">
		<h1>RESOURCES</h1>
	</div>

	<div class="accordion" id="accordionExample">
		<div id="allyship" class="[ card ][ border-0 ]">
			<div class="[ card-header ][ bg-white border-0 ][ text-center ]" id="headingOne">
				<button class="[ btn btn-link ]( underline-button )" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				Allyship
				</button>
			</div>

			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="[ card-body ]( collapse-card-body )">
					<p>An ally, straight ally, or heterosexual ally is a heterosexual and cisgender person who supports equal civil rights, gender equality, and LGBT social movements, challenging homophobia, biphobia, and transphobia. Not everyone who meets this definition identifies as an "ally". An ally acknowledges that LGBTQ people face discrimination and thus are socially disadvantaged. They aim to use their position and privilege as heterosexual and cisgender individuals in a society focused on heteronormativity to counter discrimination against LGBTQ people.<div class="[ pr-5 ][ text-right ]">-Wikipedia</div></p>

					<br>

					<p>As social animals, we all need allies/friends in life. We all have allies in our lives who stick along in the tough times, who are there to share our happiness. Below are some resources on being an ally to the LGBT+ community. </p>

					<ol>
						<li><a href="https://open.buffer.com/lgbtqia-resources/" title="">50+ Resources For LGBTQIA Allies</a></li>

						<li><a href="https://www.glaad.org/resources/ally/2" title="">10 Ways to Be an Ally & a Friend</a></li>

						<li><a href="https://www.hrc.org/resources/straight-guide-to-lgbt-americans" title="">Coming Out as a Supporter</a></li>

						<li><a href="https://www.slideshare.net/MidushiPandey/ally-toolkit-54324051" title="">LGBT Ally Toolkit</a></li>

						<li><a href="https://lynnthorne.com/2018/10/23/doing-more-as-an-lgbt-ally/" title="">Doing More as an LGBT Ally</a></li>

						<li><a href="https://bolt.straightforequality.org/files/Straight%20for%20Equality%20Publications/3rd-edition-guide-to-being-a-straight-ally.pdf" title="">Guide to being a straight ally</a></li>

						<li><a href="https://www.oprahmag.com/life/relationships-love/a28159555/how-to-be-lgbtq-ally/" title="">6 Ways to Respectfully Be a Better LGBTQ Ally</a></li>

						<li><a href="https://feminisminindia.com/2018/08/08/infographic-ally-indian-queer/" title="">Infographic: Your Guide To Being A Better Ally To The Indian Queer Cause</a></li>

						<li><a href="https://www.stonewall.org.uk/sites/default/files/straight_allies.pdf" title="">Straight Allies</a></li>

						<li><a href="https://www.forbes.com/sites/brianhonigman/2016/07/20/lgbtq-ally-at-work/#636ce1ab42fc" title="">How To Be An LGBTQ Ally At Work</a></li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>

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

	<div id="partners" class="[ pt-5 pb-3 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>POWERED BY</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:100px; height:auto" src="<?= $rootpath;?>images/powered-by-northern-trust.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/powered-by-ubs.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="height:70px; width:auto" src="<?= $rootpath;?>images/powered-by-uniliver.png" alt="">
			</div>
		</div>
	</div>

	<div class="[ py-2 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>REWARDS PARTNERS</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/rewards-capgemini.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/rewards-pb.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/powered-by-ubs.png" alt="">
			</div>
		</div>
	</div>

	<div class="[ py-3 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>INTERNATIONAL PARTNERS</h1>
		</div>

		<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/HRCFoundation.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/OutEqual.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/Shanghai Pride.png" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/Stonewall-white.jpg" alt="">
			</div>
		</div>
	</div>

	<div class="[ mt-3 py-5 ][ container ]">
		<div class="[ pt-4 ][ text-center ]">
			<h1>PARTICIPATING ORGANIZATIONS</h1>
		</div>

		<div class="[ d-md-flex justify-content-md-around ]">
			<div>
				<img class="[ img-fluid ]" src="<?= $rootpath;?>images/participating_org.jpg" alt="">
			</div>
		</div>
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
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/outreach-iimally.jpg" alt="">
			</div>
			
			<div class="[ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/outreach-linkedin.PNG" alt="">
			</div>
		</div>

		<div class="[  ][ d-md-flex justify-content-md-around ]">
			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:100px; height:auto" src="<?= $rootpath;?>images/outreach-litfest.jpg" alt="">
			</div>

			<div class="[ p-5 ][ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:100px; height:auto" src="<?= $rootpath;?>images/outreach-qknit.jpg" alt="">
			</div>
            
            <div class="[ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath;?>images/outreach_solidarity.png" alt="">
			</div>

			<div class="[ align-self-center ][ text-center ]">
				<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath;?>images/outreach-school.jpg" alt="">
			</div>
		</div>
	</div>

		<div class="[ py-5 ]( shodow )">

		</div>

	<div class="[ pb-4 ][ container ]">
		<div class="[ row pt-3 ]">
			<div class="[ offset-md-2 col-md-4 ][ text-center ]">
				<a href="#" class="[ text-secondary ]" title="">Pride Circle Privacy Policy</a>
			</div>

			<div class="[ col-md-4 ][ text-center ]">
				<a href="#" class="[ text-secondary ]" title="">Gleam Privacy Policy</a>
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

	</script>

	<!-- Page-specific JS -->
<script>
	$(document).ready(function(){
		$(document).on("click", "#navbarNav .nav-link", function(){
			if(!$("#navbar-toggler").hasClass("collapsed")){
				$("#navbar-toggler").addClass("collapsed");
				$("#navbar-toggler").attr("aria-expanded", "false");
				$("#navbarNav").removeClass("show");
			}
		})
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
</body>
</html>