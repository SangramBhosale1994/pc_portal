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
	
	<!--<script>
		let website_rootpath = '<?=$config->urls->httpRoot?>resume/';
	</script> -->


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
    <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-C3XCR831MS');
    </script> -->


	<title>Pride Circle | <?=$page->title?></title>

	<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

	<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta property="og:title" content="Pride Circle | <?=$page->title?>">
	 <meta property="og:image" content="<?=$page->general_image->httpUrl;?>">
	<meta property="og:description" content="<?=$page->title?>">
	<meta property="og:url" content="<?=$page->httpUrl?>">

	<meta name="twitter:title" content="Pride Circle | <?=$page->title?>">
	<meta name="twitter:description" content="<?=$page->title?>">
	<meta name="twitter:image" content="<?=$page->general_image->httpUrl;?>">
	<meta name="twitter:card" content="<?=$page->title?>">

	<meta property="og:site_name" content="Pride Circle">
	<meta name="twitter:image:alt" content="<?=$page->general_image->httpUrl;?>">
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
/*.icon-bar {*/
/*  position: fixed;*/
/*  top: 50%;*/
/*  -webkit-transform: translateY(-50%);*/
/*  -ms-transform: translateY(-50%);*/
/*  transform: translateY(-50%);*/
/*}*/

/* Style the icon bar links */
/*.icon-bar a {*/
/*  display: block;*/
/*  text-align: center;*/
/*  padding: 14px;*/
/*  transition: all 0.3s ease;*/
/*  color: white;*/
/*  font-size: 20px;*/
/*}*/


/*.mobile-icon-bar a{*/
/*	height: 44px;*/
/*	width: 50px;*/
/*	border-radius: 50px;*/
/*	text-align: center;*/
/*	padding: 10px;*/
/*	transition: all 0.3s ease;*/
/*	color: white;*/
/*	font-size: 18px;*/
	/*margin-right:10px;*/
/*	    margin: 0px 5px;*/
/*}*/

/* Style the social media icons with color, if you want */
/*.icon-bar a:hover {*/
/*  background-color: #000;*/
/*}*/

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
.linktree{
  background: #28BF7B;
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
    margin-top:45px;
    position:relative;
    z-index:999;
}

.banner_text{
    padding-top:21px;
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
.icon-bar a {
  display: block;
  text-align: center;
  padding: 7px ;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}
.covid_banner{
  position: fixed;
  top: 80%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  /*background-color:darkgrey;*/
  right:0;
  z-index: 997;
   border-top-left-radius: 23px;
    border-bottom-left-radius: 23px;
    padding-left: 0.8rem;
}
.covid_banner a{
    display: block;
  text-align: center;
  padding: 3px ;
  transition: all 0.3s ease;
  color: white;
  font-weight:500;
  font-size: 15px;
    line-height: 17px;
}

.covid_banner_mobile{
  /*position: fixed;*/
  top: 80%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: none;
  /*background-color:darkgrey;*/
  right:0;
  z-index: 1004;
   border-top-left-radius: 23px;
    border-bottom-left-radius: 23px;
       margin-right:0px;
       margin-left:auto;
    /*padding-left: 0.8rem;*/
        /*padding-right: 0.5rem;*/
}
.covid_banner_mobile a{
    /*display: block;*/
  text-align: center;
  padding: 8px ;
  transition: all 0.3s ease;
  color: white;
  font-weight:500;
  font-size: 15px;
    line-height: 17px;
    border-top-left-radius: 23px;
    border-bottom-left-radius: 23px;
}
.text_test_one{
    display:flex;
}
.text_test_two{
    padding-left:20px;
}
.dropdown-toggle::after {
    border-top:none;
}
.header_logo_one{
    margin-left:5rem;
}
.header_logo_two{
    margin-right:5rem;
}
.dropdown-menu{
    min-width: 0rem;
    top: 95%;
    padding:0px;
    margin:0px;
}

.menu-item .dropdown-menu{ display: none; }
	.menu-item:hover .dropdown-menu{ display: block; }
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
.dropdown-item.active, .dropdown-item:active{
    color: rgb(66,139,202) !important;
}

	
.leaderboard_text p{
    font-size:1rem;
}

.register_text p{
    font-size:1rem;
}
.register_sign_up{
    border:5px solid;
    width: 540px;
    height:auto;
    border-color:rgba(66,139,202, 1);
}

.register_sign_up h2{
   margin-top: 16px;
   font-size: 1.5rem;
}
.text-testimonials{
    
}
.partners_logo{
    display: flex;
}
.covid_logo{
    display: flex;
}

.google_form_container{
    margin-top:4rem;
}
.google_form_container iframe{
    width:100%;
    min-height:913px;
}
.google_form_text{
    margin-bottom:1rem;
   
}
.google_form_text span{
    
    line-height:2rem !important;
}
/*.register_tooltip{*/
/*    cursor:pointer;*/
/*}*/
@media screen and (max-width: 895px) and (min-width: 780px) {
    .header_logo_one{
    margin-left:2rem;
}
.header_logo_two{
    margin-right:3rem;
}

}
@media screen and (max-width: 1024px) and (min-width: 768px) {
.ally_banner{
    margin-top:55px;
    position:relative;
    z-index:999;
}

}

@media screen and (max-width: 1024px) and (min-width: 1000px) {
.ally_banner{
    margin-top:72px;
    position:relative;
    z-index:999;
}

}

@media screen and (max-width: 976px) and (min-width: 768px) {
.partners_logo{
    display:block;
}
.covid_logo{
    display: block;
}
}

@media only screen and (max-width: 768px) {
.partners_logo{
    display:block;
}
.covid_logo{
    display: block;
}
.title_break_style{
    overflow-wrap: break-word !important;
}
.badge{
    white-space: inherit;
}
.google_form_container iframe{
    width:100%;
     min-height:1039px;
}

}
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
  #slider_container{
      margin-top:1.5rem;
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
	/*Code by Amruta*/
	.register_sign_up{
    width: 540px;
    }
}

@media only screen and (max-width: 1024px) and (min-width: 768px) {
	.sign-up-indicator{
		width: 540px!important;
	}
	/*Code by Amruta*/
	/*.register_sign_up{*/
 /*   width: 540px;*/
 /*   }*/
}
@media only screen and (max-width: 767px) {
	.sign-up-indicator{
		width: 510px;
	}
	 .text_spacing_sections{
      padding:0px 19px;
  }
  
  	/*Code by Amruta*/
	.register_sign_up{
    width: 510px;
    }
    .register_sign_up h2{
   margin-top: 7px;
   font-size: 1.5rem;
}
    /*.menu-link:after{*/
    /*    margin-left:3rem;*/
    /*}*/
    
}
/** 2021-05-22 Code by Amruta Jagtap */
@media only screen and (max-width: 991px) and (min-width: 768px) {
/*@media screen and (max-width: 900px) and (min-width: 769px){*/
/*@media only screen and (max-width: 900px){*/
   
     .navbar .header_logo_one{
        display:none!important;
    }
    .navbar .header_logo_two{
        display:none!important;
    }
    
    /* .navbar .container{*/
    /*     display:flex!important;*/
        
    /*}*/
     .navbar-brand {
        display:inline-block!important;
    }
    
}
/** End 2021-05-22 Code by Amruta Jagtap */
@media only screen and (max-width: 575px) {
	.sign-up-indicator{
		width: 100%;
	}
		/*Code by Amruta*/
	.register_sign_up{
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

 .text_card {
     position: relative;
     display: flex;
     width: 350px;
     height:171px;
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

.slick-prev:before, .slick-next:before {
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
     height:202px;
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
 .twitter_embed{
     text-align:center;
     margin-top:2rem;
 }
  .facebook_embed{
     text-align:center;
 }
}
@media screen and (max-width: 1024px) and (min-width: 768px) {
 .text_card {
     position: relative;
     display: flex;
     width: 350px;
     height:275px;
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
     height:382px;
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
.covid_banner_mobile{
  /*position: fixed;*/
  top: 80%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: none;
  /*background-color:darkgrey;*/
  right:0;
  z-index: 1004;
   border-top-left-radius: 23px;
    border-bottom-left-radius: 23px;
    /*padding-left: 0.8rem;*/
        padding-right: 0.5rem;
}
.covid_banner_mobile a{
    /*display: block;*/
  text-align: center;
  padding: 8px ;
  transition: all 0.3s ease;
  color: white;
  font-weight:500;
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

@media screen and (max-width: 314px)  {


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
  .dropdown-menu .dropdown-menu{
      margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
  }
}	
/* ============ small devices .end// ============ */
@media screen and (max-width: 568px) and (min-width: 320px) {
.e-widget-wrapper{
	overflow-x: scroll;
}

}


@media screen and (max-width: 393px) and (min-width: 320px) {
.google_form_container iframe{
    width:100%;
     min-height:1196px;
}

}

@media screen and (max-width: 320px) {
.google_form_container iframe{
    width:100%;
     min-height:1196px;
}

}
/*End Code by Amruta text testimonials*/




	</style>
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $rootpath;?>scripts/jquery.min.js" type="text/javascript"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<!--<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>-->
	<script src="https://unpkg.com/tooltip.js"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js" type="text/javascript" async></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous" async></script>
	
	<script src="<?= $rootpath;?>scripts/owl.js" type="text/javascript" async></script>
	
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<!--<script src="<?= $rootpath;?>scripts/bootstrap.bundle.min.js" type="text/javascript" async></script>-->
	<!--<script src="<?= $rootpath;?>scripts/bootstrap.bundle.js" type="text/javascript" async></script>-->
	<!--<script src="<?= $rootpath;?>scripts/popper.min.js" type="text/javascript" async></script>-->
	<!--<script src="<?= $rootpath;?>scripts/Popper.js" type="text/javascript" async></script>-->
	<!--<script src="https://unpkg.com/@popperjs/core@2" type="text/javascript" async></script>-->
	
	<!--<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>-->
	<!--<script src="https://unpkg.com/popper.js"></script>-->
 <!--   <script src="https://unpkg.com/tooltip.js"></script>-->
    
    <!-- Bootstrap core JavaScript-->
	<!--<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>-->
	
	

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>
	
	
	 <!--Start of Tawk.to Script-->
         <script type="text/javascript">
        // var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        // (function(){
        // var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        // s1.async=true;
        // s1.src='https://embed.tawk.to/60bb268b4ae6dd0abe7c9686/1f7dgt5jn';
        // s1.charset='UTF-8';
        // s1.setAttribute('crossorigin','*');
        // s0.parentNode.insertBefore(s1,s0);
        // })();
         </script>
     <!--End of Tawk.to Script-->
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
    abc
    <!-- Facebook and twitter Embedding code -->
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_IN/sdk.js#xfbml=1&version=v10.0" nonce="ogK7ADYN"></script>
<!-- End Facebook and twitter Embedding code -->

	<nav id="navbar" class="[ navbar fixed-top navbar-expand-lg navbar-light bg-white ]">
		<a target="_blank" href="<?=$page->header_logo1->description;?>"><img id="navbar-md-logo" class="[  header_logo_one ][ d-none d-md-inline-block ]" src="<?=$page->header_logo1->httpUrl;?>" style="width:50px; height:auto"  alt=""></a>

		<div class="[ container ]">
		    <div class="navbar_container">
		          <a target="_blank" class=" [ navbar-brand mobile_1st_logo ][ d-sm-inline-block d-md-none ]" 
		          href="<?=$page->header_logo1->description;?>" >
    				<img class="navbar_img" src="<?=$page->header_logo1->httpUrl;?>" style="width:50px; height:auto"  alt="">
    
    				<!--<strong class="">-->
    				<!--	<span style="color:#66CCFF">Ally</span><span style="color:#BFA6D0">Challenge</span>-->
    				<!--</strong>-->
    				<!--<strong class="">-->
    				<!--    <span style="color:#66CCFF">Ally</span><span style="color:#BFA6D0">Challenge</span>-->
    				<!--    <a class="" href="#covid_banner_section">Contribute to <br>COVID Relief </a>-->
    				<!--</strong>-->
    				<!--<strong class="covid_banner_mobile d-sm-inline-block d-md-none">-->
    				<!--<div class="[   ]( covid_banner badge badge-danger ) ">-->
        <!--        		<a class=" badge badge-danger" href="#covid_banner_section_mobile">Contribute to COVID relief -->
        <!--        		</a>-->
                	<!--</div>-->
        <!--        	</strong>-->
    					
    			</a>
    			<?php
    			    if($page->header_logo2!=""){
    			?>
    			<a target="_blank" class=" [ navbar-brand mobile_2nd_logo ][ d-sm-inline-block d-md-none ]" href="<?=$page->header_logo2->description?>">
    				<img class="navbar_img" src="<?=$page->header_logo2->httpUrl;?>" style="width:69px; height:auto"  alt="">
    
    				
    			</a>
                <?php
    			    }
    			?>
		    </div>
			<!--<strong class="covid_banner_mobile d-sm-inline-block d-md-none">-->
    				<!--<div class="[   ]( covid_banner badge badge-danger ) ">-->
   <!--             		<a class=" badge badge-danger" href="#queer_relief_mobile">Queer Relief Fundraiser -->
   <!--             		</a>-->
                	<!--</div>-->
   <!--             	</strong>-->
			<button id="navbar-toggler" class="[ m-0 p-0 ][ border-0 navbar-toggler ]" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="[ collapse navbar-collapse ]" id="navbarNav">
				<ul class="[ w-100 ][ d-flex align-items-center justify-content-md-around flex-sm-row justify-content-sm-center ][ navbar-nav ]">
				    <?php
				        foreach($page->header_menus as $header_menus){
				                if($header_menus->sub_menu==""){
				            ?>
				            <li class="nav-item active" style="text-align:center">
				                <?php
				                //echo strpos($header_menus->page_redirection_url,"#");
				                    if(substr($header_menus->page_redirection_url, 0, 1 ) === "#"){
				                        $target="";
				                    }
				                    else{
				                        $target="_blank";
				                    }
				                ?>
        					<a  class="nav-link ( underline-button ) "  target="<?=$target?>" href="<?=$header_menus->page_redirection_url;?>"><?=$header_menus->title;?></a>
        					<?php 
        					//if($header_menus->title=="Register"){
        					?>
        					<!--<sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup>-->
        					<?php //} ?>
        					</li>
        					
        					
        					
				            <?php
				                }
				                if($header_menus->sub_menu!=""){
				            
        				         ?>
        				        <li class="menu-item dropdown" style="text-align:center">
                					<a class="menu-link ( underline-button ) dropdown-toggle"  href="#"  aria-expanded="false" ><?=$header_menus->title;?></a>
                					    <ul class="dropdown-menu dropdown-menu-dark" >
                					        	
                    				       <?php
                    				          // }
                				            foreach($header_menus->sub_menu as $sub_menu){
                				        ?>
                                        <li class="dropdown-content"><a target="blank" class="dropdown-item menu-link ( underline-button )" href="<?=$sub_menu->page_redirection_url;?>"><?=$sub_menu->title;?></a></li>
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
					<!--<a class="nav-link ( underline-button )" href="<?= $rootpath;?>files/Pride circle report.pdf">Impact Report<sup class="[ bg-danger text-white rounded ml-1 px-2 py-1 ]">NEW!</sup></a>-->
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
			if($page->header_logo2!=""){
		?>
		<a target="_blank" href="<?=$page->header_logo2->description;?>"> <img id="navbar-md-logo" class="[  header_logo_two ][ d-none d-md-inline-block ]" src="<?=$page->header_logo2->httpUrl;?>" style="width:69px; height:auto"  alt=""></a>
		<?php
			}
		?>
	</nav>

	
	

	<!--<div class="[ d-none d-md-block  ]( covid_banner badge badge-danger ) ">-->
	<!--	<a class="" href="#queer_relief">Queer Relief<br>Fundraiser  </a>-->
	<!--</div>-->
	
	<!--/** 2021-05-22 12:26 Code by Amruta Jagtap */-->
<?php
if($page->ally_banner_image!=""){
?>
	<section id="content">
            <div class=" img-responsive img-fluid "> 
							<!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_desktop.jpg');">-->
				<img style="" class="img-fluid ally_banner" src="<?=$page->ally_banner_image->httpUrl;?>">
			</div>
			<div class="img-responsive  mobile" >
				<img style="padding-top: 3.5rem;"  class="img-fluid"  src="<?=$page->ally_banner_mobile_image->httpUrl;?>">
			</div>
        </section>
<?php
}
?>
     
<?php
if($page->ally_banner_text!=""){
?>   
    <section id="content " class="banner_text" >
			<div class="content-wrap py-0" >
			    <div class="section border-top-0 m-0 text1_alignment" style="">
					<div class="container clearfix">
					    <div class="row col-mb-50">
							<div>
							
							</div>
                        	<div class="text-md-left hb mb-4 border-bottom-0 text_spacing_sections" >
                            	<p class="p_description " ><?=$page->ally_banner_text;?></p>
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
if($page->register_title!=""){
?>
<div class="container d-flex justify-content-center">
    <a  href="<?=$page->page_redirection_url?>">
        <button type="button" class="btn rounded-pill px-5" style="color:white;background-color:<?=$page->register_title_color;?>"><?=$page->register_title?></button>
    </a>
</div>
<?php
}
?>
<section class="content google_form_container" id="google_form_id">
    <div class="container">
        <div class="google_form_text" >
        <?=$page->ally_register_text;?>
        </div>
    </div>
    <div class="container text-center">
        
    
        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLScad0NfoMKqWweG7NZW5CSTXsiCmqfAF8PdMTqd19JsazyaHQ/viewform?embedded=true"  frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        
        <!--<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeQDCFNNFqHipdF57JaiyHYNN1o4mG7Qc14Z9NIulavgmzIJQ/viewform?embedded=true"  frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>-->
    </div>
</section>
	<!--/** End 2021-05-22  Code by Amruta Jagtap */-->

<div class="[ pt-md-5   px-5 ][ container ][ d-block d-md-none ]">
		<div class="[ pt-4 pb-3 ][ text-center ]">
			<h2><span class=" title_font badge title_break_style" style="color:white;background-color:<?=$page->ally_social_title_color;?>"><?=$page->ally_social_media_title;?></span></h2>
		</div>

		<div class="[ ][ d-flex justify-content-around ]( mobile-icon-bar )">
			
			<a target="_blank" href="https://www.linkedin.com/company/Pride-Circle" class="linkedin"><i class="fa fa-fw fa-linkedin"></i></a>

			<a target="_blank" href="https://www.instagram.com/pride_circle/" class="google"><i class="fa fa-fw fa-instagram"></i></a>
			
			<a target="_blank" href="https://www.facebook.com/PrideCircles/" class="facebook"><i class="fa fa-fw fa-facebook"></i></a>
			
			<a target="_blank" href="https://twitter.com/pride_circle" class="twitter"><i class="fa fa-fw fa-twitter"></i></a>
			
			<a target="_blank" href="https://www.youtube.com/c/PrideCircle" class="youtube"><i class="fa fa-fw fa-youtube"></i></a>
			
			<a target="_blank" href="https://linktr.ee/PrideCircle" class="linktree"><i class="fa fa-fw fa-link"></i></a>

			<a target="_blank" href="mailto:contact@thepridecircle.com" class="about_us_social_link"><i class="fa fa-fw fa-envelope"></i></a>
		</div>

		<div class="[  d-flex justify-content-around ]( mobile-icon-bar )">
			

			
		</div>
	</div>
	
	

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

	<div class="[ mt-0  ][ container-fluid pl-0 pr-0 pb-0 ]">
	

		<div class="[ pb-5 ]( container-fluid shodow  )">

		</div>
		
		
		<div class="[ col-md-12 mt-5 mb-2 text-center ][  d-none d-md-block ]( mobile-icon-bar )">
			
			<a target="_blank" href="https://www.linkedin.com/company/Pride-Circle" class="linkedin"><i class="fa fa-fw fa-linkedin"></i></a>

			<a target="_blank" href="https://www.instagram.com/pride_circle/" class="google"><i class="fa fa-fw fa-instagram"></i></a>
			
			<a target="_blank" href="https://www.facebook.com/PrideCircles/" class="facebook"><i class="fa fa-fw fa-facebook"></i></a>
			
			<a target="_blank" href="https://twitter.com/pride_circle" class="twitter"><i class="fa fa-fw fa-twitter"></i></a>
			
			<a target="_blank" href="https://www.youtube.com/c/PrideCircle" class="youtube"><i class="fa fa-fw fa-youtube"></i></a>
			
			<a target="_blank" href="https://linktr.ee/PrideCircle" class="linktree"><i class="fa fa-fw fa-link"></i></a>

			<a target="_blank" href="mailto:contact@thepridecircle.com" class="about_us_social_link"><i class="fa fa-fw fa-envelope"></i></a>
		</div>

		<div class="[ pb-4 ][ container-fluid  ]">
			<div class="[ row pt-3 ]">
			    
			    <?php
			    $counter=1;
			        foreach($page->footer_links as $footer_links){
			            
			            if($footer_links->footer_files !=""){
			                $footer_url=$footer_links->footer_files->httpUrl;
			            }
			            else{
			                $footer_url=$footer_links->page_redirection_url;
			            }
			            
			            if($counter==1){
			                $style="offset-md-2";
			            }
			            else{
			                $style="";   
			            }
			    ?>
			    <div class="[ <?=$style;?> col-md-4 ][ text-center ]">
			        <!--<a href="<?=$footer_links->footer_files->httpUrl;?>" target="_blank" class="[ text-secondary ]" title=""><?=$footer_links->title?></a>-->
					<a href="<?=$footer_url;?>" target="_blank" class="[ text-secondary ]" title="" download><?=$footer_links->title?></a>
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
                if($page->footer_logo!=""){
                ?>
				<div class="[ pt-4 ][ col-md-12 ][ text-center ]">
					<img src="<?=$page->footer_logo->httpUrl;?>" style="width:70px; height:auto"  alt="">
				</div>
                <?php
                    }
                ?>

				<div class="[ pt-3 ][ col-12 ][ text-center ]">
					Copyright © 2021 Pride Circle
				</div>

				<!-- <div class="[ pt-3 ][ col-12 ][ text-center ]">
					Developed by <a href="http://zerovaega.com/">Zerovaega Technologies</a>
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

	})
</script>

	<!-- ---------- JS LINKS END ---------- -->
    <!-- Linkedin code -->
<script type="text/javascript"> _linkedin_partner_id = "3744588"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3744588&fmt=gif" /> </noscript>
	<!-- End Linkedin code -->
</body>
</html>