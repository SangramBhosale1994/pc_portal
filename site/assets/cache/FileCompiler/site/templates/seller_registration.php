<?php

	if($input->post->email){
		$name = $sanitizer->text($input->post->name);
		$email = $sanitizer->email($input->post->email);
		$phone_number = $sanitizer->text($input->post->phone_country_code.$input->post->phone_number);
		$shop_name = $sanitizer->text($input->post->shop_name);
// 		$designation = $sanitizer->text($input->post->designation);
		$password = $sanitizer->text($input->post->password);
// 		$industry = $sanitizer->text($input->post->industry);
// 		$employee_count = $sanitizer->text($input->post->employee_count);
// 		$company_open_participation = $sanitizer->text($input->post->company_open_participation);

		/*** Basic Page Creation Info */
		$new_profile_page = new \ProcessWire\Page();
		$new_profile_page->template = $templates->get("universal_profile");
		$new_profile_page->parent = $pages->get("name=universal-profiles");
		$new_profile_page->title = $name;
		/*** Basic Page Creation Info End */

		$new_profile_page->shop_name = $shop_name;
		$new_profile_page->email = $email;
		$new_profile_page->phone_number = $phone_number;
		//$new_profile_page->designation = $designation;
		$new_profile_page->password = $password;
		//$new_profile_page->industry = $industry;
		//$new_profile_page->employee_count = $employee_count;
		$new_profile_page->user_type = "company_seller";
		$new_profile_page->verification = "verified";
		//$new_profile_page->company_open_participation = $company_open_participation;

		$new_profile_page->of(false);
		$new_profile_page->save();


		$new_company_page = new \ProcessWire\Page();
		$new_company_page->template = $templates->get("seller_profiles");
		$new_company_page->parent = $pages->get("name=seller-profiles");
		$new_company_page->title = $shop_name;
		/*** Basic Page Creation Info End */

		$new_company_page->seller_email = $email;
		$new_company_page->industry = $industry;
		$new_company_page->employee_count = $employee_count;
		// $new_company_page->sub_users = $employee_count;
// 		$referrer_member_code = mt_rand(100000,999999);
// 		$new_company_page->referrer_member_code = $referrer_member_code;
		$new_company_page->seller_profile_id = $new_profile_page;
		$new_company_page->verification = "verified";
		$new_company_page->of(false);
		$new_company_page->save();
		
		$new_profile_page->seller_page_id = $new_company_page->id;
		
		$new_profile_page->of(false);
		$new_profile_page->save();

		$session->email = $email;
		$session->applicant_name = $name;
		$session->user_type = $new_profile_page->user_type;
		//$session->company_name = $company_name;
		$session->verification = "verified";

		header("Location: ".$config->urls->httpRoot."universe/seller-privacy-statement/");
	}

	// if($input->post->email){
	// 	$email = $sanitizer->email($input->post->email);

	// 	$otp = mt_rand(100000,999999);

	// 	$np = new \ProcessWire\Page();
	// 	$np->template = $templates->get("otp_verification");
	// 	$np->parent = $pages->get("name=login-with-email");
	// 	$np->title = $otp;
	// 	$np->email = $email;
	// 	$np->otp_status = "live";
	// 	$np->save();

	// 	$subject = "OTP from Pride Circle";
	// 	$message = "Greetings from Pride Circle!\n\nThe OTP for your login is ".$otp;
	// 	$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;

	// 	try {
	// 		mail($email, $subject, $message, $headers);
	// 	} catch (Exception $e) {
	// 		$error_message = true;
	// 	}
	// }

	$rootpath = $config->urls->templates;
?>
<!DOCTYPE html>
<html>
<head>
	<?php
 include(\ProcessWire\wire('files')->compile('includes/general_seller_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
		?>
	<form action="" id="main-container" class="[ my-5 px-sm-5 ][ container rounded ]" method="POST">
		<div class="[ my-4 ][ text-center ]">
			<h3>Registration</h3>
			<p>(All fields are mandatory)</p>
		</div>



		<div class="[ my-5 ][ form-group ]">
			<label for="name">Personal Name</label>
			<input id="name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="name" placeholder="Your Name" required>

			<div class="invalid-tooltip">
				Please provide a valid name.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="email">Personal Email</label>
			<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" value="<?=$session->oauth_gmail;?>" required>

			<div class="invalid-tooltip">
				Please provide a valid email address.
			</div>
		</div>

		
		<div class="[ my-5 ][ form-group ]">
				<label for="phone_number">Personal Phone Number</label>

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
			
		<!--<div class="[ my-5 ][ form-group ]">-->
		<!--	<label for="designation">Designation</label>-->
		<!--	<input id="designation" class="form-control" type="text" name="designation" placeholder="Designation" required>-->

		<!--	<div class="invalid-tooltip">-->
		<!--		Please provide a valid designation.-->
		<!--	</div>-->
		<!--</div>-->

		<div class="[ my-5 ][ form-group ]">
			<label for="shop_name">Shop Name</label>
			<input id="shop_name" class="form-control" type="text" name="shop_name" placeholder="Shop Name" required>

			<div class="invalid-tooltip">
				Please provide a valid shop name.
			</div>
		</div>

		<!--<div class="[ my-5 ][ form-group ]">-->
		<!--	<label for="company_name">Industry</label>-->

		<!--	<select class="form-control" name="industry" required>-->
		<!--		<option value="Aerospace">Aerospace</option>-->
		<!--		<option value="Agriculture, forestry and fishing">Agriculture, forestry and fishing</option>-->
		<!--		<option value="Biotechnology and Pharmaceuticals">Biotechnology and Pharmaceuticals</option>-->
		<!--		<option value="Construction, Infrastructure and Real Estate">Construction, Infrastructure and Real Estate</option>-->
		<!--		<option value="Education and Training">Education and Training</option>-->
		<!--		<option value="Electronics">Electronics</option>-->
		<!--		<option value="Financial Services and Insurance">Financial Services and Insurance</option>-->
		<!--		<option value="Health Care">Health Care</option>-->
		<!--		<option value="Hospitality">Hospitality</option>-->
		<!--		<option value="Industrial Services">Industrial Services</option>-->
		<!--		<option value="Information Technology">Information Technology</option>-->
		<!--		<option value="Manufacturing and Production">Manufacturing and Production</option>-->
		<!--		<option value="Media">Media</option>-->
		<!--		<option value="Mining and Quarrying">Mining and Quarrying</option>-->
		<!--		<option value="Non-profit and Charity Organisations">Non-profit and Charity Organisations</option>-->
		<!--		<option value="Professional Services">Professional Services</option>-->
		<!--		<option value="Retail">Retail</option>-->
		<!--		<option value="Social Services and Government Agencies">Social Services and Government Agencies</option>-->
		<!--		<option value="Telecommunications">Telecommunications</option>-->
		<!--		<option value="Trading">Trading</option>-->
		<!--		<option value="Transportation">Transportation</option>-->
		<!--		<option value="Other">Other</option>-->
		<!--	</select>-->

		<!--	<div class="invalid-tooltip">-->
		<!--		Please select an industry.-->
		<!--	</div>-->
		<!--</div>-->

		<!--<div class="[ my-5 ][ form-group ]">-->
		<!--	<label for="company_name">Number of Employees</label>-->

		<!--	<select class="form-control" name="employee_count" required>-->
		<!--		<option value="Less than 50">Less than 50</option>-->
		<!--		<option value="50 - 99">50 - 99</option>-->
		<!--		<option value="100 - 500">100 - 500</option>-->
		<!--		<option value="501 - 4999">501 - 4999</option>-->
		<!--		<option value="5000 - 9999">5000 - 9999</option>-->
		<!--		<option value="10000 - 49,999">10000 - 49,999</option>-->
		<!--		<option value="50,000 &amp; above">50,000 &amp; above</option>-->
		<!--	</select>-->

		<!--	<div class="invalid-tooltip">-->
		<!--		Please select a range.-->
		<!--	</div>-->
		<!--</div>-->

	

		<!--<div class="[ my-5 ][ form-group ]">-->
		<!--	<label>We would like the company's name published in the IWEI Report and other collaterals as a "participating organization".</label>-->

		<!--	<label><input type="radio" id="company_open_participation_yes" name="company_open_participation" value="Yes" required> Yes (Open Participation)</label>-->
		<!--	<label><input type="radio" id="company_open_participation_no" name="company_open_participation" value="No"> No (Anonymous Participation)</label>-->
		<!--</div>-->

		<div class="[ my-5 ][ form-group ]">
			<label for="password">Password</label>
			<!--<input id="password" class="form-control" type="password" pattern='/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/' name="password" placeholder="" required>-->
			<input id="password" class="form-control" type="password" pattern='^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$' name="password" placeholder="" required>
			<sub class="text-muted"> (Password must have a capital letter, a small letter, a special character, a number and be minimum 8 characters long!)</sub>

			<div class="invalid-tooltip">
				Please provide a Password.
			</div>
		</div>

		<div class="[ my-5 ][ form-group ]">
			<label for="confirm_password">Confirm Password</label>
			<input id="confirm_password" class="form-control" type="password" name="confirm_password" placeholder="" required>

			<div class="invalid-tooltip">
				Please retype the password.
			</div>

			<div  class="[ text-danger ]" style="height: 1.3rem" >
				<div id="no_match" hidden="true">
					Passwords do not match.
				</div>
			</div>
		</div>

		<!-- Buttons Section -->
		<div class="[  mb-4  ][ d-flex flex-row justify-content-center ]">
			<button value="submit" id="submit" class="[ px-5 ][ btn btn-primary ]( btn-submit )" type="submit">
					Register
			</button>
		</div>

		<div class="[  mb-1  ][ d-flex flex-row justify-content-center [ btn btn-sm btn-outline-light text-muted ]]">
			Already registered? 
			<a href="<?=$pages->get("name=universe")->httpUrl?>" class="" style="margin-left:1px;"> Login here.</a>
		</div>
	</form>

	<?php
		if(isset($error_message)){
	?>
		<script type="text/javascript">
			$(document).ready(function(){
				alert("Something went wrong. Please try again.");
			})
		</script>
	<?php
		}
	?>
	
	<script src="<?= $rootpath;?>scripts/jquery-3.4.1.min.js"></script>
	<!-- <script src="<?= $rootpath;?>scripts/popper.min.js"></script> -->
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
		
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on("keyup","#confirm_password",  function(){
				if($(this).val() == $("#password").val()){
					$("#submit").prop("disabled", false);
					$("#no_match").prop("hidden", true);
				}
				else{
					$("#submit").prop("disabled", true);
					$("#no_match").prop("hidden", false);
				}
			});
			
				$(document).on("keyup","#password",  function(){
				if($(this).val() == $("#password").val()){
					$("#submit").prop("disabled", false);
					$("#no_match").prop("hidden", true);
				}
				else{
					$("#submit").prop("disabled", true);
					$("#no_match").prop("hidden", false);
				}
			});
			
				$(document).on("click","#submit",  function(){
				if($("#confirm_password").val() == $("#password").val()){
					$("#submit").prop("disabled", false);
					$("#no_match").prop("hidden", true);
				}
				else{
					$("#submit").prop("disabled", true);
					$("#no_match").prop("hidden", false);
				}
			})


			/*$(".btn-submit").on('click', function(e){
				e.preventDefault();
				e.stopPropagation();

				if ($(this).closest('form').find('input, select, textbox').filter(function(){return this.checkValidity() === false}).length>0){
					$(this).closest('form').addClass('was-validated');
				}
				else{
					$(this).closest('form').submit();
				}
			})*/
		});

	// 	$(document).ready(function(){
    // 		$(document).on("keyup","#email",  function(){
    // 			return (/^([\w-.]+@(?!gmail\.com)(?!yahoo\.com)(?!outlook\.com)([\w-]+.)+[\w-]{2,4})?$/);
    // 			 message: 'Please enter your work email address';
	// 	})
	// });

	
				
	</script>
	    <?php
 include(\ProcessWire\wire('files')->compile('includes/general_seller_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
		?>
</body>
</html>