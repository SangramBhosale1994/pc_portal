<?php
/* Save received JSON data into an array */
	
		/* Get the current editor's page */
		// $editor_page = wire("pages")->get("id=".wire("session")->user_page_id);
		// $editor_page->of(false);
		/**Save unlocked profile id and timestamp in json when you unlock any profile */
		// foreach($pages->get("name=editors")->children("id=4317") as $editor_page){
    //   echo "+++++++++";
    //   echo $editor_page->id;
    //   if($editor_page->id==4321){
    //     continue;
    //   }
    //   if($editor_page->id==4320){
    //     continue;
    //   }
    //   if($editor_page->id==4404){
    //     continue;
    //   }
		//   /* Get the current unlocked profiles array */
    //   $already_unlocked_profiles_array=array();
    //   $editor_unlocked_array=new stdClass();
    //   $single_unlock_profile=new stdClass();
    //   $unlocked_profiles_array_object=new stdClass();
    //   // $unlocked_profiles_array->$single_unlock_profile=new stdClass();
    //   $editor_unlocked_array=$editor_page->unlocked_profiles_array;
    //   $unlocked_profiles_array = json_decode($editor_unlocked_array);
    //   print_r($unlocked_profiles_array);
    //   echo "----";
    //   // echo count((array)$unlocked_profiles_array);
    //   /* If no unlocked are already available */
    //   if($editor_page->unlocked_profiles_array==""){
    //     $editor_page->unlocked_profiles_array="{}";
    //   }
    //   // foreach($unlocked_profiles_array as $candidate_id=>$timestamp){
    //   // 	$already_unlocked_profiles_array[]=$candidate_id;
    //   // }
    //   $profiles_to_unlock=$unlocked_profiles_array;
    //   $current_timestamp=strtotime(date("Y-m-d h:i:sa"));
    //   $unlock_profiles_object=new stdClass();
    //   foreach($profiles_to_unlock as $single_unlock_profile){
    //     echo "11";
    //     print_r($single_unlock_profile);
    //     $unlocked_profiles_array_object->$single_unlock_profile=$current_timestamp;
    //     echo "22";
    //   }
    //   echo "/////";
    //   print_r($unlocked_profiles_array);
    //   echo "----";
    //   $editor_page->unlocked_profiles_array = json_encode($unlocked_profiles_array_object);
    //   print_r($editor_page->unlocked_profiles_array);
    //   echo "***";
    //   // echo $editor_page->unlocked_profiles_array;
    //   /* Save the editor page */
    //   // $editor_page->of(false);
    //   // $editor_page->save();
    //   echo "</br></br>";
    // }

    /**Recruiters */
    foreach($pages->get("name=recruiters")->children() as $recruiter_page){
      echo "+++++++++";
      echo $recruiter_page->id;
      // if($editor_page->id==4321){
      //   continue;
      // }
      // if($editor_page->id==4320){
      //   continue;
      // }
      // if($editor_page->id==4404){
      //   continue;
      // }
		  
      // $unlocked_profiles_array->$single_unlock_profile=new stdClass();
     /* Get the current unlocked profiles array */
      $already_unlocked_profiles_array=array();
      $recruiter_unlocked_array=new stdClass();
      $unlocked_profiles_array_object=new stdClass();
      $recruiter_unlocked_array=$recruiter_page->unlocked_profiles_array;
      $unlocked_profiles_array = json_decode($recruiter_unlocked_array);
        print_r($unlocked_profiles_array);
        echo "***";
      /* If no unlocked are already available */
      if($recruiter_page->unlocked_profiles_array==""){
        $recruiter_page->unlocked_profiles_array="{}";
      }
      
      /**Save unlock profiles in unlock profiles array */
      $profiles_to_unlock=$unlocked_profiles_array;
      $current_timestamp=strtotime(date("Y-m-d h:i:sa"));
      $unlock_profiles_object=new stdClass();
      foreach($profiles_to_unlock as $single_unlock_profile){
        $unlocked_profiles_array_object->$single_unlock_profile=$current_timestamp;
      }
      
      $recruiter_page->unlocked_profiles_array = json_encode($unlocked_profiles_array_object);
      print_r($recruiter_page->unlocked_profiles_array);
        echo "----";
      /* Save the recruiter page */
      // $recruiter_page->save();

      echo "</br></br>";
    }