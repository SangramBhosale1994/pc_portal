<?php 
 include(\ProcessWire\wire('files')->compile('includes/hackathon_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); 

	if (isset($_POST['btn_hackathon_submit'])) {
			// echo "111111"; // Debugging statement

			$session_user_id = $session->user_id;
			$candidate_page = $pages->get($session_user_id);

			// Define the temporary path to upload the file before saving the files to the CMS page
			$upload_path = $config->paths->assets;

			// 		/** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
			$contact_photo = new \ProcessWire\WireUpload('solution_file');

			// 		/** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
			$contact_photo->setMaxFiles(50);
			$contact_photo->setOverwrite(true);
			$contact_photo->setDestinationPath($upload_path);
			$contact_photo->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif','xls', 'xlsx','pdf', 'docx', 'doc', 'ppt', 'pptx'));

			// 		/** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
			$files = $contact_photo->execute();
			$uploadedFiles = array('dummy.txt'); // Manually added file
			$all_files=array_merge($uploadedFiles,$files);

			// 			/**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
			// 			$award_files="award_{$section_number}_files";

			//  print_r($all_files);
			//  echo "------11-----";
			// $counter=0;
			foreach($all_files as $filename) {
				$pathname = $upload_path . $filename;
		
				// echo $counter;
				// echo "++++++++";
				// echo $pathname;
				// echo "-----------";
				
				$candidate_page->hackathon_files->add($pathname);
				// print_r($candidate_page->hackathon_files);
				// echo $candidate_page->hackathon_files->count();
						$candidate_page->of(false);
						$candidate_page->save();
						// echo "after saving............";
						// echo $candidate_page->hackathon_files->count();
						// echo "**************";
						// print_r($candidate_page->hackathon_files);
						// echo "after.....";
						// 	$company_profile_page->message("Added file: $filename");
				// unlink($pathname);
				// }
				// $counter++;
			}
						
			// 		// }
			// 		/* Uploading and saving of profile image END */		
			// 	}
			// }
			// Save the candidate profile page
			$candidate_page->of(false);
			$candidate_page->save();

			header("Location: $page->httpUrl");
    exit();

			
	}


?>
<style>
	/* css by pooja for agenda section green color piles */
	.green-piles {
		padding: 11px 5px 11px 5px !important;
		border: 1px solid rgb(255 255 255) !important;
		background: #00a04a !important;
		margin: 0px 7px 0px 7px !important;
		text-align: center !important;
		border-radius: 5px !important;
		color: #fff !important;
	}

	.green-piles h5 {
		color: #fff !important;
		margin-bottom: 0px !important;
		margin: 0 0 0px 0 !important;
	}

	.agenda-spacing h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		margin: 0 0 0.5rem 0 !important;
	}

	/* css by pooja for event passes cards  */
	@media (max-width: 767px) {
		.event-passes-ul-style ul {
			margin-left: 4rem;
		}
	}

	@media only screen and (max-width: 992px) and (min-width: 768px) {
		.event-passes-ul-style ul {
			margin-left: 5rem;
		}
	}

	@media (min-width: 992px) {
		.event-passes-ul-style ul {
			margin-left: 12rem;
		}
	}

	/* css by pooja for ul tag */
	::marker {
		color: #ffffff !important;
	}

	/* .event-passes-card h1, h2, h3, h4, h5, h6{
	color: #fff;
}  */

	/* css by pooja for header pride circle logo */
	@media only screen and (max-width: 568px) and (min-width: 320px) {
		.header-misc {
			margin-left: 0px !important;
		}
	}

	::marker {
		color: #000033 !important;
	}

	.event_passes_card ::marker {
		color: #ffffff !important;
	}

	@media only screen and (max-width: 1366px) and (min-width: 1024px) {
		.cards-text {
			height: 21rem !important;
		}
	}

	@media only screen and (max-width: 992px) and (min-width: 768px) {
		.cards-text {
			height: 28rem !important;
		}
	}

	@media only screen and (max-width: 1366px) and (min-width: 1024px) {
		.important-text {
			height: 7rem !important;
		}
	}

	@media (min-width: 993px) {
		.cards-text {
			height: 22rem !important;
		}
	}
	@media (min-width: 993px) {
		.important-text {
			height: 7rem !important;
		}
	}

	.heading-fonts h3{
		font-size: 1.3rem !important;
	}


	/*Css By Amruta*/
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
	.card_job_fair h3{
		margin:0px 0px 30px 0px !important;
	}
	.card_job_fair p{
		margin-bottom:30px!important;
	} 

	@media only screen and (min-device-width: 768px) and (max-device-width: 991px) {
				/*Amruta*/
		
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
	@media only screen and (min-width: 252px) and (max-width: 264px)
	{
		.card_job_fair{
				height:31rem;
		}
	}
	/*End code by Amruta*/
	
	/* css by pooja for removing opacity */
	.clients-grid .grid-item a {
		opacity: 1 !important;
	}

	/* Countdown timer css code by Amruta */

	#countdown{
		width: 465px;
		height: 160px;
		text-align: center;
		background: #222;
		background-image: -webkit-linear-gradient(top, #222, #333, #333, #222); 
		background-image:    -moz-linear-gradient(top, #222, #333, #333, #222);
		background-image:     -ms-linear-gradient(top, #222, #333, #333, #222);
		background-image:      -o-linear-gradient(top, #222, #333, #333, #222);
		border: 1px solid #111;
		border-radius: 5px;
		box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.6);
		margin: auto;
		padding: 24px 0;
		/* position: absolute; */
		position: relative;
		top: 0; bottom: 0; left: 0; right: 0;
	}

	#countdown:before{
		content:"";
		width: 8px;
		height: 65px;
		background: #444;
		background-image: -webkit-linear-gradient(top, #555, #444, #444, #555); 
		background-image:    -moz-linear-gradient(top, #555, #444, #444, #555);
		background-image:     -ms-linear-gradient(top, #555, #444, #444, #555);
		background-image:      -o-linear-gradient(top, #555, #444, #444, #555);
		border: 1px solid #111;
		border-top-left-radius: 6px;
		border-bottom-left-radius: 6px;
		display: block;
		position: absolute;
		top: 48px; left: -10px;
	}

	#countdown:after{
		content:"";
		width: 8px;
		height: 65px;
		background: #444;
		background-image: -webkit-linear-gradient(top, #555, #444, #444, #555); 
		background-image:    -moz-linear-gradient(top, #555, #444, #444, #555);
		background-image:     -ms-linear-gradient(top, #555, #444, #444, #555);
		background-image:      -o-linear-gradient(top, #555, #444, #444, #555);
		border: 1px solid #111;
		border-top-right-radius: 6px;
		border-bottom-right-radius: 6px;
		display: block;
		position: absolute;
		top: 48px; right: -10px;
	}

	#countdown #tiles{
		position: relative;
		z-index: 1;
	}

	#countdown #tiles > span{
		width: 92px;
		max-width: 92px;
		font: bold 48px 'Droid Sans', Arial, sans-serif;
		text-align: center;
		color: #111;
		background-color: #ddd;
		background-image: -webkit-linear-gradient(top, #bbb, #eee); 
		background-image:    -moz-linear-gradient(top, #bbb, #eee);
		background-image:     -ms-linear-gradient(top, #bbb, #eee);
		background-image:      -o-linear-gradient(top, #bbb, #eee);
		border-top: 1px solid #fff;
		border-radius: 3px;
		box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.7);
		margin: 0 7px;
		padding: 18px 0;
		display: inline-block;
		/* position: relative; */
	}

	#countdown #tiles > span:before{
		content:"";
		width: 100%;
		/* height: 13px; */
		background: #111;
		display: block;
		padding: 0 3px;
		/* position: absolute; */
		top: 41%; left: -3px;
		z-index: -1;
	}

	#countdown #tiles > span:after{
		content:"";
		width: 100%;
		height: 1px;
		background: #eee;
		border-top: 1px solid #333;
		display: block;
		position: absolute;
		top: 48%; left: 0;
	}

	#countdown .labels{
		/* width: 100%;
		height: 25px;
		text-align: center;
		position: absolute;
		bottom: 8px; */
	}

	#countdown .labels li{
		width: 102px;
		/* font: bold 15px 'Droid Sans', Arial, sans-serif; */
		color: #f47321;
		text-shadow: 1px 1px 0px #000;
		text-align: center;
		text-transform: uppercase;
		display: inline-block;
	}
</style>

<!-- web view slider by pooja -->
<section id="" class="hide-image-in-mobie slider-element boxed-slider">
	<div class=" clearfix">
		<div class="fslider" data-animation="fade">
			<div class="flexslider">
				<div class="slider-wrap">
					<?php
					foreach ($page->Banner_repeater as $Banner_repeater) {
					?>
						<div class="slide" data-thumb="<?= $Banner_repeater->banner_image->httpUrl; ?>">
							<a href="<?= $Banner_repeater->banner_image->description; ?>" class="d-block position-relative">
								<img src="<?= $Banner_repeater->banner_image->httpUrl; ?>" alt="Slide 2">

							</a>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<!--web view slider end  -->

<!-- mobile view slider by pooja -->
<section id="" class="hide-image-in-web slider-element boxed-slider">
	<div class=" clearfix">
		<div class="fslider" data-animation="fade">
			<div class="flexslider">
				<div class="slider-wrap">
					<?php
					foreach ($page->mobile_banner_repeater as $mobile_banner_repeater) {
					?>
						<div class="slide" data-thumb="<?= $mobile_banner_repeater->banner_image->httpUrl; ?>">
							<a href="<?= $mobile_banner_repeater->banner_image->description; ?>" class="d-block position-relative">
								<img src="<?= $mobile_banner_repeater->banner_image->httpUrl; ?>" alt="Slide 2">
							</a>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- mobile view
		 slider end  -->


<!-- second header
		============================================= -->
<section id="content">
	<?php
	if (false) {
	?>
		<div class="content-wrap">

			<div class="promo promo-full mt-5 mb-5">
				<div class="container-fluid">
					<div class="header_tabs justify-content-center flex-container" style="text-align: center;">
						<!-- <a class="flex-spacing right-margin-header" target="_blank" href="https://www.thepridecircle.com/"><button type="button" class="btn btn-outline-primary-new  ">PRIDE CIRCLE</button></a> -->
						<a class="flex-spacing right-margin-header" href="https://www.thepridecircle.com/"><button type="button" class="btn btn-outline-primary-agenda ">PRIDE CIRCLE </button></a>
						<a class="flex-spacing right-margin-header" href="#agenda_table"><button type="button" class="btn btn-outline-primary-ep ">RISE2022</button></a>
						<a class="flex-spacing right-margin-header" href="#speakers"><button type="button" class="btn btn-outline-primary-speakers button_alignment">AGENDA</button></a>
						<a class="flex-spacing right-margin-header" href="#sponsors"><button type="button" class="btn btn-outline-primary-sp button_alignment">SPEAKERS</button></a>
						<a class="flex-spacing right-margin-header" href="#tickets"><button type="button" class="btn btn-outline-primary-pc  button_alignment">SPONSORS</button></a>
						<a class="flex-spacing right-margin-header" href="#sponsors_contact"><button type="button" class="btn btn-outline-primary-gallery button_alignment">EVENT&nbspPASSES</button></a>
						<a class="flex-spacing right-margin-header" href="#sponsors_contact"><button type="button" class="btn btn-outline-primary-speakers button_alignment">PAST EDITIONS</button></a>
						<a class="flex-spacing right-margin-header" href="#rise2021faq"><button type="button" class="btn btn-outline-primary-sp button_alignment">TESTIMONIAL</button></a>
						<a class="flex-spacing right-margin-header" href="#about_rise"><button type="button" class="btn btn-outline-primary-agenda ">FAQ</button></a>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>


	<!-- Code by Amruta - Countdown Timer code -->
	<div id="countdown" class="mt-5">
		<div id='tiles'>
			<!-- <span>01</span>
			<span>01</span>
			<span>01</span>
			<span>01</span> -->
		</div>
		<div class="labels">
			<li>Days</li>
			<li>Hours</li>
			<li>Mins</li>
			<li>Secs</li>
		</div>
	</div>
	<!-- End Code by Amruta - Countdown Timer code -->
	<!-- Code by Amruta - Timeline and Pointers section -->
	<!-- <div id="timeline_pointers" class="mt-5">
		<?=$page->timeline_and_pointers?>
	</div> -->
	<div class="content-wrap [ mt-5 ]" id="about_rise">
		<div class="container">
			<div style="text-transform: none;" class="title_new heading-block  border-bottom-0 mb-5"><?= $page->timeline_and_pointers; ?></div>
		</div>
	</div>
	<!-- End Code by Amruta - Timeline and Pointers section -->

	<!-- paragraph section  -->
	<div class="content-wrap [ mt-5 ]" id="about_rise">
		<div class="container">
			<div style="text-transform: none;" class="title_new heading-block  border-bottom-0 mb-5"><?= $page->text_description; ?></div>
		</div>
	</div>
	<!-- paragraph section end -->

	<!-- Hackathon Register button section -->
	<?php
	// $session->hackps_candidate_registration=true;
	// echo $session->hackps_candidate_registration;
	// echo "<pre>";
	// var_dump($_SESSION);
	// echo "----------------------------------------------------";
	// print_r($_SESSION);
	// echo "<pre>";
	$candidate_page=$pages->get($session->user_id);
	// echo $session->user_id;
	// echo $session->user_email;

	// echo "trueeee";
	if($session->hackps_candidate_registration=="true" || $candidate_page->hackathon_verification!="" || $candidate_page->hackathon_interested=="Yes"){
		// echo $candidate_page->hackathon_verification;
		// echo "iff";
		// echo $candidate_page->id;
		if($candidate_page->hackathon_verification=="verified"){
			// echo "222";
			
			if($candidate_page->hackathon_files->count()!=0){
				// echo "count";
				?>
				<div class="mt-5">
					<div id="faq"></div>
					<div class="container">
						<div class="mt-5 promo promo-border p-4 p-md-5 mb-6">
							<div class="row align-items-center faq-text-center">
								<div class="col-12 col-lg text-center">
									<h3>Thank you for uploading Hackathon Problem solutions!!</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			else{
				// echo "count else";
		?>
		
	  <div class="mt-5">
			<div id="faq"></div>
			<div class="container">
				<div class="mt-5 promo promo-border p-4 p-md-5 mb-6">
					<div class="row align-items-center faq-text-center">
						<div class="col-12 col-lg">
							<h3>Hackathon Problem statements</h3>
							<div class="">
							<form  id="" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label class="control-label col-12" for="solution_file" style="letter-transform:lowercase;">Please upload your solutions</label>
									<div class="col-sm-10">
										<input type="file" class="form-control" id="solution_file" name="solution_file[]" multiple>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded" name="btn_hackathon_submit">Submit</button>
										<!-- <button type="submit" class="btn btn-outline-primary" name="btn_hackathon_submit">Submit</button> -->

									</div>
								</div>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			}
		}
		elseif($candidate_page->hackathon_verification=="unverified"){
		?>
		<div class="mt-5">
			<div id="faq"></div>
			<div class="container">
				<div class="mt-5 promo promo-border p-4 p-md-5 mb-6">
					<div class="row align-items-center faq-text-center">
						<div class="col-12 col-lg">
							<h3><?= $page->facebook_link; ?></h3>
						</div>
						<div class="col-12 col-lg-auto mt-4 mt-lg-0 m-auto">
						<!-- <h3><?= $page->facebook_link; ?></h3> -->
						  <button class="btn btn-outline-danger btn-block text-center" type="" style="background-color: #dc3545;
                color: #fff; cursor:pointer;" >
								<!-- <i class="fa fa-bell"></i> Your account verification is pending for Hackathon Problem statements! -->
								<i class="fa fa-bell"></i> Your account is unverified!
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		}
		else{
		?>
		<div class="mt-5">
			<div id="faq"></div>
			<div class="container">
				<div class="mt-5 promo promo-border p-4 p-md-5 mb-6">
					<div class="row align-items-center faq-text-center">
						<div class="col-12 col-lg">
							<h3><?= $page->facebook_link; ?></h3>
						</div>
						<div class="col-12 col-lg-auto mt-4 mt-lg-0 m-auto">
						<!-- <h3><?= $page->facebook_link; ?></h3> -->
						  <button class="btn btn-outline-danger btn-block text-center" type="" style="background-color: #dc3545;
                color: #fff; cursor:pointer;" >
								<!-- <i class="fa fa-bell"></i> Your account verification is pending for Hackathon Problem statements! -->
								<i class="fa fa-bell"></i> Your account verification is pending!
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
				
	<?php
		}
	}
	else{
	?>
	  <div class="mt-5">
			<div id="faq"></div>
			<div class="container">
				<div class="mt-5 promo promo-border p-4 p-md-5 mb-6">
					<div class="row align-items-center faq-text-center">
						<div class="col-12 col-lg">
							<h3><?= $page->facebook_link; ?></h3>
						</div>
						<div class="col-12 col-lg-auto mt-4 mt-lg-0">
							<a href="<?=$pages->get("name=resume")->httpUrl;?>?hackps=true" target="" class="font-weight-light btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?= $page->foundation_title; ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
	<!-- End Hackathon Resgister button section -->


	<!-- riserevolution section -->

	<div class="container mb-5">
		<div class="title_new heading-block border-bottom-0 mb-0">
			<!-- <h3 style="color:#003;" class="title_new mb-3 mt-5"><?= $page->ally_challenge_resource_locator; ?></h3> -->
			<div style="text-transform: none;" class="removeb-margin"><?= $page->ticketing_title_toshow; ?></div>
		</div>
		<div class="row justify-content-center">
			<div class="hide-image-in-mobie title-hide1 col-md-11">
				<img src="<?= $page->ally_banner_image->httpUrl; ?>" alt="Standard Post with Image" style="display: block;margin-left: auto;margin-right: auto;">
			</div>
			<div class="hide-image-in-web title-hide1 col-12">
				<img src="<?= $page->ally_banner_mobile_image->httpUrl; ?>" alt="Standard Post with Image" style="display: block;margin-left: auto;margin-right: auto;">
			</div>
		</div>
		<!-- <div class="row gutter-20 mx-auto mb-5 mt-3" style="max-width: 640px;">
				    <?php
					// foreach($page->rise_past_section_buttons as $rise_past_section_buttons)
					//{
					?>
					<div class="col-sm-4">
						<a href="<?= $rise_past_section_buttons->heading3; ?>" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded  shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px"><?= $rise_past_section_buttons->heading2; ?></a>
					</div>
					<?php
					//}
					?>
			    </div> -->
	</div>
	<!-- riserevolution section end -->

	<!-- 3cards section by pooja  -->
	<div class="container mt-2 mb-6">
		<div class="row justify-content-center">
			<?php foreach ($page->cards_section->find('start=0,limit=2') as $cards_section) { ?>
				<div class="col-lg-6 col-md-6 mb-3">
					<div class="heading-fonts story-box-info p-3 h-100" style="border: 1px solid #000033;border-radius: 0.25rem;">
						<h3 class="title_new center" style="margin: 7px;font-weight: bold;"><?= $cards_section->bank_name; ?></h3>
						<div class="story-box-content">
							<div style="color:#003;" class="cards-text align-privacy-data-for-ul"><?= $cards_section->text_description; ?></div>
							<div class="">
								<div style="color:#003;font-size: 1rem;margin: -0.9rem;" class="important-text center mt-2"><?= $cards_section->heading1; ?></div>
								<div class="row justify-content-center mb-3 mt-3" style="max-width: 640px;">
									<?php foreach ($cards_section->rise_past_section_buttons as $rise_past_section_buttons) { ?>
										<a href="<?= $rise_past_section_buttons->heading3; ?>" target="_blank" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?= $rise_past_section_buttons->heading2; ?></a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div class="row justify-content-center">
			<?php foreach ($page->cards_section->find('start=2,limit=1') as $cards_section) { ?>
				<div class="col-lg-12 col-md-12 mb-3">
					<div class="story-box-info p-3 h-100" style="border: 1px solid #000033;border-radius: 0.25rem;">
						<h3 class="title_new center" style="margin: 7px;font-weight: bold;"><?= $cards_section->bank_name; ?></h3>
						<div class="story-box-content">
							<div style="color:#003 !important; height:auto !important;" class="cards-text align-privacy-data-for-ul"><?= $cards_section->text_description; ?></div>
							<div class="">
								<div style="color:#003 !important;" class="important-text mt-2 center text-white"><?= $cards_section->heading1; ?></div>
								<div class="row justify-content-center mb-3 mt-3">
									<?php foreach ($cards_section->rise_past_section_buttons as $rise_past_section_buttons) { ?>
										<a href="<?= $rise_past_section_buttons->heading3; ?>" target="_blank" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?= $rise_past_section_buttons->heading2; ?></a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<div id="agenda_table"></div>
	</div>

	<!-- 3cards section end -->

	<!-- agenda section by pooja -->
	<div class="content-wrap" style="margin-bottom: -2rem !important;">
		<div class="text-center title-center title-border" style="margin-bottom: 3rem; background-color:#ef6623;height: 4rem;padding-top: 0.9rem;">
			<h3 class="title_new" style="color:#fff;"><?= $page->heading7; ?></h3>
		</div>
		<div class="container clearfix mb-3">
			<div class="bs-example">
				<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
					<?php
					foreach ($page->jobfair_agenda as $jobfair_agenda) {
					?>
						<li class="nav-item">
							<a style="font-weight: 550;cursor: default;" class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#schedule1" role="tab" aria-controls="pills-home" aria-selected="true"><?= $jobfair_agenda->title; ?></a>
						</li>

					<?php
					}
					?>

				</ul>

				<div class="tab-content">
					<?php
					if ($page->jobfair_agenda->agenda_details != "") {
						foreach ($page->jobfair_agenda as $jobfair_agenda) {
					?>
							<div class="tab-pane fade active show" id="schedule1">
								<div class="content-wrap" style="padding: 0px 0 !important;">
									<div class="containernew container clearfix">
										<div class="row agenda_section " style="margin-right: 0px !important; margin-left: 0px !important; ">
											<div class="col-md-12 grid-margin-md stretch-card d-flex_" style="">
												<div class="cardnew active">
													<div class="mb-2">
														<!-- jobfair agenda-->
														<?php
														foreach ($jobfair_agenda->agenda_details as $agenda_details) {
														?>
															<div class="agenda-spacing card-title center font-weight-normal  letter note mb-0" style="align-items: center;margin-top: 0.5rem;color:#000033;"><?= $agenda_details->text_description; ?></div>
															<!-- loop for details sessions -->
															<div>
																<?php
																foreach ($agenda_details->session_details as $session_details) {
																?>
																	<div class="green-piles">
																		<h5><?= $session_details->session_text; ?></h5>
																	</div>

																<?php
																}
																?>
															</div>
														<?php
														}
														?>
														<!-- jobfair agenda -->
													</div>
												</div>

											</div>
										</div>
									</div>
									<?php
									foreach ($page->day_1_agenda_section_button as $day_1_agenda_section_button) {
									?>
										<div class="container mt-3">
											<div class="d-flex justify-content-center">
												<a href="<?= $day_1_agenda_section_button->heading3; ?>" class="[ text-center ][ btn btn-outline-primary-new ]"><?= $day_1_agenda_section_button->heading2; ?></a>
											</div>
										</div>
									<?php
									}
									?>
								</div>
							</div>
					<?php
						}
					}
					?>



				</div>
			</div>
			<div id="sponsorship" class="mb-6"></div>
		</div>
		<!-- <div class="container">
				    <div class="row justify-content-center gutter-20 mx-auto mb-md-6 mb-5 mt-3" style="max-width: 640px;">
							<div class="col-sm-7">
								<a href="<?= $urls->httpTemplates ?>files/RISE2021-Agenda.pdf" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px">DOWNLOAD THE DETAILED AGENDA</a>
							</div>
		        	</div>
				</div> -->
		<!-- agenda section end  -->





		<!-- sponsorship div by pooja -->
		<?php
		foreach ($page->sponsorships_repeater as $sponsorships_repeater) {
		?>
			<div class="text-center title-center title-border topmargin-sm" id="gallery" style="margin-bottom: 3rem; background-color:#fbdd0d;    height: 4rem;     padding-top: 0.9rem;">
				<h3 class="title_new" style="color:#000033;"><?= $sponsorships_repeater->title; ?></h3>
			</div>
		<?php
		}
		?>
		<?php
		if ($page->sponsorships_repeater->text_description != "") {
		?>
			<div class="container mt-2 mb-5">
				<div class="row justify-content-center">
					<?php
					foreach ($page->sponsorships_repeater as $sponsorships_repeater) {
					?>
						<div class=" col-lg-12 col-md-12 mb-3">
							<div class="story-box-info p-3" style="border: 1px solid #000033;border-radius: 0.25rem;">
								<!-- <h3 class="title_new center" style="margin: 7px;"><?= $sponsorships_repeater->title; ?></h3> -->
								<div class="story-box-content mt-2">
									<div style="color:#003; height:auto !important" class="cards-text"><?= $sponsorships_repeater->text_description; ?></div>
									<!-- <a class="flex-spacing right-margin-header"  href="<?= $cards_section->heading3; ?>"><button class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?= $cards_section->heading2; ?></button></a> -->
									<div class="row justify-content-center  mb-3 mt-3" style="">
										<?php
										foreach ($sponsorships_repeater->rise_past_section_buttons as $rise_past_section_buttons) {
										?>
											<!-- <a class="flex-spacing" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"  href="<?= $rise_past_section_buttons->heading3; ?>"><?= $rise_past_section_buttons->heading2; ?></a> -->
											<a href="<?= $rise_past_section_buttons->heading3; ?>" target="_blank" class="btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?= $rise_past_section_buttons->heading2; ?></a>
										<?php

										}
										?>
									</div>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>

			</div>
		<?php
		}
		?>

		<!-- sponsorship div end by pooja  -->


		<!--sponsors and partner section-->
		<?php
		if ($page->conference_sponsors_section_title != "") {
		?>

			<div class="title_new heading-block center border-bottom-0 mb-0 ">
				<h3 style="#000033;" class="mb-4 mt-4"><?= $page->conference_sponsors_section_title; ?></h3>
			</div>

			<?php
			foreach ($page->rise2023_sponsors as $rise2023_sponsors) {
			?>
				<div class="title_new heading-block center border-bottom-0 mb-0 ">
					<h4 style="#000033;" class=""><?= $rise2023_sponsors->title; ?></h4>
					<div class="d-flex justify-content-center">
						<div class="text-center" style="background-color:red;height:2px; width:70px;margin-top:3px; text-align:center"></div>
					</div>
				</div>
				<div class="container mt-3 mb-2">
					<ul class="clients-grid grid-2 grid-sm-3 grid-md-5 mb-0 justify-content-center">
						<?php

						foreach ($rise2023_sponsors->rise2023_sponsors_images as $Sponsors_images) {
						?>

							<li class="grid-item hover-effect"><a href="<?= $Sponsors_images->speaker_image->description ?>"><img src="<?= $Sponsors_images->speaker_image->httpUrl ?>" alt="Sponsors"></a></li>
						<?php
						}
						?>
					</ul>
				</div>
		<?php
			}
		}
		?>

		<!--sponsors section end-->

		<!-- <div class="container">
				<div class="row mt-3 justify-content-center gutter-20 mx-auto mb-5" style="max-width: 640px;">
				<div id="event-passes" class="mb-5"></div>			
					<div class="col-sm-4">
								<a href="<?= $pages->get("name=sponsors")->httpUrl; ?>" target="_blank" data-scrollto="#section-demos" class="btn btn-outline-primary-new button-rounded  text-white shadow-sm font-weight-medium m-0 btn-block" data-offset="100" data-easing="easeInOutExpo" data-speed="1250" style="padding: 10px 22px">View All Sponsors</a>
							</div>
					</div>
				
			</div> -->


		<!-- event passes section by pooja -->
		<!-- <section id="content m///t-1" style="" > -->
		<div id="event-passes" class="mb-6"></div>
		<div class="content-wrap" style="margin-bottom: -2rem !important;">
			<div class="text-center title-center title-border" style="margin-bottom: 5rem; background-color:#13a149; height: 4rem;padding-top: 0.9rem;">
				<h3 class="title_new" style="color:#fff;"><?= $page->heading8; ?></h3>
			</div>
		</div>
		<div class="container mt-2 mb-5 event_passes_card">
			<div class="row justify-content-center">
				<div class="col-md-6">
						<div class="container">
								<div class="card card_job_fair" style="background: #191B21;">
										<div class="card-body">
												<div class="card-title">
														<h2 class="text-center text-white">Job Fair</h2>
														<h3 class="text-center text-white">6<sup>th</sup> May 2023<h3>
														<!--<h2>8 May </h2>-->
														<h3 class="text-center text-white">10:00 am to 06:00 pm (IST)</h3>
												</div>
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
		  </div>
		</div>
		<!-- </section> -->
		<!-- event passes section end -->


		<!-- gallery section by pooja -->
		<div class="text-center title-center title-border topmargin-sm" id="gallery" style="margin-bottom: 3rem; background-color:#214897;    height: 4rem;     padding-top: 0.9rem;">
			<h3 class="title_new" style="color:#fff;"><?= $page->heading9; ?></h3>
		</div>
		<!-- <section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:4rem;"> -->
		<div class="content-wrap py-0">
			<div class="container">
				<div class="row justify-content-center">
					<?php
					foreach ($page->gallery_repeater as $gallery_repeater) {
					?>
						<div class="col-md-6">
							<div id="carouselExampleCaptionsOne_<?= $gallery_repeater->id; ?>" class="carousel slide" data-ride="carousel" data-interval="false">
								<div class="carousel-inner">
									<?php
									$counter = 0;
									foreach ($gallery_repeater->image_slider as $image_slider) {
										$counter++;
										$active_text = "";
										if ($counter == 1) {
											$active_text = "active";
										}
									?>
										<div class="carousel-item <?= $active_text ?>">

											<img src="<?= $image_slider->image->httpUrl; ?>" class="d-block w-100 " alt="...">

										</div>
									<?php
									}
									?>
								</div>

								<a class="carousel-control-prev" href="#carouselExampleCaptionsOne_<?= $gallery_repeater->id; ?>" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleCaptionsOne_<?= $gallery_repeater->id; ?>" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
							<div class="mt-2 text-center">
								<h3><?= $gallery_repeater->heading2; ?>
									<br>
									<a target="_blank" href="<?= $gallery_repeater->heading4; ?>"><small><?= $gallery_repeater->heading3; ?></small></a>
								</h3>
							</div>
						</div>
					<?php
					}
					?>
					<!-- <div class="col-md-6">
                   				<div style="">
									<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" data-interval="false">
										<ol class="carousel-indicators">
											<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
											<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
											<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
											<li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
											<li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/1.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/2.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/3.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/4.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/5.jpg" class="d-block w-100" alt="...">
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
										</ol>
										<div class="carousel-inner">
											<div class="carousel-item active">
											<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/14.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
											<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/12.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
											<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/13.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
											<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/11.jpg" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
											<img src="<?= $urls->httpTemplates ?>images/images_canvas/flicker_images/15.jpg" class="d-block w-100" alt="...">
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
								 -->

				</div>
			</div>
		</div>
		<!-- </section> -->

		<!-- gallery section end -->

		<!-- rise reflection section by pooja-->
		<div class="container-fluid title-center title-border topmargin-sm text-center" style="margin-bottom: 1rem; background-color:#824298;    height: 4rem;     padding-top: 0.9rem;">
			<h3 class="title_new" style="color:#fff;"><?= $page->candidate_profile_id; ?></h3>
		</div>
		<!-- <section id="content" class="spacing_riseref spacing_riseref1 section_style" style="margin-top:4rem; margin-bottom: 7rem;"> -->
		<div class="content-wrap py-0">
			<div class="container">
				<div class="row justify-content-center">
					<?php
					foreach ($page->youtube_video_repeater as $youtube_video_repeater) {
					?>
						<div class="col-md-6 mt-4">
							<!-- <div style=" margin-right:1rem !important;" class="vedio_spacing vedio_height vedio_height_new"> -->
							<iframe width="677" height="400" src="https://www.youtube.com/embed/<?= $youtube_video_repeater->heading2; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							<!-- </div>     -->
						</div>
					<?php
					}
					?>
				</div>
			</div>
			<div id="media" class="mb-6"></div>
		</div>
		<!-- </section> -->
		<!-- rise reflection end -->

		<!-- facebook and twitter embedding  -->
		<?php
		if ($page->covid_19_title != "") {
		?>
			<div id="fb-root"></div>
			<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="TEQWel07"></script>
			<div class="container-fluid title-center title-border mt-6 text-center" style="margin-bottom: 3rem; background-color:#ef6623;height: 4rem;padding-top: 0.9rem;">
				<h3 class="title_new" style="color:#fff;"><?= $page->covid_19_title; ?></h3>
			</div>
			<div class="container">
				<div class="row mb-6 justify-content-center">
					<div class="col-md-5 mb-5">
						<div class="fb-page" data-href="https://www.facebook.com/<?= $page->heading3; ?>" data-tabs="timeline" data-width="800" data-height="520" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
							<blockquote cite="https://www.facebook.com/<?= $page->heading3; ?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?= $page->heading3; ?>"><?= $page->heading5; ?></a></blockquote>
						</div>
					</div>
					<div class="col-md-5 mb-5">
						<a class="twitter-timeline" data-width="500" data-height="520" href="https://twitter.com/<?= $page->heading4; ?>"><?= $page->heading6; ?></a>
						<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					</div>
				</div>
			</div>
		<?php
		} else {
		}
		?>
		<!-- facebook and twitter embedding end  -->

		<!-- frequently asked question section by pooja -->
		<div class="mt-5">
			<div id="faq"></div>
			<div class="container">
				<div class="mt-5 promo promo-border p-4 p-md-5 mb-6">
					<div class="row align-items-center faq-text-center">
						<div class="col-12 col-lg">
							<h3><?= $page->heading2; ?></h3>
						</div>
						<div class="col-12 col-lg-auto mt-4 mt-lg-0">
							<a href="<?= $page->year_of_passing; ?>" target="_blank" class="font-weight-light btn-outline-primary-new font-weight-light button ml-0 button-rounded"><?= $page->youtube_link; ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- frequently asked section end  -->

</section><!-- #content end -->

<style>
	/* social media icons alignment in a footer */
	.social-media-row-alignment {
		justify-content: flex-end !important;
	}

	@media (max-width: 767px) {
		.social-media-row-alignment {
			justify-content: center !important;
		}
	}
</style>

<!-- demo footer-->


</div><!-- #wrapper end -->

<script>
	var target_date = new Date().getTime() + (1000*3600*48); // set the countdown date
	var days, hours, minutes, seconds; // variables for time units

	var countdown = document.getElementById("tiles"); // get tag element

	getCountdown();

	setInterval(function () { getCountdown(); }, 1000);

	function getCountdown(){

		// find the amount of "seconds" between now and target
		var current_date = new Date().getTime();
		var seconds_left = (target_date - current_date) / 1000;

		days = pad( parseInt(seconds_left / 86400) );
		seconds_left = seconds_left % 86400;
			
		hours = pad( parseInt(seconds_left / 3600) );
		seconds_left = seconds_left % 3600;
				
		minutes = pad( parseInt(seconds_left / 60) );
		seconds = pad( parseInt( seconds_left % 60 ) );

		// format countdown string + set tag value
		countdown.innerHTML = "<span>" + days + "</span><span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>"; 
	}

	function pad(n) {
		return (n < 10 ? '0' : '') + n;
	}


</script>

<?php include(\ProcessWire\wire('files')->compile('includes/hackathon_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); ?>

