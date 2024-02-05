<?php
if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
	//Tell the browser to redirect to the HTTPS URL.
	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	//Prevent the rest of the script from executing.
	exit;
}
header("X-Frame-Options: ALLOW-FROM https://priallychallenge.thepridecircle.com");
header("X-XSS-Protection: 0");
// header("Content-Security-Policy: frame-ancestors https://priallychallenge.thepridecircle.com");
// Content-Security-Policy: frame-ancestors 'self' https://www.maindomain.com;


header("Content-Security-Policy: frame-ancestors 'self' https://priallychallenge.thepridecircle.com");



$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html>

<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-208516648-2');
	</script> -->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
	<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-C3XCR831MS');
	</script> -->

	<script>
		let website_rootpath = '<?= $config->urls->httpRoot ?>resume/';
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->


	<title><?= $page->title ?> | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $rootpath; ?>favicon.png" />

	<link rel="icon" href="<?= $rootpath; ?>images/index.png" sizes="32x32" />

	<!-- social sharing -->
	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="<?= $page->title ?> | Pride Circle">
	<meta property="og:image" content="<?= $page->general_image->httpUrl; ?>">
	<meta property="og:description" content="<?= $page->og_description; ?>">
	<meta property="og:url" content="<?= $page->httpUrl ?>">

	<meta name="twitter:title" content="<?= $page->title ?> | Pride Circle">
	<meta name="twitter:description" content="<?= $page->og_description; ?>">
	<meta name="twitter:image" content="<?= $page->general_image->httpUrl; ?>">
	<meta name="twitter:card" content="<?= $page->title ?>">

	<meta property="og:site_name" content="Pride Circle">
	<meta name="twitter:image:alt" content="<?= $page->general_image->httpUrl; ?>">
	<!-- ---------- META TAGS END ---------- -->
	<!-- social sharing end -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $rootpath; ?>styles/bootstrap.min.css">
	<!-- Fonts Style CSS -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= $rootpath; ?>styles/owl.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<style>
		body {
			font-family: 'Roboto', sans-serif;

		}

		#navbar-md-logo {
			position: relative;
			left: 0;
			top: 0;
		}

		#carouselExampleIndicators {
			-webkit-box-shadow: 2px 2px 3px 3px #ddd;
			-moz-box-shadow: 2px 2px 3px 3px #ddd;
			box-shadow: 2px 2px 3px 3px #ddd;
		}

		#slider_container {
			/*margin-top: 5.5rem;*/
			margin-top: 2.5rem;
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


		.mobile-icon-bar a {
			height: 44px;
			width: 50px;
			border-radius: 50px;
			text-align: center;
			padding: 10px;
			transition: all 0.3s ease;
			color: white;
			font-size: 18px;
			/*margin-right:10px;*/
			margin: 0px 5px;
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

		.linktree {
			background: #28BF7B;
			color: white;
		}

		/* Style for the navbar */
		#navbar,
		.shodow {
			-webkit-box-shadow: 0 3px 6px -6px black;
			-moz-box-shadow: 0 3px 6px -6px black;
			box-shadow: 0 3px 6px -6px black;
		}

		#navbar .nav-link {
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

			padding: 0.5rem 1rem;
		}

		/** 2022-05-22 Code by Amruta Jagtap */
		.img-responsive.mobile {
			display: none;
			width: 100%;
			height: auto;
		}

		.img-responsive {
			width: 100%;
			height: auto;
		}

		.ally_banner {
			margin-top: 69px;
			position: relative;
			z-index: 999;
		}

		.banner_text {
			padding-top: 21px;
		}

		.leaderboard_h2 {
			margin-top: 7rem;
		}

		.title_font {
			font-weight: 600;
			font-family: 'Montserrat', sans-serif;
		}

		.testimonial-item h4 {
			font-size: 19px;
			font-weight: 700;
			color: #8b1956;
			letter-spacing: 0.5px;
			margin-bottom: 0px;
		}

		.testimonial-item span {
			display: inline-block;
			margin-top: 8px;
			font-weight: 600;
			font-size: 14px;
			color: #e77817;
		}

		.icon-bar a {
			display: block;
			text-align: center;
			padding: 7px;
			transition: all 0.3s ease;
			color: white;
			font-size: 20px;
		}

		.covid_banner {
			position: fixed;
			top: 80%;
			-webkit-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			transform: translateY(-50%);
			/*background-color:darkgrey;*/
			right: 0;
			z-index: 997;
			border-top-left-radius: 23px;
			border-bottom-left-radius: 23px;
			padding-left: 0.8rem;
		}

		.covid_banner a {
			display: block;
			text-align: center;
			padding: 3px;
			transition: all 0.3s ease;
			color: white;
			font-weight: 500;
			font-size: 15px;
			line-height: 17px;
		}

		.covid_banner_mobile {
			/*position: fixed;*/
			top: 80%;
			-webkit-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			transform: none;
			/*background-color:darkgrey;*/
			right: 0;
			z-index: 1004;
			border-top-left-radius: 23px;
			border-bottom-left-radius: 23px;
			margin-right: 0px;
			margin-left: auto;
			/*padding-left: 0.8rem;*/
			/*padding-right: 0.5rem;*/
		}

		.covid_banner_mobile a {
			/*display: block;*/
			text-align: center;
			padding: 8px;
			transition: all 0.3s ease;
			color: white;
			font-weight: 500;
			font-size: 15px;
			line-height: 17px;
			border-top-left-radius: 23px;
			border-bottom-left-radius: 23px;
		}

		.text_test_one {
			display: flex;
		}

		.text_test_two {
			padding-left: 20px;
		}

		.dropdown-toggle::after {
			border-top: none;
		}

		.header_logo_one {
			margin-left: 5rem;
		}

		.header_logo_two {
			margin-right: 5rem;
		}

		.dropdown-menu {
			min-width: 0rem;
			top: 105%;
			padding: 0 0 0.5rem 0;
			margin: 0px;
		}

		.menu-item .dropdown-menu {
			display: none;
		}

		.menu-item:hover .dropdown-menu {
			display: block;
		}

		.dropdown-item {
			display: block;
			width: 100%;
			padding: 0.5rem 1.5rem;
			clear: both;
			font-weight: 400;
			color: #212529;
			text-align: inherit;
			white-space: nowrap;
			/* background-color: transparent; */
			border-radius: 10px;
		}

		.dropdown-item.active,
		.dropdown-item:active {
			color: rgb(66, 139, 202) !important;
		}


		.leaderboard_text p {
			font-size: 1rem;
		}

		.register_text p {
			font-size: 1rem;
		}

		.register_sign_up {
			border: 5px solid;
			width: 540px;
			height: auto;
			border-color: rgba(66, 139, 202, 1);
		}

		.register_sign_up h2 {
			margin-top: 16px;
			font-size: 1.5rem;
		}

		.text-testimonials {}

		.partners_logo {
			display: flex;
		}

		.covid_logo {
			display: flex;
		}

		/*.register_tooltip{*/
		/*    cursor:pointer;*/
		/*}*/
		@media screen and (max-width: 895px) and (min-width: 780px) {
			.header_logo_one {
				margin-left: 2rem;
			}

			.header_logo_two {
				margin-right: 3rem;
			}

		}

		@media screen and (max-width: 1024px) and (min-width: 768px) {
			.ally_banner {
				margin-top: 79px;
				position: relative;
				z-index: 999;
			}

		}

		@media screen and (max-width: 1024px) and (min-width: 1000px) {
			.ally_banner {
				margin-top: 72px;
				position: relative;
				z-index: 999;
			}

		}

		@media screen and (max-width: 976px) and (min-width: 768px) {
			.partners_logo {
				display: block;
			}

			.covid_logo {
				display: block;
			}
		}

		@media only screen and (max-width: 768px) {
			.partners_logo {
				display: block;
			}

			.covid_logo {
				display: block;
			}

			.title_break_style {
				overflow-wrap: break-word !important;
			}

			.badge {
				white-space: inherit;
			}

		}

		@media only screen and (max-width: 576px) {
			.underline-button {
				padding-top: 1.2rem;
			}

			/** 2022-05-22 Code by Amruta Jagtap */
			.img-responsive {
				display: none;
			}

			.img-responsive.mobile {
				display: block;
			}

			.text_spacing_sections {
				padding: 0px 19px;
			}

			#slider_container {
				margin-top: 1.5rem;
			}


			/**End 2022-05-22 Code by Amruta Jagtap */
		}

		.underline-button.active,
		.underline-button[aria-expanded=true],
		.underline-button:hover {
			text-decoration: none;
			color: rgb(66, 139, 202) !important;
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

		.underline-button.active:after,
		.underline-button[aria-expanded=true]:after,
		.underline-button:hover:after {
			width: 100%;
			left: 0;
			background: rgba(66, 139, 202, 1);
		}

		/* Style for navbar End */

		/* Gleam iframe styles */
		.e-widget-wrapper {
			border: 5px solid rgba(66, 139, 202, 1);
			padding-bottom: 0px;
			margin-bottom: 0px;
			max-width: 540px;
		}

		.sign-up-indicator {
			background-color: rgba(66, 139, 202, 1);
			width: 540px;
		}


		@media only screen and (max-width: 990px) {
			.sign-up-indicator {
				width: 450px;
			}

			/*Code by Amruta*/
			.register_sign_up {
				width: 540px;
			}
		}

		@media only screen and (max-width: 1024px) and (min-width: 768px) {
			.sign-up-indicator {
				width: 540px !important;
			}

			/*Code by Amruta*/
			/*.register_sign_up{*/
			/*   width: 540px;*/
			/*   }*/
		}

		@media only screen and (max-width: 767px) {
			.sign-up-indicator {
				width: 510px;
			}

			.text_spacing_sections {
				padding: 0px 19px;
			}

			/*Code by Amruta*/
			.register_sign_up {
				width: 510px;
			}

			.register_sign_up h2 {
				margin-top: 7px;
				font-size: 1.5rem;
			}

			/*.menu-link:after{*/
			/*    margin-left:3rem;*/
			/*}*/

		}

		/** 2022-05-22 Code by Amruta Jagtap */
		@media only screen and (max-width: 991px) and (min-width: 768px) {
			/*@media screen and (max-width: 900px) and (min-width: 769px){*/
			/*@media only screen and (max-width: 900px){*/

			.navbar .header_logo_one {
				display: none !important;
			}

			.navbar .header_logo_two {
				display: none !important;
			}

			/* .navbar .container{*/
			/*     display:flex!important;*/

			/*}*/
			.navbar-brand {
				display: inline-block !important;
			}

		}

		/** End 2022-05-22 Code by Amruta Jagtap */
		@media only screen and (max-width: 575px) {
			.sign-up-indicator {
				width: 100%;
			}

			/*Code by Amruta*/
			.register_sign_up {
				width: 100%;
			}
		}

		/* Gleam iframe styles END */

		/* Collapse style */
		.collapse-card-body {
			background-color: rgba(66, 139, 202, 0.1)
		}

		/* Collapse style END*/

		/*Code by Amruta text testimonials*/

		@media (max-width:991.98px) {
			.padding {
				padding: 1.5rem
			}
		}

		@media (max-width:767.98px) {
			.padding {
				padding: 1rem
			}
		}

		.padding {
			padding: 5rem
		}

		.text_card {
			position: relative;
			display: flex;
			width: 350px;
			height: 171px;
			flex-direction: column;
			min-width: 0;
			word-wrap: break-word;
			background-color: #fff;
			background-clip: border-box;
			border: 1px solid #d2d2dc;
			border-radius: 11px;
			-webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
			-moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
			box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
		}

		.text_card .text_card_body {
			padding: 1rem 1rem
		}

		.text_card_body {
			flex: 1 1 auto;
			padding: 1.25rem
		}

		p {
			font-size: 0.875rem;
			margin-bottom: .5rem;
			line-height: 1.5rem
		}

		h4 {
			line-height: .2 !important
		}

		.profile {
			margin-top: 16px;
			margin-left: 11px
		}

		.profile-pic {
			width: 58px
		}

		.cust-name {
			font-size: 18px
		}

		.cust-profession {
			font-size: 10px
		}

		.items {
			width: 90%;
			margin: 0px auto;
			/*margin-top: 100px*/
		}

		.slick-slide {
			margin: 10px
		}

		/*.slick-prev, .slick-next {*/
		/*    font-size: 0;*/
		/*    line-height: 0;*/
		/*    position: absolute;*/
		/*    top: 50%;*/
		/*    display: block;*/
		/*    width: 20px;*/
		/*    height: 20px;*/
		/*    padding: 0;*/
		/*    -webkit-transform: translate(0, -50%);*/
		/*    -ms-transform: translate(0, -50%);*/
		/*    transform: translate(0, -50%);*/
		/*    cursor: pointer;*/
		/*    color: transparent;*/
		/*    border: none;*/
		/*    outline: none;*/
		/*    background: #adb5bd47;*/
		/*}*/
		/*.slick-prev:hover, .slick-prev:focus, .slick-next:hover, .slick-next:focus {*/
		/*    background: #adb5bd47;*/
		/*}*/

		.slick-prev:before,
		.slick-next:before {
			font-family: 'slick';
			font-size: 20px;
			line-height: 1;
			opacity: .75;
			color: #adb5bd;
			-webkit-font-smoothing: antialiased;
		}

		@media screen and (max-width: 768px) {
			.text_card {
				position: relative;
				display: flex;
				width: 350px;
				height: 252px;
				flex-direction: column;
				min-width: 0;
				word-wrap: break-word;
				background-color: #fff;
				background-clip: border-box;
				border: 1px solid #d2d2dc;
				border-radius: 11px;
				-webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
				-moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
				box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
			}

			.twitter_embed {
				text-align: center;
				margin-top: 2rem;
			}

			.facebook_embed {
				text-align: center;
			}
		}

		@media screen and (max-width: 1024px) and (min-width: 768px) {
			.text_card {
				position: relative;
				display: flex;
				width: 350px;
				height: 275px;
				flex-direction: column;
				min-width: 0;
				word-wrap: break-word;
				background-color: #fff;
				background-clip: border-box;
				border: 1px solid #d2d2dc;
				border-radius: 11px;
				-webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
				-moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
				box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
			}


		}

		@media screen and (max-width: 767px) and (min-width: 597px) {
			.text_card {
				position: relative;
				display: flex;
				width: 350px;
				height: 382px;
				flex-direction: column;
				min-width: 0;
				word-wrap: break-word;
				background-color: #fff;
				background-clip: border-box;
				border: 1px solid #d2d2dc;
				border-radius: 11px;
				-webkit-box-shadow: 0px 0px 5px 0px rgb(249, 249, 250);
				-moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
				box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
			}


		}

		@media screen and (max-width: 768px) and (min-width: 574px) {
			.covid_banner_mobile {
				/*position: fixed;*/
				top: 80%;
				-webkit-transform: translateY(-50%);
				-ms-transform: translateY(-50%);
				transform: none;
				/*background-color:darkgrey;*/
				right: 0;
				z-index: 1004;
				border-top-left-radius: 23px;
				border-bottom-left-radius: 23px;
				/*padding-left: 0.8rem;*/
				padding-right: 0.5rem;
			}

			.covid_banner_mobile a {
				/*display: block;*/
				text-align: center;
				padding: 8px;
				transition: all 0.3s ease;
				color: white;
				font-weight: 500;
				font-size: 15px;
				line-height: 17px;
			}

		}

		/*@media screen and (max-width: 616px) and (min-width: 574px) {*/
		/*.covid_banner_mobile{*/
		/*position: fixed;*/
		/*  top: 80%;*/
		/*  -webkit-transform: translateY(-50%);*/
		/*  -ms-transform: translateY(-50%);*/
		/*  transform: none;*/
		/*background-color:darkgrey;*/
		/*  right:0;*/
		/*  z-index: 1004;*/
		/*   border-top-left-radius: 23px;*/
		/*    border-bottom-left-radius: 23px;*/
		/*    padding-left: 10.8rem;*/
		/*padding-right: 0.5rem;*/
		/*}*/
		/*.covid_banner_mobile a{*/
		/*display: block;*/
		/*  text-align: center;*/
		/*  padding: 8px ;*/
		/*  transition: all 0.3s ease;*/
		/*  color: white;*/
		/*  font-weight:500;*/
		/*  font-size: 15px;*/
		/*    line-height: 17px;*/
		/*}*/

		/*}*/

		/*@media screen and (max-width: 571px) and (min-width: 414px) {*/
		/*.covid_banner_mobile{*/
		/*position: fixed;*/
		/*  top: 80%;*/
		/*  -webkit-transform: translateY(-50%);*/
		/*  -ms-transform: translateY(-50%);*/
		/*  transform: none;*/
		/*background-color:darkgrey;*/
		/*  right:0;*/
		/*  z-index: 1004;*/
		/*   border-top-left-radius: 23px;*/
		/*    border-bottom-left-radius: 23px;*/
		/*    padding-left: 10.8rem;*/
		/*padding-right: 0.5rem;*/
		/*}*/
		/*.covid_banner_mobile a{*/
		/*display: block;*/
		/*  text-align: center;*/
		/*  padding: 8px ;*/
		/*  transition: all 0.3s ease;*/
		/*  color: white;*/
		/*  font-weight:500;*/
		/*  font-size: 15px;*/
		/*    line-height: 17px;*/
		/*}*/

		/*}*/

		/*@media screen and (max-width: 768px) and (min-width: 622px) {*/
		/*.covid_banner_mobile{*/
		/*position: fixed;*/
		/*  top: 80%;*/
		/*  -webkit-transform: translateY(-50%);*/
		/*  -ms-transform: translateY(-50%);*/
		/*  transform: none;*/
		/*background-color:darkgrey;*/
		/*  right:0;*/
		/*  z-index: 1004;*/
		/*   border-top-left-radius: 23px;*/
		/*    border-bottom-left-radius: 23px;*/
		/*    padding-left: 10.8rem;*/
		/*padding-right: 0.5rem;*/
		/*}*/
		/*.covid_banner_mobile a{*/
		/*display: block;*/
		/*  text-align: center;*/
		/*  padding: 8px ;*/
		/*  transition: all 0.3s ease;*/
		/*  color: white;*/
		/*  font-weight:500;*/
		/*  font-size: 15px;*/
		/*    line-height: 17px;*/
		/*}*/

		/*}*/

		@media screen and (max-width: 314px) {


			.mobile-icon-bar a {
				height: 43px;
				width: 50px;
				border-radius: 50px;
				text-align: center;
				padding: 9px;
				transition: all 0.3s ease;
				color: white;
				font-size: 18px;
				/*margin-right: 0px;*/
				margin: 0px 1px;
			}
		}

		@media screen and (max-width: 353px) and (min-width: 315px) {


			.mobile-icon-bar a {
				height: 43px;
				width: 50px;
				border-radius: 50px;
				text-align: center;
				padding: 10px;
				transition: all 0.3s ease;
				color: white;
				font-size: 18px;
				/*margin-right: 4px;*/
				margin: 0px 1px;
			}
		}

		/* ============ small devices ============ */
		@media (max-width: 991px) {
			.dropdown-menu .dropdown-menu {
				margin-left: 0.7rem;
				margin-right: 0.7rem;
				margin-bottom: .5rem;
			}
		}

		/* ============ small devices .end// ============ */
		@media screen and (max-width: 568px) and (min-width: 320px) {
			.e-widget-wrapper {
				overflow-x: scroll;
			}

		}

		/*End Code by Amruta text testimonials*/

		/* css by pooja for register title */
		.black_text {
			color: #000 !important;
		}

		iframe[src="https://priallychallenge.thepridecircle.com/"] {
			height: 700px;
		}

		@media(max-width: 767px) {
			iframe[src="https://priallychallenge.thepridecircle.com/"] {
				height: 1040px;
			}
		}

		/* hide banners in web and mobile view */

		@media (min-width: 991px) {
			.hide-in-web-view {
				display: none;
			}
		}

		@media (max-width: 992px) {
			.hide-in-mob-view {
				display: none;
			}
		}

		/* css by pooja end */
	</style>
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $rootpath; ?>scripts/jquery.min.js" type="text/javascript"></script>
	<script src="<?= $rootpath; ?>scripts/popper.min.js"></script>
	<!--<script src="<?= $rootpath; ?>scripts/bootstrap.min.js"></script>-->
	<script src="https://unpkg.com/tooltip.js"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $rootpath; ?>scripts/bootstrap.min.js" type="text/javascript" async></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous" async></script>

	<script src="<?= $rootpath; ?>scripts/owl.js" type="text/javascript" async></script>

	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<!--<script src="<?= $rootpath; ?>scripts/bootstrap.bundle.min.js" type="text/javascript" async></script>-->
	<!--<script src="<?= $rootpath; ?>scripts/bootstrap.bundle.js" type="text/javascript" async></script>-->
	<!--<script src="<?= $rootpath; ?>scripts/popper.min.js" type="text/javascript" async></script>-->
	<!--<script src="<?= $rootpath; ?>scripts/Popper.js" type="text/javascript" async></script>-->
	<!--<script src="https://unpkg.com/@popperjs/core@2" type="text/javascript" async></script>-->

	<!--<script src="<?= $rootpath; ?>scripts/jquery.min.js"></script>-->
	<!--<script src="https://unpkg.com/popper.js"></script>-->
	<!--   <script src="https://unpkg.com/tooltip.js"></script>-->

	<!-- Bootstrap core JavaScript-->
	<!--<script src="<?= $rootpath; ?>scripts/jquery.min.js"></script>-->



	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath; ?>scripts/jquery.easing.min.js"></script>


	<!--Start of Tawk.to Script-->
	<!-- <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/60bb268b4ae6dd0abe7c9686/1f7dgt5jn';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script> -->
	<!-- <script type="text/javascript">
				var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
				(function(){
				var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
				s1.async=true;
				s1.src='https://embed.tawk.to/60252624918aa261273df0f4/1eu8hq06f';
				s1.charset='UTF-8';
				s1.setAttribute('crossorigin','*');
				s0.parentNode.insertBefore(s1,s0);
				})();
				</script> -->
	<!--End of Tawk.to Script-->
	<!-- ---------- JS LINKS END ---------- -->
</head>

<body>
	<!-- Facebook and twitter Embedding code -->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_IN/sdk.js#xfbml=1&version=v10.0" nonce="ogK7ADYN"></script>
	<!-- End Facebook and twitter Embedding code -->

	<nav id="navbar" class="[ navbar fixed-top navbar-expand-lg navbar-light bg-white ]">
		<a target="_blank" href="<?= $page->header_logo1->description; ?>">
			<img id="navbar-md-logo" class="[  header_logo_one ][ d-none d-md-inline-block ]" src="<?= $page->header_logo1->httpUrl; ?>" style="width:50px; height:auto" alt="">
		</a>

		<div class="[ container ]">
			<div class="navbar_container">
				<a class=" [ navbar-brand mobile_1st_logo ][ d-sm-inline-block d-md-none ]" href="#">
					<img class="navbar_img" src="<?= $page->header_logo1->httpUrl; ?>" style="width:50px; height:auto" alt="">
				</a>
				<?php
				if ($page->header_logo2 != "") {
				?>
					<a class=" [ navbar-brand mobile_2nd_logo ][ d-sm-inline-block d-md-none ]" href="#">
						<img class="navbar_img" src="<?= $page->header_logo2->httpUrl; ?>" style="width:120px; height:auto" alt="">
					</a>
				<?php
				}
				?>
			</div>
			<?php if ($page->covid_19_title != "") { ?>
				<strong class="covid_banner_mobile d-sm-inline-block d-md-none">
					<a class=" badge badge-danger" href="#pc_foundation_mobile">Pride Circle Foundation
					</a>
				</strong>
			<?php } ?>
			<button id="navbar-toggler" class="[ m-0 p-0 ][ border-0 navbar-toggler ]" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="[ collapse navbar-collapse ]" id="navbarNav">
				<ul class="[ w-100 ][ d-flex align-items-center justify-content-md-around  justify-content-sm-center ][ navbar-nav ]">
					<?php
					foreach ($page->header_menus as $header_menus) {
						if ($header_menus->sub_menu == "") {
					?>
							<li class="nav-item active" style="text-align:center">
								<?php
								//echo strpos($header_menus->page_redirection_url,"#");
								if ($header_menus->page_redirection_url != "") {
									if (substr($header_menus->page_redirection_url, 0, 1) === "#") {
										$target = "";
									} else {
										$target = "";
									}
								?>

									<a class="nav-link ( underline-button ) " target="<?= $target ?>" href="<?= $header_menus->page_redirection_url; ?>"><?= $header_menus->title; ?><?php if ($header_menus->title == "Register") { ?><sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup><?php } ?></a>
								<?php
								} else {
								?>
									<a class="nav-link ( underline-button ) " target="<?= $target ?>" href="<?= $header_menus->file->httpUrl; ?>"><?= $header_menus->title; ?><?php if ($header_menus->title == "Register") { ?><sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup><?php } ?></a>
								<?php
								}
								?>
							</li>



						<?php
						}
						if ($header_menus->sub_menu != "") {

						?>
							<li class="menu-item dropdown" style="text-align:center">
								<a class="menu-link ( underline-button ) dropdown-toggle" href="#" aria-expanded="false"><?= $header_menus->title; ?></a>
								<ul class="dropdown-menu dropdown-menu-dark">

									<?php
									// }
									foreach ($header_menus->sub_menu as $sub_menu) {
									?>
										<li class="dropdown-content">
											<?php
											if ($sub_menu->page_redirection_url != "") {
											?>
												<a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?= $sub_menu->page_redirection_url; ?>"><?= $sub_menu->title; ?></a>
											<?php
											} else {
											?>
												<a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?= $sub_menu->file->httpUrl; ?>"><?= $sub_menu->title; ?></a>
											<?php
											}
											?>
										</li>
									<?php
									}
									?>
								</ul>
							</li>


					<?php
						}
					}
					?>
					<!--<li class="nav-item active">-->
					<!--<a target="_blank" class="nav-link ( underline-button ) " href="https://www.thepridecircle.com/">About Us</a>-->
					<!--</li>-->
					<!--<li class="nav-item dropdown show">-->
					<!--<a class="nav-link ( underline-button ) btn dropdown-toggle"  href="#" id="navbarDarkDropdownMenuLink"  role="button" data-toggle="dropdown" aria-expanded="false" >#AllyChallenge</a>-->
					<!--    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">-->
					<!--                       <li><a class="dropdown-item" href="https://www.thepridecircle.com/21daysallychallenge/">Ally Challenge 2020</a></li>-->
					<!--                   </ul>-->
					<!--</li>-->

					<!--<li class="nav-item">-->
					<!--<a class="nav-link ( underline-button )" href="#register">Register </a>-->
					<!--</li>-->

					<!--<li class="nav-item">-->
					<!--<a class="nav-link ( underline-button )" href="<?= $rootpath; ?>files/Pride circle report.pdf">Impact Report<sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup></a>-->
					<!--</li>-->

					<!--<li class="nav-item">-->
					<!--<a class="nav-link ( underline-button )" href="#leaderboard">Leaderboard</a>-->
					<!--</li>-->

					<!--<li class="nav-item">-->
					<!--<a class="nav-link ( underline-button )" href="#resources">Resources</a>-->
					<!--</li>-->

					<!--<li class="nav-item">-->
					<!--<a class="nav-link ( underline-button )" href="#partners">Partners</a>-->
					<!--</li>-->
				</ul>
			</div>
		</div>
		<?php
		if ($page->header_logo2 != "") {
		?>
			<a target="_blank" href="<?= $page->header_logo2->description; ?>">
				<img id="navbar-md-logo" class="[  header_logo_two ][ d-none d-md-inline-block ]" src="<?= $page->header_logo2->httpUrl; ?>" style="width:120px; height:auto" alt="">
			</a>
		<?php
		}
		?>
	</nav>

	<?php if ($page->covid_19_title != "") { ?>
		<div class="[ d-none d-md-block  ]( covid_banner badge badge-danger ) ">
			<a class="" href="#pc_foundation">Pride Circle <br>Foundation </a>
		</div>
	<?php } ?>
	<!--/** 2022-05-22 12:26 Code by Amruta Jagtap */-->
	<?php
	if ($page->ally_banner_image != "") {
	?>
		<section id="content">
			<div class="hide-in-mob-view img-responsive img-fluid ">
				<!--style="background-image: url('<?= $urls->httpTemplates ?>images/images_canvas/rise_desktop.jpg');">-->
				<img style="width:100%;" class="img-fluid ally_banner" src="<?= $page->ally_banner_image->httpUrl; ?>">
			</div>
			<div class="hide-in-web-view">
				<img style="padding-top: 5rem;width:100%;" class="img-fluid" src="<?= $page->ally_banner_mobile_image->httpUrl; ?>">
			</div>
		</section>
	<?php
	}
	?>

	<div id="about_us" class="mb-5"></div>
	<?php
	if ($page->ally_banner_text != "") {
	?>
		<section id="content " class="banner_text mb-3">
			<div class="content-wrap py-0">
				<div class="section border-top-0 m-0 text1_alignment" style="">
					<div class="container clearfix">
						<div class="row col-mb-50">
							<div class="text-md-left hb border-bottom-0 text_spacing_sections">
								<p class="p_description "><?= $page->ally_banner_text; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php
	}
	?>
	<?php
	if ($page->slider_images != "") {
	?>
		<div id="slider_container" class="[ px-md-5  ][ container ]">
			<div id="carouselExampleIndicators" class="[ carousel slide ]" data-ride="carousel">
				<div class="carousel-inner">
					<?php
					$counter = 1;
					foreach ($page->slider_images as $slider) {
						//echo $counter;
						if ($counter == 1) {
							$active = "active";
						} else {
							$active = "";
						}
					?>
						<div class="carousel-item <?= $active ?>">
							<img class="d-block w-100" src="<?= $slider->httpUrl; ?>" alt="First slide">
						</div>
					<?php
						$counter++;
					}
					?>
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

			<div id="to-participate" class="[ pt-md-1 pr-md-2 ][ text-right ]">
				<a target="_blank" href="<?= $page->ally_challenge_slides_to_download->httpUrl ?>" class="[ text-primary ]" style="font-size: 1.2rem"><i class="[ fa fa-cloud-download-alt ]"></i> Download These Slides</a>
			</div>
			<div id="register" class="mb-5"></div>
		</div>
	<?php
	}
	?>

	<?php if ($page->register_title != "") { ?>
		<div class="[ pt-4 ][ container ]">
			<div id="play-here">
				<div class="[ pb-2 ][ text-center  ]">
					<?php
					if ($page->register_title_color != "") {
					?>
						<h2 class="title_font "><span class="badge title_break_style" style="background-color:<?= $page->register_title_color; ?>"><?= $page->register_title ?></span></h2>
					<?php
					} else {
					?>
					<?php
					}
					?>
				</div>

				<div class="[ mx-md-5 px-md-5  ][ row ]">
					<div class="[ col-md-4 ][ text-center ]">

						<?php
						if ($page->ally_challenge_get_started != "") {
						?>
							<!--<a class="[ pb-2 ]( underline-button )" target="_blank" href="<?= $page->ally_challenge_get_started->httpUrl ?>">Get Started</a>-->
							<a class="[ pb-2 ]( underline-button )" target="_blank" href="<?= $page->ally_challenge_get_started->httpUrl ?>">Get Started</a>


						<?php
						} else {
						?>


							<!--<a class="[ pb-2 ]( btn underline-button ) d-block d-md-none"  data-toggle="popover" data-placement="bottom" title="Coming soon!" data-content="And here's some amazing content. It's very engaging. Right?">Get Started</a>-->

							<!--<button type="button" class="btn btn-lg btn-danger d-block d-md-none" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>-->
						<?php
						}
						?>


					</div>


					<div class="[ col-md-4 ][ text-center ]">

						<?php
						if ($page->ally_challenge_faq != "") {
						?>
							<a class="[ px-4 pb-2 ]( underline-button )" target="_blank" href="<?= $page->ally_challenge_faq->httpUrl ?>">FAQ</a>

						<?php
						} else {
						?>
						<?php
						}
						?>
					</div>

					<div class="[ col-md-4 ][ text-center ]">

						<?php
						if ($page->ally_challenge_t_and_c != "") {
						?>

							<a class="[ pb-2 ]( underline-button )" target="_blank" href="<?= $page->ally_challenge_t_and_c->httpUrl ?>">Terms & Conditions</a>

						<?php
						} else {
						?>
						<?php
						}
						?>
					</div>
				</div>

				<div class="[  pt-3 register_text]">


					<?= $page->ally_register_text; ?>
				</div>
			</div>
		</div>
		<?php
		$ref = "";
		$ref = !empty($_GET['ref']) ? $_GET['ref'] : '';

		?>

		<!-- <iframe src="https://priallychallenge.thepridecircle.com/?ref=<?= $ref ?>" width="100%" height="600" sandbox="allow-same-origin allow-scripts allow-forms allow-popups allow-popups-to-escape-sandbox"></iframe> -->


		<?php

		$ref = !empty($_GET['ref']) ? $_GET['ref'] : '';
		setcookie("ref", $ref, time() + 60 * 60);

		?>
		<div id="leaderboard" class="mb-4"></div>

	<?php } ?>
	<?php if ($page->leaderboard_title != "") { ?>
		<div class="[ pt-5 ][ container ]">
			<div class="[ pb-2 ][ text-center ]">
				<h2 class="title_font"><span class="badge title_break_style" style="color:white;background-color:<?= $page->leaderboard_title_color; ?>"><?= $page->leaderboard_title ?></span></h2>
			</div>

			<iframe src="https://priallychallenge.thepridecircle.com/public-leaderboard" width="100%" height="600"></iframe>
		</div>
	<?php } ?>

	<!--/** End 2022-05-22  Code by Amruta Jagtap */-->

	<?php if ($page->video_testimonials_title != "" || $page->text_testimonials_title != "") { ?>
		<div id="to-participate" class="[ pt-5 ][ container ]">
			<?php
			if ($page->video_testimonials_title != "") {
			?>
				<div class="[ pb-2 ][ text-center ]">
					<h2 class="title_font"><span class="badge title_break_style" style="color:white;background-color:<?= $page->video_testimonials_title_color; ?>"><?= $page->video_testimonials_title; ?></span></h2>
				</div>
			<?php
			} else {
			?>
				<div class="[ pb-2 ][ text-center ]">
					<h2 class="title_font"><span class="badge title_break_style" style="color:white;background-color:<?= $page->text_testimonials_title_color; ?>"><?= $page->text_testimonials_title; ?></span></h2>
				</div>
			<?php
			}
			?>
		</div>
	<?php } ?>
	<?php if ($page->video_testimonials_title != "") { ?>
		<div id="to-participate" class="[  ][ container ]">


			<div class="[ mt-3 ][ row ]">
				<?php
				foreach ($page->video_testimonials as $video_testimonials) {
				?>

					<div class="[  col-md-4 mb-4 ]">
						<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/<?= $video_testimonials->video_link; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>

				<?php
				}
				?>
			</div>
			<!--      <div class="[ mt-3 ][ row ]">-->

			<!--	<div class="[ offset-md-3 col-md-6 ]">-->
			<!--		<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/M823wFpgXtA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
			<!--	</div>-->
			<!--</div>-->

			<!--<div class="[ mt-3 ][ row ]">-->
			<!--	<div class="[ offset-md-3 col-md-6 ]">-->
			<!--		<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/u3g9_7BV5Os" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
			<!--	</div>-->
			<!--</div>-->

			<!--<div class="[ mt-3 ][ row ]">-->
			<!--	<div class="[ offset-md-3 col-md-6 ]">-->
			<!--		<iframe style="width: 100%;height: 315px;position: relative;" src="https://www.youtube.com/embed/R50emlrC_S8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
			<!--	</div>-->
			<!--</div>-->
		</div>
	<?php
	}
	?>


	<?php if ($page->text_testimonials_title != "") { ?>
		<div class="[ container ] text-testimonials">
			<!--<div class="[ pb-2 ][ text-center ]">-->
			<!--	<h2 class="title_font"><span class="badge title_break_style" style="color:white;background-color:<?= $page->text_testimonials_title_color; ?>"><?= $page->text_testimonials_title; ?></span></h2>-->
			<!--</div>-->


			<div class="items">
				<?php
				foreach ($page->text_testimonials  as $text_testimonials) {
				?>
					<div class="card text_card">
						<div class="card-body text_card_body">
							<div>
								<div class="text_test_one">
									<img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png" style="height:100%;">

									<div class="text_test_two">
										<div><?= $text_testimonials->title_repeater; ?></div>
										<div><?= $text_testimonials->sub_title; ?></div>
									</div>
								</div>

							</div>


							<div class="template-demo">

								<div><?= $text_testimonials->text_description; ?></div>
								<!--<p>Online reviews can make or break a customer's decision to make a purchase. Read about these customer review sites where your customers'</p>-->
							</div>
							<!--<hr>-->
							<!--<div class="row">-->
							<!--    <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
							<!--    <div class="col-sm-10">-->
							<!--        <div class="profile">-->
							<!--            <h4 class="cust-name">Delbert Simonas</h4>-->
							<!--            <p class="cust-profession">Store Owner</p>-->
							<!--        </div>-->
							<!--    </div>-->
							<!--</div>-->
						</div>
					</div>

				<?php
				}
				?>




				<!--<div class="items bg-primary" >-->
				<!--    <div class="card text_card">-->
				<!--        <div class="card-body text_card_body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>Online reviews can make or break a customer's decision to make a purchase. Read about these customer review sites where your customers'</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Delbert Simonas</h4>-->
				<!--                        <p class="cust-profession">Store Owner</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>When you think of Apple you automatically think expensive if your anything like me. When purchasing this laptop I was skeptical on laptops i purchased.</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Tikoh Amin</h4>-->
				<!--                        <p class="cust-profession-->
				<!--">Salon Owner</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>I’ve wanted a MacBook for a while now because of the build quality and the simplicity of the OS. I spend an average 6 hours a day using it for college and the battery still has a fair.</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Malachi Lensing</h4>-->
				<!--                        <p class="cust-profession-->
				<!--">Marketing Manager</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>This MacBook has excellent processing speed. The screen is crystal clear and I really enjoy the touchbar. I set up the fingerprint reader.</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Christian Isla</h4>-->
				<!--                        <p class="cust-profession-->
				<!--">Android Developer</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>For the last 10 years, I have owned an old Gateway laptop. Although it was amazing and lasted me, it was time for an upgrade. I own an Apple phone so I decided to look into a computer.</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Lori Charles</h4>-->
				<!--                        <p class="cust-profession-->
				<!--">Sales manager</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--</div>-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>When you think of Apple you automatically think expensive if your anything like me. When purchasing this laptop I was skeptical on laptops i purchased.</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Tikoh Amin</h4>-->
				<!--                        <p class="cust-profession-->
				<!--">Salon Owner</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>I’ve wanted a MacBook for a while now because of the build quality and the simplicity of the OS. I spend an average 6 hours a day using it for college and the battery still has a fair.</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Malachi Lensing</h4>-->
				<!--                        <p class="cust-profession-->
				<!--">Marketing Manager</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>This MacBook has excellent processing speed. The screen is crystal clear and I really enjoy the touchbar. I set up the fingerprint reader.</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Christian Isla</h4>-->
				<!--                        <p class="cust-profession-->
				<!--">Android Developer</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
				<!--    <div class="card">-->
				<!--        <div class="card-body">-->
				<!--            <h4 class="card-title"><img src="https://img.icons8.com/ultraviolet/40/000000/quote-left.png"></h4>-->
				<!--            <div class="template-demo">-->
				<!--                <p>For the last 10 years, I have owned an old Gateway laptop. Although it was amazing and lasted me, it was time for an upgrade. I own an Apple phone so I decided to look into a computer.</p>-->
				<!--            </div>-->
				<!--            <hr>-->
				<!--            <div class="row">-->
				<!--                <div class="col-sm-2"> <img class="profile-pic" src="https://img.icons8.com/bubbles/100/000000/edit-user.png"> </div>-->
				<!--                <div class="col-sm-10">-->
				<!--                    <div class="profile">-->
				<!--                        <h4 class="cust-name">Lori Charles</h4>-->
				<!--                        <p class="cust-profession-->
				<!--">Sales manager</p>-->
				<!--                    </div>-->
				<!--                </div>-->
				<!--            </div>-->
				<!--        </div>-->
				<!--    </div>-->
			</div>
		</div>
	<?php } ?>






	<?php if ($page->winner_title != "") { ?>
		<div id="winners" class="[ pt-5 px-md-5  ][ container text-center ]">
			<div class="[ pb-2 ]">
				<h2 class="title_font" style=""><span class="badge title_break_style" style="color:white;background-color:<?= $page->winners_title_color; ?>"><?= $page->winner_title; ?></span></h2>
			</div>
			<div class="[  ][ row ]">
				<?php
				foreach ($page->winner_images as $winner_images) {
				?>

					<div class="[  col-md-6 mb-md-4 mb-sm-4 mb-4 ]">
						<img class="[ img-fluid ]" src="<?= $winner_images->httpUrl; ?>">
					</div>

				<?php
				}
				?>
			</div>
			<!--      <div class="[ my-5 ][ row ]">-->
			<!--	<div class="[ offset-md-2 col-md-8 ]">-->
			<!--		<img class="[ img-fluid ]" src="<?= $rootpath ?>/images/winners_companies.jpg">-->
			<!--	</div>-->
			<!--</div>-->

			<!--<div class="[ my-5 ][ row ]">-->
			<!--	<div class="[ offset-md-2 col-md-8 ]">-->
			<!--		<img class="[ img-fluid ]" src="<?= $rootpath ?>/images/winners_individuals.jpg">-->
			<!--	</div>-->
			<!--</div>-->

			<!--<div class="[ my-5 ][ row ]">-->
			<!--	<div class="[ offset-md-2 col-md-8 ]">-->
			<!--		<img class="[ img-fluid ]" src="<?= $rootpath ?>/images/winners_referrals.jpg">-->
			<!--	</div>-->
			<!--</div>-->

		</div>
	<?php } ?>
	<div id="resources" class="mb-3"></div>
	<?php if ($page->resources_title != "") { ?>
		<div class="[ pt-5 container ]">
			<div class="[ pb-2 ][ text-center ]">
				<h2 class="title_font"><span class="badge title_break_style" style="color:white;background-color:<?= $page->resources_title_color; ?>"><?= $page->resources_title ?></span></h2>
			</div>

			<div class="accordion" id="resource-accordion">
				<?php
				$loop_counter = 0;
				/* Loop for listing the resources for challenges */
				foreach ($page->ally_challenge_resources as $resource) {
					$loop_counter++;

					$collapse_class = "";
					$aria_expanded = "flase";
					//$aria_expanded = "true";

					/* Only first element is opened initially */
					if ($loop_counter == 1) {
						$collapse_class = " show ";
						$aria_expanded = "true";
					}
				?>

					<div id="<?= $resource->ally_challenge_resource_locator ?>-menu" class="[ card ][ border-0 ]">
						<div class="[ card-header ][ bg-white border-0 ][ text-center ]" id="<?= $resource->ally_challenge_resource_locator ?>-heading">
							<button class="[ btn btn-link ]( underline-button )" type="button" data-toggle="collapse" data-target="#<?= $resource->ally_challenge_resource_locator ?>" aria-expanded="<?= $aria_expanded ?>" aria-controls="<?= $resource->ally_challenge_resource_locator ?>">
								<?= $resource->title; ?>
							</button>
						</div>

						<div id="<?= $resource->ally_challenge_resource_locator ?>" class="collapse <?= $collapse_class ?>" aria-labelledby="<?= $resource->ally_challenge_resource_locator ?>-heading" data-parent="#resource-accordion">
							<div class="[ card-body ]( collapse-card-body )">
								<?= $resource->ally_challenge_resource_description ?>
							</div>
						</div>
					</div>

				<?php
				}
				?>


			</div>
		</div>
	<?php } ?>
	<!-- script for redirection on tag -->
	<script>
		$(document).ready(function() {
			var url_of_page = window.location.href;
			var last_index = url_of_page.lastIndexOf('#');
			var id_of_section = url_of_page.substring(last_index + 1);

			let accordion_menu = document.getElementById(id_of_section + "-menu");
			if (accordion_menu) {
				//accordion_menu.collapse('hide');
				$('#' + id_of_section).collapse('show');

				$('body, html').animate({
					scrollTop: $("#resources").offset().top
				}, 600);
			}
		})
	</script>

	<?php if ($page->partners_title != "") { ?>
		<div id="partners" class="[  pt-5 ][ container ]">

			<!--   <div class="[ pt-4 pb-5 pb-md-0  ][ text-center ]">-->
			<!--	<h2 class="title_font">POWERED BY</h2>-->
			<!--</div>-->

			<?php
			foreach ($page->partners_logo as $partners_logo) {
			?>
				<div class="[ pt-4  pb-md-3  pb-sm-2 ][ text-center ]">
					<h2 class="title_font"><span class="badge title_break_style" style="color:white;background-color:<?= $partners_logo->partners_title_color; ?>"><?= $partners_logo->title; ?></span></h2>

				</div>
				<div class="[ mx-md-5 px-md-5 ][  justify-content-md-center partners_logo ]">
					<?php
					$logo_counter = 0;
					foreach ($partners_logo->logo_images as $partners) {

						// echo $partners_logo->logo_images->first()->httpUrl;
					?>
						<div class="[ pl-5 pr-5 ][ align-self-center ][ text-center ]">
							<a target="_blank" href="<?= $partners->description; ?>"><img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $partners->httpUrl; ?>" alt=""></a>
						</div>
						<?php
						$logo_counter++;
						if ($logo_counter % 4 == 0) {
						?>
				</div>
				<div class="[ mx-md-5 px-md-5 ][  justify-content-md-center partners_logo ]">
			<?php
						}
					}


			?>



				</div>
			<?php
			}
			?>

			<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">





				<!--<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
				<!--	<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/powered-by-msd.png" alt="">-->
				<!--</div>-->

				<!--<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
				<!--	<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath; ?>images/powered-by-northern-trust.png" alt="">-->
				<!--</div>-->
				<!--	<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
				<!--	<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?= $rootpath; ?>images/powerdby_northn.png" alt="">-->
				<!--</div>-->

				<!--	<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
				<!--	<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/powerdby_servicenow.png" alt="">-->
				<!--</div>-->
				<!--	<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
				<!--	<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/sutherland.png" alt="">-->
				<!--</div>-->

				<!--<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
				<!--	<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/powerdby_synechron.png" alt="">-->
				<!--</div>-->

				<!--<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
				<!--	<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?= $rootpath; ?>images/powered-by-novartis.png" alt="">-->
				<!--</div>-->


			</div>

			<!--<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">-->



			<!--	<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
			<!--		<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/powered-by-ubs.png" alt="">-->
			<!--	</div>-->
			<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
			<!--		<img class="[ img-fluid ]" style="max-width:70px" src="<?= $rootpath; ?>images/powered-by-uniliver.png" alt="">-->
			<!--	</div>-->

			<!--</div>-->
			<!--<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">-->



			<!--	<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
			<!--		<img class="[ img-fluid ]" style="max-width:80px" src="<?= $rootpath; ?>images/powered-by-wf.jpg" alt="">-->
			<!--	</div>-->

			<!--	<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
			<!--		<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/powered-by-zs.png" alt="">-->
			<!--	</div>-->
			<!--</div>-->


		</div>
	<?php } ?>
	<!--<div class="[ mt-3 py-5 ][ container ]">-->
	<!--	<div class="[ pt-4 ][ text-center ]">-->
	<!--		<h2>REWARDS PARTNERS</h2>-->
	<!--	</div>-->

	<!--	<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">-->
	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/rewards-capgemini.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath; ?>images/rewards-hidesign.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:160px; height:auto" src="<?= $rootpath; ?>images/rewards-indeed.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:140px; height:auto" src="<?= $rootpath; ?>images/rewards-infosys.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/rewards-intuit.png" alt="">-->
	<!--		</div>-->
	<!--	</div>-->

	<!--	<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">-->
	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/rewards-nielsen.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:290px; height:auto" src="<?= $rootpath; ?>images/rewards-pb.png" alt="">-->
	<!--		</div>-->


	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/rewards-sodexo.jpg" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/powered-by-ubs.png" alt="">-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->

	<!--<div class="[ mt-3 py-5 ][ container ]">-->
	<!--	<div class="[ pt-4 ][ text-center ]">-->
	<!--		<h2>INTERNATIONAL PARTNERS</h2>-->
	<!--	</div>-->

	<!--	<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-center ]">-->
	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?= $rootpath; ?>images/international-felgtb.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:160px; height:auto" src="<?= $rootpath; ?>images/HRCFoundation.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:160px; height:auto" src="<?= $rootpath; ?>images/international-lcw.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:80px; height:auto" src="<?= $rootpath; ?>images/international-mygwork.png" alt="">-->
	<!--		</div>-->
	<!--	</div>-->

	<!--	<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">-->


	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:180px; height:auto" src="<?= $rootpath; ?>images/OutEqual.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:130px; height:auto" src="<?= $rootpath; ?>images/international-out-at-work.jpg" alt="">-->
	<!--		</div>-->


	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/Shanghai Pride.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:180px; height:auto" src="<?= $rootpath; ?>images/Stonewall-white.jpg" alt="">-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<?php
	if ($page->participating_organizations_title != "") {
	?>
		<div class="[ pt-5 ][ container ]">
			<div class="[ pb-2 ][ text-center ]">
				<!--<h2>participating_organizations_title_color</h2>-->
				<h2 class="title_font"><span class="badge title_break_style" style="color:white;background-color:<?= $page->participating_organizations_title_color; ?>"><?= $page->participating_organizations_title; ?></span></h2>
			</div>

			<div class="[ row ]">
				<div class="[ col-md-1 ]">
				</div>

				<?php
				// 				/* Get all the companies */
				$participating_companies_array = array_filter(array_map('trim', explode(",", $page->participating_companies_list)));

				/* Sort alphabetically */
				natcasesort($participating_companies_array);
				//print_r($participating_companies_array);
				/* Counters */
				$company_counter = 1;
				$row_counter = 1;

				foreach ($participating_companies_array as $company_name) {
				?>
					<div class="[ py-2 py-md-4 ][ col-md-2 text-center ]">
						<strong><?= $company_name ?></strong>
					</div>

					<?php
					if ($company_counter == 5) {
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

			<!-- <div class="[ d-md-flex justify-content-md-around ]">-->
			<!--	<div>-->
			<!--		<img class="[ img-fluid ]" src="<?= $rootpath; ?>images/participating_org.png" alt="">-->
			<!--	</div>-->
			<!--</div> -->
		</div>

	<?php
	}
	?>

	<!--<div class="[ mt-3 py-5 ][ container ]">-->
	<!--	<div class="[ pt-4 ][ text-center ]">-->
	<!--		<h2>OUTREACH PARTNERS</h2>-->
	<!--	</div>-->

	<!--	<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">-->
	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/outreach-acme.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/outreach-beunic.jpg" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:130px; height:auto" src="<?= $rootpath; ?>images/outreach-cab.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath; ?>images/outreach-hh.jpg" alt="">-->
	<!--		</div>-->
	<!--	</div>-->

	<!--	<div class="[ d-md-flex justify-content-md-around ]">-->
	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/outreach-iimally.jpg" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/outreach-linkedin.PNG" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath; ?>images/outreach-litfest.jpg" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:90px; height:auto" src="<?= $rootpath; ?>images/outreach-mdi.jpg" alt="">-->
	<!--		</div>-->
	<!--	</div>-->

	<!--	<div class="[ d-md-flex justify-content-md-center ]">-->
	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:120px; height:auto" src="<?= $rootpath; ?>images/outreach-qknit.jpg" alt="">-->
	<!--		</div>-->

	<!--           <div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $rootpath; ?>images/outreach_solidarity.png" alt="">-->
	<!--		</div>-->

	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/outreach-school.jpg" alt="">-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->

	<!--<div class="[ mt-3 py-5 ][ container ]">-->
	<!--	<div class="[ pt-4 ][ text-center ]">-->
	<!--		<h2>YOUTH DIGITAL PARTNER</h2>-->
	<!--	</div>-->

	<!--	<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">-->
	<!--		<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
	<!--			<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/youth_partner_yka.jpg" alt="">-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->

	<!--/** 2022-05-22 12:26 Code by Amruta Jagtap */-->


	<?php if ($page->covid_19_title != "") { ?>
		<section id="content ">
			<div id="pc_foundation" class=" img-responsive img-fluid ">

				<img style="" class="img-fluid ally_banner" src="<?= $page->covid_19_banner->httpUrl; ?>">
			</div>
			<div id="pc_foundation_mobile" class="img-responsive  mobile">
				<img style="    padding-top: 1rem;" class="img-fluid" src="<?= $page->covid_19_mobile_banner->httpUrl; ?>">
			</div>
		</section>
		<div class="[ pt-md-4  pb-sm-2  ]">
			<div class="[  mx-md-5 px-md-5 ][  justify-content-md-center covid_logo ]">

				<?php
				$logo_counter = 0;
				foreach ($page->covid_19_logos as $covid_19_logos) {

				?>
					<div class="[ pl-5 pr-5 ][ align-self-center ][ text-center ]">
						<a target="_blank" href="<?= $covid_19_logos->description; ?>"><img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?= $covid_19_logos->httpUrl; ?>" alt=""></a>
					</div>
					<?php

					$logo_counter++;
					if ($logo_counter % 4 == 0) {
					?>
			</div>
			<div class="[ mx-md-5 px-md-5 ][  justify-content-md-center covid_logo ]">

		<?php
					}
				}
		?>

			</div>




		</div>
		<section id="content " class="banner_text">
			<div class="content-wrap py-0">
				<div class="section border-top-0 m-0 text1_alignment" style="">
					<div class="container clearfix">
						<div class="row col-mb-50">
							<div>

							</div>
							<div class="text-md-left hb mb-4 border-bottom-0 text_spacing_sections">
								<p class="p_description "><?= $page->covid_19_text; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>


	<?php } ?>
	<!--/** End 2022-05-22  Code by Amruta Jagtap */-->

	<?php
	if ($page->ally_social_media_title != "") {
	?>
		<div class="[ pt-md-5   px-5 mb-5 ][ container ][ d-block d-md-none ]">
			<div class="[ pt-4 pb-3 ][ text-center ]">
				<h2><span class=" title_font badge title_break_style" style="color:white;background-color:<?= $page->ally_social_title_color; ?>"><?= $page->ally_social_media_title; ?></span></h2>
			</div>

			<div class="[ ][ d-flex justify-content-around ]( mobile-icon-bar )">

				<a target="_blank" href="<?= $page->linkedin_link; ?>" class="linkedin"><i class="fa fa-fw fa-linkedin"></i></a>

				<a target="_blank" href="<?= $page->instagram_link; ?>" class="google"><i class="fa fa-fw fa-instagram"></i></a>

				<a target="_blank" href="<?= $page->facebook_link; ?>" class="facebook"><i class="fa fa-fw fa-facebook"></i></a>

				<a target="_blank" href="<?= $page->twitter_link; ?>" class="twitter"><i class="fa fa-fw fa-twitter"></i></a>

				<a target="_blank" href="<?= $page->youtube_link; ?>" class="youtube"><i class="fa fa-fw fa-youtube"></i></a>

				<a target="_blank" href="<?= $page->linktree_link; ?>" class="linktree"><i class="fa fa-fw fa-link"></i></a>

				<a target="_blank" href="mailto:<?= $page->contact_email; ?>" class="about_us_social_link"><i class="fa fa-fw fa-envelope"></i></a>
			</div>

			<div class="[  d-flex justify-content-around ]( mobile-icon-bar )">



			</div>
		</div>
	<?php
	}
	?>

	<!--Facebook & twitter Embeding-->
	<!-- <div class="container mt-4">
	<div class="row">
	    <div class="col-md-1"></div>
	    <div class="col-md-4 col-sm-12 facebook_embed" >
         <div class="fb-page" data-href="https://www.facebook.com/PrideCircles/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/PrideCircles/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/PrideCircles/">Pride Circle</a></blockquote></div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4 col-sm-12 twitter_embed">
          //<a class="twitter-timeline" data-width="340" data-height="500" href="https://twitter.com/pride_circle?ref_src=twsrc%5Etfw">Tweets by pride_circle</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> -->
	<!--<a class="twitter-timeline" data-width="340" data-height="550" href="https://twitter.com/pride_circle?ref_src=twsrc%5Etfw">Tweets by pride_circle</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>-->
	<!--<a class="twitter-timeline" href="https://twitter.com/pride_circle?ref_src=twsrc%5Etfw">Tweets by pride_circle</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>-->
	<!-- //</div>
        <div class="col-md-1"></div>
	</div>
	</div> -->
	<!--End Facebook & twitter Embeding-->
	<div class="[ mt-0  ][ container-fluid pl-0 pr-0 pb-0 ]">
		<!--<div class="[ pt-4 ][ text-center ]">-->
		<!--	<h2>PR PARTNER</h2>-->
		<!--</div>-->

		<!--<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-around ]">-->
		<!--	<div class="[ p-5 ][ align-self-center ][ text-center ]">-->
		<!--		<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?= $rootpath; ?>images/pr-avian-we.jpg" alt="">-->
		<!--	</div>-->
		<!--</div>-->

		<!--	<div class="[ mt-3 py-5 ][ container ]">-->
		<!--	<a href="https://twitter.com/intent/tweet?button_hashtag=21daysallychallenge&ref_src=twsrc%5Etfw" class="twitter-hashtag-button" data-show-count="false">Tweet #21daysallychallenge</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>-->
		<!--</div> -->

		<div class="[ pb-5 ]( container-fluid shodow  )">

		</div>

		<div class="[ pb-4 ][ container-fluid  ]">
			<div class="[ row pt-3 ] justify-content-center">

				<?php
				$counter = 1;
				foreach ($page->footer_links as $footer_links) {

					if ($footer_links->footer_files != "") {
						$footer_url = $footer_links->footer_files->httpUrl;
					} else {
						$footer_url = $footer_links->page_redirection_url;
					}

					if ($counter == 1) {
						$style = "offset-md-2";
					} else {
						$style = "";
					}
				?>
					<div class="[ col-md-4 mt-5 ][ text-center ]">
						<!--<a href="<?= $footer_links->footer_files->httpUrl; ?>" target="_blank" class="[ text-secondary ]" title=""><?= $footer_links->title ?></a>-->
						<a href="<?= $footer_url; ?>" target="_blank" class="[ text-secondary ]" title="" download><?= $footer_links->title ?></a>
					</div>
				<?php
					$counter++;
				}
				?>
				<!--<div class="[ offset-md-2 col-md-4 ][ text-center ]">-->
				<!--	<a href="https://www.thepridecircle.com/site/templates/assets/PrivacyPolicy-PrideCircle.pdf" target="_blank" class="[ text-secondary ]" title="">Pride Circle Privacy Policy</a>-->
				<!--</div>-->

				<!--<div class="[ col-md-4 ][ text-center ]">-->
				<!--	<a href="https://gleam.io/privacy" target="_blank"  class="[ text-secondary ]" title="">Gleam Privacy Policy</a>-->
				<!--</div>-->

				<?php
				if ($page->ally_social_media_title != "") {
				?>
					<!--<div class="[ row d-none d-md-block ]( icon-bar )">-->
					<!--    <div ></div>-->
					<!--    <a target="_blank" href="<?= $page->linkedin_link; ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>-->

					<!--    <a target="_blank" href="<?= $page->instagram_link; ?>" class="google"><i class="fa fa-instagram"></i></a>-->

					<!--	<a target="_blank" href="<?= $page->facebook_link; ?>" class="facebook"><i class="fa fa-facebook"></i></a>-->

					<!--	<a target="_blank" href="<?= $page->twitter_link; ?>" class="twitter"><i class="fa fa-twitter"></i></a>-->

					<!--	<a target="_blank" href="<?= $page->youtube_link; ?>" class="youtube"><i class="fa fa-youtube"></i></a>-->

					<!--	<a target="_blank" href="<?= $page->linktree_link; ?>" class="linktree"><i class="fa fa-link"></i></a>-->

					<!--	<a target="_blank" href="mailto:<?= $page->contact_email; ?>" class="about_us_social_link" title="contact@thepridecircle.com"><i class="fa fa-envelope"></i></a>-->
					<!--</div>-->

					<div class="[ col-md-12 mt-5 mb-2 text-center ][  d-none d-md-block ]( mobile-icon-bar )">

						<a target="_blank" href="<?= $page->linkedin_link; ?>" class="linkedin"><i class="fa fa-fw fa-linkedin"></i></a>

						<a target="_blank" href="<?= $page->instagram_link; ?>" class="google"><i class="fa fa-fw fa-instagram"></i></a>

						<a target="_blank" href="<?= $page->facebook_link; ?>" class="facebook"><i class="fa fa-fw fa-facebook"></i></a>

						<a target="_blank" href="<?= $page->twitter_link; ?>" class="twitter"><i class="fa fa-fw fa-twitter"></i></a>

						<a target="_blank" href="<?= $page->youtube_link; ?>" class="youtube"><i class="fa fa-fw fa-youtube"></i></a>

						<a target="_blank" href="<?= $page->linktree_link; ?>" class="linktree"><i class="fa fa-fw fa-link"></i></a>

						<a target="_blank" href="mailto:<?= $page->contact_email; ?>" class="about_us_social_link"><i class="fa fa-fw fa-envelope"></i></a>
					</div>

				<?php
				}
				?>


				<div class="[ pt-4 ][ col-md-12 ][ text-center ]">
					<a target="_blank" href="https://www.thepridecircle.com/"><img src="<?= $rootpath ?>images/pride_circle_logo_square.jpg" style="width:70px; height:auto" alt=""></a>
				</div>

				<div class="[ pt-3 ][ col-12 ][ text-center ]">
					Copyright © <?= date("Y") ?> Pride Circle
				</div>

				<!-- <div class="[ pt-3 ][ col-12 ][ text-center ]">
					Developed by <a target="_blank" href="https://zerovaega.com/">Zerovaega Technologies</a>
				</div> -->
			</div>
		</div>
	</div>

	<!-- Page-specific JS -->

	<script src="<?= $rootpath; ?>scripts/tweetjs.js" type="text/javascript"></script>

	<script>
		$(document).ready(function() {
			$(document).on("click", "#navbarNav .nav-link", function() {
				if (!$("#navbar-toggler").hasClass("collapsed")) {
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
		(function() {
			var w = window;
			var ic = w.Intercom;
			if (typeof ic === "function") {
				ic('reattach_activator');
				ic('update', w.intercomSettings);
			} else {
				var d = document;
				var i = function() {
					i.c(arguments);
				};
				i.q = [];
				i.c = function(args) {
					i.q.push(args);
				};
				w.Intercom = i;
				var l = function() {
					var s = d.createElement('script');
					s.type = 'text/javascript';
					s.async = true;
					s.src = 'https://widget.intercom.io/widget/q55fbh8u';
					var x = d.getElementsByTagName('script')[0];
					x.parentNode.insertBefore(s, x);
				};
				if (w.attachEvent) {
					w.attachEvent('onload', l);
				} else {
					w.addEventListener('load', l, false);
				}
			}
		})();
	</script>


	<script>
		$(document).ready(function() {

			$('.items').slick({
				dots: true,
				infinite: true,
				speed: 800,
				autoplay: false,
				autoplaySpeed: 2000,
				slidesToShow: 2,
				slidesToScroll: 2,
				arrow: true,
				responsive: [{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
							infinite: true,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}

				]
			});
		});
	</script>
	<script>
		// $(document).ready(function(){
		//   $('[data-toggle="tooltip"]').tooltip();
		// });
		// $(function () {
		//   $('[data-toggle="tooltip"]').tooltip()
		// });

		$(function() {
			$('.register_get_started_tooltip').tooltip()
		});

		$(function() {
			$('.register_faq_tooltip').tooltip()
		});

		$(function() {
			$('.register_t_c_tooltip').tooltip()
		});
	</script>



	<!-- ---------- JS LINKS END ---------- -->
</body>

</html>