<?php
	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
  {
      //Tell the browser to redirect to the HTTPS URL.
      header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
      //Prevent the rest of the script from executing.
      exit;
  }
		$job_search_data_set=[];
		$job_search_data_set['experience_years']="";
		$job_search_data_set['key_skills']="";
		$job_search_data_set['preferred_location']="";
		$job_search_data_set['job_type']="";
		$job_search_data_set['company_name']="";

		global $job_added_by;
		$job_added_by="";
		if(isset($_GET['company_id'])){
			$job_added_by=$_GET['company_id'];
		}
		$rootpath = $config->urls->templates;
		
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>

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
	<link href="<?= $urls->httpTemplates;?>styles/<?=$page->template?>.css" rel="stylesheet" type="text/css">
		<!--<link href="<?= $urls->httpTemplates;?>styles/job-list.css?v=19.01.22" rel="stylesheet" type="text/css">-->
	<!-- Share button CSS -->
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/needsharebutton.min.css">
	
	<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/fm.tagator.jquery.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
	
	<!-- Need Share button CSS  -->
		<link rel="stylesheet" href="<?= $urls->httpTemplates;?>styles/needsharebutton.min.css">

        
	
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<script>
	    let company_id = 0;
	    <?php
	        echo "company_id=".$page->id.";";
	    ?>
	</script>
	<!-- JQuery -->
	<script src="<?= $urls->httpTemplates;?>scripts/jquery.min.js" type="text/javascript"></script>

	<script src="<?= $config->urls->templates ?>scripts/<?php echo $page->template;?>.js?v=14.06.2022"></script>
	<!-- Popper Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/popper.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $urls->httpTemplates;?>scripts/bootstrap.min.js" type="text/javascript"></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
	<script src="<?= $urls->httpTemplates;?>scripts/fm.tagator.jquery.js?v=19.02"></script>
	  
    <!-- Suraj Gharpankar Starts-->

	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
	<!-- Suraj Gharpankar Ends -->
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
	#pagin_top_prev{
		border-radius:0rem !important;
	}
	#pagin_top_next{
		border-radius:0rem !important;
	}
	#pagin_bottom_prev{
		border-radius:0rem !important;
	}
	#pagin_bottom_next{
		border-radius:0rem !important;
	}
	#job_container_row{
		justify-content:center;
	}
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
		<!--<img src="<?=$urls->httpTemplates;?>images/job_desktop.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">-->

		<!--<img src="<?=$urls->httpTemplates;?>images/job_mobile.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">-->
		<?php
		    if($page->image){
		?>
		<img src="<?=$page->image->httpUrl?>" class="[ img-fluid ]( mobile-hide ) w-100" alt="Banner Image">
		<?php
		    }
		?>
		
		<?php
		    if($page->footer_web_banner){
		?>
		<img src="<?=$page->footer_web_banner->httpUrl?>" class="[ img-fluid ]( mobile-show ) w-100" alt="Banner Image">
		<?php
		    }
		?>
		
		<?php
		    if($page->footer_logo   ){
		?>
		<div class="d-flex justify-content-center">
		    <img src="<?=$page->footer_logo->httpUrl?>" class="[ img-fluid shadow-sm ]" style="max-width:200px; margin-top: -25px;border: 1px solid #e2e2e2;" alt="Logo">
		</div>
		<?php
		    }
		?>
	</div>


    <div class="[ my-2 ]">
        <ul class="nav nav-pills mb-3 [ d-flex justify-content-center ]" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-overview-tab" data-toggle="pill" href="#pills-overview" role="tab" aria-controls="pills-overview" aria-selected="true">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-why-join-us-tab" data-toggle="pill" href="#pills-why-join-us" role="tab" aria-controls="pills-why-join-us" aria-selected="false">Why Join Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-jobs-tab" data-toggle="pill" href="#pills-jobs" role="tab" aria-controls="pills-jobs" aria-selected="false">Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-connect-tab" data-toggle="pill" href="#pills-connect" role="tab" aria-controls="pills-connect" aria-selected="false">Connect</a>
            </li>
            
            



        </ul>
        
        
        <div class="tab-content" id="pills-tabContent">
            <div class="container tab-pane fade show active" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab">
                <div>
                    A card in Bootstrap 4 is a bordered box with some padding around its content. It includes options for headers, footers, content, colors, etc.A card in Bootstrap 4 is a bordered box with some padding around its content. It includes options for headers, footers, content, colors, etc.A card in Bootstrap 4 is a bordered box with some padding around its content. It includes options for headers, footers, content, colors, etc.
                </div>
                <div class="[ mt-2 mb-3 row d-flex justify-content-center ]">
                    <?php
                        for($i=0; $i<3; $i++){
                    
                    ?>
                    <div class="[ col-3 my-2 ]">
                        <div class="article-container">
                            <a href="#">
                                <img src="https://www.thepridecircle.com/site/assets/files/22257/iwei_-_website_cover.jpg" class="article-img img-fluid">
                            </a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="container tab-pane fade" id="pills-why-join-us" role="tabpanel" aria-labelledby="pills-why-join-us-tab">
                A card in Bootstrap 4 is a bordered box with some padding around its content. It includes options for headers, footers, content, colors, etc.A card in Bootstrap 4 is a bordered box with some padding around its content. It includes options for headers, footers, content, colors, etc.A card in Bootstrap 4 is a bordered box with some padding around its content. It includes options for headers, footers, content, colors, etc. 
            </div>
            <div class="container-fluid tab-pane fade" id="pills-jobs" role="tabpanel" aria-labelledby="pills-jobs-tab">
                <div id="job_card_section" class="[ col-sm-12 job_card_section scrollable-element ]" style="">
					<div  class="mt-5">
						<ul id="paginTop" class="pagination justify-content-center overflow-auto">

						</ul>
					</div>
					<div id="job_container_row" class="[ row ]">
					</div>     
					<div class="mt3">
							<ul id="paginBottom" class="pagination justify-content-center ">
									
							</ul>
					</div>
				</div>    
            </div>
            <div class="container tab-pane fade" id="pills-connect" role="tabpanel" aria-labelledby="pills-connect-tab">
                <div class="[ my-3 d-md-flex justify-content-center text-center ]">
                    <a href="mailto:contact@email.com" type="button" class="[ btn btn-outline-primary badge-pill px-4 mx-2 mb-2 ]"> <i class="far fa-envelope"></i> contact@gmailcont.com</a>
                    <a href="tel:+917972724141" type="button" class="[ btn btn-outline-primary badge-pill px-4 mx-2 mb-2 ]"> <i class="fas fa-phone-alt"></i> +91 7972724141</a>
                    <a href="" type="button" class="[ btn btn-outline-primary badge-pill px-4 mx-2 mb-2 ]"> <i class="fas fa-map-marker-alt"></i> Pune, Mumbai, Bangalore</a>
                </div>
                
                <div class="social_media_links">
                    <ul class="social-links">
                        <li><a href="#" style="-webkit-transition:0s;
                              transition:0s;" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#" style="-webkit-transition:0s;
                              transition:0s;" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" style="-webkit-transition:0s;
                              transition:0s;" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" style="-webkit-transition:0s;
                              transition:0s;" target="_blank"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>        
        </div>
    </div>















<!-- Code ended by : Suraj Gharpankar -> Job page modal code -->

	<!-- <script src="<?=$config->urls->templates?>scripts/needsharebutton.min.js"></script> -->
	<script>
		
		<?php
			//foreach ($filtered_job_pages as $job_page) {
		?>

		// new needShareDropdown(document.getElementById("share-button-<?=$job_page->id?>"), {
		//     //console.log($job_page->id);
		// 	url: "<?=$job_page->httpUrl?>",
		// 	title: "Check this job opening on Pride Cricle now!",
		// 	description: "Click on the link and log in to apply."
		// });

		<?php
		//	}
		?>

	</script>

        <!-- <script src="<?=$urls->httpTemplates;?>scripts/jquery.min.js"></script>
        <script src="<?=$urls->httpTemplates;?>scripts/popper.min.js"></script>
        <script src="<?=$urls->httpTemplates;?>scripts/bootstrap.min.js"></script> -->

         <!-- Code Starts:  Suraj Gharpankar : COPY BUTTON : 21-01-22 -->   
  <script>
	    $(document).on('click', '.copy_link', function(){
	        //console.log("$page->httpUrl");
            var job_page_url=$(this).prop("title");
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
     <!-- Code Ends:  Suraj Gharpankar : COPY BUTTON : 21-01-22 -->   
<?php
$show_popup=1;
if(isset($_GET['company_id'])){
	$show_popup=0;
}
?>

    <script>
        // $(window).on("load", function () {
        //     $("#exampleModal").show();
        // });
        // $('#myModal').on('shown.bs.modal', function () {
        //     $('#myInput').trigger('focus');
        // });
        $(document).ready(function(){ 
				let show_popup=<?=$show_popup?>;
				     
		// checkCookie();
		let user = getCookie("username");
		if (user != "" || show_popup==0 ) {
			
			$('#login_popup_modal').modal('hide');
		} else {
			user = 'login_popup_land';					
			$('#login_popup_modal').modal('show');
            setCookie("username", user, 5);

		}
		
	});

	let cname = "login_popup";
	let cvalue = 'login_popup_land';
	let exdays = 5;
	
	function setCookie(cname,cvalue,exdays) {
		const d = new Date();
        //cookie set for one minute
		d.setTime(d.getTime() + (60 * 30000));
        //cookie set for one week
        
        // Suraj Gharpankar : Comment this line to avoid modal reappering after clickin on Fresher or Professional button : 27-01-22
        //d.setTime(d.getTime() + (expDays * 24 * 60 * 60 * 1000));
		let expires = "expires=" + d.toGMTString();


		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";	
    }

	function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(';');
		for(let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
			c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
			}
		}
	return "";
	}

    </script>

    <!-- Copy Link Script -->
    <script>
        $(document).on('click', '#copy_link', function(){
            //console.log("$page->httpUrl");
            let copy_text="<?php echo $job_page->httpUrl;?>";
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


        // Code Starts:  Suraj Gharpankar : Tooltip : 24-01-22 -->   
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        // Code Ends:  Suraj Gharpankar : Tooltip : 24-01-22 -->    
    </script>
    <!-- End Copy Link Script --> 
    
	<!-- <script src="<?= $config->urls->templates ?>scripts/<?php echo $page->template;?>.js?22-04"></script> -->
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
