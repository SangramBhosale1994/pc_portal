 <?php

// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
// 	//Tell the browser to redirect to the HTTPS URL.
// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 	//Prevent the rest of the script from executing.
// 	exit;
// }
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

/*css for countdown*/

</style>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/60252624918aa261273df0f4/1eu8hq06f';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
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

	        <!--paragraph section-->
            <section id="content">
            	<div class="content-wrap mt-4" id="about_rise">
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
            <div class="container mt-">
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
            </div>
            <!--countdown section end-->

            <!--icons section-->
            <section id="">
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
            <section id="content" class="container_style" style="margin-top:4rem; margin-bottom: -3rem; ">
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
            <section id="content" class="mt-6 spacing_riseref spacing_riseref1 section_style mt-4">
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
                <section id="content">
			<div class="" style="margin-bottom: 5rem; margin-bottom:2rem;">


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
				<div class="container clearfix">
				    <h3 class="text-center" style="margin-bottom:2rem;">INTERNATIONAL SPEAKERS</h3>

					<div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

							<?php 
							$limit=3;
						    foreach($pages->get("name=keynote-speakers")->children("")  as $rise_speaker)
						    {
						  //      //echo $rise_speaker->title;
						  
						  //$pages->get("name=Speakers")->children() as $page_agenda
						  
						  
						?>

						<article class="portfolio-item col-lg-1-5 col-md-4 col-sm-4 col-12 pf-illustrations">
							<div class="grid-inner">
								<div class="portfolio-image" style="margin-bottom:0.2rem;">
									
										<img src="<?=$rise_speaker->pc_ally_book_ourallies_img->first()->url?>" alt="Locked Steel Gate">
								
									
								</div>

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
                                        
                                        // Reason: code added for placed icon
                                        // Code by : Hemlata
                                        // Date : 05-04-2021
                                        
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
                            <h3 class="text-center" style="margin-bottom:2rem;">NATIONAL SPEAKERS</h3>
					<div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

							<?php 
						
						    foreach($pages->get("name=all-speakers")->children("")  as $rise_speaker)
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
                                        
                                        // Reason: code added for placed icon
                                        // Code by : Hemlata
                                        // Date : 05-04-2021
                                        
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
						
										<h5 class="font-weight-normal center letter note mb-0" style="margin-top:-1.5rem !important;" ><b><?=$rise_speaker->pc_ally_book_companyname?></b></h5>
									
										 
							</div>
							
						</article>
					

						<?php
					}
					?>
						

					</div><!-- #portfolio end -->
					
					
						
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












<style>
   .owl-carousel .owl-nav .owl-next 
   {
       opacity:1 !important;
           right:-18px;
   }
</style>
	            
                            	




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
							
							</div>

							<div class="clear"></div>

							<i class="icon-envelope2"></i> <a target="_blank" style="color:white;" href="mailto:contact@thepridecircle.com "><u>contact@thepridecircle.com</u></a> <br/>
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

<!-- js by pooja For Countdown -->
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