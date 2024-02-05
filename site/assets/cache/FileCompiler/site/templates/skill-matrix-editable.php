<?php
	// require_once(\ProcessWire\wire('files')->compile('includes/admin-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
  if($session->user_designation=="admin"){ 
 require_once(\ProcessWire\wire('files')->compile('includes/admin-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	}
  if($session->user_designation=="editor"){
 require_once(\ProcessWire\wire('files')->compile('includes/editor-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	}
 
 global $to_return;
 global $skills_data;
 $skills_data="";
 $skills_data_page=$pages->get("name=skills-matrix-data");
 $skills_data=$skills_data_page->textarea_1;
 
  if(isset($_POST["btn_upload_skills"])){
 
    global $to_return;
    global $skills_data;
    $skills_input_data=$sanitizer->purify($input->post->upload_skills);
    // echo $skills_input_data;
    // echo "input";
    $skills_data_page=$pages->get("name=skills-matrix-data");
    // echo $skills_data_page->textarea_1;
    // echo "existing data";
    $skills_data_page->textarea_1=$skills_input_data;
    // echo $skills_data_page->textarea_1;
    // echo "present";
    $skills_data=$skills_data_page->textarea_1;
    $skills_data_page->of(false);
    $skills_data_page->save();
    ?>
    <script>
    alert("Skills are saved successfully!");
    </script>
    <?php
    
    
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
</style>
			
        <!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
              <h2>Add Skills In Skills Matrix</h2>
						</div>
            <div id="pageloader">
              <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
            </div>
            <div id="table_container_card_body" class="card-body">
              <form id="skills_editable_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
              <div class="container ">
                  <div class="Candidate_excel form-group">
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <div class="[  ][ form-group ]">
                          <label for="upload_skills" class="text-left">Please Enter Skills </label>
                          <textarea class="form-control" id="upload_skills" rows="5" name="upload_skills" ><?=$skills_data?></textarea>
                        </div>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                  <div class="Candidate_resumes form-group text-center">
                    <button id="btn_upload_skills" type="submit" class="btn btn-primary" name="btn_upload_skills" >Save Skills</button>
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

</body>

</html>
