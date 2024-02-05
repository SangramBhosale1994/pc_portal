<?php
	$rootpath = $config->urls->templates;

    if($session->discount == ""){
        $session->discount=0;
    }
	
/*
	File created 2021-03-07
	Primary code by Amrut Todkar

	This page will be the common header for the ticketng platform.

*/
	/* Check if the page is called with HTTPS. if not, redirect it to HTTPS  */
	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	{
		//Tell the browser to redirect to the HTTPS URL.
		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
		//Prevent the rest of the script from executing.
		exit;
	}

	/* Check if the session already has other tickets added. */
	if (!$session->tickets_json) {
		/* If the tickets json does not exist, create it. Make it an object with a tickets array in it.  */
		$session->tickets_json = '{}';
	}
	$count=0;$total=0;
	foreach (json_decode($session->tickets_json) as $single_ticket) {
		$total += $single_ticket->price;
	    $count++;    
	}
//print_r($session->tickets_json);

/* Code to delete all the ticekts from the session. Keep commented. use only when debugging and you need to emty the tickets in the session. */
//$session->remove('tickets_json');
	/* Check if the session already has other tickets added. END */
?>

<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
	<!-- Global site tag (gtag.js) - Google Analytics -->
<!--	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155220702-1"></script>-->

<!--	<script>-->
<!--		window.dataLayer = window.dataLayer || [];-->
<!--		function gtag(){dataLayer.push(arguments);}-->
<!--		gtag('js', new Date());-->

<!--		gtag('config', 'UA-155220702-1');-->
<!--	</script>-->

<!--	<script>-->
		<!--//let website_rootpath = '<?=$config->urls->httpRoot?>resume/';-->
<!--	</script>-->

	<!-- Global site tag (gtag.js) - Google Analytics End -->


<!--	<title>Application Form | Pride Circle</title>-->

<!--	<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>-->

<!--	<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />-->

	<!-- ---------- META TAGS ---------- -->
<!--	<meta charset="utf-8">-->
<!--	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
<!--	<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
<!--	<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css">-->
	<!-- Universal Style CSS -->
	<!--<link href="<?= $rootpath;?>styles/style.css" rel="stylesheet" type="text/css">-->
	<!-- Page-Specific Style CSS -->
<!--	<link href="<?= $rootpath;?>styles/<?=$page->template?>.css" rel="stylesheet" type="text/css">-->
	
<!--	<link rel="stylesheet" href="<?= $rootpath;?>styles/fm.tagator.jquery.css">-->
	
<!--	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />-->
	<!-- ---------- CSS LINKS END ---------- -->

	<!-- ---------- JS LINKS ---------- -->
	<!-- JQuery -->
<!--	<script src="<?= $rootpath;?>scripts/jquery.min.js" type="text/javascript"></script>-->
	<!-- Popper Js -->
<!--	<script src="<?= $rootpath;?>scripts/popper.min.js" type="text/javascript"></script>-->
	<!-- Bootstrap Js -->
<!--	<script src="<?= $rootpath;?>scripts/bootstrap.min.js" type="text/javascript"></script>-->
	<!-- Fontawesome JS -->
<!--	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>-->
	
<!--	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>-->
	<!--<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->
<!--	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>-->
	<!--<script src="https://cdn.jsdelivr.net/npm/@firstandthird/tokens@latest/dist/tokens.bundle.js"></script>-->
	<!-- ---------- JS LINKS END ---------- -->
<!--</head>-->


<!--===-->


<html>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
       
        <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-C3XCR831MS');
        </script> -->

        <!-- Global site tag (gtag.js) - Google Analytics End -->

        <title> <?=$page->title?> | Pride Circle</title>

        <link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

        <!-- ---------- META TAGS ---------- -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<meta property="og:title" content="<?=$page->title;?>">
	    <meta property="og:image" content='<?=$pages->get('name=rise2022-header')->general_image->httpUrl;?>'>
	    <meta property="og:description" content="<?=$pages->get('name=rise2022-header')->og_description?>">
	    <meta property="og:url" content="<?= $page->httpUrl ?>">
	    <meta property="og:type" content="article" />

	    <meta name="twitter:title" content='<?=$page->title;?>'>
	    <meta name="twitter:description" content="<?=$pages->get('name=rise2022-header')->og_description?>">
	    <meta name="twitter:image" content='<?=$pages->get('name=rise2022-header')->general_image->httpUrl;?>'>
	    <meta name="twitter:card" content="<?=$page->title;?>">

	    <meta property="og:site_name" content="<?=$page->title;?>">
	    <meta name="twitter:image:alt" content="<?=$page->title;?>">
	    <!-- ---------- META TAGS END ---------- -->

        <link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />

        <!-- ---------- CSS LINKS ---------- -->
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css?v=15.02">
        <!-- Universal Style CSS -->
        <link href="<?= $rootpath;?>styles/style.css" rel="stylesheet" type="text/css">
        <!-- Page Specific Style CSS -->
        <!--<link href="<?= $rootpath;?>styles/login-with-email.css" rel="stylesheet" type="text/css">-->

            <!-- Universal Style CSS -->
        <link href="<?= $rootpath;?>styles/style.css?v=<?=mt_rand(0,999)?>" rel="stylesheet" type="text/css">
        <!-- Page Specific Style CSS -->
        <link rel="stylesheet" href="<?= $rootpath;?>styles/<?=$page->template;?>.css"/>
        
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
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
    <body>
        <div id="top-container">
            <!-- <img src="<?=$rootpath;?>images/desktop-short.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

            <img src="<?=$rootpath;?>images/mobile-short.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image"> -->

            <img src="<?=$rootpath;?>images/ticketing-platform-conference-web.jpg" class="[ img-fluid mb-3 ]( mobile-hide )" alt="Pride Circle Banner Image">

            <img src="<?=$rootpath;?>images/ticketing-platform-conference-mobile.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
        </div>
    
       
        <div>
             <h1 class="title_text_size text-center " style="font-family: 'Montserrat', sans-serif;">RISE CONFERENCE 2022 (VIRTUAL)<br>EVENT PASSES

</h1>
        </div>
    
