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
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
    
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
		<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());

				gtag('config', 'G-C3XCR831MS');
		</script> -->
	

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

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/custom.css" type="text/css" />
  <link rel="icon" href="<?=$urls->httpTemplates?>images/index.png" sizes="32x32" />
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
	<title>Equally</title>
	


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
    /* border-radius: 3.6rem; */
    /* cursor: pointer; */
    /* display: inline-block; */
    /* font-size: 2.0rem; */
    height: 3.6rem;
    /* line-height: 3.6rem; */
    /* margin: 0 5px; */
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

/* Icons */
/*.icon-button i {*/
/*	background: none;*/
/*	color: #4099ff;*/
/*	height: 3.6rem;*/
/*	left: 0;*/
/*	line-height: 3.6rem;*/
/*	position: absolute;*/
/*	top: 0;*/
/*	-webkit-transition: all 0.3s;*/
/*	   -moz-transition: all 0.3s;*/
/*	     -o-transition: all 0.3s;*/
/*	        transition: all 0.3s;*/
/*	width: 3.6rem;*/
/*	z-index: 10;*/
/*}*/
/*.icon-button .icon-twitter {*/
/*	color: #4099ff;*/
/*}*/
/*.icon-button .icon-facebook {*/
/*	color: #3B5998;*/
/*}*/
/*.icon-button .icon-google-plus {*/
/*	color: #db5a3c;*/
/*}*/
/*.icon-button:hover .icon-twitter,*/
/*.icon-button:hover .icon-facebook,*/
/*.icon-button:hover .icon-google-plus {*/
/*	color: #4099ff;*/
/*}*/

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

</style>
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
				           <!--<a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">-->
				           <!--</a>-->
				           <!--  <a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/Rupa.png" alt="Canvas Logo">-->
				           <!--</a>-->
				           
				            
				           
				        </div>
				  <!--         <div id="primary-menu-trigger">-->
						<!--	<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>-->
						<!--</div>-->
				        
				        
				        
				        
				        <div>
				           <nav class="primary-menu2">

    							<ul class="menu-container">
    								<li class="menu-item">
    									<a class="menu-link" href="#home"><div>Home</div></a>
    									
    								</li>
    								<li class="menu-item">
                      <a class="menu-link" href="#ourallies"><div>Authors</div></a>
                      
                    </li>
                      <!--Changes Done : Hemlata-->
				    <!--Date : 28-04-2021-->
				    <!--Reason : change tab name-->
                    <!-- <li class="menu-item">
                      <a class="menu-link" target="_blank" href="https://www.amazon.in/equALLY-Stories-Friends-Queer-World/dp/9390547768/ref=tmm_hrd_swatch_0?_encoding=UTF8&qid=1617199802&sr=8-1"><div>Order Now</div></a>
                      
                    </li> -->
                    <!--changes done by : hemlata-->
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="<?php echo $page->child("name=launch")->httpUrl?>"><div>Book Launch</div></a>
    									
    								</li>
                    <li class="menu-item mega-menu">
                      <a class="menu-link" href="#wordcloud"><div>Ally Pledge</div></a>
                    
                    </li>
                    <li class="menu-item">
                        <a class="menu-link"  href="#media"><div>Media</div></a>
                    </li>
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="#testimonal"><div>Testimonials</div></a>
    								
    								</li>
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="#partners"><div>Partners</div></a>
    									
    								</li>
    
    								
    							</ul>

						    </nav><!-- #primary-menu end -->
				        </div>
				        
				        
				        
				          <div id="logo" style=" margin-right: 0;" >
				           <a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/Rupa.png" alt="Canvas Logo">
				           </a>
				          </div>
				           
				        </div>
				      <div class="d-flex justify-content-between ">
				        <div id="logo" style=" margin-right: 0;" >
				           <!--<a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">-->
				           <!--</a>-->
    				           <a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
    				           </a>
				           </div>
				            <div id="logo" style=" margin-right: 0;" >
				            
    				             <a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style="width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/Rupa.png" alt="Canvas Logo">
    				           </a>
				           
				            </div>
				           
				       
				           <div id="primary-menu-trigger" style="margin-top:auto; margin-bottom:auto;">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>
				        
				        
				        
				        
				     
				        
				        
				        
				          <!--<div id="logo" style=" margin-right: 0;" >-->
				           <!--<a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/Rupa.png" alt="Canvas Logo">-->
				           <!--</a>-->
				          <!--</div>-->
				           
				        </div>   
				        <div>
				           <nav class="primary-menu d-md-none">

    							<ul class="menu-container">
    								<li class="menu-item">
    									<a class="menu-link" href="#home"><div>Home</div></a>
    									
    								</li>
    								<li class="menu-item">
    									<a class="menu-link" href="#ourallies"><div>Authors</div></a>
    									
    								</li>
                    <li class="menu-item">
                      <a class="menu-link" href="#booklaunch"><div>Pre-Order</div></a>
                      
                    </li>
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="<?php echo $page->child("name=launch")->httpUrl?>"><div>Book Launch</div></a>
    									
    								</li>
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="#testimonal"><div>Testimonals</div></a>
    								
    								</li>
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="#partners"><div>Partners</div></a>
    									
    								</li>
    
    								
    							</ul>

						    </nav><!-- #primary-menu end -->
				        </div>
				        
				        
				    </div>
				    
				   <!--<nav class="primary-menu img-responsive mobile">-->

    			<!--				<ul class="menu-container">-->
    			<!--					<li class="menu-item">-->
    			<!--						<a class="menu-link" href="#home"><div>Home</div></a>-->
    									
    			<!--					</li>-->
    			<!--					<li class="menu-item">-->
    			<!--						<a class="menu-link" href="#ourallies"><div>Authors</div></a>-->
    									
    			<!--					</li>-->
    			<!--					<li class="menu-item mega-menu">-->
    			<!--						<a class="menu-link" href="#booklaunch"><div>Book Launch</div></a>-->
    									
    			<!--					</li>-->
    			<!--					<li class="menu-item mega-menu">-->
    			<!--						<a class="menu-link" href="#testimonal"><div>Testimonal</div></a>-->
    								
    			<!--					</li>-->
    			<!--					<li class="menu-item mega-menu">-->
    			<!--						<a class="menu-link" href="#partners"><div>Partners</div></a>-->
    									
    			<!--					</li>-->
    
    								
    			<!--				</ul>-->

						 <!--   </nav>-->
						    <!-- #primary-menu end -->
				
				</div>
			</div>
			<div class="header-wrap-clone" style="    height: 118px;"></div>
		</header><!-- #header end -->
		
		<section id="content" style="position: relative;z-index: 99;">
            <div class=" img-responsive img-fluid "> 
							<!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_desktop.jpg');">-->
				<!--<img style="" class="img-fluid" src="<?=$urls->httpTemplates?>images/images_canvas/equally_desktop.png">-->
				
		
			<!--image and link added by Hemlata -->
			<!--On date : 09/07/21-->
				
				<a href="https://www.amazon.in/equALLY-Stories-Friends-Queer-World/dp/9390547768/ref=tmm_hrd_swatch_0?_encoding=UTF8&qid=1617199802&sr=8-1" target="_blank">	<img style="" class="img-fluid" src="<?=$urls->httpTemplates?>images/images_canvas/equally_web.jpg" ></a>
				
			</div>
			<div class="img-responsive  mobile" >
				<!--<img style="    padding-top: 1rem;"  class="img-fluid"  src="<?=$urls->httpTemplates?>images/images_canvas/equally_mobile.png">-->
				
					<a href="https://www.amazon.in/equALLY-Stories-Friends-Queer-World/dp/9390547768/ref=tmm_hrd_swatch_0?_encoding=UTF8&qid=1617199802&sr=8-1" target="_blank">	<img style="    padding-top: 1rem;"  class="img-fluid"  src="<?=$urls->httpTemplates?>images/images_canvas/equally_mobile.jpg"> </a>
			
			</div> 
		                    
		                    
		                    	<!--End By Hemlata -->
        </section>
		
			
        <section id="content" style="padding: 0px 0 !important;";>
            <div class="content-wrap py-0">
                
                  <!--Changes Done : Hemlata-->
				    <!--Date : 28-04-2021-->
				    <!--Reason : hide section-->
				    
                <!--<div class="container">-->
                <!--    <div class="d-flex justify-content-center" style="text-align:center">-->
                <!--        <h1 style="font-weight:700; margin-top: 3rem">Online Book Launch Event on 9th April 2021, 1:30pm - 3:00pm IST</h1>-->
                        
                        
                <!--    </div>-->
                <!--    <br/>-->
                <!--    <center><a href="<?php echo $page->child("name=launch")->httpUrl?>" class="button button-desc button-3d button-rounded button-green center">Register Here</a></center>-->
                <!--</div>-->
                
                <!--changes done by : hemlata-->
                
            </div>
    
    
			<div class="content-wrap py-0" >
			    <div class="section border-top-0 m-0 text1_alignment" style="">
					<div class="container clearfix">
					    <div class="row col-mb-50">
							<div>
							
							</div>
                        	<div class="text-md-left hb mb-4 border-bottom-0" >
                            	<p class="p_description text_spacing_sections" ><?=$page->pc_ally_book_textbos_section1;?></p>
                            </div>
						</div>
                    </div>
				</div>
			</div>	
			
        </section>
		<br>
        <br><br><br>
        <section id="ourallies"  style="margin-top: -4rem;">
	   
	        <div class="heading-block mb-4 border-bottom-0" >
							<!--<h1 style="text-transform:uppercase; font-weight:bold !important;" class="font-weight-normal letter note mb-0" align="center">ALLIES</h1>-->
							
				<div class="d-flex justify-content-center" >
					        <h2 style="padding-top: 0rem; padding-bottom: 2rem;  margin: 0 0 0px 0; ">Authors</h2>
				</div>
			</div>
			<div class="content-wrap" style="margin-bottom: 5rem;">
				<div class="container clearfix" style="border: 1px solid rgba(1,1,1,0.1); padding-top: 2rem;padding-bottom: 2rem;">
                    <div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">
							<?php 
	
						      foreach($pages->get("name=authors")->children() as $page_agenda)
                                 {
                        	?>
                        <article class="portfolio-item col-lg-1-5 col-md-4 col-sm-4 col-12 pf-illustrations">
							<div class="grid-inner">
								<div class="portfolio-image" style="margin-bottom:0.2rem;">
									<img src="<?=$page_agenda->pc_ally_book_ourallies_img->first()->url?>" alt="Locked Steel Gate">
					            </div>
                                 <div class="d-flex justify-content-center" style="    padding-top: 0.5rem; padding-bottom: 0.5rem;">
                                        <!--              <a style="    padding-right: 0.5rem;-->
                                        <!--padding-left: 0.5rem;-->
                                        <!--font-size: 1.2rem;" target="_blank" href="#" class="linkedin"><i class="icon-linkedin-in"></i></a>-->
                                        <?php
                                        $name="Aruna Desai";
                                        $name_kanak="Kanak Sahoo";
                                        $name_shaina="Shaina Shingari";
                                        $name_tanisha="Tanisha Vinod";
                                        $name_mishkaa="Mishkkaa Verma";
                                       $name_new=$page_agenda->title;
                                        
                                        if($name== $name_new)
                                        {
                                            ?>
                                                 <a style="    padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$page_agenda->pc_allybook_ourallies_linkedin?>" class="facebook"><i class="icon-facebook"></i></a>
                                            <?php
                                            
                                        }
                                        elseif($name_kanak == $name_new)
                                        {
                                             ?>
                                                 <a style="visibility: hidden; padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$page_agenda->pc_allybook_ourallies_linkedin?>" class="facebook"><i class="icon-facebook"></i></a>
                                            <?php
                                            
                                        }
                                        elseif($name_shaina == $name_new)
                                        {
                                             ?>
                                                 <a style="visibility: hidden; padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$page_agenda->pc_allybook_ourallies_linkedin?>" class="facebook"><i class="icon-facebook"></i></a>
                                            <?php
                                        }
                                        elseif($name_tanisha == $name_new)
                                        {
                                             ?>
                                                 <a style="visibility: hidden; padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$page_agenda->pc_allybook_ourallies_linkedin?>" class="facebook"><i class="icon-facebook"></i></a>
                                            <?php
                                        }
                                         elseif($name_tanisha == $name_new)
                                        {
                                             ?>
                                                 <a style="visibility: hidden; padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$page_agenda->pc_allybook_ourallies_linkedin?>" class="facebook"><i class="icon-facebook"></i></a>
                                            <?php
                                            
                                        } elseif($name_mishkaa == $name_new)
                                        {
                                             ?>
                                                 <a style="visibility: hidden; padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$page_agenda->pc_allybook_ourallies_linkedin?>" class="facebook"><i class="icon-facebook"></i></a>
                                            <?php
                                            
                                        }
                                        else{
                                                
                                            ?>
                                    
                                            <a style="    padding-right: 0.5rem; padding-left: 0.5rem;  font-size: 1rem;" target="_blank" href="<?=$page_agenda->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>
                                            <?php
                                                
                                                
                                            
                                            
                                        }
                                         ?>
            
                
                                     </div>
                        	</div>
								<!--<div class="portfolio-desc">-->
								<!--<a style="margin-left: 61px;" href="#" class="social-icon si-light si-facebook">-->
        <!--                            	<i class="icon-facebook"></i>-->
        <!--                            	<i class="icon-facebook"></i>-->
        <!--                            </a>-->
								
								<!--</div>-->
								
						    <div class="portfolio-desc" style="padding: 1px 5px;" >
								<h4 class="font-weight-normal center letter note mb-0" ><b><?=$page_agenda->title?></b></h4>
								<h5 class="font-weight-normal center letter note mb-0" ><?=$page_agenda->pc_ally_book_img_description?></h5>	
						        <h5 class="font-weight-normal center letter note mb-0" style="margin-top:-1.8rem !important" ><b><?=$page_agenda->pc_ally_book_companyname?></b></h5>
							</div>
							
						</article>
			
						<?php
					}
					?>
						

					</div><!-- #portfolio end -->
						
				</div>
		    </div>
        </section><!-- #content end -->
		<section id="content" style="padding: 0px 0 !important;">
			<div class="content-wrap py-0">

				<div class="section border-top-0 m-0" style="padding-left: 1rem; padding-right: 1rem;padding: 0px 0 !important;">
					<div class="container clearfix">

						<div class="row col-mb-50">
							<div>
							
							</div>

							<div class="text-md-left hb mb-4 border-bottom-0 text_alignment ">

								<p class="p_description " ><?=$page->pc_ally_book_textbos_section2;?></p>

							</div>
						</div>

					</div>
				</div>
			</div>	
        </section>
        <!-- <section id="booklaunch">
			<div class=" py-0" style="margin-top: 2rem" id="booklaunch">
				<div class="section m-0 border-0 bg-color dark" style="padding: 80px 0;" >
					<div class="container center"> -->

						<!--<div class="heading-block mb-4 border-bottom-0">-->
						<!--	<h1 class="font-weight-normal letter note mb-0" align="center" style="text-transform:uppercase;">Launching In</h1>-->
						<!--</div>-->
						<!-- <div class="container clearfix">
                            	<div class="d-flex justify-content-center" >
					                 <h2 style="text-transform:uppercase; margin: 0 0 0px 0; ">Coming soon on</h2>
					                 
					            </div>
					            <div style="margin-top:1rem">
					                     <img style="height: auto; width: 200px;" src="<?=$urls->httpTemplates?>images/images_canvas/amazonlogo.png">
					                 </div>
						        <div class=" row">
        							<div class=" col-sm-12 col-xs-12 col-md-3">
        							     <div class="contentnew">
        							        <span><img style="height: 150px; width: 150px;" src="<?=$urls->httpTemplates?>images/images_canvas/b11.png"></span>
        							     </div>
        							        <div class="rounded-circle  countdown-circle" style="border: 2px solid #FF9900;  width: 150px; height: 150px;text-align: center; font-size: 4.0rem;" >
        							         	   <span   id="days"></span>
        							         	   <p style="font-size: 1.2rem; line-height: 0.3;font-weight:bold;" >Days</p>
        							        </div> 
        		        
            						</div>
        					    	<div class=" col-sm-12 col-xs-12 col-md-3">
        							        <div class="contentnew">
        							            <span><img style="height: 150px; width: 150px;" src="<?=$urls->httpTemplates?>images/images_canvas/b12.png"></span>
        							        </div>
        							        <div class="rounded-circle  countdown-circle" style="border: 2px solid #FF9900;  width: 150px; height: 150px;text-align: center; font-size: 4.0rem;" >
        							         	   <span   id="hours"></span>
        							         	   <p style="font-size: 1.2rem; line-height: 0.3;font-weight:bold;" >Hours</p>
        							        </div> 
        							      
        							</div>
        					    	<div class=" col-sm-12 col-xs-12 col-md-3">
        							        <div class="contentnew ">
        							            <span><img style="height: 150px; width: 150px;" src="<?=$urls->httpTemplates?>images/images_canvas/b13.png"></span>
        							        </div>
        							       <div class="rounded-circle  countdown-circle" style="border: 2px solid #FF9900;  width: 150px; height: 150px;text-align: center; font-size: 4.0rem;" >
        							         	   <span   id="minutes"></span>
        							         	   <p style="font-size: 1.2rem; line-height: 0.3;font-weight:bold;" >Minutes</p>
        							        </div> 
        					    	</div>
        					    	<div class=" col-sm-12 col-xs-12 col-md-3">
        							        <div class="contentnew">
        							            <span><img style="height: 150px; width: 150px;" src="<?=$urls->httpTemplates?>images/images_canvas/b14.png"></span>
        							        </div>
        							       <div class="rounded-circle  countdown-circle" style="border: 2px solid #FF9900;  width: 150px; height: 150px;text-align: center; font-size: 4.0rem;" >
        							         	   <span   id="seconds"></span>
        							         	   <p style="font-size: 1.2rem; line-height: 0.3; font-weight:bold; " >Seconds</p>
        							        </div> 
        							       
        							       
        					    	</div>
					        	</div>
					        	<div class="text-center" style="margin-top:3rem;">
					        	    <a href="mailto:contact@thepridecircle.com" style="background-color:#FF9900 !important; color: #000"  class="button button-3d button-large button-rounded button-yellow button-light">PRE-ORDER NOW</a>
					        	</div>
					        </div>
				        </div>
		        	</div>
		    </div>
        </section> -->


        <!--
            Code by sameesh 30march2021
            
            
        -->
        <section id="wordcloud"  class="">
            <br><br>
            <div class="heading-block mb-4 border-bottom-0" >
              <!--<h1 style="text-transform:uppercase; font-weight:bold !important;" class="font-weight-normal letter note mb-0" align="center">ALLIES</h1>-->
              
        <div class="d-flex justify-content-center" >
                  <h2 >Ally Pledge</h2>
        </div>
        <div class="d-flex justify-content-center pt-3">
                    <?=$page->text_description?>
                    <br>
            
                    </div>
      </div>
            <div id="chartdiv"></div>
            
             
            <div class="d-flex justify-content-center  pt-5 pb-2">
<style type="text/css">
  #total_pledges{
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
    color: white;
  }
</style>
                    <span id="total_pledges" class="badge badge-primary" ><h4 style="color: white;margin: 0;" id="total_word_count_div">Total Pledges: </h4></span>
                </div>       
            <div class="d-flex justify-content-center">
                
                <?php 
                    if(!isset($_COOKIE['saved']))
                    {
                ?> 
                    <div class="text-center" id="word_cloud_form">
                        <!--<div class="btn-group-toggle">-->
                           
                        <!--    <button type="button" class="btn btn-primary" name="word_cloud_button" id="word_cloud_button_first">1</button>-->
                        <!--    <button type="button" class="btn btn-primary" name="word_cloud_button" id="word_cloud_button_second">2</button>-->
                        <!--    <button type="button" class="btn btn-primary" name="word_cloud_button" id="word_cloud_button_third">3</button>-->
                        <!--    <button type="button" class="btn btn-primary" name="word_cloud_button" id="word_cloud_button_fourth">4</button>-->
                        <!--</div>-->
                        <br>
                        <form id="add_value" method="post">
                            <input type="text" class="form-control" name="word_cloud_pincode" id="word_cloud_pincode" placeholder="Your pin/zip code"  required><br>
                            <div class="form-group">
    
                                <input type="text" class="form-control" name="word_cloud_word" id="word_cloud_word" placeholder="Enter Here"  maxlength="30" required>
                                <small id="emailHelp" class="form-text text-muted">(Max limit 30 characters)</small>
  
                            </div>
                            <input type="submit" class="btn btn-primary" name="add_word_cloud_value" value="Submit">
                        </form>
                    </div>
                <?php 
                }
                else{
                ?>
                    <h3>Thanks for Pledging!</h3>
                <?php
                    }
                ?>
            </div>
            
            <br><br>
        </section>
        <!--
            code by sameesh ends.-->

            <!--Code by Amruta Jagtap-->
        
       
		<div id="media" class="d-flex justify-content-center" style="" >
		        <h2 style="text-transform:uppercase;"><?=$page->social_media_slider_title?></h2>
		</div>
        <div class="container">
            
        
	     	<div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget social_media_slider_carousel" data-pagi="false" data-items-xs="1" data-items-sm="2" data-items-md="3" data-items-lg="4">
                <?php
                    foreach($page->social_media_slider as $socila_media_slider){
                ?>
                
                <!--<img src="<?=$socila_media_slider->general_link;?>" alt="Open Imagination" class="social_media_slider" >-->
			        <div class="portfolio-item social_media_slider">
			            <a target="_blank" href="<?=$socila_media_slider->general_link;?>">
        						<img src="<?=$socila_media_slider->general_image->httpUrl;?>" alt="Open Imagination" class="social_media_slider" >
        					</a>
        				<!--<div class="portfolio-image social_media_slider " style=" border-radius:0px !important;">-->
        				<!--	<a href="portfolio-single.html">-->
        				<!--		<img src="<?=$socila_media_slider->ally_banner_image->httpUrl;?>" alt="Open Imagination" class="social_media_slider" >-->
        				<!--	</a>-->
        				<!--	<div class="bg-overlay">-->
        				<!--		<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">-->
        				<!--			<a href="<?=$urls->httpTemplates?>images/portfolio/full/1.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>-->
        				<!--			<a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>-->
        				<!--		</div>-->
        				<!--		<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>-->
        				<!--	</div>-->
        				<!--</div>-->
        				<div class="portfolio-desc">
        				    <?=$socila_media_slider->general_text;?>
        					<!--<h3><a href="portfolio-single.html">Open Imagination</a></h3>-->
        					<!--<span><a href="#">Media</a>, <a href="#">Icons</a></span>-->
        				</div>
        			</div>
			    <?php
                    }
                ?>

					</div>
        <!--End Code by Amruta Jagtap-->




        <section id="testimonals" style="    margin-top: 2rem; padding: 0px 0;">
			<div class="content-wrap" id="testimonal">
				<div class="container clearfix">
    					<div class="d-flex justify-content-center" style="" >
    					        <h2 style="text-transform:uppercase;">Testimonials</h2>
    					</div>
                         <div id="oc-testi" class="owl-carousel testimonials-carousel carousel-widget" data-margin="20" data-items-sm="1" data-items-md="2" data-items-xl="2">
                        <div class="oc-item">
							<div class="testimonial">
								<!--<div class="testi-image">-->
								<!--	<a href="#"><img src="images/testimonials/1.jpg" alt="Customer Testimonails"></a>-->
								<!--</div>-->
								<div class="testi-content">
									<p class="card_height">In my experience of working with different companies, I have made an important observation - it is only when one brings their authentic self to work that they truly experience personal and professional growth. Organizations should proactively foster a culture of inclusion and belonging by supporting people in their personal journeys. This is especially important to the GenZ LGBTQ+ Community, who are beginning their career and want to join companies that champion a progressive and equitable culture. A place where 'we' and 'us' prevail over 'I' and 'me'.</p>
									<div class="testi-meta">
										Saptorsi Hore
									</div>
									Head of Operations<br><strong>ThoughtWorks India</strong>
								</div>
							</div>
						</div>

						<div class="oc-item">
							<div class="testimonial">
								<!--<div class="testi-image">-->
								<!--	<a href="#"><img src="images/testimonials/2.jpg" alt="Customer Testimonails"></a>-->
								<!--</div>-->
								<div class="testi-content">
									<p class="card_height">We cannot afford to be dormant allies now. We need to break the taboo surrounding the LGBTQ+ community and encourage discussions. There will be questions, there will be doubts but we have to be patient and take them through this awakening process. I am consciously trying to bring in a change. Though I have not yet succeeded in doing so completely, the small steps I take every day matter the most.</p>
									<div class="testi-meta">
										Sudhir Shenoy
									</div>
									CEO and Country President<br><strong>Dow Chemical International Pvt. Ltd.</strong>
								</div>
							</div>
						</div>
                	</div>

				</div>
			</div>
        </section><!-- #content end -->
		<style>
    	    .video-container .fluid-width-video-wrapper
    	    {
                position: relative !important;
    	    }
	   </style>
		<div class="container video-container" style="padding-top:5rem;" >
            <div class="row">
        	    <div class="col-md-6 p-4">
        	     <iframe src="https://www.youtube.com/embed/G2B-IhAZRnM" height="400" frameborder="0"></iframe>
            	</div>
            	
            	<div class="col-md-6 p-4">
            	      <iframe src="https://www.youtube.com/embed/1GnPFfGU-1k" height="400" frameborder="0"></iframe>
            	</div>
        	</div>
        </div>
        	
     <!--   <section id="content">-->
     <!--       <div class="container">-->
     <!--           <div class="d-flex justify-content-around" >-->
		   <!-- 	    <div class="" >-->
     <!--                   <div style="margin-right:1rem !important;" class="vedio_spacing vedio_height vedio_height_new">-->
					<!--		    <iframe src="https://www.youtube.com/embed/G2B-IhAZRnM" height="400" frameborder="0"></iframe>-->
					<!--    </div>-->
					<!--</div>-->
                                 <!--<div class="col-md-1" style="padding-top: 3rem;"></div>-->  
     <!--               <div class="">-->
     <!--                       <div style=" margin-right:1rem !important;" class="vedio_spacing vedio_height vedio_height_new">-->
					<!--		    <iframe src="https://www.youtube.com/embed/1GnPFfGU-1k" width="677" height="400" frameborder="0"></iframe>-->
					<!--        </div>-->
			  <!--      </div>-->
                  
		   <!--     </div>-->
     <!--       </div>		-->
     <!--   </section>	-->
		<section id="partners" style="margin-bottom: -1rem !important;">
			<div class="content-wrap">
                <div class="container clearfix">
                    <div class="d-flex justify-content-center" >
					        <h2 style="text-transform:uppercase; padding-top: 7rem; padding-bottom: 2rem;  margin: 0 0 0px 0; ">Industry Partner</h2>
					</div>
                    <div class="container">
                        <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px; height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/ficci.png" alt="Clients">
						</ul>
				    </div>
			    </div>
                <div class="container clearfix">
                    <div class="d-flex justify-content-center" >
					        <h2 style="text-align: center; text-transform:uppercase; padding-top: 3rem; padding-bottom: 2rem;  margin: 0 0 0px 0; ">Supporting Organizations</h2>
					</div>
                    <div class="container">
				          
					<!--<div class="d-flex justify-content-center"> -->
     <!--                   <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div>-->
     <!--               </div>-->
                	<div class="d-flex justify-content-center "> 
				         <ul class="d-md-flex justify-content-center text-center">
				              <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/amazing_workplace.png" alt="Clients">
                       <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/fii.jpg" alt="Clients">
				              <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/gaylaxay.png" alt="Clients">
                       <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/gender.jpg" alt="Clients">
				               <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/gm.png" alt="Clients">
				       	    
							  
							   
							
							
							
							
							</ul>
							
				</div>
					<div class="d-flex justify-content-center "> 
				         <ul class="d-md-flex justify-content-center text-center">
                  <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/homegrown.png" alt="Clients">
                  <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/qsa.jpg" alt="Clients">
				                <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/linkedinloca.png" alt="Clients">
							    <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/yka.jpg" alt="Clients">
							    
							 
							</ul>
							
				</div>
					
				
				</div>
					

				</div>

			
			</div>
		</section>
		<section id="content">
            <div class="icon-bar">
               <a  href="#footer" class="google"><i class="icon-line-mail"></i></a> 
                <a  target="_blank" href="https://instagram.com/pride.allies" class="instagram"><i class="  icon-line-instagram"></i></a> 
                <a target="_blank" href="http://www.facebook.com/pride.allies" class="facebook"><i class="icon-facebook-f"></i></a> 
                <a target="_blank" href="https://twitter.com/pride_circle" class="twitter"><i class="icon-line-twitter"></i></a> 
                 <a target="_blank" href="https://www.linkedin.com/company/pride-circle/" class="linkedin"><i class="icon-linkedin-in"></i></a>
                 <a  target="_blank" href="https://www.youtube.com/channel/UCoaAZWnpjFXcCQ5Und9mi0Q" class="youtube"><i class="icon-line2-social-youtube"></i></a> 
            </div>
        </section>
		

    

</div>


 <footer id="footer" class="dark" style="     margin-top: 0px;"  >

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30">

						<div class="col-md-6 text-center text-md-left">
						Copyrights &copy; <?php echo date("Y")?>  All Rights Reserved by Pride Circle<br>
							<!--<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>-->
							
							
							
						</div>

						<div class="col-md-6 text-center text-md-right">
							<div class="d-flex justify-content-center justify-content-md-end">
								<!--<a target="_blank" href="https://www.facebook.com/LetUsAllRise/" class="social-icon si-small si-borderless si-facebook">-->
								<!--	<i class="icon-facebook"></i>-->
								<!--	<i class="icon-facebook"></i>-->
								<!--</a>-->
								<!--	<a target="_blank" href="https://www.instagram.com/rise4all/" class="social-icon si-small si-borderless si-instagram">-->
								<!--	<i class="icon-instagram"></i>-->
								<!--	<i class="icon-instagram"></i>-->
								<!--</a>-->

								<!--<a target="_blank" href="#" class="social-icon si-small si-borderless si-twitter">-->
								<!--	<i class="icon-twitter"></i>-->
								<!--	<i class="icon-twitter"></i>-->
								<!--</a>-->

								<!--<a href="#" class="social-icon si-small si-borderless si-gplus">-->
								<!--	<i class="icon-gplus"></i>-->
								<!--	<i class="icon-gplus"></i>-->
								<!--</a>-->

								<!--<a href="#" class="social-icon si-small si-borderless si-pinterest">-->
								<!--	<i class="icon-pinterest"></i>-->
								<!--	<i class="icon-pinterest"></i>-->
								<!--</a>-->

								<!--<a href="#" class="social-icon si-small si-borderless si-vimeo">-->
								<!--	<i class="icon-vimeo"></i>-->
								<!--	<i class="icon-vimeo"></i>-->
								<!--</a>-->

								<!--<a href="#" class="social-icon si-small si-borderless si-github">-->
								<!--	<i class="icon-github"></i>-->
								<!--	<i class="icon-github"></i>-->
								<!--</a>-->

								<!--<a href="#" class="social-icon si-small si-borderless si-yahoo">-->
								<!--	<i class="icon-yahoo"></i>-->
								<!--	<i class="icon-yahoo"></i>-->
								<!--</a>-->

								<!--<a target="_blank" href="#" class="social-icon si-small si-borderless si-linkedin">-->
								<!--	<i class="icon-linkedin"></i>-->
								<!--	<i class="icon-linkedin"></i>-->
								<!--</a>-->
							</div>

							<div class="clear"></div>

							<i class="icon-envelope2"></i><a href="mailto:contact@thepridecircle.com  "> <u> contact@thepridecircle.com  </u></a> <br/>
							<!--<i class="icon-headphones"></i>+91–9739242109|+91–9741116929<span class="middot">&middot;</span>-->
							<!--<i class="icon-skype2"></i> CanvasOnSkype-->
						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->
		<div id="gotoTop" class="icon-angle-up"></div>
	<!-- JavaScripts
	============================================= -->


  <!--
      code by sameesh for wordCloud starts here
    -->
    <script>
  
  $(document).ready(function () {
      <?php
            $jsonobj= $page->equally_json;
            //$obj = json_decode($jsonobj);
            $jsonobj=str_replace("\'","'",$jsonobj);
            $jsonobj=str_replace('\"','"',$jsonobj);
            
        ?>
        let word_cloud_data_json='<?=$jsonobj?>';
        console.log(word_cloud_data_json);
        let word_cloud_data_obj=JSON.parse(word_cloud_data_json);
        //console.log(word_cloud_data_obj);
        
                // word_cloud_button_value=Object.entries(word_cloud_data_obj).sort((a,b) => b[1]-a[1]);
                // $("#word_cloud_button_first").html(Object.values(word_cloud_button_value)[0][0]);
                // $("#word_cloud_button_second").html(Object.values(word_cloud_button_value)[1][0]);
                // $("#word_cloud_button_third").html(Object.values(word_cloud_button_value)[2][0]);
                // $("#word_cloud_button_fourth").html(Object.values(word_cloud_button_value)[3][0]);
        function word_cloud_function(word_cloud_data_obj) {

                let word_to_display = [];
                
                let word_to_exclude=<?=$page->word_to_exclude?>;
                total_word_count=0;
                //word_cloud_data_obj.forEach(function create_array_function(count,word){
                $.each( word_cloud_data_obj, function( word, count ) {
                    if(!word_to_exclude.includes(word)){
                        word_to_display.push({
                            "word": word,
                            "count": count
                        })
                        total_word_count+=count;
                    }
                })
                console.log(word_to_display);
                    //alert(total_word_count);
                am4core.useTheme(am4themes_animated);
    
                am4core.useTheme(am4themes_animated);
                var chart = am4core.create("chartdiv", am4plugins_wordCloud.WordCloud);
                var series = chart.series.push(new am4plugins_wordCloud.WordCloudSeries());
                series.data = word_to_display;
                series.dataFields.word = "word";
                series.dataFields.value = "count";
                series.randomness=0;
                series.rotationThreshold=0;
                series.colors = new am4core.ColorSet();
                series.colors.passOptions = {};
                series.colors.list = [
                  am4core.color("#e40303"),
                  am4core.color("#ff8c00"),
                  am4core.color("#ffed00"),
                  am4core.color("#008026"),
                  am4core.color("#004dff"),
                  am4core.color("#750787")
                ];
                series.colors.reuse = true;
                // var title = chart.titles.create();
                // title.text = "Ally Pledge";
                // title.fontSize = 50;
                // title.fontWeight = "80";
                $("#total_word_count_div").html("Total Pledges: ");
                $("#total_word_count_div").append(total_word_count);
            }
        
        word_cloud_function(word_cloud_data_obj);

      
        $("#add_value").submit(function (event) {
                 event.preventDefault();
                let word=$("#word_cloud_word").val();
                
                word=word.toLowerCase();
                word.replace(/'/g,"\'");
                let word_to_exclude=<?=$page->word_to_exclude?>;
                if(!word_to_exclude.includes(word)){
                    let pincode=$("#word_cloud_pincode").val();
                    if (word_cloud_data_obj.hasOwnProperty(word) ){
                            word_cloud_data_obj[word]++;
                    }
                    else{
                        word_cloud_data_obj[word] = 1;
                    }
                    //console.log(word_cloud_data_obj);
                    word_cloud_function(word_cloud_data_obj);
                    $.ajax({
                          type: "post",
                          url: '<?=$pages->get("name=api-equallity-word-cloud")->httpUrl?>',
                          data: {'word':word.replace(/'/g,"\'"),'pincode':pincode},
                          //datatype:"text",
                          success:function(result){
                              console.log(result);
                                document.cookie = "saved="+word;
                              //alert(pincode);
                          }
                    });
                     
                    $('#word_cloud_form').html("<h3>Thanks for Pledging!</h3>");
                }
                else{
                    alert("Can not add this word.");
                    
                }
            });
            
            //  $('button[name="word_cloud_button"]').click(function (event) {
            //     event.preventDefault();
            //     let word=this.innerHTML;
            //     //console.log(word);
            //     if (word_cloud_data_obj.hasOwnProperty(word) ){
            //             word_cloud_data_obj[word]++;
            //     }
            //     else{
            //         word_cloud_data_obj[word] = 1;
            //     }
            //     //console.log(word_cloud_data_obj);
            //     word_cloud_function(word_cloud_data_obj);
            //     $.ajax({
            //           type: "post",
            //           url: '<?=$page->parent->httpUrl?>api/api-equallity-word-cloud/',
            //           data: {'word':word},
            //           success:function(result){  document.cookie = "saved="+word;
            //           }
            //   });
            //     $('#word_cloud_form').html("<h3>Thanks for Pledging!</h3>");
            //  });
        });
    </script>
        <!--
        
        Code by sameesh for word cloud ends here
        -->





	<script type="text/javascript">
	const second = 1000,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;

let countDown = new Date('April 9, 2021 13:30:00').getTime(),
    x = setInterval(function() {

      let now = new Date().getTime(),
          distance = countDown - now;

      // document.getElementById('days').innerText = Math.floor(distance / (day)),
      //   document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
      //   document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
      //   document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
      
    }, second)
</script>

	
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
<!-- Linkedin code -->
<script type="text/javascript"> _linkedin_partner_id = "3744588"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3744588&fmt=gif" /> </noscript>
	<!-- End Linkedin code -->
</body>
</html>