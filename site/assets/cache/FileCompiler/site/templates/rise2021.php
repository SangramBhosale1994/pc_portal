 <?php

if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
	//Tell the browser to redirect to the HTTPS URL.
	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	//Prevent the rest of the script from executing.
	exit;
}
 ?>
<html>
<head>
    <?php
        	$rootpath = $config->urls->templates;

    ?>
    <title> RISE 2021 | Pride Circle</title>

        <link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />


    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
    <!-- ---------- META TAGS ---------- -->
	<meta property="og:title" content="RISE-2021">
	<meta property="og:image" content='<?php echo $config->urls->templates."/images/Rise_logo1.png"; ?>'>
	<meta property="og:description" content="Reimagining Inclusion for Social Equity">
	<meta property="og:url" content="<?= $page->httpUrl ?>">
	<meta property="og:type" content="article" />

	<meta name="twitter:title" content="RISE-2021">
	<meta name="twitter:description" content="Reimagining Inclusion for Social Equity">
	<meta name="twitter:image" content='<?php echo $config->urls->templates."/images/Rise_logo1.png"; ?>'>
	<meta name="twitter:card" content="RISE-2021">

	<meta property="og:site_name" content="RISE-2021"">
	<meta name="twitter:image:alt" content="RISE-2021"">
	<!-- ---------- META TAGS END ---------- -->
	


	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/style_rise.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/settings.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/layers.css">
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/navigation.css">

  <link rel="icon" href="<?=$urls->httpTemplates?>images/index.png" sizes="32x32" />
  
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
		<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());

				gtag('config', 'G-C3XCR831MS');
		</script> -->

 

	<!-- Document Title
	============================================= -->
 
	<style>
	::selection 
	{
    background: #000033;
   
    }
        body{
            overflow-x: none ;
            font-family: 'Montserrat', sans-serif;
        }
        .accordion-title p{
            margin-bottom:none;
        }
		.revo-slider-emphasis-text {
			font-size: 64px;
			font-weight: 700;
			letter-spacing: -1px;
			font-family: 'Poppins', sans-serif;
			padding: 15px 20px;
			border-top: 2px solid #FFF;
			border-bottom: 2px solid #FFF;
		}

		.revo-slider-desc-text {
			font-size: 20px;
			font-family: 'Lato', sans-serif;
			width: 650px;
			text-align: center;
			line-height: 1.5;
		}

		.revo-slider-caps-text {
			font-size: 16px;
			font-weight: 400;
			letter-spacing: 3px;
			font-family: 'Poppins', sans-serif;
		}

		.tp-video-play-button { display: none !important; }

		.tp-caption { white-space: nowrap; }
		
		#grad2 
		{
          height: 100px;
        background-image: linear-gradient(to bottom, #0a0a67, #19167a, #24228d, #302ea1, #3a3ab5);
        background-image: linear-gradient(to  bottom, #204496, #666db0, #9c9bca, #cecce4, #ffffff);
        /*background-image: linear-gradient(to bottom, #204496, #414498, #594399, #6e4298, #804096);*/
        /*background-image: linear-gradient(to bottom, #0a0a67, #131171, #1a197b, #212086, #272790);*/
}
        #grad3
        {
            height: 100px;
           background-image: linear-gradient(to bottom, #ea2127, #ff5e86, #fb9bce, #f1d2f6, #ffffff);
        }
        #grad4
        {
            height: 100px;
            background-image: linear-gradient(to bottom, #ef6623, #ff7e86, #ffabd0, #f8d9f8, #ffffff);
        }
        #grad5
        {
            height:100px;
            background-image: linear-gradient(to bottom, #fddc0d, #ffc781, #ffceda, #ffeaff, #ffffff);
        }
        .button_align
        {
             margin-top: 1rem;
        }
        
@media (min-width: 992px)
{
.full-header .primary-menu .menu-container {
    margin-right: 0rem;
}

/*@media (min-width: 992px)*/
.full-header #logo {
    padding-right: 0px !important;
  
}


 .img-responsive {
    display: block;
  }
  .img-responsive.mobile {
    display: none;
  }
  .section_style{
          padding-left: 2.5rem;
    padding-right: 2.5rem;
}
.full-header .primary-menu .menu-container {
   
    margin-right: 6.5rem;
  


  }
  .spacing_riseref1
    {
        margin-top: -49px;
        
    }
     .vedio_height_new
     {
        height:20rem;
    }
    
    .header_tabs
    {
        display: flex;
    }
     .button_align
        {
             margin-top: 1rem;
        }

}

.card-header-new {
    padding: 0.4rem 0.25rem;
    margin-bottom: -11px;
}
.menu-link {
    color: #0000333;
}
.menu-item:hover > .menu-link, .menu-item.current > .menu-link
{
    color: #000033;
}
.bs-example{
    	/*margin: 20px;*/
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
.button3 {background-color: #000033;} 

.nav-tabs {
     border-bottom: 0px solid #fff; 
}
.nav {
 
    margin-left: 2.8rem;
        margin-right: 2.8rem;
}
/*.tab-content{*/
/*  position: absolute;*/
/*  width: 450px;*/
/*  height: auto;*/
/*  margin-top: -50px;*/
/*  background: #fff;*/
/*  color: #000;*/
/*  border-radius: 30px;*/
/*  z-index: 1000;*/
/*  box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.4);*/
/*  padding: 30px;*/
/*  margin-bottom: 50px;*/
/*}*/
@media (min-width: 576px)
{
    .modal-dialog {
        max-width: 969px;
        margin: 1.75rem auto;
}
}

@media (min-width: 768px)
{
    .grid-md-6 > .grid-item 
    {
        width: 10.666667%;
    }
    .logo_desktop
    {
        display:hide;
    }
    .rise_button
    {
        padding: 12px 18px;
    }
     .content_height_cards_new
    {
        height:204px;
    }
    .card_height_rise
  {
      height:486px;
  }
  
  

}

.img-responsive.mobile {
  display: none;
}


@media only screen and (min-device-width: 480px) and (max-device-width: 7680px) {
    .button-responsive {
    display: none;
  }
}

@media only screen and (max-device-width: 480px) {
  .img-responsive {
    display: none;
  }
  .img-responsive.mobile {
    display: block;
  }
  .socialfeed
  {
      padding-left:5rem;
      padding-right:5rem;
      margin:auto;
      margin-bottom:3rem;
      
  }
  .containernew
  {
      padding-right: 0px;
     padding-left: 0px; 
     margin-right: 0px; 
     margin-left: 0px;
  }
  .container_style
  {
      margin-top: 1.5rem;
    margin-bottom: 1.5rem;
  }
   .grid-md-6 > .grid-item 
    {
        width: 20.666667%;
    }
    .body
    {
        overflow-x: hidden;
    }
    /*#logo img*/
    /*{*/
    /*    height:auto !important;*/
    /*}*/
    .vedio_spacing
    {
           margin-left:1rem;
           margin-right:2rem;
    }
    .tabs_banner
    {
           margin-top: 2rem;
    }
    .social_media_spacing
    {
        margin-bottom:2rem;
    }
    .spacing_mediacoverage
    {
            margin-top: -127px !important;
    }
     .spacing_riseref
    {
     
        margin-top: -46px;
    }
    .tickets_bannernew
    {
        height:13rem !important;
    }
    .tickets_row
    {
        margin-left:2rem;
    }
    .tickets_column
    {
        padding-bottom:2rem;
    }
    .flex-container 
    {
          flex-wrap: wrap;
          
    }
    .flex-spacing
    {
         margin: 10px;
           padding-bottom:3px;
    }
    .vedio_height
    {
            height: 16rem;
    }
    .content_height_cards
    {
        /*height: 244px !important;*/
    }
    .iframe {
    width: 84%;
    }
     .buttton_height_cards
    {
          height: 68px;
    }
     .card_text_alignmnet
    {
        text-align: center;
    }
    /*.icon-bar*/
    /*{*/
    
    /*top: 9% !important;*/
    /*}*/
    
       .owl-carousel .owl-nav [class*=owl-]
    {
     
        top: 18%;
        
    }
    
  /*Amruta*/
  
  .btn_ticket_conference{
      margin-top:0px;
  }
  .card_conference{
      margin-top:14px !important;
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
@media screen and (max-width : 1920px){
  .div-only-mobile{
  /*visibility:hidden;*/
  display: none;
  }
    
   .social_media
  {
          margin-left: 24px;
  }
   .header_tabs
    {
        display: flex;
    }
    
}
@media screen and (max-width : 906px){
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
   .header_tabs
    {
        display: block;
    }
    .button_alignment 
    {
        margin-top:0.5rem; 
        text-align: center;
    }
     .buttton_height_cards
    {
          height: 68px;
    }
    .card_text_alignmnet {
    text-align: center;
    }

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
.content-wrap {
   
     padding: 0px 0;
    }
.mfp-container
{
    height:0%;
}


.icon-bar {
  position: fixed;
     top: 60%;
  right:0;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-49%);
}

.icon-bar a {
  display: block;
  text-align: center;
  padding: 11px;
  transition: all 0.3s ease;
  color: white;
  font-size: 15px;
}

.icon-bar a:hover {
  background-color: #000;
}

.facebook {
  background: #3B5998;
  color: white;
}
.gotoTop {
  background: rgba(1,1,1,0.5);
  color: black;
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
    background: #da1ca8;
  color: white;
    
}
.content {
  margin-left: 75px;
  font-size: 30px;
}


div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 180px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc 
{
  padding: 15px;
  text-align: center;
}

.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    color: #fff;
    background-color: #000033;
}

.menu-link {
    color: #000033;
}
a {
    text-decoration: none !important;
    color: #000033;
}
.text_decor
{
        text-align: center;
    margin-top: -3rem !important;
        color: #0e0c0c;
}
.portfolio-item .portfolio-image img {
  
     width: auto; 
    height: 8rem;
}
.cardnew {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 10px solid #000033;
    border-radius: 0.25rem;
}
.portfolio-item .portfolio-image img {
    display: block;
    width: 138px;
    height: 134px;
    border-radius: 50% !important;
    margin: auto;
}  
.topmargin-sm 
{
    margin-top: 3rem !important;
}
.fancy-title {

    margin-bottom: 1rem;
}
.title_new
{
    color:#000033;
}
.btn-outline-primary-new {
    color: #eee;
    background-color: #000033;
    border-color: #000033;
}
.btn-outline-primary-new:hover {
    color: #fff;
    background-color: #000033;
    border-color: #000033;
}
.btn-outline-primary-agenda {
    color: #eee;
    background-color: #000033;
    border-color: #000033;
}
.btn-outline-primary-agenda:hover {
    color: #fff;
    background-color: rgb(234, 33, 39);
    border-color: rgb(234, 33, 39);
}
.btn-outline-primary-speakers {
    color: #eee;
    background-color: #000033;
    border-color: #000033;
}
.btn-outline-primary-speakers:hover {
    color: #fff;
    background-color: rgb(253,200,13);
    border-color: rgb(253,200,13);
}
.btn-outline-primary-sp {
    color: #eee;
    background-color: #000033;
    border-color: #000033;
}
.btn-outline-primary-sp:hover {
    color: #fff;
    background-color: rgb(0, 160, 74);
    border-color: rgb(0, 160, 74);
}

.btn-outline-primary-ep {
    color: #eee;
    background-color: #000033;
    border-color: #000033;
}
.btn-outline-primary-ep:hover {
    color: #fff;
    background-color: rgb(239 , 102 ,35);
    border-color: rgb(239 , 102 ,35);
}
.btn-outline-primary-gallery {
    color: #eee;
    background-color: #000033;
    border-color: #000033;
}
.btn-outline-primary-gallery:hover {
    color: #fff;
    background-color: rgb(128 , 64 ,150);
    border-color: rgb(128 , 64 ,150);
}
.btn-outline-primary-pc {
   color: #eee;
    background-color: #000033;
    border-color: #000033;
}
.btn-outline-primary-pc:hover {
    color: #fff;
    background-color: rgb(32 , 68 ,150);
    border-color: rgb(32 , 68 ,150);
}


.flip-card-front::after {
    background-color: rgba(32, 68, 150, 1) !important;
}
.btn-link, .page-link, .page-link:hover, .page-link:focus {
    color: #000033;
}
.ui-state-active { display:none }

.buttton_height_cards
{
        height: 68px;
}






/*4 th march media query*/

@media only screen and (min-width: 490px) and (max-width: 552px)
{
    
    .header_tabs
    {
        display: block !important;
        margin: auto;
        text-align: center;

    }
    .button_alignment 
    {
        margin-top:0.5rem; 
        text-align: center;
    }
    .buttton_height_cards
    {
            height: 68px;
    }
     .card_text_alignmnet
    {
        text-align: center;
    }
    
/*.icon-bar {*/
    
/*    top: 9%;*/
/*}*/

       .owl-carousel .owl-nav [class*=owl-]
    {
     
        top: 18%;
        
    }
  
    
}

@media only screen and (min-width: 1000px) and (max-width: 1200px){
    .content_height_cards_new {
        height: 16rem;
    }
    
    .cards-button{
        height: 70px;
    }
    .buttton_height_cards
    {
          height: 68px;
    }
}

@media only screen and (min-width: 768px) and (max-width: 1000px){
    .content_height_cards_new {
        height: 7rem;
    }
    
    .cards-button{
        height: 70px;
    }
    
    .tickets_column{
        max-width: 100% !important;
        flex: none;
    }
    .buttton_height_cards
    {
           height: 68px;
    }
    .card_text_alignmnet
    {
    text-align: center;
    }
   
    
    
}
@media only screen and (min-device-width: 300px) and (max-device-width: 353px) {
     .buttton_height_cards
    {
         
          height: 68px;
    }
    .agendatable_alignment
    {
         margin-top:4rem;
    }
    .card_text_alignmnet
    {
        text-align: center;
    }
    /*.icon-bar */
    /*{*/
    
    /*top: 9%;*/
    /*}*/
       .owl-carousel .owl-nav [class*=owl-]
    {
     
        top: 18%;
        
    }
   
}
#gotoTop {
    
    left: 39px;
    right: auto;
}

/*Amruta*/
.card_conference{
      height:25rem;
  }
  .card_job_fair{
      height:25rem;
  }
.btn_ticket_job_fair{
    border-radius: 31px;
    background: white;
    color: #191B21;
    padding: 13px;
    font-size: 14px;
    font-weight: 600;
    border-color:#191B21;
}
.btn_ticket_job_fair:hover{
    background:#191B21;
    color:white;
    border-color:#191B21;
    
}
.btn_ticket_conference{
    border-radius: 31px;
    background: white;
    color: #8A2527;
    padding: 13px;
    font-size: 14px;
    font-weight: 600;
    margin-top:13px;
    border-color:#8A2527;
    
}
/*.btn_ticket_conference:hover{*/
/*    background:#8A2527;*/
/*    color:white;*/
/*    border-color:#8A2527;*/
    
/*}*/
.card_conference{
      margin-top:0px;
  }
  
@media only screen and (min-device-width: 468px) and (max-device-width: 767px) {
      /*Amruta*/
  
  .btn_ticket_conference{
      margin-top:0px;
  }
  .card_conference{
      margin-top:14px !important;
  }

}

@media only screen and (min-device-width: 768px) and (max-device-width: 991px) {
      /*Amruta*/
  
  .card_conference{
      height:28rem;
  }
  .card_job_fair{
      height:28rem;
  }
  .btn_ticket_job_fair{
      margin-top:28px;
  }

}
/*Code by Amruta*/
@media only screen and (min-width: 263px) and (max-width: 351px)
{
  .card_job_fair{
      height:28rem;
  }
}
@media only screen and (min-width: 263px) and (max-width: 278px)
{
  .card_conference {
    height: 27rem;
  }
}
@media only screen and (min-width: 252px) and (max-width: 264px)
{
  .card_job_fair{
      height:31rem;
  }
  .card_conference {
    height: 31rem;
  }
}
/*End code by Amruta*/
</style>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60bb268b4ae6dd0abe7c9686/1f7dgt5jn';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

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
<body class="stretched " style="overflow-x: hidden; margin-right: 0rem;">
	<div id="wrapper" class="clearfix">


<section id="header_rise">
   <div class=" img-responsive " > 
							<!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_desktop.jpg');">-->
							    <img style="" class="img-fluid" src="<?=$urls->httpTemplates?>images/images_canvas/rise_desktop_new.jpg">
							</div>
							<div class="img-responsive  mobile">
								    <!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_mobile.jpg');">-->
								 <img class="img-fluid"  src="<?=$urls->httpTemplates?>images/images_canvas/Mobile-min-new.jpg">
							 </div>
    
</section>

	
<section id="content" style="margin-top:4rem;">
    <div class="container-fluid" >
        <div class="header_tabs justify-content-center flex-container" style="text-align: center;">
            <a class="flex-spacing" target="_blank" href="https://www.thepridecircle.com/" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new  ">PRIDE CIRCLE</button></a>
            <a class="flex-spacing" href="#about_rise" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-agenda ">RISE</button></a>
            <a class="flex-spacing"  href="#agenda_table" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-ep ">AGENDA</button></a>
             <a class="flex-spacing"  href="#speakers" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-speakers button_alignment">SPEAKERS</button></a>
             <a class="flex-spacing"  href="#sponsors" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-sp button_alignment">SPONSORS</button></a>
             <a class="flex-spacing"  href="#tickets" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-pc  button_alignment">EVENT&nbspPASSES</button></a>
             
               
                <a class="flex-spacing"  href="#sponsors_contact" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-gallery button_alignment">CONTACT</button></a>
                
                <!--Code Added by : Hemlata-->
                <!--Date : 16-04-2021-->
                <!--Reason : Added header tab FAQ-->
                
               <a class="flex-spacing"  href="#rise2021faq" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-sp button_alignment">FAQ</button></a>
                
                 <!--End By : Hemlata-->
                

                  <!--<a class="flex-spacing"  href="#media_coverage" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-pc button_alignment">PRESS&nbspCOVERAGE</button></a>-->
            <!--<a href=""><button class="buttonnew button3">RISE</button></a>-->
        </div>
    </div>
</section>
<section id="content">
			<div class="content-wrap" id="about_rise">
				<div class="container">

					<div class="row align-items-center col-mb-50">
						<!--<div class="col-md-5">-->
						<!--	<canvas id="chart-doughnut"></canvas>-->
						<!--</div>-->
                            <?php
                                // foreach($page->children() as $allybook_rise){
                                   //echo $rise_microsite->title;
                                //}
                            ?>

						<div class="col-md-12 text-center text-md-left">
							<!-- <div style="padding-top:2rem;     margin-bottom: -1rem !important;" class="heading-block border-bottom-0">
								<h4 style="color: #000033;"><center>Rise 2021</center></h4>
							</div> -->

							<!--<div class="fancy-title title-center title-border topmargin-sm">-->
							<!--	<h3 class="title_new">RISE 2021</h3>-->
							<!--</div>-->
                           <div>
                               	<p><?=$page->pc_rise_microsite_about_rise;?></p>
                           </div>
						
							 <br>
                                <div class="text-center" >
							<!--<a href="#" class="btn btn-outline-secondary">Learn more &rarr;</a>-->
								 <a target="_blank" href="https://www.thepridecircle.com/rise-bangalore/" style="margin:auto; text-align:center;"><button type="button" class="btn btn-outline-primary-new">RISE&nbspBangalore</button></a>
								     <a target="_blank" href="https://www.thepridecircle.com/rise-delhi/" style=""><button type="button" class="btn btn-outline-primary-new">RISE&nbspDelhi</button></a>
								 
								 	<!--<p><?=$page->pc_rise_microsite_about_rise_two;?></p>-->
								
                    	
                
                    	        </div>
						</div>
					
					</div>
				</div>

				
			</div>
		</section><!-- #content end -->
	<!---All---->
<section id="content" class="container_style" style="margin-top:4rem; margin-bottom: -3rem; ">
 <div class="container">
      <div class="row">
  <div class="col-md-4 tickets_column">
    <div class="card card_height_rise" style="">
      <div class="card-body">
       <h2 class="title_new card-title card_text_alignmnet text-center " style="margin: 0px 0 -8px 0;">Conference </h2>
        <p class="card-text">
            <div class="content_height_cards_new content_height_cards">
            <?=$page->pc_rise_microsite_conference;?> 
            </div>
            <div>
            <center><a class="flex-spacing" href="#agenda_table" style="margin-right:17px;"><button type="button" style=" margin-top: 10px;" class="btn btn-outline-primary-new  "> Agenda</button></a></center>
            
            </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 tickets_column">
    <div class="card tickets_column card_height_rise" style="">
      <div class="card-body">
        <h2 class="title_new card-title card_text_alignmnet text-center" style="margin: 0px 0 -8px 0;">Job Fair </h2>
        <p class="card-text">
                <div class="content_height_cards_new content_height_cards">
					<?=$page->pc_rise_microsite_job_fair;?>
					
				</div>

		                <div class="text-center">
		                    
		                     <a target="_blank" class="flex-spacing" href="https://www.thepridecircle.com/resume/" style="margin-right:17px;"><button type="button" style=" margin-top: 10px;" class="btn btn-outline-primary-new  text-center button_align"> Upload&nbspResume</button></a>
		                       <a target="_blank" class="flex-spacing" href="https://www.thepridecircle.com/jobs/" style="margin-right:17px;"><button style="    margin-top: 10px;" type="button" class="btn btn-outline-primary-new text-center  ">Explore jobs</button></a>
		                     </div>
                    	<!--<a target="_blank" href="https://www.thepridecircle.com/resume/"><button  class="buttonnew button3  ">Upload your Resume</button> </a>-->
                    	<!--<a target="_blank" href="https://www.thepridecircle.com/jobs/"><button class="buttonnew button3  ">Explore jobs</button></a>-->
                     <!--   </div>  -->
                     <!--   <div class=" button-responsive mobile d-md-none" style="display: inline-flex;">-->
                    	<!--<a target="_blank" href="https://www.thepridecircle.com/resume/"><button  class="buttonnew button3 img-responisve buttton_height_cards">Upload your Resume</button> </a>-->
                    	<!--<a target="_blank" href="https://www.thepridecircle.com/jobs/"><button  class="buttonnew button3 img-responisve buttton_height_cards">Explore jobs</button></a>-->
                     <!--   </div>  -->
        </p>    
      </div>
    </div>
  </div>
   <div class="col-md-4 tickets_column">
    <div class="card card_height_rise" style="">
      <div class="card-body">
       <h2 class="title_new card-title card_text_alignmnet text-center" style="margin: 0px 0 -8px 0;">Marketplace </h2>
        <p class="card-text">
           <div class="content_height_cards_new content_height_cards">
					    	<?=$page->pc_rise_microsite_marketplace;?>
					</div>
					<div>
            <center><a  class="flex-spacing" href="" style="margin-right:17px;"><button style=" margin-top: 10px;"  type="button" class="btn btn-outline-primary-new  " id="btn_coming_soon">Coming Soon</button></a></center>
            
           
            </div>
        </p>    
      </div>
    </div>
  </div>
</div>
 </div>
	
    
</section>


<!---Alll---->
 <section id="content" style="margin-top:4rem;" >
   
    <div class="content-wrap" style="margin-bottom: -2rem !important;" id="agenda_table">
        <div class="text-center title-center title-border topmargin-sm" style="margin-bottom: 3rem; background-color:rgb(239 , 102 ,35);    height: 4rem;     padding-top: 0.9rem;">
						<h3 class="title_new" style="color:#fff;">AGENDA</h3>
					</div>
        <div class="container clearfix">
    <div class="bs-example">
   
         <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#schedule1" role="tab" aria-controls="pills-home" aria-selected="true">Day 1</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#schedule2" role="tab" aria-controls="pills-profile" aria-selected="false">Day 2</a>
              </li>
 
        </ul>
    
    <div class="tab-content">
         <div class="tab-pane fade active show" id="schedule1">
       
			<div class="content-wrap" style="padding: 0px 0 !important;">
				<div class="containernew container clearfix">
                      <div class="row agenda_section " style="margin-right: 0px !important; margin-left: 0px !important; ">
                             <div class="col-md-12 grid-margin-md stretch-card d-flex_" style="margin-bottom: 1rem !important;">
                                <div class="cardnew active">
                                      <!--<div class="card-body" style=" margin: auto; width: 100%;">-->
                                        <!-- <div class="d-flex justify-content-between mb-3"> -->
                                     <h1 class="card-title center font-weight-normal  letter note mb-0" style="align-items: center;     margin-top: 1.5rem;">4<sup>th</sup> May 2021</h1>
          
    <div class="container">
            <h3 style="    margin-top: 14px; margin-bottom: 9px !important;"> <center>Session I (1.00pm to 5.30pm IST)</center></h3>
  
     
  <div id="accordion" style="padding-bottom:2rem;">
      	<?php 
               foreach($pages->get("name=day-one")->children('start=0,limit=9') as $page_agenda)
                  {
                        
        ?>
     
      
  <div class="card">
    <div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">
      <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center;" >
     
        <span class="accordion-title text-center center " data-toggle="collapse" data-target="#collapseOnecollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff">
           <?=$page_agenda->title;?>
        
        </span>
      </h5>
    </div>
    <!--<div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">-->
    <!--  <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center;" >-->
     
    <!--    <span class="accordion-title text-center center " data-toggle="collapse" data-target="#collapseOnecollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff">-->
    <!--       <?=$page_agenda->title;?>-->
        
    <!--    </span>-->
    <!--  </h5>-->
    <!--</div>-->

    <div id="" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body text-center " >
       <?=$page_agenda->pc_allybook_agendatable_time?>
      </div>
    </div>
    <!--<div id="collapseOnecollapse<?=$page_agenda->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">-->
    <!--  <div class="card-body text-center " >-->
    <!--   <?=$page_agenda->pc_allybook_agendatable_time?>-->
    <!--  </div>-->
    <!--</div>-->
    
  </div>
  
  
  <?php  
                    
                      
                  } 
                  
                ?>
  
  
  
<!--</div>-->
    
    <h3 style="    margin-top: 20px; margin-bottom: 9px !important;"><center>Session II (8:00pm to 10:00pm IST)</center></h3>
    
                     <!--<h3><center>Session-I</center></h3>-->
  
     
  <!--<div id="accordion">-->
      	<?php 
               foreach($pages->get("name=day-one")->children('start=9,limit=5') as $page_agenda)
                  {
                        
        ?>
     
      
  <div class="card">
    <div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">
      <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center; "  >
     
        <span class="accordion-title text-center center " data-toggle="" data-target="#collapseTwocollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff; ">
         <?=$page_agenda->title;?>
           
        
        </span>
      </h5>
    </div>

    <!--<div id="" class="" aria-labelledby="headingOne" data-parent="#accordion">-->
    <!--  <div class="card-body text-center " >-->
    <!--   <?=$page_agenda->pc_allybook_agendatable_time?>-->
    <!--  </div>-->
    <!--</div>-->
    <!--<div id="collapseTwocollapse<?=$page_agenda->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">-->
    <!--  <div class="card-body text-center " >-->
    <!--   <?=$page_agenda->pc_allybook_agendatable_time?>-->
    <!--  </div>-->
    <!--</div>-->
    
  </div>
  
  
  <?php  
                    
                      
                  } 
                  
                ?>
  
  
  
</div>
        </div>
           
    </div>
  </div>  
					
				</div>
			</div>
            
        </div>
        </div>
         <div class="tab-pane fade" id="schedule2">
       
			<div class="content-wrap" style="padding: 0px 0 !important;">
				<div class="containernew container clearfix">
                      <div class="row agenda_section " style="margin-right: 0px !important; margin-left: 0px !important; ">
                             <div class="col-md-12 grid-margin-md stretch-card d-flex_" style="margin-bottom: 5rem !important;">
                                <div class="cardnew active">
                                     <h1 class="card-title center font-weight-normal  letter note mb-0" style="align-items: center;     margin-top: 1.5rem;">5<sup>th</sup> May 2021</h1>
                                    
                                                
    <div class="container">
            <h3 style="    margin-top: 14px; margin-bottom: 9px !important;"> <center>Session I (1.00pm to 5.30pm IST)</center></h3>
  
     
  <div id="accordion" style="padding-bottom:2rem;">
      	<?php 
               foreach($pages->get("name=day-two")->children('start=0,limit=9') as $page_agenda)
                  {
                        
        ?>
     
      
  <div class="card">
    <div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">
      <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center;" >
     
        <span class="accordion-title text-center center " data-toggle="" data-target="#collapseOnecollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff">
           <?=$page_agenda->title;?>
        
        </span>
      </h5>
    </div>

    <!--<div id="" class="" aria-labelledby="headingOne" data-parent="#accordion">-->
    <!--  <div class="card-body text-center " >-->
    <!--   <?=$page_agenda->pc_allybook_agendatable_time?>-->
    <!--  </div>-->
    <!--</div>-->
    <!-- <div id="collapseOnecollapse<?=$page_agenda->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">-->
    <!--  <div class="card-body text-center " >-->
    <!--   <?=$page_agenda->pc_allybook_agendatable_time?>-->
    <!--  </div>-->
    <!--</div>-->
    
  </div>
  
  
  <?php  
                    
                      
                  } 
                  
                ?>
  
  
  
<!--</div>-->
    
    <h3 style="    margin-top: 20px; margin-bottom: 9px !important;"><center>Session II (8:00pm to 10:00pm IST)</center></h3>
    
                     <!--<h3><center>Session-I</center></h3>-->
  
     
  <!--<div id="accordion">-->
      	<?php 
               foreach($pages->get("name=day-two")->children('start=9,limit=5') as $page_agenda)
                  {
                        
        ?>
     
      
  <div class="card">
    <div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">
      <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center; "  >
     
        <span class="accordion-title text-center center " data-toggle="collapse" data-target="#collapseTwocollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff; ">
         <?=$page_agenda->title;?>
           
        
        </span>
      </h5>
    </div>

    <!--<div id="collapseTwocollapse<?=$page_agenda->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">-->
    <!--  <div class="card-body text-center " >-->
    <!--   <?=$page_agenda->pc_allybook_agendatable_time?>-->
    <!--  </div>-->
    <!--</div>-->
    <!-- <div id="" class="" aria-labelledby="headingOne" data-parent="#accordion">-->
    <!--  <div class="card-body text-center " >-->
    <!--   <?=$page_agenda->pc_allybook_agendatable_time?>-->
    <!--  </div>-->
    <!--</div>-->
  </div>
  
  
  <?php  
                    
                      
                  } 
                  
                ?>
  
  
  
</div>
        </div>


          <!--</div>-->
        </div>
    </div>
  </div>  
					
				</div>
			</div>
            
        </div>
        
    
    </div>
    </div>
</div>
<div class="container">
    <div class="d-flex justify-content-center" style="margin-bottom:3rem;">
    
<!--<a href="<?=$page->rise_microsite_download_link->httpUrl;?>" target="_blank">-->
<!--    <button type="button" class="btn btn-outline-primary-new">Download Agenda</button>-->
<!--</a>-->
        <!--<h4 class="text-center"><i>Detailed agenda with timings and speaker details will be published soon.</i> </h4>-->
        <a href="<?=$page->rise_microsite_download_link->httpUrl?>" class="[ text-center ][ btn btn-outline-primary-new ]">Download the detailed Agenda </a>
    



</div>
</div>


</section>

<!--<section id="content" style="margin-top:4rem;" >-->
<!--     <div class="text-center title-center title-border topmargin-sm" id="tickets" style="margin-bottom: 3rem; background-color:#000033;     height: 5rem;  padding-top: 1.5rem;">-->
<!--						<h3 class="title_new" style="color:#fff;">EVENT&nbspPASSES</h3>-->
<!--					</div>-->
					
<!--<div id="grad3" style="text-align:center;" class="  tabs_banner d-flex justify-content-between ">-->
    <!--<img style="width:100%; height:auto;" class="img-fluid" src="<?=$urls->httpTemplates?>images/images_canvas/color.jpg">-->
    
<!-- <p style="margin:auto; font-weight:bolder; font-size:1.5rem; color: #000033;" class="text-center">Coming Soon</p>-->

    
<!--</div>			-->
    <!-- <div class="content-wrap" id="rise" style="margin-top:4rem;">-->
    <!--    <div class="container clearfix">-->
    
    <!--<div class="row tickets_row">-->
    <!--    <div class="col-md-3 tickets_column" style="-->
    <!--padding-bottom: 2rem;">-->
    <!--         <div class="card" style="width: 18rem;">-->
    <!--              <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
    <!--                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                   
    <!--              </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--     <div class="col-md-1"></div>-->
    <!--    <div class="col-md-3 tickets_column" style="-->
    <!--padding-bottom: 2rem;">-->
    <!--        <div class="card" style="width: 18rem;">-->
    <!--              <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
    <!--                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                    
    <!--              </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--     <div class="col-md-1"></div>-->
    <!--     <div class="col-md-3 tickets_column" style="-->
    <!--padding-bottom: 2rem;">-->
    <!--        <div class="card" style="width: 18rem;">-->
    <!--              <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
    <!--                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                   
    <!--              </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--     <div class="col-md-1"></div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
<!--</section>-->



<section id="content" style="margin-top:4rem;">
	    <div class="text-center title-center title-border topmargin-sm" id="speakers" style="margin-bottom: 3rem;background-color:rgb(253 , 220 ,13);    height: 4rem; padding-top: 0.9rem;">
						<h3 class="title_new">SPEAKERS</h3>
					</div>
					
			<section id="content">
			<div class="content-wrap" style="margin-bottom: 5rem;">

        <div class="container clearfix" style="margin-top:2rem; margin-bottom:2rem;">
            <h3 class="text-center">HOSTS</h3>

          <div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

              <?php 
              $limit=3;
                foreach($pages->get("name=hosts")->children("")  as $rise_speaker)
                {
              //      //echo $rise_speaker->title;
              
              //$pages->get("name=Speakers")->children() as $page_agenda
              
              
            ?>

            <article class="portfolio-item col-lg-1-4 col-md-3 col-sm-4 col-12 pf-illustrations">
              <div class="grid-inner">
                <div class="portfolio-image" style="margin-bottom:0.2rem;">
                  
                    <img src="<?=$rise_speaker->pc_ally_book_ourallies_img->first()->url?>" alt="Locked Steel Gate">
                
                  
                </div>
                
                  <!--Reason: code added for placed icon-->
          <!--                        Code by : Hemlata-->
          <!--                        Date : 06-04-2021-->
 
       
       <!--Code End by : Hemlata-->
       
            <div class="d-flex justify-content-center" style="    padding-top: 0.5rem;
    padding-bottom: 0.5rem;">
                  <a style="    padding-right: 0.5rem;
    padding-left: 0.5rem;
    font-size: 1.2rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>
            </div>

              
                </div>
                <!--<div class="portfolio-desc">-->
                <!--<a style="margin-left: 61px;" href="#" class="social-icon si-light si-facebook">-->
        <!--                              <i class="icon-facebook"></i>-->
        <!--                              <i class="icon-facebook"></i>-->
        <!--                            </a>-->
                
                <!--</div>-->
                
                <div class="portfolio-desc" style="padding: 1px 5px;" >
                  <h4 class="font-weight-normal center letter note mb-0" ><b><?=$rise_speaker->title?></b></h4>
                    <h5 class="font-weight-normal center letter note mb-0" ><?=$rise_speaker->pc_ally_book_img_description?></h5> 
            
                    <h5 class="font-weight-normal center letter note mb-0" style="margin-top:-1.5rem !important;" ><b><?=$rise_speaker->pc_ally_book_companyname?></b></h5>
                  
                     
              </div>
              
            </article>
          

            <?php
          }
          ?>
            

          </div><!-- #portfolio end -->
          
          
            
            </div>




				<div class="container clearfix" style="margin-top:2rem; margin-bottom:2rem;">
				    <h3 class="text-center">INTERNATIONAL SPEAKERS</h3>

					<div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

							<?php 
							$limit=3;
						    foreach($pages->get("name=keynote-speakers")->children("limit=20")  as $rise_speaker)
						    {
						  //      //echo $rise_speaker->title;
						  
						  //$pages->get("name=Speakers")->children() as $page_agenda
						  
						  
						?>

						<article class="portfolio-item col-lg-1-5 col-md-4 col-sm-4 col-12 pf-illustrations">
							<div class="grid-inner">
								<div class="portfolio-image" style="margin-bottom:0.2rem;">
									
										<img src="<?=$rise_speaker->pc_ally_book_ourallies_img->first()->url?>" alt="Locked Steel Gate">
								
									
								</div>
								
								  <!--Reason: code added for placed icon-->
          <!--                        Code by : Hemlata-->
          <!--                        Date : 07-04-2021-->
      <div class="d-flex justify-content-center" style="    padding-top: 0.5rem;
    padding-bottom: 0.5rem;">
                
                <?php
                                        $name="aruna-desai";
                                        $name_saurabh="saurabh-kirpal";
                                        $name_Raga="raga-olga-dsilva";
                                        $name_Shaina="shaina-shingari";
                                        $name_Anubhuti="anubhuti-banerjee";
                                        
                                        
                                       $name_new=$rise_speaker->name;
                                        
                                        if($name== $name_new)
                                        {
                                            ?>
                                                 <a style="    padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-facebook"></i></a>
                                            <?php
                                            
                                        }
                                        elseif($name_saurabh == $name_new)
                                        {
                                             ?>
                                                 <a style="padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-line-twitter"></i></a>
                                            <?php
                                            
                                        }
                                        elseif( $name_Raga == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-globe"></i></a>
                                            <?php
                                        }
                                        
                                      
                                        
                                         elseif( $name_Shaina == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-line-twitter"></i></a>
                                            <?php
                                        }
                                        
                                         elseif( $name_Anubhuti == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-globe"></i></a>
                                            <?php
                                        }
                                    //   End code by : Hemlata
                                       
                                        else{
                                                
                                            ?>
                                    
                                            <a style="    padding-right: 0.5rem; padding-left: 0.5rem;  font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>
                                            <?php
                                                
                                                
                                            
                                            
                                        }
                                         ?>
                
                
    <!--              <a style="    padding-right: 0.5rem;-->
    <!--padding-left: 0.5rem;-->
    <!--font-size: 1.2rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>-->
            </div>

       
       <!--Code End by : Hemlata-->
       
    <!--        <div class="d-flex justify-content-center" style="    padding-top: 0.5rem;-->
    <!--padding-bottom: 0.5rem;">-->
    <!--              <a style="    padding-right: 0.5rem;-->
    <!--padding-left: 0.5rem;-->
    <!--font-size: 1.2rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>-->
    <!--        </div>-->

							
								</div>
								<!--<div class="portfolio-desc">-->
								<!--<a style="margin-left: 61px;" href="#" class="social-icon si-light si-facebook">-->
        <!--                            	<i class="icon-facebook"></i>-->
        <!--                            	<i class="icon-facebook"></i>-->
        <!--                            </a>-->
								
								<!--</div>-->
								
								<div class="portfolio-desc" style="padding: 1px 5px;" >
									<h4 class="font-weight-normal center letter note mb-0" ><b><?=$rise_speaker->title?></b></h4>
										<h5 class="font-weight-normal center letter note mb-0" ><?=$rise_speaker->pc_ally_book_img_description?></h5>	
						
										<h5 class="font-weight-normal center letter note mb-0" style="margin-top:-1.5rem !important;" ><b><?=$rise_speaker->pc_ally_book_companyname?></b></h5>
									
										 
							</div>
							
						</article>
					

						<?php
					}
					?>
						

					</div><!-- #portfolio end -->
					
					
						
						</div>
				<div class="container clearfix" style="margin-top: 2rem;">
                         <h3 class="text-center">NATIONAL SPEAKERS</h3>
					<div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

							<?php 
						
						    foreach($pages->get("name=all-speakers")->children("limit=20")  as $rise_speaker)
						    {
						  //      //echo $rise_speaker->title;
						  
						  //$pages->get("name=Speakers")->children() as $page_agenda
						  
						  
						?>

						<article class="portfolio-item col-lg-1-5 col-md-4 col-sm-4 col-12 pf-illustrations">
							<div class="grid-inner">
								<div class="portfolio-image" style="margin-bottom:0.2rem;">
									
										<img src="<?=$rise_speaker->pc_ally_book_ourallies_img->first()->url?>" alt="Locked Steel Gate">
								
									
								</div>

    <!--        <div class="d-flex justify-content-center" style="    padding-top: 0.5rem;-->
    <!--padding-bottom: 0.5rem;">-->
    <!--              <a style="    padding-right: 0.5rem;-->
    <!--padding-left: 0.5rem;-->
    <!--font-size: 1.2rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>-->
    <!--        </div>-->
                                          <div class="d-flex justify-content-center" style="    padding-top: 0.5rem; padding-bottom: 0.5rem;">
                                        <!--              <a style="    padding-right: 0.5rem;-->
                                        <!--padding-left: 0.5rem;-->
                                        <!--font-size: 1.2rem;" target="_blank" href="#" class="linkedin"><i class="icon-linkedin-in"></i></a>-->
                                        <?php
                                       $name="aruna-desai";
                                        $name_saurabh="saurabh-kirpal";
                                        $name_Raga="raga-olga-dsilva";
                                        $name_Shaina="shaina-shingari";
                                        $name_Anubhuti="anubhuti-banerjee";
                                        
                                       $name_new=$rise_speaker->name;
                                        
                                        if($name== $name_new)
                                        {
                                            ?>
                                                 <a style="    padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-facebook"></i></a>
                                            <?php
                                            
                                        }
                                        elseif($name_saurabh == $name_new)
                                        {
                                             ?>
                                                 <a style="padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-line-twitter"></i></a>
                                            <?php
                                            
                                        }
                                        elseif( $name_Raga == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-globe"></i></a>
                                            <?php
                                        }
                                        // Code added By : Hemlata 
                                        // Reason : Added code for icon
                                        // Date : 06-04-2021
                                        
                                          elseif( $name_Shaina == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-line-twitter"></i></a>
                                            <?php
                                        }
                                           elseif( $name_Anubhuti == $name_new)
                                        {
                                             ?>
                                                 <a style=" padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin">
                                                     <i class="icon-globe"></i></a>
                                            <?php
                                        }
                                       
                                    //   End code by Hemlata
                                       
                                        else{
                                                
                                            ?>
                                    
                                            <a style="    padding-right: 0.5rem; padding-left: 0.5rem;  font-size: 1rem;" target="_blank" href="<?=$rise_speaker->pc_allybook_ourallies_linkedin?>" class="linkedin"><i class="icon-linkedin-in"></i></a>
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
									<h4 class="font-weight-normal center letter note mb-0" ><b><?=$rise_speaker->title?></b></h4>
										<h5 class="font-weight-normal center letter note mb-0" ><?=$rise_speaker->pc_ally_book_img_description?></h5>	
						
										<h5 class="font-weight-normal center letter note mb-0" style="margin-top:-2rem !important;" ><b><?=$rise_speaker->pc_ally_book_companyname?></b></h5>
									
										 
							</div>
							
						</article>
					

						<?php
					}
					?>
						

					</div><!-- #portfolio end -->
					
					
						
						</div>
						
						
						
			</div>
</section><!-- #content end -->

<section id="content" style="margin-top:4rem;">


 <div id="" style="text-align:center;" class="tabs_banner d-flex justify-content-between">
    <?php
        $speaker_page=$pages->get("name=speakers");
    ?>   
    <a target="_blank" style="margin:auto;" href="<?=$speaker_page->httpUrl;?>">
 <button  type="button" class="buttonnew button3">View All Speakers
</button>

    </a>
</div>


   
	    </section>
	    

<section id="content"  style="margin-top:4rem;">
     <div class="text-center title-center title-border topmargin-sm" id="sponsors" style="background-color:rgb(0 , 160 ,74); height: 4rem;
    padding-top: 0.9rem;" >
						<h3 class="title_new" style="color:#fff;">SPONSORS&nbspAND&nbspPARTNERS</h3>
					</div>
			<div class="content-wrap" id="sponsors" >
				<div class="container clearfix">

				  <div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">CONFERENCE</h3>
					</div>

				
				<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Title </h3>
        <div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>

				   <ul class="d-md-flex justify-content-center text-center">
				       	<img style="width: 208px; height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/fiservnew.png" alt="Clients">
							
								<img style="width: 208px; height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/8.jpg" alt="Clients">
							<img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/macquare.png" alt="Clients">
								<img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/northern_trust.png" alt="Clients">
							
							</ul>
				</div>
				<div class="container"> 
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Associate</h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/epsilon.png" alt="Clients">
							
							
							</ul>
				</div>
					<div class="container"> 
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Plenary Panel </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/american expressnew.png" alt="Clients">
    <img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/athenahealth.png" alt="Clients">
     <img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/facset1.png" alt="Clients">
							
    <img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/7.jpg" alt="Clients">
							
							
							</ul>
				</div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Breakouts</h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/6.jpg" alt="Clients">
							
							
							</ul>
				</div>
                    	<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Report Launch </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-flex justify-content-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/verisk.png" alt="Clients">
							
							
							</ul>
				</div>
				
				</div>
			<div class="container clearfix">

		
					 <div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">JOB FAIR</h3>
					</div>

				
				<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Inspirer </h3>
                            <div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div>
                            </div>
				            <ul class="d-md-flex justify-content-center text-center">
    							<img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/credit_suisse.png" alt="Clients">
    						     <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/hsbc.png" alt="Clients">
    						     <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/JP Morgan .png" alt="Clients">
    							<img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/northern_trust.png" alt="Clients">
    								<img style="width: 208px;height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/ubernew.png" alt="Clients">
    						
    							</ul>
    							
    							<ul class="d-md-flex justify-content-center text-center">
    						
    							<img style="width: 208px;height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/ubs1.png" alt="Clients">
                                <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/wellfargo1.png" alt="Clients">
                                
                                
						      </ul>
			     </div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Platinum  </h3>
                            <div class="d-flex justify-content-center"> 
                                <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center">
                                    
                                </div>
                            </div>
				            <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/citrix1.png" alt="Clients">
							
							
							</ul>
			    	</div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Diamond</h3>
                        <div class="d-flex justify-content-center"> 
                            <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center">
                                
                            </div>
                        </div>
				        <ul class="d-md-flex justify-content-center text-center">
				            <img style="width: 208px; height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/14.jpg" alt="Clients">
				            <img style="width: 208px; height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/7.jpg" alt="Clients">
				            <img style="width: 208px; height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/londonstck.png" alt="Clients">
				            
								<img style="width: 208px; height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/master card1.png" alt="Clients">
							    <img style="width: 208px; height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/vip.png" alt="Clients">
							
						</ul>
				    </div>
                	<div class="container">
				        <h3 class=" text-center" style="margin: 0 0 0px 0;">Gold </h3>
                        <div class="d-flex justify-content-center">
                             <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center">
                                 
                             </div>
                        </div>
				   <ul class="d-md-flex justify-content-center text-center">
				       <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/american expressnew.png" alt="Clients">
				       <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/bnymellon.png" alt="Clients">
				       <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/commonwealth.png" alt="Clients">
				       <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/fiservnew.png" alt="Clients">
               <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/ford.png" alt="Clients">
               <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/general_elec.png" alt="Clients">
				       </ul>
				        <ul class="d-md-flex justify-content-center text-center">
				    <img style="width: 208px; height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/8.jpg" alt="Clients">
						<img style="width: 208px; height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/invesco1.png" alt="Clients">
						<img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/10.jpg" alt="Clients">
            <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/12.jpg" alt="Clients">
            <img style="width: 208px;height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/novartis.png" alt="Clients">	
						<img style="width: 208px; height: auto;padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/vmware.png" alt="Clients">
					</ul>	
					<!-- <ul class="d-md-flex justify-content-center text-center">	-->
     <!--                    <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/invesco.png" alt="Clients">-->
     <!--                      <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/microsoft.png" alt="Clients">-->
     <!--                    <img style="width: 208px;height: auto;padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/netflix.png" alt="Clients">-->
                         
					
					<!--</ul>	-->
					
							
				</div>
				  	<div class="container">
				        <h3 class=" text-center" style="margin: 0 0 0px 0;">Silver </h3>
                            <div class="d-flex justify-content-center"> 
                                <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center">
                                    
                                </div>
                            </div>
				            <ul class="d-md-flex justify-content-center text-center">
				                <img style="width: 208px;height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/27ai1.png" alt="Clients">
				                <!-- <img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/amazonnew.png" alt="Clients"> -->
				                
				       	        <img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/appliedm.png" alt="Clients">
				       	        
				       	        <img style="width: 208px;height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/5.jpg" alt="Clients">
							         <img style="width: 208px;height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/epsilon.png" alt="Clients">
							        	<img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/factset.png" alt="Clients">
							</ul>
							<ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/general mills1.png" alt="Clients">
                                 
							
							
							
							
							      <img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/nvidia1.png" alt="Clients">
				       	        <img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/standerd chartednew.png" alt="Clients">
				       	        <img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/11.jpg" alt="Clients">
				       	        <!--</ul>-->
				       	        <!-- <ul class="d-md-flex justify-content-center text-center">-->
                                  <img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/verisk.png" alt="Clients">
							
							
								<img style="width: 208px; height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/wills towernew.png" alt="Clients">
							<!--</ul>-->
			    	</div>
				  	<div class="container">
				          <h3 class=" text-center" style="margin: 0 0 0px 0;">Bronze </h3>
                            <div class="d-flex justify-content-center"> 
                                <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center">
                                    
                                </div>
                            </div>
				            <ul class="d-md-flex justify-content-center text-center">
				            	<img style="width: 208px;  height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/c2fo.png" alt="Clients">
				            		<img style="width: 208px;  height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/canada.png" alt="Clients">
							    <img style="width: 208px;  height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/sp.png" alt="Clients">
							    	<img style="width: 208px;  height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/twiter.png" alt="Clients">
							     <img style="width: 208px;  height: auto; padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/13.jpg" alt="Clients">
							
							
							</ul>
				</div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Career Guidance</h3>
						
<div class="d-flex justify-content-center"> 
<div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div>
</div>

				   <ul class="d-md-flex justify-content-center text-center">
				       	<img style="width: 208px;
    height: auto;
    padding: 15px;border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/nutanix.png" alt="Clients">
							
							
							
							</ul>
				</div>
				
				

				
				</div>
					 <div class="container clearfix">

				  <div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">PARTNERS</h3>
					</div>
					</div>
                        		<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Logistics Partner </h3>
					<div class="d-flex justify-content-center"> 
<div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div>
</div>
    	<div class="d-flex justify-content-center "> 
				   <ul class="d-md-flex justify-content-center text-center">
				       	<img style="width: 208px;
    height: auto;
    padding: 15px; border-radius: 15%;" src="<?=$urls->httpTemplates?>images/sponsors_rise/fedex1_new.png" alt="Clients">
							
							
							
							</ul>
				</div>
					
				
				</div> 

				
			</div>
		</section>
<section id="content" class="container_style" style="margin-top:4rem;" >
	    	    	

<div class="container" id="sponsors_contact" >
    <div style="text-align:center; color;#000033; border: 3px solid #000033;
    padding-top: 2rem;    " class="tabs_banner  ">
   


        <h2 style="color:#0000033;  line-height:28px; margin: 0 0 0px 0;"><center style="line-height: 28px;"><b>Don't miss this opportunity to become the RISE 2021 Sponsor</b></center><br/></h2>
        <h3 style="color:#0000033; line-height: 1; margin: 0 0 0px 0; margin-top: 6px;"><center>For all sponsorship enquiries, please reach out to </center><br/></h3>
        <h4 style="color:#0000033; line-height: 0.5; margin: 0 0 0px 0;     margin-bottom: 5rem;"><a href="mailto:contact@thepridecircle.com"><u>contact@thepridecircle.com</u></a></h4>

    
</div>
    
</div>
<!-- <div id="sponsors_contact" style="text-align:center; color;#000033; border: 1px solid rgba(0,0,0,0.5);-->
<!--    padding-top: 2rem;    " class="tabs_banner  ">-->
   


<!--        <h2 style="color:#0000033;  line-height:28px; margin: 0 0 0px 0;"><center style="line-height: 28px;"><b>Don't miss this opportunity to become the RISE 2021 Sponsor</b></center><br/></h2>-->
<!--        <h3 style="color:#0000033; line-height: 1; margin: 0 0 0px 0; margin-top: 6px;"><center>For all sponsorship enquiries, please reach out to </center><br/></h3>-->
<!--        <h4 style="color:#0000033; line-height: 0.5; margin: 0 0 0px 0;     margin-bottom: 5rem;"><a href="mailto:contact@thepridecircle.com"><u>contact@thepridecircle.com</u></a></h4>-->

    
<!--</div>-->

	    	    	    	    
	    	    
<!--    <a href="#" class="button button-full button-dark center text-right bottommargin-lg">-->
<!--					<div class="container clearfix">-->
<!--				<button type="button" class="buttonnew button3" data-toggle="modal" data-target="#exampleModal">-->
<!--     Sponsors and Partners-->
 
<!--</button>-->
<!--					</div>-->
<!--				</a>-->
				
<!-- Modal -->
   
</section>
<section id="content" style="margin-top:4rem;" >
     <div class="text-center title-center title-border topmargin-sm" id="tickets" style="margin-bottom: 3rem; background-color:rgb(32, 68, 150); height: 4rem;
    padding-top: 0.9rem;">
						<h3 class="title_new" style="color:#fff;">EVENT&nbspPASSES</h3>
					</div>
    	<!--Amruta Jagatap Ticketing Events Passse -->			
 <div class="container">
     <div class="row">
                <div class="col-md-6">
                    <div class="container">
                        <div class="card card_job_fair" style="background: #191B21;">
                            <div class="card-body">
                                <div class="card-title">
                                    <h2 class="text-center text-white">Job Fair</h2>
                                    <h3 class="text-center text-white">8<sup>th</sup> May 2021<h3>
                                    <!--<h2>8 May </h2>-->
                                    <h3 class="text-center text-white">10:00 am to 06:00 pm (IST)</h3>
                                    
                                </div>
                                <!--<ul>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--</ul>-->
                                <p class="text-center text-white"> (It is compulsory to upload <br> your  resume to participate)</p>
                                <div class="text-center">
                                    <a target="_blank" href="<?=$pages->get("name=resume")->httpUrl;?>">
                                    <!-- <a href="#"> -->
                                        <button class=" text-center btn_ticket_job_fair" >Upload your Resume</button>
                                        <!-- <button class=" text-center btn_ticket_job_fair" >Coming Soon</button> -->
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container">
                        <div class="card card_conference" style="background:#8A2527;">
                            <div class="card-body">
                                <div class="card-title">
                                    <h2 class="text-center text-white">CONFERENCE</h2>
                                    <h3 class="text-center text-white">4<sup>th</sup> & 5<sup>th</sup> May 2021</h3>
                                    <h3 class="text-center text-white">01:00 pm to 05:30 pm (IST) <br> & <br>08:00 pm to 10:00 pm (IST)</h3>
                                </div>
                                <!--<ul>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--    <li>Lunch & Hi Tea</li>-->
                                <!--</ul>-->
                                <!--<p> NOTE: Only for LGBTI Job Seekers</p>-->
                                <p></p>
                                <div class="text-center">
                                    <!--<a target="_blank" href="<?=$pages->get("name=tickets")->httpUrl;?>">-->
                                      <!--<button class=" text-center btn_ticket_conference" >Book your Passes</button>-->
                                      <button type="button" class="btn text-center btn_ticket_conference disabled"  disabled>Sold Out</button>
                                      
                                    <!--</a>-->
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
 </div>
    

  <!--<div class="[ container ][ mt-4 ]">-->
  <!--  <div class="d-flex justify-content-center" >-->
  <!--      <h4 class="text-center"><i>Limited offer. Avail an additional 10% discount on Group Booking of 5 or more tickets.</i> </h4>-->
  <!--  </div>-->
  <!--</div>  -->
  <!-- Amruta Jagatap End Ticketing Events Passse -->
  
   <!--Code added by : Hemlata-->
                <!--Reason : add FAQ page-->
                <!--Date : 14-04-2021-->
             <div class="text-center title-center title-border topmargin-sm" id="rise2021faq">
						<!--<h3 class="title_new" style="color:#fff;">EVENT&nbspPASSES</h3>-->
					</div>    
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
    					
    <!--End code by : Hemlata For FAQ page-->
                        					
					
<!--<div id="grad3" style="text-align:center;" class="  tabs_banner d-flex justify-content-between ">-->
    <!--<img style="width:100%; height:auto;" class="img-fluid" src="<?=$urls->httpTemplates?>images/images_canvas/color.jpg">-->
    
 <!--<p style="margin:auto; font-weight:bolder; font-size:1.5rem; color: #000033;" class="text-center">Coming Soon</p>-->
   
    
<!--</div>			-->
    <!-- <div class="content-wrap" id="rise" style="margin-top:4rem;">-->
    <!--    <div class="container clearfix">-->
    
    <!--<div class="row tickets_row">-->
    <!--    <div class="col-md-3 tickets_column" style="-->
    <!--padding-bottom: 2rem;">-->
    <!--         <div class="card" style="width: 18rem;">-->
    <!--              <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
    <!--                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                   
    <!--              </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--     <div class="col-md-1"></div>-->
    <!--    <div class="col-md-3 tickets_column" style="-->
    <!--padding-bottom: 2rem;">-->
    <!--        <div class="card" style="width: 18rem;">-->
    <!--              <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
    <!--                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                    
    <!--              </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--     <div class="col-md-1"></div>-->
    <!--     <div class="col-md-3 tickets_column" style="-->
    <!--padding-bottom: 2rem;">-->
    <!--        <div class="card" style="width: 18rem;">-->
    <!--              <div class="card-body">-->
    <!--                <h5 class="card-title">Card title</h5>-->
    <!--                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
    <!--                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                   
    <!--              </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--     <div class="col-md-1"></div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
</section>





  <div class="text-center title-center title-border topmargin-sm" id="gallery" style="margin-bottom: 3rem; background-color:rgb(128 , 64 ,150);    height: 4rem;     padding-top: 0.9rem;" >
						<h3 class="title_new" style="color:#fff;">GALLERY</h3>
					</div>
<section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:4rem;">
   
			<div class="content-wrap py-0">

                        <div class="container">
        <div class="row">
            <div class="col-md-6">
                   <div style="">
							<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="false">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
    <!--<li data-target="#carouselExampleCaptions" data-slide-to="5"></li>-->
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/1.jpg" class="d-block w-100" alt="...">
      <!--<div class="carousel-caption d-none d-md-block">-->
      <!--  <h5>First slide label</h5>-->
      <!--  <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>-->
      <!--</div>-->
    </div>
    <div class="carousel-item">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/2.jpg" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/3.jpg" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/4.jpg" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/5.jpg" class="d-block w-100" alt="...">
      
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                            </div>
                            <div class="text-center" >
								<h3>RISE Bangalore 2019
								<br>
								<a target="_blank" href="https://www.flickr.com/photos/182792580@N02/albums/72157709799174011"><small>View Images</small></a></h3>
								
							</div>
            </div>
            <div class="col-md-6">
                    <div>
                	<div id="carouselExampleCaptionsOne" class="carousel slide" data-ride="carousel" data-interval="false">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptionsOne" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptionsOne" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptionsOne" data-slide-to="2"></li>
    <li data-target="#carouselExampleCaptionsOne" data-slide-to="3"></li>
    <li data-target="#carouselExampleCaptionsOne" data-slide-to="4"></li>
    <!--<li data-target="#carouselExampleCaptionsOne" data-slide-to="5"></li>-->
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/14.jpg" class="d-block w-100" alt="...">
      <!--<div class="carousel-caption d-none d-md-block">-->
      <!--  <h5>First slide label</h5>-->
      <!--  <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>-->
      <!--</div>-->
    </div>
    <div class="carousel-item">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/12.jpg" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/13.jpg" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/11.jpg" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/15.jpg" class="d-block w-100" alt="...">
      
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptionsOne" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptionsOne" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
						</div>
						
					<div class="text-center" >
								<h3>RISE Delhi 2020
								<br>
								<a target="_blank" href="https://www.flickr.com/photos/182792580@N02/albums/72157713339442893"><small>View Images</small></a></h3>
								
							</div>	
			</div>	
            </div>
            
        </div>
                    
                
			
			</div>
	
	
	
		</section><!-- #content end -->
 
<div class="title-center title-border topmargin-sm text-center" style="margin-bottom: 3rem; background-color:rgb(234 , 33 ,39);    height: 4rem;     padding-top: 0.9rem;">
						<h3 class="title_new" style="color:#fff;">RISE REFLECTIONS</h3>
					</div>
<section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:4rem; margin-bottom: 7rem;">
     
			<div class="content-wrap py-0" style="margin-bottom: -2rem !important;">

                       <div class="container">
                           <div class="row">
                               <div class="col-md-6">
                                   	<div style=" margin-right:1rem !important;" class="vedio_spacing vedio_height vedio_height_new">
								<iframe src="https://www.youtube.com/embed/9N8t7KUevGI?autoplay=0&loop=1autoplay=0&loop=1&modestbranding=1&rel=0" width="677" height="400" frameborder="0"></iframe>
							</div>
							
                                   
                               </div>
                              
                                  <div class="col-md-6">
                                      <div style=" margin-right:1rem !important;" class="vedio_spacing vedio_height vedio_height_new">
							    	<iframe src="https://www.youtube.com/embed/Rw_J8b4EiyI?autoplay=0&loop=1&modestbranding=1&rel=0" width="677" height="400" frameborder="0"></iframe>
							</div>
							
                                      
                                  </div>
                           </div>
                       </div>
                    
                
				<!-- Portfolio Items
				============================================= -->
				<!--<div id="portfolio" class="portfolio row grid-container portfolio-reveal no-gutters" data-layout="fitRows" style="">-->

					<!-- Portfolio Item: Start -->
				
<!--			<article class="portfolio-item col-md-6 col-sm-6 col-12 ">-->
<!--						<div class="grid-inner">-->
						
<!--							<div style="height: 19rem; margin-right:1rem !important;" class="vedio_spacing">-->
<!--								<iframe src="https://www.youtube.com/embed/9N8t7KUevGI?autoplay=0&loop=1autoplay=0&loop=1&modestbranding=1&rel=0" width="677" height="400" frameborder="0"></iframe>-->
<!--							</div>-->
							
						
<!--						</div>-->
<!--						
<!--					</article>-->
					<!-- Portfolio Item: End -->

<!--			</article>-->
                    	
<!--					<article class="portfolio-item col-md-6 col-sm-6 col-12 ">-->
<!--						<div class="grid-inner">-->
						
<!--							<div style=" height: 19rem; margin-right:1rem !important;" class="vedio_spacing">-->
<!--							    	<iframe src="https://www.youtube.com/embed/Rw_J8b4EiyI?autoplay=0&loop=1&modestbranding=1&rel=0" width="677" height="400" frameborder="0"></iframe>-->
<!--							</div>-->
							
						
<!--						</div>-->

<!--					</article>-->
				
					    
				
				<!--</div>-->
				<!-- #portfolio end -->

				
				
				
				
				
				
				
				
				
			</div>
	
		</section><!-- #content end -->
    
	<!--<div class="title-center title-border topmargin-sm text-center" style="margin-bottom: 3rem; background-color:rgb(239 , 102 ,35);     height: 5rem;     padding-top: 1.5rem;" id="media_coverage">-->
	<!--					<h3 class="title_new" style="color:#fff;"></h3>-->
	<!--				</div>-->


<style>
   /*.owl-carousel .owl-nav [class*=owl-] {*/
   /*    opacity:1 !important;*/
   /*        left: -16px;*/
   /*}*/
   
   .owl-carousel .owl-nav .owl-next 
   {
       opacity:1 !important;
           right:-18px;
   }
   

</style>
	<!--<section id="content" class="" style="margin-top:4rem; margin-bottom: 3rem;">-->
	<!--    <div class="title-center title-border topmargin-sm text-center" style="margin-bottom: 3rem; background-color:rgb(239 , 102 ,35);     height: 4rem;     padding-top: 0.9rem;" id="media_coverage" >-->
	<!--					<h3 class="title_new" style="color:#fff;">PRESS&nbspCOVERAGE</h3>-->
	<!--				</div>-->
					
					
	<!--			<div></div><div></div>	-->
	<!--		<div class="content-wrap " >-->
	<!--			<div class="container clearfix">-->
				

	<!--				<div class="owl-carousel image-carousel carousel-widget flip-card-wrapper clearfix" data-margin="20" data-nav="true" data-pagi="false" data-items-xs="1" data-items-sm="1" data-items-md="2" data-items-lg="3" data-items-xl="3" style="overflow: visible;">-->
                
                            	<?php 
                            	
                        			 foreach($pages->get("name=media-coverage")->children() as $media_coverage)
                        				 {
                                              
                        		  ?>




						<!--<div class="flip-card">-->
						<!--	<div class="flip-card-front dark" style="background-color: rgba(32, 68, 150, 1)!important;">-->
								<!--<div class="flip-card-inner">-->
								<!--	<div class="card bg-transparent border-0">-->
								<!--		<div class="card-body">-->
								<!--			<h3 class="card-title mb-0">-->
											    <?
											   // $media_coverage->rise_microsite_media_coverage_headline
											    ?>
											    <!--</h3>-->
											<!--<h4 class=" mb-0">13 August 2020</h4>-->
											<!--<span>13 August 2020</span><br>-->
											<!--<span >Somak Ghoshal</span>-->
											<!--<br>-->
											<!--<span class="font-italic">-->
											    <?
											    //=$media_coverage->rise_microsite_mediacoverage_source;
											    ?>
											    <!--</span>-->
							<!--			</div>-->
							<!--		</div>-->
							<!--	</div>-->
							<!--</div>-->
							<!--<div class="flip-card-back bg-danger no-after">-->
							<!--	<div class="flip-card-inner">-->
							<!--	    	<span class="font-italic">-->
								    	    <?
								    	    //=$media_coverage->rise_microsite_mediacoverage_date;
								    	    ?>
								 <!--   	    </span>-->
									<!--<p class="mb-2 text-white">-->
									    
									    <?
									    //=$media_coverage->rise_microsite_mediacoverage_description;
									    ?>
									 <!--   </p>-->
									    
										<!--<span class="font-italic">-->
										    <?
										    //=$media_coverage->rise_microsite_mediacoverage_author;
										    ?>
									<!--	    </span><br>-->
									<!--<button type="button" class="btn btn-outline-light mt-2">View Details</button>-->
								 <!--<a target="_blank" href="-->
								 <?
								 //$media_coverage->rise_microsite_mediacoverage_link;
								 ?>
						<!--		 " class="card-link btn btn-outline-light mt-2">Read More</a>-->
						<!--		</div>-->
						<!--	</div>-->
						<!--</div>-->
                        <?
                        				 }
                        ?>
						
		<!--			</div>-->

		<!--		</div>-->
		<!--	</div>-->
		<!--</section>	-->
	
<!--<section id="content" class="" style="margin-top:4rem; margin-bottom: 3rem;">-->
<!--     <div class="fancy-title title-center title-border topmargin-sm">-->
<!--						<h3 class="title_new">Social </h3></h3>-->
<!--					</div>-->
<!--			<div class="content-wrap py-0">-->

<!--                      <div class="container">-->
<!--                          <div class="row">-->
<!--                             <div class="col-md-5">-->
<!--                                   <div class="container">-->
<!--					            	<h3 class="title_new text-center">Instagram</h3>-->
<!--            	<div id="instagram-feed-demo" class="instagram_feed customjs" style="height:18% !important;" >-->
						
						
<!--				</div>-->
<!--					        </div>-->
<!--                             </div>-->
<!--                              <div class="col-md-2"></div>-->
<!--                              <div class="col-md-5">-->
<!--                                  <div class="">-->
<!--                                      	<h3 class="title_new text-center">Facebook</h3>-->
<!--                                    <div class="container social_media" >-->
                                     
<!--                                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLetUsAllRise%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>-->
                                           
<!--                                    </div>-->
<!--                                  </div>-->
<!--                              </div>-->
                              
<!--                          </div>-->
<!--                      </div> -->
                    
                
<!--				 Portfolio Items-->
<!--				============================================= -->
<!--				<div id="portfolio" class="portfolio row grid-container portfolio-reveal no-gutters" data-layout="fitRows">

<!--					 Portfolio Item: Start -->
<!--					<article class="portfolio-item col-md-1 col-sm-6 col-12 ">-->
<!--					    </article>-->
<!--			<article class="portfolio-item col-md-4 col-sm-6 col-12 ">-->
<!--						<div class="grid-inner social_media_spacing">-->
						
<!--					        <div class="container" style="    text-align: center;">-->
<!--					            	<h3 class="title_new text-center" >Instagram</h3>-->
<!--            	<div id="instagram-feed-demo" class="instagram_feed customjs" style="height:18% !important;" >-->
<!--						<a target="_blank" href="https://www.instagram.com/rise4all/" style="text-align:center">-->
<!--						    <img class="img-fluid" style="width: 90%;height: auto;" src="<?=$urls->httpTemplates?>images/images_canvas/ss1.png">-->
<!--						    </a>-->
<!--						 <div id="tutorialFeed"> </div>-->
						
<!--				</div>-->
				        
				
				
				
				
<!--					        </div>-->
							
						
<!--						</div>-->
						
<!--					</article>-->
<!--					 Portfolio Item: End -->
<!--                        <article class="portfolio-item col-md-2 col-sm-6 col-12 ">-->
<!--					    </article>-->
			
                    	
<!--					<article class="portfolio-item col-md-4 col-sm-6 col-12 ">-->
<!--						<div class="grid-inner social_media_spacing">-->
<!--						      <div class="container" style="    text-align: center;">-->
<!--								<h3 class="title_new text-center">Facebook</h3>-->
<!--                                    <div class="container img-responsive " >-->
                                     
<!--                                             <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLetUsAllRise%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>                              -->
<!--                                    </div>-->
<!--                                     <div class="container img-responsive mobile " >-->
                                     
<!--                                       <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLetUsAllRise%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>-->
                                           
<!--                                    </div>-->
<!--                            </div>            -->
						
<!--						</div>-->
						
<!--					</article>-->
<!--					<article class="portfolio-item col-md-1 col-sm-6 col-12 ">-->
<!--					    </article>-->

<!--				</div>-->
				
				
<!--				 #portfolio end -->

				
<!--				<div>-->
				    
<!--				</div>-->
				
				
				
				
				
				
				
<!--			</div>-->
	
<!--		</section>-->
		
		<!-- #content end -->		

<section id="content">
<div class="icon-bar" style="z-index:999">
    
    
    	<!--<div id="gotoTop" class="icon-angle-up"></div>-->
    
     <!--<a class="gotoTop" href="" > <i   class="icon-angle-up"></i></a> -->
 <a  href="#footer" class="google"><i class="icon-email3"></i></a> 
  <a target="_blank" href="https://www.facebook.com/LetUsAllRise/" class="facebook"><i class="icon-facebook-f"></i></a> 
  
 
  <a target="_blank" href="https://www.linkedin.com/company/pride-circle/" class="linkedin"><i class="icon-linkedin-in"></i></a>
  <a  target="_blank" href="https://www.youtube.com/channel/UCoaAZWnpjFXcCQ5Und9mi0Q" class="youtube"><i class="icon-line2-social-youtube"></i></a> 
  <a target="_blank" href="https://twitter.com/pride_circle" class="twitter"><i class="icon-line-twitter"></i></a> 
   <a  target="_blank" href="https://www.instagram.com/rise4all/" class="instagram"><i class="  icon-line-instagram"></i></a> 

</div>
</section>
		
<footer id="footer" class="dark" style="margin-top:56px !important "  >

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30">

						<div class="col-md-6 text-center text-md-left">
							Copyrights &copy; <?php echo date("Y")?> All Rights Reserved by Pride Circle<br>
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

							<i class="icon-envelope2"></i> <a target="_blank" style="color:white;" href="mailto:contact@thepridecircle.com "><u>contact@thepridecircle.com</u></a> <br/>
							<!--<i class="icon-headphones"></i>+91–9739242109|+91–9741116929<span class="middot">&middot;</span>-->
							<!--<i class="icon-skype2"></i> CanvasOnSkype-->
						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->
</div>
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/jquery.js"></script>
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/functions.js"></script>

	<!-- SLIDER REVOLUTION 5.x SCRIPTS  -->
	<script src="<?=$urls->httpTemplates?>includes_allybook/js/jquery.themepunch.tools.min.js"></script>
	<script src="<?=$urls->httpTemplates?>includes_allybook/js/jquery.themepunch.revolution.min.js"></script>

	<script src="<?=$urls->httpTemplates?>includes_allybook/js/extensions/revolution.extension.video.min.js"></script>
	<script src="<?=$urls->httpTemplates?>includes_allybook/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script src="<?=$urls->httpTemplates?>includes_allybook/js/extensions/revolution.extension.actions.min.js"></script>
	<script src="<?=$urls->httpTemplates?>includes_allybook/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script src="<?=$urls->httpTemplates?>includes_allybook/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script src="<?=$urls->httpTemplates?>includes_allybook//js/extensions/revolution.extension.navigation.min.js"></script>
	<script src="<?=$urls->httpTemplates?>includes_allybook/js/extensions/revolution.extension.migration.min.js"></script>
	<script src="<?=$urls->httpTemplates?>includes_allybook/js/extensions/revolution.extension.parallax.min.js"></script>
	
	
	
<script type="text/javascript">
   
 var token = 'your access token',
    username = 'shivanjali_desai', // rudrastyh - my username :)
    num_photos = 4;
 
$.ajax({ // the first ajax request returns the ID of user rudrastyh
	url: 'https://api.instagram.com/v1/users/search',
	dataType: 'jsonp',
	type: 'GET',
	data: {access_token: token, q: username}, // actually it is just the search by username
	success: function(data){
		console.log(data);
		$.ajax({
			url: 'https://api.instagram.com/v1/users/' + data.data[0].id + '/media/recent', // specify the ID of the first found user
			dataType: 'jsonp',
			type: 'GET',
			data: {access_token: token, count: num_photos},
			success: function(data2){
				console.log(data2);
				for(x in data2.data){
					$('ul').append('<li><img src="'+data2.data[x].images.thumbnail.url+'"></li>');  
				}
    			},
			error: function(data2){
				console.log(data2);
			}
		});
	},
	error: function(data){
		console.log(data);
	}
});
</script>
	
	
	
 <script>
$(document).ready(function(){ 
	$("#myTab li:eq(1) a").tab('show'); // show 2nd tab on page load
});
</script>
	<script>

		var tpj = jQuery;
		var revapi202;
		var $ = jQuery.noConflict();

		tpj(document).ready(function() {
			if (tpj("#rev_slider_579_1").revolution == undefined) {
				revslider_showDoubleJqueryError("#rev_slider_579_1");
			} else {
				revapi202 = tpj("#rev_slider_579_1").show().revolution({
					sliderType: "standard",
					jsFileLocation: "include/rs-plugin/js/",
					sliderLayout: "fullscreen",
					dottedOverlay: "none",
					delay: 9000,
					responsiveLevels: [1140, 1024, 778, 480],
					visibilityLevels: [1140, 1024, 778, 480],
					gridwidth: [1140, 1024, 778, 480],
					gridheight: [728, 768, 960, 720],
					lazyType: "none",
					shadow: 0,
					spinner: "off",
					stopLoop: "on",
					stopAfterLoops: 0,
					stopAtSlide: 1,
					shuffle: "off",
					autoHeight: "off",
					fullScreenAutoWidth: "off",
					fullScreenAlignForce: "off",
					fullScreenOffsetContainer: "",
					fullScreenOffset: "",
					disableProgressBar: "on",
					hideThumbsOnMobile: "off",
					hideSliderAtLimit: 0,
					hideCaptionAtLimit: 0,
					hideAllCaptionAtLilmit: 0,
					debugMode: false,
					fallbacks: {
						simplifyAll:"off",
						disableFocusListener:false,
					},
					parallax: {
						type:"mouse",
						origo:"slidercenter",
						speed:300,
						levels:[2,4,6,8,10,12,14,16,18,20,22,24,49,50,51,55],
					},
					navigation: {
						keyboardNavigation:"off",
						keyboard_direction: "horizontal",
						mouseScrollNavigation:"off",
						onHoverStop:"off",
						touch:{
							touchenabled:"on",
							swipe_threshold: 75,
							swipe_min_touches: 1,
							swipe_direction: "horizontal",
							drag_block_vertical: false
						},
						arrows: {
							style: "hermes",
							enable: true,
							hide_onmobile: false,
							hide_onleave: false,
							tmp: '<div class="tp-arr-allwrapper">	<div class="tp-arr-imgholder"></div>	<div class="tp-arr-titleholder">{{title}}</div>	</div>',
							left: {
								h_align: "left",
								v_align: "center",
								h_offset: 10,
								v_offset: 0
							},
							right: {
								h_align: "right",
								v_align: "center",
								h_offset: 10,
								v_offset: 0
							}
						}
					}
				});
				revapi202.on("revolution.slide.onloaded",function (e) {
					setTimeout( function(){ SEMICOLON.slider.sliderDimensions(); }, 200 );
				});

				revapi202.on("revolution.slide.onchange",function (e,data) {
					SEMICOLON.slider.revolutionSliderMenu();
				});
			}
//}); /*ready*/

	</script>
	<script type="text/javascript">
    $(function () {
        $("#btnShowPopup").click(function () {           
            $("#MyPopup").modal("show");
        });
    }); 
</script>
<script src="https://www.jqueryscript.net/demo/Instagram-Photos-Without-API-instagramFeed/jquery.instagramFeed.js"></script>

  
  
  

<script type="text/javascript">
   
 var token = 'your access token',
    username = 'shivanjali_desai', // rudrastyh - my username :)
    num_photos = 4;
 
$.ajax({ // the first ajax request returns the ID of user rudrastyh
	url: 'https://api.instagram.com/v1/users/search',
	dataType: 'jsonp',
	type: 'GET',
	data: {access_token: token, q: username}, // actually it is just the search by username
	success: function(data){
		console.log(data);
		$.ajax({
			url: 'https://api.instagram.com/v1/users/' + data.data[0].id + '/media/recent', // specify the ID of the first found user
			dataType: 'jsonp',
			type: 'GET',
			data: {access_token: token, count: num_photos},
			success: function(data2){
				console.log(data2);
				for(x in data2.data){
					$('ul').append('<li><img src="'+data2.data[x].images.thumbnail.url+'"></li>');  
				}
    			},
			error: function(data2){
				console.log(data2);
			}
		});
	},
	error: function(data){
		console.log(data);
	}
});
</script>

<script>
$("#btn_coming_soon").on("click",function(){
  alert("Coming soon!");
})
</script>
<?php
// <!-- Linkedin code -->
?>
<script type="text/javascript"> _linkedin_partner_id = "3744588"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3744588&fmt=gif" /> </noscript>
	<?php
  // <!-- End Linkedin code -->
  ?>
</body>
</html>