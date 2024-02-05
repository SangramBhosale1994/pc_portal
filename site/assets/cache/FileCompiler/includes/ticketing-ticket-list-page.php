<?php
/*
	File created 2021-03-07
	Primary code by Amrut Todkar

	This page will show all the tickets to the user.
	Page will contain:
	-A list of all the tickets available for the conference
	-Each ticket will have an image and details of that event
	-Each ticket will come with a “Book” button.
	-After clicking on the “Book” button, the user will be taken to the single ticket details page
	-The header will have the banner image of the RISE event, below that,  a “cart” button showing the items in the cart. This will increase as each item is added to the cart.
	-The Footer will be similar as the RISE2021 microsite, containing the contact email ID, copyright statement.
	-A social media floating ribbon will be placed on the rightmost edge.

*/

	require_once 'includes/ticketing-header.php';
?>
        <?php 
            if($page->httpUrl!=$pages->get("name=ticket-thank-you")->httpUrl){
        ?>
        <div class=" container d-flex justify-content-end ">
            <!--<a href="<?= $pages->get("name=tickets")->httpUrl ?>"><button type="button" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i>&nbsp;Go Back</button></a>	-->
           
            
        <a href="<?= $pages->get("name=cart")->httpUrl ?>"><button type="button" class="btn btn-primary"><i style="padding-right:1rem;" class="fa fa-shopping-cart" aria-hidden="true"></i><?=$count?> Items 
            <i class="fa fa-inr" aria-hidden="true" style="font-size:18px;"></i>
            <?php 
                if($count>=5){
                    echo $total-($total*$session->discount);
                    $session->total=$total-($total*$session->discount);
                    $session->count=$count;
                    
                }else{
                    echo $total;
                    $session->count=$count;
                }
            ?>  </button></a>	      
        </div>
        <?php 
        }
        ?>




<!DOCTYPE html>
<html>
<head>
	<title>Tickets</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
  <style>
    .card-ticket-design
    {
        padding-top:2rem;
        padding-bottom:2rem;
    }
    .badge-danger {
    color: #fff;
    background-color: rgb(0 0 0 / 90%);
    }
    .btn-outline-primary-new {
        color: #f8f9fa;
    background-color: transparent;
    background-image: none;
    border-color: #f8f9fa;
    border-radius: 50px;
padding-right: 2rem;
padding-left: 2rem;
border-width: 2px;
}
.btn-outline-primary-new:hover {
        color: #2a2a81;
    background-color: #f8f9fa;
    border-color: #f8f9fa;
}
}
  </style>
</head>
<body>
    <!--<h2 class="text-center">Tickets</h2>-->
<section>
    <!--full day session passes-->
     <div class="container">
        <div class="row"  >
            <?php
                foreach($pages->get("name=events")->children("start=0,limit=3") as $single_event_fullday ) 
                {
                    
               
            ?>
            <div class="col-sm-4 card-ticket-design">
                <!--<div class="card " >-->
                <!--  <div class="card-body">-->
                <!--    <h5 class="card-title"><?=$single_event_fullday->title?></h5>-->
                <!--    <p class="card-text"> <?=$single_event_fullday->ticketing_event_description?></p>-->
                        <!--<div class="d-flex justify-content-center">-->
                          
                        <!--</div>-->
                <!--     <i class="fa fa-inr" aria-hidden="true" style="font-size:18px;"></i>-->
                <!--     <?=$single_event_fullday->ticketing_event_price?>-->
                <!--     <br/>-->
                <!--    <a href="<?= $page->get("name=events")->child("title=".$single_event_fullday->title)->httpUrl ?>" class="btn btn-primary">BUY NOW</a>-->
                <!--  </div>-->
                <!--</div>-->
                 <div class="row" style="    padding-left: 1rem;
    padding-right: 1rem; ">
                        <div class="col-md-12 rounded event_passes_height" style="border:2px solid #2a2a81;background-color: #2a2a81; color:#ddd;">
                                <h3 class="text-center" style="font-family: 'Montserrat', sans-serif; margin-top:2rem;"><?=$single_event_fullday->ticketing_title_toshow?></h3>
                                <h4 class="text-center" style="font-size: 3rem;font-family: 'Montserrat', sans-serif;">INR <?=$single_event_fullday->ticketing_event_price?>*</h4>
                                   <!--<h5 style="text-align:center"><del style="color:red">INR <?=$single_event_fullday->ticketing_events_original_price?></del> <span class="badge badge-pill badge-danger">50% OFF</span></h5>-->
                                    <div style="text-align:center; font-family: 'Montserrat', sans-serif;"><span><del style="color:#ddd">INR <?=$single_event_fullday->ticketing_events_original_price?></del></span> <span class="badge badge-pill badge-danger">40% OFF</span></div>
                                <div style="height:200px;     margin-top: 1.5rem;" >
                                    <?=$single_event_fullday->ticketing_event_description?>
                                </div>
                                <div class="text-center">
                                    <a href="<?= $page->get("name=events")->child("title=".$single_event_fullday->title)->httpUrl ?>" class="btn btn-outline-primary-new">ADD TO CART</a></a>
                                </div>
                        </div>
                         
                    </div>
            </div>
            <!--<div class="col-sm-4 card-ticket-design">-->
            <!--    <div class="card">-->
            <!--      <div class="card-body">-->
            <!--        <h5 class="card-title">Day 2 Session-I & Session-II</h5>-->
            <!--        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                     <!--<i class="fa fa-inr" aria-hidden="true" style="font-size:28px;"><h2>20</h2></i>-->
            <!--         <p><span style="font-size:30px;">₹</span>-->
                     <!--<h2>20  <small><del style="color:red;">40</del></small></h2></p>-->
                    
                    
            <!--         <br/>-->
            <!--        <a href="#" class="btn btn-primary">BUY NOW</a>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="col-sm-4 card-ticket-design">-->
                <!--<div class="card">-->
                <!--  <div class="card-body">-->
                <!--    <h5 class="card-title">Day 1 & Day 2 (Session-I & Session-II)</h5>-->
                <!--    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
                <!--     <span style="font-size: 40px;">₨</span>-->
                <!--     <br/>-->
                <!--    <a href="#" class="btn btn-primary">BUY NOW</a>-->
                <!--  </div>-->
                <!--</div>-->
                <?php
                }
                
                ?>
            </div>
           
        </div>
  </div>
    
    <!--session passses-->
  <div class="container" >
        <div class="row" style="">
            <?php
                foreach($pages->get("name=events")->children("start=3,limit=4") as $single_event_fullday ) 
                {
                    
               
            ?>
            
            <div class="col-md-6 card-ticket-design" style="padding-left:1rem; padding-rigth:1rem;">
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
                                <h3 class="text-center" style="margin-top:2rem; font-family: 'Montserrat', sans-serif;"><?=$single_event_fullday->title?></h3>
                                <h4 class="text-center" style="font-size: 3rem;font-family: 'Montserrat', sans-serif;">INR <?=$single_event_fullday->ticketing_event_price?></h4>
                             
                                <div style="text-align:center; font-family: 'Montserrat', sans-serif;"><span><del style="color:#ddd">INR <?=$single_event_fullday->ticketing_events_original_price?></del></span> <span class="badge badge-pill badge-danger">40% OFF</span></div>
                                <div style="height:200px; margin-top:1.5rem;">
                                    <?=$single_event_fullday->ticketing_event_description?>
                                </div>
                                <div class="text-center">
                                    <a href="<?= $page->get("name=events")->child("title=".$single_event_fullday->title)->httpUrl ?>" class="btn btn-outline-primary-new">ADD TO CART</a>
                                </div>
                        </div>
                            <div class="col-md-1"></div>
                    </div>
                
            </div>
            <?php
                }
            ?>
            <!--<div class="col-sm-6 card-ticket-design">-->
            <!--    <div class="card">-->
            <!--      <div class="card-body">-->
            <!--        <h5 class="card-title">Day 1 Session-II</h5>-->
            <!--        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
            <!--        <a href="<?= $page->url ?>events/day-1-session-2" class="btn btn-primary">BUY NOW</a>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="col-sm-6 card-ticket-design">-->
            <!--    <div class="card">-->
            <!--      <div class="card-body">-->
            <!--        <h5 class="card-title">Day 2 Session-I</h5>-->
            <!--        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
            <!--        <a href="#" class="btn btn-primary">BUY NOW</a>-->
                    
            <!--            <span style="font-size: 40px;">₨</span>-->
            <!--            <h3><?=$page->ticketing_event_price?></h3>-->
            <!--              <h3><?=$page->ticketing_event_price?></h3>-->
                        
                   
            <!--      </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="col-sm-6 card-ticket-design">-->
            <!--    <div class="card">-->
            <!--      <div class="card-body">-->
            <!--        <h5 class="card-title">Day 1 Session-II</h5>-->
            <!--        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
            <!--        <a href="#" class="btn btn-primary">BUY NOW</a>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
  </div>
  <div class="container " style="margin-bottom:2rem;">
      <div>
          <h3 class="text-center"> Terms And Conditions </h3>
          <div class="row tandc_height" style="">
              <div class="col-md-12">
                  <p><?=$page->ticketing_terms_conditions?></p>
              </div>
          </div>
      </div>
  </div>
</section>
    
    
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    -->
<?php

    require_once 'includes/ticketing-footer.php';
?>
</body>
</html>