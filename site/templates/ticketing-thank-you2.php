<?php
require_once 'includes/ticketing-header.php';
//include 'includes/send_mail.php';
//for loop for each 

if ($session->tickets_json != "{}") {
	$purchase_page = new Page();
	$purchase_page->template = 'ticketing-purchase';
	$purchase_array = [];


	$ticket_count_array = array();
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
		
		
		//code to add attendee page and attendee register events
		//attendee page
		$attendee_page = $pages->get("name=attendee")->child("ticketing_attendee_phone_number=" . $single_ticket->attendee_phone_number);
		if ($attendee_page->id == 0) {
			$attendee_page = new Page();
		}
		$attendee_page->template = 'ticketing-attendee';
		$attendee_page->parent = $pages->get("name=attendee");
		$attendee_page->title = $single_ticket->attendee_name;
		$attendee_page->ticketing_attendee_phone_number = $single_ticket->attendee_phone_number;
		$attendee_page->of(false);
		//$attendee_page->save();


		// create event page as child page 
		$flag = true;
		if ($pages->get("name=attendee")->child("ticketing_attendee_phone_number=" . $single_ticket->attendee_phone_number)->Children()->count() > 0) {
			foreach ($attendee_page->children() as $attendee_page_child) {
				if ($attendee_page->child("ticketing_event_id=" . $single_ticket->event_id)->id) {
					$flag = false;
					echo "Can't buy this " . $single_ticket->event_id . " ticket twise<br>";
				}
			}
		}
		// if ($flag) {
		$event = new Page();
		$event->template = 'ticketing-attendee-single-event';
		$event->parent = $attendee_page; // new parent above
		$event->title = $single_ticket->event_id;
		$event->ticketing_event_page_id = $pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id;
		//$event->save();
		array_push($purchase_array, $event->id);
		// }
	}
	$purchase_page->ticketing_ticket_page_id = implode(',', $purchase_array);
	$purchase_page->parent = $pages->get("name=purchase");
	$purchase_page->title = time();
	//$purchase_page->save();
}






/* Send confirmation Email */
		// To send HTML mail, the Content-type header must be set
//      $subject = "Activate your account: Pride Circle Corporate Dashboard";

		//$url="http://zerovaega.in/pc_rportal/universe/";
	   // $url =wire("pages")->get("name=universe")->httpUrl;

		$billing_name = "Amrut Todkar";//$single_ticket->attendee_name;
		$billing_address = "Pl.12 Suryavanshi Colony, Saneguruji Vasahat, Kolhapur. 416011";
		$billing_gst = "Not Povided";
		$invoice_number = "160145894";
		$invoice_date = "14th April 2021";//date("jS F Y", time()); //September 30th, 2013
		$event_name = "RISE 2021";

		$subject="RISE 2021- Ticket Booking Confirmation.";
		
		$message ="Congratulations! Your ticket/s have been booked!<br><br>";

		$message .="<table style='border:1px solid #aaa;width:100%;background-color:#000033; color:#fff'>"; 
		$message .="    <tr>";
		$message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.5rem'>";
		$message .="            <b>{$event_name}</b>";
		$message .="        </td>";
		$message .="    </tr>";
		$message .="</table>";

		$message .="<table style='border:1px solid #aaa;width:100%; padding:5px'>";
		$message .="    <tr style='padding:10px;' >";
		$message .="        <td style='text-align:left; padding-right:30px'>";
		$message .="            <b>Inclusion First Consultancy Private Limited</b>";
		$message .="            <br>";
		$message .="            Address: PRATAPGAD CHS LTD SHREE COMPLEX PH-III, ADHARWADI JAILKALYAN, MUMBAI, Thane, Maharashtra, India, Mumbai, Maharashtra, MH - 421301";
		$message .="            <br>";
		$message .="            constact@thepridecircle.com, +919739242109";
		$message .="            <br>";
		$message .="            GSTIN: 27AAECI9693N1ZM";
		$message .="            <br>";
		$message .="            CIN: U93090MH2018PTC313196";
		$message .="        </td>";
		$message .="    </tr>";
		$message .="</table>";

		$message .="<br>";

		$message .="<table style='width:100%'; color:#000033'>"; 
		$message .="    <tr>";
		$message .="        <td colspan='2' style='text-align: center; padding:5px; font-size:1.3rem'>";
		$message .="            <b>Tax Invoice</b>";
		$message .="        </td>";
		$message .="    </tr>";
		$message .="</table>";

		$message .="<br>";

		$message .="<table style='border:1px solid #aaa;width:100%'>";
		$message .="    <tr style='padding:10px;' >";
		$message .="        <td style='text-align:left; padding-right:30px'>";
		$message .="            <b>Name</b>: {$billing_name}";
		$message .="            <br>";
		$message .="            <b>Bill To Address</b>: {$billing_address}";
		$message .="            <br>";
		$message .="            <b>GSTIN</b>: {$billing_gst}";
		$message .="        </td>";
		$message .="        <td style='text-align:right'>";
		$message .="            <b>Invoice Number</b>: {$invoice_number}";
		$message .="            <br>";
		$message .="            <b>Invoice Date</b>: {$invoice_date}";
		$message .="        </td>";
		$message .="    </tr>";
		$message .="</table>";

		$message .="<br>";



		$message .= "<table style='border:1px solid #aaa;width:100%'>";
		$message .= "    <tr style='border:1px solid #aaa'>";
		$message .= "        <th style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; text-align:center'>#</th>";
		$message .= "        <th style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; text-align:center'>Item(s)</th>";
		$message .= "        <th style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; text-align:center'>QTY</th>";
		$message .= "        <th style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; text-align:center'>Value of Tickets Sold (INR)</th>";
		$message .= "    </tr>";

		$loop_count = 0;
		$total_price_of_all_tickets = 0;
		foreach ($ticket_count_array as $single_ticket_id => $single_ticket_quantity) {
			$loop_count++;

			$single_ticket_page = $pages->get("id=".$single_ticket_id);
			$single_ticket_name = $single_ticket_page->title;

			/* Total price of a ticket type is calculated by the single price and quantity */
			$single_ticket_total_price = $single_ticket_page->ticketing_event_price * $single_ticket_quantity;
			/* Convert to two decimal points (example 1500.00) Keep in mind that this is a string. Not a float or int */
			$single_ticket_total_price = number_format((float)$single_ticket_total_price, 2, '.', '');
			$total_price_of_all_tickets += $single_ticket_total_price;



			$message .= "    <tr>";
			$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa; padding-right:4px;padding-left:4px'>{$loop_count}</td>";
			$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-right:4px;padding-left:4px; margin:0px'>".$single_ticket_name."</td>";
			$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-right:4px;padding-left:4px; margin:0px'>".$single_ticket_quantity."</td>";
			$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-right:4px;padding-left:4px; margin:0px'>".$single_ticket_total_price."</td>";
			$message .= "    </tr>";
		}

		$tax_amount = $total_price_of_all_tickets*0.18;
		$amount_including_tax = $total_price_of_all_tickets+$tax_amount;
		$processing_fee = $total_price_of_all_tickets*0.02;
		$total_invoice_amount = $amount_including_tax + $processing_fee;

		/* Convert the amounts to two decimal points (example 1500.00) Keep in mind that this is a string. Not a float or int */
		$total_price_of_all_tickets = number_format((float)$total_price_of_all_tickets, 2, '.', '');
		$tax_amount = number_format((float)$tax_amount, 2, '.', '');
		$amount_including_tax = number_format((float)$amount_including_tax, 2, '.', '');
		$processing_fee = number_format((float)$processing_fee, 2, '.', '');
		$total_invoice_amount = number_format((float)$total_invoice_amount, 2, '.', '');

		$message .= "    <tr>";
		$message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Taxable Total</td>";
		$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$total_price_of_all_tickets."</td>";
		$message .= "    </tr>";
		$message .= "    <tr>";
		$message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>IGST @ 18.0 %</td>";
		$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$tax_amount."</td>";
		$message .= "    </tr>";
		$message .= "    <tr>";
		$message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Amount Including Tax</td>";
		$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$amount_including_tax."</td>";
		$message .= "    </tr>";
		$message .= "    <tr>";
		$message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Processing Fee</td>";
		$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$processing_fee."</td>";
		$message .= "    </tr>";
		$message .= "    <tr>";
		$message .= "        <td colspan='3' style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;text-align: right; padding-right:15px'>Total Invoice Amount</td>";
		$message .= "        <td style='border-right:1px solid #aaa;border-bottom:1px solid #aaa;padding-left:4px'>".$total_invoice_amount."</td>";
		$message .= "    </tr>     ";
		$message .= "</table>";


		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		

		try {
			//send_smtp_mail("todkar.amrut27897@gmail.com",$message,$subject);
			//mail($company_page->admin_email, $subject, $message, $headers);
			//echo $company_page->email;echo $email_subject;echo $email_message; echo $email_headers;
		} catch (Exception $e) {
print_r($e);
			//$to_return->error->error_message = $e;
		}

// echo $message;

// die();


		foreach (json_decode($session->tickets_json) as $single_ticket) {

			


			//code to add attendee page and attendee register events
			//attendee page
			$attendee_page = $pages->get("name=attendee")->child("ticketing_attendee_phone_number=" . $single_ticket->attendee_phone_number);
			if ($attendee_page->id == 0) {
				$attendee_page = new Page();
			}
			$attendee_page->template = 'ticketing-attendee';
			$attendee_page->parent = $pages->get("name=attendee");
			$attendee_page->title = $single_ticket->attendee_name;
			$attendee_page->ticketing_attendee_phone_number = $single_ticket->attendee_phone_number;
			$attendee_page->of(false);
			//$attendee_page->save();



			// create event page as child page 
			$flag = true;
			if ($pages->get("name=attendee")->child("ticketing_attendee_phone_number=" . $single_ticket->attendee_phone_number)->Children() > 0) {
				foreach ($attendee_page->children() as $attendee_page_child) {
					if ($attendee_page->child("ticketing_event_id=" . $single_ticket->event_id)->id) {
						$flag = false;
						echo "Can't buy this " . $single_ticket->event_id . " ticket twise<br>";
					}
				}
			}
			// if ($flag) {
			$event = new Page();
			$event->template = 'ticketing-attendee-single-event';
			$event->parent = $attendee_page; // new parent above
			$event->title = $single_ticket->event_id;
			$event->ticketing_event_page_id = $pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id;
			//$event->save();
			array_push($purchase_array, $event->id);
			// }
		}
	  



		//$message = "Greetings from Pride Circle!\n\nThank you for signing up for the Corporate Dashboard.\n\nActivate your account by clicking the link here.".$otp;
//      $link = "Greetings from Pride Circle!\n\nThe OTP for your login is ".<a href="'.$a.'">".$otp."</a>";

		//  $link="http://zerovaega.in/pc_rportal/universal-login/";
		// $subject = "Your Account is Verified! Access Pride Circle Corporate Dashboard";
		// $meassage="Congratulations! Your account has been verified!<br>We are glad to have you on-board!<br><br>You can now log into your account using your registered email ID and password and explore the features of the the Pride Circle Corporate Dashboard.<br><br> <a href='".$link."'><button id='btn_login' style='color: #fff;
		//  background-color: #007bff;border-color: #007bff;padding:5px;border-radius:5px;cursor: pointer!important;'>Login</button></a><br><br>From,<br>Team Pride Circle";
		 
		
	
		$headers = "From: Pride Circle <noreply@thepridecircle.com>". PHP_EOL;
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		

		try {
			//send_smtp_mail($company_page->admin_email,$message,$subject);
			//mail($company_page->admin_email, $subject, $message, $headers);
			//echo $company_page->email;echo $email_subject;echo $email_message; echo $email_headers;
		} catch (Exception $e) {
			$to_return->error->error_message = $e;
		}
		/* Send confirmation Email END */












$session->remove('tickets_json');
//print_r($session->tickets_json);












?>




	<div id="invoice-container" class="[ py-5 ][ container ]">
		<div class="[ row ]">
			<div class="[ offset-md-2 col-md-8 ]">
				<?=$message?>
			</div>
		</div>
	</div>

	<button id="invoice-download-button">Download Invoice</button>




<div class="pdfs">
	asdasdasd
</div>








	<h1>Thanks </h1>
</body>


	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

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
	});
	</script>

</html>