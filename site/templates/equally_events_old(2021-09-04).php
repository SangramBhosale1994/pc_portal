<?php
	// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	// {
	// 	//Tell the browser to redirect to the HTTPS URL.
	// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	// 	//Prevent the rest of the script from executing.
	// 	exit;
	// }
?><html>

	<head>
	
		<meta charset="UTF-8" />
		<title><?=$page->title?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta name="description" content="Accordion Using CSS and Jquery" />
		<meta name="keywords" content="accordion, css3, radio buttons, pseudo class, Radio Checked Property, Jquery" />

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


		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Need Share button CSS  -->
		<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/needsharebutton.min.css">
		
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

		<!-- CSS Only Accordion-->
				<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/equally_events.css?v=30.03">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
		<!--Jquery can be removed to have CSS only accordion to disable "One Accordion open at a time feature"-->
		<script src="<?=$urls->httpTemplates?>scripts/equally_events.js"></script>
	<style>
		.spread_text:hover{
			text-decoration:none;
		}
		.spread_text{
			margin-top: 2px;
		}

		.rupa_logo{
			padding-right: 30px;
		}

		@media only screen and (max-width: 768px){
			.spread_text{
				margin-top: 8px;
				font-size: 11px;
			}
			.share_btn{
				font-size: 12px;
				font-weight: bolder;
			}
			.whatsapp_icon{
				font-size: 17px;
			}
			.rupa_logo{
			padding-right: none;
			}
		}

		.fa-chevron-right, .fa-chevron-up{
			position: absolute;
			right: 13;
			top: 12;
		}

	</style>

	</head>
	<body>
		<div id="" class="clearfix">
			<header id="header" class="full-header" data-sticky-shrink="true">
			<div id="header-wrap">
				<div class="container"  style="max-width: none; padding-right: 30px; padding-left: 30px">
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
    									<a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#home"><div>Home</div></a>
    									
    								</li>
    								<li class="menu-item">
                      <a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#ourallies"><div>Authors</div></a>
                      
                    </li>
                     <!--Changes Done : Hemlata-->
				    <!--Date : 28-04-2021-->
				    <!--Reason : change tab name-->
                    <li class="menu-item">
                      <a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#booklaunch"><div>Order Now</div></a>
                      
                    </li>
                    <!--End By : Hemlata-->
    								
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#testimonal"><div>Testimonials</div></a>
    								
    								</li>
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#partners"><div>Partners</div></a>
    									
    								</li>
    
    								
    							</ul>

						    </nav><!-- #primary-menu end -->
				        </div>
				        
				        
				        
				          <div id="logo" style=" margin-right: 0;" >
				           <a href="index.html" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/Rupa.png" alt="Canvas Logo">
				           </a>
				          </div>
				           
				        </div>
				      <div class=" d-flex justify-content-between ">
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
    									<a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#home"><div>Home</div></a>
    									
    								</li>
    								<li class="menu-item">
    									<a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#ourallies"><div>Authors</div></a>
    									
    								</li>
                    <li class="menu-item">
                      <a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#booklaunch"><div>Pre-Order</div></a>
                      
                    </li>

    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#testimonal"><div>Testimonals</div></a>
    								
    								</li>
    								<li class="menu-item mega-menu">
    									<a class="menu-link" href="<?php echo $pages->get("name=equally")->httpUrl; ?>#partners"><div>Partners</div></a>
    									
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
		   
			<div style="position: relative;z-index: 99">
				
				<img style="height:auto; width:100% ;" class="[ img-fluid ][ d-none d-md-block ]" src="<?=$urls->httpTemplates?>images/equally_book_web.jpg">
				<img style="height:auto; width:100% ;" class="[ img-fluid ][ d-block d-md-none ]" src="<?=$urls->httpTemplates?>images/equally_book_mobile.jpg">
			</div>
			
		</div>






			<!--created by :hemlata -->
			<!--Date       : 26-03-2021-->
			<!--Reason     : add new Header and Agenda Table And New Button with icons-->
			
	<div class="container-fluid">
		<div class="accordion-started accordion-bral row">
		    <!--Changes Done : Hemlata-->
				    <!--Date : 28-04-2021-->
				    <!--Reason : hide section-->

			<!--<div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 2rem; margin-bottom: 2rem;">-->
			<!--	<h1 class="text-center">Join us for the online book launch</h1>-->
			<!--	<h5 class="text-center">9th April 2021 | 1:30pm-3:00pm IST</h5>-->
			<!--</div>-->
		
			
			 
			 
			<div class="[ pb-2 pb-md-4 px-3 px-md-5 ] [ container ]" style="margin-top: 2rem;">
			    
			    
			    <!--Code by Amruta Jagtap-->
			    <h1 class="card-title center font-weight-bolder  " style="align-items: center;     margin-top: 1rem;   text-align: center;"><?=$page->general_title;?></h1>
			    
			    <iframe width="560" height="300" src="https://www.youtube.com/embed/<?=$page->youtube_link;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			    
			    
			    <!--<iframe width="560" height="315" src="https://www.youtube.com/embed/pAryn-DuJRs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
			    <!--End Code by Amruta Jagtap-- width="640" height="360">
			    
			     <!--End  by : Hemlata-->
			     
				<!--<h1 class="card-title center font-weight-bolder  " style="align-items: center;     margin-top: -1.5rem;   text-align: center;">AGENDA</h1>-->
			
				<!--<div class="accordion" id="agenda_accordion">-->
			<?php
		
			 $counter = 1;
			
				foreach($page->child("name=agenda-table")->children as $equally_event)
				{
				   
			?>		
			 <!-- <div class="[ my-3 ][ card rounded ]( acc_<?=$counter?> )" style="border-radius: 15px!important;">-->
				<!--<div class="[ p-2 ][ rounded text-center ]( accordion_title )" data-toggle="collapse" data-target="#collapse_<?=$counter?>" aria-expanded="false" id="heading_<?=$counter?>" style="cursor: pointer;">-->
				<!--	  <b><?= $equally_event->equally_event_title?></b>-->
				<!--	  <i class="fa fa-chevron-right"></i>-->
				<!--</div>-->

				<!--<div id="collapse_<?=$counter?>" class="collapse" aria-labelledby="heading_<?=$counter?>" data-parent="#agenda_accordion">-->
				<!--  <div class="[ py-0 ][ card-body text-center ]">-->
				<!--	<?= $equally_event->equally_event_description?>-->
				<!--  </div>-->
				<!--</div>-->
			 <!-- </div>-->
			
			<!-- <div class="container col-sm-12 col-md-12 col-lg-12"  style="padding: 4.5px;  border-radius: 0.5rem;">
				<input class="ac-input" id="ac-1"  name="accordion-1" type="radio" />
				<label class="ac-label text-center acc_<?=$counter?>" for="ac-1" style="color:white;     border-radius: 0.8rem;">
					<?= $equally_event->equally_event_title?><i></i>
				</label>
				<div class="article ac-content acc_<?=$counter?>">
					<div class="row" style="margin-bottom-2rem; "> -->
						<!--<div class="col-md-3">-->
						<!--    <p class="text-justify">-->
									<!--<?= $equally_event->equally_event_description?>-->
			<!--					</p>-->
						<!--</div>-->
						  <!-- <div class="col-md-12" style="border-radius: 0.8rem;">
								<p class="text-justify">
									<?= $equally_event->equally_event_description?>
								</p>
						  </div>
						
					</div>
					
					
				
				</div>
			</div> -->
			 <!--accordion item 1 -- end -->
			<?php
				$counter++;
				}
			?>
					<!--</div>-->



		
			<!--<div class="col-sm-12 col-md-12 col-lg-12">-->
			<!-- accordion item 2 -- start -->
			<!--	<input class="ac-input" id="ac-2" name="accordion-1" type="radio"/>-->
			<!--	<label class="ac-label text-center acc_two" for="ac-2" > EVENT 2<i></i></label>-->
			<!--	<div class="article  acc_two">-->
			<!--		<p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
			<!--	</div>-->
			<!--</div>-->
			<!-- accordion item 2 -- end -->

			<!--<div class="col-sm-12 col-md-12 col-lg-12">-->
			<!-- accordion item 3 -- start -->
			<!--	<input class="ac-input" id="ac-3" name="accordion-1" type="radio" />-->
			<!--	<label class="ac-label text-center acc_three" for="ac-3"> EVENT 3<i></i></label>-->
			<!--	<div class="article  acc_three">-->
			<!--		<p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
			<!--	</div>-->
			<!--</div>-->
			<!-- accordion item 3 -- end -->

			<!--<div class="col-sm-12 col-md-12 col-lg-12">-->
			<!-- accordion item 4 -- start -->
			
			
			<!--	<input class="ac-input" id="ac-4" name="accordion-1" type="radio" />-->
			<!--	<label class="ac-label text-center acc_four" for="ac-4"> EVENT 4<i></i></label>-->
			<!--	<div class="article  acc_four">-->
			<!--		<p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
			<!--	</div>-->
			<!--</div>-->

			<!-- accordion item 4 -- end -->

			<!--<div class="col-sm-12 col-md-12 col-lg-12">-->
			<!-- accordion item 5 -- start -->
			<!--	<input class="ac-input" id="ac-5" name="accordion-1" type="radio" />-->
			<!--	<label class="ac-label text-center acc_five" for="ac-5"> EVENT 5<i></i></label>-->
			<!--	<div class="article  acc_five">-->
			<!--		<p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
			<!--	</div>-->
			<!--</div>-->
			<!-- accordion item 5 -- end -->
			<!--<div class="col-sm-12 col-md-12 col-lg-12">-->
			<!-- accordion item 5 -- start -->
			<!--	<input class="ac-input" id="ac-6" name="accordion-1" type="radio" />-->
			<!--	<label class="ac-label text-center acc_six" for="ac-6"> EVENT 6<i></i></label>-->
			<!--	<div class="article  acc_six ">-->
			<!--		<p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
			<!--	</div>-->
			<!--</div>-->
			<!-- accordion item 5 -- end -->
			<!--<div class="col-sm-12 col-md-12 col-lg-12">-->
			<!-- accordion item 7 -- start -->
			<!--	<input class="ac-input" id="ac-7" name="accordion-1" type="radio" />-->
			<!--	<label class="ac-label text-center acc_seven" for="ac-7"> EVENT 7 <i></i></label>-->
			<!--	<div class="article  acc_seven">-->
			<!--		<p class="text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>-->
			<!--	</div>-->
			<!--</div>-->
			<!-- accordion item 7 -- end -->

		</div>
	</div>
	<div class="content-wrap py-0" style="margin-top:2rem; margin-bottom:2rem;">
				<div class="container">
				    
				    <!--Changes Done : Hemlata-->
				    <!--Date : 28-04-2021-->
				    <!--Reason : hide section-->
				    
					<!--<div class="d-flex justify-content-center" style="text-align:center">-->
					<!--    <h1 style="font-weight:700; margin-top: 3rem">Online Book Launch Event on 9th April 2021,<br/> 1:30pm - 3:00pm IST</h1>-->
						
						
					<!--</div>-->
					<!--<br/>-->
					

	<!--				<div class="[ row ]">-->
	<!--					<div class="[ offset-md-4 col-md-4 ]">-->
	<!--						<a target="_blank" href="https://registrations.ficci.com/ficpri/online-registrationv.asp" class="btn btn-success" style="width: 100%;-->
	<!--height: 50px;    font-size: 22px;">Register Here</a>-->
	<!--					</div>					-->
	<!--				</div>-->
	
	    <!--Changes Done by : Hemlata -->

					<div class="[ row ]">
						<div class="[ offset-md-4 col-md-4 ]">
							<div>
								
							</div>
						</div>
					</div>


					<!-- <center><a target="_blank" href="https://registrations.ficci.com/ficpri/online-registrationv.asp" class="btn btn-success" style="width: 330px;
	height: 50px;    font-size: 22px;">Register Here</a></center> -->
				</div> <br>
						<div class="[ mb-2 d-flex justify-content-center ]">
							<a  target="_blank" style="margin-left: 2px; font-weight:bolder ;" class="spread_text">Spread the Word</a> 
							<?php //echo $job_page->id; 
						   // echo "+++++++++++++++++++++++++++++"; ?>
							
							&nbsp; &nbsp;
						<!-- <div> -->
						
						 <!--   <div id="top-share-button" class="[ card-link ][ text-info btn btn-outline-light ]" data-share-position="bottomCenter" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button"><i class="fas fa-share-alt"></i></span></div>-->
							<!--<button class="btn btn-outline-light text-primary " id="copy_link"   title="abc"><i class="far fa-copy "></i> </button>-->
							<!--<span class="tooltiptext">Tooltip text</span>-->
       <!-- 					<a target="_blank" href="https://api.whatsapp.com/send?text=<?=$job_page->httpUrl?>"><button class="btn btn-outline-light text-success " id="whatsapp_link"><i class="fa fa-whatsapp  "></i> </button></a>-->
				    
							<div id="top-share-button" class="[ mb-3 ][ share_btn text-info btn btn-light  ]" data-share-position="bottomCenter" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin" style="margin-right: 4px;">
								<span class="custom-button"><i class="fa fa-share-alt"></i></span>
							</div>
							
							<!--<div id="share-button-<?=$job_page->id?>" style="" class="[ card-link ][ text-info btn btn-outline-light ]" data-share-position="bottomCenter" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button"><i class="fas fa-share-alt"></i></span></div>-->
							
							<button class="[ mb-3 ] share_btn btn btn-light text-primary " id="copy_link" title="abc" style="margin-right: 4px;"><i class="fa fa-copy "></i> </button>
							<a target="_blank" href="https://api.whatsapp.com/send?text=<?=$page->httpUrl?>"><button class="[ mb-3 ] btn btn-light text-success share_btn" id="whatsapp_link" style="margin-right: 4px;"><i class="fa fa-whatsapp whatsapp_icon "></i> </button></a>
						<!-- </div> -->
						</div>	

						<div class="[ d-block d-md-none ]" style="height: 5rem">
							
						</div>
			
			<!--End by : hemlata -->
			<!--Date   : 26-03-2021-->
			<!--Reason : add new Header and Agenda Table And New Button-->
			
			<section id="content">
			<div class="icon-bar">
			   <a  href="#footer" class="google"><i class="fa fa-envelope-o"></i></a> 
				<a  target="_blank" href="https://instagram.com/pride.allies" class="instagram"><i class="fa fa-instagram"></i></a> 
				<a target="_blank" href="http://www.facebook.com/pride.allies" class="facebook"><i class="fa fa-facebook"></i></a> 
				<a target="_blank" href="https://twitter.com/pride_circle" class="twitter"><i class="fa fa-twitter"></i></a> 
				 <a target="_blank" href="https://www.linkedin.com/company/pride-circle/" class="linkedin"><i class="fa fa-linkedin"></i></a>
				 <a  target="_blank" href="https://www.youtube.com/channel/UCoaAZWnpjFXcCQ5Und9mi0Q" class="youtube"><i class="fa fa-youtube"></i></a> 
			</div>
		</section>
	
	<style>
	.bg-dark {
	background-color: #000000 !important;
}
.btn-outline-light {
	/* color: #f8f9fa; */
	/* background-color: transparent; */
	/* background-image: none; */
	border-color: black;
}
@media (min-width: 992px){
.full-header #logo {
	
	border-right: 0px ;
}
}

</style>

</div>
</div>
	

<footer class="bg-dark text-center text-white" style="margin-bottom:0rem;">
  <!-- Grid container -->
  <!--<div class="container p-4 pb-0">-->
	<!-- Section: Social media -->
   
	<!-- Section: Social media -->
  <!--</div>-->
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="container justify-content-center" style=" padding-top: 2rem;">
	  For any queries, please reach out to us at &nbsp; <a style="color:white;" href="mailto:contact@thepridecircle.com"><u>contact@thepridecircle.com</u></a>
  </div>
   <section class="">
	   
		<!--Twitter -->
	  <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/pride_circle" role="button"
		><i class="fa fa-twitter"></i
	  ></a>
		
		  <!--Linkedin -->
	  <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/company/pride-circle/" role="button"
		><i class="fa fa-linkedin"></i
	  ></a>
	  
		<!--Instagram -->
	  <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/rise4all/" role="button"
		><i class="fa fa-instagram"></i
	  ></a>
	   
	   <!--Facebook -->
	  <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/LetUsAllRise/" role="button"
		><i class="fa fa-facebook-f"></i
	  ></a>

	  
	   <!--Google -->
	  <a target="_blank" class="btn btn-outline-light btn-floating m-1" href="https://www.youtube.com/channel/UCoaAZWnpjFXcCQ5Und9mi0Q" role="button"
		><i class="fa fa-youtube-play"></i
	  ></a>

	  

	 

	</section>
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
   Copyright:  &copy; <?php echo date("Y")?> All Rights Reserved by Pride Circle

  </div>
  <!-- Copyright -->
</footer>

		
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/jquery.js"></script>
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/plugins.min.js"></script>
	<script src="<?=$urls->httpTemplates?>scripts/js_canvas/functions.js"></script>

<script src="<?= $config->urls->templates ?>scripts/needsharebutton.min.js"></script>

	<script>
		new needShareDropdown(document.getElementById("top-share-button"), {
			url: window.location.href,
			title: "equALLY book launch event",
			description: "Click on the link to register now!"
		
		});
	</script>
	<script>
	    $(document).on('click', '#copy_link', function(){
	        //console.log("$page->httpUrl");
            let copy_text="<?php echo $page->httpUrl;?>";
            Clipboard_CopyTo(copy_text);
        });
        function Clipboard_CopyTo(value) {
          var tempInput = document.createElement("input");
          tempInput.value = value;
          document.body.appendChild(tempInput);
          tempInput.select();
          document.execCommand("copy");
          document.body.removeChild(tempInput);
        }
        /*End copy link using js*/
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			// Add minus icon for collapse element which is open by default
			$(".collapse.show").each(function(){
			  //$(this).prev(".accordion_title").find(".fa").addClass("fa-minus").removeClass("fa-plus");
			});
			// Toggle plus minus icon on show hide of collapse element
			$(".collapse").on('show.bs.collapse', function(){
				//$(this).prev(".accordion_title").find(".fa").removeClass("fa-plus").addClass("fa-minus");
				//$(this).prev(".accordion_title").find(".fa").addClass("d-none");
				$(this).prev(".accordion_title").find(".fa").toggleClass("fa-chevron-right fa-chevron-up");
				//$(this).prev(".accordion_title").find(".fa").addClass("chevron-up");
				
				console.log(9393)
			}).on('hide.bs.collapse', function(){

				$(this).prev(".accordion_title").find(".fa").toggleClass("fa-chevron-right fa-chevron-up");
				//$(this).prev(".accordion_title").find(".fa").addClass("chevron-up");
				// $(this).prev(".accordion_title").find(".fa").addClass("chevron-up");
				// $(this).prev(".accordion_title").find(".fa").removeClass("chevron-right"); 

				console.log(939333)
			});
		});
	</script>	
	
	
	
	</body>
</html>
