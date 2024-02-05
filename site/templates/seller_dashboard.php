<?php
	require_once 'includes/seller-header.php';

	
	//$seller_form_submit_response=false;
// 	if($session->seller_form_submit==true){
// 	    $seller_form_submit_response="Thanks for registering with us. We would review and get back shortly!";
// 	    $session->seller_form_submit="";
// 	}
	
	if(isset($_POST['btn_seller_upload_submit'])){
//echo time();
?>
<script>
	      
    console.log("33333");
    console.log((new Date()).toUTCString());
</script>
<?php
	    $email=$session->email;
	    $seller_page=$pages->get("name=seller-profiles")->child("seller_email=".$email);
//	print_r($seller_page);
				//$data_to_return->profile_created = true;	
			
		$seller_page->gst_number = $sanitizer->text($input->post->gst_number);
		$seller_page->pan_number = $sanitizer->text($input->post->pan_number);
		$seller_page->bank_account_number = $sanitizer->text($input->post->account_number);
		$seller_page->bank_ifsc_code = $sanitizer->text($input->post->ifsc_code);
		$seller_page->address = $sanitizer->textarea($input->post->registered_address);
		$seller_page->bank_account_holder_name = $sanitizer->text($input->post->account_holder_name);
		$seller_page->account_type = $sanitizer->text($input->post->account_type);
		$seller_page->bank_name = $sanitizer->text($input->post->bank_name);
		$seller_page->bank_branch_name = $sanitizer->text($input->post->bank_branch);
		
		$seller_page->of(false);
		$seller_page->save();
		
		$upload_path = $config->paths->assets ;//. "files/temp-files/";
		
// 			foreach($files as $filename) {
// 				$pathname = $upload_path . $filename;
// 				$seller_page->document_first->add($pathname);
// 				$seller_page->message("Added file: $filename");
// 				unlink($pathname);
// 			}
			
	
		/* Uploading and saving of Resume. (Same process as image upload) */
// 		$document_first = new WireUpload('document_legal_agreement');
// //echo $resume;
// 		$document_first->setMaxFiles(1);
// 		$document_first->setOverwrite(false);
// 		$document_first->setDestinationPath($upload_path);

// 		$document_first->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

// 		$files_document_first = $document_first->execute();

// 		$is_document_first_uploaded = false;
// //echo count($files_document_first);
// 		if(!count($files_document_first) && $data_to_return->profile_to_edit){

// 		}
// 		elseif(!count($files_document_first)){
// // 			$data_to_return->error = true;
// // 			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
// 		}
// 		else{
// 			if($seller_page->document_first){
// 			    $seller_page->of(false);
// 				$seller_page->document_first->deleteAll();
				
// 				$seller_page->save();
// 			}
//         //$seller_file=$seller_page->document_first;
// 			foreach($files_document_first as $filename) {
// 				$pathname = $upload_path . $filename;
// 				//echo $pathname;
// 				//$seller_file->add($filename,$pathname);
// 				//echo $seller_file;
// 					$seller_page->of(false);
// 				$seller_page->document_first->add($pathname);
// 				$seller_page->of(false);
// 				$seller_page->save();
                    
// 				$seller_page->message("Added file:".$filename);
// 				unlink($pathname);
// 			}

// 			$is_document_first_uploaded = true;
// 		}
		/* Uploading and saving of Resume END */
		
/* Uploading and saving of Resume. (Same process as image upload) */
		$document_second = new WireUpload('document_onboarding_form');
//echo $resume;
// echo "1";
// echo time();
// echo "\n";
		$document_second->setMaxFiles(1);
		$document_second->setOverwrite(false);
		$document_second->setDestinationPath($upload_path);
// echo "2";
// echo time();
// echo "\n";
		$document_second->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_second = $document_second->execute();

		$is_document_second_uploaded = false;
//echo count($files_document_second);
// 		if(!count($files_document_second) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_second)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
		}
		else{
			if($seller_page->document_second){
			    $seller_page->of(false);
				$seller_page->document_second->deleteAll();
// echo "3";
// echo time();
// echo "\n";
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_second as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
					$seller_page->of(false);
				$seller_page->document_second->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
// echo "4";
// echo time();  
// echo "\n";
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_second_uploaded = true;
		}
		/* Uploading and saving of Resume END */
		
/* Uploading and saving of Document third. (Same process as image upload) */
		$document_third = new WireUpload('document_pan');
//echo $resume;
// echo "5";
// echo time();
// echo "\n";
		$document_third->setMaxFiles(1);
		$document_third->setOverwrite(false);
		$document_third->setDestinationPath($upload_path);

		$document_third->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_third = $document_third->execute();

		$is_document_third_uploaded = false;
//echo count($files_document_third);
// 		if(!count($files_document_third) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_third)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your Document.";
		}
		else{
			if($seller_page->document_third){
			    $seller_page->of(false);
				$seller_page->document_third->deleteAll();
				
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_third as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
					$seller_page->of(false);
				$seller_page->document_third->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
//  echo "6";
// echo time(); 
// echo "\n";
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_third_uploaded = true;
		}
/* Uploading and saving of Document third END */

/* Uploading and saving of Document four. (Same process as image upload) */
		$document_fourth = new WireUpload('document_gst');
//echo $resume;
		$document_fourth->setMaxFiles(1);
		$document_fourth->setOverwrite(false);
		$document_fourth->setDestinationPath($upload_path);

		$document_fourth->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_fourth = $document_fourth->execute();

		$is_document_fourth_uploaded = false;
//echo count($files_document_fourth);
// 		if(!count($files_document_fourth) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_fourth)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your Document.";
		}
		else{
			if($seller_page->document_fourth){
			    $seller_page->of(false);
				$seller_page->document_fourth->deleteAll();
				
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_fourth as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
					$seller_page->of(false);
				$seller_page->document_fourth->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
                    
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_fourth_uploaded = true;
		}
/* Uploading and saving of document_fourth END */

		/* Uploading and saving of Resume. (Same process as image upload) */
		$document_fifth = new WireUpload('document_pan_directors');
//echo $resume;
		$document_fifth->setMaxFiles(1);
		$document_fifth->setOverwrite(false);
		$document_fifth->setDestinationPath($upload_path);

		$document_fifth->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_fifth = $document_fifth->execute();

		$is_document_fifth_uploaded = false;
//echo count($files_document_first);
// 		if(!count($files_document_fifth) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_fifth)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
		}
		else{
			if($seller_page->document_fifth){
			    $seller_page->of(false);
				$seller_page->document_fifth->deleteAll();
				
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_fifth as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
					$seller_page->of(false);
				$seller_page->document_fifth->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
                    
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_fifth_uploaded = true;
		}
		/* Uploading and saving of Resume END */
		
			/* Uploading and saving of Resume. (Same process as image upload) */
		$document_sixth = new WireUpload('document_cancelled_cheque');
//echo $resume;
		$document_sixth->setMaxFiles(1);
		$document_sixth->setOverwrite(false);
		$document_sixth->setDestinationPath($upload_path);

		$document_sixth->setValidExtensions(array('pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif'));

		$files_document_sixth = $document_sixth->execute();

		$is_document_sixth_uploaded = false;
//echo count($files_document_first);
// 		if(!count($files_document_sixth) && $data_to_return->profile_to_edit){

// 		}
// 		else
		if(!count($files_document_sixth)){
// 			$data_to_return->error = true;
// 			$data_to_return->error_text[] = "No resume uploaded. Please upload your resume.";
		}
		else{
			if($seller_page->document_sixth){
			    $seller_page->of(false);
				$seller_page->document_sixth->deleteAll();
				
				$seller_page->save();
			}
        //$seller_file=$seller_page->document_first;
			foreach($files_document_sixth as $filename) {
				$pathname = $upload_path . $filename;
				//echo $pathname;
				//$seller_file->add($filename,$pathname);
				//echo $seller_file;
				$seller_page->of(false);
				$seller_page->document_sixth->add($pathname);
				$seller_page->of(false);
				$seller_page->save();
                    
				$seller_page->message("Added file:".$filename);
				unlink($pathname);
			}

			$is_document_sixth_uploaded = true;
		}
		/* Uploading and saving of Resume END */
		/* Save the page with uploaded files. */
		$seller_page->of(false);
		$seller_page->save();
//echo time();		
	//	$session->seller_form_submit=true;
//	$seller_form_submit_response=true;
                						         
		//if($seller_form_submit_response==true){
		     ?>
	        <script>
	      
  		// $('#education-next').attr('disabled', 'false');
  		// $('#education-next').html('Submit');
	        console.log("11111");
	        console.log((new Date()).toUTCString());
	   //     console.log("
	       // var redirect="true";
	   // universe/?universal_logout=true");
	    alert("Thanks for registering with us. We would review and get back shortly!");
	   //// header("Location: ".$urls->httpRoot?>"universe/?universal_logout=true");
	       window.location.href="<?=$urls->httpRoot?>universe/?universal_logout=true";
	        //window.location.href="http://zerovaega.in/pc_rportal/universe/";
	        
	        </script>
	        <?php
	      // }
	    
	}
	
	
	
	
	

?>


				<!-- Begin Page Content -->
				<div class="container-fluid">
	<?php
//	if($seller_form_submit_response==true){
		     ?>
	        <script>
	      
  		// $('#education-next').attr('disabled', 'false');
  		// $('#education-next').html('Submit');
	   //     console.log("11111");
	   //     console.log((new Date()).toUTCString());
	   ////     console.log("
	       // var redirect="true";
	   // universe/?universal_logout=true");
	   // alert("Thanks for registering with us. We would review and get back shortly!");
	   //// header("Location: ".$urls->httpRoot?>"universe/?universal_logout=true");
	       //window.location.href="<?=$urls->httpRoot?>universe/?universal_logout=true";
	        //window.location.href="http://zerovaega.in/pc_rportal/universe/";
	        
	        </script>
	        <?php
	       //}
	       ?>

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800"></h1>
					</div>


					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ]">
						    <h3 style="margin-bottom: 0px !important;"><?=$page->title;?></h3>
                        </div>
                        
                        <?php
                             $email=$session->email;
                            $seller_page=$pages->get("name=seller-profiles")->child("seller_email=".$email);
                            
                            $document_first_uploaded=false;
                            $document_second_uploaded=false;
                            $document_third_uploaded=false;
                            $document_fourth_uploaded=false;
                            $document_fifth_uploaded=false;
                            $document_sixth_uploaded=false;
                            
                            $document_first_border="danger";
                            $document_second_border="danger";
                            $document_third_border="danger";
                            $document_fourth_border="danger";
                            $document_fifth_border="danger";
                            $document_sixth_border="danger";
                            
                            // if(count($seller_page->document_first)){
                            //     $document_first_uploaded=true;
                            //         $document_first_border="primary";
                            // }
                            if(count($seller_page->document_second)){
                                $document_second_uploaded=true;
                                $document_second_border="primary";
                            }
                            if(count($seller_page->document_third)){
                                $document_third_uploaded=true;
                                    $document_third_border="primary";
                            }
                            if(count($seller_page->document_fourth)){
                                $document_fourth_uploaded=true;
                                $document_fourth_border="primary";
                            }
                            if(count($seller_page->document_fifth)){
                                $document_fifth_uploaded=true;
                                $document_fifth_border="primary";
                            }
                            if(count($seller_page->document_sixth)){
                                $document_sixth_uploaded=true;
                                $document_sixth_border="primary";
                            }
                            
                        ?>
                        
                        <div class="row px-3 pt-3">

    						<!-- Earnings (Monthly) Card Example -->

    						<!-- Earnings (Monthly) Card Example -->
    						<!--<div class="col-xl-3 col-md-6 mb-4">-->
    						<!--	<div class="card border-left-<?=$document_first_border;?> shadow h-100 py-2">-->
    								<!--<div class="card-body">-->
    								<!--	<div class="row no-gutters align-items-center">-->
    								<!--		<div class="col mr-2">-->
    								<!--			<div class="text-xs font-weight-bold text-<?=$document_first_border;?> text-uppercase mb-1">Legal Agreement with Pride Circle</div>-->
    								<!--			<div class="row no-gutters align-items-center">-->
    								<!--				<div class="col-auto">-->
    								<!--					<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">-->
    													<?php if($document_first_uploaded){
        													    //echo "Submitted";
        													}
        													else{
        													    //echo "Not submitted";
        													}
    													?> 
    												<!--	</div>-->
    												<!--</div>-->
    										<!--		<div class="col">-->
    													<!-- <div class="progress progress-sm mr-2">
    										<!--				<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>-->
    										<!--			</div> -->
    										<!--		</div>-->
    										<!--	</div>-->
    										<!--</div>-->
    										<!--<div class="col-auto">-->
    											
    											<?php if($document_first_uploaded){
        													    //echo '<i class="fas fa-check fa-2x text-gray-300"></i>';
        													}
        													else{
        													   // echo '<i class="fas fa-times fa-2x text-gray-300"></i>';
        													}
    													?>
    						<!--				</div>-->
    						<!--			</div>-->
    						<!--		</div>-->
    						<!--	</div>-->
    						<!--</div>-->
    
    						<!-- Pending Requests Card Example -->
    						<div class="col-xl-3 col-md-6 mb-4">
    							<div class="card border-left-<?=$document_second_border;?> shadow h-100 py-2">
    								<div class="card-body">
    									<div class="row no-gutters align-items-center">
    										<div class="col mr-2">
    											<div class="text-xs font-weight-bold text-<?=$document_second_border;?> text-uppercase mb-1">Onboarding form</div>
    											<div class="row no-gutters align-items-center">
    												<div class="col-auto">
    													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php if($document_second_uploaded){
        													    echo "Submitted";
        													}
        													else{
        													    echo "Not submitted";
        													}
    													?> </div>
    												</div>
    												<div class="col">
    													<!-- <div class="progress progress-sm mr-2">
    														<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    													</div> -->
    												</div>
    											</div>
    										</div>
    										<div class="col-auto">
    											
    											<?php if($document_second_uploaded){
        													    echo '<i class="fas fa-check fa-2x text-gray-300"></i>';
        													}
        													else{
        													    echo '<i class="fas fa-times fa-2x text-gray-300"></i>';
        													}
    													?>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						
    						<!-- Pending Requests Card Example -->
    						<div class="col-xl-3 col-md-6 mb-4">
    							<div class="card border-left-<?=$document_third_border;?> shadow h-100 py-2">
    								<div class="card-body">
    									<div class="row no-gutters align-items-center">
    										<div class="col mr-2">
    											<div class="text-xs font-weight-bold text-<?=$document_third_border;?> text-uppercase mb-1">PAN for shop</div>
    											<div class="row no-gutters align-items-center">
    												<div class="col-auto">
    													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php if($document_third_uploaded){
        													    echo "Submitted";
        													}
        													else{
        													    echo "Not submitted";
        													}
    													?> </div>
    												</div>
    												<div class="col">
    													<!-- <div class="progress progress-sm mr-2">
    														<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    													</div> -->
    												</div>
    											</div>
    										</div>
    										<div class="col-auto">
    											
    											<?php if($document_third_uploaded){
        													    echo '<i class="fas fa-check fa-2x text-gray-300"></i>';
        													}
        													else{
        													    echo '<i class="fas fa-times fa-2x text-gray-300"></i>';
        													}
    													?>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						
    						<!-- Pending Requests Card Example -->
    						<div class="col-xl-3 col-md-6 mb-4">
    							<div class="card border-left-<?=$document_fourth_border;?> shadow h-100 py-2">
    								<div class="card-body">
    									<div class="row no-gutters align-items-center">
    										<div class="col mr-2">
    											<div class="text-xs font-weight-bold text-<?=$document_fourth_border;?> text-uppercase mb-1">GST for shop</div>
    											<div class="row no-gutters align-items-center">
    												<div class="col-auto">
    													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php if($document_fourth_uploaded){
        													    echo "Submitted";
        													}
        													else{
        													    echo "Not submitted";
        													}
    													?> </div>
    												</div>
    												<div class="col">
    													<!-- <div class="progress progress-sm mr-2">
    														<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    													</div> -->
    												</div>
    											</div>
    										</div>
    										<div class="col-auto">
    											
    											<?php if($document_fourth_uploaded){
        													    echo '<i class="fas fa-check fa-2x text-gray-300"></i>';
        													}
        													else{
        													    echo '<i class="fas fa-times fa-2x text-gray-300"></i>';
        													}
    													?>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						
    							<!-- Pending Requests Card Example -->
    						<div class="col-xl-3 col-md-6 mb-4">
    							<div class="card border-left-<?=$document_fifth_border;?> shadow h-100 py-2">
    								<div class="card-body">
    									<div class="row no-gutters align-items-center">
    										<div class="col mr-2">
    											<div class="text-xs font-weight-bold text-<?=$document_fifth_border;?> text-uppercase mb-1">PAN of the Director/s</div>
    											<div class="row no-gutters align-items-center">
    												<div class="col-auto">
    													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php if($document_fifth_uploaded){
        													    echo "Submitted";
        													}
        													else{
        													    echo "Not submitted";
        													}
    													?> </div>
    												</div>
    												<div class="col">
    													<!-- <div class="progress progress-sm mr-2">
    														<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    													</div> -->
    												</div>
    											</div>
    										</div>
    										<div class="col-auto">
    											
    											<?php if($document_fifth_uploaded){
        													    echo '<i class="fas fa-check fa-2x text-gray-300"></i>';
        													}
        													else{
        													    echo '<i class="fas fa-times fa-2x text-gray-300"></i>';
        													}
    													?>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						
    							<!-- Pending Requests Card Example -->
    						<div class="col-xl-3 col-md-6 mb-4">
    							<div class="card border-left-<?=$document_sixth_border;?> shadow h-100 py-2">
    								<div class="card-body">
    									<div class="row no-gutters align-items-center">
    										<div class="col mr-2">
    											<div class="text-xs font-weight-bold text-<?=$document_sixth_border;?> text-uppercase mb-1">Cancelled cheque</div>
    											<div class="row no-gutters align-items-center">
    												<div class="col-auto">
    													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php if($document_sixth_uploaded){
        													    echo "Submitted";
        													}
        													else{
        													    echo "Not submitted";
        													}
    													?> </div>
    												</div>
    												<div class="col">
    													<!-- <div class="progress progress-sm mr-2">
    														<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    													</div> -->
    												</div>
    											</div>
    										</div>
    										<div class="col-auto">
    											
    											<?php if($document_sixth_uploaded){
        													    echo '<i class="fas fa-check fa-2x text-gray-300"></i>';
        													}
        													else{
        													    echo '<i class="fas fa-times fa-2x text-gray-300"></i>';
        													}
    													?>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						
    					</div>
                        <?php
                       
                           
                        
                        ?>
                        <div id="table_container_card_body" class="card-body">
                          <div class="mobile_div">
                            <form id="main-container" class="[ my-5 px-sm-5 ][ container rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
                                 <!--<div id="additional-tab" class="[ tab-pane fade ]" role="tabpanel" aria-labelledby="additional-tab">-->
                                 <?php 
                                 //echo $config->urls->httpRoot."universe/api/seller-uploading-form/";
                                 ?>
                        			<div class="[ my-5 ][ text-center ]">
                        				<h3>Document Upload</h3>
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                    				    <label for="gst_number">GST Number of Shop </label>
                    					<input type="text"  id="gst_number" name="gst_number" class="form-control" pattern="[0-9a-zA-Z]{15}"  placeholder="GST Number" value="<?=$seller_page->gst_number;?>" maxlength="15"  />
                    
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid GST number.
                    					</div>
                        			
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                    				    <label for="pan_number">PAN Number of Shop </label>
                    					<input type="text" id="pan_number" name="pan_number" class="form-control" pattern="[0-9a-zA-Z]{10}"   placeholder="PAN Number" value="<?=$seller_page->pan_number;?>"  maxlength="10"  />
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid PAN number.
                    					</div>
                        			
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                    				    <label for="registered_address">Registered Address of Shop<span style="color:red;">*</span> </label>
                    					<textarea  id="registered_address" name="registered_address" class="form-control" rows="2" required /><?=$seller_page->address;?></textarea>
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid Registered Address.
                    					</div>
                        			
                        			</div>
                        			<h5><b>Bank Details</b></h5>
                        			<div class="[ my-1 ][ form-group ]">
                    				    <label for="account_number">Account Number<span style="color:red;">*</span> </label>
                    					<input type="text" id="account_number" name="account_number" class="form-control"   placeholder="Account Number" value="<?=$seller_page->bank_account_number;?>" required />
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid Account number.
                    					</div>
                        			
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                    				    <label for="account_holder_name">Account Holder's Name<span style="color:red;">*</span> </label>
                    					<input type="text" id="account_holder_name" name="account_holder_name" class="form-control" placeholder="Account Holder's Name" value="<?=$seller_page->bank_account_holder_name;?>"  required />
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid Account Holder's Name.
                    					</div>
                        			
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                    				    <label for="ifsc_code">IFSC Code<span style="color:red;">*</span> </label>
                    					<input type="text" id="ifsc_code" name="ifsc_code" class="form-control"   placeholder="IFSC Code" value="<?=$seller_page->bank_ifsc_code;?>" required />
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid IFSC code.
                    					</div>
                        			
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                    				    <label for="account_type">Account Type<span style="color:red;">*</span> </label>
                    					<input type="text" id="account_type" name="account_type" class="form-control"   placeholder="Account Type" value="<?=$seller_page->account_type;?>" required />
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid Account type.
                    					</div>
                        			
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                    				    <label for="bank_name">Bank Name<span style="color:red;">*</span> </label>
                    					<input type="text"  id="bank_name" name="bank_name" class="form-control"  placeholder="Bank Name" value="<?=$seller_page->bank_name;?>"  required/>
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid Bank name.
                    					</div>
                        			
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                    				    <label for="bank_branch">Bank Branch<span style="color:red;">*</span> </label>
                    					<input type="text"  id="bank_branch" name="bank_branch" class="form-control"  placeholder="Bank Branch" value="<?=$seller_page->bank_branch_name;?>"  required/>
                    
                    					<div class="invalid-tooltip">
                    						Please enter valid Bank branch.
                    					</div>
                        			
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                        			    <!--<a href="<?=$pages->get("name=seller-profiles")->document_first->first()->httpUrl;?>" id="upload_document_first" class="[ mb-3 ]" target='_blank' title="">Download Legal Agreement with Pride Circle</a><br>-->
                        			    <!--<a href="<?=$rise_sponsorship_files->httpUrl;?>" target="_blank"><button class="btn btn-outline-primary">Download Legal Agreement with Pride Circle <i class="fa fa-arrow-circle-down" aria-hidden="true" style="padding-left:9px;"></i></button></a><br><br>-->
                        			    <!--<div class="text-success">-->
                        			    <?php
                        			    if($document_first_uploaded){
											    //echo "(Already uploaded. You can replace it by uploading again.)";
											}
											else{
											    //echo "";
											}
        								?>
        								<!--</div><br>-->
                <!--        				<label>Signed Legal Agreement with Pride Circle</label>-->
                        
                <!--        				<div class="custom-file">-->
                <!--        					<input  id="document_legal_agreement" name="document_legal_agreement" class="custom-file-input" type="file" >-->
                <!--        					<label id="document_legal_agreement_label" class="custom-file-label" for="document_legal_agreement">PDF or MS Word files only</label>-->
                        
                <!--        					<div class="invalid-tooltip">-->
                <!--        						Please upload a valid document.-->
                <!--        					</div>-->
                <!--        				</div>-->
                <!--        			</div>-->
                        
                        			<div class="[ my-5 ][ form-group ]">
                        			    <a href="<?=$pages->get("name=seller-profiles")->document_second->first()->httpUrl;?>"  class="[ mb-3 ]" target='_blank' title="">Download Onboarding Document</a><br>
                        			    <div class="text-success">
                        			    <?php
        //                 			    if($document_second_uploaded){
								// 			    echo "(Already uploaded. You can replace it by uploading again.)";
								// 			}
								// 			else{
								// 			    echo "";
								// 			}
        								?>
        								</div><br>
                        			    
                        				<label>Signed Onboarding Document<span style="color:red;">*</span> </label>
                        
                        				<div class="custom-file">
                        					<input type="file"  id="document_onboarding_form" name="document_onboarding_form" class="custom-file-input"  required />
                        					<label id="document_onboarding_form_label" class="custom-file-label" for="document_onboarding_form">PDF, MS Word, JPG, JPEG, PNG files only</label>
                        					<!--pdf', 'docx', 'doc','jpg', 'jpeg', 'png', 'gif-->
                        
                        					<div class="invalid-tooltip">
                        						Please upload a valid document.
                        					</div>
                        				</div>
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                        				<label>PAN for Shop </label>
                        
                        				<div class="custom-file">
                        					<input type="file" id="document_pan" name="document_pan" class="custom-file-input"   />
                        					<label id="document_pan_label" class="custom-file-label" for="document_pan">PDF, MS Word, JPG, JPEG, PNG files only</label>
                        
                        					<div class="invalid-tooltip">
                        						Please upload a valid document.
                        					</div>
                        				</div>
                        			</div>
                        			<div class="[ my-5 ][ form-group ]">
                        				<label>GST for Shop </label>
                        
                        				<div class="custom-file">
                        					<input type="file"  id="document_gst" name="document_gst" class="custom-file-input"  />
                        					<label id="document_gst_label" class="custom-file-label" for="document_gst">PDF, MS Word, JPG, JPEG, PNG files only</label>
                        
                        					<div class="invalid-tooltip">
                        						Please upload a valid document.
                        					</div>
                        				</div>
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                        				<label>PAN of the Director/s<span style="color:red;">*</span> </label>
                        
                        				<div class="custom-file">
                        					<input type="file"  id="document_pan_directors" name="document_pan_directors" class="custom-file-input"  required />
                        					<label id="document_pan_directors_label" class="custom-file-label" for="document_pan_directors">PDF, MS Word, JPG, JPEG, PNG files only</label>
                        
                        					<div class="invalid-tooltip">
                        						Please upload a valid document.
                        					</div>
                        				</div>
                        			</div>
                        			
                        			<div class="[ my-5 ][ form-group ]">
                        				<label>Cancelled Cheque<span style="color:red;">*</span> </label>
                        
                        				<div class="custom-file">
                        					<input type="file" id="document_cancelled_cheque" name="document_cancelled_cheque" class="custom-file-input" required  />
                        					<label id="document_cancelled_cheque_label" class="custom-file-label" for="document_cancelled_cheque">PDF, MS Word, JPG, JPEG, PNG files only</label>
                        
                        					<div class="invalid-tooltip">
                        						Please upload a valid document.
                        					</div>
                        				</div>
                        			</div>
                        			
                        			<!--<div class="[ my-5 ][ form-group ]">-->
                        				<!--<label>Cancelled Cheque<span style="color:red;">*</span> </label>-->
                        
                        				<!--<div class="custom-file">-->
                        			<!--		<div class="form-check">-->
                           <!--                   <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>-->
                           <!--                   <label class="form-check-label" for="flexCheckDefault">-->
                           <!--                     Terms and condition-->
                           <!--                   </label>-->
                           <!--                 </div>-->
                        
                        			<!--		<div class="invalid-tooltip">-->
                        			<!--			Please select checkbox.-->
                        			<!--		</div>-->
                        				<!--</div>-->
                        			<!--</div>-->
                        			

                        
                        			<!-- Buttons Section -->
                        			<div class="[ d-flex flex-row justify-content-center mb-4 ]">
                        				<!--<button type="button" id="education-back" class="[ btn btn-outline-primary ]( btn-back )" href="#employment-tab">-->
                        				<!--	<i class="fas fa-arrow-left mr-2"></i>Back-->
                        				<!--</button>-->
                                           
<script>
	      
    console.log("22222");
    console.log((new Date()).toUTCString());
</script>

                        				<button type="submit" name="btn_seller_upload_submit" value="submit" id="education-next" class="[ btn btn-primary ]( btn-submit )" >
                        					Submit
    <script>
    // $(this).html('Uploading...');
                        					  console.log("4444444");
    console.log((new Date()).toUTCString());
</script>
                        				</button>
                        				
                        				
	      
  
                        				<?php 
                						    //if($seller_form_submit_response==""){?>
                						        <script>
                						      //   $('#education-next').html('Uploading...');
  			                       //                 $('#education-next').attr('disabled', 'true');
                						     
                						        console.log("11111");
                						        //window.location.href="<?=$urls->httpRoot?>universe/?universal_logout=true";
                						        //window.location.href="http://zerovaega.in/pc_rportal/universe/";
                						        
                						        </script>
                						 <?php
                						   // }
                						
                						 ?>
                        			</div>
                        				<p class="text-center">(After clicking submit, please wait for the files to be uploaded.)</p>
                        			<!-- Buttons Section End -->
                        		<!--</div>-->
                        		   
			                    </form>
			                 </div>
                    <!--    </div>-->
                    <!--</div>-->
                        
					<!-- Content Row -->
					<!--<div class="container">-->
					    <!--<p><?=$page->text_description;?></p>-->
					    <!--<p><b>Pride Circle Corporate Dashboard</b></p>-->
					    <!--<p>A newly developed initiative/ A new digital hub/initiative by Pride Circle that enables an all-in-one management of their every engagement through this single platform.</p>-->
					    <!--<p>We have several exciting programs lined up for the next 12 months. </p>-->
					    <!--<p>To have a look at our list of events for the year and know more about each program, enlist your organisation on the Pride Circle Corporate Dashboard.</p>-->
					    <!--<p>Happy Pride!</p>-->
					<!--</div>-->

					<!-- Content Row -->

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<!--<footer class="sticky-footer bg-white">-->
			<!--	<div class="container my-auto">-->
			<!--		<div class="copyright text-center my-auto">-->
						<!--<span>Copyright &copy; Pride Circle 2019</span>-->
			<!--			<div class="[ text-center ]">-->
   <!--                 		<img height="95px" src="<?=$rootpath?>images/pride_circle_logo.jpg" alt="">-->
   <!--                 	</div>-->
   <!--                 	<div class="[ mt-3 ][ text-center ]">-->
   <!--                 	    <span>-->
   <!--                 	    In case of any questions, please email us at <a href="mailto:rise@thepridecircle.com?Subject=Query%20Regarding%20the%20Resume%20Upload%20Portal" title="Mail Us">rise@thepridecircle.com</a></span>-->
   <!--                 	</div>-->
                    
   <!--                 	<div class="[ mt-3 ][ text-center  ]">-->
   <!--                 	     <span>-->
   <!--                 		Developed By  <a href="mailto:todkar.amrut27897@gmail.com" target="_blank">ProAutomater</a></span>-->
   <!--                 	</div>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</footer>-->
			<!-- End of Footer -->
			
			<?php
    			include 'includes/general_seller_footer.php';
    		?>

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="<?=$page->url?>?logout=true">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= $rootpath;?>scripts/sb-admin-2.min.js"></script>

<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=<?=mt_rand(100,1000)?>" type="text/javascript"></script>
	<!-- Page level plugins -->
	<script src="<?=$rootpath?>scripts/chart.min.js"></script>


</body>
</html>