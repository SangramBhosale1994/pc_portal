<?php
//If the HTTPS is not found to be "on"
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}

/*$rootpath = $config->urls->templates;*/
header("Location: ".$config->urls->httpRoot."resume/");
/*
foreach ($pages->get("name=candidates")->children as $key => $candidate_page){
	if($pages->get("name=candidates")->children("oauth_gmail=".$candidate_page->oauth_gmail)->count()>1){
		echo $candidate_page->id;
		echo "<br>";
		echo $candidate_page->oauth_gmail;
		echo "<hr>";
	}
}*/

/* to create a db of proper values of old entires */

//$old_db = mysqli_connect("localhost", "u429740792_pride_circle", "Pridecircle@123", "u429740792_resume_db");

/*$serial_counter = 1001;
foreach ($pages->find("id>=1420, id<=2059, sort=id") as $candidate_page) {*/


/*$serial_counter = 1641;
foreach ($pages->find("id>=1079, id<=1419, sort=id") as $candidate_page) {*/
/*
$serial_counter = 1939;
foreach ($pages->get("name=candidates")->children("id>=2493, id<=2498, sort=id") as $candidate_page) {

	$candidate_page->serial_id = $serial_counter;
	$candidate_page->of(false);
	$candidate_page->save();
	echo $candidate_page->id;
	echo "<br>";
	echo $candidate_page->serial_id;
	echo "<hr>";
	$serial_counter++;

}
?>*/