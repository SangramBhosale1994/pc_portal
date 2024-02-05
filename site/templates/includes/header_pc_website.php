<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="htmlcss bootstrap centered menu, navbar, mega menu examples" />
<meta name="description" content="Bootstrap centered navbar examples for any type of project, Bootstrap 4" />  

<!-- ---------- META TAGS ---------- -->
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<!-- <meta property="og:title" content="Pride Circle">
	<meta property="og:image" content="<?=$config->urls->templates;?>images/pride-circle.jpg">
	<meta property="og:description" content="India's premier Diversity & Inclusion consulting 
">
	<meta property="og:url" content="<?=$page->httpUrl;?>">
 
	<meta name="twitter:title" content="Pride Circle | <?=$page->title?>">
	<meta name="twitter:description" content="India's premier Diversity & Inclusion consulting 
">
	<meta name="twitter:image" content="<?=$config->urls->templates;?>images/pride-circle.jpg">
	<meta name="twitter:card" content="">
 
	<meta property="og:site_name" content="Pride Circle">
	<meta name="twitter:image:alt" content="<?=$config->urls->templates;?>images/pride-circle.jpg"> -->
	<?php if($page->website_meta_image == 0 ) { ?>
		<meta property="og:image" content="<?=$config->urls->templates;?>images/pride-circle.jpg">
		<meta name="twitter:image" content="<?=$config->urls->templates;?>images/pride-circle.jpg">
		<meta name="twitter:image:alt" content="<?=$config->urls->templates;?>images/pride-circle.jpg">
	<?php } else { ?>
		<meta property="og:image" content="<?=$page->website_meta_image->httpUrl?>">
		<meta name="twitter:image" content="<?=$page->website_meta_image->httpUrl?>">
		<meta name="twitter:image:alt" content="<?=$page->website_meta_image->httpUrl?>">
	<?php } ?>


	<?php if($page->website_meta_description == 0 ) { ?>
		<meta property="og:description" content="India's premier Diversity & Inclusion consulting">
		<meta name="twitter:description" content="India's premier Diversity & Inclusion consulting">
	<?php } else { ?>
		<meta property="og:description" content="<?=$page->website_meta_description?>">
		<meta name="twitter:description" content="<?=$page->website_meta_description?>">
	<?php } ?>


	<meta property="og:url" content="<?php  
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
			$url = "https://";   
		else  
			$url = "http://";   
		// Append the host(domain name, ip) to the URL.   
		$url.= $_SERVER['HTTP_HOST'];   
		
		// Append the requested resource location to the URL   
		$url.= $_SERVER['REQUEST_URI'];        
		echo $url;  
  	?>">
 
	<!-- ---------- META TAGS END ---------- -->
	<!-- facebook verification code -->
	<meta name="facebook-domain-verification" content="tym36lnnu8qd0ts9mt7zguftrsmg8x" />

<!-- Global site tag (gtag.js) - Google Analytics -->

<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-C3XCR831MS"></script>
<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-C3XCR831MS');
</script> -->


<title><?=$page->title;?> | Pride Circle</title>

<link rel="icon" href="<?=$config->urls->templates;?>images/index.png" sizes="32x32" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>

<!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
<!-- Bootstrap -->
<link href="<?=$config->urls->templates;?>styles/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<!-- Font Awesome Icon -->
<link rel="stylesheet" href="<?=$config->urls->templates;?>styles/font-awesome.css">
<link rel="stylesheet" href="<?=$config->urls->templates;?>styles/font-awesome.min.css">

<!-- Font Awesome Icon -->
<link rel="stylesheet" href="<?=$config->urls->templates;?>styles/css/font-awesome.min.css">

<script src="https://kit.fontawesome.com/65fdf4282c.js" crossorigin="anonymous"></script>
<!-- Added for Copy Toast -->
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="<?=$config->urls->templates;?>styles/toast.style.css" rel="stylesheet" type="text/css"/>
<!-- Added for Copy Toast Ends -->
<!-- Custom stlylesheet -->
<link type="text/css" rel="stylesheet" href="<?=$config->urls->templates;?>styles/style_pc_website.css" />

<link type="text/css" rel="stylesheet" href="<?=$config->urls->templates;?>styles/<?=$page->template?>.css?m=<?=mt_rand(1,99)?>" />
<!-- <link type="text/css" rel="stylesheet" href="<?=$config->urls->templates;?>styles/css/sidebar.css" /> -->

<link type="text/css" rel="stylesheet" href="<?=$config->urls->templates;?>styles/article_page.css" />

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
	
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white ">
		<!-- logo -->
			<div class="nav-logo">
				<a href="<?=$pages->get('name=home')->httpUrl;?>" class="logo" style=""><img style="height: 70px;width:70px;" src="<?=$config->urls->templates;?>./images/pride_circle_logo_square.jpg" alt=""></a>
			</div>
		<!-- /logo -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" >
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- navbar-collapse -->
		<div class="collapse navbar-collapse" id="main_nav">
			 <?php $page_name=basename($_SERVER['PHP_SELF']); ?>
			<ul class="navbar-nav ">
				 <li class="nav-item"><a class="nav-link  <?php if($page_name=="<?=$pages->get('name=our-story')->httpUrl;?>"){echo "active";}?>"   href="<?=$pages->get('name=our-story')->httpUrl;?>"> About Us </a></li>
				<!-- <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown"   target="_blank" href="<?=$pages->get('name=our-story')->httpUrl;?>"> Our story </a>-->
				  <!--<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>	 -->
				<!--<ul class="dropdown-menu">-->
				<!--		<li class="dropdown-item"><a  class="nav-link" target="_blank" href="<?=$pages->get('name=our-story')->httpUrl;?>">Our story</a>-->
				<!--		</li>-->
				<!--		<li class="dropdown-item"><a  class="nav-link" target="_blank" href="<?=$pages->get('name=story')->httpUrl;?>">Our team </a>-->
				<!--		</li>-->
				<!--	</ul>-->
				<!--</li>-->
				
				<!-- <li class="nav-item active"><a class="nav-link" target="_blank" href="<?=$pages->get('name=story')->httpUrl;?>">Our Team </a> </li> -->
				<li class="nav-item"><a class="nav-link  <?php if($page_name=="<?=$pages->get('name=community_engagement')->httpUrl;?>"){echo "active";}?>"   href="<?=$pages->get('name=community_engagement')->httpUrl;?>"> Community</a></li>
				<li class="nav-item"><a class="nav-link  <?php if($page_name=="/corporate_outreach"){echo "active";}?>"   href="<?=$pages->get('name=corporate_outreach')->httpUrl;?>"> Workplace </a></li>
				<li class="nav-item"><a class="nav-link  <?php if($page_name=="<?=$pages->get('name=home-school')->httpUrl;?>"){echo "active";}?>"   href="<?=$pages->get('name=home-school')->httpUrl;?>"> Home & School </a></li>
				<!--<li class="nav-item"><a class="nav-link  <?php if($page_name=="<?=$pages->get('name=days_challenge')->httpUrl;?>"){echo "active";}?>"  target="_blank" href="<?=$pages->get('name=days_challenge')->httpUrl;?>"> #21Days Ally Challenge</a></li>-->
				
				<li class="nav-item"><a class="nav-link  <?php if($page_name=="<?=$pages->get('name=resource_center')->httpUrl;?>"){echo "active";}?>"   href="<?=$pages->get('name=resource_center')->httpUrl;?>"> Events </a></li>
				
				<li class="nav-item"><a class="nav-link" target="_blank"   href="https://www.thepridecircle.com/rise2022/"> Rise2022 </a></li>
				<li class="nav-item"><a class="nav-link  <?php if($page_name=="<?=$pages->get('name=articles')->httpUrl;?>"){echo "active";}?>"   href="<?=$pages->get('name=articles')->httpUrl;?>"> Articles </a></li>
    				
    		<li class="nav-item"><a class="nav-link"   href="mailto:rise@thepridecircle.com"> Contact us </a></li>
				
			</ul>
			
			<!-- <a class="btn btn-warning" href="#">Button</a> -->
			<ul class="nav-social ml-0">
				<li><a target="_blank" href="https://www.facebook.com/PrideCircles/"><i class="fa fa-facebook"></i></a></li>
				<li><a target="_blank" href="https://www.youtube.com/channel/UCoaAZWnpjFXcCQ5Und9mi0Q"><i class="fa fa-youtube"></i></a></li>
				<li><a target="_blank" href="https://twitter.com/pride_circle"><i class="fa fa-twitter"></i></a></li>
				<li><a target="_blank" href="https://www.instagram.com/pride_circle/"><i class="fa fa-instagram"></i></a></li>
				<li><a target="_blank" href="https://www.linkedin.com/signup/cold-join?session_redirect=https%3A%2F%2Fwww%2Elinkedin%2Ecom%2Fgroups%2F10392130%2F&trk=login_reg_redirect"><i class="fa fa-linkedin"></i></a></li>
				<li><a  href="mailto:contact@thepridecircle.com"><i class="fa fa-envelope "></i></a></li>
				
			</ul>
		</div> 
		<!-- navbar-collapse.// -->
	</nav>

<!--</body>-->
<!--</html>-->