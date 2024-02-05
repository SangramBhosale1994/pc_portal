<?php
	require_once 'includes/admin-header.php';
  	/* Execution time is 10 minutes */
	ini_set('max_execution_time', 600);
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	require 'vendor/autoload.php';

  if(isset($_POST["btn_upload_resume"])){

    global $to_return;
    	/* Save Uploaded images */
		/* Define the temporary path to upload the file before saving the files to the CMS page */
		$upload_path = wire("config")->paths->assets."uploaded_resumes";//. "files/temp-files/";
    // echo $upload_path;
    // echo "****";
    // $to_return->upload_path = $upload_path;
    $bulk_candidate_resume_page=$pages->get("name=candidate-bulk-resume-upload");
    // echo $bulk_candidate_resume_page->file->url;
    /** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
		$file = new WireUpload('candidate_excel');
    //print_r($job_image);
      if($file!=""){
        /** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
        $file->setMaxFiles(1);
        $file->setOverwrite(true);
        $file->setDestinationPath($upload_path);
        $file->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif','xls', 'xlsx','pdf', 'docx', 'doc'));
    
        /** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
        $files = $file->execute();
        
        
           /**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
    
          foreach($files as $filename) {
    
            $pathname = $upload_path . $filename;
    // echo $pathname;
            // $bulk_candidate_resume_page->file->add($pathname);
    
            // $bulk_candidate_resume_page->message("Added file: $filename");
    
            // unlink($pathname);
          }


        /* Uploading and saving of profile image */
    // $to_return->files =[];
    // print_r($_FILES);
        /* iterate through sent images in$_FILES */
    //     foreach ($_FILES as $file_key => $file_value) {
    //       if($file_value["tmp_name"] !== ""){
    
    //         /** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
    //         $contact_photo = new WireUpload($file_key);
    // // $to_return->files[] = $file_key;
    //         /** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
    //         $contact_photo->setMaxFiles(1);
    //         $contact_photo->setOverwrite(false);
    //         $contact_photo->setDestinationPath($upload_path);
    //         $contact_photo->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif','xls', 'xlsx','pdf', 'docx', 'doc'));
    
    //         /** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
    //         $files = $contact_photo->execute();
    //         echo "000";
    //         echo $files->name;
    //         print_r($files);
    //         echo "-----";
    //         /** Checking of errors while uploading the files. Run a count($files) test to make sure there are actually files; if so, proceed; if not, generate getErrors() */
    
    //         /* If $files contains nothing, save the error message. */
    //         if(!count($files)){
    //           $to_return->error->number_of_errors++;
    //           $to_return->error->error_message .= "Could not upload the file.";
    //         }
    //         /*** Here, $files contains a file. So we proceed to save the image file to the candidate profile page. */
    //         else{
    //           echo $bulk_candidate_resume_page->file;
    //           echo "++++";
    //           /**** Delete the previous image available if the page is being edited. */
    //           if($bulk_candidate_resume_page->$file_key){
    //             $bulk_candidate_resume_page->$file_key->deleteAll();
    //           }
    
    //           /**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
    //           foreach($files as $filename) {
    //             echo $filename;
    //             $pathname = $upload_path . $filename;
    //             echo "/////";
    //             echo $pathname;
    //             // $bulk_candidate_resume_page->file->add($pathname);
    //             // $bulk_candidate_resume_page->message("Added file: $filename");
    //             // unlink($pathname);
    //           }
    //         }
    //         /* Uploading and saving of profile image END */		
    //       }
    //     }
    
        // $bulk_candidate_resume_page->of(false);
        // $bulk_candidate_resume_page->save();

        /**Create Candidate Account */
        


	//use PhpOffice\PhpSpreadsheet\Spreadsheet;
	//use \PhpOffice\PhpSpreadsheet\Reader\IReader;
// echo "111";
$bulk_candidate_resume_page=$pages->get("name=candidate-bulk-resume-upload");
	$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
	// $spreadsheet = $reader->load("files/Data dump first batch.xlsx");
	$reader->setReadDataOnly(true);
  // echo "333";
	$spreadsheet = $reader->load($pathname);
  // $spreadsheet = $pathname;
  // echo $bulk_candidate_resume_page->file->url;
  // echo "222";
  // echo $spreadsheet;
  // echo "pp";

//print_r($spreadsheet);

	function split_name($name) {
		$name = trim($name);
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		$first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
		return array($first_name, $last_name);
	}


	$worksheet = $spreadsheet->getActiveSheet();
	$rows = $worksheet->toArray();

	$counter = 0;
	$candidates_array = Array();
	$loop_conter=0;
	foreach($rows as $key => $value) {
		$counter++;
		$canidate_info_array = Array();

		if($key == 0){
			continue;	
		}
		// key is the row count(starts from 0)
		// array of values

		$name_array = Array();
		$name_array = split_name($value[0]);

		$canidate_info_array["first_name"] = $name_array[0];
		$canidate_info_array["last_name"] = $name_array[1];
		$canidate_info_array["email"] = $value[1];
		$canidate_info_array["phone"] = $value[2];
		$canidate_info_array["identify_as"] = $value[3];
		$canidate_info_array["pronoun"] = $value[4];
		$canidate_info_array["qualification"] = $value[5];
		$canidate_info_array["experience"] = $value[6];
		$canidate_info_array["current_role"] = $value[7];
		$canidate_info_array["current_employer"] = $value[8];

		//print_r($canidate_info_array);
		$first_name = $name_array[0];
		$last_name = $name_array[1];
		$preffered_name=$value[1];
		$email = $value[2];
		if($email==""){
			echo "No email on line ".$key;
			continue;
		}
		$phone = $value[3];
		$identify_as = $value[4];
		$whatsapp_number=$value[5];
		$pronoun = $value[6];
		$current_location = $value[7];
		$current_role = $value[9];
		$previous_current_company = $value[10];
		$skills = $value[11];
		$experience = (int)$value[12];
		$qualification = $value[13];
		$current_ctc = $value[14];
		$out_at_work = $value[15];
		
		$prefix = "+91";

		if (substr($phone, 0, strlen($prefix)) == $prefix) {
		    $phone = substr($phone, strlen($prefix));
		} 

		$prefix = "91";

		if (substr($phone, 0, strlen($prefix)) == $prefix && strlen($phone)>10) {
		    $phone = substr($phone, strlen($prefix));
		} 

		/* Define a $np (New Page) variable for creating or getting page */
		$np= "";

		/* check if the page is to be created or edited */
		/** Get the page into $np if it exists already */
		if($pages->get("name=candidates")->child("oauth_gmail=".$email.",template=candidate_page")->id != 0){
			/* Get reference to the page to be edited */
			$np = $pages->get("name=candidates")->child("oauth_gmail=".$email.",template=candidate_page");

			/** Check if 'other' is selected. If yes, go for the custom input. (for pronoun, out_at_work, identify_as, qualification etc multiple choice type inputs) */
			
			//$data_to_return->profile_to_edit = true;
//  echo "<hr>account with email {$email} already exists<hr>";
// echo "<br>account with email {$email} already exists<br>";
// echo "<br>account with email {$email} already exists<br>";
			//continue;


		}
		/** Else if the page doesn't alreasy exist and this is a new entry */
		else{
			//echo "abc abc";
			/*** Basic Page Creation Info */
			$np = new Page();
			$np->template = $templates->get("candidate_page");
			$np->parent = $pages->get("name=candidates");
			$np->title = time().mt_rand(10,99);
			/*** Basic Page Creation Info End */

			/*** Save the page with unique email-ID */
			/***Amruta Jagtap Email validation - Email is proper format then create account otherwise skip this email. FILTER_VALIDATE_EMAIL this is Filter email and filter_var() is check current email is appropriate format or not. */
			// $regex = "/(gmail|yahoo|hotmail|gim|columbia)/";
			// $non_email=preg_match($regex, $email);
			$non_email=filter_var($email, FILTER_VALIDATE_EMAIL);
			if(!$non_email){
				echo "<br>".$email ." Email is not proper format";
				continue;
			}
			else{

		
			$np->oauth_gmail = $email;

			/*** Serial ID created from the ID counter page */
			/**** Get serial ID from the serial ID page */
			$serial_id_counter_page = $pages->get("name=serial_id_counter_page");
			/**** Assign the given ID to the  new page and increment the number for the next page */
			$np->serial_id = $serial_id_counter_page->serial_id++;

			/**** save the incremented ID page */
			// $serial_id_counter_page-> of(false);
			// $serial_id_counter_page->save();
			/*** Serial ID created from the ID counter page END */

			/*** Save the newly created candidate page with bare minimum requirements so that a candidate profile is created */
			// $np->of(false);
			// $np->save();

			/*** Check if the profile is actually created and saved, if true- save the success message in data_to_return object*/
			if($pages->get("name=candidates")->child("oauth_gmail=".$email.",template=candidate_page")->id != 0){
				//$data_to_return->profile_created = true;
// echo "<hr>------{$email} ------------- created<hr>";
			}
			else{
				// $data_to_return->error = true;
				// $data_to_return->error_text[] = "Something went wrong! Could not create your profile. Plese try again.";
				// echo json_encode($data_to_return);
				//exit();
				// $not_created_account=$pages->get("name=candidates")->child(("oauth_gmail=".$email.",template=candidate_page")->id == 0);
				// echo$not_created_account->count();
				$loop_conter++;
// echo "<br>{$email}";
			//continue;
			}
		}
		}
		/* Check if the page is to be created or edited END */

		/* Save the link to the profile page in the data_to_return object.  */
		//$data_to_return->profile_url = $np->httpUrl;

		/* Text Data From The Form (sanitized) */
		/* Text Data From The Form (sanitized) */
		if($np->first_name==""){
			$np->first_name = $sanitizer->text($first_name);
		}
		if($np->last_name==""){
			$np->last_name = $sanitizer->text($last_name);
		}
		if($np->preferred_name==""){
			echo "================================================";
			$np->preferred_name = $sanitizer->text($preffered_name);
		}
		if($np->email==""){
			$np->email = $sanitizer->email($email);
		}
		if($np->phone_country_code==""){
			$np->phone_country_code = $sanitizer->text("+91");
		}
		if($np->phone_number==""){
			$np->phone_number = $sanitizer->text($phone);
		}
		if($np->identify_as==""){
			$np->identify_as = $sanitizer->text($identify_as);
		}
		if($np->whatsapp_country_code==""){
			$np->whatsapp_country_code = $sanitizer->text("+91");
		}
		if($np->whatsapp_number==""){
			$np->whatsapp_number = $sanitizer->text($whatsapp_number);
		}
		if($np->pronoun==""){
			$np->pronoun = $sanitizer->text($pronoun);
		}
		if($np->current_city==""){
			$np->current_city = $sanitizer->text($current_location);
		}
		if($np->current_role==""){
			$np->current_role = $sanitizer->text($current_role);
		}
		if($np->qualification==""){
			$np->qualification = $sanitizer->text($qualification);
		}
		if($np->experience_years==""){
			$np->experience_years = $sanitizer->text($experience);
		}
		if($np->skills==""){
			$np->skills = $sanitizer->text($skills);
		}
		if($np->previous_current_company==""){
			// $np->previous_current_company = $sanitizer->text($previous_current_company);
			$np->current_employer = $sanitizer->text($previous_current_company);
			
		}
		if($np->out_at_work==""){
			
			$out_at_work=$sanitizer->text($out_at_work);
			if($out_at_work=="N" || $out_at_work=="No" || $out_at_work=="no"){
				$np->out_at_work = "No";
			}
			if($out_at_work=="Y" || $out_at_work=="Yes" || $out_at_work=="yes"){
				$np->out_at_work = "Yes";
			}

		}
		if($np->current_ctc==""){
			$np->current_ctc = $sanitizer->text($current_ctc);
		}

		//print_r($np);
		
		echo "<hr>";
		$np->active_status = "Active";
		$np->lgbtq_verification=="Unchecked";
		/* Text Data From The Form End */
// $np->of(false);
// $np->save();
// print_r($np);


	};


echo "Done.$loop_conter";
}


/**Candidate resumes upload */

$resume_files = new WireUpload('candidate_resumes');
    // print_r($resume_files);
    
    //     /** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
    //     $file->setMaxFiles(1);
    //     $file->setOverwrite(true);
    //     $file->setDestinationPath($upload_path);
    //     $file->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif','xls', 'xlsx','pdf', 'docx', 'doc'));
    
    //     /** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
    //     $files = $file->execute();
        
        
    //        /**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
    
    //       foreach($files as $filename) {
    
    //         $pathname = $upload_path . $filename;
    // echo $pathname;
    // echo "///";
            // $bulk_candidate_resume_page->file->add($pathname);
    
            // $bulk_candidate_resume_page->message("Added file: $filename");
    
            // unlink($pathname);
          // }
      // echo "files print";
      print_r($_FILES['candidate_resumes']['name']);
      // die();
      // echo "prints";
      // // print_r($_FILES[0]);
      // echo "222";
      // echo "files print";
        $resume_filename=array();
    //       /* iterate through sent images in$_FILES */
        // foreach ($_FILES as $file_key => $file_value) {
          // print_r($file_key);
          // echo "******";
          // print_r($file_value['name']);

          
          // if($file_value["tmp_name"] !== ""){
            // $candidate_email=$file_value['name'];
            /** Save the uploaded file object in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
            $contact_photo = new WireUpload('candidate_resumes');
    // $to_return->files[] = $file_key;
            /** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
            $contact_photo->setMaxFiles(50);
            $contact_photo->setOverwrite(false);
            $contact_photo->setDestinationPath($upload_path);
            $contact_photo->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif','xls', 'xlsx','pdf', 'docx', 'doc'));
    
            /** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
            $files = $contact_photo->execute();
            // echo "000";
            print_r($files);
            // die();
            // echo $file_key;
            // echo "-----";
            /** Checking of errors while uploading the files. Run a count($files) test to make sure there are actually files; if so, proceed; if not, generate getErrors() */
    
            /* If $files contains nothing, save the error message. */
            // if(!count($files)){
            //   // $to_return->error->number_of_errors++;
            //   // $to_return->error->error_message .= "Could not upload the file.";
            //   echo "Could not upload the file.";
            // }
            // /*** Here, $files contains a file. So we proceed to save the image file to the candidate profile page. */
            // else{
              $loop_counter=0;
              /**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
              // foreach($file_value['name'] as $filename_name){
                foreach($files as $filename) {
                      // foreach($file_value['name'] as $filename){
                      // echo $filename;
                      $pathname = $upload_path . $filename;
                      // echo "/////";
                      //   echo "***";
                      if(!empty($filename)){
                        // echo "111";
                        // echo $filename;
                        // echo realpath($filename), '<br>'; 
                          //echo basename($filename), '<br>';
                          $filepath=realpath($filename);
                          // echo "+++++";
                          // echo $filepath;
                          // echo "21";
                          $ext = pathinfo($filepath, PATHINFO_EXTENSION);
                          // echo $ext;
                          // echo "22";
                          $filename_name=basename($filename,".".$ext);

                          // echo $filename_name;
                          // echo "23";
                          // echo " 24";
                          
                            // $pathname = $upload_path . $filename_name;
                            $filename_name=str_replace(".pdf","",$_FILES['candidate_resumes']['name'][$loop_counter]);
                            echo $filename_name;
                            
                            $candidate_page=$pages->get("name=candidates")->child("email=".$filename_name);
                              echo "1";
          
                              echo $candidate_page;
                              if($candidate_page->id==0){
                                  echo $filename_name;
                                  
                                echo " --------------<br>";
                              }
                              // elseif($candidate_page->resume){
                              //     /**this code used for only check how many accounts or which accounts are already exists */
                              //   //  echo "already file exists ".$filename_name;
                              //   //  echo $filename_name;
                              //      $loop_counter++;
                                  
                              //     // echo " <br>";
                              //     //echo "<br>";
                              //      continue;
                              // }
                              //echo $loop_counter;
                              //echo "<hr>";
                              if($candidate_page->id!=0){
                                  if($candidate_page->email=="0207kamal@gmail.com"){
                                      continue;
                                  }
                                  if($candidate_page->email=="shrikantnikam31@gmail.com"){
                                      continue;
                                  }
                                  echo "2";
                                  echo "++++";
                                  echo $candidate_page->id;
                            echo "<br>";
                            echo $pathname;
                                  $candidate_page->of(false);
                                  /**Delete code is used for you override the new resume on existing resume */
                                  //echo "old ".$candidate_page->resume;
                                  echo "delete file";
                                    $candidate_page->resume->deleteAll();
                                
                                  // unlink($candidate_page->resume);
                                  //echo "after delete  ".$candidate_page->resume;
                                  echo "<br>";
                              // $pathname = $filepath;
                              // die();
                              echo "add file to backend";
                              echo $pathname;
                              $candidate_page->resume->add($pathname);
                              echo $candidate_page->resume->httpUrl;
                                      
                                    // echo "filepath".$candidate_page->resume->add($pathname);
                              $candidate_page->message("Added file: $filename_name");
                                      echo " email match  ";
                                      echo $filename_name;
                                      echo "<br>";
                                      $loop_counter++;
                                      echo "increment";
                              //unlink($pathname);
                                      /**save candidate page with resume. note- uncomment this code when you save resume */
                              $candidate_page->save();
                              }
                              else{
                                  echo "<br>";
                                  //echo $filename_name;
                                  echo "<br>";
                              }
                              echo "save file";
                              /**save candidate page with resume. note- uncomment this code when you save resume */
                              $candidate_page->of(false);
                              $candidate_page->save();
                              /**when you upload files then save file using (_) underscore e.g bhadanaranveer@gmail.com to bhadanaranveer_gmail_com*/
                          // }   
                      }
                  
                }
              // }
              echo $loop_counter;
            // }
          // }
        // }



      
  }


?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
              <h2>Candidate Resume Upload</h2>
						</div>
            <div id="table_container_card_body" class="card-body">
              <form id="bulk_candidate_resume_upload_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
                <div class="container text-center">
                  <div class="Candidate_excel form-group">
                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                        <div class="row">
                            <label for="upload_file">Upload Candidate Excel Sheet</label>
                        </div>
                        <div class="">
                            <div class=" inputfile">
                                <div class="custom-file mb-3 ">
                                  <!-- <input type="file"  class="custom-file-input" id="award_1_files"  name="award_1_files[]" value="" multiple > -->
                                  <input type="file"  class="custom-file-input" id="candidate_excel"  name="candidate_excel" value=""  >
                                  <label style="text-align: left;" class="custom-file-label">Choose File..</label>
                                    
                                </div>
                            </div> 
                        </div>
                      </div>
                      <div class="col-md-3"></div>
                    </div>
                  </div>
                  <div class="Candidate_resumes form-group">
                    <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-6">
                        <div class="row">
                            <label for="upload_file">Upload Candidate Resumes</label>
                        </div>
                        <div class="">
                            <div class="inputfile">
                                <div class="custom-file mb-3 ">
                                  <input type="file"  class="custom-file-input" id="candidate_resumes"  name="candidate_resumes[]" value="" multiple >
                                  <label style="text-align: left;" class="custom-file-label">Choose File..</label>
                                    
                                </div>
                            </div> 
                        </div>
                      </div>
                      <div class="col-md-3"></div>
                    </div>
                  </div>
                  <div class="Candidate_resumes form-group text-center">
                    <button type="submit" class="btn btn-primary" name="btn_upload_resume" >Upload Resumes</button>
                  </div>

                </div>
              </form>
            </div>
					       
					</div>

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<!-- <span>Copyright &copy; Pride Circle 2019</span> -->
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	
	<!-- Bootstrap core JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
		
	

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= $rootpath;?>scripts/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?= $rootpath;?>scripts/jquery.dataTables.min.js?v=<?=mt_rand(0,999)?>"></script>
	<script src="<?= $rootpath;?>scripts/dataTables.bootstrap4.min.js"></script>


	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>
	
	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>


	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=<?=mt_rand(0,999)?>"></script>
	
</body>

</html>
