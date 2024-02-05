<?php
/** Run Loop on candidate pages
 * Save recruiter candidate status to new recruiter candidate status for filter field
 */
$recruiter_page_array = array();
foreach ($pages->get("name=candidates")->children() as $single_candidate) {
        $notes_object_array = array();
        if($single_candidate->notes_data!=""){
          $recuiter_notes_array = json_decode($single_candidate->notes_data);
          // echo "////";
          // print_r($recuiter_notes_array);
          // echo "****";
          foreach ($recuiter_notes_array as $single_notes) {
              foreach ($single_notes as $single_notes_data) {
                $recruiter_page=$pages->get($single_notes_data->added_by);
                if($recruiter_page->recruiter_profile_type=="super-recruiter"){
                  $recruiter_candidate_id=$recruiter_page->id;
                  $candidate_status=$single_notes_data->notes;
                }
                else{
                  $recruiter_page=$pages->get($single_notes_data->added_by)->parent();
                  $recruiter_candidate_id=$recruiter_page->id;
                }

                $word = "Status changed to :";
                $favourite_word="Status changed to : Favourited";
                $unlocked_word="Status changed to : Unlocked";
                if(strpos($single_notes_data->notes, $word) !== false) {
                  if((strpos($single_notes_data->notes, $favourite_word) !== false) || (strpos($single_notes_data->notes, $unlocked_word) !== false)){
                    continue;
                  }
                  else{
                    $latestNote = $single_notes_data;
                  }
                }
                if ($latestNote !== null) {
                  echo "+++++++++++++++++++++++++++++";
                  echo $latestNote->notes;
                  echo $latestNote->added_by;
                  echo "-----------------------------";
                  $candidate_status=substr($latestNote->notes, strpos($latestNote->notes, ":") + 2);
              
                  $candidates_status_for_filter_json = $single_candidate->recruiter_candidate_status_for_filter;
                  if ($candidates_status_for_filter_json == "") {
                      $candidates_status_for_filter_json = '{}';
                  }
                  $candidates_status_object_for_filter = json_decode($candidates_status_for_filter_json);
                  $candidates_status_object_for_filter->$recruiter_candidate_id = $candidate_status;
                  $single_candidate->recruiter_candidate_status_for_filter = json_encode($candidates_status_object_for_filter);
                }
              }
          }
          echo $single_candidate->id;
          echo "<br>";
          $single_candidate->of(false);
          $single_candidate->save();
        }
        else{
          echo "No notes data";
          echo $single_candidate->id;
          echo "<br>";
          continue;
        }
}
?>
