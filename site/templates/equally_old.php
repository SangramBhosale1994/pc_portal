<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	

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
	<meta name="viewport" content="width=device-width, initial-scale=1" />


	<!-- Document Title
	============================================= -->
	<title>Equally</title>
	


<style type="text/css">
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
 
  

</style>
</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
	    	<header id="header" class="full-header" data-sticky-shrink="true">
			<div id="header-wrap">
				<div class="container">
				    <div class="d-flex justify-content-between">
				        <div id="logo" style=" margin-right: 0;" >
				           <a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
				           </a>
				           <a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
				           </a>
				             <a href="index.html" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
				           </a>
				           
				            
				           
				        </div>
				           <div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>
				        
				        
				        
				        
				        <div>
				           <nav class="primary-menu">

    							<ul class="menu-container">
    								<li class="menu-item">
    									<a class="menu-link" href="#home"><div>Home</div></a>
    									
    								</li>
    								<li class="menu-item">
    									<a class="menu-link" href="#ourallies"><div>Authors</div></a>
    									
    								</li>
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="#booklaunch"><div>Book Launch</div></a>
    									
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
				          <div id="logo" style=" margin-right: 0;" >
				           <a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
				           </a>
				          </div>
				           
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
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->
		
		<section id="content">
            <div class=" img-responsive img-fluid "> 
							<!--style="background-image: url('<?=$urls->httpTemplates?>images/images_canvas/rise_desktop.jpg');">-->
				<img style="" class="img-fluid" src="<?=$urls->httpTemplates?>images/images_canvas/equally_desktop.png">
			</div>
			<div class="img-responsive  mobile" >
				<img class="img-fluid"  src="<?=$urls->httpTemplates?>images/images_canvas/equally_mobile.png">
			</div>
        </section>
		
			
        <section id="content" style="padding: 0px 0 !important;";>
            <div class="content-wrap py-0">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <h1 style="font-weight:700; margin-top: 3rem">Online Event on 9th April 2021, 1:30pm IST</h1>
                        
                        
                    </div>
                    <br/>
                    <center><button class="button button-desc button-3d button-rounded button-green center">Register Here</button></center>
                </div>
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
                                       $name_new=$page_agenda->title;
                                        
                                        if($name== $name_new)
                                        {
                                            ?>
                                                 <a style="    padding-right: 0.5rem;padding-left: 0.5rem;font-size: 1rem;" target="_blank" href="<?=$page_agenda->pc_allybook_ourallies_linkedin?>" class="facebook"><i class="icon-facebook"></i></a>
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

							<div class="text-md-left hb mb-4 border-bottom-0 text_alignment text_spacing_sections">

								<p class="p_description " ><?=$page->pc_ally_book_textbos_section2;?></p>

							</div>
						</div>

					</div>
				</div>
			</div>	
        </section>
        <section id="booklaunch">
			<div class=" py-0" id="booklaunch">
				<div class="section m-0 border-0 bg-color dark" style="padding: 80px 0;" >
					<div class="container center">

						<!--<div class="heading-block mb-4 border-bottom-0">-->
						<!--	<h1 class="font-weight-normal letter note mb-0" align="center" style="text-transform:uppercase;">Launching In</h1>-->
						<!--</div>-->
						<div class="container clearfix">
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
					        	    <a href="#" style="background-color:#FF9900 !important; color: #000"  class="button button-3d button-large button-rounded button-yellow button-light">PRE-BOOK NOW</a>
					        	</div>
					        </div>
				        </div>
		        	</div>
		    </div>
        </section>
        <section id="testimonals" style="    margin-top: 2rem; padding: 0px 0;">
			<div class="content-wrap" id="testimonal">
				<div class="container clearfix">
    					<div class="d-flex justify-content-center" style="" >
    					        <h2 style="text-transform:uppercase;">Testimonals</h2>
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
					        <h2 style="text-transform:uppercase; padding-top: 3rem; padding-bottom: 2rem;  margin: 0 0 0px 0; ">Partners</h2>
					</div>
                    <div class="container">
				          
					<!--<div class="d-flex justify-content-center"> -->
     <!--                   <div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:px; text-align:center"></div>-->
     <!--               </div>-->
                	<div class="d-flex justify-content-center "> 
				         <ul class="d-md-flex justify-content-center text-center">
				       	    <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/homegrown.png" alt="Clients">
							  <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/linkedinloca.png" alt="Clients">
							    <img style="width: 208px;height: auto; padding: 15px;" src="<?=$urls->httpTemplates?>images/sponsors_equally/gaylaxay.png" alt="Clients">
							
							
							
							
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
						Copyrights &copy; <?php echo date("Y")?>  2020 All Rights Reserved by Pride Circle<br>
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
	<script type="text/javascript">
	const second = 1000,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;

let countDown = new Date('April 9, 2021 13:30:00').getTime(),
    x = setInterval(function() {

      let now = new Date().getTime(),
          distance = countDown - now;

      document.getElementById('days').innerText = Math.floor(distance / (day)),
        document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
        document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
        document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
      
    }, second)
</script>

	
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/jquery.js"></script>
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/plugins.min.js"></script>
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/functions.js"></script>
	

</body>
</html>