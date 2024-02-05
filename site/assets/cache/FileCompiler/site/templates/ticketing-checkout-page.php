<?php
/*
	File created 2021-03-07
	Primary code by Amrut Todkar

	This page will show all the tickets added to the cart and the total to the user.
	Page will contain:
	-After adding all the tickets, the user will go to the cart page. The cart page will show a list of all the tickets that the user has added with the information filled for each ticket.
	-The user can remove a ticket from their cart at this point.
	-There will be a button to go back to the Tickets page if they want to go back and add more tickets.
	-Once satisfied with the ticket information, the user can click on “Checkout” page
*/
 require(\ProcessWire\wire('files')->compile('razorpay-php/Razorpay.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
		use Razorpay\Api\Api;
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));



/*RAZORPAY interation  */
// $api_key = "rzp_test_iDBiHxziJkeWCV";//"rzp_live_mu64OP1Rnn48Iz";//
$api_key = "rzp_test_Wo6ju4HcBrxYTy";
if($session->billing_info!=''){
	$billing_info = json_decode($session->billing_info);
	?>
	<div class="container" style="margin-bottom:2rem;">
			<div class="[ container ]" style="margin-top:1rem;">
		<?php 
		    //if more than 5 tickets buying then 10% more discount on ticket actual price
			if($session->count>=5){
		?>
				<div class="[ row ]">
			<div class="[ col-md-2 ] ">			
			</div>

			<div class="[ col-md-8 ] " style="border:2px solid #2a2a81;">
				<div class="[ justify-content-between ][ p-3 ]" style=" margin-top:2rem;">
					<div style="">
						<h2 class="text-center">Items &nbsp; - &nbsp; <?=$session->count;?></h2>
						<h2 class="text-center">Total &nbsp; - &nbsp; <?=$session->grand_total?> </h2>

					</div>
					<div class="">
					        		<b>Bill in the name of :</b>&nbsp;<?=$billing_info->name?></br>
								<b>Company Name :</b>&nbsp;<?=$billing_info->company_name?></br>
								<b>Email :</b>&nbsp; <?=$billing_info->email ?></br>
									<b>Billing Address :</b>&nbsp; <?=$billing_info->address ?></br>
									<b>Billing State :</b>&nbsp; <?=$billing_info->state ?></br>
								<b>Phone Number :</b>&nbsp;<?=	$billing_info->phone_country_code?>-<?=$billing_info->phone_number?></br>
								<b>GST Number :</b>&nbsp;<?=$billing_info->gst_number?>
				        	</div>
					
				</div>	
			</div>

			<div class="[ col-md-2 ] ">			
			</div>
		</div>
		<?php
			}
			
			else{
		?>
				<div class="[ row ]">
				
		               <div class="[ col-md-2 ] " style=""></div>
					<div class="[ col-md-8 ] " style="border:3px solid #2a2a81; ">
						<div class="[ justify-content-center ][ p-3 ]" style=" margin-top:1rem; margin-bottom:2rem;">
							<div style="">
        						<h2 class="text-center"><?=$session->count;?> Tickets (INR <?=$session->grand_total?>)</h2>	
				        	</div>
				        	<div class="">
					        		<b>Bill in the name of :</b>&nbsp;<?=$billing_info->name?></br>
    								<b>Company Name :</b>&nbsp;<?=$billing_info->company_name?></br>
    								<b>Email :</b>&nbsp; <?=$billing_info->email ?></br>
									<b>Billing Address :</b>&nbsp; <?=$billing_info->address ?></br>
									<b>Billing State :</b>&nbsp; <?=$billing_info->state ?></br>
								<b>Phone Number :</b>&nbsp;<?=	$billing_info->phone_country_code?>-<?=$billing_info->phone_number?></br>
								<b>GST Number :</b>&nbsp;<?=$billing_info->gst_number?>
				        	</div>
				        	
						
						</div>	
					</div>
					<div class="[ col-md-2 ] " style=""></div>
				</div>
			<?php }
		?>
	</div>
		<!-- <div class="row" style="">
		    <div class="col-md-2"></div>
			<div class="col-md-8" style="  border:3px solid #2a2a81;  padding: 36px; margin-top:2rem;">
				
				 
			</div>
			 <div class="col-md-2"></div>
		</div>  -->       
	</div>
	
	
	
	<?php
	if ($session->total > 0) {
	
	?>
	<!--<div class="container">-->
		
		
		
	<!--  <div class="row">-->
	<!--        <div class="col" style="text-align: center;">-->
	<!--    	<form action="<?= $page->parent->httpUrl ?>ticket-thank-you" method="POST">-->
	<!--    		<script src="https://checkout.razorpay.com/v1/checkout.js" data-key=<?php echo $api_key ?> data-amount="<?= $session->grand_total * 100 ?>" data-currency="INR" data-buttontext="Confirm And Pay" data-name="The Pride Circle" data-description="Rise 2021 Ticketing" data-image="https://www.thepridecircle.com/site/templates/assets/img/b9bdc83305cfe9eea4375c1226da58b4.png" data-prefill.name="<?= $billing_info->name ?>" data-prefill.email="<?= $billing_info->email ?>" data-prefill.contact="<?= $billing_info->phone_country_code . $billing_info->phone_number ?>" data-theme.color="#2a2a81"></script>-->
	<!--    		<input class="btn btn-primary"  type="hidden" custom="Hidden Element" name="hidden">-->
	<!--    	</form>-->
	<!--    	</div>-->
	<!--    </div>-->
	<!--</div>-->
	
   <?php  
   
    /*
        Razerpay Interartion by Sameesh.
    */
	$displayCurrency='INR';
// 	$api_secret='MEbODTX2gmae47DaFbZaucU6';//'LFw4weJmBHlo3Ra3fpj5ThOh'; //
	$api_secret='EygxZqmW5nBl3zarpwqBsCcE';
	$api = new Api($api_key, $api_secret);
	$amount_to_pay=$session->grand_total * 100;
				
				$orderData = [
					'receipt'         => time(),
					'amount'          => (int)$amount_to_pay, // 2000 rupees in paise
					'currency'        => 'INR',
					'payment_capture' => 1 // auto capture
				];
				$razorpayOrder = $api->order->create($orderData);    
				$razorpayOrderId = $razorpayOrder['id'];
				//echo $razorpayOrderId;
				$session->razorpay_order_id = $razorpayOrderId;

				$displayAmount = $amount = $orderData['amount'];

				if ($displayCurrency !== 'INR') {
					$url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
					$exchange = json_decode(file_get_contents($url), true);

					$displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
				}


				$data = [
					"key"               => $api_key,
					"amount"            => $session->grand_total,
					"name"              => "Pride Circle",
					"description"       => "RISE 2021",
					"image"             => "https://www.thepridecircle.com/site/templates/assets/img/b9bdc83305cfe9eea4375c1226da58b4.png",
					"prefill"           => [
						"name"              => "$billing_info->name",
						"email"             => "$billing_info->email",
						"contact"           => "$billing_info->phone_country_code.$billing_info->phone_number",
					],
				// 	"notes"             => [
				// 		"address"           => "Hello World",
				// 		"merchant_order_id" => "12312321",
				// 	],
					"theme"             => [
						"color"             => "#F37254"
					],
					"order_id"          => $razorpayOrderId,
				];

				if ($displayCurrency !== 'INR') {
					$data['display_currency']  = $displayCurrency;
					$data['display_amount']    = $displayAmount;
				}

				$json = json_encode($data);
	    		if( isset($_POST['ajax']) && isset($_POST['payment_id']) ){
                     echo $_POST['payment_id'];
                }

				?>
				<div class="text-center" style="margin-bottom:4rem;">
					<button id="rzp-button1" class="btn btn-primary">Confirm And Pay</button>
				</div>
				<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
				<?php 
				    
				?>
				<script>
					// Checkout details as a json
					var options = <?php echo $json ?>;

					/**
					 * The entire list of Checkout fields is available at
					 * https://docs.razorpay.com/docs/checkout-form#checkout-fields
					 */
					options.handler = function(response) {
						$.ajax({
    				        url :'<?=$page->parent->httpUrl?>api/api-ticketing-save-payment-id/',
    				        method : "post",
    				        data:{'payment_id' : response.razorpay_payment_id },
    				        success:function(result){
    				            window.location="<?=$page->parent->httpUrl?>ticket-thank-you";
    				        }
				        });

					    
					};
					
				

					// Boolean whether to show image inside a white frame. (default: true)
					options.theme.image_padding = false;

					options.modal = {
						ondismiss: function() {
							console.log("This code runs when the popup is closed");

						},
						// Boolean indicating whether pressing escape key 
						// should close the checkout form. (default: true)
						escape: true,
						// Boolean indicating whether clicking translucent blank
						// space outside checkout form should close the form. (default: false)
						backdropclose: false
					};

					var rzp = new Razorpay(options);

					document.getElementById('rzp-button1').onclick = function(e) {
						rzp.open();
						e.preventDefault();
					}
				</script>
		
				<?php
        /*
            Razerpay integration ends here.
        */
    	
	} else {
		echo "Cart is empty";
	}
}else{
	header("Location: " . $page->parent->httpUrl . "cart");
}
    ?>
	<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
<?php require_once(\ProcessWire\wire('files')->compile('includes/ticketing-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>



