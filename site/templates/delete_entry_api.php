<?php
	if (!isset($_POST['now'])) {
		die("Something went wrong. Please refresh and try again");
	}

	$imported_entries_to_delete= json_decode($_POST['now']);

	foreach ($imported_entries_to_delete as $key => $page_id_to_delete) {
		if($pages->get($page_id_to_delete)->trash()){
			echo "Profile ".$page_id_to_delete." was deleted successfully.";
		}
		else{
			echo "Profile ".$page_id_to_delete." couldn' be deleted. Please try again.";
		}
	}
?>