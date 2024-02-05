<?php
include 'includes/send_mail_ticketing.php';

		/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
		/**** Get serial ID from the serial ID page */
		foreach($pages->get("name=pass-applicants")->children("pass_verification=verified,limit=1") as $job_fair_attendee_page)
		{
    	
    		
    		$event_name = "RISE 2021";
    		$pass_number=$job_fair_attendee_page->serial_id;
    		$applicants_name=$job_fair_attendee_page->title;
    		$applicants_email=$job_fair_attendee_page->email;
    		$applicants_contact=$job_fair_attendee_page->phone_country_code."".$job_fair_attendee_page->phone_number;
    		$event_link="https://rise2021.vtour.tech/";
    		$visit_link="https://www.thepridecircle.com/rise2021/";
    		$video_guide="https://youtu.be/BU-bjlq1IEU";
    		
    		$applicants_subject="RISE 2021 | Job Fair Pass and Details";
    
    		$applicants_message ="Hello {$applicants_name},";
    		
    		$applicants_message .="<br><br>";
    		$applicants_message .="Welcome to RISE Job Fair 2021, May 8th.";
    		$applicants_message .="<br><br>";
    
    		$applicants_message .="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
    		$applicants_message .="    <tr>";
    		$applicants_message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
    		$applicants_message .="            <b>{$event_name}</b>";
    		$applicants_message .="        </td>";
    		$applicants_message .="    </tr>";
    		$applicants_message .="</table>";
    
    		$applicants_message .="<table style='border:1px solid #aaa;width:100%; padding:5px'>";
    		$applicants_message .="    <tr style='padding:10px;' >";
    		$applicants_message .="        <td style='text-align:left; padding:15px;'>";
    		$applicants_message .="            <b>Date</b>: May 8th</b>";
    		$applicants_message .="            <br>";
    		$applicants_message .="            <b>Time</b>: 10:30am to 6:00pm (IST)[Join per your alloted slot]</b>";
    		$applicants_message .="            <br>";
    		$applicants_message .="            <b>Join the Event</b>: {$event_link}";
    		$applicants_message .="            <p style='margin-top:0px; margin-bottom:0px;'>[Link will be LIVE only from 8th May 10:30 am IST]</p>\n";  
    // 		$applicants_message .="            <br>";
    		$applicants_message .="            <b>Name</b>: {$applicants_name}";
    		$applicants_message .="            <br>";
    		$applicants_message .="            <b>Contact Number</b>: {$applicants_contact}";
    		$applicants_message .="            <br>";
    		$applicants_message .="            <b>Learn more</b>: <a href='{$visit_link}'>Visit</a>";
    		$applicants_message .="            <br>";
    		$applicants_message .="            <b>Platform opens at</b>: 8th May, 10:30am (IST)";
    		$applicants_message .="        </td>";
    		$applicants_message .="    </tr>";
    		$applicants_message .="</table>";
    
    		$applicants_message .="<br>";
    		$applicants_message .="<hr>";
    		$applicants_message .="<br>";
    		$applicants_message .="<p style='font-weight: 400;'><strong>To log in:</strong></p>";
    		$applicants_message .="<ul>";
    		$applicants_message .="<li style='font-weight: 400;'>Click on the event link given above</li>";
    		$applicants_message .="<li style='font-weight: 400;'>Enter your country code and registered mobile number (no spaces)</li>";
    		$applicants_message .="<li style='font-weight: 400;'>Click on 'Send OTP'</li>";
    		$applicants_message .="<li style='font-weight: 400;'>Enter the OTP received on your registered mobile number</li>";
    		$applicants_message .="<li style='font-weight: 400;'>Click on 'Sign in'</li>";
    		$applicants_message .="</ul>";
    // 		$applicants_message .="<br>";
    		$applicants_message .="<p style='font-weight: 400;'>Here is a video guide to help you navigate the platform:&nbsp;<a href='{$video_guide}'>https://youtu.be/BU-bjlq1IEU</a></p>";
    		$applicants_message .="<br>";
    		$applicants_message .="<hr>";
    		$applicants_message .="<br>";
    		
    		$applicants_message .="<p style='font-weight: 400;'><strong>Having trouble logging in or need assistance?</strong></p>";
    		$applicants_message .="<ul>";
    		$applicants_message .="<li style='font-weight: 400;'>Use our help desk chat available on https://rise2021.vtour.tech  </li>";
    		$applicants_message .="<li style='font-weight: 400;'>Call us on: +91 9731661434 or +91 9739242112 </li>";
    		$applicants_message .="<li style='font-weight: 400;'>Email us at contact@thepridecircle.com</li>";
    		$applicants_message .="<li style='font-weight: 400;'>Read through the FAQs <a href='https://www.thepridecircle.com/rise2021/rise2021-faq/'>here</a></li>";
    		$applicants_message .="</ul>";
    		$applicants_message .="<br>";
    		$applicants_message .="<hr>";
    		$applicants_message .="<br>";
    		
    		$applicants_message .="<p style='font-weight: 400;'><strong>We strongly recommend the following for seamless audio & video experience:</strong></p>";
    		$applicants_message .="<ul>";
    		$applicants_message .="<li style='font-weight: 400;'>Use a Desktop/Laptop instead of your phone  </li>";
    		$applicants_message .="<li style='font-weight: 400;'>Works best with Google Chrome. Other web browsers may not be able to access the site. </li>";
    		$applicants_message .="<li style='font-weight: 400;'>Platform does not work with Internet Explorer</li>";
    		$applicants_message .="<li style='font-weight: 400;'>For hand-held devices, the platform is compatible only with Android, not iOS</li>";
    		$applicants_message .="<li style='font-weight: 400;'>You can log into only one device at a time. Sign out to exit the event platform on current device before switching onto a different device.</li>";
    		$applicants_message .="<li style='font-weight: 400;'>Use your personal network and device, instead of the corporate network/device</li>";
    		$applicants_message .="</ul>";
    		$applicants_message .="<br>";
    		$applicants_message .="<hr>";
    		$applicants_message .="<br>";
    		
    // 		$applicants_message .="<p style='font-weight: 400;'><strong>Whitelist:</strong></p>";
    // 		$applicants_message .="<p style='font-weight: 400;'>To access the event platform on your corporate network/device, reach out to your IT team to whitelist the sites given below:</p>";
    // 		$applicants_message .="<ul>";
    // 		$applicants_message .="<li style='font-weight: 400;'><a href='http://rise2021.vtour.tech'>http://rise2021.vtour.tech</a>  </li>";
    // 		$applicants_message .="<li style='font-weight: 400;'><a href='https://www.millicast.com'>https://www.millicast.com</a> </li>";
    // 		$applicants_message .="<li style='font-weight: 400;'><a href=' https://www.pubnub.com'> https://www.pubnub.com</a></li>";
    // 		$applicants_message .="<li style='font-weight: 400;'>All microservices on <a href='https://global.vtour.tv/home'>vtour.tv</a> and <a href='http://vtour.tech/'>vtour.tech</a></li>";
    // 		$applicants_message .="</ul>";
    // 		$applicants_message .="<br>";
    // 		$applicants_message .="Whitelisting is done to ensure you have browser level permission for AV (camera/mic)";
    // 		$applicants_message .="<br>";
    // 		$applicants_message .="If the website still cannot be accessed, it is best to switch to a personal network and/or device.";
    // 		$applicants_message .="<br>";
    // 		$applicants_message .="<br>";
    // 		$applicants_message .="<hr>";
    // 		$applicants_message .="<br>";
    		$applicants_message .="We look forward to welcoming you!";
    		$applicants_message .="<br>";
    		$applicants_message .="Thank you for your commitment to inclusion.";
    		$applicants_message .="<br><br>";
    		$applicants_message .="-Team Pride Circle\n";
    		$applicants_message .="<br>";
    		$applicants_message .="#RiseAndGrow";
    		
    		$email=$job_fair_attendee_page->email;
    		//$email="amrut.zerovaega@gmail.com";
    		
    		try {
    			send_smtp_mail($email,$applicants_message,$applicants_subject);
    			echo $email;
    			echo "mail send";
    			echo "<hr>";
    		} catch (Exception $e) {
                    print_r($e);
    		}
		}
?>