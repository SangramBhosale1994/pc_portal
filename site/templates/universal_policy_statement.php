<?php
	$rootpath = $config->urls->templates;

	if($session->email == "" || $session->company_name == ""){
		$session->redirect($pages->get("name=universal-login")->httpUrl);
	}
	else if($input->post->submit){
		$user_email = $session->email;
		$user_page = $pages->get("name=universal-profiles")->child("email={$user_email}");

		if($user_page->id != 0){
			$user_page->of(false);
			$user_page->privacy_policy_acceptance = "accepted";
			$user_page->save();

			$session->redirect($pages->get("name=home")->httpUrl);
		}
	}


?>
<!DOCTYPE html>
<html>
	<head>
		

		<?php
			include 'includes/general_header.php';

			$user_email = $session->email;
			$user_page = $pages->get("name=universal-profiles")->child("email={$user_email}");
		?>

		<div class="[ mt-5 py-4 ][ container ]">
			<div class="[ d-flex justify-content-between ]">
				<div class="" style="font-size: 1.2rem"><?=$session->applicant_name?><br><?=$session->company_name?></div>

				<div>
					<a class="[ px-4 ][ btn btn-outline-primary ]" href="<?=$pages->get("name=company-logout")->httpUrl?>">Logout</a>
				</div>
			</div>
		</div>

		<div class="container tabcontainer mt-5 p-5">
			<div id="main-container">
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:6.0pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:center;background:white;'><strong><u><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>DATA PROTECTION AND PRIVACY STATEMENT</span></u></strong></p>
				<br>
				<br>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.0pt;margin-left:0cm;line-height:16.5pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;font-family:"Cambria",serif;'>This privacy statement sets out how Pride Circle (hereinafter &ldquo;Us&rdquo; or &ldquo;the Data Controllers&rdquo;) uses and protects any information that you give Pride Circle when you use the website <strong><em><u>www.workplaceequalityindex.in</u></em></strong> (hereinafter, &ldquo;the Website&rdquo;), and/or the software application designed, digital media, storage medium, or functionalities related to <strong>India Workplace Equality Index&nbsp;</strong>(hereinafter &ldquo;IWEI&rdquo;).</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>When using the Platform, each time you provide Us with or it is necessary for Us to access any kind of information which, due to their characteristics, allow us to identify you, such as your name, surname, email address, telephone number, type of device &nbsp;(hereinafter, &ldquo;Personal Data&rdquo;), whether for purposes of browsing, registering or using our services or functionalities, you will be subject to Data Protection and Privacy Statement Use and other documents cited therein (jointly &ldquo;the Terms and Conditions&rdquo;) which are applicable at all times and should be reviewed to ensure you agree with them.</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;'>&nbsp;</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><strong><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>1. COLLECTION OF PERSONAL DATA AND PROCESSING PURPOSES</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:16.5pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;font-family:"Cambria",serif;'>Please bear in mind that before using any of our services or functionalities, you must read this Data Protection and Privacy Statement regarding the service or functionality. User&#39;s (your) Personal Data is collected for following purposes only:</span></p>
				<ul style="list-style-type: disc;">
					<li><span style='font-family:"Cambria",serif;'>Collecting information as submitted by the user to participate in the India Workplace Equality Index.&nbsp;</span></li>
					<li><span style='font-family:"Cambria",serif;'>Analyzing the data, verifying against the supporting documents. Marking as per information provided.</span></li>
					<li><span style='font-family:"Cambria",serif;'>Publishing the results to the user.&nbsp;</span></li>
				</ul>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>The user (you) may choose not to provide certain Personal Data or withdraw the consent subsequently with respect to such Personal Data by sending a written intimation. However, not providing certain compulsory information or withdrawing the consent may mean that it will not be possible to manage your registration as a user or to use certain functionalities or services available through the Platform.</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><strong><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>2. COMPANY AND ADDRESS DELEGATED WORK</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><strong><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>&nbsp;</span></strong><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>You hereby guarantee that the Data provided is true and exact and agrees to report any change or modification thereto. Any loss or damage caused to the Platform, to Data Controllers or to any third party through the communication of erroneous, inaccurate, or incomplete information on the registration forms shall be the sole responsibility of the user. The Data Controllers, shall use Personal Data for the following purposes:</span></p>
				<div style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'>
					<ol start="1" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:50px;">
						<li style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Cambria",serif;'>To manage your registration as a user of the Platform. The Personal Data you provide us with shall be used to identify you as a Platform user, and to give you access to its different functionalities, products and services that are available to you as a registered user.</span></li>
					</ol>
				</div>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:60.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;'>&nbsp;</span></p>
				<div style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'>
					<ol start="2" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:50px;">
						<li style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Cambria",serif;color:black;'>Contact you by email, telephone calls, SMS, or other equivalent forms of electronic&nbsp;communication, such as the App&rsquo;s push notifications etc., regarding updates or informative&nbsp;communications related to the functionalities, products or contracted services, including Platform security updates, when necessary or reasonable for their implementation.</span></li>
					</ol>
				</div>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.2pt;margin-left:60.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>&nbsp;</span></p>
				<div style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'>
					<ol start="3" style="margin-bottom:0cm;list-style-type: upper-alpha;margin-left:50px;">
						<li style='margin-top:0cm;margin-right:0cm;margin-bottom:10.0pt;margin-left:0cm;line-height:115%;font-size:15px;font-family:"Calibri",sans-serif;'><span style='font-family:"Cambria",serif;'>Attend and manage your requests made using the available customer service channels in relation to the Platform or the Physical Stores, as well as monitoring the quality of our service.</span></li>
					</ol>
				</div>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><strong><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>3. DATA PROTECTION RIGHTS</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>The Data Controllers undertake to respect the confidentiality of your Personal Data and to guarantee you can exercise your rights. You may exercise your rights of access, rectification, cancellation and opposition by sending an email to:&nbsp;</span><span style="color:black;"><a href="mailto:contact@workplaceequalityindex.in"><span style='font-size:16px;font-family:"Cambria",serif;'>contact@workplaceequalityindex.in</span></a></span><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>&nbsp;indicating the reason for your request.</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>If you decide to exercise these rights, and if part of the personal data you provided was your email address, we would ask you to please specify this circumstance in your written request, indicating the email address from which you wish to exercise your right rights of access, rectification, cancellation and opposition.</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><strong><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>5. WHAT WE ASK YOU TO SUBMIT IN IWEI</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>Whilst registering and completing a submission, we may ask you to submit the following information:</span></p>
				<ul style="list-style-type: undefined;">
					<li><span style='font-family:"Cambria",serif;color:black;'>Information and files as supporting evidence for submissions such as:</span></li>
					<li><span style='font-family:"Cambria",serif;color:black;'>Policy Excerpt</span></li>
					<li><span style='font-family:"Cambria",serif;color:black;'>Communications</span></li>
					<li><span style='font-family:"Cambria",serif;color:black;'>Screenshots of intranet posts</span></li>
					<li><span style='font-family:"Cambria",serif;color:black;'>Descriptions of processes and ways of working</span></li>
					<li><span style='font-family:"Cambria",serif;color:black;'>Examples of training</span></li>
					<li><span style='font-family:"Cambria",serif;color:black;'>Case studies</span><span style="color:black;">&nbsp;</span></li>
				</ul>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:18.0pt;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;'>&nbsp;</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;'>&nbsp;</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>Please note that whilst completing your submission you make be asked to provide pieces of evidence which include personal details, such as profiles of individuals. It is your responsibility to ensure you have the permission of the individual to share this information with Us.</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;'>&nbsp;</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><strong><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>6. LINKS TO OTHER WEBSITES</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>Our website may contain links to other websites of interest. However, once you have used these links to leave our site, you should note that we do not have any control over that other website. Therefore, we cannot be responsible for the protection and privacy of any information which you provide whilst visiting such sites and such sites are not governed by this privacy statement. You should exercise caution and look at the privacy statement applicable to the website in question.</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><strong><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>7. &nbsp;SECURITY PRACTICES</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>The Data Controllers adopt reasonable security practices and procedures as mandated under applicable Indian laws for the protection of Personal Data and to prevent unauthorised use or disclosure of Personal Data.</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:11.25pt;margin-left:0cm;line-height:16.5pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><strong><span style='font-size:16px;font-family:"Cambria",serif;'>8. CHANGES TO THIS PRIVACY POLICY</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:16.5pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><span style='font-size:16px;font-family:"Cambria",serif;'>The Data Controllers has the discretion to update this privacy policy at any time. We encourage User to frequently check this page for any changes to stay informed about how we assist to protect the personal information we collect. You acknowledge and agree that it is your responsibility to review this privacy policy periodically and be aware of modifications.</span></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:7.5pt;margin-left:0cm;line-height:16.5pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><strong><span style='font-size:16px;font-family:"Cambria",serif;'>&nbsp;</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:11.25pt;margin-left:0cm;line-height:16.5pt;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;'><strong><span style='font-size:16px;font-family:"Cambria",serif;'>9. YOUR ACCEPTANCE OF THESE TERMS</span></strong></p>
				<p style='margin-top:0cm;margin-right:0cm;margin-bottom:15.6pt;margin-left:0cm;line-height:normal;font-size:15px;font-family:"Calibri",sans-serif;text-align:justify;background:white;'><span style='font-size:16px;font-family:"Cambria",serif;color:black;'>By using this Site, you signify your acceptance of this policy and terms of service. If you do not agree to this policy, please do not use our Site. Your continued use of the Site, following the posting of changes to this policy will be deemed as your acceptance of those changes.</span></p>

				<br>
				<br>

				<form action="" method="POST" class="[ text-center ]">
					<input type="submit" class="[ px-5 ][ btn btn-primary ]" name="submit" value="I Accept">
				</form>
			</div>
		</div>

		<script src="<?= $rootpath;?>scripts/jquery-3.4.1.min.js"></script>
		<!-- <script src="<?= $rootpath;?>scripts/popper.min.js"></script> -->
		<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
		<script src="<?= $rootpath;?>scripts/script.js?v=<?=mt_rand(0,999)?>"></script>
	</body>


	
</html>