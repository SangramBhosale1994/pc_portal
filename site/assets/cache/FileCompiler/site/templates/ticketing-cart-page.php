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
    
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
    
        /*
            Code by Sameesh 
        */
    	if($count>=5){
    	    //to add 10% extra discount if count >5
    		$session->discount=0.10;
    		$session->total=$total-(int)($total*$session->discount);
    		$session->count=$count;
    		
    	}else{
    		$session->discount=0;
    		$session->count=$count;
    	}
        
    
     ?>


    <?php 
        if($page->httpUrl!=$pages->get("name=ticket-thank-you")->httpUrl){
    ?>
        <div class=" container  justify-content-between ">
            <a href="<?= $pages->get("name=tickets")->httpUrl ?>"><button type="button" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i>&nbsp;Continue Shopping</button></a>	
           
        </div>    
        <?php 
        }
        ?>
   <?php
        /* Check if the ticket deletion form was submitted from front-end. -by checking if there is a post value of the delete button name */
        if (isset($_POST["delete_ticket_button"])) {
        
        	/* Get which ticket is to be deleted from the cart. use sanitizer as the value needs to be an integer. */
        	$ticket_index_to_delete = $input->post->int('delete_ticket_button');
        
        	/* Convert the JSON of tickets in the cart (session) into an object. */
        	$cart_tickets_object = json_decode($session->tickets_json);
        
        	/* Remove that one particular ticket from the array. array_splice (https://www.w3schools.com/php/func_array_splice.asp) */
        	unset($cart_tickets_object->$ticket_index_to_delete);
        
        	/* Save the new array to the cart again by encoding the object into JSON */
        	$session->tickets_json = json_encode($cart_tickets_object);
        	
        	
        	header("Location: " . $page->httpUrl);
        }
        /* Check if the ticket deletion form was submitted END */
        
        /* Show the list of all the tickets that are saved in the session (CART) */
        
        /* Convert the JSON of tickets in the cart (session) into an object. */
        $cart_tickets_object = json_decode($session->tickets_json);
        $total = 0;
    
        if (isset($_POST["btn_billing_submit"])) {
        	$billing_info = new stdClass;
        	$billing_info->name = $input->post->text('billing_name');
        	$billing_info->company_name = $input->post->text('billing_compnay_name');
        	$billing_info->email = $input->post->text('billing_email');
        	$billing_info->phone_country_code = $input->post->text('phone_country_code');
        	$billing_info->phone_number = $input->post->text('billing_phone_number');
        	$billing_info->gst_number = $input->post->text('billing_gst_number');
        	$billing_info->address = $input->post->textarea('billing_address');
        	$billing_info->state = $input->post->text('state');
        	$session->billing_info = json_encode($billing_info);
        	header("Location: " . $page->parent->httpUrl . "checkout");
        }
    ?>



<div class="" style="margin-top:5rem;">



	<div class="shopping-cart container">

		<h2 class="text-center"></h2>
		<?php
		$total = 0;
		/* Loop to go through each ticket added in the cart and show the details */
		foreach (json_decode($session->tickets_json) as $cart_ticket_key => $single_ticket) {
			$total += $single_ticket->price;


		?>

			<div class="" style=" margin-top: 1rem;  ">
			    <div class="row">
			        <div class="col-md-2"></div>
			        <div class="col-md-8" style="border:2px solid #2a2a81;">
			    <div class=" container d-flex justify-content-between" style="margin-top:2rem;">
			        <div>
			            <div style=" font-family: 'Montserrat', sans-serif;">
			               <h3> <?= $pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->title ?>
			               </h3>
			            </div>
			            <br/>
			              <div class="product-price" style="margin-top: -1rem; color:red;">INR<?= $single_ticket->price ?></div>
			        </div>
			        <div>
			            
								<form method="POST"  id="ticket_deletion_form_<?= $cart_ticket_key ?>">
									<button name="delete_ticket_button" class="btn btn-danger" value="<?= $cart_ticket_key ?>"><i class="fa fa-trash" aria-hidden="true"></i> REMOVE</button>
								</form>
			        </div>
			    </div>
			    
			            <div class="container">
							<div class="row">
								<div class="col-md-6">
									<h5 style=" font-family: 'Montserrat', sans-serif; margin-top:1rem;">Attendee Information</h5>
									<p> Name : <?= $single_ticket->first_name . " " . $single_ticket->last_name ?><br/>
									Pronoun : <?= $single_ticket->pronoun ?><br/>
									Phone number : <?= $single_ticket->phone_country_code ?> <?= $single_ticket->phone_number ?><br/>
								    Email : <?= $single_ticket->email ?><br/>
									Company Name : <?= $single_ticket->company_name ?></p>


								</div>
								<div class="col-md-6" >
								    <!--<div class="product-price">INR<?= $single_ticket->price ?></div>-->
								</div>

							</div>
						</div>
			        <div class="col-md-2"></div>
			      </div>  
			    </div>
			
			</div>




    <?php
    
		}
		
	?>
	</div>
	
	<?php
		
		$discounted_price = $total;

		if($session->count >= 5){
			$discounted_price =  $total-(int)($total*$session->discount);
		}
		

		$gst_amount = $discounted_price*0.18;
		$price_including_gst = $discounted_price + $gst_amount;
		$transaction_fee = $price_including_gst*0.03;
		
		
		$discounted_price=number_format((float)$discounted_price, 2, '.', '');
		$session->total = $discounted_price;
		$transaction_fee =number_format((float)$transaction_fee, 2, '.', '');
		$gst_amount =number_format((float)$gst_amount, 2, '.', '');
		$total =number_format((float)$total, 2, '.', '');
		$grand_total =  $discounted_price+$gst_amount+$transaction_fee;
		$price_including_gst =number_format((float)$price_including_gst, 2, '.', '');
		
		$grand_total =number_format((float)$grand_total, 2, '.', '');
		$session->grand_total = $grand_total;
		
		

		if($total != 0){

?>
</div>
<?php
	/* Changes made to the design and content by Amrut Todkar 2021-03-13 */
?>
	<div class="[ container ]" style="margin-top:1rem;">
	    <?php 
	        if($session->count>=5){
	    ?>
		        <div class="[ row ]">
			<div class="[ col-md-2 ] ">			
			</div>

			<div class="[ col-md-8 ] " style="border:2px solid #2a2a81;">
				<div class="[ d-flex justify-content-between ][ p-3 ]" style=" ">
					<div style="">
						
						<h5 class="">Cart Total </h5>
						<h5 class="">Discounted Price </h5>
						<h5 class="">GST (18%) </h5>
						<h5 class="">Convenience Fees</h5>
						<h5 class="">Grand Total </h5>
					</div>
					<div style="" style="text-align: right">
					
						<h5 class="card-text" style="">
							<?php
							echo  $total;
						
							?>

						</h5>
							<h5 class="card-text" style="">
							<?php
								echo $discounted_price;
						    ?>

						</h5>
						<h5 class="card-text" style=""><?=$gst_amount;?></h5>
						<h5 class="card-text" style=""><?=$transaction_fee;?></h5>
						<h5 class="card-text" style=""><?=$session->grand_total;?></h5>
					</div>
					
				</div>	
			</div>

			<div class="[ col-md-2 ] ">			
			</div>
		</div>
		<?php
	        }
	        else{?>
	             <div class="[ row ]">
        			<div class="[ col-md-2 ] ">			
        			</div>
        
        			<div class="[ col-md-8 ] " style="border:2px solid #2a2a81;">
        				<div class="[ d-flex justify-content-between ][ p-3 ]" style=" ">
        					<div style="">
        						
        						<h5 class="">Cart Total </h5>
        						<h5 class="">GST (18%) </h5>
        						<h5 class="">Convenience Fees</h5>
        						<h5 class="">Grand Total </h5>
        					</div>
        					<div  style="text-align: right">
        						<h5 class="card-text" style=""><?=$session->total;?></h5>
        						<h5 class="card-text" style=""><?=$gst_amount;?></h5>
        						<h5 class="card-text" style=""><?=$transaction_fee;?></h5>
        						<h5 class="card-text" style=""><?=$session->grand_total;?></h5>
        					</div>
        					
        				</div>	
        			</div>
        
        			<div class="[ col-md-2 ] ">			
        			</div>
        		</div>
	        <?php }
		?>
	</div>

<?php
	/* Changes made to the design and content by Amrut Todkar 2021-03-13 END */
?>

	<br>
	<!--<a href="<?= $page->parent->url ?>">Add More</a>-->
	<!--<br/>-->
	<!--<a href="<?= $page->parent->url ?>thank-you">Checkout</a>-->
	<!--<div class="d-flex justify-content-center" style="padding-bottom:3rem;">-->
	<!--	<a href="<?= $page->parent->url ?>" class="text-center" style=""><button type="button" class="btn btn-primary">Add More</button></a>-->


		<!--<a href="<?= $pages->get("name=checkout")->httpUrl ?>"  class="text-center"><button type="button" class="btn btn-primary">Checkout</button></a>-->
	<!--</div>-->

	<!--<div class="text-center">-->
	<!--     <button class="checkout text-center">Checkout</button>-->
	<!--</div>  -->


	<!--checkout form-->
	<div class="container" style="margin-bottom:3rem;">
	    <h2 class="text-center" style="font-family: 'Montserrat', sans-serif;">Billing Information</h2>
	    
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form class="needs-validation" id="add_payment_info" method="post" novalidate>

					<div class="form-group">
						<label for="billing_name">Bill in the Name of </label>
						<input type="text" class="form-control" id="billing_name" name="billing_name" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" placeholder="Name" required>
						<div class="invalid-feedback">
							Please enter valid Name
						</div>
					</div>
					<div class="form-group">
						<label for="billing_compnay_name">Company Name</label>
						<input type="text" class="form-control" id="billing_compnay_name" name="billing_compnay_name" placeholder="Company Name" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" required>
						<div class="invalid-feedback">
							Please enter valid Company Name
						</div>
					</div>
					<div class="[  ][ form-group ]">
						<label for="billing_email">Email</label>
						<input id="billing_email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="billing_email" placeholder="abc@xyz.com" value="<?= $session->oauth_gmail; ?>" required>

						<div class="invalid-feedback">
							Please provide a valid email address.
						</div>
					</div>
<!--                    	<div class="form-group">-->
<!--						<label for="billing_address">Address </label>-->
						<!--<input type="text" class="form-control" id="billing_address" name="billing_address"  placeholder="Enter Address">-->
<!--						<textarea id="billing_address" name="billing_address"-->
<!--          rows="5" cols="80">-->

<!--</textarea>-->
<!--						<div class="invalid-feedback">-->
<!--							Please enter Address-->
<!--						</div>-->
<!--					</div>-->
                        <div class="form-group">
                          <label for="billing_address">Billing Address</label>
                          <textarea class="form-control rounded-0" id="billing_address" name="billing_address" rows="5" placeholder="Enter Billing Address"></textarea>
                          <div class="invalid-feedback">
							Please enter Address
						</div>
                          
                        </div>

					
                    <div  class="[ ][ form-group ]">
                        <label for="state">State</label>
				        <div class="row no-gutters">
                            <select name="state" id="state" class="form-control" id="state" name="state">
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Dadra and Nagar Haveli">Dadar and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman and Diu</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Puducherry">Puducherry</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra" selected>Maharashtra</option>
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
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                                <option value="Out of India">Out of India</option>
                            </select>
                        </div>
                    </div>
					<div class="[ ][ form-group ]">
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

							<input id="billing_phone_number" class="[ offset-1 col-7 pl-2 ][ form-control ]" pattern="[0-9]{10}" type="text" name="billing_phone_number" placeholder="Example: 9876543210" maxlength="10" required>
                            
                           
							<div class="invalid-feedback">
								Please provide a valid phone number.
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="billing_gst_number">GST number </label>
						<input type="text" class="form-control" id="billing_gst_number" name="billing_gst_number" maxlength="15" placeholder="GST Number">
						<div class="invalid-feedback">
							Please enter valid GST Number
						</div>
					</div>

					<center><button class="btn btn-primary" type="submit" name="btn_billing_submit">Continue</button></center>
				</form>

			</div>
			<div class="col-md-2"></div>
		</div>
	</div>



	<script>
		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function() {
			'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
					form.addEventListener('submit', function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
	</script>
<?php


		} else {
// 			echo "There are no tickets in your cart!";
			?>
				<div class="container text-center mt-3" style="height:500px;padding-top:10rem;">
				    <div class="alert alert-warning text-center" role="alert" style=" text-align: center;">
                          <p style="color:red; margin-top:1rem;">Your cart is empty!</p>
                        </div>
                        					
				</div>
				   <?php 
?>
	<!--<div class="d-flex justify-content-center" style="padding-bottom:3rem;">-->
	<!--	<a href="<?= $page->parent->url ?>" class="text-center" style=""><button type="button" class="btn btn-primary">Add More</button></a>-->


		<!--<a href="<?= $pages->get("name=checkout")->httpUrl ?>"  class="text-center"><button type="button" class="btn btn-primary">Checkout</button></a>-->
	<!--</div>-->
<?php
		}
?>
<script>
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
</script>
<?php
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>