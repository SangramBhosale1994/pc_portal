<?php
foreach($pages->get('name=recruiters')->children() as $single_recruiter){
  if($single_recruiter->id=="11100"){
    continue;
  }
  if($single_recruiter->id=="11039"){
    continue;
  }
  $unlocked_profiles_array=$single_recruiter->unlocked_profiles_array;
  $favourite_profiles_array=$single_recruiter->favourite_profiles_array;
  $candidate_applied_for_job=$single_recruiter->candidate_who_applied_for_job;
  $time_lgs=$single_recruiter->time_logs;
  $candidate_download_profiles=$single_recruiter->candidate_download_profiles;
  echo "*******";
  echo $single_recruiter->id." name: ".$single_recruiter->title;
  echo "<br> unlocked profiles <br>";
  echo $unlocked_profiles_array;
  echo "<br> favourite profiles <br> ";
  echo $favourite_profiles_array;
  echo "<br> candidate who applied for job <br> ";
  print_r($candidate_applied_for_job);
  echo "<br> time logs <br> ";
  echo $time_lgs;
  echo "<br> candidate download profiles <br> ";
  echo $candidate_download_profiles;

  $single_recruiter->unlocked_profiles_array="{}";
  $single_recruiter->favourite_profiles_array="{}";
  $single_recruiter->candidate_who_applied_for_job="[]";
  $single_recruiter->time_logs="{}";
  $single_recruiter->candidate_download_profiles="{}";

  echo "<br> As per new recruiter structure <br> ";
  echo "unlocked profiles <br> ";
  echo $single_recruiter->unlocked_profiles_array;
  echo "<br> favourite profiles <br> ";
  echo $single_recruiter->favourite_profiles_array;
  echo "<br> candidate who applied for job <br> ";
  print_r($single_recruiter->candidate_applied_for_job);
  echo $single_recruiter->candidate_applied_for_job;
  echo "<br> time logs <br> ";
  echo $single_recruiter->time_lgs;
  echo "<br> candidate download profiles <br> ";
  echo $single_recruiter->candidate_download_profiles;
  echo "<br> As per new recruiter structure end<br> ";

  // $single_recruiter->of(false);
  // $single_recruiter->save();

}
?>