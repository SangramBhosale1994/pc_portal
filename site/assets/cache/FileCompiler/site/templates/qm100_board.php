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
	
	<!-- seo url by pooja -->
	<!-- ---------- META TAGS ---------- -->
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta property="og:title" content="<?=$page->title?>">
	<meta property="og:image" content="<?=$page->general_image->httpUrl;?>">
	<meta property="og:description" content="<?=$page->og_description?>">
	<meta property="og:url" content="<?=$page->httpUrl?>">
 
	<meta name="twitter:title" content="<?=$page->title?>">
	<meta name="twitter:description" content="<?=$page->og_description?>">
	<meta name="twitter:image" content="<?=$page->general_image->httpUrl;?>">
	<meta name="twitter:card" content="<?=$page->og_title?>">
 
	<meta property="og:site_name" content="">
	<meta name="twitter:image:alt" content="<?=$page->general_image->httpUrl;?>">
	<!-- ---------- META TAGS END ---------- -->

    <!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=$urls->httpTemplates;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?=$urls->httpTemplates;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page-Specific Style CSS -->
	<link href="<?=$urls->httpTemplates;?>styles/job-list.css?v=21.04.22" rel="stylesheet" type="text/css">
	<!-- Share button CSS -->
	<link rel="stylesheet" href="<?=$urls->httpTemplates;?>styles/needsharebutton.min.css">
	
	<link rel="stylesheet" href="<?=$urls->httpTemplates;?>styles/fm.tagator.jquery.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
	
	<!-- Need Share button CSS  -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/needsharebutton.min.css">
	
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $urls->httpTemplates;?>scripts/jquery.min.js" type="text/javascript"></script>

	<script src="<?=$urls->httpTemplates?>scripts/<?php echo $page->template;?>.js?v=21.04.22.2"></script>
	<!-- Popper Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/popper.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
	<script src="<?= $urls->httpTemplates;?>scripts/fm.tagator.jquery.js"?v=19.02></script>
	
	<!-- ---------- JS LINKS END ---------- -->
	
	
	

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
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/style_edu_summit.css" type="text/css" />
	<!--<link rel="icon" href="<?=$urls->httpTemplates?>favicon.png" type="image/x-icon">-->
	
	<link rel="shortcut icon" type="image/png" href="<?=$urls->httpTemplates?>images/frontend/favicon.png"/>
	<link rel="icon" href="<?=$urls->httpTemplates?>images/index.png" sizes="32x32" />
	
	<!--new stylesheet file-->
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/style_edu_summit.css" type="text/css" />

    <!-- stylesheet by pooja for 100qi.css file path  -->
    <link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/100qi.css" type="text/css" />

    

    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title><?=$page->title;?></title>
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
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
	

    <!-- Google tag (gtag.js) -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-C3XCR831MS');
    </script> -->
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
				           <a href="https://www.thepridecircle.com/" target="_blank" class="standard-logo" class="img-responsive"  data-dark-logo="<?=$urls->httpTemplates?>images/images_canvas/logo1.png"><img  style="height: 70px; width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
				           </a>
				           
				        </div>
				        <div>
				            <!--web view navigation bar-->
				           <nav class="primary-menu2">
    							<ul class="menu-container">
                                    <li class="menu-item"><a target="_blank" class="menu-link" href="https://www.thepridecircle.com/"><div>PRIDE CIRCLE</div></a></li>
    								<li class="menu-item"><a class="menu-link" href="<?=$page->httpUrl;?>#about-us"><div>#100QueerInterns</div></a></li>
                                    <li class="menu-item"><a class="menu-link" href="<?=$page->httpUrl;?>#agenda"><div> Apply Now</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#speakers"><div>Hiring Partners</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#FAQs"><div>FAQS</div></a></li>
                                    <li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#contact_us"><div>CONTACT US</div></a></li>
    							</ul>
						    </nav><!-- web view navigation bar end -->
				        </div>
				    </div>
				      <div class="d-flex justify-content-between ">
				        <div id="logo" style=" margin-right: 0;" >
    				           <a href="https://www.thepridecircle.com/" target="_blank" class="retina-logo img-responsive" data-dark-logo="images/images_canvas/logo1.png"><img  style=" width: auto; padding: 10px" src="<?=$urls->httpTemplates?>images/images_canvas/logo1.png" alt="Canvas Logo">
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
    								<li class="menu-item"><a target="_blank" class="menu-link" href="https://www.thepridecircle.com/"><div>PRIDE CIRCLE</div></a></li>
    								<li class="menu-item"><a class="menu-link" href="<?=$page->httpUrl;?>#about-us"><div>#100QueerInterns</div></a></li>
                                    <li class="menu-item"><a class="menu-link" href="<?=$page->httpUrl;?>#agenda"><div> Apply Now</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#speakers"><div>Hiring Partners</div></a></li>
    								<li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#FAQs"><div>FAQS</div></a></li>
                                    <li class="menu-item mega-menu"><a class="menu-link" href="<?=$page->httpUrl;?>#contact_us"><div>CONTACT US</div></a></li>
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
				<a href="<?=$page->banner_image->description;?>" target="_blank"><img style="" class="img-fluid" src="<?=$page->banner_image->httpUrl;?>" ></a>
			</div>
			<!--end-->
			<!--mobile view banner-->
			<div class="img-responsive  mobile" >
					<a href="<?=$page->Banner_image_mobile->description;?>" target="_blank"><img  class="img-fluid"  src="<?=$page->Banner_image_mobile->httpUrl;?>"> </a>
			</div> 
			<!--end-->
			<div id="about-us"></div>
        </section>
		<!--banner section end-->
	
		
		<!--paragraph section-->
            <section id="about-us" class="mt-6">
            	<div class="content-wrap" id="about_rise">
            		<div class="container">
            			<div class="title_new heading-block center border-bottom-0 mb-0">
            				<h3 style="#000033;font-style: italic;" class="mb-4"><?=$page->heading1;?></h3>
            				<div><?=$page->text_description;?></div>	
            			</div>
            		</div>
            	</div>
            </section>
            <!--paragraph end-->
            
            
            <!--icons section-->
            <section id="" class="">
                <div class="container clearfix ">
                    <div class="title_new heading-block center border-bottom-0 mb-0">
                    <h3 style="#000033;" class="mb-4 mt-5"><?=$page->year_of_passing;?></h3>
                    </div>
					<div class="row col-mb-50 px-lg-5">
						<div class="col-sm-6 col-lg-6">
							<div class="feature-box fbox-effect">
								<div class="fbox-icon">
									<a href="#"><img src="<?=$page->aim_logo->httpUrl;?>" alt="" ></a>
								</div>
								<div class="title_new fbox-content">
									<p><?=$page->word_cloud_data_array;?></p>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="feature-box fbox-effect">
								<div class="fbox-icon">
									<a href="#"><img src="<?=$page->aim_logo1->httpUrl;?>" alt="" ></a>
								</div>
								<div class="title_new fbox-content">
									<p><?=$page->word_to_exclude;?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
            </section>
            <!--icon section end-->

            
            <!-- jobs cards section by pooja -->
            <section id="jobs" class="mb-5">
                    <div class="title_new heading-block center border-bottom-0 mb-0 mt-6">
                        <h3 style="#000033;" class="mb-4"><?=$page->general_title;?></h3>
                    </div>
                    <div class="container mt-4 mb-4">
                        <div class="[ row ] justify-content-center">

                                <?php
                                    /* Job postings in the descending order od the day they were posted. Latest first. */
                                    $i=1;

                                    if(isset($filter_selector)){
                                        $cards_filter=$filter_selector;
                                    }
                                    $filtered_job_pages=$pages->get("name=100qi")->children("limit=6"."active_status=active");
                                    if($filtered_job_pages->count()==0){
                                        echo "<h3 class='text-center m-auto'>No results found</h3>";
                                    }
                                    $job_page_counter = 0;

                                    foreach ($filtered_job_pages as $job_page) {
                                        if($job_page->max_experience !=0 && isset($experience_years)){
                                            if($experience_years>$job_page->max_experience){
                                                continue;
                                            }
                                            
                                        }
                                            if($job_page->job_publish_shedule!=""){
                                            if($job_page->job_publish_shedule>time()){
                                                continue;
                                            }
                                        }

                                        $job_page_counter++;

                                        $is_visible = "";
                                    ?>

                                    <div class="( job-card-container )[ my-3 ][ <?=$job_page_counter?> ][ col-md-6  col-lg-4  ]" style="<?=$is_visible?>">
                                        <div class="[ card ]">
                                            <?php
                                                /* Add NEW badge for the first ten job postings */
                                                if(time()-$job_page->created <15*24*60*60){ 
                                            ?>
                                                <span class="[ px-3 ][ badge badge-danger ]" style="position: absolute; right:41%; top:-0.6rem;  font-size: 0.9rem; font-weight: 600; padding-bottom: 0.3rem">NEW</span>
                                            <?php
                                            }
                                            ?>

                                            <div class="card-body">
                                                
                                                <!--Sameesh yadav for 6-march-2021to add image in card of jobs-->
                                                <div class="container p-0 m-0">
                                                    <div class="row align-items-center" style="   height:98px;overflow: hidden ">
                                                        <?php
                                                        /**
                                                        * firt check if image in job page if null then add default vaue
                                                        * $image to store image url
                                                        */
                                                        if ($job_page->job_image != null) {
                                                            $image = $job_page->job_image->httpUrl;
                                                        } else {
                                                            $image = $urls->httpTemplates . "images/job_card_Logo_new.png";
                                                        }
                                                        ?>
                                                        <img src="<?=$image ?>" class="mx-auto" alt="Image" style="max-height: 78px; width:auto">
                                                    </div>
                                                </div>
                                                <!--code ends here-->
                                                <h5 class="job-card-primary-text [ card-title ]" style="white-space: wrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em; height:2.6em;"><?=htmlspecialchars_decode(htmlspecialchars_decode($job_page->title))?></h5>

                                                <h6 class="job-card-secondary-text [ mb-0 ][ card-subtitle text-muted ]" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em"><?=$job_page->company_name?>
                                                    <br>Posted on <?=date("d M Y", $job_page->created)?>
                                                </h6>

                                                <!--/* Existing system user experience save to experience field but in new system minimum experience save in min_experience field and maximum experience save in max_experience field . 
                                                    so existing system experience saving min and max experience field */-->
                                            
                                                <?php $job_location=array_map('trim', array_filter(explode(",",$job_page->location)));$job_location=implode(", ",$job_location); ?>

                                                <p class="card-text" style="color:#333">
                                                <!-- <i class="[  mr-1 ][ text-info ] icon-clock1"></i> <?=$job_page->min_experience?><?php if($job_page->max_experience!=0) echo "-".$job_page->max_experience?> Month<?php if($job_page->min_experience!=1) echo 's';?> -->
                                                 <br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt"></i>  <?=$job_location?><br><i class="[ mr-1 ][ text-info ] fas fa-fw fa-eye"></i> <?php echo date("H", $job_page->created)+date("H", time())?> Views Today</p>
                                                <p class="card-text"><span class="badge badge-info"><i class="[  mr-1 ] fas fa-fw fa-qrcode"></i> <?=$job_page->job_code?></span></p>
                                                <hr>

                                                <div class="[ d-flex justify-content-between ]">
                                                    <a href="<?=$job_page->httpUrl?>" target="_blank" style="margin-left: -10px" class="btn purple">Know more</a>
                                                    <div id="share-button-<?=$job_page->id?>" style="" class="[ card-link ][ text-info btn btn-outline-light ]" data-share-position="bottomCenter" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button"><i class="fas fa-share-alt"></i></span></div>
                                                    <button class="btn btn-outline-light text-primary copy_link" id="copy_link"   title="<?=$job_page->httpUrl?>"><i class="far fa-copy "></i> </button>
                                                    <a target="_blank" href="https://api.whatsapp.com/send?text=<?=$job_page->httpUrl?>"><button class="btn btn-outline-light text-success " id="whatsapp_link"><i class="fa fa-whatsapp  "></i> </button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    $i++;
                                    }
                                    ?>

                        </div>
                    </div>

                    <div class="center mt-3">
                        <a href="<?=$pages->get('name=jobs')->httpUrl;?>" target="_blank" class="btn1 purple"><?=$page->leaderboard_title;?></a>
                    </div>
                </section>
            <!-- jobs cards section end -->
       	
       	    <!--cards section-->
               <?php
                if($page->winner_title!=""){
                ?>
                <section id="content" class=" container_style">
                            <div class="container">
                                <div class="title_new heading-block center border-bottom-0 mb-0">
                                    <h3 class="mb-4 mt-6"><?=$page->winner_title;?></h3>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 tickets_column">
                                        <div class="card" style="">
                                        <div class="card-body">
                                            <div class="center">
                                                <img src="<?=$page->covid_19_banner->httpUrl;?>" alt="Memebers" width="120" class="center mb-2">
                                                <!--<h5 class="font-weight-medium"><a href="demo-forum-profile.html">Jim Séchen</a></h5>-->
                                            </div>
                                        <h2 class="title_new card-title card_text_alignmnet text-center "><?=$page->winners_title_color;?></h2>
                                        <div  class="card-height center" style="color:#333"><?=$page->unlocked_profiles_array;?></div>
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
                                        <h2 class="title_new card-title card_text_alignmnet text-center "><?=$page->whatsapp_number;?></h2>
                                        <div class="card-height center" style="color:#333"><?=$page->ticketing_vip_thankyou;?></div>    
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
                                        <h2 class="title_new card-title card_text_alignmnet text-center "><?=$page->whatsapp_country_code;?></h2>
                                        
                                        <div class="card-height center" style="color:#333"><?=$page->ticketing_vip_event_description;?></div>   
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>            	
                </section>
                <?php
                }else{
                    ?>

                <?php
                    }
                    ?>
            <!--cards section end-->
            
            <!--Agenda section-->
            <div id="agenda"></div>
            <section class="spacing_riseref spacing_riseref1 section_style ">
			    <div class="content-wrap py-0" style="margin-bottom: -2rem !important;">
                    <div class="container-fluid">
                        <div class="title_new heading-block center border-bottom-0 mb-0">
                           <h3 style="#000033;" class="mb-4 mt-6"><?=$page->ally_challenge_resource_locator;?></h3>
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
                <div class="title_new heading-block center border-bottom-0 mb-0 mt-5">
                    <p style="font-style: italic;"><?=$page->ticketing_title_toshow;?></p>
                </div>
                <div class="center mt-4">
                    <a href="<?=$page->heading9;?>" target="_blank" class="btn1 purple"><?=$page->bank_name;?></a>
                </div>
            </section>

            

			<div id="speakers"></div>
		    </section>
            <!--agenda section end-->
        
                    <!--speakers section-->
            <?php
                if($page->ally_challenge_leaderboard_timestamp!=""){
                ?>
            <section class="">
				<div id="section-multipage" class="page-section center bg-transparent mb-0 clearfix">
					<div class="px-5 container-fluid" style="max-width: 1600px">
						<div class="title_new heading-block center border-bottom-0 mb-0">
                                <h3 class="mb-4 mt-6"><?=$page->ally_challenge_leaderboard_timestamp;?></h3>
                        </div>

						<?php 
                        foreach($page->speakers_section as $speakers_section)
                        {
                        ?>
                        <div class="title_new heading-block center border-bottom-0 mb-0">
                           <h4 class="mb-4"><?=$speakers_section->title;?></h4>
                        </div>
						<div id="intro-multipages-container" class="row col-mb-50 mb-3 justify-content-center">
						    <?php 
                            foreach($speakers_section->speakers_information as $speakers_information)
                            {
                            ?>
							<div class="grid-intro-item col-lg-1-5 col-md-4 col-sm-6 col-12">
								<div class="portfolio-item">
									<div class="portfolio-image  rounded-lg">
										<img src="<?=$speakers_information->ally_banner_mobile_image->httpUrl;?>" alt="Speakers">
									</div>
									<div class="portfolio-desc center pb-0">
										<a href="<?=$speakers_information->active_status;?>" target="_blank">
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
            <?
            }else{
            ?>
            
            <?
            }
            ?>
            <!--speaker end-->
            
            
            <!--sponsors and partner section-->
            <?php
                if($page->ally_social_media_title!=""){
                ?>
            <section class="">
                <div class="title_new heading-block center border-bottom-0 mb-0 ">
                    <h3 style="#000033;" class="mb-4 mt-6"><?=$page->ally_social_media_title;?></h3>
                </div>
                
                <?php 
                    foreach($page->multiple_sponsors_repeater as $multiple_sponsors_repeater)
                    {
                    ?>
                <div class="title_new heading-block center border-bottom-0 mb-0 ">
                    <h4 style="#000033;" class="mb-4"><?=$multiple_sponsors_repeater->title;?></h4>
                </div>
				<div class="container mt-3">
				      <ul class="clients-grid grid-2 grid-sm-3 grid-md-5 mb-0 justify-content-center">
				          <?php 
                            foreach($multiple_sponsors_repeater->speakers_repeater as $speakers_repeater)
                            {
                            ?>
                
						   <li class="grid-item hover-effect"><a href="<?=$speakers_repeater->ally_banner_image->description;?>" style="opacity: 1;"><img src="<?=$speakers_repeater->ally_banner_image->httpUrl;?>" alt="Sponsors"></a></li>
						   <?
                            }
                            ?>
				      </ul>
			
				</div>
				<?
                }
                ?>
                <!--sponsors section end-->
            </section>
            <?
            }else{
            ?>
            
            <?
            }
            ?>
            
            
                <style>
                    .nott p{
                        margin-bottom: 0px !important;
                    }
                </style>
                
            <!--div section-->
            <section id="contact_us">
                <div class="promo promo-full mt-6 ">
                    <div class="container">
                        <div class="row justify-content-center" style="border: 3px solid #502a75;border-radius: 10px;padding:35px;">
                            <div class="heading-block center border-bottom-0 mb-0">
                                <div class="nott" style="color:#333"><?=$page->ally_challenge_resource_description;?></div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--div section end-->
            
			<!--partner section-->
			
			<?php
                if($page->job_type!=""){
                ?>
			<section id="">
			    <div class="content-wrap">
			    <div class="title_new heading-block center border-bottom-0 mb-0 mt-6">
                    <h3 style="#000033;" class="mb-4"><?=$page->job_type;?></h3>
                </div>
				<div class="container mt-3">
				    <div class="row">
					<div id="oc-images" class="partners_slider owl-carousel image-carousel carousel-widget" data-items-xs="2" data-items-sm="3" data-items-lg="4" data-items-xl="5">
                        <?php 
                                foreach($page->partners_repeater as $repeater)
                                {
                                ?>
        						<div class="oc-item">
        							<a href="<?=$repeater->ally_banner_image->description;?>"><img src="<?=$repeater->ally_banner_image->httpUrl;?>" alt="Image"></a>
        						</div>
						        <?
                                }
                                ?>
					</div>
					</div>
				</div>
				</div>
			</section>
			<?
            }else{
            ?>
            
            <?
            }
            ?>
				<!--end-->
			<!--sponsors and partner section end-->    
            
            
            
        
			<!--frequently asked questions-->

			<section id="FAQs">
                <div class=" mt-lg-6 mt-4 mb-5">
                    <div class="" >
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-4 ">
                                    <h3 class="mt-2 center" style="margin: 0 0 0px 0;color:#333;"><?=$page->covid_19_title;?></h3>
                                </div>
                                <div class="col-12 col-lg-3 mt-4 mt-lg-3 center">
                                    <a target="_blank" href="<?=$page->active_status;?>" class="btn1 purple">Download</a>
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
              
								<a target="_blank" href="<?=$page->heading2;?>" class="social-icon si-small si-borderless si-linkedin">
									<i class="white-color icon-linkedin" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-linkedin" style="font-size: 1.5rem;"></i>
								</a>
								<a target="_blank" href="<?=$page->heading3;?>" class="social-icon si-small si-borderless si-instagram">
									<i class="white-color icon-instagram" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-instagram" style="font-size: 1.5rem; background: #f09433;background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );"></i>
								</a>
                <a target="_blank" href="<?=$page->heading4;?>" class="social-icon si-small si-borderless si-facebook">
									<i class="white-color icon-facebook" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-facebook" style="font-size: 1.5rem;"></i>
								</a>
                <a target="_blank" href="<?=$page->heading5;?>" class="social-icon si-small si-borderless si-gplus">
									<i class="white-color icon-line2-social-youtube" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-line2-social-youtube" style="font-size: 1.5rem;"></i>
								</a>
								<a target="_blank" href="<?=$page->heading6;?>" class="social-icon si-small si-borderless si-twitter">
									<i class="icon-twitter" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-twitter" style="font-size: 1.5rem;"></i>
								</a>
								<a target="_blank"  href="<?=$page->heading7;?>" class="social-icon si-small si-borderless  si-tripadvisor">
									<i class="white-color icon-line-link" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-line-link" style="font-size: 1.5rem; background-color:#28BF7B;"></i>
								</a>
								<a target="_blank" href="mailto:<?=$page->heading8;?>" class="social-icon si-small si-borderless si-pinterest">
									<i class="white-color icon-email3" style="color:#ffffff;font-size: 1.5rem;"></i>
									<i class="icon-email3" style="font-size: 1.5rem;"></i>
								</a>
								
								<!--<a target="_blank" href="https://linktr.ee/PrideCircle" class="linktree"><i class="fa fa-fw fa-link" aria-hidden="true"></i></a>-->
							</div>

							<div class="clear"></div>

						</div>
						<div class="white-color col-md-12 center mt-4" style="color:#ffffff;">
						<!-- Developed by <a target="_blank" style="color:#ffffff;" href="https://zerovaega.com/">Zerovaega Technologies</a><br> -->
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
const newYearTime = new Date(`December 29 2021 15:00:00`);

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

<!-- js by pooja for job cards  -->

<script src="<?=$urls->httpTemplates?>scripts/needsharebutton.min.js"></script>
	<script>
		
		<?php
			foreach ($filtered_job_pages as $job_page) {
		?>

		new needShareDropdown(document.getElementById("share-button-<?=$job_page->id?>"), {
		    //console.log($job_page->id);
			url: "<?=$job_page->httpUrl?>",
			title: "Check this job opening on Pride Cricle now!",
			description: "Click on the link and log in to apply."
		});

		<?php
			}
		?>

	</script>
	
		<script>	
            $(document).on('click', '.copy_link', function(){
                //console.log("$page->httpUrl");
                var job_page_url=$(this).attr("title");
            // console.log(job_page_url);
                let copy_text=job_page_url;
                //console.log(copy_text);
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
<!-- Linkedin code -->
<script type="text/javascript"> _linkedin_partner_id = "3744588"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=3744588&fmt=gif" /> </noscript>
	<!-- End Linkedin code -->
</body>
</html>

