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
/*@media only screen and (max-width: 30000px) and (min-width: 768px){*/
/*#copyrights {*/
/*    padding: 40px 0;*/
/*    background-color: #DDD;*/
/*    font-size: 0.875rem;*/
/*    line-height: 1.8;*/
/*    border-radius: 315px 315px 0 0 !important;*/
/*}*/
/*}*/
/*#footer {*/
/*    position: relative;*/
/*    background-color: #fff !important;*/
/*    border-top: 5px solid rgb(255 255 255) !important;*/
/*}*/

/*css by pooja for agenda section*/
/*@media only screen and (max-width: 767px) and (min-width: 280px){*/
/*.title-hide1{*/
/*    display:none;*/
/*}*/
/*}*/

/*@media only screen and (max-width: 30000px) and (min-width: 768px){*/
/*.title-hide2{*/
/*    display:none;*/
/*}*/
/*}  */
/*@media only screen and (max-width: 30000px) and (min-width: 768px){*/
/*    .card-height{*/
/*        height:9rem;*/
/*    }*/
/*}*/

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
    								<li class="menu-item"><a class="menu-link" href="#"><div>PRIDE CIRCLE</div></a></li>
    								<li class="menu-item"><a class="menu-link" href="#"><div>ABOUT US</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>AGENDA</div></a></li>
                                    <li class="menu-item mega-menu"><a class="menu-link" href="#"><div>SPEAKERS</div></a></li>
                                    <li class="menu-item"><a class="menu-link"  href="#"><div>SPONSORS & PARTNERS</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>CONTACT US</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>FAQS</div></a></li>
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
    								<li class="menu-item"><a class="menu-link" href="#"><div>PRIDE CIRCLE</div></a></li>
    								<li class="menu-item"><a class="menu-link" href="#"><div>ABOUT US</div></a></li>
                                    <li class="menu-item"><a class="menu-link" href="#"><div>AGENDA</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>SPEAKERS</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>SPONSORS & PARTNERS</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>CONTACT US</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>FAQS</div></a></li>
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
				<a href="#" target="_blank"><img style="" class="img-fluid" src="<?=$urls->httpTemplates?>Copy of banner.jpg" ></a>
			</div>
			<!--end-->
			<!--mobile view banner-->
			<div class="img-responsive  mobile" >
					<a href="#" target="_blank"><img  class="img-fluid"  src="<?=$urls->httpTemplates?>Copy of banner-mobile.jpg"> </a>
			</div> 
			<!--end-->
        </section>
		<!--banner section end-->
		
		<!--paragraph section-->
            <section id="content" class="mt-6">
            	<div class="content-wrap" id="about_rise">
            		<div class="container">
            			<div class="title_new heading-block center border-bottom-0 mb-0">
            				<h3 style="#000033;font-style: italic;" class="mb-4">“The youth of today are the leaders of tomorrow.” <br>
            				- Nelson Mandela</h3>
            					<p>This October, Pride Circle brings to you India’s leading conference - Pride-Ed Summit 2021 - to foster belonging in education! The conference focuses on spotlighting  inclusive learning and building opportunities and safe spaces for LGBT+ students around the nation.</p>
            					<p>Whether you are a student, parent, teacher or employer - We invite you to join us on this journey to re-shape your space and build a better, inclusive world, which welcomes, accepts and celebrates LGBT+ individuals for who they are. </p>
            					<p style="font-style: italic;">Let’s take this first step towards fostering belonging in education. Change starts from us!</p>
            			</div>
            		</div>
            	</div>
            </section>
            <!--paragraph end-->
            
            <!--countdown section-->
            <section id="content" class="mt-6">
            <div class="container">
                <div class="title_new heading-block center border-bottom-0 mb-0">
                <h3 class="mb-4">WE ARE COMING SOON</h3>
                </div>
                <div class="mt-4">
                    <div class="mx-auto" style="max-width: 960px">
							<div class="row clearfix">
								<div class="col-12 col-md-3 center customers-count">
									<h2 id="days" style="font-size: 36px;"></h2>
									<h2 style="font-size: 36px;">Days</h2>
								</div>
								<div class="col-12 col-md-3 center customers-count">
									<h2 id="hours" style="font-size: 36px;" ></h2>
									<h2 style="font-size: 36px;">Hours</h2>
								</div>
								<div class="col-12 col-md-3 center customers-count">
									<h2 id="minutes" style="font-size: 36px;"></h2>
									<h2 style="font-size: 36px;">Minutes</h2>
								</div>
								<div class="col-12 col-md-3 center customers-count">
									<h2 id="seconds" style="font-size: 36px;"></h2>
									<h2 style="font-size: 36px;">Seconds</h2>
								</div>
							</div>
						</div>
                </div>
                <div class="title_new heading-block center border-bottom-0 mb-0">
                <a href="#" target="_blank"><h4 class="mb-4">Register Now</h4></a>
                </div>
            </div>
            </section>
            <!--countdown section end-->
            
            
            <!--icons section-->
            <section id="" class="mt-6">
                <div class="container clearfix mt-4">
                    <div class="title_new heading-block center border-bottom-0 mb-0">
                    <h3 style="#000033;" class="mb-4">WHAT DO WE AIM TO DO?</h3>
                    </div>
					<div class="row col-mb-50">
						<div class="col-sm-6 col-lg-6">
							<div class="feature-box fbox-effect">
								<div class="fbox-icon">
									<a href="#"><i class="icon-screen i-alt"></i></a>
								</div>
								<div class="title_new fbox-content">
									<p>To initiate and catalyze dialogue around LGBT+ inclusion in learning.</p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="feature-box fbox-effect">
								<div class="fbox-icon">
									<a href="#"><i class="icon-eye i-alt"></i></a>
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
            <section id="content" class="mt-6 container_style">
                         <div class="container">
                              <div class="row">
                              <div class="col-md-4 tickets_column">
                                <div class="card" style="">
                                  <div class="card-body">
                                    <div class="center">
    									<img src="<?=$rootpath;?>1.png" alt="Memebers" width="120" class="center mb-2">
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
    									<img src="<?=$rootpath;?>2.png" alt="Memebers" width="120" class="center mb-2">
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
    									<img src="<?=$rootpath;?>3.png" alt="Memebers" width="120" class="center mb-2">
    									<!--<h5 class="font-weight-medium"><a href="demo-forum-profile.html">Jim Séchen</a></h5>-->
    								</div>
                                   <h2 class="title_new card-title card_text_alignmnet text-center ">SDG 16</h2>
                                   
                                   <div class="card-height center">Promote peaceful and inclusive societies for sustainable development, provide access to justice for all and  build effective, accountable and inclusive  institutions at all levels</div>   
                                  </div>
                                </div>
                              </div>
                        </div>
                         </div>
                        	
    
</section>
            <!--cards section end-->
            
            <!--Agenda section-->
            <section id="content" class="mt-6 spacing_riseref spacing_riseref1 section_style ">
			    <div class="content-wrap py-0" style="margin-bottom: -2rem !important;">
                    <div class="container">
                        <div class="title_new heading-block center border-bottom-0 mb-0">
                           <h3 style="#000033;" class="mb-4">Agenda</h3>
                           <p style="font-style: italic;">All timings in IST Tentative timings and sessions, subject to change</p>
                        </div>
                        <div class="row">
                            <div class="title-hide1 col-md-12">
                                <div  class="vedio_spacing vedio_height vedio_height_new">
								     <img src="<?=$page->ally_banner_image->httpUrl;?>" alt="Standard Post with Image" >
							    </div>
                            </div>
                            <div class="title-hide2 col-md-12">
                                <div  class="vedio_spacing  vedio_height_new">
							    	<img src="<?=$page->ally_banner_mobile_image->httpUrl;?>" alt="Standard Post with Image">
							    </div>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-lg-6 mb-4">
                        <div class="d-flex justify-content-center">
                           <h3 class="center mt-lg-3"><a href="<?=$urls->httpTemplates?>files/RISE2021-Agenda.pdf" class="">Download the detailed Agenda </a></h3>
                        </div>
                    </div>
			    </div>
		    </section>
            <!--agenda section end-->
            
            <!--speakers section-->
            <section id="" class="mt-6">
                <div class="container">
                    <div class="title_new heading-block center border-bottom-0 mb-0">
                    <h3 style="#000033;" class="mb-4">SPEAKERS</h3>
                    </div>
                    <div class="title_new heading-block center border-bottom-0 mb-0">
                <a href="#" target="_blank"><h4 class="mb-4">Day 1</h4></a>
                </div>
                    <div class="row">
							  <div class="col-12 col-sm-6 col-lg-3 mb-3 mb-lg-0">
								<a href="#">
								  <img alt="100%x180" src="<?=$rootpath;?>200x200.gif" class="img-thumbnail w-100 d-block">
								</a>
								<div class="center">
            						<!--<i class="icon-linkedin"></i>-->
        							<h3 style="margin: 0 0 0px 0;">Hello</h3>
        							<i class="icon-linkedin"></i>
        							<div>Portfolio Layouts</div>
        							<div>Portfolio Layouts</div>
        							<div>Portfolio Layouts</div>
        						</div>
							  </div>
							  <div class="col-12 col-sm-6 col-lg-3 mb-3 mb-lg-0">
							    <a href="#">
								  <img alt="100%x180" src="<?=$rootpath;?>200x200.gif" class="img-thumbnail w-100 d-block">
								</a>
								<div class="center">
        							<i class="icon-linkedin"></i>
            						<!--<i class="icon-linkedin"></i>-->
        							<div class="counter"><span data-from="10" data-to="165" data-refresh-interval="50" data-speed="2000">165</span>+</div>
        							<h5>Portfolio Layouts</h5>
        						</div>
							  </div>
							  <div class="col-12 col-sm-6 col-lg-3 mb-3 mb-lg-0">
								<a href="#">
								  <img alt="100%x180" src="<?=$rootpath;?>200x200.gif" class="img-thumbnail w-100 d-block">
								</a>
								<div class="center">
								    <i class="icon-linkedin"></i>
            						<!--<i class="icon-linkedin"></i>-->
        							<div class="counter"><span data-from="10" data-to="165" data-refresh-interval="50" data-speed="2000">165</span>+</div>
        							<h5>Portfolio Layouts</h5>
        						</div>
							  </div>
							  <div class="col-12 col-sm-6 col-lg-3 mb-3 mb-lg-0">
								<a href="#">
								  <img alt="100%x180" src="<?=$rootpath;?>200x200.gif" class="img-thumbnail w-100 d-block">
								</a>
								<div class="center">
        							<i class="icon-linkedin"></i>
            						<!--<i class="icon-linkedin"></i>-->
        							<div class="counter"><span data-from="10" data-to="165" data-refresh-interval="50" data-speed="2000">165</span>+</div>
        							<h5>Portfolio Layouts</h5>
        						</div>
							</div>
                </div>
                </div>
            </section>
            <!--speakers section end-->
            
            <!--sponsors and partner section-->
            <section id="content"  style="margin-top:4rem;">
                <div class="title_new heading-block center border-bottom-0 mb-0 mt-6">
                    <h2 style="#000033;" class="mb-4">Sponsors</h2>
                </div>
                <?php 
                    foreach($page->multiple_sponsors_repeater as $multiple_sponsors_repeater)
                    {
                    ?>
                <div class="title_new heading-block center border-bottom-0 mb-0 mt-6">
                    <h4 style="#000033;" class="mb-4"><?=$multiple_sponsors_repeater->title;?></h4>
                </div>
				<div class="container mt-3">
				      <ul class="clients-grid grid-2 grid-sm-3 grid-md-4 mb-0">
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
                 
                 <!--div section-->
                <div class="container mt-6">
				<div class="section mt-0 clearfix" style="border: 5px solid;">
					<div class="heading-block center border-bottom-0 mb-0">
						<h2 class="nott" style="font-size: 36px;">Want to extend support to our vision?</h2>
						<span>For all sponsorship enquiries, please reach out to <br>
						<a href="#" data-scrollto="#section-testimonials" data-easing="easeInOutExpo" data-speed="1250">contact@thepridecircle.com</a></span>
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
			</section>	
			<!--sponsors and partner section end-->
			
			<!--frequently asked questions-->
            <div class=" mt-6 mb-6">
                <div class="">
                   <div class="col-md-12">
                    <div class="container">
                        <div class="card card_faq" style="border-color: black; border-width: medium; margin-left:1rem; margin-right:1rem;">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1 class="text-center text-Black">Frequently Asked Questions</h1>
                                </div>
                                
                               
                                <div class="text-center">
                                   
                                    <a target="_blank" href="<?=$pages->get("name=rise2021-faq")->httpUrl;?>">
                                    <!-- <a href="#"> -->
                                        <button class=" text-center btn_ticket_job_fair" style="width: 36%" >View FAQs</button>
                                        
                                        <!-- <button class=" text-center btn_ticket_job_fair" >Coming Soon</button> -->
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                </div>
            </div>
            <!--frequently asked question secton end-->

			

            
			
		

 <footer id="footer" class="" style="margin-top: 0px;"  >

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30">
						<div class="col-md-12 center">
							<div class="d-flex justify-content-center ">
								<a target="_blank" href="https://www.facebook.com/LetUsAllRise/" class="social-icon si-small si-borderless si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>
									<a target="_blank" href="https://www.instagram.com/rise4all/" class="social-icon si-small si-borderless si-instagram">
									<i class="icon-instagram"></i>
									<i class="icon-instagram"></i>
								</a>

								<a target="_blank" href="#" class="social-icon si-small si-borderless si-twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-gplus">
									<i class="icon-gplus"></i>
									<i class="icon-gplus"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-pinterest">
									<i class="icon-pinterest"></i>
									<i class="icon-pinterest"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-vimeo">
									<i class="icon-vimeo"></i>
									<i class="icon-vimeo"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-github">
									<i class="icon-github"></i>
									<i class="icon-github"></i>
								</a>

								<a href="#" class="social-icon si-small si-borderless si-yahoo">
									<i class="icon-yahoo"></i>
									<i class="icon-yahoo"></i>
								</a>

								<a target="_blank" href="#" class="social-icon si-small si-borderless si-linkedin">
									<i class="icon-linkedin"></i>
									<i class="icon-linkedin"></i>
								</a>
							</div>

							<div class="clear"></div>

						</div>
						<div class="col-md-12 center">
						Copyrights &copy; <?php echo date("Y")?>  All Rights Reserved by Pride Circle<br>
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

