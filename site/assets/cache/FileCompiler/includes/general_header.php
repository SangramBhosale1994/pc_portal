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
        <!--<link href="<?= $rootpath;?>styles/login-with-email.css" rel="stylesheet" type="text/css">-->

            <!-- Universal Style CSS -->
        <link href="<?= $rootpath;?>styles/style.css?v=<?=mt_rand(0,999)?>" rel="stylesheet" type="text/css">
        <!-- Page Specific Style CSS -->
        <link rel="stylesheet" href="<?= $rootpath;?>styles/<?=$page->template;?>.css"/>
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
    </head>
    <body>
        <div id="top-container">
            <!-- <img src="<?=$rootpath;?>images/desktop-short.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

            <img src="<?=$rootpath;?>images/mobile-short.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image"> -->

            <!--<img src="<?=$rootpath;?>images/Web_Banner_R2.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">-->

            <!--<img src="<?=$rootpath;?>images/Mobile_Banner_R2.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">-->
            
            <img src="<?=$pages->get("name=universe-header")->banner_image->httpUrl?>" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

            <img src="<?=$pages->get("name=universe-header")->Banner_image_mobile->httpUrl?>" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
        </div>



    
    </body>
</html>