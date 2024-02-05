<?php
	/*
		File created 2021-03-07
		Primary code by Amrut Todkar

		This page will show a single ticket and the form to add it to the cart to the user.
		Page will contain:
		-The user will see the details of the ticket/event
		-The user will have a form below the details which they have to fill if they want to book the ticket, each ticket the user wants to bu will be filled in with the ticket-holder’s information in this form, the form will have the following fields:
			-First Name*
			-Last Name*
			-Pronouns* 
			-Phone number*
			-Confirm Phone Number*
			-Email ID*
			-Company Name
		-I agree to the T&C checkbox*
		-The user will see the important notices, terms and conditions on this page as well. (Phone number double checking included)
		-The user will not be able to register tickets with conflicting timings for the same phone number.
		-The user can go back and add other tickets after this.
	*/

 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	/*
	    Fuction  checkPassesConfliction added by Sameesh to check passes Confiction
	*/
	function checkPassesConfliction($first, $second)
    {
        if ($first == "d1s1") {
            if ($second == "d1s2" | $second == "d2s1" | $second == "d2s2" | $second == "d2f") {
                return true;
            }
            return false;
        }
        if ($first == "d1s2") {
            if ($second == "d1s1" | $second == "d2s1" | $second == "d2s2" | $second == "d2f") {
                return true;
            }
            return false;
        }
        if ($first == "d2s1") {
            if ($second == "d1s1" | $second == "d1s2" | $second == "d2s2" | $second == "d1f") {
                return true;
            }
            return false;
        }
        if ($first == "d2s2") {
            if ($second == "d1s1" | $second == "d1s2" | $second == "d1s2" | $second == "d1f") {
                return true;
            }
            return false;
        }
        if ($first == "d1f") {
            if ($second == "d2s1" | $second == "d2s2" | $second == "d2f" ) {
                return true;
            }
            return false;
        }
        
        if ($first == "d2f") {
            if ($second == "d1s1" | $second == "d1s2" | $second == "d1f" ) {
                return true;
            }
            return false;
        }
        if($first=="d1d2f")
            return false;
    }
   ?>
		<?php 
			if($page->httpUrl!=$pages->get("name=ticket-thank-you")->httpUrl){
		?>
		<div class=" container d-flex justify-content-between ">
			<a href="<?= $pages->get("name=tickets")->httpUrl ?>"><button type="button" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i>&nbsp;Buy more tickets</button></a>	
		   
			
		<a class="[ text-center ]" href="<?= $pages->get("name=cart")->httpUrl ?>"><button type="button" class="btn btn-primary"><i style="padding-right:1rem;" class="fa fa-shopping-cart" aria-hidden="true"></i><?=$count?> Tickets 
			<i class="fa fa-inr" aria-hidden="true" style="font-size:18px;"></i>
			<?php 
				if($count>=5){
					$session->discount=0.1;
					echo $total-(int)($total*$session->discount);
					$session->total=$total-(int)($total*$session->discount);
					$session->count=$count;
					
				}else{
					$session->discount=0;
					echo $total;
					$session->count=$count;
				}
			?>  </button><br>Checkout</a>	      
		</div>
		<?php }?>
   <?php
	 if (isset($_POST['submit'])){


	        // echo "Your Ticket is added to cart";
	}
	/* Set variables to be saved information into. These variables will decide what to show to the user on the front end code */
	$to_return = new stdClass;
	$to_return->success_array = Array();
	$to_return->error_array = Array();

	/* If already saved in the session, save that into the variable and empty the session variable. */
	if($session->to_return!=""){
		$to_return = json_decode($session->to_return);
		$session->to_return = "";
	}
	/* If already saved in the session END */

	/* If the ticket is just added to cart, this flag will be set to true until the message of (ticket added successfully!) is shown to the user. */
	if($session->ticket_buy_flag=='' && !isset($session->ticket_buy_flag)){
		$session->ticket_buy_flag = false;

	/* TODO
		remove this parameter from the session at the end of the purchase.
	 */
	}

	/* if the ticket booking form is submitted, save the information in the session */
	if (isset($_POST['add_ticket_submit'])) {
		/* Saving all the values sent in the form.*/
		/* TODO
				1. Everything should be sanitized using the processwire sanitizer function. (check how $input->post() works with sanitizer as well https://processwire.com/api/ref/wire-input/post/ and this for sanitizerrs- https://processwire.com/api/ref/sanitizer/) OUr processwire version number can be seen in the processwire admin panel.
				2. If a required value is empty, user shall be notified
				3. Backend validation of the input valus should happen here. No invalid values should escape. Testing should be strict.
			*/

		/* Create an object of the input ticket information. and save the info into that. */
		$attendee_ticket_info_object = new stdClass;

		$attendee_ticket_info_object->first_name = $input->post->text('first_name');

		$attendee_ticket_info_object->last_name = $input->post->text('last_name');
		if($input->post->text('pronoun')!="other"){
		    $attendee_ticket_info_object->pronoun = $input->post->text('pronoun');
		}else{
		    $attendee_ticket_info_object->pronoun = $input->post->text('pronoun_custom');
		}
		$attendee_ticket_info_object->phone_country_code = $input->post->text('phone_country_code');
		$attendee_ticket_info_object->phone_number = $input->post->text('phone_number');
		$attendee_ticket_info_object->email = $input->post->email('email');
		$attendee_ticket_info_object->company_name = $input->post->text('company_name');

		/* Changes made by Amrut Todkar 2021-03-13 empty tickets checking, adding other info to the session. */
		/* Loop through all the inputs, see if anything is empty. Save error if empty. */
		foreach ($attendee_ticket_info_object as $key=> $attendee_ticket_info) {
			if($attendee_ticket_info == "" && $key!= "company_name"){
				$to_return->error_array[] = "Error adding the ticket. Please fill-in all the fields correctly.";
				/* Once empty is found and added to the array, exit the loop. Once is enough. */
				continue;
			}
		}
		/* Loop through all the inputs, see if anything is empty. Save error if empty. END */

		/* Check if both the given phone numbers and country codes match */
		// if($attendee_ticket_info_object->phone_number != $input->post->text('confirm_phone_number') || $attendee_ticket_info_object->phone_country_code != $input->post->text('confirm_country_code')){
		// 	/* If they don't, add that to the error array */
		// 	$to_return->error_array[] = "Please confirm your phone number and country code again. The two numbers entered do not match.";
		// }
		/* Check if both the given phone numbers match END */

		/* Save the ticket's information into the session along with the attendee info to save which ticket was booked for the attendee  */
		$attendee_ticket_info_object->event_id = $page->ticketing_event_id;
		$attendee_ticket_info_object->event_page_id = $page->id;
		$attendee_ticket_info_object->price = $page->ticketing_event_price;
		/* Save the ticket's information into the session END  */

		/* Check if the same ticket is added to the cart with the same phone number */
		$already_added_to_cart_flag = true;
		$flag_confliction=false;
		foreach (json_decode($session->tickets_json) as $single_ticket) {
			if ($single_ticket->event_page_id == $attendee_ticket_info_object->event_page_id && $single_ticket->phone_number == $attendee_ticket_info_object->phone_number) {
				/* If it matches, set the flag to false */
				$already_added_to_cart_flag = false;

				/* Add error to the error array. */
				$to_return->error_array[] = "This attendee already has been added for this event in the cart. One phone number cannot have the same ticket twice. (".$page->title." for ".$attendee_ticket_info_object->phone_number." )";
				
				
				
			}
			
    		/*
                code adeed by Sameesh to checkPassesConfliction
    		*/
    		if($single_ticket->phone_number == $attendee_ticket_info_object->phone_number){
    		    if(!checkPassesConfliction($single_ticket->event_id,$attendee_ticket_info_object->event_id)&&!$flag_confliction){
    		        $to_return->error_array[] = "Can't Buy this Ticket.";
    		        $flag_confliction=true;
    		    }
    		}
    		/*
    		    Sameesh code ends here
    		*/
		}
		/* Check if the same ticket is added to the cart with the same phone number END */

		/* Check if the same ticket is added to the back-end with the same phone number */
		$already_added_to_backend_flag = true;
		
		/* Get child of candidates which has the same phone number with country code, check if that candidate's page has a child which has the same ID as this ticket page */
		$get_page_if_already_added = $pages->get("name=attendee")->child("phone_number=".$attendee_ticket_info_object->phone_number.",phone_country_code=".$attendee_ticket_info_object->phone_country_code)->children("ticketing_event_page_id=".$page->id)->first();
        /* If the page exists, id will not be zero. Set error to the array. */
		if($get_page_if_already_added->id != 0){
			$already_added_to_backend_flag = true;

			$to_return->error_array[] = "This attendee has been registered for this event previously. One phone number cannot have the same ticket twice. (".$page->title." for ".$attendee_ticket_info_object->phone_number." )";
		}
		/* Check if the same ticket is added to the back-end with the same phone number END */
            
        /*
            Check Confiction in backend sameesh
        */ 
        if (count($to_return->error_array) == 0) {
            foreach($pages->get("name=attendee")->child("phone_number=".$attendee_ticket_info_object->phone_number)->children() as $single_attendee_event){
                if(!checkPassesConfliction($page->ticketing_event_id,$single_attendee_event->title)){
                     $to_return->error_array[] = "Can't Buy this Ticket.";
                     break;
                }
            }
        }
        /*
            sameesh code ends here
        */
            
            
		/* If there are no errors, add the ticket to the cart. */
		if (count($to_return->error_array) == 0) {
			/* Create an object of the ticket information END */
			/* Saving all the values sent in the form. END */

			/* Adding ticket's name and other additional automatic information into the object */
			/* TODO
				1. Each ticket will have a unique name. That name should be saved to the session as well.
				2. Check if the same mobile number has already been added into the database with the same ticket. One mobile number can have multiple tickets, but each ticket should be different. One person cannot have multiple of the same tickets. If that happens, inform the user right there and don't save the ticket to the session. Cross check this in the sessoin as well. two tickets should not have the same name and the same mobile numeber.
				3. Also, the conflicting timing tickets should not be bought by the same phone number. For example, the ticket for Day2 session1 and Full Day2 ticket should not be booked for the same phone number.
			 */
			/* Adding ticket's name and other additional automatic information into the object END */

			/* Save the values sent in the form into the session as a ticket. ( add to CART) */

			/* Add the new ticket object to the session object */
			$timestamp = time();
			$temporary_tickets_object = new stdClass;
			$temporary_tickets_object = json_decode($session->tickets_json);
			/* TODO 
				Need to create an empty object before setting an object to $temporary_tickets_object->$timestamp
				Like this:
				$temporary_tickets_object->$timestamp = new stdClass;
			 */
			$temporary_tickets_object->$timestamp = $attendee_ticket_info_object;
			$session->tickets_json = json_encode($temporary_tickets_object);

			if($count == 4){
				$to_return->success_array[] = "10% Discount applied for adding 5 tickets.";
			}

			/*Add to success variable that the ticket was added successfully.  */
			$to_return->success_array[] = "One ticket was added to cart successfully!<br/>
To purchase more tickets, enter the correct details of the individual you wish to purchase the ticket for. The event pass link will be sent to this individual.<br>
Their First Name, Last Name and Pronoun will be visible on the virtual platform on the event days.";
			// $session->ticket_buy_flag = true;
			/* Add the new ticket object to the session object END */
		}	
		/* If there are no errors, add the ticket to the cart. END*/

		/* Save the values sent in the form into the session as a ticket. ( add to CART) END */

		/* Save the to return object into the session after encoding it */
		$session->to_return = json_encode($to_return);

		header("Location: ".$page->httpUrl);
	}
	/* if the ticket booking form is submitted, save the information in the session END */
?>


	
	<!-- Form to add the ticket to the cart. -->
	<!-- TODO 
	1. Add design
	2. Add moe fields from the flow documentand differnet types of fields like dropdown and radio, etc. as needed
	3. Form validation especially mobile number. It is required that the phone number is perfect.
	4. The mobile number is to be put twice to confirm
	5. Front and backend both validation should happen.
	6. submit button should have a unique name as given already (add_ticket_submit) 
	7. Form target should be this page.
	
	-->
	<!--<a href="<?= $page->parent->parent->httpUrl ?>">back</a>-->
	<!--<form method="POST">-->
	<!--    attendee_name<input type="text" name="attendee_name" required>-->
	<!--    attendee_country_code<input type="text" name="attendee_country_code">-->
	<!--    attendee_phone_number<input type="text" name="attendee_phone_number" required>-->
	<!--    <button type="submit" name="add_ticket_submit">Submit</button>-->
	<!--</form>-->
	<!--<a href="<?= $page->parent->parent->httpUrl ?>cart">go to cart</a>-->
	<!-- Form to add the ticket to the cart END -->
	
	<!--<a href="<?= $page->parent->url ?>"><button type="button" class="btn btn-primary">Add More</button></a> -->
	<!--<a href="<?= $pages->get("name=cart")->httpUrl ?>"><button type="button" class="btn btn-primary">Checkout</button></a>  -->

	<!-- Notification Container -->
	<div class="[ container ]">

	<?php
		/* Show the messages from the back-end code. Error and success messages both. */
		/* Check if any error messages are available in the error array */
		if(count($to_return->error_array) > 0){
			/* loop through the error array to show each error in a separate card */
			foreach($to_return->error_array as $error_text){
	?>
		<div class="alert alert-danger text-center" style="margin-top:2rem;"  role="alert">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<?=$error_text?>
		</div>
	<?php
			}
			/* loop through the error array to show each error in a separate card END */
		}
		/* Check if any error messages are available END */

		/* Check if any success messages are available in the success array */
		if(count($to_return->success_array) > 0){
			/* loop through the success message array to show each success message in a separate card */
			foreach($to_return->success_array as $success_text){
	?>
	<div class="alert alert-success text-center" style="margin-top:2rem;" role="alert">
		<i class="fa fa-check" aria-hidden="true"></i>   <?=$success_text?>
	</div>
	<?php
			}
			/* loop through the success message array to show each success message in a separate card END */
		}
		/* Check if any success messages are available in the success array */
		/* Show the messages from the back-end code. END */
	?>
 
	</div>
	<!-- Notification Container END-->




	<!--session passses-->
	<div class="[ container ][ mt-4 ] " >
		<div class="row" style="">
			<div class="offset-md-3 col-md-6 card-ticket-design" style="padding-left:1rem; padding-rigth:1rem;">
				<!--<div class="card " >-->
				<!--  <div class="card-body">-->
				<!--    <h5 class="card-title"><?=$single_event_fullday->title?></h5>-->
				<!--    <p class="card-text"><?=$single_event_fullday->ticketing_event_description?></p>-->
				<!--   <i class="fa fa-inr" aria-hidden="true" style="font-size:18px;"></i>-->
				<!--     <?=$single_event_fullday->ticketing_event_price?>-->
				<!--     <br/>-->
				<!--    <a href="<?= $page->get("name=events")->child("title=".$single_event_fullday->title)->httpUrl ?>" class="btn btn-primary">BUY NOW</a>-->
				<!--  </div>-->
				<!--</div>-->
					<div class="row" style="    padding-left: 1rem;
	padding-right: 1rem; ">
						<div class="col-md-1"></div>
						<div class="col-md-10 rounded event_passes_height_one " style="border:2px solid #000033;border:2px solid #2a2a81;background-color: #2a2a81; color:#ddd;">
								<h3 class="text-center" style="margin-top:2rem; font-family: 'Montserrat', sans-serif;"><?=$page->ticketing_title_toshow?></h3>
								<h4 class="text-center" style="font-size: 3rem;font-family: 'Montserrat', sans-serif;">INR <?=$page->ticketing_event_price?>*</h4>
							 
								<div style="text-align:center; font-family: 'Montserrat', sans-serif;"><span><del style="color:#ddd">INR <?=$page->ticketing_events_original_price?></del>*</span> <span class="badge badge-pill badge-danger" style="color: #fff;background-color: rgb(0 0 0 / 90%);">50% OFF</span></div>
								<div class="event_description_height" style=" margin-top:1.5rem;">
									<?=$page->ticketing_event_description?>
								</div>
						</div>
							<div class="col-md-1"></div>
					</div>
				
			</div>
		</div>
	</div>
	






	
	
 <div class="container [ mt-5 ]">

		<div class="row">
			<div class="[ col-12 ]">
			 	<div class="[ my-2 ][ text-center bg-primarya ]">
					<h3>Attendee Information</h3>
				</div>

				<div class="" style="margin-top:2rem;">
					<?php 
					echo $page->parent->ticketing_event_description;
					?>
				</div>
			</div>
			<div class="col-md-2">
				
			</div>
			 <div class="col-md-8">
					<form id="main-container" action="<?=$page->httpUrl?>" class="[ my-5 px-sm-5 ][ container rounded tab-content ][ needs-validation ]"  method="POST" enctype="multipart/form-data" novalidate>
		<!-- PERSONAL INFORMATION TAB -->
		
					<?php
						   /* echo $pages->get("name=cart")->httpUrl;*/
					?>
							<div id="personal-tab" class="[ tab-pane fade show active ]" role="tabpanel" aria-labelledby="personal-tab">
								

								<div class="[ ][ form-group ]">
								<div class="row">
									<div class="[ col-md-6 ]">
										<label for="first_name">First name</label>
										<input id="first_name" class="form-control phone_number_spacing" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="first_name" placeholder="First Name" required>
						
										<div class="invalid-tooltip">
											Please provide a valid First name.
										</div>
									</div>
									<div class="[ col-md-6 ]">
										<label for="last_name">Last name</label>
										<input id="last_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="last_name" placeholder="Last Name" required>
						
										<div class="invalid-tooltip">
											Please provide a valid Last name.
										</div>
									</div>
									
									
								</div>
								</div>
								
								<div class="[ ][ form-group ]">
								 <div class="row">
									<div class="[ col-md-6 ][ ]">
										<label for="pronoun">Pronoun</label>
										<select id="pronoun" class="custom-select phone_number_spacing" name="pronoun"  required>
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

									<div id="pronoun_custom_container" class="[ col-md-6 ][ hidden ]" style='display:none;' >
										<label for="pronoun_custom"> Enter Your Pronoun</label>
						
										<input id="pronoun_custom" class="form-control" pattern="^[A-Za-z'\s\.\-\\\/]{1,}$" type="text" name="pronoun_custom" placeholder="Your Pronoun" >
						
										<div class="invalid-tooltip">
											Please state a valid pronoun.
										</div>
									</div>

							   <div class="col-md-6 phone_number_alignment">
									<label for="phone_number">Phone number</label>
						
									<div class="row no-gutters">
										
										<select id="phone_country_code" class="[ col-12 col-sm-4 pl-2 ][ custom-select  phone_number_spacing ]" name="phone_country_code">
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
			
								<input id="phone_number" class="[ offset-sm-1 col-12 col-sm-7 pl-2 ][ form-control phone_number_spacing ]" pattern="[0-9]{10}" type="text" name="phone_number" placeholder="Example: 9876543210" maxlength="10" required>
			
								<div class="invalid-tooltip">
									Please provide a valid phone number.
								</div>
							</div>
										
								</div>
										   
							 </div>
					   </div>
		
			
			
			
				<div class="[  ][ form-group ]">
					<label for="email">Email</label>
					<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="abc@xyz.com" value="<?=$session->oauth_gmail;?>" required>

					<div class="invalid-tooltip">
						Please provide a valid email address.
					</div>
				</div>

				<div class="[  ][ form-group ]">
					<label for="email">Confirm your email</label>
					<input id="email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="email" placeholder="Re-enter your email" value="<?=$session->oauth_gmail;?>" required>

					<div class="invalid-tooltip">
						Please provide a valid email address.
					</div>
				</div>
		
			
				<div class="[ form-group ]">
				<label for="company_name">Company name</label>
				<input id="company_name" class="form-control" type="text" name="company_name" placeholder="Company name" >

				<div class="invalid-tooltip">
					Please provide a valid Comapny name.
				</div>
			</div>

			<div>
				<!-- <p>TERMS & CONDITIONS</p> -->
				<!-- <ul>
					<li>You certify that you are over 18 years of age.</li>

					<li>You certify that the information you provide by you such as login details (Name, contact number and email ID) are correct.</li>

					<li>Pride Circle is not responsible if they are unable to contact you due to incorrect login details entered by you at the time of purchase.</li>

					<li>The event pass(es) once purchased are non-refundable, non-transferrable and cannot be exchanged or redeemed against cash, credits, or any other benefits.</li>

					<li>If during RISE Job Fair 2021, you are found to have behaved in an illegal, unethical and/or immoral manner to any representative of Pride Circle, recruiters or any other event attendee,
					all access to RISE 2021 and Pride Circle’s websites and services shall be terminated, and strict action shall be taken against any such misconduct.</li>

					<li>In all situations, Pride Circle's decision(s) shall be final and binding.</li>

					<li>To read more about RISE ticketing terms & conditions, including terms of use and refund policy, please <a target="_blank" href="<?php echo $pages->get("name=terms-and-conditions")->httpUrl?>">click here</a>.</li>

				</ul> -->

				<?=$page->ticketing_terms_conditions?>

			</div>
            <div>
			<?=$pages->get("name=events")->ticketing_terms_conditions?>
			</div>

			<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
			  <label class="form-check-label" for="flexCheckDefault" style="color:red;">
			   I ACCEPT THE TERMS AND CONDITIONS 
			  </label>
			  <!--<input type="checkbox" name="checkbox" value="check"  />-->
			  <!--  <input type="submit" name="email_submit" value="submit" onclick="if(!this.form.checkbox.checked){alert('You must agree to the terms first.');return false}"  />-->
			  
	    <!--       <div class="form-check">-->
	    <!--          <input class="form-check-input"   type="checkbox" -+value="" id="invalidCheck2" required />-->
     <!--       	  <label class="form-check-label" for="invalidCheck2">-->
     <!--       	    Agree to -->
     <!--       	  </label>-->
     <!--       	</div>-->
			  
			</div>
		</div>
			<!-- Buttons Section -->
			<div class="[ d-flex flex-row justify-content-center mb-4 ]" style="margin-top:2rem;">
				<button value="submit" class="btn btn-primary" type="submit" name="add_ticket_submit" >
					ADD TO CART
				</button>
			</div>
			<!-- Buttons Section End -->
		</div>
		
		<!--</div>-->
		<!-- ADDITIONAL INFORMATION TAB -->
	</form>
			 </div>
			  <div class="col-md-2">
				  
		 </div>
		</div>
		
		
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on("keyup","#confirm_phone_number",  function(){
				if($(this).val() == $("#phone_number").val()){
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

	//  $(document).ready(function(){
	//      $(document).on("keyup","#email",  function(){
	//          return (/^([\w-.]+@(?!gmail\.com)(?!yahoo\.com)(?!outlook\.com)([\w-]+.)+[\w-]{2,4})?$/);
	//           message: 'Please enter your work email address';
	//  })
	// });

	
				
	</script>   
	
	
<?php
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
 
?>
	
</body>

</html>