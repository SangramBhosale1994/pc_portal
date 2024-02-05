<?php
	$rootpath = $config->urls->templates;

	// if($session->email == "" || $session->company_name == ""){
	if($session->email == ""){
		$session->redirect($pages->get("name=universe")->httpUrl);
	}
	else if($input->post->submit){
		$user_email = $session->email;
		echo $user_email;
		$user_page = $pages->get("name=universal-profiles")->child("email={$user_email}");

		if($user_page->id != 0){
			$user_page->of(false);
			$user_page->privacy_policy_acceptance = "accepted";
			$user_page->save();
            
            // if($user_page->privacy_policy_acceptance != "accepted"){
                
            //     $session->redirect($pages->get("name=seller-privacy-statement")->httpUrl);
            // }
            // else{
                $session->redirect($pages->get("name=seller-dashboard")->httpUrl);
            ///}
			
		}
	}


?>
<!DOCTYPE html>
<html>
	<head>
		

		<?php
 include(\ProcessWire\wire('files')->compile('includes/general_seller_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

			$user_email = $session->email;
			$user_page = $pages->get("name=universal-profiles")->child("email={$user_email}");
		?>

		<div class="[ mt-5 py-4 ][ container ]">
			<div class="[ d-flex justify-content-end ]">
				<!--<div class="" style="font-size: 1.2rem"><?=$session->applicant_name?><br><?=$session->company_name?></div>-->

				<div>
					<a class="[ px-4 ][ btn btn-outline-primary ]" href="<?=$pages->get("name=universal-logout")->httpUrl?>">Logout</a>
				</div>
			</div>
		</div>

		<div class="container tabcontainer mt-3 p-5">
			<div id="main-container">
			    <!--<p class="text-center" style="text-decoration:underline;"><b>DATA PROTECTION AND PRIVACY STATEMENT</b></p><br>-->
			    <p><?=$page->text_description;?></p>
			    
				<br>
				<br>

				<form action="" method="POST" class="[ text-center ]">
					<input type="submit" class="[ px-5 ][ btn btn-primary ]" name="submit" value="I have read and accept the terms above">
				</form>
			</div>
		</div>

		<script src="<?= $rootpath;?>scripts/jquery-3.4.1.min.js"></script>
		<!-- <script src="<?= $rootpath;?>scripts/popper.min.js"></script> -->
		<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
		<script src="<?= $rootpath;?>scripts/script.js?v=<?=mt_rand(0,999)?>"></script>
	</body>


	
</html>