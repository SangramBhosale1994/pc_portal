<?php 
// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// {
//     //Tell the browser to redirect to the HTTPS URL.
//     header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
//     //Prevent the rest of the script from executing.
//     exit;
// }

/* TODO : Deprecate this system. Use direct values. */
	$rootpath = $config->urls->templates;
	$homepath = $urls->httpRoot."resume/";
	$job_code = $page->job_code;
 //echo $session->oauth_gmail;
	if(isset($_POST['btn_submit_job'])){
		// echo "111";
		$option_about_job=$input->post->about_job;
		$candidate_page = $pages->get("name=candidates")->child("email=".$session->oauth_gmail);
		$candidate_page->how_did_you_know_about_job=$option_about_job;
		// echo "222";
		$candidate_page->of(false);
		$candidate_page->save();
		// echo "333";
	}
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

	<title><?=htmlspecialchars_decode(htmlspecialchars_decode($page->title))?> | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $urls->httpTemplates;?>images/frontend/favicon.png"/>

	<link rel="icon" href="<?= $urls->httpTemplates;?>images/index.png" sizes="32x32" />

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ---------- META TAGS END ---------- -->
	<!-- ---------- META TAGS ---------- -->
	<meta property="og:title" content="Find a Job | Pride Circle ">
    <meta property="og:image" content='<?php echo $pages->get("name=home")->httpUrl."site/templates/images/pride_circle_logo.jpg"; ?>'>
    <meta property="og:description" content="Reimagining Inclusion for Social Equity">
    <meta property="og:url" content="<?= $page->httpUrl ?>">
    <meta property="og:type" content="article" />

    <meta name="twitter:title" content="Find a Job | Pride Circle ">
    <meta name="twitter:description" content="Reimagining Inclusion for Social Equity">
    <meta name="twitter:image" content='<?php echo $pages->get("name=home")->httpUrl."site/templates/images/pride_circle_logo.jpg"; ?>'>
    <meta name="twitter:card" content="Find a Job | Pride Circle ">

    <meta property="og:site_name" content="Find a Job | Pride Circle ">
    <meta name="twitter:image:alt" content="Find a Job | Pride Circle ">
    <!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?= $urls->httpTemplates;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page-Specific Style CSS -->
	<link href="<?= $urls->httpTemplates;?>styles/<?=$page->template?>.css?v=14.06.22" rel="stylesheet" type="text/css">
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
		let job_code = '<?=$job_code?>';
	</script>
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
	<style>
	<?php
	if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
	?>
		.header_menu_banner{
			margin-top:4.3rem;
		}
		@media (max-width:768px){
			.header_menu_banner{
				margin-top:5rem;
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
	<div id="top-container"  class="header_menu_banner">
		<!--<img src="<?=$urls->httpTemplates;?>images/job_desktop.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">-->

		<!--<img src="<?=$urls->httpTemplates;?>images/job_mobile.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">-->
		
			<img src="<?=$pages->get("name=resume-header")->banner_image->httpUrl?>" class="[ img-fluid ]( mobile-hide ) w-100" alt="Pride Circle Banner Image">

		<img src="<?=$pages->get("name=resume-header")->Banner_image_mobile->httpUrl?>" class="[ img-fluid ]( mobile-show ) w-100" alt="Pride Circle Banner Image">
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
				<div class="container p-0 m-0">
										<?php
											$company_profile_present="false";
											// echo $page->company_name;
											// addslashes($job_page->company_name);
											// echo addslashes($page->company_name);
											$recruiter_page=$pages->get("name=recruiters")->child("company_name="."'".$page->company_name."'");
											// echo $recruiter_page->id;
											// print_r($recruiter_page->recruiter_accessible_sections);
											if($recruiter_page->recruiter_accessible_sections!=""){
												foreach($recruiter_page->recruiter_accessible_sections as $accessible_sections){
													/*check accessible sections id into accessible sections id array
														check accessible sections name into accessible sections array */
														// echo $accessible_sections->name;
													if($accessible_sections->name=="recruiter-company-profile"){
														$company_profile_present="true";
													}
												}
											}
										?>
                    <div class="row align-items-center text-center d-block" style="height:152px; ">
                        <?php
                        /**
                         * firt check if image in job page if null then add default vaue
                         * $image to store image url
                         */
                        if ($page->job_image != null) {
                            $image = $page->job_image->httpUrl;
                        } else {
                            $image =  $rootpath . "images/job_card_Logo_new.png";
                        }
                        ?>
												<?php
													
													if($company_profile_present=="true"){
													?>
													<a href="<?=$pages->get('name=company-profile')->httpUrl?>?name=<?=$page->company_name?>">
														<img src="<?=$image?>" class="mx-auto" alt="Image" style="max-height: 150px; width:auto">
													<a>
													<?php
													}
													else{
													?>
														<img src="<?=$image?>" class="mx-auto" alt="Image" style="max-height: 150px; width:auto">
													<?php
													}
													?>
                    </div>
                </div>
				<h1 class="mb-3">
					<?=htmlspecialchars_decode(htmlspecialchars_decode($page->title))?>
				</h1>

				<div>
					<span id="profile-category" class="badge badge-info px-2 py-1 mb-4 mr-2 border-ngo"><i class="fas fa-map-marker-alt"></i> &nbsp;<?=$page->location?></span>

					<span id="profile-category" class="badge badge-info px-2 py-1 mb-4 mr-2 border-ngo"><i class="fas fa-user-clock"></i> &nbsp;<?=$page->min_experience?></span>

					<span id="profile-category job_page_job_code" class="badge badge-info px-2 py-1 mb-4 mr-2 border-ngo"><i class="fas fa-qrcode"></i> &nbsp;<?=$page->job_code?></span>
				</div>

				<div class="[ my-3 ]">
					<button type="button" id="job_code_<?=$page->job_code?>" class="( apply-button )[ px-5 ][ btn btn-primary ]"> Apply Now </button>
					
				</div>
						<?php
								$job_created_time=$page->created;
								// echo "created job date";
								// echo $job_created_time;
								$display_views_after_24_hours=$job_created_time+24*60*60;
								// echo "**********";
								// echo $display_views_after_24_hours;
								$current_timestamp=strtotime(date("d-m-Y"));
								//echo "+++++".$current_timestamp;
								if($job_created_time<$current_timestamp){
						?>
                <div>
                    <!--<span id="profile-category" class="badge badge-info px-2 py-1  mr-2 border-ngo"><i class="fas fa-eye"></i> &nbsp;<?php echo date("H", $page->created)+date("H", time())?> Views Today</span>-->
                    <p class="mb-0"><i class="[ mr-1 ][ text-info ] fas fa-fw fa-eye"></i> <?php echo date("H", $page->created)+date("H", time())?> Views Today</p>
                </div>
						<?php
								}
						?>
				<div>
				    
					<div id="top-share-button" class="[ my-3 ][ text-info btn btn-outline-light ]" data-share-position="bottomCenter" data-share-share-button-class="custom-button" data-share-networks="Mailto,Twitter,Facebook,Linkedin"><span class="custom-button">Share&nbsp; <i class="fas fa-share-alt"></i></span></div>
					
					<button class="btn btn-outline-primary " id="copy_link"><i class="far fa-copy "></i> </button>
					<a target="_blank" href="https://api.whatsapp.com/send?text=<?=$page->httpUrl?>"><button class="btn btn-outline-success " id="whatsapp_link"><i class="fa fa-whatsapp  "></i> </button></a>
				</div>
				
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
					<h4 class="text-center">Job Details</h4>
				</div>
				<table class="[ table ]">
					<tbody>	
						<tr>
							<td>Company</td>
							<td><?=addslashes($page->company_name)?></td>
						</tr>

						<tr>
							<td>Position</td>
							<td><?=$page->position?></td>
						</tr>

						<tr>
							<td>Required Experience</td>
							<td>
							<?=$page->min_experience?><?php if($page->max_experience!=0) echo "-".$page->max_experience?> Year<?php if($page->min_experience!=1) echo 's';?>
								<?php //if($page->min_experience == ""){
							//echo $page->experience; }else{ echo $page->min_experience; }?><?php //if($page->max_experience!=0) echo "-".$page->max_experience?> <?php //if($page->min_experience != ""){ echo "Years"; }?>
							</td>
						</tr>

						<tr>
							<td>CTC</td>
							<td><?=$page->ctc?></td>
						</tr>

						<tr>
						    <?php 
						        $location=$page->location;
						        $location_array=array_map('trim', array_filter(explode(",",$location)));
						        $location_impload_array=implode(", ",$location_array);
						    ?>
							<td>Location</td>
							<td> <?=$location_impload_array?></td>
						</tr>

						<tr>
							<td>Job Code</td>
							<td><?=$page->job_code?></td>
						</tr>

						<tr>
							<td>Posted On</td>
							<td><?=date("d M Y", $page->created)?></td>
						</tr>

						<tr>
							<td>Application Deadline</td>
							<td><?=date("d M Y", $page->application_deadline)?></td>
						</tr>

						<tr>
							<td  colspan="2" ><br><h4>Skills</h4><br><div style="margin-left:20px"><?=$page->skills?></div></td>
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
						<button type="button" id="job_code_<?=$page->job_code?>" class="( apply-button )[ px-5 ][ btn btn-primary ]"> Apply Now </button>
					</div>
				</div>
			</div>

			<div class="col-md">
			</div>
		</div>
	</div>

<!-- Add popup for "how did you hear about the job -->
<?php
	  if($page->is_popup_show_event != ""){
	?>
	<div id="about_job_modal" class="modal fade bd-modal-sm" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">                
                <h5 class="modal-title">Jobs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
						<form action="" method="POST" id="about_job_popup_form" enctype="multipart/form-data">
							<div class="modal-body"> 
									<!-- <h5>Please <a target="_blank" href="https://www.thepridecircle.com/resume/" style="text-decoration:none;">log in</a> and try again.</h5> -->
									<!-- <h5>Please <a target="_blank" href="https://zerovaega.in/pc_portal/resume/" style="text-decoration:none;">log in</a> and try again.</h5> -->
										<label for="sel1" class="form-label">How did you hear about the job?</label>
										<select class="form-control" name="about_job" aria-label="Default select example" required>
											<option value="" selected disabled>Please select option</option>
											<!-- <option value="Facebook">Facebook</option>
											<option value="Linkedin">Linkedin</option>
											<option value="Instagram">Instagram</option> -->
											<option value="Friend">Friend</option>
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
									<button type="button" class="btn btn-primary btn_submit_job" name="btn_submit_job" id="job_code_<?=$page->job_code?>">Submit</button>
								</div>
								
							</div>
						</form>
               
        </div>
    </div>
	</div>
	<?php
		}
	?>
	<!-- End popup jobs -->
	<!--Modal-->
	<div id="myModal" class="modal fade bd-modal-sm" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog ">
					<div class="modal-content">
							<div class="modal-header">                
									<h5 class="modal-title">Apply Now</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							</div>
							<div class="modal-body"> 
									<h5>Please <a target="_blank" href="https://www.thepridecircle.com/resume/" style="text-decoration:none;">log in</a> to apply.</h5>
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
			title: "Check this job opening on Pride Cricle now!",
			description: "Click on the link and log in to apply."
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
	

	<script src="<?php echo $config->urls->templates; ?>scripts/<?php echo $page->template;?>.js?i=s"></script>
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
 include(\ProcessWire\wire('files')->compile('includes/job_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/sticky-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>

<?php
 require(\ProcessWire\wire('files')->compile($config->paths->templates.'includes/footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>

