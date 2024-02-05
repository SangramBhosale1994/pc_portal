<?php
 require_once(\ProcessWire\wire('files')->compile('includes/recruiter-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
  global $message;
  $message="";
  $btn_submit="enabled";

  $session_user_id=$session->user_page_id;
  $recruiter_page=$pages->get($session_user_id);
  if($recruiter_page->text_description!=""){
    $company_text=$recruiter_page->text_description;
  }
  else{
    $company_text="";
  }

  if($recruiter_page->rich_textarea_1!=""){
    $privacy_policy_text=$recruiter_page->rich_textarea_1;
  }
  else{
    $privacy_policy_text="";
  }

  if($recruiter_page->footer_logo!=""){
    $company_logo=$recruiter_page->footer_logo->httpUrl;
    $required_data="";
  }
  else{
    $company_logo="";
    $required_data="required";
  }

  if($recruiter_page->profile_image!=""){
    $privacy_policy_image=$recruiter_page->profile_image->httpUrl;
    $required_data="";
  }
  else{
    $privacy_policy_image="";
    $required_data="required";
  }
  
  // echo $company_text;
  // echo "****";

  // echo $privacy_policy_text;
  // echo "----///";

  // echo $company_logo;
  // echo "---*";

  // echo $privacy_policy_image;
  // echo "++++";
  
  

  global $response;
  $response="";
  // echo "**";
  // echo $message;
  if(isset($_POST['btn_submit'])){
    // $btn_submit="disabled";
    // echo $input->post->company_text;
    // echo $input->post->company_privacy_policy_text;
    // echo $input->post->recruiter_company_logo;
    // echo $input->post->recruiter_company_privacy_policy_image;
    $data_present="false";
    $session_user_id=$session->user_page_id;
    $recruiter_page=$pages->get($session_user_id);
    if($input->post->company_text!="" && $input->post->company_privacy_policy_text!=""){
      $recruiter_page->text_description =$sanitizer->purify($input->post->company_text);
      $recruiter_page->rich_textarea_1 =$sanitizer->purify($input->post->company_privacy_policy_text);
      $data_present="true";
    }
    else{
      $data_present="false";
      echo "<script type='text/javascript'>alert('Please submit all details.');</script>";
      // $response="Please submit all details.";
    }

    // if($input->post->company_privacy_policy_text!=""){
    //   $recruiter_page->rich_textarea_1 =$sanitizer->purify($input->post->company_privacy_policy_text);
    //   $data_present="true";
    // }
    // else{
    //   $data_present="false";
    //   echo "<script type='text/javascript'>alert('Please enter privacy policy data.');</script>";
    // }
    
    
      
    /* Save page */
    $recruiter_page->of(false);
    $recruiter_page->save();
            
    /* Define the temporary path to upload the file before saving the files to the CMS page */
    $upload_path = $config->paths->assets;//. "files/temp-files/";

    /* Uploading and saving of company profile image */
    /** Save the uploaded file  in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
    $company_file = new \ProcessWire\WireUpload('recruiter_company_logo');

    /** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
    $company_file->setMaxFiles(1);
    $company_file->setOverwrite(true);
    $company_file->setDestinationPath($upload_path);
    $company_file->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif'));

    /** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
    $files = $company_file->execute();
    // print_r($files);
    // echo "****";
    
    /**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
    if(count($files)){
      if($recruiter_page->footer_logo){
        $recruiter_page->footer_logo->deleteAll();
      }
      foreach($files as $filename) {
        $pathname = $upload_path . $filename;
        // echo $pathname;
        // echo "++++";
        $recruiter_page->footer_logo->add($pathname);
        // echo $recruiter_page->footer_logo;
        $recruiter_page->message("Added file: $filename");
  
        unlink($pathname);
      }
    }

    /* Define the temporary path to upload the file before saving the files to the CMS page */
    $upload_path = $config->paths->assets;//. "files/temp-files/";

    /* Uploading and saving of company privacy policy image */
    /** Save the uploaded file  in a variable. This will be a reference to the HTML form element which is profile picture upload input name. */
    $company_privacy_policy_image = new \ProcessWire\WireUpload('recruiter_company_privacy_policy_image');

    /** Some settings of upload size, extention type, destinatino path etc added to the image upload object */
    $company_privacy_policy_image->setMaxFiles(1);
    $company_privacy_policy_image->setOverwrite(true);
    $company_privacy_policy_image->setDestinationPath($upload_path);
    $company_privacy_policy_image->setValidExtensions(array('jpg', 'jpeg', 'png', 'gif'));

    /** Execution of the uploading of the image upload object. This is where the image will be saved with the given settings and at the given location. Variable $files will contain the success/failure status of the execution process. */
    $files = $company_privacy_policy_image->execute();
    // print_r($files);
    // echo "****";
    /**** Save the image to the candidate profile page. Foreach loop is used even though only one image is being saved because, $files will always be an array.  */
    if(count($files)){
      if($recruiter_page->profile_image){
        $recruiter_page->profile_image->deleteAll();
      }
      foreach($files as $filename) {

        $pathname = $upload_path . $filename;
        // echo $pathname;
        // echo "++++";

        $recruiter_page->profile_image->add($pathname);

        $recruiter_page->message("Added file: $filename");

        unlink($pathname);
      }
    }
  
    /* Save page */
    $recruiter_page->of(false);
    $recruiter_page->save();
    $message="Profile Data has been saved successfully";
    if($data_present=="true"){
      echo "<script type='text/javascript'>alert('Profile Data has been saved successfully');</script>";
      // $response="Profile Data has been saved successfully";
    }
    // else{
    //   echo "<script type='text/javascript'>alert('Please submit all details.');</script>";
    // }
    
    // echo "<script type='text/javascript'>location.reload()</script>";
    // echo "-----";
    // header("Location: ".$page->httpUrl);
    
  }
?>
<style>
  #pageloader
{
  background: rgba( 255, 255, 255, 0.8 );
  display: none;
  height: 100%;
  position: fixed;
  width: 100%;
  z-index: 9999;
}

#pageloader img
{
  left: 40%;
  margin-left: -32px;
  margin-top: -32px;
  position: absolute;
  top: 30%;
}
.recruiter_company_profile_url:hover{
    text-decoration:none;
}
</style>
			<!-- include summernote css -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	
        <!-- Begin Page Content -->
				<div class="container-fluid recruiter_datatable_section">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
              <div>
                <h2>Company Profile</h2>
              </div>
              <div class="text-right">
                <p style="margin-bottom:5px;">See company profile here</p>
                <?php
                  $company_profile_link=$pages->get('name=company=profile')->httpUrl."?name=".$session->company_name;
                ?>
                <a target="_blank" href="<?=$company_profile_link?>"><?=$company_profile_link?></a>
                
                <div class="mt-2">
                <button class="btn btn-primary recruiter_company_profile_url" id="copy_link" ><i class="fas fa-copy "></i> Copy link</button>
              </div>
										
						</div>
          </div>
          <div class="company_profile_section">
            <div id="pageloader">
              <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
            </div>
            <div id="table_container_card_body" class="card-body">
              <form id="recruiter_company_profile_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
                <div class="container text-center">
                  <h2 class="pb-2"><?=$session->company_name?></h2>
                  <div class="Company_logo form-group">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <div class="[ mb-3 ][ form-group ] text-left">
                          <label><span style="color:red;">*</span>Upload Company Logo</label>
                  
                          <div class="custom-file">
                            <input id="recruiter_company_logo" name="recruiter_company_logo" class="custom-file-input" type="file" <?=$required_data?>>
                            <label id="recruiter_company_logo_label" class="custom-file-label" for="recruiter_company_logo">Upload Image</label>
                            <span >Kindly upload an image with a resolution of 284*117.</span>
                            
                            <div class="invalid-tooltip">
                              Please upload a valid file.
                            </div>
                          </div>
                          <div class="pt-2">
                            <?php
                              if($company_logo!=""){
                            ?>
                              <!-- <a id="upload_company_logo" class="[ mb-3 ]" target='_blank' title="" href="<?=$company_logo?>">See uploaded image</a> -->
                            <?php
                              }else{
                            ?>
                              <p>No Company Logo Available</p>
                            <?php
                              }
                            ?>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                  <div class="Company_about_text form-group">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <div class="[ mb-3 ][ form-group ] text-left">
                          <label for="company_text"><span style="color:red;">*</span>About Company</label>
                          <textarea id="company_text" class="form-control" type="textarea" name="company_text"  <?=$required_data?>></textarea>

                          <div class="invalid-tooltip">
                            Please provide a valid company text.
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                  <div class="Company_privacy_policy_image form-group">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <div class="[ mb-3 ][ form-group ] text-left">
                         
                          <label><span style="color:red;">*</span>Upload an Image (to show beside the "Policies & Benefits" section.)</label>
                  
                          <div class="custom-file">
                            <input id="recruiter_company_privacy_policy_image" name="recruiter_company_privacy_policy_image" class="custom-file-input" type="file" <?=$required_data?>>
                            <label id="recruiter_company_privacy_policy_image_label" class="custom-file-label" for="recruiter_company_privacy_policy_image">Upload Image</label>
                            <span >Kindly upload an image with a resolution of 600*502.</span>
                            <div class="invalid-tooltip">
                              Please upload a valid file.
                            </div>
                          </div>
                          <div class="pt-2">
                            <?php
                              if ($privacy_policy_image!=""){
                            ?>
                              <!-- <a id="upload_company_privacy_policy_image" class="[ mb-3 ]" target='_blank' title="" href="<?=$privacy_policy_image?>">See uploaded image</a> -->
                            <?php
                              }else{
                            ?>
                              <p>No Policy Section Image Available</p>
                            <?php
                              }
                            ?>
                          </div>
                        </div>
                        
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                  <div class="Company_privacy_policy_text form-group">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <div class="[ mb-3 ][ form-group ] text-left">
                          <label for="company_privacy_policy_text"><span style="color:red;">*</span>Policies & Benefits You Offer</label>
                          <textarea id="company_privacy_policy_text" class="form-control" type="textarea" name="company_privacy_policy_text"  <?=$required_data?>></textarea>

                          <div class="invalid-tooltip">
                            Please provide a valid policies & benefits content.
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                  
                  
                  <div class="Candidate_resumes form-group text-center">
                    <button id="btn_submit" type="submit" class="btn btn-primary" name="btn_submit" >Submit</button>
                    <!-- <span><?=$response?></span> -->
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
		
  <!-- include summernote js -->
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= $rootpath;?>scripts/sb-admin-2.min.js"></script>
  <script>
  $(document).ready(function() {
		/* initialize the text editor fields */
		$('#company_text').summernote();
		$('#company_privacy_policy_text').summernote();

    // $('#btn_submit').click(function(e) {
    //   e.preventDefault();

    //   var content = $('#company_text').summernote('code');
    //   if (!content) {
    //     alert("Please enter company about text.");
    //     return false;
    //   }

    //   // Your form submission code here
    // });
  });
  </script>
  <script>
	/* copy link using js */
    $(document).on('click', '#copy_link', function(){
        let copy_text="<?php echo $company_profile_link;?>";
        Clipboard_CopyTo(copy_text);
    });
    
    function Clipboard_CopyTo(value) {
      var tempInput = document.createElement("input");
      tempInput.value = value;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand("copy");
      document.body.removeChild(tempInput);
    }
    /*End copy link using js*/
    

</script>

<script type="text/javascript">
				{
					let sideBar = document.querySelector('.side-bar');
					let arrowCollapse = document.querySelector('#logo-name__icon');
					let headerNav = document.querySelector('.header_navbar');
					let recruiter_datatable_section = document.querySelector('.recruiter_datatable_section');
					let sticky_footer = document.querySelector('.sticky-footer');
					// console.log(dashboard);
					console.log("ghghgh");
					sideBar.onmouseover = () => {
            sideBar.classList.add('collapse');
            arrowCollapse.classList.add('collapse');
            arrowCollapse.classList = 'bx bx-chevron-right logo-name__icon collapse';
            recruiter_datatable_section.style.margin = '83px 70px 50px 90px';
            recruiter_datatable_section.style.width = 'calc(100% - 80px)';
					};

					sideBar.onmouseout = () => {
            sideBar.classList.remove('collapse');
            arrowCollapse.classList.remove('collapse');
            arrowCollapse.classList = 'bx bx-chevron-left logo-name__icon';
            recruiter_datatable_section.style.margin = '83px 70px 50px 90px';
            recruiter_datatable_section.style.width = 'calc(100% - 80px)';
					};
				}
	</script>
</body>

</html>
