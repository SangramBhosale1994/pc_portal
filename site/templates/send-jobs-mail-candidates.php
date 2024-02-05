<?php
	require_once 'includes/admin-header.php';
  include 'includes/send_mail_ticketing.php';
?>
<?php
    $manage_candidate_link=$config->urls->httpRoot."resume/pc-admin/admin-candidate-table/";
  // PHP SDK: https://github.com/sendinblue/APIv3-php-library
  // require_once(__DIR__ . '/vendor/autoload.php');
  require_once 'vendor_sendinblue/autoload.php';

  // print_r($session->candidate_checkbox_data);
  if(isset($_POST['btn_jobs_to_candidate_mail'])){
    // echo "***";
    $selected_candidates_array=array();
    $selected_jobs_array=array();
    $selected_jobs_id_array=array();
    $jobs_input=$input->post('jobs_to_candidate');
    // print_r(explode(",",$jobs_input));
    $selected_jobs_array=explode(",",$jobs_input);
    if(count($selected_jobs_array)!=5){
      echo "<script> alert('Please select 5 jobs only.'); </script>";
      // exit();
    }
    else{
    foreach($selected_jobs_array as $single_selected_job){
      
      /**separate id in single job by space using explode function and convert it into array */
      $explode_job_id=explode(" ",$single_selected_job);
      /**save zero position id in explode job id into job id array */
      $selected_jobs_id_array[]=$explode_job_id[0];
    }
    $selected_candidates=$session->candidate_checkbox_data;
    $selected_candidates_array=json_decode($selected_candidates);
    $candidate_array=array();
    $candidate_associative_array=array();
    $job_data_array=array();
    
    // $result_message="Jobs Are<br>";
    foreach($selected_candidates_array as $single_candidate_id){
      $candidate_page=$pages->get("name=candidates")->child("id=".$single_candidate_id);
      $candidate_array['email']=$candidate_page->email;
      $candidate_array['name']=$candidate_page->first_name." ".$candidate_page->last_name;
      $candidate_associative_array[]=$candidate_array;
      
    }
    // print_r($candidate_associative_array);
    $session->candidate_array=$candidate_associative_array;
    $counter=1;
    foreach($selected_jobs_id_array as $single_job){
      $job_page=$pages->get("name=jobs")->child("id=".$single_job);
      $job_location = array_map('trim', array_filter(explode(",", $job_page->location)));
      $job_location = implode(", ", $job_location);
      $job_created_date=date("d M Y", $job_page->created);
      $job_min_experience=$job_page->min_experience;
      $job_max_experience=$job_page->max_experience;
      if($job_min_experience!=0 && $job_max_experience!=0){
        // echo "0";
        $job_experience="".$job_min_experience." - ".$job_max_experience." Years";
      }
      elseif($job_min_experience==0 && $job_max_experience==0){
        // echo "1";
        // $job_min_experience="0";
        // $job_experience="".$job_min_experience." - ".$job_max_experience." Years";
        $job_experience="".$job_min_experience." Years";
      }
      elseif($job_min_experience==0 && $job_max_experience!=0){
        // echo "2";
        // $job_experience="".$job_min_experience." Years";
        $job_experience="".$job_min_experience." - ".$job_max_experience." Years";
      }
      elseif($job_max_experience==0 && $job_min_experience!=0){
        // echo "3";
        $job_experience="".$job_min_experience." Years";
      }
      else{
        // echo "4";
        $job_experience="".$job_max_experience." Years";
      }
      $job_data_array['job'.$counter.'_name']=$job_page->title;
      $job_data_array['job'.$counter.'_company_name']=$job_page->company_name;
      $job_data_array['job'.$counter.'_link']=$job_page->httpUrl;
      $job_data_array['job'.$counter.'_created_date']=$job_created_date;
      $job_data_array['job'.$counter.'_experience']=$job_experience;
      $job_data_array['job'.$counter.'_location']=$job_location;
      // $result_message.=$job_page->title."<br>";
      $counter++;
    }
    $session->job_data_array=$job_data_array;
      /**Api integration */

        // Configure API key authorization: api-key
        /**Zerovaega Key */
        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        /**Live key */
        // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        
        // Uncomment below line to configure authorization using: partner-key
        // $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', 'YOUR_API_KEY');
        
        $apiInstance = new SendinBlue\Client\Api\ContactsApi(
          // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
          // This is optional, `GuzzleHttp\Client` will be used as default.
          new GuzzleHttp\Client(),
          $config
        );
        // $email = "testmail@example.com"; // string | Email (urlencoded) of the contact
        // $createContact = new \SendinBlue\Client\Model\CreateContact(); // \SendinBlue\Client\Model\UpdateContact | Values to update a contact
        // $createContact['attributes'] = array('FNAME'=>'Alex', 'LNAME'=>'Roger');
        // $apiInstance->createContact($createContact);
        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new GuzzleHttp\Client(),
            $config
        );
        // $createContact['email']="amrutaj.zerovaega@gmail.com";
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail(); // \SendinBlue\Client\Model\SendSmtpEmail | Values to send a transactional email
        // $sendSmtpEmail['to'] = array(array('email'=>'amrutaj.zerovaega@gmail.com', 'name'=>'John Doe'),array('email'=>'amruta.jagatap@zerovaega.com', 'name'=>'Amruta Jagtap'));
        // echo "****";
        // print_r($candidate_associative_array) ;
       
        
       
        foreach($candidate_associative_array as $single_candidate){
          $sendSmtpEmail['to'] = array($single_candidate);
          // $sendSmtpEmail['templateId'] = 1;
          $sendSmtpEmail['templateId'] = 3;
          // $sendSmtpEmail['params'] = array('name'=>'John', 'surname'=>'Doe','job1_name'=>$job_page->title,'job1_company_name'=>$job_page->company_name);
          $sendSmtpEmail['params'] = $job_data_array;
          
          // $sendSmtpEmail['headers'] = array('X-Mailin-custom'=>'custom_header_1:custom_value_1|custom_header_2:custom_value_2');

          try {
              $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
              header("Location:".$pages->get('name=send-jobs-mail-candidates-result')->httpUrl."");
          } catch (Exception $e) {
              echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
          }
          // $result_message.="Jobs are";
          // foreach($job_data_array as $job_key=>$job_value){
          //   $result_message.=$job_value."<br>";
          // }
        }
        

      }
    }
  // session_destroy();
  // }
?>

<style>
  .tagator_options{
    max-height:350px;
  }
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
</style>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][  ]">
                <h2>Send Mail To Candidates</h2>
               
                <a href="<?=$manage_candidate_link?>">
                  <button type="button" class="btn btn-outline-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>       
                </a>
            </div>
            <div id="pageloader">
              <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
            </div>
					
						<div id="table_container_card_body" class="card-body">
							<!-- <h3 id="table_loading" >Loading...</h3> -->

							<div id="table_container" class="table-responsive">
                            <!-- <input id="searchInput" type="text">  -->
								<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0" >
                  <div class="">
                    <form id="send_jobs_mail_container_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
                      <div id="" class="" style="height:32rem;">
                        
                        <div class="container">
                          
                          <div class="row">
                              <!-- <div class="col-md-3"></div> -->
                              <div class="col-md-7">
                                  <div class="[  ][ form-group ]">
                                      <?php
                                          $jobs_array=array();
                                          foreach($pages->get("name=jobs")->children("verification=verified,active_status=active") as $single_job){
                                              if($single_job->job_publish_shedule!=""){
                                                  if($single_job->job_publish_shedule>time()){
                                                      continue;
                                                  }
                                              }
                                              $jobs_array[]=str_replace("&#039;","\'",$single_job->id." ".$single_job->title);
                                             
                                          }
                                          
                                          /* here we use sort() then sort display 1st capital leeter in alphabetical order and then small letters in alphabetical order 
                                          So here we use natcasesort() is case sensetive so they dispaly capital and small letter alphabetical order at a time.*/
                                          natcasesort($jobs_array);
                                          // print_r($jobs_array);
                                          // echo "-----";                                           
                                          $jobs_data=implode("','",$jobs_array);
                                          // echo $jobs_data;
                                      ?>
                                      <label for="jobs_to_candidate">Jobs <sub>(You can select multiple Jobs. You have to select only 5 jobs.)</sub></label>
                                      <input id="jobs_to_candidate" name="jobs_to_candidate" type="text" class="form-control tagator" value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$jobs_data;?>']">
                                            <!-- <input id="jobs_to_candidate" name="jobs_to_candidate" type="text" class="form-control tagator" value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['aaa\'aaa','aaa\'aaa','aaa\'aaa','aaa\'aaa','aaaaaaa']"> -->
                                    
                                      <div class="invalid-tooltip">
                                          Please select an option.
                                      </div>
                                  </div>
                              </div>  
                              <div class="col-md-5">
                              <div class="text-center" style="margin-top:2rem;">
                                <button id="btn_jobs_to_candidate_mail" name="btn_jobs_to_candidate_mail" type="submit" class="[ btn btn-primary ]" >Send Mail</button>
                              </div>

                              </div> 
                          </div>
                                  
                        </div>
                      </div>
                    </form>
                  </div>              

								</table>
							</div>
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

    <script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/27714a0b3d.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=<?=mt_rand(0,999)?>"></script>
	
	
	<!--<script>-->
	<!--	$(document).ready( function () {-->
	<!--		$('#dataTable').DataTable({-->
	<!--			"paging": true-->
	<!--		});-->

	<!--		$('#dataTable').show();-->


	<!--	} );-->
	<!--</script>-->
  <script>
    $(document).ready(function () {
      // $(document).on("submit","#btn_upload_resume", function(){
      $("#send_jobs_mail_container_form").on("submit",function(){
        // $('#btn_upload_resume').attr('disabled', 'true');
        // $('#btn_upload_resume').html('Uploading...');
        $("#pageloader").fadeIn();
      });
    });
  </script>


</body>

</html>
