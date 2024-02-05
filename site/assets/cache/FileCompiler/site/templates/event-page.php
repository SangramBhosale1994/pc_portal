<?php 
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}

/* TODO : Deprecate this system. Use direct values. */
	$rootpath = $config->urls->templates;
	$homepath = $urls->httpRoot."resume/";
	$event_code = $page->event_code;

	// echo $session->oauth_gmail;
	// echo "****";
	// if(isset($_POST['btn_submit_workshop'])){
	// 	echo "111";
	// 	$option_about_workshop=$input->post->about_workshop;
	// 	$candidate_page = $pages->get("name=candidates")->child("email=".$session->oauth_gmail);
	// 	$candidate_page->how_did_you_know_about_workshop=$option_about_workshop;
	// 	echo "222";
	// 	$candidate_page->of(false);
	// 	$candidate_page->save();
	// 	echo "333";
	// }

 ?>
<!DOCTYPE html>
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

	<script type="text/javascript">
		let rootpath = '<?=$rootpath?>';
		let homepath = '<?=$homepath?>';
		let event_code = '<?=$event_code?>';
	</script>
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
 require_once(\ProcessWire\wire('files')->compile('includes/resume_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
		}
	?>
	<div id="top-container" class="header_menu_banner">
		<img src="<?=$pages->get("name=resume-header")->banner_image->httpUrl?>" class="[ w-100 img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$pages->get("name=resume-header")->Banner_image_mobile->httpUrl?>" class="[ w-100 img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
	</div>

	<div class="container">
		<div class="row mt-md-5">
			<div class="col-md">

			</div>

			<!-- <div id="profile-picture-container" class="col-sm-12 col-md-3">
				<?php
					// if(array_key_exists("profile_picture", $available_columns_to_show) && $page->profile_image){
					// 	$profile_picture_url = $page->profile_image->url;
					// }
					// else{
						// $profile_picture_url = $urls->httpTemplates."images/powered-by-msd.png";
					// }
				?>

				<img id="profile-picture" src="<?=$profile_picture_url ?>" class="[ mx-auto my-2 ][ img-fluid rounded border-primary ]" alt="Profile Picture"> 

				<div class="[ text-center ]">
					<p>
						<a class="[ text-info ]" href="https://www.fargo.com">https://www.fargo.com</a>
					</p>
				</div>

			</div>-->

			<!--introduction part start-->
			<div class="col-sm-12 col-md-12 mt-2 text-center d-md-flex flex-md-column">
				<!-- <h1 id="profile-name" class="mb-3">
					<strong>Softeware Design and UX Head</strong>
				</h1> -->
				<h1 class="mb-3">
					<?=$page->title?>
				</h1>

				<div>
					<span id="profile-category" class="badge badge-info px-2 py-1 mb-4 mr-2 border-ngo"><i class="fas fa-map-marker-alt"></i> &nbsp;<?=$page->location?></span>

					<span id="profile-category" class="badge badge-info px-2 py-1 mb-4 mr-2 border-ngo"><i class="fas fa-qrcode"></i> &nbsp;<?=$page->event_code?></span>
				</div>

				<div class="[ my-3 ]">

					<?php
						// $register_button_class = " apply-button ";
						// $register_button_disabled = " ";
						// $register_button_text = " Register ";

						// if($page->event_start_date<time()){
						// 	if($page->event_end_date && $page->event_end_date>time())
						// 	{
						// 	}
						// 	else{
						// 		$register_button_class = " disabled ";
						// 		$register_button_disabled = " disabled";
						// 		$register_button_text = " Registrations Over ";
						// 	}
						// }
					?>

					<!-- <button type="button" class="( <?=$register_button_class?> )[ px-5 ][ btn btn-primary ]" <?=$register_button_disabled?>> <?=$register_button_text?> </button> -->

					<!-- <a href="https://docs.google.com/forms/d/e/1FAIpQLSfNSY5AxCqIAWhj-ZnamvVwMpO8bgKEfP01wuX50pjwO9dJ4A/viewform" target="_blank" class="[ px-5 ][ btn btn-primary ]">Register</a> -->
					<button type="button" id="event_code_<?=$page->event_code?>" class="( apply-button )[ px-4 ][ btn btn-primary ]"> Register Now </button>
				</div>

				<div id="top-share-button" class=" need-share-button" data-share-share-button-class="custom-button" data-share-networks="mailto,twitter,facebook,linkedin" data-share-position="bottomCenter">
					<span class="custom-button [ mt-3 ][ text-info btn btn-outline-light ]">Share This Page&nbsp; <i class="fas fa-share-alt"></i></span>
				</div>

				<!-- <div>
					<div id="top-share-button" class="[ my-3 ][ text-info btn btn-outline-light ]" data-share-position="bottomCenter" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button">Share This Page&nbsp; <i class="fas fa-share-alt"></i></span></div>
				</div> -->
			</div>

			<div class="col-md">

			</div>


			<!--introduction part end-->
		</div>
		<!--menu-bar-->
		<div class="row">
			<div class="col-md d-none d-md-block d-lg-block">
			</div>

			<div id="profile-details-container"  class="[ mt-5 ][ col-md-7 ]" data-target="body" data-offset="0">
				<div class="[ my-3 ]">
					<h4 class="text-center">Event Details</h4>
				</div>
				<table class="[ table ]">
					<tbody>	
						<tr>
							<td>Facilitated by</td>
							<td><?=$page->event_facilitated_by?></td>
						</tr>

						<tr>
							<td>Location</td>
							<td><?=$page->location?></td>
						</tr>

						<tr>
							<td>Event Code</td>
							<td><?=$page->event_code?></td>
						</tr>

						<tr>
							<td>Date<?php
									if((int)$page->event_end_date > 0){
										echo "s";
									} 
								?>
								</td>
							<td>
								<?php
									echo date("d M Y", $page->event_start_date);

									if((int)$page->event_end_date > 0){
										echo " - ".date("d M Y", $page->event_end_date);
									} 
								?>	
							</td>
						</tr>

						<tr>
							<td>Time</td>
							<td>
								<?=$page->event_start_time." - ".$page->event_end_time?>
							</td>
						</tr>

						<tr>
							<td>Who Can Attend?</td>
							<td><?=$page->event_who_can_attend?></td>
						</tr>
						<tr>
							<td>Ticket Price</td>
							<td><?=$page->ticket_price?></td>
						</tr>

						<tr>
							<td>Register Before</td>
							<td><?=date("d M Y", $page->application_deadline)?></td>
						</tr>

						<?php
							if($page->event_link){
						?>
						
						<tr>
							<td>Event Link</td>
							<td><a target="_blank" href="<?=$page->event_link?>">Click Here</a></td>
						</tr>
						
						<?php
							}
						?>

						<tr>
							<td colspan="2" ><br><h4>Speaker/Trainer Details</h4><br><div style="margin-left:20px"><?=$page->event_speaker_details?></div></td>
						</tr>

						<tr>
							<td  colspan="2" ><br><h4>Description</h4><br><div style="margin-left:20px"><?=$page->summary?></div></td>
						</tr>
					</tbody>
				</table>

				<div class="[ mt-5 mb-3 ]">
					<h4 class="text-center"></h4>
				</div>

				<div class="[ text-center ][ my-5 ]">
					<div class="">
						<!-- <button type="button" class="( <?=$register_button_class?> )[ px-5 ][ btn btn-primary ]" <?=$register_button_disabled?>> <?=$register_button_text?> </button> -->

						<!-- <a href="https://docs.google.com/forms/d/e/1FAIpQLSfNSY5AxCqIAWhj-ZnamvVwMpO8bgKEfP01wuX50pjwO9dJ4A/viewform" target="_blank" class="[ px-5 ][ btn btn-primary ]">Register</a> -->
						<button type="button" id="event_code_<?=$page->event_code?>" class="( apply-button )[ px-4 ][ btn btn-primary ]"> Register Now</button>
					</div>
				</div>
			</div>

			<div class="col-md">
			</div>
		</div>
	</div>
	<!-- Add popup for "how did you hear about the workshop -->
	<?php
	  if($page->is_popup_show_event != ""){
	?>
	<div id="about_workshop_modal" class="modal fade bd-modal-sm" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title">Workshop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
						<form method="POST" id="about_workshop_popup_form" enctype="multipart/form-data">
							<div class="modal-body"> 
									<!-- <h5>Please <a target="_blank" href="https://www.thepridecircle.com/resume/" style="text-decoration:none;">log in</a> and try again.</h5> -->
									<!-- <h5>Please <a target="_blank" href="https://zerovaega.in/pc_portal/resume/" style="text-decoration:none;">log in</a> and try again.</h5> -->
										<label for="sel1" class="form-label">How did you hear about the workshop?</label>
										<select class="form-control" name="about_workshop" aria-label="Default select example" required>
											<option value="" selected disabled>Please select option</option>
											<!-- <option value="Facebook">Facebook</option>
											<option value="Linkedin">Linkedin</option>
											<option value="Instagram">Instagram</option> -->
											<option value="Friend">Friend</option>
											<!-- <option value="Referred" <?php if($referrer_code_cookie_value !== false){echo "selected";} ?>>Referred</option> -->
											<option value="Referral">Referral</option>
											<option value="Newspaper">Newspaper</option>
											<option value="Facebook Advert">Facebook Advert</option>
											<option value="Instagram Advert">Instagram Advert</option> 
											<option value="Linkedin Advert">LinkedIn Advert</option>
											<option value="Twitter Post">Twitter Post</option>
											<option value="Social Media Story / Posts / Reel">Social Media Story / Posts / Reel</option>
											<option value="Email Notification">Email Notification</option>
											<option value="Whatsapp Forward Message">WhatsApp Forward Message</option>
										</select>
										<span id="message" style="color:red;"></span>
									
							</div>
									
							<div class="modal-footer">
								<div class="">
									<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
									<button type="button" class="btn btn-primary btn_submit_workshop" id="event_code_<?=$page->event_code?>" name="btn_submit_workshop">Submit</button>
								</div>
								
							</div>
						</form>
               
        </div>
    </div>
	</div>
	<?php
		}
	?>
	<!-- End popup workshops -->
	<div id="myModal" class="modal fade bd-modal-sm" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title">Register Now</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <!-- <h5>Please <a target="_blank" href="https://www.thepridecircle.com/resume/" style="text-decoration:none;">log in</a> and try again.</h5> -->
								<h5>Please <a target="_blank" href="https://zerovaega.in/pc_portal/resume/" style="text-decoration:none;">log in</a> and try again.</h5>
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
            </div>
               
        </div>
    </div>
	</div>

	<script src="<?= $config->urls->templates ?>scripts/needsharebutton.min.js"></script>

	<script>
		new needShareDropdown(document.getElementById("top-share-button"), {
			url: window.location.href,
			title: "Check this event on Pride Cricle now!",
			description: "Click on the link and log in to join."
		});
	</script>		

	<script src="<?php echo $config->urls->templates; ?>scripts/<?php echo $page->template;?>.js?v=<?=mt_rand(0,99)?>"></script>

	<div id="" class="[ py-3 ][ shadow ]" style="border-top: 0px solid #999">

		<div class="[ my-3 ][ text-center small ]">
			For techincal queries regarding the form, please email us at <a href="mailto:contact@thepridecircle.com?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us">contact@thepridecircle.com</a>
		</div>

		<!-- <div class="[ mt-3 ][ text-center small ]">
			Developed By  <a href="https://zerovaega.com/" target="_blank">Zerovaega Technologies.</a>
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
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>