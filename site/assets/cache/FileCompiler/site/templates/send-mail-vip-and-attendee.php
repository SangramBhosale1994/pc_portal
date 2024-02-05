<?php
 include(\ProcessWire\wire('files')->compile('includes/send_mail_ticketing.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

		/*** Amruta Jagatap Job code Serial ID created from the ID counter page */
		/**** Get serial ID from the serial ID page */
		//foreach($pages->get("name=attendee")->children() as $vip_attendee_page)
		
// 		$vip_attendee_array=array();
// 		$attendee_array=array();
		
// 		foreach($pages->get("name=vip-attendee")->children("verification=verified,sort=sort") as $vip_attendee_page)
// 		{
// 		    $vip_attendee_array[]=$vip_attendee_page->email;
// 		}
// 		print_r($vip_attendee_array);
// 		echo "<hr>";
// 		foreach($pages->get("name=attendee")->children("sort=sort") as $attendee_page)
// 		{
// 		    $attendee_array[]=$attendee_page->name;
// 		}
// 		print_r($attendee_array);
// 		echo "<hr>";
// 		$all_attendee_array=array_merge($vip_attendee_array,$attendee_array);
// 		print_r($all_attendee_array);
// 		echo "<hr>";
// 		if(in_array($attendee_array,$all_attendee_array)){
// 		    echo $attendee_page->name;
// 		}

        
// 		    $all_email_array=array(
//                 "charlene.lty@gmail.com",
//                 "chloebdavies@gmail.com",
//                 "rastillas@gmail.com",
//                 "shweta.shukla@mastercard.com",
//                 "margot.slattery@gmail.com",
//                 "euritus@outandequal.org",
//                 "ivanna.marin.mora@intel.com",
//                 "rudranichhetri@gmail.com",
//                 "kchatterjee@spglobal.com",
//                 "shainashingarii@gmail.com",
//                 "pgrewal@twitter.com",
//                 "arun.sharma2@fiserv.com",
//                 "deepa.narasimhan@miqdigital.com",
//                 "apuchta@ellaglobalcommunity.org",
//                 "psandri@air-worldwide.com",
//                 "bhavna.kumar@db.com",
//                 "kelly.waller@finastra.com",
//                 "sumanta_das@intuit.com",
//                 "surovi.dhupar@teamhgs.com",
//                 "ddevassy@vmware.com",
//                 "jyothi.menon@ubs.com",
//                 "surekha.kunder@in.tiaa.org",
//                 "ken.c.janssens@jpmorgan.com",
//                 "smita.menon@ny.email.gs.com",
//                 "vihaan.peethambar@ny.email.gs.com",
//                 "sudhahooda@gmail.com",
//                 "takehiro.noma@cebupacificair.com",
//                 "khandhar.kushal@bcg.com",
//                 "zafrulla.khan@lseg.com",
//                 "argho.sen@natwest.com",
//                 "ashish.jha@invesco.com",
//                 "lbadgett@econs.umass.edu"

//             );
		    
		    
// 		$mail_array=array();
// 		$failed_array=array();
// 		foreach($pages->get("name=vip-attendee")->children("verification=verified,sort=sort,limit=1") as $vip_attendee_page)
// 		{
		    
		    
// 		    	if(in_array(strtolower($vip_attendee_page->email),$all_email_array)){
//         		    echo $vip_attendee_page->email;
//         		    echo "<br>";
//         		    continue;
//         		}





            echo "777";
        	echo "**********************";
        	foreach($pages->get("name=vip-attendee")->children("") as $attendee_page){
        //	foreach($pages->get("name=attendee")->children("") as $attendee_page){
        	    //$ticket_page=$attendee_page->child("title=d1d2f");
        	    $ticket_page=$attendee_page->child("title=vipd1d2f");
        	    if($ticket_page->id==""){
        	      
        	       continue;
        	    }
        	    else{
        	          echo "<hr>";
        	        echo $attendee_page->id;
        	       
        	        $event_name = "Thank You for being a part of RISE Conference 2021";
            		//$pass_number=$vip_attendee_page->serial_id;
            		$applicants_name=$attendee_page->title;
            		$applicants_email=$attendee_page->email;
            		$applicants_contact=$attendee_page->phone_country_code."".$attendee_page->phone_number;
            		
            	
            		$visit_link="https://www.thepridecircle.com/universe/";
            		$site_link="https://www.thepridecircle.com/";
            		
            		$applicants_subject="Thank You for Participating in RISE Conference 2021";
            
            		$applicants_message ="Dear {$applicants_name},";
            		
             		$applicants_message .="<br><br>";
            // 		$applicants_message .="<b style='text-align: center; padding:5px; font-size:1.5rem'>{$event_name}</b>";
            // 		$applicants_message .="<br><br>";
            		$applicants_message .="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
            		$applicants_message .="    <tr>";
            		$applicants_message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
            		$applicants_message .="            <b>{$event_name}</b>";
            		$applicants_message .="        </td>";
            		$applicants_message .="    </tr>";
            		$applicants_message .="</table>";
            		
            		$applicants_message .="<p style='font-weight: 400;'>We at Pride Circle wholeheartedly thank you for your participation in this inclusion revolution!</p>";
            		
            // 		$applicants_message .="<br>";
            		
            		$applicants_message .="<p style='font-weight: 400;'>RISE Conference 2021 has been two whole days of inspiring speakers engaging in enlightening conversations. It has been quite a ride to run this conference in a lockdown, with the team working from home.</p>";
            		
            // 		$applicants_message .="<br>";
            		
            		$applicants_message .="<p style='font-weight: 400;'>You are an integral part of the success of RISE and we hope to continue to collaborate in our journey towards fostering LGBT+ inclusion at the workplace and society.</p>";
            		
            // 		$applicants_message .="<br>";
            		
            		$applicants_message .="<p style='font-weight: 400;'>While we look forward to the fourth edition of RISE in 2022, we at Pride Circle are working towards bringing you a wide range of exciting activities and campaigns throughout the year. To find out more about what we have in store for 2021 visit: {$visit_link}</p>";
            		
            // 		$applicants_message .="<br>";
            		
            		$applicants_message .="<p style='font-weight: 400;'>We will get back to you with the video recording of the sessions, and the blog in a couple of weeks.</p>";
            		
            // 		$applicants_message .="<br>";
            		
            		$applicants_message .="<p style='font-weight: 400;'>In these tough times, we hope for your safety and wellbeing.</p>";
            		
            // 		$applicants_message .="<br>";
            		
            		$applicants_message .="<p style='font-weight: 400;'>For more information about Pride Circle visit our website or keep a close eye on our social media pages for our next campaigns:</p>";
            	
            		$applicants_message .="<p style='font-weight: 400;'><strong>Website:</strong> {$site_link}</p>";
            		$applicants_message .="<p style='font-weight: 400;'><strong>Instagram:</strong> @pride_circle  |  @rise4all  </p>";
            		$applicants_message .="<p style='font-weight: 400;'><strong>Facebook:</strong> @PrideCircles  |  @LetUsAllRise </p>";
            		$applicants_message .="<p style='font-weight: 400;'><strong>LinkedIn:</strong> Pride Circle </p>";
            		$applicants_message .="<p style='font-weight: 400;'><strong>Twitter:</strong> @pride_circle  </p>";
            		$applicants_message .="<p style='font-weight: 400;'><strong>YouTube:</strong> Pride Circle  </p>";
            		
            		$applicants_message .="<br><br>";
            		$applicants_message .="<p>Regards,</p>";
            // 		$applicants_message .="<br>";
            		$applicants_message .="<p>Team Pride Circle</p>";
            // 		$applicants_message .="<br>";
            		$applicants_message .="<p>#RiseAndGrow</p>";
            		
            		//$email=$vip_attendee_page->email;
            		$email="amrutaj.zerovaega@gmail.com";
            		
            		
            		try {
            			//send_smtp_mail($email,$applicants_message,$applicants_subject);
            			$mail_array[]=$email;
            			echo $email;
            			echo " mail send";
            			echo "<hr>";
            		} catch (Exception $e) {
                            print_r($e);
                        $failed_array[]=$email;
            		}
        		//}
        		
        		$result_json=json_encode($mail_array).json_encode($failed_array);
        		$result="Vip attendee result";
        // 		$result_email="amrut.zerovaega@gmail.com";
        // 		send_smtp_mail($result_email,$result_json,$result);
        	        
        	        
        	    }
        	    
            
        	    
        	}
    		
    		
		
		
		
	
	
	
?>