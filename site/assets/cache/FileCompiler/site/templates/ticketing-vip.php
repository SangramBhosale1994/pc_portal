<?php
	/* SEt the sessio nto VIP session */
	$session->vip = true;

	/* Redirect to the page of tickets. */
	header("Location: " . $pages->get("name=tickets")->httpUrl);
?>