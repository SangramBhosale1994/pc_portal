<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}

?><!DOCTYPE html>
<html>
<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

	<!-- <script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-155220702-1');
	</script> -->
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-208516648-2');
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->

	<title><?=$page->title?> | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $urls->httpTemplates;?>images/frontend/favicon.png"/>

	<link rel="icon" href="<?= $urls->httpTemplates;?>images/index.png" sizes="32x32" />

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?= $urls->httpTemplates;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page-Specific Style CSS -->
	<link href="<?= $urls->httpTemplates;?>styles/<?=$page->template?>.css" rel="stylesheet" type="text/css">
	<!-- Share button CSS -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/needsharebutton.min.css">

	<style type="text/css">
		.need-share-button_dropdown-middle-left{
			margin-right: -80px;
			margin-top:-85px !important;
		}
	</style>
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $urls->httpTemplates;?>scripts/jquery.min.js" type="text/javascript"></script>
	<!-- Popper Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/popper.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/bootstrap.min.js" type="text/javascript"></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<!-- ---------- JS LINKS END ---------- -->
	<style>
		<?php
		if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
		?>
			.header_menu_banner{
				margin-top:4.3rem;
			}
			@media (max-width:768px){
				.header_menu_banner{
					margin-top:4.9rem;
				}
			}
		<?php
			}
		?>
	</style>
	</head>

<body>
	<?php
		if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
			require_once 'includes/resume_header.php';
		}
	?>
	<div id="top-container" class="header_menu_banner">
		<img src="<?=$pages->get("name=resume-header")->banner_image->httpUrl?>" class="[  w-100 img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$pages->get("name=resume-header")->Banner_image_mobile->httpUrl?>" class="[  w-100 img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
	</div>

	<div class="[ container ]" style="margin-top: 10em" >
		<div class="[ my-5 ][ row ]">
			<div class="[ col-12 ]">
				<h2 style="text-align: center"><?=$page->title?></h2>
			</div>
		</div>

		<div class="[ my-4 ][ row ]">
			<div class="[ offset-md-4 col-md-4 ]" >
				<div class="[ form-group ]">
					<input id="events_searchword" class="[ form-control form-control-lg ]" type="text" name="events_searchword" placeholder="Search">
				</div>
			</div>
		</div>

		<div class="[ my-4 ][ row ]">
			<div class="[ offset-md-4 col-md-4 ]" >
				<ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Upcoming&nbsp;Events</a>
					</li>
					<li class="nav-item">
						<a class="[ px-5 ][ nav-link ]" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Past&nbsp;Events</a>
					</li>
				</ul>
			</div>
		</div>

		<!-- <div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">d.</div>
		</div> -->

		<div class="[ tab-content ]">

			<div id="pills-home" class="[ tab-content ][ tab-pane fade show active ]" role="tabpanel" aria-labelledby="pills-home-tab">
				<div class="[ mb-3 ][ row ]">

				<?php
					$i=1;
					foreach ($pages->get("name=workshops")->children("event_start_date|event_end_date>".time().",sort=event_start_date") as $event_page) {
				?>

					<div class="( event-card-container )[ my-3 ][ col-md-4 ]">
						<div class="[ card ]">
							<div class="card-body">
								<h5 class="[ card-title ]" style="white-space: wrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em; height:2.6em;"><?=$event_page->title?></h5>
								<h6 class="[ mb-3 ][ card-subtitle text-muted ]" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em"> Facilitated By <?=$event_page->event_facilitated_by?></h6>

								<p class="card-text">
									<i class="[ mr-1 ][ text-info ][ fas fa-fw fa-calendar-day ]"></i>
									<?php
										echo date("d M Y", $event_page->event_start_date);
										
										if((int)$event_page->event_end_date > 0){
											echo " - ".date("d M Y", $event_page->event_end_date);
										} 
									?>

									<br>

									<i class="[ mr-1 ][ text-info ][ text-center ] fas fa-fw fa-clock"></i>
									<?=$event_page->event_start_time." - ".$event_page->event_end_time?>

									<br>

									<i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt"></i>
									<?=$event_page->location?>

									<br>

									<i class="[ mr-1 ][ text-info ] fas fa-fw fa-user"></i>
									For <?=$event_page->event_who_can_attend?>
								</p>

								<p class="card-text"><span class="badge badge-info"><i class="[  mr-1 ] fas fa-fw fa-qrcode"></i> <?=$event_page->event_code?></span></p>
								<hr>
								<div class="[ d-flex justify-content-between ]">
									<a href="<?=$event_page->httpUrl?>" target="_blank" style="margin-left: -10px" class="[ card-link ][ text-primary btn btn-outline-light ]">KNOW MORE</a>

									<div id="share-button-<?=$event_page->id?>" class=" need-share-button" data-share-share-button-class="custom-button" data-share-networks="mailto,twitter,facebook,linkedin" data-share-position="middleLeft">
										<span class="custom-button [ card-link ][ text-info btn btn-outline-light ]"><i class="fas fa-share-alt"></i></span>
									</div>

									<!-- <div id="share-button-<?=$event_page->id?>" style="margin-right: -10px" class="[ card-link ][ text-info btn btn-outline-light ]" data-share-position="centerLeft" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button"><i class="fas fa-share-alt"></i></span></div> -->
								</div>
							</div>
						</div>
					</div>

				<?php
						$i++;
					}
				?>
				</div>

				<div class="[ pt-5 pb-5 pb-md-0  ][ text-center ]">
					<h1>Learning Partners</h1>
				</div>
				
				<div class="[ mx-md-5 px-md-5 row ][ d-md-flex justify-content-md-center ]">
					<?php
						foreach($page->upcoming_events_images as $single_upcoming_event_image){
					?>
					<div class="[col-12 col-md-3 col-lg-3 p-3 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?=$single_upcoming_event_image->httpUrl?>" alt="">
					</div>
					<?php
						}
					?>

					<!-- <div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?=$page->upcoming_events_images->eq(1)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:90px; height:auto" src="<?=$page->upcoming_events_images->eq(2)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:110px; height:auto" src="<?=$page->upcoming_events_images->eq(3)->httpUrl?>" alt="">
					</div> -->
				</div>

				<!-- <div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-center ]">
					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:110px; height:auto" src="<?=$page->upcoming_events_images->eq(4)->httpUrl?>" alt="">
					</div>
					
					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?=$page->upcoming_events_images->eq(5)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?=$page->upcoming_events_images->eq(6)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:100px; height:auto" src="<?=$page->upcoming_events_images->eq(7)->httpUrl?>" alt="">
					</div>

					
				</div>

				<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-center ]">
					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?=$page->upcoming_events_images->eq(8)->httpUrl?>" alt="">
					</div>
					
					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:90px; height:auto" src="<?=$page->upcoming_events_images->eq(9)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:170px; height:auto" src="<?=$page->upcoming_events_images->eq(10)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:100px; height:auto" src="<?=$page->upcoming_events_images->eq(11)->httpUrl?>" alt="">
					</div>
				</div> -->
			</div>

			<div id="pills-profile" class="[ tab-content ][ tab-pane fade ]" role="tabpanel" aria-labelledby="pills-profile-tab">
				<div class="[ mb-3 ][ row ]">
					<?php
					$i=1;
					foreach ($pages->get("name=workshops")->children("event_start_date<".time().",sort=event_start_date") as $event_page) {

						if($event_page->event_end_date && $event_page->event_end_date>time()){
							continue;
						}

				?>

					<div class="( event-card-container )[ my-3 ][ col-md-4 ]">
						<div class="[ card ]">
							<div class="card-body">
								<h5 class="[ card-title ]" style="white-space: wrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em; height:2.6em;"><?=$event_page->title?></h5>
								<h6 class="[ mb-3 ][ card-subtitle text-muted ]" style="white-space: nowrap; overflow:hidden; text-overflow: ellipsis; line-height: 1.3em"> Facilitated By <?=$event_page->event_facilitated_by?></h6>

								<p class="card-text">
									<i class="[ mr-1 ][ text-info ][ fas fa-fw fa-calendar-day ]"></i>
									<?php
										echo date("d M Y", $event_page->event_start_date);
										
										if($event_page->event_end_date > 0){
											echo " - ".date("d M Y", $event_page->event_end_date);
										} 
									?>

									<br>

									<i class="[ mr-1 ][ text-info ] fas fa-fw fa-clock"></i>
									<?=$event_page->event_start_time." - ".$event_page->event_end_time?>

									<br>

									<i class="[ mr-1 ][ text-info ] fas fa-fw fa-map-marker-alt"></i>
									<?=$event_page->location?>

									<br>

									<i class="[ mr-1 ][ text-info ] fas fa-fw fa-user-check"></i>
									For <?=$event_page->event_who_can_attend?>
								</p>

								<p class="card-text"><span class="badge badge-info"><i class="[  mr-1 ] fas fa-fw fa-qrcode"></i> <?=$event_page->event_code?></span></p>
								<hr>
								<div class="[ d-flex justify-content-between ]">
									<a href="<?=$event_page->httpUrl?>" target="_blank" style="margin-left: -10px" class="[ card-link ][ text-primary btn btn-outline-light ]">KNOW MORE</a>

									<div id="share-button-<?=$event_page->id?>" class=" need-share-button" data-share-share-button-class="custom-button" data-share-networks="mailto,twitter,facebook,linkedin" data-share-position="middleLeft">
										<span class="custom-button [ card-link ][ text-info btn btn-outline-light ]"><i class="fas fa-share-alt"></i></span>
									</div>

									<!-- <div id="share-button-<?=$event_page->id?>" style="margin-right: -10px" class="[  need-share-button ][ card-link ][ text-info btn btn-outline-light ]" data-share-position="middleLeft" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin">
										<span class="custom-button"><i class="fas fa-share-alt"></i></span>
									</div> -->
								</div>
							</div>
						</div>
					</div>

				<?php
						$i++;
					}
				?>
				</div>

				<div class="[ pt-5 pb-5 pb-md-0  ][ text-center ]">
					<h1>Learning Partners</h1>
				</div>

				<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-center ]">
					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:60px; height:auto" src="<?=$page->past_events_images->eq(0)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:70px; height:auto" src="<?=$page->past_events_images->eq(1)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?=$page->past_events_images->eq(2)->httpUrl?>" alt="">
					</div>
					
					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:150px; height:auto" src="<?=$page->past_events_images->eq(3)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:230px; height:auto" src="<?=$page->past_events_images->eq(4)->httpUrl?>" alt="">
					</div>
				</div>

				<div class="[ mx-md-5 px-md-5 ][ d-md-flex justify-content-md-center ]">
					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:100px; height:auto" src="<?=$page->past_events_images->eq(5)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:200px; height:auto" src="<?=$page->past_events_images->eq(6)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:130px; height:auto" src="<?=$page->past_events_images->eq(7)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:130px; height:auto" src="<?=$page->past_events_images->eq(8)->httpUrl?>" alt="">
					</div>

					<div class="[ p-5 ][ align-self-center ][ text-center ]">
						<img class="[ img-fluid ]" style="max-width:180px; height:auto" src="<?=$page->past_events_images->eq(9)->httpUrl?>" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="<?= $config->urls->templates ?>scripts/<?php echo $page->template;?>.js?v=10.19"></script>
	
	<script src="<?= $config->urls->templates ?>scripts/needsharebutton.min.js"></script>
	<script>
		
		<?php
			foreach ($pages->get("name=workshops")->children() as $event_page) {
		?>

		new needShareDropdown(document.getElementById("share-button-<?=$event_page->id?>"), {
			url: "<?=$event_page->httpUrl?>",
			title: "Check this event on Pride Cricle now!",
			description: "Click on the link and log in to join."
		});

		<?php
			}
		?>

	</script>

	<div id="" class="[ py-3 ][ shadow ]" style="border-top: 0px solid #999">

		<div class="[ my-3 ][ text-center small ]">
			For techincal queries regarding the form, please email us at <a href="mailto:contact@thepridecircle.com?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us">contact@thepridecircle.com</a>
		</div>

		<!-- <div class="[ mt-3 ][ text-center small ]">
			Developed By  <a href="mailto:todkar.amrut27897@gmail.com" target="_blank">ProAutomater</a>
		</div> -->
	</div>
<!-- Script for header -->
<script src="<?= $rootpath;?>scripts/tweetjs.js" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		$(document).on("click", "#navbarNav .nav-link", function(){
			if(!$("#navbar-toggler").hasClass("collapsed")){
				$("#navbar-toggler").addClass("collapsed");
				$("#navbar-toggler").attr("aria-expanded", "false");
				$("#navbarNav").removeClass("show");
			}
		})

	})
</script>
<!-- Script for header -->

<?php
require $config->paths->templates.'includes/footer.php';
?>