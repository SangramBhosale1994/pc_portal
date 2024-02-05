<?php
 // init();
// public function init() {
  //$page->addHook('LazyCron::every2Minutes', $this, 'expired_jobs');
// } 
//  $rootpath = $config->urls->templates; 
//  function expired_jobs(HookEvent $e){
  /** this function is used for save job verification status is unverified after job application deadline is over */
function expired_jobs(){
  //$current_timestamp=strtotime(date("Y-m-d h:i:sa"));
  /** get current date timestamp */
  $current_date=strtotime(date("Y-m-d"));
  echo $current_date;
  /** add 24 hours in current date timestamp because your posted job is not unverified if job application dedaline is current date */
  $current_timestamp=$current_date + 24*60*60;
  echo  "add 24 hours in current date";
  echo $current_timestamp;

  //$counter=0;
  /**Get all job which application deadline is over */
  foreach(wire('pages')->get("name=jobs")->children("application_deadline<".$current_timestamp) as $expired_job_page) {
          echo $expired_job_page->id;
         echo "<br>";
         echo $expired_job_page->application_deadline;
         echo "-----------";
        //wire('log')->save("expired_jobs", "expired_jobs executed.");  
        //if($expired_job_page->id=="4418"){
          /**save verification status is unverified */
          $expired_job_page->verification="unverified";
          $expired_job_page->of(false);
          $expired_job_page->save();
        //}
        
        //$counter++;
  }
  // echo "***************";
  // echo $counter;
}
expired_jobs();
// wire()->addHook('LazyCron::every2Minutes', null, 'expired_jobs');
?>