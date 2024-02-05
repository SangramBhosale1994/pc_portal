<?php 
    //header("Location:".$page->page_redirection_url."");
    
    // include(\ProcessWire\wire('files')->compile('includes/send_mail_ticketing.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
    
  //$seller_name_array = array("bangalore_connection"=>"bangalore_connection#467");
    
    // $seller_name_array = array(
    //     "bangalore_connection "=>"bangalore_connection#467", 
    //     "haute_potli"=>"haute_potli#246",
    //     "yogam_pottery"=>"yogam_pottery@486",
    //     "jity_of_coy"=>"jity_of_coy#985",
    //     "arpita_gaidhane_art"=>"arpita_gaidhane_art#908",
    //     "shujuku_fabtech"=>"shujuku_fabtech#632",
    //     "lil_fairy_bakes"=>"lil_fairy_bakes#576",
    //     "house_of_kc"=>"house_of_kc#678",
    //     "studio_marapachi"=>"studio_marapachi#679",
    //     "green_castle"=>"green_castle#063",
    //     "bee_studio"=>"bee_studio#083",
    //     "wayward_wayz"=>"wayward_wayz#578",
    //     "qucciberry"=>"qucciberry#753",
    //     "panda_rolling"=>"panda_rolling#753",
    //     "angelo_vegan_cheese"=>"angelo_vegan_cheese#845",
    //     "resin_NMe"=>"resin_NMe#853",
    //     "zuca_fresh"=>"zuca_fresh#762",
    //     "philo_merchandising"=>"philo_merchandising#544",
    //     "suyash_tripathi_CA"=>"suyash_tripathi_CA#539"
    //     );
    
    // $seller_name_array = array(
    //   "kronokare_cosmetics"=>"kronokare_cosmetics#824",
    //   "boucle"=>"boucle#754",
    //   "astitva_jewellery"=>"astitva_jewellery#745"
    //     );
        
    // $seller_email_array=array(
    //     "shop@kronokare.com",
    //     "tania.t.george@gmail.com",
    //     "riddhimanjain21@gmail.com"
    //     );
    
    // $seller_email_array=array(
    //     "priyank94@gmail.com",
    //     "aamoghcollections@gmail.com",
    //     "yogampottery@gmail.com",
    //     "sayantan@jityofcoy.in",
    //     "arpita.gaidhane@gmail.com",
    //     "vishnurajanpillai@gmail.com",
    //     "gauthambalajee@gmail.com",
    //     "krish.houseofkc@gmail.com",
    //     "studiomarapachi@gmail.com",
    //     "vishnutejau@gmail.com",
    //     "ksagroupofbusiness@gmail.com",
    //     "akanksha0503@gmail.com",
    //     "varunabraham@aol.com",
    //     "sanamdembla@gmail.com",
    //     "adityaf92@gmail.com",
    //     "ksujan370@gmail.com",
    //     "info@zucafresh.com",
    //     "sharvamane97@gmail.com",
    //     "tripathi.r.suyash@gmail.com",
    //     );
    
    
    
    //$seller_email_array=array("amrutaj.zerovaega@gmail.com");
    // $i=0;
    // foreach($seller_name_array as $key=>$value){
        
    //     // echo $key;
    //     // echo $value;
        
    //     $seller_name=$key;
    
    //     $link="https://shop.thepridecircle.com/seller/";
        
    //     $mail_subject="Login Credentials for Pride Circle Marketplace";
    	    		
    // 	$mail_message="Hello,";
    // 	$mail_message.="<br><br>";
    // 	$mail_message.="Welcome to Pride Circle Marketplace!<br><br>Your account has been created. Please find your login credentials as given below.";
    // 	$mail_message.="<br><br>";
    // 	$mail_message.="Username: ".$key;
    // 	$mail_message.="<br>";
    // 	$mail_message.="Password: ".$value;
    // 	$mail_message.="<br><br>";
    // 	$mail_message.="Click the link to login and begin listing. ".$link;
    // 	$mail_message.="<br><br>";
    // 	$mail_message.="If you have any queries, please contact us at :- contact@thepridecircle.com";
    // 	$mail_message.="<br><br>";
    // 	$mail_message.="Remember, this is confidential and do not share with anyone. Also, Pride Circle would never ask you to share this information at any point in time.";
    // 	$mail_message.="<br><br>";
    // 	$mail_message.="Regards,<br>Pride Circle Team";
    	
    // //	$email="amrutaj.zerovaega@gmail.com";
    // $email=$seller_email_array[$i];
    
    	
    // 	try {
    // 		send_smtp_mail($email,$mail_message,$mail_subject);
    // 		echo "Email send!";
    // 	} catch (Exception $e) {
    //             print_r($e);
    // 	}
    // 	$i++;
    // }
    
    
	
	
// 	$candidate_page=$pages->get("name=candidates")->child("auth_gmail=anshulmalviya196@gmail.com")->id;
// 	echo $candidate_page;
	

?>


<h1 class="page-title typo-heading" style="color:green;">SHOP PRODUCTS</h1>

  
<!--    <p class="myP">This is a p element.</p>-->

<!--<div id="myDIV">This is a div element.</div>-->

<script>
    //var x = document.getElementsByClassName("typo-heading").innerHTML = "Milk";;
//     var text = document.createTextNode("Tutorix is the best e-learning platform");
//   tag.appendChild(text);
   //document.getElementsByClassName("typo-heading").innerHTML="SHOP";
    
    //document.getElementsByClassName("typo-heading").innerHTML = "SHOP <span>PRODUCTS</span>";
  
//var list = document.getElementsByClassName("example")[0];
document.getElementsByClassName("typo-heading")[0].innerHTML = "SHOP <span id='span_product'>PRODUCTS</span>";
document.getElementById("span_product").style.color="black";

// document.getElementsByClassName("myP").innerHTML = "Hello Dolly.";
// document.getElementById("myDIV").innerHTML = "How are you?";


    
    
     //var y=x.slice(5, 13);
      //var y=x[0].style.color="red";
    
    // y[0].style.color="red";
  //alert(x);
    // var str = 'Geeks for Geeks'
    // var array = y.split("SHOP"); 
    // array[0].style.color="red"
    // document.write(array); 
    
    
//      var tag = document.createElement("p");
//   var text = document.createTextNode("Tutorix is the best e-learning platform");
//   tag.appendChild(text);
//   var element = document.getElementById("new");
//   element.appendChild(tag);

</script>