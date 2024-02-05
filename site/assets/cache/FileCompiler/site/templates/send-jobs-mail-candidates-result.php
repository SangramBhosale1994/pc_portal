<?php
 require_once(\ProcessWire\wire('files')->compile('includes/admin-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>
<?php
$manage_candidate_link=$config->urls->httpRoot."resume/pc-admin/admin-candidate-table/";
// print_r($session->job_data_array);
// echo "----";
// print_r($session->candidate_array);
    // $result_message.=$single_candidate['email']."<br>";
?>


				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][  ]">
                <h2>Send Mail To Candidates Results</h2>
               
                <a href="<?=$manage_candidate_link?>">
                  <button type="button" class="btn btn-outline-primary"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>       
                </a>
            </div>
					
						<div id="table_container_card_body" class="card-body">
							<!-- <h3 id="table_loading" >Loading...</h3> -->

							<div id="table_container" class="table-responsive">
                            <!-- <input id="searchInput" type="text">  -->
								<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0" >
                  <div class="">
                    <div class="row" style="margin-left:1rem;">
                      <p>
                        Result:-
                        </br>
                        Jobs are send to following candidates-</br>
                        Jobs are -
                        </br>
                        <?php
                          $counter=1;
                          // echo $counter;
                          foreach($session->job_data_array as $job_key=>$job_value){
                            // echo $job_key;
                            // echo "****";
                            // echo "job".$counter."_name</br>";
                            if($job_key=="job".$counter."_name"){
                              // echo $job_key;
                              echo $job_value."</br>";
                              $counter++;
                            }
                            
                          }
                          // echo "---";
                          // echo $counter;
                        ?>
                        </br>
                        Candidates are -
                        </br>
                        <?php
                          foreach($session->candidate_array as $single_candidate){
                              echo $single_candidate['email']."</br>";

                          }
                        ?>
                        </p>
                    </div>
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
