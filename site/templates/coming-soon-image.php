<?php
// 	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// 	{
// 		//Tell the browser to redirect to the HTTPS URL.
// 		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 		//Prevent the rest of the script from executing.
// 		exit;
// 	}

	$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-155220702-1');
	</script>

	<script>
		let website_rootpath = '<?=$config->urls->httpRoot?>resume/';
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->


	<title>#AllyChallenge | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

	<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:title" content="Ally Challenge | Pride Circle">
	<meta property="og:image" content="<?= $rootpath;?>images/slide-7.jpg">
	<meta property="og:description" content="#AllyChallenge">
	<meta property="og:url" content="https://www.thepridecircle.com/allychallenge/">

	<meta name="twitter:title" content="Ally Challenge | Pride Circle">
	<meta name="twitter:description" content="#AllyChallenge">
	<meta name="twitter:image" content="<?= $rootpath;?>images/slide-7.jpg">
	<meta name="twitter:card" content="AllyChallenge">

	<meta property="og:site_name" content="Pride Circle">
	<meta name="twitter:image:alt" content="AllyChallenge">
	<!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css">
	<!-- Fonts Style CSS -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?=$rootpath;?>styles/owl.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
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

/** 2021-05-22 Code by Amruta Jagtap */
.img-responsive.mobile {
  display: none;
   width:100%;
  height:auto;
}
.img-responsive
{
     width:100%;
  height:auto;
}

.ally_banner{
    margin-top:69px;
}

.banner_text{
    padding-top:60px;
}
.leaderboard_h2{
    margin-top:7rem;
}

.title_font{
    font-weight: 600;
    font-family:'Montserrat', sans-serif;
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
/** End 2021-05-22 Code by Amruta Jagtap */
@media only screen and (max-width: 576px) {
	.underline-button {
		padding-top: 1.2rem;
	}
	
/** 2021-05-22 Code by Amruta Jagtap */	
  .img-responsive {
    display: none;
  }
  .img-responsive.mobile {
    display: block;
  }
  .text_spacing_sections{
      padding:0px 19px;
  }
  /**End 2021-05-22 Code by Amruta Jagtap */
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
	 .text_spacing_sections{
      padding:0px 19px;
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

 .card {
     position: relative;
     display: flex;
     width: 350px;
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

 .card .card-body {
     padding: 1rem 1rem
 }

 .card-body {
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


/*End Code by Amruta text testimonials*/




	</style>
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $rootpath;?>scripts/jquery.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js" type="text/javascript" async></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous" async></script>
	
	<script src="<?= $rootpath;?>scripts/owl.js" type="text/javascript" async></script>
	
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<!-- ---------- JS LINKS END ---------- -->
</head>
<body>

	
	<!--/** 2021-05-22 12:26 Code by Amruta Jagtap */-->
	
	<section id="content">
            <div class=" img-responsive img-fluid "> 
							<!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_desktop.jpg');">-->
				<img style="" class="img-fluid ally_banner" src="<?=$urls->httpTemplates?>images/allychallenge.png">
			</div>
			<div class="img-responsive  mobile" >
				<img style="    padding-top: 1rem;"  class="img-fluid"  src="<?=$urls->httpTemplates?>images/allychallenge.png">
			</div>
			<div class="text-center" style="padding-top:20px;">
			    <a  href="https://www.thepridecircle.com/21daysallychallenge/"><h3>Learn about #AllyChallenge 2020</h3></a>
			</div>
        </section>
  
	<!--/** End 2021-05-22  Code by Amruta Jagtap */-->

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
</body>
</html>