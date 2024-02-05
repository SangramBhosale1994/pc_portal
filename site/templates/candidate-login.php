<?php
/** Amruta Jagtap: Candidate login is 1st page of resume portal. On this page display apply jobs and and candidate login sections. in apply section, when you click on "Apply for job" button then page redirect to job page. In candidate login section, there are two sections one is "Login with email" and second is "Login with google". Login with email is normal login section using email and Login with google is gmail login. */

	// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	// {
	// 	//Tell the browser to redirect to the HTTPS URL.
	// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	// 	//Prevent the rest of the script from executing.
	// 	exit;
	// }

// require ("google/vendor/autoload.php");
// //Step 1: Enter you google account credentials
// $g_client = new Google_Client();
// $g_client->setClientId("207925546618-0kiskvb554p6i24t1gdk75uig3ge3n6c.apps.googleusercontent.com");
// $g_client->setClientSecret("31SJZ_V_9QGDnfedqj9Q2rVU");
// $g_client->setRedirectUri($config->urls->httpRoot."resume/");
// $g_client->setScopes("email");

// //Step 2 : Create the url
// $auth_url = $g_client->createAuthUrl();

// //Step 3 : Get the authorization  code
// $code = isset($_GET['code']) ? $_GET['code'] : NULL;

// //Step 4: Get access token
// if(isset($code)) {
//     try {
//         $token = $g_client->fetchAccessTokenWithAuthCode($code);
//         $g_client->setAccessToken($token);
//     }catch (Exception $e){
//         echo $e->getMessage();
//     }
//     try {
//         $pay_load = $g_client->verifyIdToken();
//     }catch (Exception $e) {
//         echo $e->getMessage();
//     }
// } else{
//     $pay_load = null;
// }

// if(isset($pay_load)){
// 	$session->oauth_gmail = $pay_load['email'];
// 	$session->user_designation = "candidate";
	
// 	if($pages->get("oauth_gmail=".$session->oauth_gmail)!= ""){
// 		header("Location:".$pages->get("oauth_gmail=".$session->oauth_gmail.",template=candidate_page")->url);
// 	}else{
// 		header("Location: form");
// 	}
// }

/** To save hackathon interested candidate data */
		/** Get hackathon value from url */

		if($input->get('hackps', ["true"], false)){
			$hackps=$input->get('hackps');
			$session->hackps=$hackps;
		}
		
if($input->get('candidate_logout', ["true"], false)){
	/* Empty the session variables */
	// $session->user_email = "";
	$session->logout(); 
/* TODO remove the whole session */
}
$rootpath = $config->urls->templates;
$url_to_home = $config->urls->httpRoot;
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

		gtag('config', 'UA-155220702-1');
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics End -->
	<title>Login | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ---------- META TAGS END ---------- -->

	<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?= $rootpath;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page Specific Style CSS -->
	<link href="<?= $rootpath;?>styles/home.css" rel="stylesheet" type="text/css">
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
	<script src="<?= $rootpath;?>scripts/jquery.min.js" type="text/javascript"></script>
	<!-- Popper Js -->
	<script src="<?= $rootpath;?>scripts/popper.min.js" type="text/javascript"></script>
	<!-- Bootstrap Js -->
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js" type="text/javascript"></script>
	<!-- Fontawesome JS -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<!-- ---------- JS LINKS END ---------- -->
	

</head>
<body class="resume_portal resume_image">
	<div class="main-container">
		<div class="resume_portal">

<!--Styles for candidate page-->
<style type="text/css">
	#desktop-image-container{
		position: relative;
		width: 100%;
		height: auto;
	}

	#desktop-image-container img{
		width: 100%;
		height: auto;
	}

	#desktop-jobs-button {
		position: absolute;
		top: 80%;
		left: 25%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		background-color: #D75F19;
		color: white;
		font-size: 16px;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		text-align: center;
		width: 13em;
		height: 2.5rem;
		font-weight: bold;
		/*font-family:  RN House semi bold;*/
	}

	#desktop-login-container{
		position: absolute;
		top: 82%;
		left: 75%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
	}

	#desktop-login-button {
		background-color: #3F2767;
		color: white;
		font-size: 16px;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		text-align: center;
		width: 13em;
		height: 2.5rem;
		font-weight: bold;
		/*font-family:  RN House semi bold;*/
	}

	#desktop-bottom-text{
		position: absolute;
		bottom: 1%;
		left: 0%;
		/*transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);*/
		text-align: center;
		width: 100%;
	}




	#mobile-image-container{
		position: relative;
		width: 100%;
		height: auto;
	}

	#mobile-image-container img{
		width: 100%;
		height: auto;
	}

	#mobile-jobs-button {
		position: absolute;
		top: 55%;
		left: 61%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		background-color: #D75F19;
		color: white;
		font-size: 16px;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		text-align: center;
		width: 13em;
		height: 2.5rem;
		font-weight: bold;
		/*font-family:  RN House semi bold;*/
	}

	#mobile-login-container{
		position: absolute;
		top: 85%;
		left: 50%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
	}

	#mobile-login-button {
		background-color: #3F2767;
		color: white;
		font-size: 16px;
		border: none;
		cursor: pointer;
		border-radius: 5px;
		text-align: center;
		width: 13em;
		height: 2.5rem;
		font-weight: bold;
		/*font-family:  RN House semi bold;*/
	}

	#mobile-bottom-text{
		position: absolute;
		bottom: 1%;
		left: 0%;
		/*transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);*/
		text-align: center;
		width: 100%;
		font-size: 0.7rem;
	}

	@media only screen and (max-width: 359px) {
		#mobile-bottom-text{
			bottom: -3%;
		}
	}

	@media screen and (max-width: 1080px) and (min-width: 1920px) {
		#desktop-jobs-button {
			position: absolute;
			top: 66%;
			left: 25%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			background-color: #D75F19;
			color: white;
			font-size: 16px;
			border: none;
			cursor: pointer;
			border-radius: 5px;
			text-align: center;
			width: 13em;
			height: 2.5rem;
			font-weight: bold;
			/*font-family:  RN House semi bold;*/
		}

		#desktop-login-container{
			position: absolute;
			top: 68%;
			left: 75%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
		}

	}

	@media screen and (max-width: 2560px) and (min-width: 1440px) {
		#desktop-jobs-button {
			position: absolute;
			top: 66%;
			left: 25%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			background-color: #D75F19;
			color: white;
			font-size: 16px;
			border: none;
			cursor: pointer;
			border-radius: 5px;
			text-align: center;
			width: 13em;
			height: 2.5rem;
			font-weight: bold;
			/*font-family:  RN House semi bold;*/
		}

		#desktop-login-container{
			position: absolute;
			top: 68%;
			left: 75%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
		}

	}

	@media screen and (max-width: 1440px) and (min-width: 900px) {
		#desktop-jobs-button {
			position: absolute;
			top: 66%;
			left: 25%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			background-color: #D75F19;
			color: white;
			font-size: 16px;
			border: none;
			cursor: pointer;
			border-radius: 5px;
			text-align: center;
			width: 13em;
			height: 2.5rem;
			font-weight: bold;
			/*font-family:  RN House semi bold;*/
		}

		#desktop-login-container{
			position: absolute;
			top: 68%;
			left: 75%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
		}

	}

	@media screen and (max-width: 1024px) and (min-width: 768px) {
		#desktop-jobs-button {
			position: absolute;
			top: 57%;
			left: 25%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			background-color: #D75F19;
			color: white;
			font-size: 16px;
			border: none;
			cursor: pointer;
			border-radius: 5px;
			text-align: center;
			width: 13em;
			height: 2.5rem;
			font-weight: bold;
			/*font-family:  RN House semi bold;*/
		}

		#desktop-login-container{
			position: absolute;
			top: 59%;
			left: 75%;
			transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
		}

	}

	<?php
		if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
		?>
			.header_menu_banner{
				margin-top:4.2rem;
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
<!--End Style-->
<?php
		require_once 'includes/resume_header.php';
	?>          
            <!--On below section, Banner images display for web view and mobile view. There are separate banners or section. On banner image display buttons and links.-->
		<div class="header_menu_banner">
			<div id="desktop-image-container " class="( mobile-hide )">
				<img src="<?=$page->banner_image->httpUrl;?>" class="[ img-fluid ]( mobile-hide w-100 )" alt="Pride Circle Banner Image">
                <!--Login with google is not work on zerovaega site beacuse coinfiguration done on live site.-->
				<div id="desktop-login-container">
					<a href="<?=$auth_url;?>" id="desktop-login-button" class="[ btn rounded-pill ]( mobile-hide )">Login with Google</a>

					<a class="[ text-center ]" href="<?=$url_to_home?>resume/login-with-email" style="text-decoration: none; display: block;width: 100%"  title="Login with your email ID"><span class="text-muted">or </span> <span style="text-decoration: underline;"> Login With Email </span> </a>
				</div>
				
				<a  href="https://zerovaega.in/pc_portal/jobs/" id="desktop-jobs-button" class="[ btn rounded-pill ]( mobile-hide )" target="_blank">Apply For Jobs</a>


				<div id="desktop-bottom-text" style="font-size: 0.9rem">
					For queries, please email us at&nbsp;<a href="mailto:contact@thepridecircle.com?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us"> contact@thepridecircle.com </a>
					<div class="[ my-1 ]"></div>
					<!-- <span  style="font-size: 0.7rem">Developed By  <a href="https://www.zerovaega.com/" target="_blank">Zerovaega Technologies</a></span> -->
				</div>
			</div>

			<div id="mobile-image-container " class="( mobile-show )">
				<img src="<?=$page->Banner_image_mobile->httpUrl;?>" class="[ img-fluid ]( mobile-show w-100 )" alt="Pride Circle Banner Image">
				
                <!--Login with google is not work on zerovaega site beacuse coinfiguration done on live site.-->
				<div id="mobile-login-container">
					<a href="<?=$auth_url;?>" id="mobile-login-button" class="[ btn rounded-pill ]( mobile-show )">Login with Google</a>

					<a href="<?=$url_to_home?>resume/login-with-email" class="[ text-center ]" href="<?=$url_to_home?>resume/login-with-email" style="text-decoration: none; display: block;width: 100%"  title="Login with your email ID"><span class="text-muted">or </span> <span style="text-decoration: underline;"> Login With Email </span> </a>
				</div>
				
				<a href="https://zerovaega.in/pc_portal/jobs/" id="mobile-jobs-button" class="[ btn rounded-pill ]( mobile-show )" target="_blank">Apply For Jobs</a>

				<div id="mobile-bottom-text">
					<span>For queries, please email us at&nbsp;<a href="mailto:contact@thepridecircle.com?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us"> contact@thepridecircle.com </a></span>
					<div class="[ my-1 ]"></div>
					<!-- <span  style="font-size: 0.7rem">Developed By  <a href="https://www.zerovaega.com/" target="_blank">Zerovaega Technologies</a></span> -->
				</div>
			</div>
		</div>
		
	</div>

	</div>

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
</body>
</html>
