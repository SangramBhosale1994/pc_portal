<?php
	// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	// {
	// 	//Tell the browser to redirect to the HTTPS URL.
	// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	// 	//Prevent the rest of the script from executing.
	// 	exit;
	// }

 require(\ProcessWire\wire('files')->compile("google/vendor/autoload.php",array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
//Step 1: Enter you google account credentials

$g_client = new Google_Client();
$g_client->setClientId("678071877513-n8lr3sircqhe5gvg6t7o3a3nn5piv79s.apps.googleusercontent.com");
$g_client->setClientSecret("4UKpeN-0BVZaqOM0ylKazGNb");
$g_client->setRedirectUri('http://demo.zerovaega.com/index.php?route=account/account');
$g_client->setScopes("email");

//Step 2 : Create the url
$auth_url = $g_client->createAuthUrl();

//Step 3 : Get the authorization  code
$code = isset($_GET['code']) ? $_GET['code'] : NULL;

//Step 4: Get access token
if(isset($code)) {
    try {
        $token = $g_client->fetchAccessTokenWithAuthCode($code);
        $g_client->setAccessToken($token);
    }catch (Exception $e){
        echo $e->getMessage();
    }
    try {
        $pay_load = $g_client->verifyIdToken();
    }catch (Exception $e) {
        echo $e->getMessage();
    }
} else{
    $pay_load = null;
}

if(isset($pay_load)){
	$session->oauth_gmail = $pay_load['email'];
	$session->user_designation = "candidate";
	
	if($pages->get("oauth_gmail=".$session->oauth_gmail)!= ""){
		header("Location:".$pages->get("oauth_gmail=".$session->oauth_gmail.",template=candidate_page")->url);
	}else{
		header("Location: form");
	}
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
</style>

			<div id="desktop-image-container" class="( mobile-hide )">
				<img src="<?=$rootpath;?>images/resume_portal_web_new.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

				<div id="desktop-login-container">
					<a href="<?=$auth_url;?>" id="desktop-login-button" class="[ btn rounded-pill ]( mobile-hide )">Login with Google</a>

					<a class="[ text-center ]" href="<?=$url_to_home?>resume/login-with-email" style="text-decoration: none; display: block;width: 100%"  title="Login with your email ID"><span class="text-muted">or </span> <span style="text-decoration: underline;"> Login With Email </span> </a>
				</div>
				
				<a  href="https://www.thepridecircle.com/jobs/" id="desktop-jobs-button" class="[ btn rounded-pill ]( mobile-hide )" target="_blank">Apply For Jobs</a>


				<div id="desktop-bottom-text" style="font-size: 0.9rem">
					For queries, please email us at&nbsp;<a href="mailto:contact@thepridecircle.com?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us"> contact@thepridecircle.com </a>
					<div class="[ my-1 ]"></div>
					<span  style="font-size: 0.7rem">Developed By  <a href="https://www.zerovaega.com/" target="_blank">Zerovaega Technologies</a></span>
				</div>
			</div>

			<div id="mobile-image-container" class="( mobile-show )">
				<img src="<?=$rootpath;?>images/resume_portal_mobile.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">

				<div id="mobile-login-container">
					<a href="<?=$auth_url;?>" id="mobile-login-button" class="[ btn rounded-pill ]( mobile-show )">Login with Google</a>

					<a href="<?=$url_to_home?>resume/login-with-email" class="[ text-center ]" href="<?=$url_to_home?>resume/login-with-email" style="text-decoration: none; display: block;width: 100%"  title="Login with your email ID"><span class="text-muted">or </span> <span style="text-decoration: underline;"> Login With Email </span> </a>
				</div>
				
				<a href="https://www.thepridecircle.com/jobs/" id="mobile-jobs-button" class="[ btn rounded-pill ]( mobile-show )" target="_blank">Apply For Jobs</a>

				<div id="mobile-bottom-text">
					<span>For queries, please email us at&nbsp;<a href="mailto:contact@thepridecircle.com?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us"> contact@thepridecircle.com </a></span>
					<div class="[ my-1 ]"></div>
					<span  style="font-size: 0.7rem">Developed By  <a href="https://www.zerovaega.com/" target="_blank">Zerovaega Technologies</a></span>
				</div>
			</div>
		
	</div>

	</div>
</body>
</html>
