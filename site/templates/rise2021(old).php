 <!DOCTYPE>
<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

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
	<title>RISE</title>

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

}

.img-responsive.mobile {
  display: none;
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
    .card_height_rise
  {
      height:393px;
  }
   .social_media
  {
          margin-left: 24px;
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
    color: #000033;
    border-color: #000033;
}
.btn-outline-primary-new:hover {
    color: #fff;
    background-color: #000033;
    border-color: #000033;
}
.flip-card-front::after {
    background-color: rgba(32, 68, 150, 1) !important;
}
.btn-link, .page-link, .page-link:hover, .page-link:focus {
    color: #000033;
}
.ui-state-active { display:none }
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


<section id="content">
   <div class=" img-responsive "> 
							<!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_desktop.jpg');">-->
							    <img style="" class="img-fluid" src="<?=$urls->httpTemplates?>images/images_canvas/rise_desktop.jpg">
							</div>
							<div class="img-responsive  mobile" >
								    <!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_mobile.jpg');">-->
								 <img class="img-fluid"  src="<?=$urls->httpTemplates?>images/images_canvas/rise_mobile.jpg">
							 </div>
    
</section>

	
<section id="content" style="margin-top:4rem;">
    <div class="container-fluid">
        <div class="d-flex justify-content-center flex-container">
            <a class="flex-spacing" href="#about_rise" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new  "> ABOUT RISE</button></a>
            <a class="flex-spacing"  href="#agenda_table" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new">AGENDA</button></a>
             <a class="flex-spacing"  href="#speakers" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new">SPEAKERS</button></a>
             <a class="flex-spacing"  href="#sponsors" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new">SPONSORS</button></a>
             <a class="flex-spacing"  href="#tickets" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new">EVENT&nbsp PASSES</button></a>
             
               
                <a class="flex-spacing"  href="#gallery" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new">GALLERY</button></a>
                  <a class="flex-spacing"  href="#media_coverage" style="margin-right:17px;"><button type="button" class="btn btn-outline-primary-new">PRESS&nbspCOVERAGE</button></a>
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
							<div style="padding-top:2rem;     margin-bottom: -1rem !important;" class="heading-block border-bottom-0">
								<h4 style="color: #000033;"><center>Rise 2021</center></h4>
							</div>

							<p><?=$page->pc_rise_microsite_about_rise;?></p>
                                <div >
							<!--<a href="#" class="btn btn-outline-secondary">Learn more &rarr;</a>-->
								 <a target="_blank" href="https://www.thepridecircle.com/rise-bangalore/" style="margin:auto; text-align:center;"><button type="button" class="btn btn-outline-primary-new">RISE&nbspBanglore</button></a>
								    <br>
								 
								 	<p><?=$page->pc_rise_microsite_about_rise_two;?></p>
								 <br>
                    	 <a target="_blank" href="https://www.thepridecircle.com/rise-delhi/" style=""><button type="button" class="btn btn-outline-primary-new">RISE&nbspDelhi</button></a>
                    	 <br>
                    	        </div>
						</div>
					
					</div>
				</div>

				
			</div>
		</section><!-- #content end -->
	<!---All---->
<section id="content" class="container_style" style="margin-top:4rem;">
 <div class="container">
      <div class="row">
  <div class="col-sm-4 tickets_column">
    <div class="card card_height_rise">
      <div class="card-body">
       <h2 class="title_new card-title" style="margin: 0px 0 -8px 0;">Conference </h2>
        <p class="card-text">
            <p></p><?=$page->pc_rise_microsite_conference;?> </p>
            </p>
             <a href="#agenda_table"><button style="padding: 5px 18px;" class="buttonnew button3" style="margin:auto;"> Agenda</button></a>
      </div>
    </div>
  </div>
  <div class="col-sm-4 tickets_column">
    <div class="card tickets_column card_height_rise">
      <div class="card-body">
        <h2 class="title_new card-title" style="margin: 0px 0 -8px 0;">Job Fair </h2>
        <p class="card-text">
            <p>
					<?=$page->pc_rise_microsite_job_fair;?>
					
					</p>

		                <div class="">
                    	<a target="_blank" href="https://www.thepridecircle.com/resume/"><button style="padding: 5px 18px;" class="buttonnew button3">Upload your Resume</button></a>
                    	<a target="_blank" href="https://www.thepridecircle.com/jobs/"><button style="padding: 5px 18px;"  class="buttonnew button3">Explore jobs</button></a>
                        </div>                        
        </p>    
      </div>
    </div>
  </div>
   <div class="col-sm-4 tickets_column">
    <div class="card card_height_rise">
      <div class="card-body">
       <h2 class="title_new card-title" style="margin: 0px 0 -8px 0;">Marketplace </h2>
        <p class="card-text">
            <p>
					    	<?=$page->pc_rise_microsite_marketplace;?>
					</p>
            <button style="padding: 5px 18px;" class="buttonnew button3">Coming Soon </button>
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
        <div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">AGENDA</h3></h3>
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
                                     <h1 class="card-title center font-weight-normal  letter note mb-0" style="align-items: center;">13 April 2021</h1>
          
    <div class="container">
            <h3 style="    margin-top: 14px; margin-bottom: 9px !important;"> <center>Session-I</center></h3>
  
     
  <div id="accordion" style="padding-bottom:2rem;">
      	<?php 
               foreach($pages->get("name=day-one")->children('start=0,limit=6') as $page_agenda)
                  {
                        
        ?>
     
      
  <div class="card">
    <div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">
      <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center;" >
     
        <span class="accordion-title text-center center " data-toggle="collapse" data-target="#collapseOnecollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff">
           <?=$page_agenda->pc_allybook_agendatable_description;?>
        
        </span>
      </h5>
    </div>

    <div id="collapseOnecollapse<?=$page_agenda->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body text-center " >
       <?=$page_agenda->pc_allybook_agendatable_time?>
      </div>
    </div>
  </div>
  
  
  <?php  
                    
                      
                  } 
                  
                ?>
  
  
  
<!--</div>-->
    
    <h3 style="    margin-top: 20px; margin-bottom: 9px !important;"><center>Session-II</center></h3>
    
                     <!--<h3><center>Session-I</center></h3>-->
  
     
  <!--<div id="accordion">-->
      	<?php 
               foreach($pages->get("name=day-one")->children('start=6,limit=15') as $page_agenda)
                  {
                        
        ?>
     
      
  <div class="card">
    <div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">
      <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center; "  >
     
        <span class="accordion-title text-center center " data-toggle="collapse" data-target="#collapseTwocollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff; ">
         <?=$page_agenda->pc_allybook_agendatable_description;?>
           
        
        </span>
      </h5>
    </div>

    <div id="collapseTwocollapse<?=$page_agenda->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body text-center " >
       <?=$page_agenda->pc_allybook_agendatable_time?>
      </div>
    </div>
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
                                     <h1 class="card-title center font-weight-normal  letter note mb-0" style="align-items: center;">14 April 2021</h1>
                                    
                                                
    <div class="container">
            <h3 style="    margin-top: 14px; margin-bottom: 9px !important;"> <center>Session-I</center></h3>
  
     
  <div id="accordion" style="padding-bottom:2rem;">
      	<?php 
               foreach($pages->get("name=day-two")->children('start=0,limit=7') as $page_agenda)
                  {
                        
        ?>
     
      
  <div class="card">
    <div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">
      <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center;" >
     
        <span class="accordion-title text-center center " data-toggle="collapse" data-target="#collapseOnecollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff">
           <?=$page_agenda->pc_allybook_agendatable_description;?>
        
        </span>
      </h5>
    </div>

    <div id="collapseOnecollapse<?=$page_agenda->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body text-center " >
       <?=$page_agenda->pc_allybook_agendatable_time?>
      </div>
    </div>
  </div>
  
  
  <?php  
                    
                      
                  } 
                  
                ?>
  
  
  
<!--</div>-->
    
    <h3 style="    margin-top: 20px; margin-bottom: 9px !important;"><center>Session-II</center></h3>
    
                     <!--<h3><center>Session-I</center></h3>-->
  
     
  <!--<div id="accordion">-->
      	<?php 
               foreach($pages->get("name=day-one")->children('start=7,limit=15') as $page_agenda)
                  {
                        
        ?>
     
      
  <div class="card">
    <div class="card-header" id="headingOne" style="padding: 0.4rem 0.25rem; margin-bottom: -11px; background-color:rgb(0,160,74);">
      <h5 class="mb-0" style="margin-top: 9px;    padding-bottom: 9px; text-align:center; "  >
     
        <span class="accordion-title text-center center " data-toggle="collapse" data-target="#collapseTwocollapse<?=$page_agenda->id?>" aria-expanded="true" aria-controls="collapseOne" style="color:#fff; ">
         <?=$page_agenda->pc_allybook_agendatable_description;?>
           
        
        </span>
      </h5>
    </div>

    <div id="collapseTwocollapse<?=$page_agenda->id?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body text-center " >
       <?=$page_agenda->pc_allybook_agendatable_time?>
      </div>
    </div>
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
<div class="d-flex justify-content-center" style="margin-bottom:3rem;">
    
<a href="<?=$page->rise_microsite_download_link->httpUrl;?>" target="_blank">
    <button type="button" class="btn btn-outline-primary-new">Download Agenda</button>
</a>





</div>

</section>

<section id="content" style="margin-top:4rem;" >
     <div class="fancy-title title-center title-border topmargin-sm" id="tickets">
						<h3 class="title_new">EVENT&nbspPASSES</h3></h3>
					</div>
					
<div id="grad3" style="text-align:center;" class="  tabs_banner d-flex justify-content-between ">
    <!--<img style="width:100%; height:auto;" class="img-fluid" src="<?=$urls->httpTemplates?>images/images_canvas/color.jpg">-->
    
 <p style="margin:auto; font-weight:bolder; font-size:1.5rem;     color: #fff;" >Coming Soon...</p>

    
</div>			
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



<section id="content" style="margin-top:4rem;">
	    <div class="fancy-title title-center title-border topmargin-sm" id="speakers">
						<h3 class="title_new">Speakers</h3></h3>
					</div>
					
			<section id="content">
			<div class="content-wrap" style="margin-bottom: 5rem;">
				<div class="container clearfix">

					<div id="portfolio" class="portfolio row grid-container gutter-20" data-layout="fitRows">

							<?php 
							$limit=3;
						    foreach($pages->get("name=Speakers")->children("")  as $rise_speaker)
						    {
						  //      //echo $rise_speaker->title;
						  
						  //$pages->get("name=Speakers")->children() as $page_agenda
						  
						  
						?>

						<article class="portfolio-item col-lg-1-5 col-md-4 col-sm-4 col-12 pf-illustrations">
							<div class="grid-inner">
								<div class="portfolio-image" style="margin-bottom:0.2rem;">
									
										<img src="<?=$rise_speaker->pc_ally_book_ourallies_img->first()->url?>" alt="Locked Steel Gate">
								
									
								</div>

            <div class="d-flex justify-content-center">
                  <a style="    padding-right: 0.5rem;
    padding-left: 0.5rem;
    font-size: 1.2rem;" target="_blank" href="#" class="linkedin"><i class="icon-linkedin-in"></i></a>
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


 <div id="grad4" style="text-align:center;" class="tabs_banner d-flex justify-content-between">
    <?php
        $speaker_page=$pages->get("name=speakers");
    ?>   
    <a target="_blank" style="margin:auto;" href="<?=$speaker_page->httpUrl;?>">
 <button  type="button" class="buttonnew button3">View Speakers
</button>

    </a>
</div>


   
	    </section>
	    

<section id="content"  style="margin-top:4rem;">
     <div class="fancy-title title-center title-border topmargin-sm" id="sponsors">
						<h3 class="title_new">SPONSORS&nbspAND&nbspPARTNERS</h3>
					</div>
			<div class="content-wrap" id="sponsors">
				<div class="container clearfix">

				  <div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">CONFERENCE</h3>
					</div>

				
				<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Title </h3>
        <div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>

				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/intuit.png" alt="Clients">
							<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/macquare.png" alt="Clients">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/northern_trust.png" alt="Clients">
							
							</ul>
				</div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">CXO panel </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/athenahealth.png" alt="Clients">
							
							
							</ul>
				</div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Breakout</h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/bcg.png" alt="Clients">
							
							
							</ul>
				</div>
                    	<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Report Launch </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-flex justify-content-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/verisk.png" alt="Clients">
							
							
							</ul>
				</div>
				
				</div>
			<div class="container clearfix">

		
					 <div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">JOB FAIR</h3>
					</div>

				
				<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Inspirer </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/credit_suisse.png" alt="Clients">
							<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/wells_fargo.png" alt="Clients">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/northern_trust.png" alt="Clients">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/ubs.png" alt="Clients">
							</ul>
				</div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Platinum  </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/citrix.png" alt="Clients">
							
							
							</ul>
				</div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Daimond</h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/mastercard.png" alt="Clients">
							
							
							</ul>
				</div>
                    	<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Gold </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
				       	<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/general_elec.png" alt="Clients">
							
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/intuit.png" alt="Clients">
    <img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/invesco.png" alt="Clients">
							
							
							</ul>
				</div>
				  	<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Silver </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
				       	<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/27.png" alt="Clients">
							
								<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/general_mills.png" alt="Clients">
    <img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/standard_chat.png" alt="Clients">
    <img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/verisk.png" alt="Clients">
							
							
							</ul>
				</div>
				  	<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Bronze </h3>
<div class="d-flex justify-content-center"> <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div></div>
				   <ul class="d-md-flex justify-content-center text-center">
				       	<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/c2fo.png" alt="Clients">
							
							
							
							</ul>
				</div>
					<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Career Guidance Booth  </h3>
						
<div class="d-flex justify-content-center"> 
<div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div>
</div>

				   <ul class="d-md-flex justify-content-center text-center">
				       	<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/nutanix.png" alt="Clients">
							
							
							
							</ul>
				</div>
				
				

				
				</div>
					<div class="container clearfix">

				  <div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">PARTNERS</h3>
					</div>
					</div>
                        		<div class="container">
				          
						<h3 class=" text-center" style="margin: 0 0 0px 0;">Shipment Partner </h3>
					<div class="d-flex justify-content-center"> 
<div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div>
</div>
    	<div class="d-flex justify-content-center "> 
				   <ul class="d-md-flex justify-content-center text-center">
				       	<img style="width: 208px;
    height: auto;
    padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_rise/Fedex.png" alt="Clients">
							
							
							
							</ul>
				</div>
					
				
				</div>

				
			</div>
		</section>
	    	<section id="content" class="container_style" style="margin-top:4rem;">
	    	    	


 <div id="grad5" style="text-align:center;" class="tabs_banner d-flex justify-content-between">
   
    
  <a target="_blank" style="margin:auto; justify-content: center;" href="https://www.thepridecircle.com/universe/company-registration-with-email/"> 
  <button type="button"  class="buttonnew button3" >
   Become a Sponsor
 
</button>
</a>

    
</div>

	    	    	    	    
	    	    
<!--    <a href="#" class="button button-full button-dark center text-right bottommargin-lg">-->
<!--					<div class="container clearfix">-->
<!--				<button type="button" class="buttonnew button3" data-toggle="modal" data-target="#exampleModal">-->
<!--     Sponsors and Partners-->
 
<!--</button>-->
<!--					</div>-->
<!--				</a>-->
				
<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title title_new" id="exampleModalLongTitle">Sponsors & Partners</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <div class="modal-body">
                    

					<!--<h3>Sponsors & Partners</h3>-->

					<ul class="clients-grid grid-2 grid-sm-3 grid-md-6 mb-0">
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/1.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/2.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/3.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/4.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/5.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/6.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/7.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/8.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/9.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/10.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/11.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/12.png" alt="Clients"></a></li>
							<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/7.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/8.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/9.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/10.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/11.png" alt="Clients"></a></li>
						<li class="grid-item"><a href="#"><img src="<?=$urls->httpTemplates?>images/images_canvas/clients/12.png" alt="Clients"></a></li>
					</ul>

				
				
        
        
        
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
              </div>
        </div>
      </div>
    </div>
			
</section>
<section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:4rem;">
     <div class="fancy-title title-center title-border topmargin-sm" id="gallery">
						<h3 class="title_new">GALLERY</h3></h3>
					</div>
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
    <li data-target="#carouselExampleCaptions" data-slide-to="5"></li>
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
								<h3>RISE Banglore 2019
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
    <li data-target="#carouselExampleCaptionsOne" data-slide-to="5"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/11.jpg" class="d-block w-100" alt="...">
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
      <img src="<?=$urls->httpTemplates?>images/images_canvas/flicker_images/14.jpg" class="d-block w-100" alt="...">
      
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


<section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:4rem;">
     <div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">RISE REFLECTIONS</h3></h3>
					</div>
			<div class="content-wrap py-0" style="margin-bottom: -2rem !important;">

                       <div class="container">
                           <div class="row">
                               <div class="col-md-6">
                                   	<div style="height: 19rem; margin-right:1rem !important;" class="vedio_spacing">
								<iframe src="https://www.youtube.com/embed/9N8t7KUevGI?autoplay=0&loop=1autoplay=0&loop=1&modestbranding=1&rel=0" width="677" height="400" frameborder="0"></iframe>
							</div>
							
                                   
                               </div>
                                  <div class="col-md-6">
                                      <div style=" height: 19rem; margin-right:1rem !important;" class="vedio_spacing">
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
    


	<section id="content" class="" style="margin-top:4rem;">
			<div class="content-wrap spacing_mediacoverage" id="media_coverage">
				<div class="container clearfix">
					<div class="fancy-title title-center title-border topmargin-sm">
						<h3 class="title_new">PRESS&nbspCOVERAGE</h3>
					</div>

					<div class="owl-carousel image-carousel carousel-widget flip-card-wrapper clearfix" data-margin="20" data-nav="true" data-pagi="false" data-items-xs="1" data-items-sm="1" data-items-md="2" data-items-lg="3" data-items-xl="3" style="overflow: visible;">
                
                            	<?php 
                            	
                        			 foreach($pages->get("name=media-coverage")->children() as $media_coverage)
                        				 {
                                              
                        		  ?>




						<div class="flip-card">
							<div class="flip-card-front dark" style="background-color: rgba(32, 68, 150, 1)!important;">
								<div class="flip-card-inner">
									<div class="card bg-transparent border-0">
										<div class="card-body">
											<h3 class="card-title mb-0">
											    <?=$media_coverage->rise_microsite_media_coverage_headline?></h3>
											<!--<h4 class=" mb-0">13 August 2020</h4>-->
											<!--<span>13 August 2020</span><br>-->
											<!--<span >Somak Ghoshal</span>-->
											<br>
											<span class="font-italic"><?=$media_coverage->rise_microsite_mediacoverage_source;?></span>
										</div>
									</div>
								</div>
							</div>
							<div class="flip-card-back bg-danger no-after">
								<div class="flip-card-inner">
								    	<span class="font-italic"><?=$media_coverage->rise_microsite_mediacoverage_date;?></span>
									<p class="mb-2 text-white">
									    
									    <?=$media_coverage->rise_microsite_mediacoverage_description;?></p>
									    
										<span class="font-italic">
										    <?=$media_coverage->rise_microsite_mediacoverage_author;?></span><br>
									<!--<button type="button" class="btn btn-outline-light mt-2">View Details</button>-->
								 <a target="_blank" href="<?=$media_coverage->rise_microsite_mediacoverage_link;?>" class="card-link btn btn-outline-light mt-2">Read More</a>
								</div>
							</div>
						</div>
                        <?
                        				 }
                        ?>
						
					</div>

				</div>
			</div>
		</section>	
	
<section id="content" class="" style="margin-top:4rem; margin-bottom: 3rem;">
     <!--<div class="fancy-title title-center title-border topmargin-sm">-->
					<!--	<h3 class="title_new">Social </h3></h3>-->
					<!--</div>-->
			<div class="content-wrap py-0">

    <!--                  <div class="container">-->
    <!--                      <div class="row">-->
    <!--                         <div class="col-md-5">-->
    <!--                               <div class="container">-->
				<!--	            	<h3 class="title_new text-center">Instagram</h3>-->
    <!--        	<div id="instagram-feed-demo" class="instagram_feed customjs" style="height:18% !important;" >-->
						
						
				<!--</div>-->
				<!--	        </div>-->
    <!--                         </div>-->
    <!--                          <div class="col-md-2"></div>-->
    <!--                          <div class="col-md-5">-->
    <!--                              <div class="">-->
    <!--                                  	<h3 class="title_new text-center">Facebook</h3>-->
    <!--                                <div class="container social_media" >-->
                                     
    <!--                                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLetUsAllRise%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>-->
                                           
    <!--                                </div>-->
    <!--                              </div>-->
    <!--                          </div>-->
                              
    <!--                      </div>-->
    <!--                  </div> -->
                    
                
				<!-- Portfolio Items
				============================================= -->
				<div id="portfolio" class="portfolio row grid-container portfolio-reveal no-gutters" data-layout="fitRows">

					 <!--Portfolio Item: Start -->
					<article class="portfolio-item col-md-1 col-sm-6 col-12 ">
					    </article>
			<article class="portfolio-item col-md-4 col-sm-6 col-12 ">
						<div class="grid-inner social_media_spacing">
						
					        <div class="container">
					            	<h3 class="title_new text-center">Instagram</h3>
            	<div id="instagram-feed-demo" class="instagram_feed customjs" style="height:18% !important;" >
						
						
				</div>
					        </div>
							
						
						</div>
						
					</article>
					 <!--Portfolio Item: End -->
                        <article class="portfolio-item col-md-2 col-sm-6 col-12 ">
					    </article>
			
                    	
					<article class="portfolio-item col-md-4 col-sm-6 col-12 ">
						<div class="grid-inner">
						
								<h3 class="title_new text-center">Facebook</h3>
                                    <div class="container img-responsive social_media" >
                                     
                                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLetUsAllRise%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="600" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                           
                                    </div>
                                     <div class="container img-responsive mobile social_media" >
                                     
                                       <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FLetUsAllRise%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                           
                                    </div>
						
						</div>
						
					</article>
					<article class="portfolio-item col-md-1 col-sm-6 col-12 ">
					    </article>

				</div>
				
				
				<!-- #portfolio end -->

				
				
				
				
				
				
				
				
				
			</div>
	
		</section><!-- #content end -->		

<section id="content">
<div class="icon-bar">
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
							Copyrights &copy; 2020 All Rights Reserved by Pride Circle<br>
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

							<i class="icon-envelope2"></i> contact@thepridecircle.com <span class="middot">&middot;</span> <br/>
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
		}); /*ready*/

	</script>
	<script type="text/javascript">
    $(function () {
        $("#btnShowPopup").click(function () {           
            $("#MyPopup").modal("show");
        });
    }); 
</script>
<script src="https://www.jqueryscript.net/demo/Instagram-Photos-Without-API-instagramFeed/jquery.instagramFeed.js"></script>
	<script>
 (function($){
		$(window).on('load', function(){
			$.instagramFeed({
				'username': 'rise4all',
				'container': "#instagram-feed-demo",
				'display_profile': false,
				'display_biography': false,
				'display_gallery': true,
				'get_raw_json': false,
				'callback': null,
				'styling': true,
				'items': 12,
				'items_per_row': 3,
				'margin': 0.3
			});
		});
	})(jQuery);
  </script>
  
  
  
  <script>
   
  </script>
</body>
</html>