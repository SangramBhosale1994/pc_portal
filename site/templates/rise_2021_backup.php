<?php
	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	{
		//Tell the browser to redirect to the HTTPS URL.
		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
		//Prevent the rest of the script from executing.
		exit;
	}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
	<!-- ---------- META TAGS ---------- -->
	<meta property="og:title" content="equALLY">
	<meta property="og:image" content='<?php echo $config->urls->templates."/images/equally_share.jpg"; ?>'>
	<meta property="og:description" content="Stories by friends of the Queer World">
	<meta property="og:url" content="<?= $page->httpUrl ?>">
	<meta property="og:type" content="article" />

	<meta name="twitter:title" content="equALLY">
	<meta name="twitter:description" content="Stories by friends of the Queer World">
	<meta name="twitter:image" content='<?php echo $config->urls->templates."/images/equally_share.jpg"; ?>'>
	<meta name="twitter:card" content="equALLY">

	<meta property="og:site_name" content="equALLY">
	<meta name="twitter:image:alt" content="equALLY">
	<!-- ---------- META TAGS END ---------- -->
	
	
	

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/style_allybook.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/style1_allybook.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/swiper.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/style_rise.css" type="text/css" />

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />


  <!--
        Amchart Word cloud links added by sameesh@30-03-2021
    -->
            <script src="//cdn.amcharts.com/lib/4/core.js"></script>
            <script src="//cdn.amcharts.com/lib/4/charts.js"></script>
            <script src="//cdn.amcharts.com/lib/4/plugins/wordCloud.js"></script>
            <script src="//cdn.amcharts.com/lib/4/themes/animated.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            

	<!-- Document Title
	============================================= -->
	<title>Demo</title>
	


<style type="text/css">



/* By Amrut Todkar 2021-08-03 */
.full-header .primary-menu .menu-container {
    border-right: 1px solid #fff;
}
/* By Amrut Todkar 2021-08-03  END */

	.circle {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  border: 2px solid #fff;
  line-height:36px;
  text-align:center;
  font-size: 20px;
  padding-right: 20px;
  }
.img-fluid {
    width: 100%;
    height: auto;
}
.contentnew {
    /*background: orange;*/
    margin: 1rem;
    padding: 1rem;
    flex: 1;
    color: white;
    display: flex;
}

.contentnew > span {
    margin: auto;
}

.rownew {
    display: flex;
    flex-direction: row;
   /* background-color: blue;*/
    flex: 1
}

.colnew {
    display: flex;
    flex-direction: column;
    flex: 1;
    padding-right: 30px;
   
}
/*ul#menu li
{
	padding-right: 40px;
	padding-left: 20px;

}*/
.countdown-circle {
	       border-radius: 50% !important;
    text-align: center;
    /* padding: 55px; */
    padding-top: 3px;
    margin-left: 56px;
    margin-left: auto;
    margin-right: auto;

}
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
.card_height
  {
          height: 201px ;
  }
.text_spacing_sections
{
    padding-left:1rem;
     padding-right:1rem;
}
/*@media (min-width: 768px)*/
/*.min-vh-md-100 {*/
/*     min-height: 100vh !important; */
/*}*/

.fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed {
 
    width: 94%;

}
@media only screen and (min-width: 300px) and (max-width: 600px)
{
    .img-fluid
    {
         width:100%;
         height:auto;
    }
    .text1_alignment
    {
            padding-left: 1rem;
            padding-right: 1rem;
    }
    .card_height
  {
          height: auto !important ;
  }
  .text_spacing_sections
    {
        padding-left:1rem;
         padding-right:1rem;
    }
    .div_display_mobile
    {
        display:block;
    }


}
@media only screen and (max-device-width: 480px) {
  .img-responsive {
    display: none;
  }
  .img-responsive.mobile {
    display: block;
  }
   .carousel-cell
  {
      height:200px !important;
  }
      .card_height
  {
          height: auto !important ;
  }
  .text_alignment
  {
      padding-left:1rem;
      padding-right:1rem;
  }
  .text_spacing_sections
    {
        padding-left:1rem;
         padding-right:1rem;
    }
    .div_display_mobile
    {
        display:block;
    }

  
}
.desk{
  width:100%;
  height:auto;
  /*background:red;*/
}
.div-only-mobile{
  width:100%;
  height:auto;
  /*background:orange;*/
  
 
  
}
@media only screen and (min-width: 1250px) and (max-width: 1351px)
{
 
   .card_height
  {
             height: 197px;
  }
  .text_spacing_sections
    {
        padding-left:1rem;
         padding-right:1rem;
    }
    .div_display_mobile
    {
        display:none;
    }

}
@media only screen and (min-width: 300px) and (max-width: 429px)
{
 
      .card_height
  {
          height: auto !important ;
  }
      .text_spacing_sections
    {
        padding-left:1rem;
         padding-right:1rem;
    }
}
@media (min-width: 992px){
.full-header #logo {
    
    border-right: 0px ;
}
}

@media only screen and (min-width: 991px) and (max-width: 1250px)
{
  .div-only-mobile{
  /*visibility:hidden;*/
  display: none;
  
  }
   .card_height
  {
             height: 256px;
  }
 .text_spacing_sections
    {
        padding-left:1rem;
         padding-right:1rem;
    }
  .menu_hide{
      display:none;
  }
  
  
}
@media only screen and (min-width: 768px) and (max-width: 991px)
{
 .desk{
  /*visibility:hidden;*/
   display: none;
  }
 .div-only-mobile {
  /*visibility:visible;*/
  display: block;
  }
  p{
      padding-left: 1rem;
    padding-right: 1rem;
  }
  .agenda_section{
      padding-left: 0rem;
    padding-right: 0rem;
  }
  .img-fluid{
     width: 100%; 
      height: auto;
  }
   .card_height
  {
          height: 404px ;
  }
  .text_spacing_sections
    {
        padding-left:1rem;
         padding-right:1rem;
    }
  
}
.content-wrap {
 padding: 0px 0;
    }

.buttonnew {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button2 {background-color: #008CBA;} /* Blue */
.scrollbar_table {
 overflow-y: scroll;
 overflow: hidden;
}
.table_align
{
    width:100%;
  height:200px;
}
.bg-color, .bg-color #header-wrap {
    /*background-color: #1693a5 !important;*/
     background-color: #222 !important;
}
.card
{
    border: 22px solid rgb(22 147 165);
}
.icon-button {
    background-color: white;
    height: 3.6rem;
    position: relative;
    text-align: center;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    width: 27px;
}

/* Circle */
.icon-button span {
	border-radius: 0;
	display: block;
	height: 0;
	left: 50%;
	margin: 0;
	position: absolute;
	top: 50%;
	-webkit-transition: all 0.3s;
	   -moz-transition: all 0.3s;
	     -o-transition: all 0.3s;
	        transition: all 0.3s;
	width: 0;
}
.icon-button:hover span {
	width: 3.6rem;
	height: 3.6rem;
	border-radius: 3.6rem;
	margin: -1.8rem;
}
.twitter span {
	/*background-color: #4099ff;*/
}
.facebook span {
	/*background-color: #3B5998;*/
}
.portfolio-desc {
    padding: 10px 5px;
  
}
.social-icon 
{
        font-size: 1rem;
        width: 30px;
    height: 30px;
}

#main {
  width: 300px;
  height: 50px;
  
  display: flex;
}

#main div {
  -ms-flex: 1;  /* IE 10 */  
  flex: 1;
}


.icon-bar {
  position: fixed;
  top: 70%;
  right:0;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  z-index:3;
}

.icon-bar a {
  display: block;
  text-align: center;
  padding: 11px;
  transition: all 0.3s ease;
  color: white;
  /*font-size: 20px;*/
      width: 38px !important;
       z-index: 99;
}

.icon-bar a:hover {
  background-color: #000;
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
.instagram
{
    background: red;
  color: white;
    
}
.content {
  margin-left: 75px;
  font-size: 30px;
}
* { box-sizing: border-box; }

body { font-family: sans-serif; }

.carousel {
  /*background: #EEE;*/
}

.carousel-cell {
  width: 66%;
  height: 399px;
  margin-right: 10px;
  /*background: #8C8;*/
  border-radius: 5px;
  counter-increment: carousel-cell;
}

/* cell number */
.carousel-cell:before {
  display: block;
  text-align: center;
  content: counter(carousel-cell);
  line-height: 200px;
  font-size: 80px;
  /*color: white;*/
}
.fluid-width-video-wrapper {
    width: 100%;
    position: initial !important;
    padding: 0;
}
 
   
  #chartdiv {
            width: 75vw;
            height: 80vh;
            margin: 0 auto;
        }
.card {
    border: 1px solid rgba(0, 0, 0, 0.125) !important;
    border-radius: 0.25rem;
}

/*footer style by pooja */
#copyrights {
    border-radius: 30px 30px 0 0 !important;
}
/*@media only screen and (max-width: 30000px) and (min-width: 768px){*/
/*#footer{*/
/*    padding: 40px 0 20px!important;*/
    /*background-color: #DDD;*/
/*    font-size: 0.875rem;*/
    /*line-height: 1.8;*/
    /*border-radius: 315px 315px 0 0 !important;*/
/*    border-top-right-radius: 70px;*/
/*    border-top-left-radius: 70px;*/
/*}*/
/*}*/
/*}*/
#footer {
    position: relative;
    border-top-right-radius: 70px;
    border-top-left-radius: 70px;
    /*background-color: #fff !important;*/
    /*border-top: 5px solid rgb(255 255 255) !important;*/
}



/*css by pooja for agenda section*/
@media only screen and (max-width: 767px) and (min-width: 280px){
.title-hide1{
    display:none;
}
}

@media only screen and (max-width: 30000px) and (min-width: 768px){
.title-hide2{
    display:none;
}
}  
@media only screen and (max-width: 30000px) and (min-width: 768px){
    .card-height{
        height:9rem;
    }
}

/*speakers section*/
.img-thumbnail {
    padding: 0.25rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 50% !important;
    max-width: 100%;
    height: auto;
}
.new-width {
    width: 60% !important;
}

/*countdown section*/
.count-h2{
        font-size: 36px;
        margin: 0px 0 13px 0;
        color: #ffffff;
    }
@media only screen and (max-width: 767px) and (min-width: 280px){
    .count-h2{
        font-size: 16px;
        margin: 0px 0 13px 0;
        color: #ffffff;
    }
    
@media only screen and (max-width: 767px) and (min-width: 280px){  
  .btn-space{
       padding: 8px 3px; 
    }
}
  
.linktree{
  background: #28BF7B;
  color: white;
}
.col-3 {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 24% !important;
}

.white-color{
    color:#ffffff !important;
}

.owl-carousel .owl-dots .owl-dot {
    display: inline-block;
    zoom: 1;
    width: 8px;
    height: 8px;
    margin: 30px 4px 0 4px;
    opacity: 0.5;
    border-radius: 50%;
    background-color: #796fea !important;
    -webkit-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}
</style>
</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
	    	<header id="header" class="full-header" data-sticky-shrink="true">
			<div id="header-wrap">
				<div class="container">
				    <div class="d-flex justify-content-between img-responsive">
				        <div id="logo" style=" margin-right: 0;" >
				           <a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
				           </a>
				           
				        </div>
				        <div>
				            <!--web view navigation bar-->
				           <nav class="primary-menu2">
    							<ul class="menu-container">
    								<li class="menu-item"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>"><div>PRIDE CIRCLE</div></a></li>
    								<li class="menu-item"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#about-us"><div>ABOUT US</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#agenda"><div>AGENDA</div></a></li>
                                    <li class="menu-item mega-menu"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#speakers"><div>SPEAKERS</div></a></li>
                                    <li class="menu-item"><a class="menu-link"  href="<?=$pages->get('rise2021-replica')->httpUrl;?>#sponsors_and_partners"><div>SPONSORS & PARTNERS</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#footer"><div>CONTACT US</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#FAQs"><div>FAQS</div></a></li>
    							</ul>
						    </nav><!-- web view navigation bar end -->
				        </div>
				    </div>
				      <div class="d-flex justify-content-between ">
				        <div id="logo" style=" margin-right: 0;" >
    				           <a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
    				           </a>
				           </div>
				       
				        <div id="primary-menu-trigger" style="margin-top:auto; margin-bottom:auto;">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>
				        </div>   
				        <div>
				            <!--mobile view navigation bar-->
				           <nav class="primary-menu d-md-none">
    							<ul class="menu-container">
    								<li class="menu-item"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>"><div>PRIDE CIRCLE</div></a></li>
    								<li class="menu-item"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#about-us"><div>ABOUT US</div></a></li>
                                    <li class="menu-item"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#agenda"><div>AGENDA</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#speakers"><div>SPEAKERS</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#sponsors_and_partners"><div>SPONSORS & PARTNERS</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#footer"><div>CONTACT US</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$pages->get('rise2021-replica')->httpUrl;?>#FAQs"><div>FAQS</div></a></li>
    							</ul>
						    </nav>
						    <!--mobile view navigation bar end-->
				        </div>
				    </div>
				</div>
			</div>
			<div class="header-wrap-clone" style="height: 118px;"></div>
		</header><!-- #header end -->
		
		<!--banner section by pooja-->
		<section id="content" style="position: relative;z-index: 99;">
		    <!--web view banner-->
            <div class=" img-responsive img-fluid "> 
				<a href="https://tinyurl.com/PrideEdSignUp" target="_blank"><img style="" class="img-fluid" src="<?=$urls->httpTemplates?>Copy of banner.jpg" ></a>
			</div>
			<!--end-->
			<!--mobile view banner-->
			<div class="img-responsive  mobile" >
					<a href="https://tinyurl.com/PrideEdSignUp" target="_blank"><img  class="img-fluid"  src="<?=$urls->httpTemplates?>Copy of banner-mobile.jpg"> </a>
			</div> 
			<!--end-->
        </section>
		<!--banner section end-->
		
		<!--paragraph section-->
            <section id="about-us" class="mt-6">
            	<div class="content-wrap" id="about_rise">
            		<div class="container">
            			<div class="title_new heading-block center border-bottom-0 mb-0">
            				<h3 style="#000033;font-style: italic;" class="mb-4"><?=$page->heading1;?></h3>
            					<p><?=$page->text_description;?></p>
            					
            			</div>
            		</div>
            	</div>
            </section>
            <!--paragraph end-->
            
            <!--countdown section-->
            <section id="content" class="pt-4 pb-4 mt-6" style="background-color: #eecce5;">
            <div class="container">
                <div class="title_new heading-block center border-bottom-0 mb-0">
                <h3 class="mb-4">WE ARE COMING SOON</h3>
                </div>
                <div class="mt-4">
                    <div class="mx-auto" >
							<div class="row clearfix" style="background-color: #501b75;border-radius: 30px;padding: 3px;">
								<div class="col-3 col-md-3 mt-3 center customers-count">
									<h2 id="days" class="count-h2"></h2>
									<h2 class="count-h2">Days</h2>
								</div>
								<div class="col-3 col-md-3 mt-3 center customers-count">
									<h2 id="hours" class="count-h2" ></h2>
									<h2 class="count-h2">Hours</h2>
								</div>
								<div class="col-3 col-md-3 mt-3 center customers-count">
									<h2 id="minutes" class="count-h2"></h2>
									<h2 class="count-h2">Minutes</h2>
								</div>
								<div class="col-3 col-md-3 mt-3 center customers-count">
									<h2 id="seconds" class="count-h2"></h2>
									<h2 class="count-h2">Seconds</h2>
								</div>
							</div>
						</div>
                </div>
                <div class="col-12 col-lg-12 mt-4 mt-lg-3 center">
					<a href="https://tinyurl.com/PrideEdSignUp" target="_blank" class="btn purple">Register Now</a>
					<!--<a href="#" class="button button-border button-rounded"><i class="icon-gift"></i>Button</a>-->
				</div>
            </div>
            </section>
            <!--countdown section end-->
            
            
            <!--icons section-->
            <section id="" class="">
                <div class="container clearfix mt-4">
                    <div class="title_new heading-block center border-bottom-0 mb-0">
                    <h3 style="#000033;" class="mb-4 mt-6">WHAT DO WE AIM TO DO?</h3>
                    </div>
					<div class="row col-mb-50 px-lg-5">
						<div class="col-sm-6 col-lg-6">
							<div class="feature-box fbox-effect">
								<div class="fbox-icon">
									<a href="#"><img src="<?=$page->aim_logo->httpUrl;?>" alt="" ></a>
								</div>
								<div class="title_new fbox-content">
									<p>To initiate and catalyze dialogue around LGBT+ inclusion in learning.</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="feature-box fbox-effect">
								<div class="fbox-icon">
									<a href="#"><img src="<?=$page->aim_logo1->httpUrl;?>" alt="" ></a>
								</div>
								<div class="title_new fbox-content">
									<p>To sustain this conversation through supporting ideas for affirmative action.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
            </section>
            <!--icon section end-->
       	
       	    <!--cards section-->
            <section id="content" class=" container_style">
                         <div class="container">
                              <div class="title_new heading-block center border-bottom-0 mb-0">
                                <h3 class="mb-4 mt-6">SUSTAINABLE DEVELOPMENT GOALS AND PRIDE-ED SUMMIT 2021</h3>
                              </div>
                              <div class="row">
                              <div class="col-md-4 tickets_column">
                                <div class="card" style="">
                                  <div class="card-body">
                                    <div class="center">
    									<img src="<?=$page->covid_19_banner->httpUrl;?>" alt="Memebers" width="120" class="center mb-2">
    									<!--<h5 class="font-weight-medium"><a href="demo-forum-profile.html">Jim Séchen</a></h5>-->
    								</div>
                                   <h2 class="title_new card-title card_text_alignmnet text-center ">SDG 1</h2>
                                   <div  class="card-height center">End poverty in all its forms everywhere</div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4 tickets_column">
                                <div class="card tickets_column " style="">
                                  <div class="card-body">
                                    <div class="center">
    									<img src="<?=$page->footer_logo->httpUrl;?>" alt="Memebers" width="120" class="center mb-2">
    									<!--<h5 class="font-weight-medium"><a href="demo-forum-profile.html">Jim Séchen</a></h5>-->
    								</div>
                                   <h2 class="title_new card-title card_text_alignmnet text-center ">SDG 4</h2>
                                   <div class="card-height center">Ensure inclusive and equitable quality education and promote  lifelong learning opportunities for all</div>    
                                  </div>
                                </div>
                              </div>
                               <div class="col-md-4 tickets_column">
                                <div class="card " style="">
                                  <div class="card-body">
                                   <div class="center">
    									<img src="<?=$page->covid_19_mobile_banner->httpUrl;?>" alt="Memebers" width="120" class="center mb-2">
    									<!--<h5 class="font-weight-medium"><a href="demo-forum-profile.html">Jim Séchen</a></h5>-->
    								</div>
                                   <h2 class="title_new card-title card_text_alignmnet text-center ">SDG 16</h2>
                                   
                                   <div class="card-height center">Promote peaceful and inclusive societies for sustainable development, provide access to justice for all and  build effective, accountable and inclusive  institutions at all levels</div>   
                                  </div>
                                </div>
                              </div>
                        </div>
                         </div>
                        <div id="agenda"></div>	
            </section>
            <!--cards section end-->
            
            <!--Agenda section-->
            <section class="spacing_riseref spacing_riseref1 section_style ">
			    <div class="content-wrap py-0" style="margin-bottom: -2rem !important;">
                    <div class="container-fluid">
                        <div class="title_new heading-block center border-bottom-0 mb-0">
                           <h3 style="#000033;" class="mb-4 mt-6">Agenda</h3>
                           <p style="font-style: italic;">All timings in IST <br> Tentative timings and sessions, subject to change</p>
                        </div>
                        <div class="row">
                            <div class="title-hide1 col-md-12" style="padding-right: 0px;padding-left: 0px;">
                                <div  class="">
								     <img src="<?=$page->ally_banner_image->httpUrl;?>" alt="Standard Post with Image" >
							    </div>
                            </div>
                            <div class="title-hide2 col-md-12">
                                <div  class="">
							    	<img src="<?=$page->ally_banner_mobile_image->httpUrl;?>" alt="Standard Post with Image">
							    </div>
                            </div>
                        </div>
                    </div>
			    </div>
			 <div class="center mt-5">
				<a href="#" target="_blank" class="btn purple">Detailed agenda coming soon!</a>
			</div>
			<div id="speakers"></div>
		    </section>
            <!--agenda section end-->
            
            
            <!--speakers section-->
            <section class="">
				<div id="section-multipage" class="page-section center bg-transparent mb-0 clearfix">
					<div class="px-5 container-fluid" style="max-width: 1600px">

						<div class="mb-4 mt-6 center border-bottom-0 clearfix">
							<h2 class="nott" style="font-size: 36px; line-height: 1.2; letter-spacing: -1px;">SPEAKERS</h2>
						</div>

						<?php 
                        foreach($page->speakers_section as $speakers_section)
                        {
                        ?>
                        <div class="title_new heading-block center border-bottom-0 mb-0">
                           <a href="#" target="_blank"><h4 class="mb-4"><?=$speakers_section->title;?></h4></a>
                        </div>
						<div id="intro-multipages-container" class="row col-mb-50 mb-0">
						    <?php 
                            foreach($speakers_section->speakers_information as $speakers_information)
                            {
                            ?>
							<div class="grid-intro-item col-lg-1-5 col-md-4 col-sm-6 col-12">
								<div class="portfolio-item">
									<div class="portfolio-image  rounded-lg">
										<a href="index-corporate.html" target="_blank">
											<img src="<?=$speakers_information->ally_banner_mobile_image->httpUrl;?>" alt="Live Preview">
										</a>
									</div>
									<div class="portfolio-desc center pb-0">
										<a href="#" target="_blank">
										<img src="<?=$urls->httpTemplates?>icons8-linkedin-48.png" class="mb-1" alt="Lightbox" style="max-width: 33px;"></a>
										<h3><?=$speakers_information->account_type;?></h3>
										<div><?=$speakers_information->ally_challenge_leaderboard_timestamp;?></div>
        							    <div><?=$speakers_information->ally_challenge_resource_locator;?></div>
        							    <div><?=$speakers_information->ally_social_media_title;?></div>
									</div>
								</div>
							</div>
							<?
                            }
                            ?>
						</div>
						<?
                        }
                        ?>
					</div>
				</div>
				<div id="sponsors_and_partners"></div>
            </section>
            <!--speaker end-->
            
            
            <!--sponsors and partner section-->
            <section class="">
                <div class="title_new heading-block center border-bottom-0 mb-0 ">
                    <h2 style="#000033;" class="mb-4 mt-6">Sponsors</h2>
                </div>
                <?php 
                    foreach($page->multiple_sponsors_repeater as $multiple_sponsors_repeater)
                    {
                    ?>
                <div class="title_new heading-block center border-bottom-0 mb-0 ">
                    <h4 style="#000033;" class="mb-4"><?=$multiple_sponsors_repeater->title;?></h4>
                </div>
				<div class="container mt-3">
				      <ul class="clients-grid grid-2 grid-sm-3 grid-md-5 mb-0">
				          <?php 
                            foreach($multiple_sponsors_repeater->speakers_repeater as $speakers_repeater)
                            {
                            ?>
                
						   <li class="grid-item"><a href="#"><img src="<?=$speakers_repeater->ally_banner_image->httpUrl;?>" alt="Sponsors"></a></li>
						   <?
                            }
                            ?>
				      </ul>
				</div>
				<?
                }
                ?>
                 <style>
                    .heading-block > span:not(.before-heading) {
                    display: block;
                    margin-top: 2px !important;
                    font-weight: 600 !important;
                    color: #333 !important;
                    font-size: 20px !important;
                }
                @media only screen and (max-width: 767px) and (min-width: 280px){
                    .heading-block > span:not(.before-heading) {
                        display: block;
                        margin-top: 2px !important;
                        font-weight: 600 !important;
                        color: #333 !important;
                        font-size: inherit !important;
                        }
                }
                 </style>
				<div class="promo promo-full mt-6 p-4 p-md-5 mb-5">
					<div class="container">
						<div class="row justify-content-center" style="border: 3px solid #502a75;border-radius: 10px;padding:35px;">
							<div class="heading-block center border-bottom-0 mb-0">
        						<span class="nott">Want to extend support to our vision?</span>
        						<span>For all sponsorship enquiries, please reach out to </span>
        						<span><a href="mailto:contact@thepridecircle.com" data-scrollto="#section-testimonials" data-easing="easeInOutExpo" data-speed="1250">contact@thepridecircle.com</a></span>
        					</div>
						</div>
					</div>
				</div>
                 <!--div section end-->
                 
				<div class="title_new heading-block center border-bottom-0 mb-0 mt-6">
                    <h3 style="#000033;" class="mb-4">Partners</h3>
                </div>
				<div class="container mt-3">
					<div id="oc-clients" class="owl-carousel image-carousel carousel-widget" data-margin="20" data-nav="false" data-pagi="true" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">
    					<!--<div class="bxslider">-->
    					    <?php 
                                foreach($page->partners_repeater as $repeater)
                                {
                                ?>
                                <div class="oc-item"><a href="#"><img src="<?=$repeater->ally_banner_image->httpUrl;?>" alt="Partners"></a></div>
                                <!--<img src="https://dummyimage.com/400x250/EC184B/fff.png" alt="Partners">-->
                                <?
                                }
                                ?>
                        </div>
                    <!--</div>-->
				</div>
				<div></div>
			</section>	
			<!--sponsors and partner section end-->
			
            
        
			<!--frequently asked questions-->
			<style>
			    
			    .btn {
                  background-color: transparent !important;
                  color: #ffffff !important;
                  padding: 14px 28px !important;
                  /*font-size: 16px;*/
                  cursor: pointer;
                  font-weight: 700 !important;
                }
			   .purple {
                  border-color: #502a75 !important;
                  color: #502a75 !important;
                  border-radius: 10px !important;
                  border: 2px solid !important;
                }
                .purple:hover {
                  background-color: #502a75 !important;
                  color: #ffffff !important;
                  border: 2px solid #502a75 !important;
                }
			</style>
			<section id="FAQs">
            <div class=" mt-6 mb-4">
				<div class="" >
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-12 col-lg-4 ">
								<h3 class="mt-2 center">Frequently Asked Questions</h3>
							</div>
							<div class="col-12 col-lg-3 mt-4 mt-lg-0 center">
								<a href="#" class="btn purple">DOWNLOAD</a>
							</div>
						</div>
					</div>
				</div>
            </div>
            </section>
            <!--frequently asked question secton end-->

		
            <!--demo footer-->
            <style>
                #footer{
                     background-image: url("<?=$urls->httpTemplates?>images/footer.jpg");
                     /*height:300px;*/
                     background-repeat : no-repeat;
                     background-size: cover;
                     min-height: 200px;
                     background-position: center top;
                }
                #footer {
                    position: relative;
                    background-color: #EEE;
                    border-top: none !important;
                }
                #copyrights {
                    padding: 40px 0;
                    background-color: transparent !important;
                    font-size: 0.875rem;
                    line-height: 1.8;
                }
            </style>
		

 <footer id="footer" class="" style="margin-top: 0px;"  >

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row ">
					    <div class="col-md-12 title_new heading-block center border-bottom-0 mb-0">
                           <h3 class="white-color mb-2" style="color:#ffffff;">Stay Updated</h3>
                        </div>
						<div class="col-md-12 center">
							<div class="d-flex justify-content-center ">
							    <a target="_blank" href="https://tinyurl.com/PrideCircleLinkedIn" class="social-icon si-small si-borderless si-linkedin">
									<i class="white-color icon-linkedin" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-linkedin" style="font-size: 1.5rem;"></i>
								</a>
								<a target="_blank" href="https://tinyurl.com/PIEInstagram" class="social-icon si-small si-borderless si-instagram">
									<i class="white-color icon-instagram" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-instagram" style="font-size: 1.5rem;"></i>
								</a>
								
								<a target="_blank" href="https://tinyurl.com/FacebookPrideCircle" class="social-icon si-small si-borderless si-facebook">
									<i class="white-color icon-facebook" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-facebook" style="font-size: 1.5rem;"></i>
								</a>
								
								<a target="_blank" href="https://tinyurl.com/YouTubePrideCircle" class="social-icon si-small si-borderless si-gplus">
									<i class="white-color icon-line2-social-youtube" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-line2-social-youtube" style="font-size: 1.5rem;"></i>
								</a>
								
								<a target="_blank" href="https://tinyurl.com/TwitterPrideCircle" class="social-icon si-small si-borderless si-twitter">
									<i class="icon-twitter" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-twitter" style="font-size: 1.5rem;"></i>
								</a>
                                <a target="_blank"  href="https://linktr.ee/PrideCircle" class="social-icon si-small si-borderless  si-tripadvisor">
									<i class="white-color icon-line-link" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-line-link" style="font-size: 1.5rem; background-color:#28BF7B;"></i>
								</a>
								

								<a target="_blank" href="mailto:contact@thepridecircle.com" class="social-icon si-small si-borderless si-pinterest">
									<i class="white-color icon-email3" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-email3" style="font-size: 1.5rem;"></i>
								</a>
							
								<!--<a target="_blank" href="https://linktr.ee/PrideCircle" class="linktree"><i class="fa fa-fw fa-link" aria-hidden="true"></i></a>-->
							</div>

							<div class="clear"></div>

						</div>
						<div class="white-color col-md-12 center mt-4" style="color:#ffffff;">
						Developed by <a target="_blank" style="color:#ffffff;" href="https://zerovaega.com/">Zerovaega Technologies</a><br>
							<!--<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>-->
						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->
	<div id="gotoTop" class="icon-angle-up"></div>
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/jquery.js"></script>
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/plugins.min.js"></script>
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/functions.js"></script>
<script>
console.log("margin")
    $(window).on("load", function(){
        console.log("margin")
        //setInterval($("footer").css("margin-top", "20px"), 1000)
        $("footer").css("margin-top", "20px")
        setInterval(function(){ $("footer").css("margin-top", "20px") }, 1000);
    })



  $("#oc-portfolio").owlCarousel({
    item:4,
    singleItem: true,
    autoplay: true,
    autoplayTimeout: 5000,
    loop: true,
    nav: true,
    responsiveClass: true,
    responsive:{
        0:{
            items: 1,
            dots: false
        },
        600:{
            items: 2,
            dots: false
        },
        1200:{
            items: 4
        }
    }
});
</script>
    
    <!--js by pooja for countdown section-->
    <script>
    const days = document.querySelectorAll("days");
const hours = document.querySelectorAll("hours");
const minutes = document.querySelectorAll("minutes");
const seconds = document.querySelectorAll("seconds");


const currentYear = new Date().getFullYear();
const newYearTime = new Date(`January 1 ${currentYear + 1} 00:00:00`);

//update countdowntime
function updateCountdown() {
    const currentTime = new Date();
    const diff = newYearTime - currentTime;

    const d = Math.floor(diff / 1000 / 60 / 60 / 24);
    const h = Math.floor(diff / 1000 / 60 / 60) % 24;
    const m = Math.floor(diff / 1000 / 60) % 60;
    const s = Math.floor(diff / 1000) % 60;

    document.getElementById('days').innerHTML = d;
    document.getElementById('hours').innerHTML = h;
    document.getElementById('minutes').innerHTML = m;
    document.getElementById('seconds').innerHTML = s;

} setInterval(updateCountdown, 1000);
</script>

</body>
</html>

