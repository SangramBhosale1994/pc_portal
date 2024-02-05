<?php
	$session->logout();

	$session->redirect($pages->get("name=universal-home")->httpUrl);
	header("Location: ".$config->urls->httpRoot);//."admin-dashboard");
?>