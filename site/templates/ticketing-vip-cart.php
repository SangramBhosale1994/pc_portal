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

    require_once 'includes/ticketing-header.php';
    //print_r($session->tickets_json_vip);
    $count=0;
    if( $session->tickets_json_vip!=null||$session->tickets_json_vip!=""){
        //print_r($session->tickets_json_vip);
       foreach(json_decode($session->tickets_json_vip) as $s){
            $count++;
        }
    }
    if (isset($_POST["delete_ticket_button"])) {

    	/* Get which ticket is to be deleted from the cart. use sanitizer as the value needs to be an integer. */
    	$ticket_index_to_delete = $input->post->int('delete_ticket_button');
    
    	/* Convert the JSON of tickets in the cart (session) into an object. */
    	$cart_tickets_object = json_decode($session->tickets_json_vip);
    
    	/* Remove that one particular ticket from the array. array_splice (https://www.w3schools.com/php/func_array_splice.asp) */
    	//array_splice($cart_tickets_object->tickets_array, $ticket_index_to_delete, 1);
    	unset($cart_tickets_object->$ticket_index_to_delete);
    
    	/* Save the new array to the cart again by encoding the object into JSON */
    	$session->tickets_json_vip = json_encode($cart_tickets_object);
    	$session->vip_ticket_count--;
    	
    	header("Location: " . $page->httpUrl);
    }
    
	if (isset($_POST['add_ticket_submit'])) {
	    if(!isset($session->tickets_json_vip)){
	include 'includes/send_mail_ticketing.php';
    	    foreach (json_decode($session->tickets_json_vip) as $single_ticket) {
    
    				$attendee_page = $pages->get("name=vip-attendee")->child("phone_number=" . $single_ticket->phone_number);
    				if ($attendee_page->id == 0) {
    					$attendee_page = new Page();
    				}
    				$attendee_page->template = 'ticketing-vip-attendee';
    				$attendee_page->parent = $pages->get("name=vip-attendee");
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
    	            $vip_attendee_page=$pages->get("name=vip-attendee")->child("phone_number=".$attendee_page->phone_number.",phone_country_code=".$attendee_page->phone_country_code);
    	            if( $vip_attendee_page->child("title=".$single_ticket->event_id)->id==0){
    				// create event page as child page 
        				$event = new Page();
        				$event->template = 'ticketing-attendee-single-event';
        				$event->parent = $attendee_page; // new parent above
        				$event->title = $single_ticket->event_id;
        				$event->ticketing_event_page_id = $pages->get("name=tickets-vip")->child("ticketing_event_id=" . $single_ticket->event_id)->id;
        				$event->verification = "unverified";
        				$event->save();
        				$session->vip_ticket_count++;
    				}
            	}
		   session_destroy();
	    }
    	header("Location: " . $page->parent->httpUrl."ticket-vip-thank-you/");
	}
?>   
	<div class="container d-flex justify-content-start" style="">
		<a href="javascript:history.back()" class="text-center" style=""><button type="button" class="btn btn-primary">Add More</button></a>
		<a href="javascript:history.back()" class="text-center" style=""></a>
	</div>
<div class="" style="margin-top:2rem;">
    <?php
        if($count>0){
            foreach(json_decode($session->tickets_json_vip) as  $cart_ticket_key =>$single_ticket){
    ?>
	<div class="shopping-cart container">
		<h2 class="text-center"></h2>
		
			<div class="" style=" margin-top: 1rem;  ">
			    <div class="row">
			        <div class="col-md-2"></div>
			        <div class="col-md-8" style="border:2px solid #2a2a81;">
			    <div class=" container d-flex justify-content-between" style="margin-top:2rem;">
			        <div>
			            <div style=" font-family: 'Montserrat', sans-serif;">
			               <h3> <?= $pages->get("name=tickets-vip")->child("ticketing_event_id=" . $single_ticket->event_id)->title ?>
			               </h3>
			            </div>
			            <br/>
			              <div class="product-price" style="margin-top: -1rem; color:red;"></div>
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
									<p> Name : <?=$single_ticket->first_name." ".$single_ticket->last_name?><br/>
									Pronoun : <?=$single_ticket->pronoun?><br/>
									Phone number : <?=$single_ticket->phone_country_code.$single_ticket->phone_number?><br/>
								Email : <?=$single_ticket->email?><br/>
									Company Name : <?=$single_ticket->company_name?></p>


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
		</div>
			      





		

<?php
            }?>
            <form   method="POST">
    	        <div class="[ d-flex flex-row justify-content-center mb-4 ]" style="margin-top:2rem;">
    				<button value="submit" id="add_ticket_submit" class="btn btn-primary" type="submit" name="add_ticket_submit" >
    					Submit
    				</button>
    			</div>
    		</form>
            <?php
            
        }
        else{
?>
<div class="container text-center mt-3" style="height:500px;padding-top:10rem;">
				    <div class="alert alert-warning text-center" role="alert" style=" text-align: center;">
                          <p style="color:red; margin-top:1rem;">Your cart is empty!</p>
                        </div>
                        					
				</div>
            				

<?php
        }
?>
    <script>
// $("#add_ticket_submit").click(function(){
//      $("#add_ticket_submit").attr('disabled', 'true');
//  });
           
        
   </script>
</div>
<?php
require_once 'includes/ticketing-footer.php';
?>