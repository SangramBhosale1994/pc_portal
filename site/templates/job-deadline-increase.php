<?php
 // init();
// public function init() {
  //$page->addHook('LazyCron::every2Minutes', $this, 'expired_jobs');
// } 
//  $rootpath = $config->urls->templates; 
//  function expired_jobs(HookEvent $e){
function expired_jobs(){
  $current_timestamp=strtotime(date("Y-m-d h:i:sa"));
  //$counter=0;
  // foreach(wire('pages')->get("name=jobs")->children("application_deadline<".$current_timestamp) as $expired_job_page) {
    foreach(wire('pages')->get("name=jobs")->children("sort=-published,verification=unverified,limit=5") as $expired_job_page) {
         echo $expired_job_page->id;
         echo "****************";
         echo $expired_job_page->job_code;
         echo "-------------------";
         echo $expired_job_page->application_deadline;
         echo "<br>";
         $expired_job_page->application_deadline="2022-04-30";
         echo $expired_job_page->application_deadline;
        //wire('log')->save("expired_jobs", "expired_jobs executed.");  
        //if($expired_job_page->id=="4418"){
          // $expired_job_page->verification="unverified";
          // $expired_job_page->of(false);
          // $expired_job_page->save();
        //}
        
        //$counter++;
  }
  // echo "***************";
  // echo $counter;
}
expired_jobs();
// wire()->addHook('LazyCron::every2Minutes', null, 'expired_jobs');
?>