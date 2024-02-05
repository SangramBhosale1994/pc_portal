<?php
	$rootpath = $config->urls->templates;

	// if($session->email == "" || $session->company_name == ""){
	if($session->email == ""){
		$session->redirect($pages->get("name=universe")->httpUrl);
	}

	$user_email = $session->email;
	$user_page = $pages->get("name=universal-profiles")->child("email={$user_email}");
	
	if($user_page->id != 0 && $user_page->privacy_policy_acceptance != "accepted"){
		$session->redirect($pages->get("name=universal-privacy-statement")->httpUrl);
	}


?>
<!DOCTYPE html>
<html>
	<head>
		

		<?php
			include 'includes/general_header.php';

			if($session->verification !== "verified"){
				if($user_page->id == 0){
		?>

		<div class=" [ text-center ] container mt-5 p-4">
			<h2>Could not log you in!</h2>
			<h4 class="[ text-muted ]">Please contact the website administrators.</h4>
		</div>

		<?php
				}

				$session->verification = $user_page->verification;
			}
			else{
				$user_email = $session->email;
				$user_page = $pages->get("name=universal-profiles")->child("email={$user_email}");


			}
		?>

		<div class="[ mt-5 pt-4 ][ container ]">
			<!--<div class="[ mb-5 ]" style="font-size: 1.2rem"><?=$session->applicant_name?> <br><?=$session->company_name?>-->
			<!--</div>-->

			<div class="[ d-flex justify-content-end ]">
				<!--<div>-->
					<?php
						if($session->verification == "verified"){
					?>

					<!--<button id="dow" class="[ px-4 ][ btn btn-outline-primary ]" type="button">Download Survey</button>-->
					
					<?php
						}
					?>
				<!--</div>-->

				<div>
					<a class="[ px-4 ][ btn btn-outline-primary ]" style="position: absolute;top: 39%;right: 10%;" href="<?=$pages->get("name=universal-logout")->httpUrl?>">Logout</a>
				</div>
			</div>
		</div>

		<?php

			if($session->verification !== "verified"){
		?>

		<div class=" [ text-center ] container mt-5 p-4">
			<h2>Thank you for Signing Up!</h2>
			<p>Your registration is currently under review and you will be notified within the next 48 hours on your registered email ID once the verification is complete.</p>
			<p>In the meantime, learn more about us at <a href="http://www.thepridecircle.com/">www.thepridecircle.com</a> and catch a glimpse of RISE 2019 and 2020</p>
			<!--<p>While we work towards the completion of your registration, catch a glimpse of RISE 2019 and 2020 here:</p>-->
			<!--<h4 class="[ text-muted ]">You will be able to fill-in the survey once verified.</h4>-->
			<div class="row">
			    <div class="col-md-6">
			        <iframe width="520" height="415" style="margin-top:38px;"
                        src="https://www.youtube.com/embed/9N8t7KUevGI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
			            <!--https://www.youtube.com/embed/v=9N8t7KUevGI&feature=youtu.be-->
                    </iframe>
			    </div>
			    <div class="col-md-6">
			        <iframe width="520" height="415" style="margin-top:38px;"
                        src="https://www.youtube.com/embed/Rw_J8b4EiyI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
			    </div>
			</div>
		
		</div>

		<?php
			}
		
		?>

	
		<script src="<?= $rootpath;?>scripts/jquery-3.4.1.min.js"></script>
		<!-- <script src="<?= $rootpath;?>scripts/popper.min.js"></script> -->
		<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
		<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
		<script src="<?= $rootpath;?>scripts/script.js?v=<?=mt_rand(0,999)?>"></script>
		<?php
			include 'includes/general_footer.php';
		?>
	</body>
    

	
</html>