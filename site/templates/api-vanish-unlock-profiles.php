<?php
 /** This function is used for to remove unlock profiles after 4 month of added  */
function vanish_unlock_profiles(){
  /**Get session user id */
  $session_user_id=wire('session')->user_page_id;
  $session_recruiter_profile_type=wire('session')->recruiter_profile_type;
  // echo $session_user_id;
  /**get editor or recuiter is using session id */
  $editor_user_profile=wire('pages')->get("name=editors")->child("id=".$session_user_id);
  if($session_recruiter_profile_type=="sub-recruiter"){
    $recruiter_user_profile=wire('pages')->get($session_user_id)->parent();
  }
  else{
    $recruiter_user_profile=wire('pages')->get($session_user_id);
  }
  
  // echo "user id";
  // echo $editor_user_profile->id;
  // echo $recruiter_user_profile->id;
  /**check editor or recuiter id is not empty and access unlocked profiles array of perticular page */
  if($editor_user_profile->id!=""){
    $user_profile=$editor_user_profile;
    $unlock_profiles_object=json_decode($editor_user_profile->unlocked_profiles_array);
  }
  elseif($recruiter_user_profile->id!=""){
    $user_profile=$recruiter_user_profile;
    if(!empty($recruiter_user_profile->unlocked_profiles_array)){
      $unlock_profiles_object=json_decode($recruiter_user_profile->unlocked_profiles_array);
    }
   
  }
  else{}
  /**Get current timestamp */
  $current_timestamp=strtotime(date("Y-m-d h:i:sa"));
  // echo "Current date :";
  // echo date("Y-m-d h:i:sa");
  /**apply forach loop on unlock profiles object */
  if($unlock_profiles_object!=""){
    foreach($unlock_profiles_object as $candidate_id=>$timestamp){
      /**Get timestamp of each unclok profile and add 4 months in this timestamp */
      $candidate_unlock_timestamp=strtotime("+4 months", $timestamp);
      // echo "Candidate unlock time";
      // echo date("Y-m-d h:i:sa",$candidate_unlock_timestamp);
      /**check current timestamp is greater than candidate profile timestamp if no then remove this profile from unlock profiles object */
      if($candidate_unlock_timestamp<$current_timestamp){
        /**remove candidate id from unlocked profiles object */
        // echo $candidate_id;
        unset($unlock_profiles_object->$candidate_id);
  
      }
      // echo "********************";
      // print_r($unlock_profiles_object);
    }
  }
  
  /**assign updated unlock profiles object to unlock profiles array */
  $user_profile->unlocked_profiles_array=json_encode($unlock_profiles_object);
  /**save profile page */
  $user_profile->of(false);
  $user_profile->save();
  
 
}
vanish_unlock_profiles();

?>