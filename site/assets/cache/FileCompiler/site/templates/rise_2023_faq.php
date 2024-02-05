<?php

if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
	//Tell the browser to redirect to the HTTPS URL.
	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	//Prevent the rest of the script from executing.
	exit;
}
?>
<html>
    <head>
        	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/style_rise.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/demoris2022.css?v=24.12" type="text/css" />

	<link rel="stylesheet" href="<?=$urls->httpTemplates?>styles/css_canvas/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/settings.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/layers.css">
	<link rel="stylesheet" type="text/css" href="<?=$urls->httpTemplates?>includes_allybook/css/navigation.css">

 

	<!-- Document Title
	============================================= -->
	<title><?=$page->name;?></title>
	<style>
		  /* css by pooja for ul , ol tags align properly whileusing ckeditor */
.ul-tag ul li{
	margin-left: 1rem !important;
}
.ul-tag ul li ul li{
	margin-left: 1em !important;
}


.ul-tag ol li{
margin-left: 1rem !important;
}

.ul-tag ol li ol li{
	margin-left: 1rem !important;
}

	
	</style>

    </head>
<body>
                        <section id="header_rise">
				            <div class=" img-responsive " > 
							    <img style="" class="img-fluid" src="<?=$page->ally_banner_image->httpUrl;?>">
							</div>
							<div class="img-responsive  mobile">
								 <img class="img-fluid"  src="<?=$page->ally_banner_mobile_image->httpUrl;?>">
							 </div>
                        </section>


        
        <div class="container mt-3 mb-6">
            <h2 style="font-family: 'Montserrat', sans-serif;" class="text-center"><?=$page->title?></h2>
            
            <div style="color: #020202;" class="mt-5 ul-tag">
                <?=$page->ticketing_terms_conditions?>
            </div>
            
        </div>

		<style>
			/* social media icons alignment in a footer */
			.social-media-row-alignment {
				justify-content: flex-end !important;
			}
			@media (max-width: 767px){
				.social-media-row-alignment {
					justify-content: center !important;
					}		
			}
		</style>
		<!-- Footer
		============================================= -->
<?php include(\ProcessWire\wire('files')->compile('includes/rise2023_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true))); ?>