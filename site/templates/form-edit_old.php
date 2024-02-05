<?php
	// if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
	// {
	// 	//Tell the browser to redirect to the HTTPS URL.
	// 	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
	// 	//Prevent the rest of the script from executing.
	// 	exit;
	// }

	if($session->user_designation == "admin" && isset($_GET['page_id'])){
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

	$user_data_set['first_name'] = $user_page->first_name;
	$user_data_set['last_name'] = $user_page->last_name;
	$user_data_set['preferred_name'] = $user_page->preferred_name;
	/*$user_data_select['pronoun'] = $user_page->pronoun;*/
	/*$user_data_select['identify_as'] = $user_page->identify_as;*/
	$user_data_set['date_of_birth'] = date("Y-m-d", $user_page->date_of_birth);
	$user_data_set['email'] = $user_page->email;
	$user_data_set['phone_country_code'] = $user_page->phone_country_code;
	$user_data_set['phone_number'] = $user_page->phone_number;
	/*$user_data_select['current_city'] = $user_page->current_city;*/
	$user_data_set['current_state'] = $user_page->current_state;
	$user_data_set['linkedin_url'] = $user_page->linkedin_url;
	/*$user_data_select['qualification'] = $user_page->qualification;*/
	/*$user_data_select['course'] = $user_page->course;*/
	$user_data_set['specialisation'] = $user_page->specialisation;
	$user_data_set['year_of_passing'] = $user_page->year_of_passing;
	$user_data_set['college'] = $user_page->college;
	$user_data_set['cartifications'] = $user_page->cartifications;
	/*$user_data_select['industry'] = $user_page->industry;*/
	/*$user_data_select['functional_area'] = $user_page->functional_area;*/
	$user_data_set['experience_years'] = $user_page->experience_years;
	$user_data_set['experience_months'] = $user_page->experience_months;
	$user_data_set['current_employer'] = $user_page->current_employer;
	$user_data_set['current_role'] = $user_page->current_role;
	$user_data_set['technical_skills'] = $user_page->technical_skills;
	$user_data_set['non_technical_skills'] = $user_page->non_technical_skills;
	$user_data_set['soft_skills'] = $user_page->soft_skills;
	$user_data_set['current_ctc_time'] = $user_page->current_ctc_time;
	$user_data_set['current_ctc'] = $user_page->current_ctc;
	$user_data_set['preferred_location1'] = $user_page->preferred_location1;
	$user_data_set['preferred_location2'] = $user_page->preferred_location2;
	/*$user_data_select['preferred_location3'] = $user_page->preferred_location3;*/
	$user_data_set['pwd_accomodation'] = $user_page->pwd_accomodation;
	$user_data_set['referred_by'] = $user_page->referred_by;
	$user_data_set['referrer_email'] = $user_page->referrer_email;
	$user_data_set['job_code'] = $user_page->job_code;



	$user_data_select['pronoun'] = $user_page->pronoun;
	$user_data_select['identify_as'] = $user_page->identify_as;
	$user_data_select['current_city'] = $user_page->current_city;
	$user_data_select['qualification'] = $user_page->qualification;
	$user_data_select['course'] = $user_page->course;
	$user_data_select['industry'] = $user_page->industry;
	$user_data_select['functional_area'] = $user_page->functional_area;
	$user_data_select['preferred_location3'] = $user_page->preferred_location3;



	$out_at_work = $user_page->out_at_work;
	$active_status = $user_page->active_status;
	$resume_url = $user_page->resume->url;
	$profile_image_url = $user_page->profile_image->url;

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

	<script>
		let website_rootpath = '<?=$config->urls->httpRoot?>resume/';

		$(document).ready(function(){
			<?php
				foreach ($user_data_set as $key => $value) {
			?>

			$("#<?=$key?>").val("<?=$value?>");

			<?php
				}
			?>

			$("input[name='out_at_work']").val(["<?=$out_at_work?>"]);

			$("input[name='active_status']").val(["<?=$active_status?>"]);

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
			<div class="[ my-2 ][ text-center bg-primarya ]">
				<h3>Personal Information</h3>
			</div>

			<div class="[ d-none ]">
				<input id="page_to_edit_id" class="form-control" type="text" value="<?=$user_page->id?>" name="page_to_edit_id" hidden>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="first_name">Legal First Name</label>
				<input id="first_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="first_name" placeholder="Legal First Name" required>

				<div class="invalid-tooltip">
					Please provide a valid name.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="last_name">Legal Last Name</label>
				<input id="last_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="last_name" placeholder="Legal Last Name" required>

				<div class="invalid-tooltip">
					Please provide a valid name.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="preferred_name">Preferred Name <sub class="text-muted"> (optional)</sub></label>
				<input id="preferred_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="preferred_name" placeholder="Preferred Name">

				<div class="invalid-tooltip">
					Please provide a valid name.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="pronoun">Pronoun</label>
				<select id="pronoun" class="custom-select" name="pronoun" required>
					<option value="" selected hidden>Pronoun</option>
					<option value="He">He</option>
					<option value="She">She</option>
					<option value="They">They</option>
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
				<label class="d-block" for="out_at_work">Are you OUT at work?</label>

				<div class="[ custom-control custom-radio ]">
					<input type="radio" id="out_at_work_yes" value="Yes" name="out_at_work" class="custom-control-input" required>
					<label class="custom-control-label" for="out_at_work_yes">Yes, I am</label>
				</div>

				<div class="[ custom-control custom-radio ]">
					<input type="radio" id="out_at_work_no" value="No" name="out_at_work" class="custom-control-input" required>
					<label class="custom-control-label" for="out_at_work_no">No, I am not</label>

					<div class="invalid-tooltip">
						Please select an option.
					</div>
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="identify_as">I identify as:</label>
				<select id="identify_as" class="custom-select" name="identify_as" required>
					<option value="" selected hidden>Identify as</option>
					<option value="Lesbian">Lesbian</option>
					<option value="Gay">Gay</option>
					<option value="Bisexual">Bisexual</option>
					<option value="Transgender">Transgender</option>
					<option value="Intersex">Intersex</option>
					<option value="Gender Non-Confirming">Gender Non-Confirming</option>
					<option value="Non-Binary">Non-Binary</option>
					<option value="Queer / Questioning">Queer / Questioning</option>
					<option value="other">Other</option>
				</select>

				<div class="invalid-tooltip">
					Please select how you identify as.
				</div>
			</div>

			<div id="identify_as_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="identify_as_custom">Please mention how you identify as</label>

				<input id="identify_as_custom" class="form-control" pattern="^[A-Za-z'\s\.\-\\\/]{1,}$" type="text" name="identify_as_custom" placeholder="I identify as">

				<div class="invalid-tooltip">
					Please state how you identidy as.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="date_of_birth">Date of Birth</label>
				<input id="date_of_birth" class="form-control" type="date" name="date_of_birth" min="1900-01-01" max="2002-01-01" required>

				<div class="invalid-tooltip">
					Please select your date of birth.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="email">Email</label>
				<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" value="" required>

				<div class="invalid-tooltip">
					Please provide a valid email address.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="phone_number">Phone Number</label>

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

					<input id="phone_number" class="[ offset-1 col-7 pl-2 ][ form-control ]" pattern="[0-9]{10}" type="text" name="phone_number" placeholder="Example: 9876543210" maxlength="10" required>

					<div class="invalid-tooltip">
						Please provide a valid phone number.
					</div>
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="current_city">Current City</label>

				<select  id="current_city" class="[ custom-select ]" name="current_city" required>
					<option value="" selected hidden>Select Current City</option>
					<option value="Bengaluru"> Bengaluru</option>
					<option value="Chennai"> Chennai</option>
					<option value="Coimbatore"> Coimbatore</option>
					<option value="Chandigarh"> Chandigarh</option>
					<option value="Delhi NCR"> Delhi NCR</option>
					<option value="Jaipur"> Jaipur</option>
					<option value="Kolkata"> Kolkata</option>
					<option value="Kochi"> Kochi</option>
					<option value="Hyderabad"> Hyderabad</option>
					<option value="Mumbai"> Mumbai</option>
					<option value="Pune"> Pune</option>
					<option value="other">Other</option>
				</select>

				<div class="invalid-tooltip">
					Please state your city.
				</div>
			</div>

			<div id="current_city_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="current_city_custom">Please Enter Your Current City</label>

				<input id="current_city_custom" class="form-control" pattern="^[A-Za-z'\s\.\-\\\/]{1,}$" type="text" name="current_city_custom" placeholder="Current City">

				<div class="invalid-tooltip">
					Please state your current city.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="current_state">Current State</label>

				<select id="current_state" class="custom-select" name="current_state" required>
					<option value="" selected hidden> Select a state </option>
					<option value="Andhra Pradesh">Andhra Pradesh</option>
					<option value="Arunachal Pradesh">Arunachal Pradesh</option>
					<option value="Assam">Assam</option>
					<option value="Bihar">Bihar</option>
					<option value="Chhattisgarh">Chhattisgarh</option>
					<option value="Goa">Goa</option>
					<option value="Gujarat">Gujarat</option>
					<option value="Haryana">Haryana</option>
					<option value="Himachal Pradesh">Himachal Pradesh</option>
					<option value="Jammu and Kashmir">Jammu and Kashmir</option>
					<option value="Jharkhand">Jharkhand</option>
					<option value="Karnataka">Karnataka</option>
					<option value="Kerala">Kerala</option>
					<option value="Ladakh">Ladakh</option>
					<option value="Madhya Pradesh">Madhya Pradesh</option>
					<option value="Maharashtra">Maharashtra</option>
					<option value="Manipur">Manipur</option>
					<option value="Meghalaya">Meghalaya</option>
					<option value="Mizoram">Mizoram</option>
					<option value="Nagaland">Nagaland</option>
					<option value="Odisha">Odisha</option>
					<option value="Punjab">Punjab</option>
					<option value="Rajasthan">Rajasthan</option>
					<option value="Sikkim">Sikkim</option>
					<option value="Tamil Nadu">Tamil Nadu</option>
					<option value="Telangana">Telangana</option>
					<option value="Tripura">Tripura</option>
					<option value="Uttarakhand">Uttarakhand</option>
					<option value="Uttar Pradesh">Uttar Pradesh</option>
					<option value="West Bengal">West Bengal</option>
					<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
					<option value="Chandigarh">Chandigarh</option>
					<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
					<option value="Daman and Diu">Daman and Diu</option>
					<option value="Delhi">Delhi</option>
					<option value="Lakshadweep">Lakshadweep</option>
					<option value="Puducherry">Puducherry</option>
				</select>

				<div class="invalid-tooltip">
					Please select your state.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="linkedin_url">Linkedin URL <sub class="text-muted"> (optional)</sub></label>
				<input id="linkedin_url" class="form-control" type="url" name="linkedin_url" placeholder="Linkedin URL">

				<div class="invalid-tooltip">
					Please provide a valid Linkedin URL
				</div>
			</div>

			<div class="[ my-2 ][ text-center ]">
				<h3>Education Information</h3>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="qualification">Highest Qualification</label>

				<select id="qualification" class="custom-select" name="qualification" required>
					<option value="" selected hidden>Select your qualification</option>
					<option value="School">School</option>
					<option value="10th">10th</option>
					<option value="12th">12th</option>
					<option value="Bachelors">Bachelors</option>
					<option value="Masters">Masters</option>
					<option value="PhD">PhD</option>
					<option value="other">Other</option>
				</select>

				<div class="invalid-tooltip">
					Please select your highest qualification.
				</div>
			</div>

			<div id="qualification_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="qualification_custom">Please Enter Your Highest Qualification</label>

				<input id="qualification_custom" class="form-control" type="text" name="qualification_custom" placeholder="Highest Qualification">

				<div class="invalid-tooltip">
					Please state your highest qualification.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="course">Course</label>

				<select id="course" class="custom-select" name="course" required>
					<option value="" selected hidden>Select Course</option>
					<option value="School">School</option>
					<option value="B.A.">B.A.</option>
					<option value="B. Arch.">B. Arch.</option>
					<option value="BCA">BCA</option>
					<option value="B.B.A / B.M.S.">B.B.A / B.M.S.</option>
					<option value="B. Com">B. Com</option>
					<option value="Civil Engineering">Civil Engineering</option>
					<option value="BDS">BDS</option>
					<option value="BHM">BHM</option>
					<option value="B.Pharma">B.Pharma</option>
					<option value="Medical">Medical</option>
					<option value="B.Tech / B.E.">B.Tech / B.E.</option>
					<option value="LLB">LLB</option>
					<option value="M.A.">M.A.</option>
					<option value="MCA">MCA</option>
					<option value="MBA">MBA</option>
					<option value="M. Com">M. Com</option>
					<option value="M.Pharma">M.Pharma</option>
					<option value="M.Sc.">M.Sc.</option>
					<option value="M.Tech / M.E.">M.Tech / M.E.</option>
					<option value="other">Other</option>
				</select>

				<div class="invalid-tooltip">
					Please select your course.
				</div>
			</div>

			<div id="course_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="course_custom">Please Enter Your Course</label>

				<input id="course_custom" class="form-control" type="text" name="course_custom" placeholder="Course">

				<div class="invalid-tooltip">
					Please state your course.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="specialisation">Your Specialisation</label>
				<input id="specialisation" class="form-control" type="text" name="specialisation" placeholder="Your Specialisation" required>

				<div class="invalid-tooltip">
					Please state your specialisation.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="year_of_passing">Year of Passing</label>
				<select id="year_of_passing" class="custom-select" name="year_of_passing" required>
					<option value="" selected hidden>Select Year</option>
					<?php
						for ($i=2020; $i >1939; $i--) {
							echo '<option value="'.$i.'" >'.$i.'</option>';
						}
					?>
				</select>

				<div class="invalid-tooltip">
					Please select your year of passing.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="college">Your College</label>
				<input id="college" class="form-control" type="text" name="college" placeholder="Your College" required>

				<div class="invalid-tooltip">
					Please state your college.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="cartifications">Certifications <sub class="text-muted"> (optional)</sub></label>
				<input id="cartifications" class="form-control" type="text" name="cartifications" placeholder="Certifications">
			</div>

			<div class="[ my-2 ][ text-center ]">
				<h3>Employment Information</h3>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="industry">Current Industry</label>
				<select id="industry" class="custom-select" name="industry" required>
					<option value="" selected hidden>Select Your Industry</option>
					<option value="Finance">Accounting / Finance</option>
					<option value="MR">Advertising / PR / MR</option>
					<option value="Graphics Design">Animation / Graphics Design</option>
					<option value="Interior Design">Architecture / Interior Design</option>
					<option value="Automobile">Automobile</option>
					<option value="Aerospace">Aviation / Aerospace</option>
					<option value="Financial services">Banking / Financial services</option>
					<option value="ITES">BPO / ITES</option>
					<option value="Broadcasting">Broadcasting</option>
					<option value="Petrochemical">Chemical / Petrochemical</option>
					<option value="Defence">Defence</option>
					<option value="Training">Education / Teaching / Training</option>
					<option value="Management">Facility Management</option>
					<option value="Beverages">FMCG / Food / Beverages</option>
					<option value="Processing">Food Processing</option>
					<option value="Travel">Hotel / Restaurant /Airline / Travel</option>
					<option value="Insurance">Insurance</option>
					<option value="Network">IT – Hardware & Network</option>
					<option value="Software Services">IT – Software /Software Services</option>
					<option value="Analytics">KPO / Research / Analytics</option>
					<option value="Legal">Legal</option>
					<option value="Hospital">Medical / Healthcare /Hospital</option>
					<option value="Social Services">NGO / CBO / Social Services</option>
					<option value="other">Other</option>
				</select>

				<div class="invalid-tooltip">
					Please select your current industry.
				</div>
			</div>

			<div id="industry_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="industry_custom">Please Enter Your Current Industry</label>

				<input id="industry_custom" class="form-control" type="text" name="industry_custom" placeholder="Your Industry">

				<div class="invalid-tooltip">
					Please state your Current industry.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="functional_area">Current Functional Area</label>
				<select id="functional_area" class="custom-select" name="functional_area" required>
					<option value="" selected hidden>Select Functional Area</option>
					<option value="Accounts / Finance / Tax / Company Secretary / Audit">Accounts / Finance / Tax / Company Secretary / Audit</option>
					<option value="Analytics & Data Mining">Analytics & Data Mining</option>
					<option value="Architecture">Architecture</option>
					<option value="Beauty / Fitness / Spa Services">Beauty / Fitness / Spa Services</option>
					<option value="CSR & Sustainability">CSR & Sustainability</option>
					<option value="Defence / Security services">Defence / Security services</option>
					<option value="Design / Creative / UI / UX">Design / Creative / UI / UX</option>
					<option value="Engineering / R&D">Engineering / R&D</option>
					<option value="Executive Assistant / Front Desk / Data Entry">Executive Assistant / Front Desk / Data Entry</option>
					<option value="Fashion Designing / Merchandising">Fashion Designing / Merchandising</option>
					<option value="Financial Services / Insurance / Banking">Financial Services / Insurance / Banking</option>
					<option value="Hotel / Restaurant">Hotel / Restaurant</option>
					<option value="HR / Recruitment / Admin">HR / Recruitment / Admin</option>
					<option value="IT – Hardware">IT – Hardware</option>
					<option value="IT – Application building">IT – Application building</option>
					<option value="IT – Client / Server">IT – Client / Server</option>
					<option value="IT – DBA / Datawarehousing">IT – DBA / Datawarehousing</option>
					<option value="IT – E-Commerce">IT – E-Commerce</option>
					<option value="IT – Embedded / VLSI / EDA">IT – Embedded / VLSI / EDA</option>
					<option value="IT – ERM / ERP / CRM">IT – ERM / ERP / CRM</option>
					<option value="IT – Mainframe">IT – Mainframe</option>
					<option value="IT – Mobile">IT – Mobile</option>
					<option value="IT – Network Admin / Security">IT – Network Admin / Security</option>
					<option value="IT – Telecom">IT – Telecom</option>
					<option value="ITES / BPO / KPO / LPO / Customer Service">ITES / BPO / KPO / LPO / Customer Service</option>
					<option value="Legal / IP">Legal / IP</option>
					<option value="Marketing / PR / Media">Marketing / PR / Media</option>
					<option value="Manufacturing / Production">Manufacturing / Production</option>
					<option value="Sales / Retail">Sales / Retail</option>
					<option value="Project Management">Project Management</option>
					<option value="Logistics / Supply Chain">Logistics / Supply Chain</option>
					<option value="Travel / Tour / Airline">Travel / Tour / Airline</option>
					<option value="other">Other</option>
				</select>

				<div class="invalid-tooltip">
					Please select your current functional area.
				</div>
			</div>

			<div id="functional_area_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="functional_area_custom">Please Enter Your Current Functional Area</label>

				<input id="functional_area_custom" class="form-control" type="text" name="functional_area_custom" placeholder="Functional Area">

				<div class="invalid-tooltip">
					Please state your current functional area.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="experience_years">Total Experience</label>

				<div class="row no-gutters">
					<div class="[ col-6 pr-2 ][ input-group ]">
						<div class="input-group-prepend">
							<div class="input-group-text">Years</div>
						</div>

						<select id="experience_years" class="custom-select" name="experience_years" required>
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

						<select id="experience_months" class="custom-select" name="experience_months" required>
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
				<label for="current_employer">Current Employer</label>
				<input id="current_employer" class="form-control" type="text" name="current_employer" placeholder="Employer's Name" required>

				<div class="invalid-tooltip">
					Please state your current employer.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="current_role">Current Role</label>
				<input id="current_role" class="form-control" type="text" name="current_role" placeholder="Current Role" required>

				<div class="invalid-tooltip">
					Please state your current role.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="technical_skills">Technical (IT) Skills <sub class="text-muted">(Seperated by comma ",") (optional)</sub></label>
				<input id="technical_skills" class="form-control" type="text" name="technical_skills" placeholder="Example- Python, Java, AWS">

				<div class="invalid-tooltip">
					Please enter technical (IT) skill sets.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="non_technical_skills">Non-Technical Skills <sub class="text-muted">(Seperated by comma ",")</sub></label>
				<input id="non_technical_skills" class="form-control" type="text" name="non_technical_skills" placeholder="Example- MS Word, Finance Management, Professional Driving" required>

				<div class="invalid-tooltip">
					Please enter non-technical skill sets.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="soft_skills">Soft Skills <sub class="text-muted">(Seperated by comma ",")</sub></label>
				<input id="soft_skills" class="form-control" type="text" name="soft_skills" placeholder="Example- Fluent Communication, Leadership, Public Speaking" required>

				<div class="invalid-tooltip">
					Please enter soft skill sets.
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="current_ctc">Current CTC</label>

				<div class="row no-gutters">
					<select id="current_ctc_time" class="[ col-4 pl-2 ][ custom-select ]" name="current_ctc_time">
						<option value="Annual" selected>Annual</option>
						<option value="Monthly">Monthly</option>
					</select>

					<input id="current_ctc" class="[ offset-1 col-7 pl-2 ][ form-control ]" type="text" name="current_ctc" pattern="[0-9]{0,}" placeholder="Current CTC" required>

					<div class="invalid-tooltip">
						Please state your current CTC.
					</div>
				</div>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="preferred_location">Your Preferred Work Location <sub class="text-muted"> (optional)</sub></label>

				<div class="row">
					<div class="col-12 col-md-4">
						<select  id="preferred_location1" class="[ custom-select ]" name="preferred_location1">
									<option value="" hidden disabled selected>City 1</option>
									<option value="Bengaluru">Bengaluru</option>
									<option value="Chennai">Chennai</option>
									<option value="Coimbatore">Coimbatore</option>
									<option value="Chandigarh">Chandigarh</option>
									<option value="Delhi NCR">Delhi NCR</option>
									<option value="Jaipur">Jaipur</option>
									<option value="Kolkata">Kolkata</option>
									<option value="Kochi">Kochi</option>
									<option value="Mumbai">Mumbai</option>
									<option value="Hyderabad">Hyderabad</option>
									<option value="Pune">Pune</option>
						</select>
					</div>

					<div class="col-12 col-md-4">
						<select  id="preferred_location2" class="[ custom-select ]" name="preferred_location2">
									<option value="" hidden disabled selected>City 2</option>
									<option value="Bengaluru">Bengaluru</option>
									<option value="Chennai">Chennai</option>
									<option value="Coimbatore">Coimbatore</option>
									<option value="Chandigarh">Chandigarh</option>
									<option value="Delhi NCR">Delhi NCR</option>
									<option value="Jaipur">Jaipur</option>
									<option value="Kolkata">Kolkata</option>
									<option value="Kochi">Kochi</option>
									<option value="Mumbai">Mumbai</option>
									<option value="Hyderabad">Hyderabad</option>
									<option value="Pune">Pune</option>
						</select>
					</div>

					<div class="col-12 col-md-4">
						<select  id="preferred_location3" class="[ custom-select ]" name="preferred_location3">
									<option value="" hidden disabled selected>City 3</option>
									<option value="Bengaluru">Bengaluru</option>
									<option value="Chennai">Chennai</option>
									<option value="Coimbatore">Coimbatore</option>
									<option value="Chandigarh">Chandigarh</option>
									<option value="Delhi NCR">Delhi NCR</option>
									<option value="Jaipur">Jaipur</option>
									<option value="Kolkata">Kolkata</option>
									<option value="Kochi">Kochi</option>
									<option value="Mumbai">Mumbai</option>
									<option value="Hyderabad">Hyderabad</option>
									<option value="Pune">Pune</option>
									<option value="other">Other</option>
						</select>
					</div>

					<div class="invalid-tooltip">
						Please select preferred location.
					</div>
				</div>
				<!-- <select  id="preferred_location" class="[ custom-select ]" name="preferred_location"  multiple size="3" required>
					<option value="" disabled>Select Upto Three Preferred</option>
					<option value="bengaluru">Bengaluru</option>
					<option value="chennai">Chennai</option>
					<option value="coimbatore">Coimbatore</option>
					<option value="chandigarh">Chandigarh</option>
					<option value="delhi_ncr">Delhi NCR</option>
					<option value="jaipur">Jaipur</option>
					<option value="kolkata">Kolkata</option>
					<option value="kochi">Kochi</option>
					<option value="mumbai">Mumbai</option>
					<option value="hyderabad">Hyderabad</option>
					<option value="pune">Pune</option>
					<option value="other">Other</option>
				</select> -->


			</div>

			<div id="preferred_location3_custom_container" class="[ my-5 hidden ][ form-group ]">
				<label for="preferred_location3_custom">Please Enter Your Preferred Location</label>

				<input id="preferred_location3_custom" class="form-control" type="text" name="preferred_location_custom" placeholder="Preferred Location">

				<div class="invalid-tooltip">
					Please state your preferred location.
				</div>
			</div>

			<div class="[ mt-5 mb-3 ][ text-center ]">
				<h3>Additional Details</h3>
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="job_code">Job Code <sub class="text-muted"> (optional)</sub></label>
				<input id="job_code" class="form-control" type="text" name="job_code" placeholder="Job Code">
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="pwd_accomodation">Would you need reasonable accommodation (PWD)?<sub class="text-muted"> (optional)</sub></label><i class="[ ml-2 ][ far fa-question-circle ][ text-muted ]" data-toggle="popover" title="Reasonable Accomodation" tabindex="0" data-trigger="focus" data-original-title="Reasonable Accomodation" data-content="To know more, click <a target='_blank' href='https://en.wikipedia.org/wiki/Reasonable_accommodation'>here</a>."></i>
				<input id="pwd_accomodation" class="form-control" type="text" name="pwd_accomodation" placeholder="">
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="referred_by">Referred By <sub class="text-muted"> (optional)</sub></label>
				<input id="referred_by" class="form-control" type="text" name="referred_by" placeholder="Referrer's Name">
			</div>

			<div class="[ my-5 ][ form-group ]">
				<label for="referrer_email">Referrer's Email<sub class="text-muted"> (optional)</sub></label>

				<input id="referrer_email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="referrer_email" placeholder="Referrer's Email">

				<div class="invalid-tooltip">
					Please provide a valid email address.
				</div>
			</div>

			<div class="[ my-5 ][ text-center ]">
				<h3>Resume Upload</h3>
			</div>

			<a class="" href="<?=$resume_url?>" target='_blank' title="">View Submitted Resume</a>

			<div class="[ my-5 ][ form-group ]">
				<label>Re-upload Your Resume</label>

				<div class="custom-file">
					<input  id="resume" name="resume" class="custom-file-input" type="file">
					<label id="resume_label" class="custom-file-label" for="resume">PDF or MS Word files only</label>

					<div class="invalid-tooltip">
						Please upload a valid resume.
					</div>
				</div>
			</div>

			<a class="" href="<?=$profile_image_url?>" target='_blank' title="">View Submitted Profile Image</a>

			<div class="[ my-5 ][ form-group ]">
				<label>Re-upload Your Profile Image</label>

				<div class="custom-file">
					<input id="profile_image" name="profile_image" class="custom-file-input" type="file">
					<label id="profile_image_label" class="custom-file-label" for="profile_image">PNG or JPG images only</label>

					<div class="invalid-tooltip">
						Please upload a valid image.
					</div>
				</div>
			</div>

			<?php
				if($session->user_designation == "admin" && isset($_GET['page_id'])){
			?>

			<div class="[ my-5 ][ form-group ]">
				<label class="d-block" for="active_status">Active Status</label>

				<div class="[ custom-control custom-radio ]">
					<input type="radio" id="active_status_active" value="Active" name="active_status" class="custom-control-input" required>
					<label class="custom-control-label" for="active_status_active">Active</label>
				</div>

				<div class="[ custom-control custom-radio ]">
					<input type="radio" id="active_status_inactive" value="Inactive" name="active_status" class="custom-control-input" required>
					<label class="custom-control-label" for="active_status_inactive">Inactive</label>

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
					<label id="redacted_resume_label" class="custom-file-label" for="resume">PDF or MS Word files only</label>

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

				<button value="submit" id="education-next" class="[ btn btn-primary px-4 ]( btn-submit )" type="submit" data-toggle="modal" data-target="#myModalDemo">
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

	<?php require_once 'includes/sticky-footer.php' ?>

		<!-- ---------- JS LINKS ---------- -->
	<!-- Form Validation (validator.js)) JS -->
	<script src="<?= $rootpath;?>scripts/validate.min.js" type="text/javascript"></script>
	<!-- Underscore JS -->
	<script src="<?= $rootpath;?>scripts/underscore.min.js" type="text/javascript"></script>
	<!-- Page-specific JS -->
	<script src="<?= $rootpath;?>scripts/form-edit.js?v=2.08" type="text/javascript"></script>
	<!-- ---------- JS LINKS END ---------- -->
</body>
