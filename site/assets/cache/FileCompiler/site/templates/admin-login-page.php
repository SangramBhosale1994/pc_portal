<?php
// 	if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
// 	{
// 		//Tell the browser to redirect to the HTTPS URL.
// 		header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
// 		//Prevent the rest of the script from executing.
// 		exit;
// 	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?=$page->title?></title>

	<!-- Custom fonts for this template -->
	<!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
	<script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?= $urls->httpTemplates;?>styles/sb-admin-2.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="<?= $urls->httpTemplates;?>styles/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
	<?php
		/* Error to show to the user in case of failed login */
		$error_to_show = "";

/* TODO Manage the logout */
		/* Check if GET has logout request */
		if($input->get('admin_logout', ["true"], false)){
			/* Empty the session variables */
			$session->user_email = "";
			$session->user_designation = "";
/* TODO remove the whole session */
		}

		/* Check if already logged in */
		if($session->user_designation == "admin" ){
			/* Redirect to the admin dashboard */
			$session->redirect($pages->get("name=pc-admin")->httpUrl);
		}

		/* Check if login Email ID is submitted */
		if(isset($_POST['admin_email'])){
			/* Save posted values in variables. Sanitize email before saving. */
			$admin_email_to_verify = $input->post('admin_email', "email", false);
			$admin_password_to_verify = $input->post('admin_password');

			/* Check if both posted values are proper */
			if($admin_email_to_verify && $admin_password_to_verify){
				/* Find the admin profile with the same email and password */
				$matching_admin_profile = $pages->get("name=admins")->child("email=".$sanitizer->selectorValue($admin_email_to_verify).",password=".$admin_password_to_verify);

				if($matching_admin_profile->id){
					/* Save Page ID of the logged in account to the session */
					$session->user_page_id = $matching_admin_profile->id;

					/* Save the email ID into the session */
				 	$session->user_email = $admin_email_to_verify;

				 	/* Specify that this ession belongs to an admin */
				 	$session->user_designation = "admin";

				 	/* Redirect to the admin dashboard */
				 	$session->redirect($pages->get("name=pc-admin")->httpUrl);
				}
				else{
					/* Profile Has not been found. Error to show is changed */
					$error_to_show = "Login failed. Please try again.";
				}
			}
		}
	?>

	<div class="[ container ]">
		<div class="[ row ]">
			<div class="[ col-12 ][ py-5 ][ text-center ]">
				<h1>Admin Login</h1>

				<?php
					if ($error_to_show){
				?>
					<span class="[ px-3 py-1 ][ bg-danger text-light rounded ]"><?=$error_to_show?></span>
				<?php
					}
				?>

			</div>

			<form class="[ offset-md-4 col-md-4 ][ p-2 ][ rounded border-dark ]" action="<?=$page->url?>" method="POST" accept-charset="utf-8">
				<div class="[ form-group ]">
					<label for="admin_email">Login ID</label>

					<input id="admin_email" class="form-control" type="text" name="admin_email" placeholder="Email ID">
				</div>

				<div class="[ form-group ]">
					<label for="admin_password">Password</label>

					<input id="admin_password" class="form-control" type="password" name="admin_password" placeholder="Password">
				</div>

				<div class="[ form-group ][ text-center ]">
					<input id="admin_submit" class="[ btn btn-lg btn-primary ][ px-5 mt-5 ]" type="submit" name="login" value="Login">
				</div>
			</form>
		</div>
	</div>