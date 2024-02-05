<?php
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
//for loop for each 

if ($session->tickets_json != "{}") {
    $purchase_page = new \ProcessWire\Page();
    $purchase_page->template = 'ticketing-purchase';
    $purchase_array = [];
    $ticket_count_array = array();
    foreach (json_decode($session->tickets_json) as $single_ticket) {
        //code to add attendee page and attendee register events
        //attendee page
        //$pages->get("name=events")->chlid("ticketing_event_id=".$single_ticket->event_id)->title;
        // $ticket_count_array[$pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id]++;
        if (!array_key_exists($pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id, $ticket_count_array)) {
            $ticket_count_array[$pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->title] = 1;
        } else {
            $ticket_count_array[$pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->title]++;
        }
        
        

        $attendee_page = $pages->get("name=attendee")->child("phone_number=" . $single_ticket->attendee_phone_number);
        if ($attendee_page->id == 0) {
            $attendee_page = new \ProcessWire\Page();
        }
        $attendee_page->template = 'ticketing-attendee';
        $attendee_page->parent = $pages->get("name=attendee");
        $attendee_page->title = $single_ticket->attendee_name;
        $attendee_page->ticketing_attendee_phone_number = $single_ticket->attendee_phone_number;
        $attendee_page->of(false);
        $attendee_page->save();


        // create event page as child page 
        $flag = true;
        if ($pages->get("name=attendee")->child("ticketing_attendee_phone_number=" . $single_ticket->attendee_phone_number)->numChildren() > 0) {
            foreach ($attendee_page->children() as $attendee_page_child) {
                if ($attendee_page->child("ticketing_event_id=" . $single_ticket->event_id)->id) {
                    $flag = false;
                    echo "Can't buy this " . $single_ticket->event_id . " ticket twise<br>";
                }
            }
        }
        // if ($flag) {
        $event = new \ProcessWire\Page();
        $event->template = 'ticketing-attendee-single-event';
        $event->parent = $attendee_page; // new parent above
        $event->title = $single_ticket->event_id;
        $event->ticketing_event_page_id = $pages->get("name=events")->child("ticketing_event_id=" . $single_ticket->event_id)->id;
        $event->save();
        array_push($purchase_array, $event->id);
        // }
    }
    $purchase_page->ticketing_ticket_page_id = implode(',', $purchase_array);
    $purchase_page->parent = $pages->get("name=purchase");
    $purchase_page->title = time();
    $purchase_page->save();
}
//print_r($ticket_count_array);
$session->remove('tickets_json');
//print_r($session->tickets_json);

?>
<html>

<body>
    <div class="container" style="height:500px">
        <h1 class="text-center" style="color:red;">Failure </h1>
    
    <div class="row" style="margin-left: 2rem; margin-right: 2rem;">
        <div class=" col-md-12" >
           <div class="alert alert-warning text-center" role="alert">
                        <p style="color:red;">Something went wrong. Try again .!</p>
                </div>
           <center>
                <a href="<?= $pages->get("name=checkout")->httpUrl ?>"><button  type="button" class="btn btn-danger text-center">Go Back</button> </a> 
           </center>
              
        </div>
    </div>
 </div>   
</body>
<?php
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>
</html>