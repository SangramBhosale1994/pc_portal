<?php
 require_once(\ProcessWire\wire('files')->compile('includes/user-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	//echo $session->company_name;
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4" >
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
						    <div>
						    	<h3 style="margin-bottom: 0px !important;">RISE (Reimagining Inclusion for Social Equity)</h3>
						    	<!--<div class="container" style="background-color:white;">-->
						    
						    	<!--</div>-->
                            </div>
                            
						</div>
						<div class="card-body">
						    	<p ><?=$page->rise_sponsorship_description;?></p>
						</div>
						<!--<hr>-->
						<div class="[ card-header ][ py-3 ]" style="border-top: 1px solid #e3e6f0;">
						    <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
						        <li class="nav-item">
                                    <a class="nav-link active" id="pills-conference-tab" data-toggle="pill" href="#pills-conference" role="tab" aria-controls="pills-conference" aria-selected="false">Conference</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="pills-job-fair-tab" data-toggle="pill" href="#pills-job-fair" role="tab" aria-controls="pills-job-fair" aria-selected="false">Job Fair</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="pills-marketplace-tab" data-toggle="pill" href="#pills-marketplace" role="tab" aria-controls="pills-marketplace" aria-selected="false">Marketplace</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link " id="pills-pre-event-tab" data-toggle="pill" href="#pills-pre-event" role="tab" aria-controls="pills-pre-event" aria-selected="true" >Other Opportunities</a>
                                  </li>
                                  
                                  
                            </ul>
                        </div>
                        
                        <style type="text/css">
                        	blockquote{
                        		color: red;
                        	}
                        </style>
                        
                        <div id="table_container_card_body" class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade" id="pills-pre-event" role="tabpanel" aria-labelledby="pills-pre-event-tab">
                                    <p><?=$page->rise_sponsorship_other_opportunities_text;?></p>
                                     <?php 
                                         // $rise_sponsorship_files = $pages->rise_sponsorship_pre_event_file;
                                          foreach($page->rise_sponsorship_other_opportunities_file as $rise_sponsorship_files){?>
                                          
                                            <a href="<?=$rise_sponsorship_files->httpUrl;?>" target="_blank"><button class="btn btn-outline-primary"><?=$rise_sponsorship_files->description;?>  <i class="fa fa-arrow-circle-down" aria-hidden="true" style="padding-left:9px;"></i></button></a>
                                           
                                         <?php } ?>
                                    
                              </div>
                              <div class="tab-pane fade show active" id="pills-conference" role="tabpanel" aria-labelledby="pills-conference-tab">
                                    <p><?=$page->rise_sponsorship_conference_text;?></p>
                                    <?php foreach($page->rise_sponsorship_conference_file as $rise_sponsorship_files){?>
                                          
                                        <a href="<?=$rise_sponsorship_files->httpUrl;?>" target="_blank"><button class="btn btn-outline-primary"><?=$rise_sponsorship_files->description;?>  <i class="fa fa-arrow-circle-down" aria-hidden="true" style="padding-left:9px;"></i></button></a>
                                     <?php } ?>
                                    
                              </div>
                              <div class="tab-pane fade" id="pills-job-fair" role="tabpanel" aria-labelledby="pills-job-fair-tab">
                                    <p><?=$page->rise_sponsorship_job_fair_text;?></p>
                                    <?php foreach($page->rise_sponsorship_job_fair_file as $rise_sponsorship_files){?>
                                          
                                        <a href="<?=$rise_sponsorship_files->httpUrl;?>" target="_blank"><button class="btn btn-outline-primary"><?=$rise_sponsorship_files->description;?>  <i class="fa fa-arrow-circle-down" aria-hidden="true" style="padding-left:9px;"></i></button></a>
                                     <?php } ?>
                              </div>
                              <div class="tab-pane fade" id="pills-marketplace" role="tabpanel" aria-labelledby="pills-marketplace-tab">
                                    <p><?=$page->rise_sponsorship_marketplace_text;?></p>
                                    <?php foreach($page->rise_sponsorship_marketplace_file as $rise_sponsorship_files){?>
                                          
                                        <a href="<?=$rise_sponsorship_files->httpUrl;?>" target="_blank"><button class="btn btn-outline-primary"><?=$rise_sponsorship_files->description;?>  <i class="fa fa-arrow-circle-down" aria-hidden="true" style="padding-left:9px;"></i></button></a>
                                     <?php } ?>
                              </div>
                            </div>
                        </div>

						<!--<div id="table_container_card_body" class="card-body">-->
						<!--	<h3 id="table_loading" >Loading...</h3>-->

						<!--	<div id="table_container" class="table-responsive">-->
						<!--		<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">-->
						<!--		</table>-->
						<!--	</div>-->
						<!--</div>-->
					</div>

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<!--<footer class="sticky-footer bg-white">-->
			<!--	<div class="container my-auto">-->
			<!--		<div class="copyright text-center my-auto">-->
						 <!--<span>Copyright &copy; Pride Circle 2019</span> -->
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
			<!--<div style="margin-left:10rem;">-->
			<?php
 include(\ProcessWire\wire('files')->compile('includes/general_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
    		?>
            <!--</div>-->
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
	<script src="<?= $rootpath;?>scripts/jquery.dataTables.min.js"></script>
	<script src="<?= $rootpath;?>scripts/dataTables.bootstrap4.min.js"></script>


	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>


	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=4.22"></script>
</body>

</html>
