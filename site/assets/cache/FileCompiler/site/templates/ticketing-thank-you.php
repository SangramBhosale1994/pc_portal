	<?php

 require(\ProcessWire\wire('files')->compile('razorpay-php/Razorpay.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
		use Razorpay\Api\Api;
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
 include(\ProcessWire\wire('files')->compile('includes/send_mail_ticketing.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	
	//$session->count=0;
	$ticket_count_array = array();
	$billing_info = new stdClass;
	if($session->billing_info!=''){
		$billing_info = json_decode($session->billing_info);
	}
	
	

	$tickets_object = json_decode($session->tickets_json);
	//for loop for each 
// 	if($session->payment_id==''||$session->payment_id==null){
// 		header("Location: " . $page->parent->httpUrl ."checkout");
// 		die();
// 	}
if(0){}
	else{
    // 	$api_key = "rzp_test_iDBiHxziJkeWCV";//"rzp_live_mu64OP1Rnn48Iz";//
    // 	$api_secret='MEbODTX2gmae47DaFbZaucU6';//'LFw4weJmBHlo3Ra3fpj5ThOh'; //
    // 	$api = new Api($api_key, $api_secret);
    //     $payment_order=$api->payment->fetch($session->payment_id);

		if ($session->tickets_json != "{}"&&$session->billing_info!='') {
			$purchase_page = new \ProcessWire\Page();
			$purchase_page->template = 'ticketing-purchase';
			$purchase_array = [];
			foreach (json_decode($session->tickets_json) as $single_ticket) {
				//code to add attendee page and attendee register events
				//attendee page
				//$pages->get("name=events")->chlid("ticketing_event_id=".$single_ticket->event_id)->title;
				// $ticket_count_array[$pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id]++;
				if (!array_key_exists($pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id, $ticket_count_array)) {
					$ticket_count_array[$pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id] = 1;
				} else {
					$ticket_count_array[$pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id]++;
				}
				
				
	
				$attendee_page = $pages->get("name=attendee")->child("phone_number=" . $single_ticket->phone_number);
				if ($attendee_page->id == 0) {
					$attendee_page = new \ProcessWire\Page();
					$attendee_page->template = 'ticketing-attendee';
				    $attendee_page->parent = $pages->get("name=attendee");
				    $attendee_page->title = $single_ticket->first_name." ".$single_ticket->last_name;
    				$attendee_page->of(false);
				    $attendee_page->save();
	    		    $pass_applicants_counter_page = $pages->get("name=pass-applicants-counter-page");
	        	    $attendee_page->serial_id = $pass_applicants_counter_page->serial_id++;
    		        $pass_applicants_counter_page->of(false);
	            	$pass_applicants_counter_page->save();
	            	

				}
				$attendee_page->title = $single_ticket->first_name." ".$single_ticket->last_name;
				
				$attendee_page->first_name = $single_ticket->first_name;
				$attendee_page->last_name = $single_ticket->last_name;
				$attendee_page->pronoun = $single_ticket->pronoun;
				$attendee_page->email = $single_ticket->email;
				$attendee_page->phone_country_code = $single_ticket->phone_country_code;
				$attendee_page->company_name = $single_ticket->company_name;
				$attendee_page->phone_number = $single_ticket->phone_number;
				$attendee_page->of(false);
				$attendee_page->save();
	
	
				// create event page as child page 
				$event = new \ProcessWire\Page();
				$event->template = 'ticketing-attendee-single-event';
				$event->parent = $attendee_page; // new parent above
				$event->title = $single_ticket->event_id;
				$event->ticketing_event_page_id = $pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id;
				$event->save();
				array_push($purchase_array, $event->id);
			}
			$purchase_page=new \ProcessWire\Page();
			$purchase_page->parent = $pages->get("name=purchase");
			$purchase_page->template = 'ticketing-purchase';
			$purchase_page->title = time();
			$purchase_page->ticketing_ticket_page_id = implode(',', $purchase_array);
			//echo $session->billing_info;
			$billing_info=json_decode($session->billing_info);
			$purchase_page->first_name=$billing_info->name;
			$purchase_page->company_name=$billing_info->company_name;
			$purchase_page->email=$billing_info->email;
			$purchase_page->phone_country_code=$billing_info->phone_country_code;
			$purchase_page->phone_number=$billing_info->phone_number;
			$purchase_page->current_state=$billing_info->state;
			
			$purchase_page->address=$billing_info->address;
			$purchase_page->ticketing_billing_gst_number=$billing_info->gst_number;
			$purchase_page->ticket_purchase_order_id=$session->razorpay_order_id;
			//$purchase_page->ticketing_payment_id=$session->payment_id;
			
			$billing_counter_page=$pages->get("name=billing_counter_page");
			$current_counter=$billing_counter_page->serial_id;
			$billing_counter_page->serial_id++;
			$billing_counter_page->of(false);
			$billing_counter_page->save();
			
			$purchase_page->billing_number=$current_counter;
			$purchase_page->save();
			//$session->remove('billing_info');
			//$session->remove('tickets_json');
			//session_destroy();
		}
	
	?>


<?php

/* Send confirmation Email */
	// To send HTML mail, the Content-type header must be set

	//$url="http://zerovaega.in/pc_rportal/universe/";
   // $url =\ProcessWire\wire("pages")->get("name=universe")->httpUrl;

	$billing_name = $billing_info->name;//$single_ticket->attendee_name;
	$billing_company_name = $billing_info->company_name;
	$billing_address = "";
	$billing_email = $billing_info->email;
	$billing_phone = $billing_info->phone_country_code." ".$billing_info->phone_number;
	$billing_gst = "-";
	if($billing_info->gst_number != ""){
		$billing_gst = $billing_info->gst_number;
	}
	$billing_address = $billing_info->address;
	$billing_state = $billing_info->state;
	$invoice_number = $purchase_page->id;//time();
	$invoice_date = date("jS F Y", time()); //September 30th, 2013
	$event_name = "RISE 2021";

	$subject="RISE CONFERENCE 2021 | EVENT PASSES";
	
	$message ="Dear {$billing_name},";
	
	$message .="<br><br>";
	$message .="You have successfully purchased an event pass to ASIA'S BIGGEST LGBT+ CONFERENCE - RISE 2021 !";
	$message .="<br><br>";
	$message .="Explore our all new virtual platform on 4<sup>th</sup> and 5<sup>th</sup> May and be a part of this global  of LGBT+ inclusion.";
	$message .="<br><br>";
	$message .="Your purchase details:";
	$message .="<br><br>";

	$message .="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
	$message .="    <tr>";
	$message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
	$message .="            <b>TICKETS</b>";
	$message .="        </td>";
	$message .="    </tr>";
	$message .="</table>";




	foreach (json_decode($session->tickets_json) as $single_ticket) {

		$attendee_event_title = $pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->title;

		$attendee_name = $single_ticket->first_name." ".$single_ticket->last_name." (".$single_ticket->pronoun.")";
		$attendee_company_name = $single_ticket->company_name;
		$attendee_email = $single_ticket->email;	
		$attendee_ticket_number =$pages->get("name=attendee")->child("phone_number=".$single_ticket->phone_number.",phone_country_code=".$single_ticket->phone_country_code)->serial_id;

		$attendee_phone = $single_ticket->phone_country_code." ". $single_ticket->phone_number;

		

		$message .="<table style='border:1px solid #aaa;width:100%; padding:5px'>";
		$message .="    <tr style='padding:10px;' >";
		$message .="        <td style='text-align:left; padding:15px;'>";
		$message .="            <b>{$attendee_event_title}</b>";
		$message .="            <br>";
		$message .="            <b>Ticket Number</b>: {$attendee_ticket_number}";
		$message .="            <br>";
		$message .="            <b>Name</b>: {$attendee_name}";
		$message .="            <br>";
		$message .="            <b>Company</b>: {$attendee_company_name}";
		$message .="            <br>";
		$message .="            <b>Email</b>: {$attendee_email}";
		$message .="            <br>";
		$message .="            <b>Phone Number</b>: {$attendee_phone}";
		$message .="        </td>";
		$message .="    </tr>";
		$message .="</table>";
		$message .="<br>";

	}


	$invoice_message ="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
	$invoice_message .="    <tr>";
	$invoice_message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
	$invoice_message .="            <b>{$event_name}</b>";
	$invoice_message .="        </td>";
	$invoice_message .="    </tr>";
	$invoice_message .="</table>";

	$invoice_message .="<table style='border:1px solid #aaa;width:100%; padding:5px'>";
	$invoice_message .="    <tr style='padding:10px;' >";
	$invoice_message .="        <td style='text-align:left; padding:15px;'>";
	$invoice_message .="            <b>Inclusion First Consultancy Private Limited</b>";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>Address</b>: Pratapgad CHS LTD Shree complex PH-III, Adharwadi Jailkalyan, Mumbai, Thane, Maharashtra, India, Mumbai, Maharashtra, MH - 421301";
	$invoice_message .="            <br>";
	$invoice_message .="            contact@thepridecircle.com, +919739242110";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>GSTIN</b>: 27AAECI9693N1ZM";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>HSN</b>: 998424";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>CIN</b>: U93090MH2018PTC313196";
	$invoice_message .="        </td>";
	$invoice_message .="    </tr>";
	$invoice_message .="</table>";

	$invoice_message .="<br>";

	$invoice_message .="<table style='width:100%'; color:#000033'>"; 
	$invoice_message .="    <tr>";
	$invoice_message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.3rem'>";
	$invoice_message .="            <b>Tax Invoice</b>";
	$invoice_message .="        </td>";
	$invoice_message .="    </tr>";
	$invoice_message .="</table>";

	$invoice_message .="<br>";

	$invoice_message .="<table style='border:1px solid #aaa;width:100%'>";
	$invoice_message .="    <tr style='padding:10px;' >";
	$invoice_message .="        <td style='text-align:left; padding:15px'>";
	$invoice_message .="            <b>Bill in the name of</b>: {$billing_name}";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>Company</b>: {$billing_company_name}";
	$invoice_message .="            <br>";
	//$invoice_message .="            <b>Bill To Address</b>: {$billing_address}";
	//$invoice_message .="            <br>";
	$invoice_message .="            <b>Contact Number</b>: {$billing_phone}";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>Email</b>: {$billing_email}";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>Address</b>: {$billing_address}";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>State</b>: {$billing_state}";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>GSTIN</b>: {$billing_gst}";
	$invoice_message .="        </td>";
	$invoice_message .="        <td style='text-align:right; padding:15px'>";
	$invoice_message .="            <b>Invoice Number</b>: {$invoice_number}";
	$invoice_message .="            <br>";
	$invoice_message .="            <b>Invoice Date</b>: {$invoice_date}";
	$invoice_message .="        </td>";
	$invoice_message .="    </tr>";
	$invoice_message .="</table>";

	$invoice_message .="<br>";



	$invoice_message .= "<table style='border:1px solid #aaa;width:100%'>";
	$invoice_message .= "    <tr style='border:1px solid #aaa'>";
	$invoice_message .= "        <th style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; text-align:center'>#</th>";
	$invoice_message .= "        <th style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; text-align:center'>Item(s)</th>";
	$invoice_message .= "        <th style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; text-align:center'>QTY</th>";
	$invoice_message .= "        <th style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; text-align:center'>Value of Tickets Sold (INR)</th>";
	$invoice_message .= "    </tr>";



	$total = 0;
	/* Loop to go through each ticket added in the cart and show the details */
	foreach (json_decode($session->tickets_json) as $cart_ticket_key => $single_ticket) {
		$total += $single_ticket->price;
	}


	$loop_count = 0;
	$total_price_of_all_tickets = $total;
	foreach ($ticket_count_array as $single_ticket_id => $single_ticket_quantity) {
		$loop_count++;

		$single_ticket_page = $pages->get("id=".$single_ticket_id);
		$single_ticket_name = $single_ticket_page->title;

		/* Total price of a ticket type is calculated by the single price and quantity */
		$single_ticket_total_price = $single_ticket_page->ticketing_event_price * $single_ticket_quantity;
		/* Convert to two decimal points (example 1500.00) Keep in mind that this is a string. Not a float or int */
		$single_ticket_total_price = number_format((float)$single_ticket_total_price, 2, '.', '');
		//$total_price_of_all_tickets += $single_ticket_total_price;



		$invoice_message .= "    <tr>";
		$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; padding-right:4px;padding-left:4px'>{$loop_count}</td>";
		$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-right:4px;padding-left:4px; margin:0px'>".$single_ticket_name."</td>";
		$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-right:4px;padding-left:4px; margin:0px'>".$single_ticket_quantity."</td>";
		$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-right:4px;padding-left:4px; margin:0px'>".$single_ticket_total_price."</td>";
		$invoice_message .= "    </tr>";
	}

	$cart_total = $total_price_of_all_tickets;
	$is_discounted = false;
	if($count>=5){
		$is_discounted = true;
		$discount_price = (int)($total_price_of_all_tickets*0.10);
		$total_price_of_all_tickets = $total_price_of_all_tickets - $discount_price;
		$discount_price = number_format((float)$discount_price, 2, '.', '');
	}

	$tax_amount = $total_price_of_all_tickets*0.18;
	if($billing_state=="Out of India"){
		$tax_amount = $total_price_of_all_tickets*0;
	}
	$amount_including_tax = $total_price_of_all_tickets+$tax_amount;
	$processing_fee = $amount_including_tax*0.03;
	$total_invoice_amount = $amount_including_tax + $processing_fee;

	/* Convert the amounts to two decimal points (example 1500.00) Keep in mind that this is a string. Not a float or int */
	$total_price_of_all_tickets = number_format((float)$total_price_of_all_tickets, 2, '.', '');
	$tax_amount = number_format((float)$tax_amount, 2, '.', '');
	$amount_including_tax = number_format((float)$amount_including_tax, 2, '.', '');
	$processing_fee = number_format((float)$processing_fee, 2, '.', '');
	$total_invoice_amount = number_format((float)$total_invoice_amount, 2, '.', '');
	$cart_total = number_format((float)$cart_total, 2, '.', '');
	$total_price_of_all_tickets = number_format((float)$total_price_of_all_tickets, 2, '.', '');

	if($is_discounted == true){
		$invoice_message .= "    <tr>";
		$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Cart Total</td>";
		$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$cart_total."</td>";
		$invoice_message .= "    </tr>";
		$invoice_message .= "    <tr>";

		$invoice_message .= "    <tr>";
		$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Addition Discount</td>";
		$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$discount_price."</td>";
		$invoice_message .= "    </tr>";
		$invoice_message .= "    <tr>";
	}

	$invoice_message .= "    <tr>";
	$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Taxable Total</td>";
	$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$total_price_of_all_tickets."</td>";
	$invoice_message .= "    </tr>";
	$invoice_message .= "    <tr>";
	
	if($billing_state=="Out of India"){
	
	$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>IGST @ 0.00 %</td>";
	$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$tax_amount."</td>";
	$invoice_message .= "    </tr>";
	
	    
	}
	elseif($billing_state!="Maharashtra" && $billing_gst != "-"){
	
	$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>IGST @ 18.0 %</td>";
	$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$tax_amount."</td>";
	$invoice_message .= "    </tr>";
	
	    
	}
	else{
	
	$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>CGST @ 9.0 %</td>";
	$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".number_format((float)($tax_amount/2), 2, '.', '')."</td>";
	$invoice_message .= "    </tr>";	
	$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>SGST @ 9.0 %</td>";
	$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".number_format((float)($tax_amount/2), 2, '.', '')."</td>";
	$invoice_message .= "    </tr>";
	
	    
	}
	$invoice_message .= "    <tr>";
	$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Amount Including Tax</td>";
	$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$amount_including_tax."</td>";
	$invoice_message .= "    </tr>";
	$invoice_message .= "    <tr>";
	$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Convenience Fee</td>";
	$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$processing_fee."</td>";
	$invoice_message .= "    </tr>";
	$invoice_message .= "    <tr>";
	$invoice_message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Total Invoice Amount</td>";
	$invoice_message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$total_invoice_amount."</td>";
	$invoice_message .= "    </tr>     ";
	$invoice_message .= "</table>";


	$message .=  $invoice_message;

	$message .="<br>";
	$message .="<b>Please Note:</b> All fields must have details entered correctly, or the links to the event passes will not reach you and the passes once purchased are not refundable.";
	$message .="<br><br>";
	$message .="In case of any questions or entry correction requests, please drop us a mail before 20th April 2021, explaining the query along with your purchase transaction ID or ticket ID on <b>contact@thepridecircle.com</b>";
	$message .="<br>";

	$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	

	try {
		send_smtp_mail($billing_email,$message,$subject);
		//mail($company_page->admin_email, $subject, $message, $headers);
//echo $company_page->email;echo $email_subject;echo $email_message; echo $email_headers;
	} catch (Exception $e) {
print_r($e);
		//$to_return->error->error_message = $e;
	}

//echo $message;


?>




<?php
		/* VIP thank you message*/
		if(0){//$session->vip == true){
	?>

	<div class="container">
			
	
		<div class="row" style="margin-left: 2rem; margin-right: 2rem;">
			<div class=" col-md-12 text-center " style="border:3px solid #000033">
				<h1 class="text-center">	<?=$page->title_vip_thankyou?> </h1>
				
				<p class="" style="">
					<?=$page->ticketing_vip_thankyou?>
				</p>
			</div>
		</div>
		<div class="[ container ] [ mb-5 ]" style="/*height:300px;*/">
			<div class="d-flex justify-content-center" style="margin-top:3rem;">
				<a target="_blank" href="https://www.thepridecircle.com/rise2021/"  ><button class="btn btn-primary text-center">VISIT RISE-2021</button></a>
				
			</div>
			
		</div>
		
		<div class="row" style="margin-left: 2rem; margin-right: 2rem;">
			<div class=" col-md-12" style="border:3px solid #000033">
				<p class="text-center" style="">
					<?=$page->ticketing_terms_conditions?>
				</p>
			</div>
		</div>
		
	</div>

	<?php
	}
	/* VIP thank you message END */
	else{
	?>

	<!--<html>-->
	
	<!--<body>-->
	<!--	<div class="container">-->
	<!--		<h1 class="text-center">	<?=$page->title?> </h1>-->
		<div class="row" style="margin-left: 2rem; margin-right: 2rem;">
			<div class=" col-md-12 text-center " style="border:3px solid #000033; margin-top:2rem;">
				<h3 class="text-center"><?=$page->title?></h3> 
				<p class="" style="">
				 
					<?=$page->ticketing_thankyou_description?>
				</p>
			</div>
		</div>
		<div class="[ container ] [ mb-5 ]" style="/*height:300px*/;">
			<div class="d-flex justify-content-center" style="margin-top:3rem;">
				<a target="_blank" href="https://www.thepridecircle.com/rise2021/"  ><button class="btn btn-primary text-center">VISIT RISE-2021</button></a>
				
			</div>
			
		</div>
		
		<?php
			if($page->ticketing_terms_conditions !=""){
		?>

		<div class="row" style="margin-left: 2rem; margin-right: 2rem;">
			<div class=" col-md-12" style="border:3px solid #000033">
				<p class="text-center" style="">
					<?=$page->ticketing_terms_conditions?>
				</p>
			</div>
		</div>

		<?php	
			}
		?>
		
	</div>
	<?php	
		}
	?>


	<div id="invoice-container" class="[ py-5 ][ container ]">
		<div class="[ row ]">
			<div class="[ offset-md-2 col-md-8 ]">
				<?=$invoice_message?>
			</div>
		</div>
	</div>
    
<!-- 	<button id="invoice-download-button">Download Invoice</button>




<div class="pdfs">
	asdasdasd
</div> -->

    <div class="container align-self-center" style="margin-bottom:4rem;">
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary text-center" id="print_invoice" >Print Invoice</button>
        </div>
    </div>




	

	<?php
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	?>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

	<script type="text/javascript" src="<?=$config->urls->templates?>scripts/printThis.js"></script>

	<script type="text/javascript">
	/*
	--------------------------------------------------
	JQuery required
	By Amrut Todkar 2021-03-16 (copied from IWEI code, form page script: script.js)
	--------------------------------------------------
	*/

	$(document).ready(function(){
console.log(1);
	/* Convert form to PDF */
	// var doc = new jsPDF();
	// var specialElementHandlers = {
	//     '#editor': function (element, renderer) {
	//         return true;
	//     }
	// };
// invoice-container
        
		$('#invoice-download-button').click(function () {
			$(this).html('downloading...');
			$(this).prop('disabled', 'true');
console.log(2);
		 	CreatePDFfromHTML();
	//     doc.fromHTML($('#content').html(), 15, 15, {
	//         'width': 170,
	//             'elementHandlers': specialElementHandlers
	//     });
	//     doc.save('sample-file.pdf');
		});
/* Convert form to PDF END */

		/* funciton to convert to pdf */
		function CreatePDFfromHTML() {
			var HTML_Width = $(".pdfs").width();
			var HTML_Height = $(".pdfs").height();
			var top_left_margin = 15;
			var PDF_Width = HTML_Width + (top_left_margin * 2);
			var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
			var canvas_image_width = HTML_Width;
			var canvas_image_height = HTML_Height;
			var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;


			//var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);

			//let canvas_array = [];

			//let loop_counter = 0;
			//$(".section-pills").each(function(){
			//$("#home-tab").click();

			// $("#PoliciesandBenefits").tab('show');
			// $("#TheEmployeeLifecycle").tab('show');
			// $("#LGBTEmployeeResourceGroup").tab('show');
			// $("#AlliesAndRoleModels").tab('show');
			// $("#SeniorLeadership").tab('show');
			// $("#Monitoring").tab('show');
			// $("#Procurement").tab('show');
			// $("#CommunityEngagement").tab('show');


			// $("#AdditionalWork").tab('show');

			// $("#PoliciesandBenefits").tab('show');
			html2canvas($(".pdfs")[0]).then(function (canvas){
				// HTML_Width = $(".pdfs").width();
				// HTML_Height = $(".pdfs").height();
				// top_left_margin = 15;
				// PDF_Width = HTML_Width + (top_left_margin * 2);
				// PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
				// canvas_image_width = HTML_Width;
				// canvas_image_height = HTML_Height;
				// totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
				//var imgData = canvas.toDataURL("image/jpeg", 1.0);
				//canvas_array.push(imgData);
				//loop_counter++;
				var imgData = canvas.toDataURL("image/jpeg", 1.0);	
				var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);

				pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
				for (var i = 1; i <= totalPDFPages; i++) { 
console.log("asd");
					pdf.addPage(PDF_Width, PDF_Height);
					pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
				}
				//pdf.addPage(PDF_Width, PDF_Height);
				 //download_pdf(loop_counter);
				//$(".html-content").hide();
				// $("#home-tab").click();
				// $("#AdditionalWork").removeClass('active')
				// $("#PoliciesandBenefits").tab('show')
				$('#invoice-download-button').html('Download Survey');
				$('#invoice-download-button').prop('disabled', false); 

				pdf.save("RISE2021_INVOICE.pdf");
			});
		}
		/* funciton to convert to pdf END */
		$('#print_invoice').click(function () {
            $('#invoice-container').printThis({
                header: "<h1  style='text-align: center;'}>Invoice</h1>",
                importCSS: true
            });
        });
	});
	</script>

	</body>

	</html>

<?php

	/* Send ticket info to each attendee */
	foreach (json_decode($session->tickets_json) as $single_ticket) {
		// $attendee_page = $pages->get("name=attendee")->child("phone_number=" . $single_ticket->phone_number);
		// if ($attendee_page->id == 0) {
		// 	$attendee_page = new \ProcessWire\Page();
		// }
		// $attendee_page->template = 'ticketing-attendee';
		// $attendee_page->parent = $pages->get("name=attendee");
		// $attendee_page->title = $single_ticket->first_name." ".$single_ticket->last_name;
		
		// $attendee_page->first_name = $single_ticket->first_name;
		// $attendee_page->last_name = $single_ticket->last_name;
		// $attendee_page->pronoun = $single_ticket->pronoun;
		// $attendee_page->email = $single_ticket->email;
		//$attendee_page->phone_country_code = $single_ticket->phone_country_code;
		//$attendee_page->company_name = $single_ticket->company_name;
		// $attendee_page->phone_number = $single_ticket->phone_number;

		$attendee_event_title = $pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->title;



		$attendee_name = $single_ticket->first_name." ".$single_ticket->last_name." (".$single_ticket->pronoun.")";
		$attendee_company_name = $single_ticket->company_name;
		$attendee_email = $single_ticket->email;
		$attendee_phone = $single_ticket->phone_country_code." ". $single_ticket->phone_number;
        
		$attendee_ticket_number =$pages->get("name=attendee")->child("phone_number=".$single_ticket->phone_number.",phone_country_code=".$single_ticket->phone_country_code)->serial_id;

		$attendee_subject="RISE CONFERENCE 2021 | EVENT PASSES";

		$attendee_message ="Dear {$attendee_name},";
		
		$attendee_message .="<br><br>";
		$attendee_message .="Your event pass to ASIA'S BIGGEST LGBT+ CONFERENCE - RISE 2021 has been successfully booked by {$billing_email}";
		$attendee_message .="<br><br>";
		$attendee_message .="Explore our all new virtual platform on 4th and 5th May and be a part of this global thought-fest of LGBT+ inclusion.";
		$attendee_message .="<br>";
		$attendee_message .="Your event pass details:";
		$attendee_message .="<br><br>";

		$attendee_message .="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
		$attendee_message .="    <tr>";
		$attendee_message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
		$attendee_message .="            <b>{$event_name}</b>";
		$attendee_message .="        </td>";
		$attendee_message .="    </tr>";
		$attendee_message .="</table>";

		$attendee_message .="<table style='border:1px solid #aaa;width:100%; padding:5px'>";
		$attendee_message .="    <tr style='padding:10px;' >";
		$attendee_message .="        <td style='text-align:left; padding:15px;'>";
		$attendee_message .="            <b>{$attendee_event_title}</b>";
		$attendee_message .="            <br>";
		$attendee_message .="            <b>Ticket Number</b>: {$attendee_ticket_number}";
		$attendee_message .="            <br>";
		$attendee_message .="            <b>Name</b>: {$attendee_name}";
		$attendee_message .="            <br>";
		$attendee_message .="            <b>Company</b>: {$attendee_company_name}";
		$attendee_message .="            <br>";
		$attendee_message .="            <b>Email</b>: {$attendee_email}";
		$attendee_message .="            <br>";
		$attendee_message .="            <b>Phone Number</b>: {$attendee_phone}";
		$attendee_message .="        </td>";
		$attendee_message .="    </tr>";
		$attendee_message .="</table>";

		$attendee_message .="<br>";
		$attendee_message .="<b>Please Note:</b> All fields must have details entered correctly, or the links to the event passes will not reach you and the passes once purchased are not refundable.";
		$attendee_message .="<br><br>";
		$attendee_message .="In case of any questions or entry correction requests, please drop us a mail before 20th April 2021, explaining the query along with your purchase transaction ID or ticket ID on <b>contact@thepridecircle.com</b>";
		$attendee_message .="<br>";


		try {
			send_smtp_mail($attendee_email,$attendee_message,$attendee_subject);
			//mail($company_page->admin_email, $subject, $message, $headers);
            //echo $company_page->email;echo $email_subject;echo $email_message; echo $email_headers;
		} catch (Exception $e) {
                print_r($e);
			//$to_return->error->error_message = $e;
		}

	}
	/* Send ticket info to each attendee END */
			
	session_destroy();
}
?>