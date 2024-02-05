<?php

// 	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// 	{
// 		//Tell the browser to redirect to the HTTPS URL.
// 		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 		//Prevent the rest of the script from executing.
// 		exit;
// 	}
	
	$referrer_code_cookie_value = false;
	$required="required";
	if($session->user_designation == "admin" && isset($_GET['page_id'])){
		$required="";
		$user_page = $pages->get($_GET['page_id']);
	}
	elseif($session->oauth_gmail == ""){
		header("Location: ".$config->urls->httpRoot."resume/");
	}
	elseif($pages->get("oauth_gmail=".$session->oauth_gmail.",template=candidate_page")== ""){
		header("Location: ".$pages->get("name=form")->url);
	}
	else{
		$user_page = $pages->get("oauth_gmail=".$session->oauth_gmail);
	}

	$rootpath = $config->urls->templates;
	$user_data_set = [];
	$user_data_select = [];
	$user_data_textarea=[];

	$user_data_set['first_name'] = $user_page->first_name;
	$user_data_set['last_name'] = $user_page->last_name;
	$user_data_set['preferred_name'] = $user_page->preferred_name;
	$user_data_select['pronoun'] = $user_page->pronoun;
	$user_data_select['identify_as'] = $user_page->identify_as;
	//$user_data_set['date_of_birth'] = date("Y-m-d", $user_page->date_of_birth);
	$user_data_set['email'] = $user_page->email;
	$user_data_set['phone_country_code'] = $user_page->phone_country_code;
	$user_data_set['phone_number'] = $user_page->phone_number;
	$user_data_set['whatsapp_country_code'] = $user_page->whatsapp_country_code;
	$user_data_set['whatsapp_number'] = $user_page->whatsapp_number;
	$user_data_select['current_city'] = $user_page->current_city;
	$user_data_set['current_state'] = $user_page->current_state;
	$user_data_set['linkedin_url'] = $user_page->linkedin_url;
	$user_data_set['qualification'] = addslashes($user_page->qualification);
	/*$user_data_select['course'] = $user_page->course;*/
	//$user_data_set['specialisation'] = $user_page->specialisation;
	$user_data_set['year_of_passing'] = $user_page->year_of_passing;
	//$user_data_set['college'] = $user_page->college;
	//$user_data_set['cartifications'] = $user_page->cartifications;
	/*$user_data_select['industry'] = $user_page->industry;*/
	/*$user_data_select['functional_area'] = $user_page->functional_area;*/
	$user_data_set['experience_years'] = $user_page->experience_years;
	$user_data_set['experience_months'] = $user_page->experience_months;
	$user_data_set['current_employer'] = $user_page->current_employer;
	$user_data_set['current_role'] = $user_page->current_role;
// 	$user_data_set['technical_skills'] = $user_page->technical_skills;
// 	$user_data_set['non_technical_skills'] = $user_page->non_technical_skills;
	$user_data_set['skills'] = $user_page->skills;
	$user_data_set['current_ctc_time'] = $user_page->current_ctc_time;
	$user_data_set['current_ctc'] = $user_page->current_ctc;
	$user_data_set['current_ctc_currency'] = $user_page->current_ctc_currency;
	//$user_data_textarea['tell_us_about_yourself'] =str_replace("\n,\r,\t,\'","\\n\\r\\t\\'",$user_page->tell_us_about_yourself); preg_replace('/[^A-Za-z0-9\-]/', '', $string)
	//$user_data_textarea['tell_us_about_yourself'] =addslashes($user_page->tell_us_about_yourself);
	$user_data_textarea['tell_us_about_yourself'] =str_replace("\n","\\n",htmlentities(addslashes($user_page->tell_us_about_yourself)));
	$user_data_set['how_did_you_know_about_us'] = $user_page->how_did_you_know_about_us;
	//$user_data_set['tell_us_about_yourself'] = $user_page->tell_us_about_yourself;
// 	$user_data_set['preferred_location1'] = $user_page->preferred_location1;
// 	$user_data_set['preferred_location2'] = $user_page->preferred_location2;
	/*$user_data_select['preferred_location3'] = $user_page->preferred_location3;*/
//	$user_data_set['pwd_accomodation'] = $user_page->pwd_accomodation;
	$user_data_set['referred_by'] = $user_page->referred_by;
	$user_data_set['referrer_email'] = $user_page->referrer_email;
	$user_data_set['job_code'] = $user_page->job_code;
	$user_data_set['out_at_work'] = $user_page->out_at_work;



	//$user_data_select['pronoun'] = $user_page->pronoun;
	//$user_data_select['identify_as'] = $user_page->identify_as;
	$user_data_select['current_city'] = $user_page->current_city;
//	echo $user_page->current_city;
// 	$user_data_select['qualification'] = $user_page->qualification;
// 	$user_data_select['course'] = $user_page->course;
// 	$user_data_select['industry'] = $user_page->industry;
// 	$user_data_select['functional_area'] = $user_page->functional_area;
// 	$user_data_select['preferred_location3'] = $user_page->preferred_location3;

//separate salary and currency in current_ctc word
// $current_ctc = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$user_data_set['current_ctc']); 
//  $user_data_set['current_ctc']=$current_ctc[0];
//  $user_data_set['current_ctc_currency']=$current_ctc[1];
//echo($current_ctc[0]);

	$out_at_work = $user_page->out_at_work;
	$active_status = $user_page->active_status;
	$lgbtq_verification=$user_page->lgbtq_verification;
	if($user_page->resume){
	    $resume_url = $user_page->resume->url;
	}
	else{
	    $resume_url = '#';
	}
	
	//$profile_image_url = $user_page->profile_image->url;

	$redacted_resume_url = "";
	if($user_page->redacted_resume){
		$redacted_resume_url = $user_page->redacted_resume->url;
	}


	$user_page_url = $user_page->httpUrl;
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

	<title>Edit Application Form | Pride Circle</title>

	<link rel="shortcut icon" type="image/png" href="<?= $rootpath;?>images/frontend/favicon.png"/>

	<link rel="icon" href="<?= $rootpath;?>images/index.png" sizes="32x32" />
	
	


	<!-- ---------- META TAGS ---------- -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- ---------- META TAGS END ---------- -->

	<!-- ---------- CSS LINKS ---------- -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap.min.css">
	<!-- Universal Style CSS -->
	<link href="<?= $rootpath;?>styles/style.css" rel="stylesheet" type="text/css">
	<!-- Page-Specific Style CSS -->
	<link href="<?= $rootpath;?>styles/<?=$page->template?>.css" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" href="<?= $rootpath;?>styles/fm.tagator.jquery.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" />
	<!--<link rel="stylesheet" href="<?= $rootpath;?>styles/bootstrap-tagsinput.css">-->
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
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>
	<!-- ---------- JS LINKS END ---------- -->

	<script>
		let website_rootpath = '<?=$config->urls->httpRoot?>resume/';

		$(document).ready(function(){
			
			<?php
				foreach ($user_data_set as $key => $value) {
			?>

			$('#<?=$key?>').val('<?=$value?>');
			

			<?php
				}
				
			?>
			// let temp_textarea="";
				<?php
			        foreach ($user_data_textarea as $key => $value) {
			    ?>
			    <?php
		
				    //$value[$key]=addslashes($user_data_textarea[$key]);
				    //$value=html_entity_decode($value);
				?>
				$('#<?=$key?>').html('<?=$value?>').text();
				
		
			<?php
				}
				
			?>

			//$("input[name='out_at_work']").val(["<?=$out_at_work?>"]);

			$("input[name='active_status']").val(["<?=$active_status?>"]);
			
			$("input[name='lgbtq_verification']").val(["<?=$lgbtq_verification?>"]);

			<?php
				foreach ($user_data_select as $key => $value) {
			?>

			if($("#<?=$key?> option[value='<?=$value?>']").length){
				$("#<?=$key?>").val("<?=$value?>");
			}
			else{
				$("#<?=$key?>").val("other");
				$("#<?=$key?>"+"_custom_container").show();
				$("#<?=$key?>"+"_custom").prop('required',true);
				$("#<?=$key?>"+"_custom").val("<?=$value?>");
			}

			<?php
				}
			?>

		})
	</script>

</head>

<body>
	<div id="top-container">
		<img src="<?=$rootpath;?>images/desktop-short.jpg" class="[ img-fluid ]( mobile-hide )" alt="Pride Circle Banner Image">

		<img src="<?=$rootpath;?>images/mobile-short.jpg" class="[ img-fluid ]( mobile-show )" alt="Pride Circle Banner Image">
	</div>

	<form id="main-container" class="[ my-5 px-sm-5 ][ container rounded tab-content ][ needs-validation ]" action="<?=$config->urls->httpRoot?>resume/thank-you/?edit_application=<?=$user_page->id?>&page_id=<?=$user_page->id?>" method="POST" enctype="multipart/form-data" novalidate>
		<!-- PERSONAL INFORMATION TAB -->
		<div id="personal-tab" class="[ tab-pane fade show active ]" role="tabpanel" aria-labelledby="personal-tab">
			<!--<div class="[ my-2 ][ text-center bg-primaryy ]">-->
			<!--	<h3>Personal Information</h3>-->
			<!--</div>-->

			<div class="[ d-none ]">
				<input id="page_to_edit_id" class="form-control" type="text" value="<?=$user_page->id?>" name="page_to_edit_id" hidden>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="first_name">Legal name</label>
				<input id="first_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="first_name" placeholder="Legal Name" <?=$required?>>

				<div class="invalid-tooltip">
					Please provide a valid name.
				</div>
			</div>

			<!--<div class="[ my-5 ][ form-group ]">-->
			<!--	<label for="last_name">Legal Last Name</label>-->
			<!--	<input id="last_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="last_name" placeholder="Legal Last Name" required>-->

			<!--	<div class="invalid-tooltip">-->
			<!--		Please provide a valid name.-->
			<!--	</div>-->
			<!--</div>-->

			<div class="[ my-5 ][ form-group ]">
				<label for="preferred_name">Preferred Name </label>
				<input id="preferred_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="preferred_name" placeholder="Preferred Name" <?=$required?>>

				<div class="invalid-tooltip">
					Please provide a valid name.
				</div>
			</div>
			
			<div class="[ my-5 ][ form-group ]">
				<label for="identify_as">Identify as:</label>
				<select id="identify_as" class="custom-select" name="identify_as" <?=$required?>>
					<option value="" selected hidden>Identify as</option>
					<option value="Lesbian">Lesbian</option>
					<option value="Gay">Gay</option>
					<option value="Bisexual">Bisexual</option>
					<option value="Transwoman">Transwoman</option>
					<option value="Transman">Transman</option>
					<option value="Queer">Queer</option>
					<option value="Pansexual">Pansexual</option>
					<option value="Asexual">Asexual</option>
					<option value="Intersex">Intersex</option>
					<option value="Gender Non-Conforming / Gender Non-Binary">Gender Non-Conforming / Gender Non-Binary</option>
					<option value="other">Other</option>
				</select>

				<div class="invalid-tooltip">
					Please select how you identify as.
				</div>
			</div>
			<div id="identify_as_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="identify_as_custom">Please mention how you identify as</label>

				<input id="identify_as_custom" class="form-control"  type="text" name="identify_as_custom" placeholder="Identify as">

				<div class="invalid-tooltip">
					Please state how you identidy as.
				</div>
			</div>
			
			<div class="[ my-5 ][ form-group ]">
				<label for="email">Email</label>
				<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" value="<?=$session->oauth_gmail;?>" <?=$required?>>

				<div class="invalid-tooltip">
					Please provide a valid email address.
				</div>
			</div>
			
				<div class="[ my-5 ][ form-group ]">
				<label for="phone_number">Phone number</label>

				<div class="row no-gutters">
					<select id="phone_country_code" class="[ col-4 pl-2 ][ custom-select ]" name="phone_country_code">
						<option value="+376">(AD) +376</option>
						<option value="+971">(AE) +971</option>
						<option value="+93">(AF) +93</option>
						<option value="+1-268">(AG) +1-268</option>
						<option value="+1-264">(AI) +1-264</option>
						<option value="+355">(AL) +355</option>
						<option value="+374">(AM) +374</option>
						<option value="+599">(AN) +599</option>
						<option value="+244">(AO) +244</option>
						<option value="+672">(AQ) +672</option>
						<option value="+54">(AR) +54</option>
						<option value="+1-684">(AS) +1-684</option>
						<option value="+43">(AT) +43</option>
						<option value="+61">(AU) +61</option>
						<option value="+297">(AW) +297</option>
						<option value="+994">(AZ) +994</option>
						<option value="+387">(BA) +387</option>
						<option value="+1-246">(BB) +1-246</option>
						<option value="+880">(BD) +880</option>
						<option value="+32">(BE) +32</option>
						<option value="+226">(BF) +226</option>
						<option value="+359">(BG) +359</option>
						<option value="+973">(BH) +973</option>
						<option value="+257">(BI) +257</option>
						<option value="+229">(BJ) +229</option>
						<option value="+590">(BL) +590</option>
						<option value="+1-441">(BM) +1-441</option>
						<option value="+673">(BN) +673</option>
						<option value="+591">(BO) +591</option>
						<option value="+55">(BR) +55</option>
						<option value="+1-242">(BS) +1-242</option>
						<option value="+975">(BT) +975</option>
						<option value="+267">(BW) +267</option>
						<option value="+375">(BY) +375</option>
						<option value="+501">(BZ) +501</option>
						<option value="+1">(CA) +1</option>
						<option value="+61">(CC) +61</option>
						<option value="+243">(CD) +243</option>
						<option value="+236">(CF) +236</option>
						<option value="+242">(CG) +242</option>
						<option value="+41">(CH) +41</option>
						<option value="+225">(CI) +225</option>
						<option value="+682">(CK) +682</option>
						<option value="+56">(CL) +56</option>
						<option value="+237">(CM) +237</option>
						<option value="+86">(CN) +86</option>
						<option value="+57">(CO) +57</option>
						<option value="+506">(CR) +506</option>
						<option value="+53">(CU) +53</option>
						<option value="+238">(CV) +238</option>
						<option value="+599">(CW) +599</option>
						<option value="+61">(CX) +61</option>
						<option value="+357">(CY) +357</option>
						<option value="+420">(CZ) +420</option>
						<option value="+49">(DE) +49</option>
						<option value="+253">(DJ) +253</option>
						<option value="+45">(DK) +45</option>
						<option value="+1-767">(DM) +1-767</option>
						<option value="+1-809">(DO) +1-809</option>
						<option value="+213">(DZ) +213</option>
						<option value="+593">(EC) +593</option>
						<option value="+372">(EE) +372</option>
						<option value="+20">(EG) +20</option>
						<option value="+212">(EH) +212</option>
						<option value="+291">(ER) +291</option>
						<option value="+34">(ES) +34</option>
						<option value="+251">(ET) +251</option>
						<option value="+358">(FI) +358</option>
						<option value="+679">(FJ) +679</option>
						<option value="+500">(FK) +500</option>
						<option value="+691">(FM) +691</option>
						<option value="+298">(FO) +298</option>
						<option value="+33">(FR) +33</option>
						<option value="+241">(GA) +241</option>
						<option value="+44">(GB) +44</option>
						<option value="+1-473">(GD) +1-473</option>
						<option value="+995">(GE) +995</option>
						<option value="+44-1481">(GG) +44-1481</option>
						<option value="+233">(GH) +233</option>
						<option value="+350">(GI) +350</option>
						<option value="+299">(GL) +299</option>
						<option value="+220">(GM) +220</option>
						<option value="+224">(GN) +224</option>
						<option value="+240">(GQ) +240</option>
						<option value="+30">(GR) +30</option>
						<option value="+502">(GT) +502</option>
						<option value="+1-671">(GU) +1-671</option>
						<option value="+245">(GW) +245</option>
						<option value="+592">(GY) +592</option>
						<option value="+852">(HK) +852</option>
						<option value="+504">(HN) +504</option>
						<option value="+385">(HR) +385</option>
						<option value="+509">(HT) +509</option>
						<option value="+36">(HU) +36</option>
						<option value="+62">(ID) +62</option>
						<option value="+353">(IE) +353</option>
						<option value="+972">(IL) +972</option>
						<option value="+44-1624">(IM) +44-1624</option>
						<option value="+91" selected>(IN) +91</option>
						<option value="+246">(IO) +246</option>
						<option value="+964">(IQ) +964</option>
						<option value="+98">(IR) +98</option>
						<option value="+354">(IS) +354</option>
						<option value="+39">(IT) +39</option>
						<option value="+44-1534">(JE) +44-1534</option>
						<option value="+1-876">(JM) +1-876</option>
						<option value="+962">(JO) +962</option>
						<option value="+81">(JP) +81</option>
						<option value="+254">(KE) +254</option>
						<option value="+996">(KG) +996</option>
						<option value="+855">(KH) +855</option>
						<option value="+686">(KI) +686</option>
						<option value="+269">(KM) +269</option>
						<option value="+1-869">(KN) +1-869</option>
						<option value="+850">(KP) +850</option>
						<option value="+82">(KR) +82</option>
						<option value="+965">(KW) +965</option>
						<option value="+1-345">(KY) +1-345</option>
						<option value="+7">(KZ) +7</option>
						<option value="+856">(LA) +856</option>
						<option value="+961">(LB) +961</option>
						<option value="+1-758">(LC) +1-758</option>
						<option value="+423">(LI) +423</option>
						<option value="+94">(LK) +94</option>
						<option value="+231">(LR) +231</option>
						<option value="+266">(LS) +266</option>
						<option value="+370">(LT) +370</option>
						<option value="+352">(LU) +352</option>
						<option value="+371">(LV) +371</option>
						<option value="+218">(LY) +218</option>
						<option value="+212">(MA) +212</option>
						<option value="+377">(MC) +377</option>
						<option value="+373">(MD) +373</option>
						<option value="+382">(ME) +382</option>
						<option value="+590">(MF) +590</option>
						<option value="+261">(MG) +261</option>
						<option value="+692">(MH) +692</option>
						<option value="+389">(MK) +389</option>
						<option value="+223">(ML) +223</option>
						<option value="+95">(MM) +95</option>
						<option value="+976">(MN) +976</option>
						<option value="+853">(MO) +853</option>
						<option value="+1-670">(MP) +1-670</option>
						<option value="+222">(MR) +222</option>
						<option value="+1-664">(MS) +1-664</option>
						<option value="+356">(MT) +356</option>
						<option value="+230">(MU) +230</option>
						<option value="+960">(MV) +960</option>
						<option value="+265">(MW) +265</option>
						<option value="+52">(MX) +52</option>
						<option value="+60">(MY) +60</option>
						<option value="+258">(MZ) +258</option>
						<option value="+264">(NA) +264</option>
						<option value="+687">(NC) +687</option>
						<option value="+227">(NE) +227</option>
						<option value="+234">(NG) +234</option>
						<option value="+505">(NI) +505</option>
						<option value="+31">(NL) +31</option>
						<option value="+47">(NO) +47</option>
						<option value="+977">(NP) +977</option>
						<option value="+674">(NR) +674</option>
						<option value="+683">(NU) +683</option>
						<option value="+64">(NZ) +64</option>
						<option value="+968">(OM) +968</option>
						<option value="+507">(PA) +507</option>
						<option value="+51">(PE) +51</option>
						<option value="+689">(PF) +689</option>
						<option value="+675">(PG) +675</option>
						<option value="+63">(PH) +63</option>
						<option value="+92">(PK) +92</option>
						<option value="+48">(PL) +48</option>
						<option value="+508">(PM) +508</option>
						<option value="+64">(PN) +64</option>
						<option value="+1-787">(PR) +1-787</option>
						<option value="+970">(PS) +970</option>
						<option value="+351">(PT) +351</option>
						<option value="+680">(PW) +680</option>
						<option value="+595">(PY) +595</option>
						<option value="+974">(QA) +974</option>
						<option value="+262">(RE) +262</option>
						<option value="+40">(RO) +40</option>
						<option value="+381">(RS) +381</option>
						<option value="+7">(RU) +7</option>
						<option value="+250">(RW) +250</option>
						<option value="+966">(SA) +966</option>
						<option value="+677">(SB) +677</option>
						<option value="+248">(SC) +248</option>
						<option value="+249">(SD) +249</option>
						<option value="+46">(SE) +46</option>
						<option value="+65">(SG) +65</option>
						<option value="+290">(SH) +290</option>
						<option value="+386">(SI) +386</option>
						<option value="+47">(SJ) +47</option>
						<option value="+421">(SK) +421</option>
						<option value="+232">(SL) +232</option>
						<option value="+378">(SM) +378</option>
						<option value="+221">(SN) +221</option>
						<option value="+252">(SO) +252</option>
						<option value="+597">(SR) +597</option>
						<option value="+211">(SS) +211</option>
						<option value="+239">(ST) +239</option>
						<option value="+503">(SV) +503</option>
						<option value="+1-721">(SX) +1-721</option>
						<option value="+963">(SY) +963</option>
						<option value="+268">(SZ) +268</option>
						<option value="+1-649">(TC) +1-649</option>
						<option value="+235">(TD) +235</option>
						<option value="+228">(TG) +228</option>
						<option value="+66">(TH) +66</option>
						<option value="+992">(TJ) +992</option>
						<option value="+690">(TK) +690</option>
						<option value="+670">(TL) +670</option>
						<option value="+993">(TM) +993</option>
						<option value="+216">(TN) +216</option>
						<option value="+676">(TO) +676</option>
						<option value="+90">(TR) +90</option>
						<option value="+1-868">(TT) +1-868</option>
						<option value="+688">(TV) +688</option>
						<option value="+886">(TW) +886</option>
						<option value="+255">(TZ) +255</option>
						<option value="+380">(UA) +380</option>
						<option value="+256">(UG) +256</option>
						<option value="+1">(US) +1</option>
						<option value="+598">(UY) +598</option>
						<option value="+998">(UZ) +998</option>
						<option value="+379">(VA) +379</option>
						<option value="+1-784">(VC) +1-784</option>
						<option value="+58">(VE) +58</option>
						<option value="+1-284">(VG) +1-284</option>
						<option value="+1-340">(VI) +1-340</option>
						<option value="+84">(VN) +84</option>
						<option value="+678">(VU) +678</option>
						<option value="+681">(WF) +681</option>
						<option value="+685">(WS) +685</option>
						<option value="+383">(XK) +383</option>
						<option value="+967">(YE) +967</option>
						<option value="+262">(YT) +262</option>
						<option value="+27">(ZA) +27</option>
						<option value="+260">(ZM) +260</option>
						<option value="+263">(ZW) +263</option>
					</select>

					<input id="phone_number" class="[ offset-1 col-7 pl-2 ][ form-control ]" pattern="[0-9]{10}" type="text" name="phone_number" placeholder="Example: 9876543210" maxlength="10" <?=$required?>>

					<div class="invalid-tooltip">
						Please provide a valid phone number.
					</div>
				</div>
			</div>
			
			<div class="[ my-5 ][ form-group ]">
				<label for="WhatsApp_country_code">WhatsApp number</label>

				<div class="row no-gutters">
					<select id="whatsapp_country_code" class="[ col-4 pl-2 ][ custom-select ]" name="WhatsApp_country_code">
						<option value="+376">(AD) +376</option>
						<option value="+971">(AE) +971</option>
						<option value="+93">(AF) +93</option>
						<option value="+1-268">(AG) +1-268</option>
						<option value="+1-264">(AI) +1-264</option>
						<option value="+355">(AL) +355</option>
						<option value="+374">(AM) +374</option>
						<option value="+599">(AN) +599</option>
						<option value="+244">(AO) +244</option>
						<option value="+672">(AQ) +672</option>
						<option value="+54">(AR) +54</option>
						<option value="+1-684">(AS) +1-684</option>
						<option value="+43">(AT) +43</option>
						<option value="+61">(AU) +61</option>
						<option value="+297">(AW) +297</option>
						<option value="+994">(AZ) +994</option>
						<option value="+387">(BA) +387</option>
						<option value="+1-246">(BB) +1-246</option>
						<option value="+880">(BD) +880</option>
						<option value="+32">(BE) +32</option>
						<option value="+226">(BF) +226</option>
						<option value="+359">(BG) +359</option>
						<option value="+973">(BH) +973</option>
						<option value="+257">(BI) +257</option>
						<option value="+229">(BJ) +229</option>
						<option value="+590">(BL) +590</option>
						<option value="+1-441">(BM) +1-441</option>
						<option value="+673">(BN) +673</option>
						<option value="+591">(BO) +591</option>
						<option value="+55">(BR) +55</option>
						<option value="+1-242">(BS) +1-242</option>
						<option value="+975">(BT) +975</option>
						<option value="+267">(BW) +267</option>
						<option value="+375">(BY) +375</option>
						<option value="+501">(BZ) +501</option>
						<option value="+1">(CA) +1</option>
						<option value="+61">(CC) +61</option>
						<option value="+243">(CD) +243</option>
						<option value="+236">(CF) +236</option>
						<option value="+242">(CG) +242</option>
						<option value="+41">(CH) +41</option>
						<option value="+225">(CI) +225</option>
						<option value="+682">(CK) +682</option>
						<option value="+56">(CL) +56</option>
						<option value="+237">(CM) +237</option>
						<option value="+86">(CN) +86</option>
						<option value="+57">(CO) +57</option>
						<option value="+506">(CR) +506</option>
						<option value="+53">(CU) +53</option>
						<option value="+238">(CV) +238</option>
						<option value="+599">(CW) +599</option>
						<option value="+61">(CX) +61</option>
						<option value="+357">(CY) +357</option>
						<option value="+420">(CZ) +420</option>
						<option value="+49">(DE) +49</option>
						<option value="+253">(DJ) +253</option>
						<option value="+45">(DK) +45</option>
						<option value="+1-767">(DM) +1-767</option>
						<option value="+1-809">(DO) +1-809</option>
						<option value="+213">(DZ) +213</option>
						<option value="+593">(EC) +593</option>
						<option value="+372">(EE) +372</option>
						<option value="+20">(EG) +20</option>
						<option value="+212">(EH) +212</option>
						<option value="+291">(ER) +291</option>
						<option value="+34">(ES) +34</option>
						<option value="+251">(ET) +251</option>
						<option value="+358">(FI) +358</option>
						<option value="+679">(FJ) +679</option>
						<option value="+500">(FK) +500</option>
						<option value="+691">(FM) +691</option>
						<option value="+298">(FO) +298</option>
						<option value="+33">(FR) +33</option>
						<option value="+241">(GA) +241</option>
						<option value="+44">(GB) +44</option>
						<option value="+1-473">(GD) +1-473</option>
						<option value="+995">(GE) +995</option>
						<option value="+44-1481">(GG) +44-1481</option>
						<option value="+233">(GH) +233</option>
						<option value="+350">(GI) +350</option>
						<option value="+299">(GL) +299</option>
						<option value="+220">(GM) +220</option>
						<option value="+224">(GN) +224</option>
						<option value="+240">(GQ) +240</option>
						<option value="+30">(GR) +30</option>
						<option value="+502">(GT) +502</option>
						<option value="+1-671">(GU) +1-671</option>
						<option value="+245">(GW) +245</option>
						<option value="+592">(GY) +592</option>
						<option value="+852">(HK) +852</option>
						<option value="+504">(HN) +504</option>
						<option value="+385">(HR) +385</option>
						<option value="+509">(HT) +509</option>
						<option value="+36">(HU) +36</option>
						<option value="+62">(ID) +62</option>
						<option value="+353">(IE) +353</option>
						<option value="+972">(IL) +972</option>
						<option value="+44-1624">(IM) +44-1624</option>
						<option value="+91" selected>(IN) +91</option>
						<option value="+246">(IO) +246</option>
						<option value="+964">(IQ) +964</option>
						<option value="+98">(IR) +98</option>
						<option value="+354">(IS) +354</option>
						<option value="+39">(IT) +39</option>
						<option value="+44-1534">(JE) +44-1534</option>
						<option value="+1-876">(JM) +1-876</option>
						<option value="+962">(JO) +962</option>
						<option value="+81">(JP) +81</option>
						<option value="+254">(KE) +254</option>
						<option value="+996">(KG) +996</option>
						<option value="+855">(KH) +855</option>
						<option value="+686">(KI) +686</option>
						<option value="+269">(KM) +269</option>
						<option value="+1-869">(KN) +1-869</option>
						<option value="+850">(KP) +850</option>
						<option value="+82">(KR) +82</option>
						<option value="+965">(KW) +965</option>
						<option value="+1-345">(KY) +1-345</option>
						<option value="+7">(KZ) +7</option>
						<option value="+856">(LA) +856</option>
						<option value="+961">(LB) +961</option>
						<option value="+1-758">(LC) +1-758</option>
						<option value="+423">(LI) +423</option>
						<option value="+94">(LK) +94</option>
						<option value="+231">(LR) +231</option>
						<option value="+266">(LS) +266</option>
						<option value="+370">(LT) +370</option>
						<option value="+352">(LU) +352</option>
						<option value="+371">(LV) +371</option>
						<option value="+218">(LY) +218</option>
						<option value="+212">(MA) +212</option>
						<option value="+377">(MC) +377</option>
						<option value="+373">(MD) +373</option>
						<option value="+382">(ME) +382</option>
						<option value="+590">(MF) +590</option>
						<option value="+261">(MG) +261</option>
						<option value="+692">(MH) +692</option>
						<option value="+389">(MK) +389</option>
						<option value="+223">(ML) +223</option>
						<option value="+95">(MM) +95</option>
						<option value="+976">(MN) +976</option>
						<option value="+853">(MO) +853</option>
						<option value="+1-670">(MP) +1-670</option>
						<option value="+222">(MR) +222</option>
						<option value="+1-664">(MS) +1-664</option>
						<option value="+356">(MT) +356</option>
						<option value="+230">(MU) +230</option>
						<option value="+960">(MV) +960</option>
						<option value="+265">(MW) +265</option>
						<option value="+52">(MX) +52</option>
						<option value="+60">(MY) +60</option>
						<option value="+258">(MZ) +258</option>
						<option value="+264">(NA) +264</option>
						<option value="+687">(NC) +687</option>
						<option value="+227">(NE) +227</option>
						<option value="+234">(NG) +234</option>
						<option value="+505">(NI) +505</option>
						<option value="+31">(NL) +31</option>
						<option value="+47">(NO) +47</option>
						<option value="+977">(NP) +977</option>
						<option value="+674">(NR) +674</option>
						<option value="+683">(NU) +683</option>
						<option value="+64">(NZ) +64</option>
						<option value="+968">(OM) +968</option>
						<option value="+507">(PA) +507</option>
						<option value="+51">(PE) +51</option>
						<option value="+689">(PF) +689</option>
						<option value="+675">(PG) +675</option>
						<option value="+63">(PH) +63</option>
						<option value="+92">(PK) +92</option>
						<option value="+48">(PL) +48</option>
						<option value="+508">(PM) +508</option>
						<option value="+64">(PN) +64</option>
						<option value="+1-787">(PR) +1-787</option>
						<option value="+970">(PS) +970</option>
						<option value="+351">(PT) +351</option>
						<option value="+680">(PW) +680</option>
						<option value="+595">(PY) +595</option>
						<option value="+974">(QA) +974</option>
						<option value="+262">(RE) +262</option>
						<option value="+40">(RO) +40</option>
						<option value="+381">(RS) +381</option>
						<option value="+7">(RU) +7</option>
						<option value="+250">(RW) +250</option>
						<option value="+966">(SA) +966</option>
						<option value="+677">(SB) +677</option>
						<option value="+248">(SC) +248</option>
						<option value="+249">(SD) +249</option>
						<option value="+46">(SE) +46</option>
						<option value="+65">(SG) +65</option>
						<option value="+290">(SH) +290</option>
						<option value="+386">(SI) +386</option>
						<option value="+47">(SJ) +47</option>
						<option value="+421">(SK) +421</option>
						<option value="+232">(SL) +232</option>
						<option value="+378">(SM) +378</option>
						<option value="+221">(SN) +221</option>
						<option value="+252">(SO) +252</option>
						<option value="+597">(SR) +597</option>
						<option value="+211">(SS) +211</option>
						<option value="+239">(ST) +239</option>
						<option value="+503">(SV) +503</option>
						<option value="+1-721">(SX) +1-721</option>
						<option value="+963">(SY) +963</option>
						<option value="+268">(SZ) +268</option>
						<option value="+1-649">(TC) +1-649</option>
						<option value="+235">(TD) +235</option>
						<option value="+228">(TG) +228</option>
						<option value="+66">(TH) +66</option>
						<option value="+992">(TJ) +992</option>
						<option value="+690">(TK) +690</option>
						<option value="+670">(TL) +670</option>
						<option value="+993">(TM) +993</option>
						<option value="+216">(TN) +216</option>
						<option value="+676">(TO) +676</option>
						<option value="+90">(TR) +90</option>
						<option value="+1-868">(TT) +1-868</option>
						<option value="+688">(TV) +688</option>
						<option value="+886">(TW) +886</option>
						<option value="+255">(TZ) +255</option>
						<option value="+380">(UA) +380</option>
						<option value="+256">(UG) +256</option>
						<option value="+1">(US) +1</option>
						<option value="+598">(UY) +598</option>
						<option value="+998">(UZ) +998</option>
						<option value="+379">(VA) +379</option>
						<option value="+1-784">(VC) +1-784</option>
						<option value="+58">(VE) +58</option>
						<option value="+1-284">(VG) +1-284</option>
						<option value="+1-340">(VI) +1-340</option>
						<option value="+84">(VN) +84</option>
						<option value="+678">(VU) +678</option>
						<option value="+681">(WF) +681</option>
						<option value="+685">(WS) +685</option>
						<option value="+383">(XK) +383</option>
						<option value="+967">(YE) +967</option>
						<option value="+262">(YT) +262</option>
						<option value="+27">(ZA) +27</option>
						<option value="+260">(ZM) +260</option>
						<option value="+263">(ZW) +263</option>
					</select>

					<input id="whatsapp_number" class="[ offset-1 col-7 pl-2 ][ form-control ]" pattern="[0-9]{10}" type="text" name="WhatsApp_number" placeholder="Example: 9876543210" maxlength="10" <?=$required?>>

					<div class="invalid-tooltip">
						Please provide a valid WhatsApp number.
					</div>
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="pronoun">Pronoun</label>
				<select id="pronoun" class="custom-select" name="pronoun" <?=$required?>>
					<option value="" selected hidden>Pronoun</option>
					<option value="She/Her">She/Her</option>
					<option value="He/Him">He/Him</option>
					<option value="They/Them">They/Them</option>
					<option value="other">Other</option>
				</select>

				<div class="invalid-tooltip">
					Please select a pronoun.
				</div>
			</div>
			
				<div id="pronoun_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="pronoun_custom">Please Enter Your Pronoun</label>

				<input id="pronoun_custom" class="form-control" pattern="^[A-Za-z'\s\.\-\\\/]{1,}$" type="text" name="pronoun_custom" placeholder="Your Pronoun">

				<div class="invalid-tooltip">
					Please state a valid pronoun.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label class="d-block" for="out_at_work">OUT at work?</label>
				<select id="out_at_work" name="out_at_work" class="custom-select" <?=$required?>>
					<option value="" selected hidden>OUT at work?</option>
					<option value="Yes">Yes</option>
					<option value="No">No</option>
				</select>
				
					<div class="invalid-tooltip">
						Please select an option.
					</div>

			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="current_role">Current role</label>
				<input id="current_role" class="form-control" type="text" name="current_role" placeholder="Current Role" <?=$required?>>

				<div class="invalid-tooltip">
					Please state your current role.
				</div>
			</div>
			<!--<input type="text" value="Amsterdam,Washington" data-role="tagsinput" />-->
				<div class="[ my-5 ][ form-group ]">
				<label for="key_skills">Key skills <sub>(You can select multiple skills. To add custom skill, type and press enter.)</sub> </label>
				<input id="skills" name="key_skills" type="text" class="form-control tagator" <?=$required?> value="<?=$user_data_set['skills']?>"  data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Assign Passwords and Maintain Database Access',
                        'Analytical',
                        'Analyze and Recommend Database Improvements',
                        'Analyze Impact of Database Changes to the Business',
                        'Audit Database Access and Requests',
                        'APIs',
                        'Application and Server Monitoring Tools',
                        'Application Development ',
                        'Architecture',
                        'Artificial Intelligence',
                        'Attention to Detail',
                        'AutoCAD',
                        'Azure',
                        'Cloud Computing',
                        'C++',
                        'C Language',
                        'Compensation & Benefits',
                        'Configure Database Software',
                        'Configuration Management',
                        'Critical Thinking',
                        'Database Administration',
                        'Deploying Applications in a Cloud Environment',
                        'Develop and Secure Network Structures',
                        'Develop and Test Methods',
                        'Emerging Technologies',
                        'File Systems',
                        'HTML',
                        'Implement Backup and Recovery Plan',
                        'Implementation',
                        'Information Systems',
                        'Interaction Design',
                        'Interaction Flows',
                        'Install, Maintain, and Merge Databases',
                        'Integrated Technologies',
                        'Integrating Security Protocols with Cloud Design',
                        'Internet',
                        'JavaScript',
                        'Java',
                        'Optimization',
                        'IT Soft Skills',
                        'L&D',
                        'Logical Thinking',
                        'Leadership',
                        'Operating Systems',
                        'Migrating Existing Workloads into Cloud Systems',
                        'Mobile Applications',
                        'Open Source Technology Integration',
                        'Optimizing Website Performance',
                        'PHP',
                        'Python',
                        'Problem Solving',
                        'Project Management',
                        'Recruitment',
                        'Ruby',
                        'Software Engineering',
                        'Software Quality Assurance (QA)',
                        'TensorFlow',
                        'User-Centered Design',
                        'UX Design',
                        'UI / UX',
                        'Visual Basic',
                        'Visual FoxPro',
                        'Web Development',
                        'Web Design'
                        ]
                    ">
				<!--<select id="out_at_work_yes" name="out_at_work" class="custom-select" required>-->
				<!--	<option value="" selected hidden>Key Skills</option>-->
				<!--	<option value="Assign Passwords and Maintain Database Access">Assign Passwords and Maintain Database Access</option>-->
				<!--	<option value="Analytical">Analytical</option>-->
				<!--	<option value="Analyze and Recommend Database Improvements">Analyze and Recommend Database Improvements</option>-->
				<!--	<option value="Analyze Impact of Database Changes to the Business">Analyze Impact of Database Changes to the Business</option>-->
				<!--	<option value="Audit Database Access and Requests">Audit Database Access and Requests</option>-->
				<!--	<option value="APIs">APIs</option>-->
				<!--	<option value="Application and Server Monitoring Tools">Application and Server Monitoring Tools</option>-->
				<!--	<option value="Application Development ">Application Development </option>-->
				<!--	<option value="Architecture">Architecture</option>-->
				<!--	<option value="Artificial Intelligence">Artificial Intelligence</option>-->
				<!--	<option value="Attention to Detail">Attention to Detail</option>-->
				<!--	<option value="AutoCAD">AutoCAD</option>-->
				<!--	<option value="Azure">Azure</option>-->
				<!--	<option value="Cloud Computing">Cloud Computing</option>-->
				<!--	<option value="C++">C++</option>-->
				<!--	<option value="C Language">C Language</option>-->
				<!--	<option value="Configure Database Software">Configure Database Software</option>-->
				<!--	<option value="Configuration Management">Configuration Management</option>-->
				<!--	<option value="Critical Thinking">Critical Thinking</option>-->
				<!--	<option value="Database Administration">Database Administration</option>-->
				<!--	<option value="Deploying Applications in a Cloud Environment">Deploying Applications in a Cloud Environment</option>-->
				<!--	<option value="Develop and Secure Network Structures">Develop and Secure Network Structures</option>-->
				<!--	<option value="Develop and Test Methods">Develop and Test Methods</option>-->
				<!--	<option value="Emerging Technologies">Emerging Technologies</option>-->
				<!--	<option value="File Systems">File Systems</option>-->
				<!--	<option value="HTML">HTML</option>-->
				<!--	<option value="Implement Backup and Recovery Plan">Implement Backup and Recovery Plan</option>-->
				<!--	<option value="Implementation">Implementation</option>-->
				<!--	<option value="Information Systems">Information Systems</option>-->
				<!--	<option value="Interaction Design">Interaction Design</option>-->
				<!--	<option value="Interaction Flows">Interaction Flows</option>-->
				<!--	<option value="Install, Maintain, and Merge Databases">Install, Maintain, and Merge Databases</option>-->
				<!--	<option value="Integrated Technologies">Integrated Technologies</option>-->
				<!--	<option value="Integrating Security Protocols with Cloud Design">Integrating Security Protocols with Cloud Design</option>-->
				<!--	<option value="Internet">Internet</option>-->
				<!--	<option value="JavaScript">JavaScript</option>-->
				<!--	<option value="Java">Java</option>-->
				<!--	<option value="Optimization">Optimization</option>-->
				<!--	<option value="IT Soft Skills">IT Soft Skills</option>-->
				<!--	<option value="Logical Thinking">Logical Thinking</option>-->
				<!--	<option value="Leadership">Leadership</option>-->
				<!--	<option value="Operating Systems">Operating Systems</option>-->
				<!--	<option value="Migrating Existing Workloads into Cloud Systems">Migrating Existing Workloads into Cloud Systems</option>-->
				<!--	<option value="Mobile Applications">Mobile Applications</option>-->
				<!--	<option value="Open Source Technology Integration">Open Source Technology Integration</option>-->
				<!--	<option value="Optimizing Website Performance">Optimizing Website Performance</option>-->
				<!--	<option value="PHP">PHP</option>-->
				<!--	<option value="Python">Python</option>-->
				<!--	<option value="Problem Solving">Problem Solving</option>-->
				<!--	<option value="Project Management">Project Management</option>-->
				<!--	<option value="Ruby">Ruby</option>-->
				<!--	<option value="Software Engineering">Software Engineering</option>-->
				<!--	<option value="Software Quality Assurance (QA)">Software Quality Assurance (QA)</option>-->
				<!--	<option value="TensorFlow">TensorFlow</option>-->
				<!--	<option value="User-Centered Design">User-Centered Design</option>-->
				<!--	<option value="UX Design">UX Design</option>-->
				<!--	<option value="UI / UX">UI / UX</option>-->
				<!--	<option value="Visual Basic">Visual Basic</option>-->
				<!--	<option value="Visual FoxPro">Visual FoxPro</option>-->
				<!--	<option value="Web Development">Web Development</option>-->
				<!--	<option value="Web Design">Web Design</option>-->
				<!--</select>-->
				<!--<input id="technical_skills" class="form-control" type="text" name="technical_skills" placeholder="Example- Python, Java, AWS">-->

				<div class="invalid-tooltip">
					Please enter key skills.
				</div>
			</div>
			
			<div class="[ my-5 ][ form-group ]">
				<label for="experience_years">Total experience </label>

				<div class="row no-gutters">
					<div class="[ col-6 pr-2 ][ input-group ]">
						<div class="input-group-prepend">
							<div class="input-group-text">Years</div>
						</div>

						<select id="experience_years" class="custom-select" name="experience_years" >
							<?php
								for ($i=0; $i <= 60; $i++) {
									echo '<option value="'.$i.'" >'.$i.'</option>';
								}
							?>
						</select>

						<div class="invalid-tooltip">
							Please select years.
						</div>
					</div>

					<div class="[ col-6 pl-2 ][ input-group ]">
						<div class="input-group-prepend">
							<div class="input-group-text">Months</div>
						</div>

						<select id="experience_months" class="custom-select" name="experience_months" >
							<?php
								for ($i=0; $i <12; $i++) {
									echo '<option value="'.$i.'" >'.$i.'</option>';
								}
							?>
						</select>

						<div class="invalid-tooltip">
							Please select months.
						</div>
					</div>
				</div>
			</div>
	
			<div class="[ my-5 ][ form-group ]">
				<label for="current_city">Current location</label>

				<select  id="current_city" class="form-control selectpicker"  name="current_city" data-live-search="true" <?=$required?>>
					<option value="" selected hidden>Select Current Location</option>
					<option value="other">Other</option>
					<option  value="Abu">Abu</option>
                    <option value="Adoni">Adoni</option>
                    <option value="Agartala">Agartala</option>
                    <option value="Agra">Agra</option>
                    <option value="Ahmadabad">Ahmadabad</option>
                    <option value="Ahmadnagar">Ahmadnagar</option>
                    <option value="Aizawl">Aizawl</option>
                    <option value="Ajmer">Ajmer</option>
                    <option value="Akola">Akola</option>
                    <option value="Alappuzha">Alappuzha</option>
                    <option value="Aligarh">Aligarh</option>
                    <option value="Alipore">Alipore</option>
                    <option value="Alipur Duar">Alipur Duar</option>
                    <option value="Almora">Almora</option>
                    <option value="Alwar">Alwar</option>
                    <option value="Amaravati">Amaravati</option>
                    <option value="Ambala">Ambala</option>
                    <option value="Ambikapur">Ambikapur</option>
                    <option value="Amer">Amer</option>
                    <option value="Amravati">Amravati</option>
                    <option value="Amreli">Amreli</option>
                    <option value="Amritsar">Amritsar</option>
                    <option value="Amroha">Amroha</option>
                    <option value="Anantapur">Anantapur</option>
                    <option value="Anantnag">Anantnag</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Ara">Ara</option>
                    <option value="Arcot">Arcot</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Asansol">Asansol</option>
                    <option value="Assam">Assam</option>
                    <option value="Aurangabad">Aurangabad</option>
                    <option value="Ayodhya">Ayodhya</option>
                    <option value="Azamgarh">Azamgarh</option>
                    <option value="Badagara">Badagara</option>
                    <option value="Badami">Badami</option>
                    <option value="Baharampur">Baharampur</option>
                    <option value="Bahraich">Bahraich</option>
                    <option value="Balaghat">Balaghat</option>
                    <option value="Balangir">Balangir</option>
                    <option value="Baleshwar">Baleshwar</option>
                    <option value="Ballari">Ballari</option>
                    <option value="Ballia">Ballia</option>
                    <option value="Bally">Bally</option>
                    <option value="Balurghat">Balurghat</option>
                    <option value="Banda">Banda</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Bankura">Bankura</option>
                    <option value="Bara Banki">Bara Banki</option>
                    <option value="Baramula">Baramula</option>
                    <option value="Baranagar">Baranagar</option>
                    <option value="Barasat">Barasat</option>
                    <option value="Bareilly">Bareilly</option>
                    <option value="Baripada">Baripada</option>
                    <option value="Barmer">Barmer</option>
                    <option value="Barrackpore">Barrackpore</option>
                    <option value="Baruni">Baruni</option>
                    <option value="Barwani">Barwani</option>
                    <option value="Basirhat">Basirhat</option>
                    <option value="Basti">Basti</option>
                    <option value="Batala">Batala</option>
                    <option value="Beawar">Beawar</option>
                    <option value="Begusarai">Begusarai</option>
                    <option value="Belgavi">Belgavi</option>
                    <option value="Bettiah">Bettiah</option>
                    <option value="Betul">Betul</option>
                    <option value="Bhadravati">Bhadravati</option>
                    <option value="Bhagalpur">Bhagalpur</option>
                    <option value="Bhandara">Bhandara</option>
                    <option value="Bharatpur">Bharatpur</option>
                    <option value="Bharhut">Bharhut</option>
                    <option value="Bharuch">Bharuch</option>
                    <option value="Bhatpara">Bhatpara</option>
                    <option value="Bhavnagar">Bhavnagar</option>
                    <option value="Bhilai">Bhilai</option>
                    <option value="Bhilwara">Bhilwara</option>
                    <option value="Bhind">Bhind</option>
                    <option value="Bhiwani">Bhiwani</option>
                    <option value="Bhojpur">Bhojpur</option>
                    <option value="Bhopal">Bhopal</option>
                    <option value="Bhubaneshwar">Bhubaneshwar</option>
                    <option value="Bhuj">Bhuj</option>
                    <option value="Bhusawal">Bhusawal</option>
                    <option value="Bid">Bid</option>
                    <option value="Bidar">Bidar</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Bihar Sharif">Bihar Sharif</option>
                    <option value="Bijnor">Bijnor</option>
                    <option value="Bikaner">Bikaner</option>
                    <option value="Bilaspur">Bilaspur</option>
                    <option value="Bilaspur">Bilaspur</option>
                    <option value="Bishnupur">Bishnupur</option>
                    <option value="Bithur">Bithur</option>
                    <option value="Bodh Gaya">Bodh Gaya</option>
                    <option value="Bokaro">Bokaro</option>
                    <option value="Brahmapur">Brahmapur</option>
                    <option value="Budaun">Budaun</option>
                    <option value="Budge Budge">Budge Budge</option>
                    <option value="Bulandshahr">Bulandshahr</option>
                    <option value="Buldana">Buldana</option>
                    <option value="Bundi">Bundi</option>
                    <option value="Burdwan">Burdwan</option>
                    <option value="Burhanpur">Burhanpur</option>
                    <option value="Buxar">Buxar</option>
                    <option value="Chaibasa">Chaibasa</option>
                    <option value="Chamba">Chamba</option>
                    <option value="Chandernagore">Chandernagore</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Chandigarh (Union Territory)">Chandigarh (Union Territory)</option>
                    <option value="Chandragiri">Chandragiri</option>
                    <option value="Chandrapur">Chandrapur</option>
                    <option value="Chapra">Chapra</option>
                    <option value="Chengalpattu">Chengalpattu</option>
                    <option value="Chennai">Chennai</option>
                    <option value="Cherrapunji">Cherrapunji</option>
                    <option value="Chhatarpur">Chhatarpur</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Chhindwara">Chhindwara</option>
                    <option value="Chidambaram">Chidambaram</option>
                    <option value="Chikkamagaluru">Chikkamagaluru</option>
                    <option value="Chitradurga">Chitradurga</option>
                    <option value="Chittaurgarh">Chittaurgarh</option>
                    <option value="Chittoor">Chittoor</option>
                    <option value="Churu">Churu</option>
                    <option value="Coimbatore">Coimbatore</option>
                    <option value="Cuddalore">Cuddalore</option>
                    <option value="Cuttack">Cuttack</option>
                    <option value="Dadra And Nagar Haveli (Union Territory)">Dadra And Nagar Haveli (Union Territory)</option>
                    <option value="Dalhousie">Dalhousie</option>
                    <option value="Daman">Daman</option>
                    <option value="Daman And Diu (Union Territory)">Daman And Diu (Union Territory)</option>
                    <option value="Damoh">Damoh</option>
                    <option value="Darbhanga">Darbhanga</option>
                    <option value="Darjiling">Darjiling</option>
                    <option value="Datia">Datia</option>
                    <option value="Daulatabad">Daulatabad</option>
                    <option value="Davangere">Davangere</option>
                    <option value="Dehra Dun">Dehra Dun</option>
                    <option value="Dehri">Dehri</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Delhi (National Capital Territory)">Delhi (National Capital Territory)</option>
                    <option value="Deoghar">Deoghar</option>
                    <option value="Deoria">Deoria</option>
                    <option value="Dewas">Dewas</option>
                    <option value="Dhamtari">Dhamtari</option>
                    <option value="Dhanbad">Dhanbad</option>
                    <option value="Dhar">Dhar</option>
                    <option value="Dharmapuri">Dharmapuri</option>
                    <option value="Dharmshala">Dharmshala</option>
                    <option value="Dhaulpur">Dhaulpur</option>
                    <option value="Dhenkanal">Dhenkanal</option>
                    <option value="Dhuburi">Dhuburi</option>
                    <option value="Dhule">Dhule</option>
                    <option value="Diamond Harbour">Diamond Harbour</option>
                    <option value="Dibrugarh">Dibrugarh</option>
                    <option value="Dinapur Nizamat">Dinapur Nizamat</option>
                    <option value="Dindigul">Dindigul</option>
                    <option value="Dispur">Dispur</option>
                    <option value="Diu">Diu</option>
                    <option value="Doda">Doda</option>
                    <option value="Dowlaiswaram">Dowlaiswaram</option>
                    <option value="Dum Dum">Dum Dum</option>
                    <option value="Dumka">Dumka</option>
                    <option value="Dungarpur">Dungarpur</option>
                    <option value="Durg">Durg</option>
                    <option value="Durgapur">Durgapur</option>
                    <option value="Dwarka">Dwarka</option>
                    <option value="Eluru">Eluru</option>
                    <option value="Erode">Erode</option>
                    <option value="Etah">Etah</option>
                    <option value="Etawah">Etawah</option>
                    <option value="Faizabad">Faizabad</option>
                    <option value="Faridabad">Faridabad</option>
                    <option value="Faridkot">Faridkot</option>
                    <option value="Farrukhabad-cum-Fatehgarh">Farrukhabad-cum-Fatehgarh</option>
                    <option value="Fatehpur">Fatehpur</option>
                    <option value="Fatehpur Sikri">Fatehpur Sikri</option>
                    <option value="Firozpur">Firozpur</option>
                    <option value="Firozpur Jhirka">Firozpur Jhirka</option>
                    <option value="Gandhinagar">Gandhinagar</option>
                    <option value="Ganganagar">Ganganagar</option>
                    <option value="Gangtok">Gangtok</option>
                    <option value="Gaya">Gaya</option>
                    <option value="Ghaziabad">Ghaziabad</option>
                    <option value="Ghazipur">Ghazipur</option>
                    <option value="Giridih">Giridih</option>
                    <option value="Goa">Goa</option>
                    <option value="Godhra">Godhra</option>
                    <option value="Gonda">Gonda</option>
                    <option value="Gorakhpur">Gorakhpur</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Gulmarg">Gulmarg</option>
                    <option value="Guna">Guna</option>
                    <option value="Guntur">Guntur</option>
                    <option value="Gurdaspur">Gurdaspur</option>
                    <option value="Gurgaon">Gurgaon</option>
                    <option value="Guwahati">Guwahati</option>
                    <option value="Gwalior">Gwalior</option>
                    <option value="Gyalsing">Gyalsing</option>
                    <option value="Hajipur">Hajipur</option>
                    <option value="Halebid">Halebid</option>
                    <option value="Halisahar">Halisahar</option>
                    <option value="Hamirpur">Hamirpur</option>
                    <option value="Hamirpur">Hamirpur</option>
                    <option value="Hansi">Hansi</option>
                    <option value="Hanumangarh">Hanumangarh</option>
                    <option value="Haora">Haora</option>
                    <option value="Hardoi">Hardoi</option>
                    <option value="Haridwar">Haridwar</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Hassan">Hassan</option>
                    <option value="Hathras">Hathras</option>
                    <option value="Hazaribag">Hazaribag</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Hisar">Hisar</option>
                    <option value="Hoshangabad">Hoshangabad</option>
                    <option value="Hoshiarpur">Hoshiarpur</option>
                    <option value="Hubballi-Dharwad">Hubballi-Dharwad</option>
                    <option value="Hugli">Hugli</option>
                    <option value="Hyderabad">Hyderabad</option>
                    <option value="Idukki">Idukki</option>
                    <option value="Imphal">Imphal</option>
                    <option value="Indore">Indore</option>
                    <option value="Ingraj Bazar">Ingraj Bazar</option>
                    <option value="Itanagar">Itanagar</option>
                    <option value="Itarsi">Itarsi</option>
                    <option value="Jabalpur">Jabalpur</option>
                    <option value="Jagdalpur">Jagdalpur</option>
                    <option value="Jaipur">Jaipur</option>
                    <option value="Jaisalmer">Jaisalmer</option>
                    <option value="Jalandhar">Jalandhar</option>
                    <option value="Jalaun">Jalaun</option>
                    <option value="Jalgaon">Jalgaon</option>
                    <option value="Jalor">Jalor</option>
                    <option value="Jalpaiguri">Jalpaiguri</option>
                    <option value="Jamalpur">Jamalpur</option>
                    <option value="Jammu">Jammu</option>
                    <option value="Jammu And Kashmir">Jammu And Kashmir</option>
                    <option value="Jamnagar">Jamnagar</option>
                    <option value="Jamshedpur">Jamshedpur</option>
                    <option value="Jaunpur">Jaunpur</option>
                    <option value="Jhabua">Jhabua</option>
                    <option value="Jhalawar">Jhalawar</option>
                    <option value="Jhansi">Jhansi</option>
                    <option value="Jharia">Jharia</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Jhunjhunu">Jhunjhunu</option>
                    <option value="Jind">Jind</option>
                    <option value="Jodhpur">Jodhpur</option>
                    <option value="Jorhat">Jorhat</option>
                    <option value="Junagadh">Junagadh</option>
                    <option value="Kadapa">Kadapa</option>
                    <option value="Kaithal">Kaithal</option>
                    <option value="Kakinada">Kakinada</option>
                    <option value="Kalaburagi">Kalaburagi</option>
                    <option value="Kalimpong">Kalimpong</option>
                    <option value="Kalyan">Kalyan</option>
                    <option value="Kamarhati">Kamarhati</option>
                    <option value="Kanchipuram">Kanchipuram</option>
                    <option value="Kanchrapara">Kanchrapara</option>
                    <option value="Kandla">Kandla</option>
                    <option value="Kangra">Kangra</option>
                    <option value="Kannauj">Kannauj</option>
                    <option value="Kanniyakumari">Kanniyakumari</option>
                    <option value="Kannur">Kannur</option>
                    <option value="Kanpur">Kanpur</option>
                    <option value="Kapurthala">Kapurthala</option>
                    <option value="Karaikal">Karaikal</option>
                    <option value="Karimnagar">Karimnagar</option>
                    <option value="Karli">Karli</option>
                    <option value="Karnal">Karnal</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kathua">Kathua</option>
                    <option value="Katihar">Katihar</option>
                    <option value="Keonjhar">Keonjhar</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Khajuraho">Khajuraho</option>
                    <option value="Khambhat">Khambhat</option>
                    <option value="Khammam">Khammam</option>
                    <option value="Khandwa">Khandwa</option>
                    <option value="Kharagpur">Kharagpur</option>
                    <option value="Khargon">Khargon</option>
                    <option value="Kheda">Kheda</option>
                    <option value="Kishangarh">Kishangarh</option>
                    <option value="Koch Bihar">Koch Bihar</option>
                    <option value="Kochi">Kochi</option>
                    <option value="Kodaikanal">Kodaikanal</option>
                    <option value="Kohima">Kohima</option>
                    <option value="Kolar">Kolar</option>
                    <option value="Kolhapur">Kolhapur</option>
                    <option value="Kolkata">Kolkata</option>
                    <option value="Kollam">Kollam</option>
                    <option value="Konark">Konark</option>
                    <option value="Koraput">Koraput</option>
                    <option value="Kota">Kota</option>
                    <option value="Kottayam">Kottayam</option>
                    <option value="Kozhikode">Kozhikode</option>
                    <option value="Krishnanagar">Krishnanagar</option>
                    <option value="Kullu">Kullu</option>
                    <option value="Kumbakonam">Kumbakonam</option>
                    <option value="Kurnool">Kurnool</option>
                    <option value="Kurukshetra">Kurukshetra</option>
                    <option value="Lachung">Lachung</option>
                    <option value="Lakhimpur">Lakhimpur</option>
                    <option value="Lalitpur">Lalitpur</option>
                    <option value="Leh">Leh</option>
                    <option value="Location">Location</option>
                    <option value="Lucknow">Lucknow</option>
                    <option value="Ludhiana">Ludhiana</option>
                    <option value="Lunglei">Lunglei</option>
                    <option value="Machilipatnam">Machilipatnam</option>
                    <option value="Madgaon">Madgaon</option>
                    <option value="Madhubani">Madhubani</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Madikeri">Madikeri</option>
                    <option value="Madurai">Madurai</option>
                    <option value="Mahabaleshwar">Mahabaleshwar</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Mahbubnagar">Mahbubnagar</option>
                    <option value="Mahe">Mahe</option>
                    <option value="Mahesana">Mahesana</option>
                    <option value="Maheshwar">Maheshwar</option>
                    <option value="Mainpuri">Mainpuri</option>
                    <option value="Malda">Malda</option>
                    <option value="Malegaon">Malegaon</option>
                    <option value="Mamallapuram">Mamallapuram</option>
                    <option value="Mandi">Mandi</option>
                    <option value="Mandla">Mandla</option>
                    <option value="Mandsaur">Mandsaur</option>
                    <option value="Mandya">Mandya</option>
                    <option value="Mangaluru">Mangaluru</option>
                    <option value="Mangan">Mangan</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Matheran">Matheran</option>
                    <option value="Mathura">Mathura</option>
                    <option value="Mattancheri">Mattancheri</option>
                    <option value="Meerut">Meerut</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Merta">Merta</option>
                    <option value="Mhow">Mhow</option>
                    <option value="Midnapore">Midnapore</option>
                    <option value="Mirzapur-Vindhyachal">Mirzapur-Vindhyachal</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Mon">Mon</option>
                    <option value="Moradabad">Moradabad</option>
                    <option value="Morena">Morena</option>
                    <option value="Morvi">Morvi</option>
                    <option value="Motihari">Motihari</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Munger">Munger</option>
                    <option value="Murshidabad">Murshidabad</option>
                    <option value="Murwara">Murwara</option>
                    <option value="Mussoorie">Mussoorie</option>
                    <option value="Muzaffarnagar">Muzaffarnagar</option>
                    <option value="Muzaffarpur">Muzaffarpur</option>
                    <option value="Mysuru">Mysuru</option>
                    <option value="Nabha">Nabha</option>
                    <option value="Nadiad">Nadiad</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Nagaon">Nagaon</option>
                    <option value="Nagappattinam">Nagappattinam</option>
                    <option value="Nagarjunakoṇḍa">Nagarjunakoṇḍa</option>
                    <option value="Nagaur">Nagaur</option>
                    <option value="Nagercoil">Nagercoil</option>
                    <option value="Nagpur">Nagpur</option>
                    <option value="Nahan">Nahan</option>
                    <option value="Nainital">Nainital</option>
                    <option value="Nanded">Nanded</option>
                    <option value="Narsimhapur">Narsimhapur</option>
                    <option value="Narsinghgarh">Narsinghgarh</option>
                    <option value="Narwar">Narwar</option>
                    <option value="Nashik">Nashik</option>
                    <option value="Nathdwara">Nathdwara</option>
                    <option value="Navadwip">Navadwip</option>
                    <option value="Navsari">Navsari</option>
                    <option value="Neemuch">Neemuch</option>
                    <option value="New Delhi">New Delhi</option>
                    <option value="Nizamabad">Nizamabad</option>
                    <option value="Nowgong">Nowgong</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Okha">Okha</option>
                    <option value="Orchha">Orchha</option>
                    <option value="Osmanabad">Osmanabad</option>
                    <option value="Palakkad">Palakkad</option>
                    <option value="Palanpur">Palanpur</option>
                    <option value="Palashi">Palashi</option>
                    <option value="Palayankottai">Palayankottai</option>
                    <option value="Pali">Pali</option>
                    <option value="Panaji">Panaji</option>
                    <option value="Pandharpur">Pandharpur</option>
                    <option value="Panihati">Panihati</option>
                    <option value="Panipat">Panipat</option>
                    <option value="Panna">Panna</option>
                    <option value="Paradip">Paradip</option>
                    <option value="Parbhani">Parbhani</option>
                    <option value="Partapgarh">Partapgarh</option>
                    <option value="Patan">Patan</option>
                    <option value="Patiala">Patiala</option>
                    <option value="Patna">Patna</option>
                    <option value="Pehowa">Pehowa</option>
                    <option value="Phalodi">Phalodi</option>
                    <option value="Phek">Phek</option>
                    <option value="Phulabani">Phulabani</option>
                    <option value="Pilibhit">Pilibhit</option>
                    <option value="Pithoragarh">Pithoragarh</option>
                    <option value="Porbandar">Porbandar</option>
                    <option value="Port Blair">Port Blair</option>
                    <option value="Prayagraj">Prayagraj</option>
                    <option value="Puducherry">Puducherry</option>
                    <option value="Puducherry (Union Territory)">Puducherry (Union Territory)</option>
                    <option value="Pudukkottai">Pudukkottai</option>
                    <option value="Punch">Punch</option>
                    <option value="Pune">Pune</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Puri">Puri</option>
                    <option value="Purnia">Purnia</option>
                    <option value="Purulia">Purulia</option>
                    <option value="Pusa">Pusa</option>
                    <option value="Pushkar">Pushkar</option>
                    <option value="Rae Bareli">Rae Bareli</option>
                    <option value="Raichur">Raichur</option>
                    <option value="Raiganj">Raiganj</option>
                    <option value="Raipur">Raipur</option>
                    <option value="Raisen">Raisen</option>
                    <option value="Rajahmundry">Rajahmundry</option>
                    <option value="Rajapalaiyam">Rajapalaiyam</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Rajauri">Rajauri</option>
                    <option value="Rajgarh">Rajgarh</option>
                    <option value="Rajkot">Rajkot</option>
                    <option value="Rajmahal">Rajmahal</option>
                    <option value="Rajnandgaon">Rajnandgaon</option>
                    <option value="Ramanathapuram">Ramanathapuram</option>
                    <option value="Rampur">Rampur</option>
                    <option value="Ranchi">Ranchi</option>
                    <option value="Ratlam">Ratlam</option>
                    <option value="Ratnagiri">Ratnagiri</option>
                    <option value="Rewa">Rewa</option>
                    <option value="Rewari">Rewari</option>
                    <option value="Rohtak">Rohtak</option>
                    <option value="Rupnagar">Rupnagar</option>
                    <option value="Sagar">Sagar</option>
                    <option value="Saharanpur">Saharanpur</option>
                    <option value="Saharsa">Saharsa</option>
                    <option value="Salem">Salem</option>
                    <option value="Samastipur">Samastipur</option>
                    <option value="Sambalpur">Sambalpur</option>
                    <option value="Sambhal">Sambhal</option>
                    <option value="Sangareddi">Sangareddi</option>
                    <option value="Sangli">Sangli</option>
                    <option value="Sangrur">Sangrur</option>
                    <option value="Santipur">Santipur</option>
                    <option value="Saraikela">Saraikela</option>
                    <option value="Sarangpur">Sarangpur</option>
                    <option value="Sasaram">Sasaram</option>
                    <option value="Satara">Satara</option>
                    <option value="Satna">Satna</option>
                    <option value="Sawai Madhopur">Sawai Madhopur</option>
                    <option value="Sehore">Sehore</option>
                    <option value="Seoni">Seoni</option>
                    <option value="Sevagram">Sevagram</option>
                    <option value="Shahdol">Shahdol</option>
                    <option value="Shahjahanpur">Shahjahanpur</option>
                    <option value="Shahpura">Shahpura</option>
                    <option value="Shajapur">Shajapur</option>
                    <option value="Shantiniketan">Shantiniketan</option>
                    <option value="Sheopur">Sheopur</option>
                    <option value="Shillong">Shillong</option>
                    <option value="Shimla">Shimla</option>
                    <option value="Shivamogga">Shivamogga</option>
                    <option value="Shivpuri">Shivpuri</option>
                    <option value="Shravanabelagola">Shravanabelagola</option>
                    <option value="Shrirampur">Shrirampur</option>
                    <option value="Shrirangapattana">Shrirangapattana</option>
                    <option value="Sibsagar">Sibsagar</option>
                    <option value="Sikar">Sikar</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Silchar">Silchar</option>
                    <option value="Siliguri">Siliguri</option>
                    <option value="Silvassa">Silvassa</option>
                    <option value="Sirohi">Sirohi</option>
                    <option value="Sirsa">Sirsa</option>
                    <option value="Sitamarhi">Sitamarhi</option>
                    <option value="Sitapur">Sitapur</option>
                    <option value="Siuri">Siuri</option>
                    <option value="Siwan">Siwan</option>
                    <option value="Solapur">Solapur</option>
                    <option value="Sonipat">Sonipat</option>
                    <option value="Srikakulam">Srikakulam</option>
                    <option value="Srinagar">Srinagar</option>
                    <option value="Sultanpur">Sultanpur</option>
                    <option value="Surat">Surat</option>
                    <option value="Surendranagar">Surendranagar</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Tamluk">Tamluk</option>
                    <option value="Tehri">Tehri</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tezpur">Tezpur</option>
                    <option value="Thalassery">Thalassery</option>
                    <option value="Thane">Thane</option>
                    <option value="Thanjavur">Thanjavur</option>
                    <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                    <option value="Thrissur">Thrissur</option>
                    <option value="Tinsukia">Tinsukia</option>
                    <option value="Tiruchchirappalli">Tiruchchirappalli</option>
                    <option value="Tirunelveli">Tirunelveli</option>
                    <option value="Tirupati">Tirupati</option>
                    <option value="Tiruppur">Tiruppur</option>
                    <option value="Titagarh">Titagarh</option>
                    <option value="Tonk">Tonk</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Tumkuru">Tumkuru</option>
                    <option value="Tuticorin">Tuticorin</option>
                    <option value="Udaipur">Udaipur</option>
                    <option value="Udayagiri">Udayagiri</option>
                    <option value="Udhagamandalam">Udhagamandalam</option>
                    <option value="Udhampur">Udhampur</option>
                    <option value="Ujjain">Ujjain</option>
                    <option value="Ulhasnagar">Ulhasnagar</option>
                    <option value="Una">Una</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="Valsad">Valsad</option>
                    <option value="Varanasi">Varanasi</option>
                    <option value="Vasai-Virar">Vasai-Virar</option>
                    <option value="Vellore">Vellore</option>
                    <option value="Veraval">Veraval</option>
                    <option value="Vidisha">Vidisha</option>
                    <option value="Vijayawada">Vijayawada</option>
                    <option value="Visakhapatnam">Visakhapatnam</option>
                    <option value="Vizianagaram">Vizianagaram</option>
                    <option value="Warangal">Warangal</option>
                    <option value="Wardha">Wardha</option>
                    <option value="West Bengal">West Bengal</option>
                    <option value="Wokha">Wokha</option>
                    <option value="Yanam">Yanam</option>
                    <option value="Yavatmal">Yavatmal</option>
                    <option value="Yemmiganur">Yemmiganur</option>
                    <option value="Zunheboto">Zunheboto</option>
                    
				</select>

				<div class="invalid-tooltip">
					Please state your city.
				</div>
			</div>

			<div id="current_city_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="current_city_custom">Please enter your current location</label>

				<input id="current_city_custom" class="form-control" pattern="^[A-Za-z'\s\.\-\\\/]{1,}$" type="text" name="current_city_custom" placeholder="Current Location">

				<div class="invalid-tooltip">
					Please state your current city.
				</div>
			</div>
			
			<div class="[ my-5 ][ form-group ]">
				<label for="current_employer">Current/Previous company</label>
				<input id="current_employer" class="form-control" type="text" name="current_employer" placeholder="Current/Previous Company" <?=$required?>>

				<div class="invalid-tooltip">
					Please state your current/previous company.
				</div>
			</div>
			
			<div class="[ my-5 ][ form-group ]">
				<label for="current_ctc">Current/last drawn salary</label>

				<div class="row no-gutters">
				    <!--<div class="col-md-4">-->
				        <select id="current_ctc_time" class="[ col-3 pl-2 ][ custom-select ]" name="current_ctc_time" <?=$required?>>
				        <option value="" selected hidden>Current salary</option>    
						<option value="Annual" >Annual</option>
						<option value="Monthly">Monthly</option>
					</select>
				    <!--</div>-->
				    <!--<div class="col-md-4">-->
				        <!--<input id="current_ctc" class="[  col-6 pl-2 ][ form-control ]" type="text" name="current_ctc" pattern="[0-9]{10}" placeholder="Current Salary" <?=$required?>>-->
				    
				        <input id="current_ctc" class="[ offset-0 col-6 pl-2 ][ form-control ]" type="number" step="0.01" pattern="[0-9]+\.[0-9](2)" min="0" name="current_ctc"  placeholder="Current Salary" <?=$required?> >
				    
				        
				    <!--</div>-->
				    <!--<div class="col-md-4">-->
				        <select id="current_ctc_currency" class="[ col-3 pl-2 ][ custom-select ]" name="current_ctc_currency" <?=$required?>>
				        <option value="" selected hidden>Current currency</option>    
						<option value="lakh" selected>Lakh</option>
						<option value="crore">Crore</option>
						<option value="thousand">Thousand </option>
					</select>
				    <!--</div>-->
					
					<div class="invalid-tooltip">
						Please enter your current Salary.
					</div>
				</div>
			</div>
			
			 <div class="[ my-5 ][ form-group ]">
				<label for="tell_us_about_yourself">Tell us about yourself <sub class="text-muted"> (optional)</sub></label>
				<textarea type="text" class="form-control" rows="5" name="tell_us_about_yourself" id="tell_us_about_yourself"></textarea>
				<!--<input id="current_role" class="form-control" type="text" name="current_role" placeholder="Tell us about yourself" required>-->

				<div class="invalid-tooltip">
					Please enter tell us about yourself.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="qualification">Highest education qualification</label>
				
				<input id="qualification" class="form-control" type="text" name="qualification" placeholder="Highest Education" <?=$required?>>
				<div class="invalid-tooltip">
					Please select your highest education qualification.
				</div>
			</div>

			<!--<div id="qualification_custom_container" class="[ my-5 hidden ][ form-group ]">-->
			<!--	<label for="qualification_custom">Please Enter Your highest Education Qualification</label>-->

			<!--	<input id="qualification_custom" class="form-control" type="text" name="qualification_custom" placeholder="Highest Qualification">-->

			<!--	<div class="invalid-tooltip">-->
			<!--		Please state your highest education.-->
			<!--	</div>-->
			<!--</div>-->

		
			<div class="[ my-5 ][ form-group ]">
				<label for="year_of_passing">Year of passing highest education</label>
				<select id="year_of_passing" class="custom-select" name="year_of_passing" <?=$required?>>
					<option value="" selected hidden>Select Year</option>
					<?php
					
					    $current_year=date("Y");
					    $max_year=$current_year+5;
					    $min_year=$max_year-80;
					    
						for ($i=$max_year; $i>=$min_year; $i--) {
						    echo '<option value="'.$i.'" >'.$i.'</option>';
						}
					
					?>
				</select>

				<div class="invalid-tooltip">
					Please select your year of passing.
				</div>
			</div>

            <div class="[ my-5 ][ form-group ]" hidden >
				<label class="d-block" for="how_did_you_know_about">How did you know about us? <sub class="text-muted"> (optional)</sub></label>
				<select id="how_did_you_know_about_us" name="how_did_you_know_about" class="custom-select">
					<option value="" selected hidden>How did you know about us?</option>
					<option value="Friend">Friend</option>
					<option value="Referred">Referred</option>
					<option value="Newspaper">Newspaper</option>
					<option value="Social media">Social media</option>
					<option value="Other">Other</option>
				</select>
				
					<div class="invalid-tooltip">
						Please select an option.
					</div>

			</div>
			
			<!--<div class="[ my-5 ][ form-group ]">-->
			<!--	<label class="d-block" for="how_did_you_know_about">How did you know about us? <sub class="text-muted"> (optional)</sub></label>-->
			<!--	<select id="how_did_you_know_about_us" name="how_did_you_know_about" class="custom-select" >-->
				
				<?php
			        /* By Amruta Jgatap 2021-02-08 Here, if the cookie of the referrer code is set, then we show the "referred" option as selected. Otherwise, option is kept unselected.*/
			    ?>
			    
			<!--		<option value="" 
					<?php 
					//if($referrer_code_cookie_value === false){echo "selected";} 
					?> 
					hidden>How did you know about us?</option>-->
			<!--		<option value="Friend">Friend</option>-->
			<!--		<option value="Referred" 
			<?php 
			//if($referrer_code_cookie_value !== false){echo "selected";} 
			?>
			>Referred</option>-->
			<!--		<option value="Newspaper">Newspaper</option>-->
			<!--		<option value="Social media">Social media</option>-->
			<!--	</select>-->
				
			<!--		<div class="invalid-tooltip">-->
			<!--			Please select an option.-->
			<!--		</div>-->

			<!--</div>-->
			
			<?php
			    /* Amruta Jagtap 2021-02-08 This option shall be shown when the "Referred" option is selected in the field above. This shall be autopopulated with the referrer code when the cookie is present */
			?>
			<!--<div id="referrer_code_container" class="[ my-5 
			<?php
			// if($referrer_code_cookie_value === false){echo "hidden";} 
			?>
			 ][ form-group ]">-->
			<!--	<label for="referrer_code">Referrer Code <sub  class="text-muted">(This will be auto-filled if you have used the referrer's link.)</sub></label>-->
				
			<!--	<input id="referrer_code" class="form-control" type="text" value="
			<?php 
			//if($referrer_code_cookie_value !== false){echo $referrer_code_cookie_value;} 
			?>
			" name="referrer_code" placeholder="Code">-->
			<!--	<div class="invalid-tooltip">-->
			<!--		Please enter the code for Referral.-->
			<!--	</div>-->
			<!--</div>-->
			
			
			<a class="" href="<?=$resume_url?>" target='_blank' title="">View Submitted Resume</a>

			<div class="[ my-5 ][ form-group ]">
				<label>Re-upload Your Resume</label>

				<div class="custom-file">
					<!--<input  id="resume" name="resume" class="custom-file-input" type="file" required>-->
					<!--<label id="resume_label" class="custom-file-label" for="resume">PDF or MS Word files only</label>-->
					<input  id="resume" name="resume" class="custom-file-input" type="file" >
					<label id="resume_label" class="custom-file-label" for="resume">PDF or MS Word files only</label>

					<div class="invalid-tooltip">
						Please upload a valid resume.
					</div>
				</div>
			</div>
	

			<?php
				if($session->user_designation == "admin" && isset($_GET['page_id'])){
			?>

			<div class="[ my-5 ][ form-group ]">
				<label class="d-block" for="active_status">Active Status</label>

				<div class="[ custom-control custom-radio ]">
					<input type="radio" id="active_status_active" value="Active" name="active_status" class="custom-control-input" >
					<label class="custom-control-label" for="active_status_active">Active</label>
				</div>

				<div class="[ custom-control custom-radio ]">
					<input type="radio" id="active_status_inactive" value="Inactive" name="active_status" class="custom-control-input" >
					<label class="custom-control-label" for="active_status_inactive">Inactive</label>

					<div class="invalid-tooltip">
						Please select an option.
					</div>
				</div>
			</div>
			
			<div class="[ my-5 ][ form-group ]">
				<label class="d-block" for="lgbtq_verification">LGBTQ Verification</label>

				<div class="[ custom-control custom-radio ]">
					<input type="radio" id="lgbtq_verification_confirmed" value="Confirmed" name="lgbtq_verification" class="custom-control-input" >
					<label class="custom-control-label" for="lgbtq_verification_confirmed">Confirmed</label>
				</div>

				<div class="[ custom-control custom-radio ]">
					<input type="radio" id="lgbtq_verification_rejected" value="Rejected" name="lgbtq_verification" class="custom-control-input" >
					<label class="custom-control-label" for="lgbtq_verification_rejected">Rejected</label>

					<div class="invalid-tooltip">
						Please select an option.
					</div>
				</div>
			</div>

			<?php
				if ($redacted_resume_url!=""){
			?>
				<a class="" href="<?=$redacted_resume_url?>" target='_blank' title="">View Submitted Redacted Resume</a>
			<?php
				}else{
			?>
				<p>No Redacted Resume Available</p>
			<?php
				}
			?>

			<div class="[ my-5 ][ form-group ]">
				<label>Upload Redacted Resume</label>

				<div class="custom-file">
					<input  id="redacted_resume" name="redacted_resume" class="custom-file-input" type="file" accept=".pdf, .docx, .doc">
					<label id="redacted_resume_label" class="custom-file-label" for="redacted_resume">PDF or MS Word files only</label>

					<div class="invalid-tooltip">
						Please upload a valid resume.
					</div>
				</div>
			</div>

			<?php
				}
			?>

			<div class="my-5 bg-danger text-white">  
			<?php
			//echo $page->resume_contents;
			?>
			</div>

			<!-- Buttons Section -->
			<div class="[ mb-4 ][ d-flex flex-row justify-content-between ]">
				<a id="education-back" class="[ btn btn-outline-primary ]( btn-back )" href="<?=$user_page_url?>">
					Cancel
				</a>

				<button value="submit" id="education-next" class="[ btn btn-primary px-4 ]( btn-submit )" type="submit" >
					Submit
				</button>
				
			</div>
			<!-- Buttons Section End -->
		</div>
		<!-- ADDITIONAL INFORMATION TAB -->
	</form>
<!-- Modal code by Amruta Jagatap -->
<!-- Modal -->
<!-- this modal for display candidate upload resume skills on modal -->
<div id="myModalDemo" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" >Add Skills</h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					
                </button> -->
		</div>
		<!-- bosy section display all skills using js on modal -->
		<form id="skills-array-modal-form">
			<div class="modal-body" style="padding-left: 36px;">
			 <h6 style="padding-bottom:14px;">Choose your skills from the following</h6>
			<!-- each section id used in js for display data on modal -->
				<div id="technical_skills_array" style="padding-bottom: 10px;">
					<h5>Technical Skills</h5>
				</div>
				<div id="non_technical_skills_array" style="padding-bottom: 10px;">
					<h5>Non-Technical Skills</h5>
				</div>
				<div id="soft_skills_array" style="padding-bottom: 10px;">
					<h5>Soft Skills</h5>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit"  class="[ btn btn-primary px-4 ](btn-submit-skills)" id="btn_confirm_skill">Continue</button>
			</div>
		</form>
	</div>
</div>
</div >

<script>
    	$(document).ready(function(){
          $("#first_name").keyup(function(){
            $("#preferred_name").val($(this).val());
          });
        });
        
        $(document).ready(function(){
          $("#phone_number").keyup(function(){
            $("#whatsapp_number").val($(this).val());
          });
        });;
        
        $(function() {
  $('.selectpicker').selectpicker();
});
</script>
<!--<script src="<?= $rootpath;?>scripts/typehead.js" type="text/javascript"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>-->
<!-- <script src="<?= $rootpath;?>scripts/bootstrap-tagsinput.min.js"></script>-->
	<script>
// var citynames = new Bloodhound({
//   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
//   queryTokenizer: Bloodhound.tokenizers.whitespace,
//   prefetch: {
//     url: 'assets/citynames.json',
//     filter: function(list) {
//       return $.map(list, function(cityname) {
//         return { name: cityname }; });
//     }
//   }
// });
// citynames.initialize();

// $('input').tagsinput({
//   typeaheadjs: {
//     name: 'citynames',
//     displayKey: 'name',
//     valueKey: 'name',
//     source: citynames.ttAdapter()
//   }
// });
</script>

	<?php require_once 'includes/sticky-footer.php' ?>
	

		<!-- ---------- JS LINKS ---------- -->
	<!-- Form Validation (validator.js)) JS -->
	
	<script src="<?= $rootpath;?>scripts/validate.min.js" type="text/javascript"></script>
	<!-- Underscore JS -->
	<script src="<?= $rootpath;?>scripts/underscore.min.js" type="text/javascript"></script>
	<!-- Page-specific JS -->
	<script src="<?= $rootpath;?>scripts/form-edit.js?v=2.22" type="text/javascript"></script>
	<!-- ---------- JS LINKS END ---------- -->
</body>
