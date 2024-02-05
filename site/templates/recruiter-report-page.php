<?php
	if($session->user_designation=="admin"){
		require_once 'includes/admin-header.php';
	}
	elseif($session->user_designation=="editor"){
		require_once 'includes/editor-header.php';
	}
	else{
		require_once 'includes/recruiter-header.php';
	}

  global $recuiter_name;
  $recuiter_name="";
  if(isset($_GET['user_id'])){
    $recruiter_page_id=$_GET['user_id'];
    $recruiter_page=wire('pages')->get($recruiter_page_id);
    $recuiter_name=$recruiter_page->title;
  }
?>
				<!-- Begin Page Content -->
				<div class="container-fluid recruiter_datatable_section">

					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4" style="background-color: #f8f9fc;">
            <h3 style="padding: 21px 0px 0px 21px;">
              <?=$recuiter_name?>
            </h3>
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
              
							<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist" style="width:100%;">
									
									<li class="nav-item">
											<a class="nav-link active" id="pills-unlocked-data-tab" data-toggle="pill" href="#pills-unlocked-data" role="tab" aria-controls="pills-profile" aria-selected="false">Unlocked Profiles</a>
									</li>
									<li class="nav-item">
											<a class="nav-link" id="pills-download-data-tab" data-toggle="pill" href="#pills-download-data" role="tab" aria-controls="pills-contact" aria-selected="false">Downloaded Profiles</a>
									</li>
									<li class="nav-item">
											<a class="nav-link" id="pills-time-logs-data-tab" data-toggle="pill" href="#pills-time-logs-data" role="tab" aria-controls="pills-contact" aria-selected="false">Time Logs History</a>
									</li>
									<li class="nav-item">
											<a class="nav-link" id="pills-viewed-profile-data-tab" data-toggle="pill" href="#pills-viewed-profile-data" role="tab" aria-controls="pills-contact" aria-selected="false">Viewed Profiles</a>
									</li>
									<li class="nav-item">
											<a class="nav-link" id="pills-offers-input-data-tab" data-toggle="pill" href="#pills-offers-input-data" role="tab" aria-controls="pills-contact" aria-selected="false">Offers History</a>
									</li>
							</ul>      
						</div>
						<!-- <div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Candidates</h6>
						</div> -->

						<div id="table_container_card_body" class="card-body">
							<h3 id="table_loading" >Loading...</h3>
							<div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-unlocked-data" role="tabpanel" aria-labelledby="pills-profile-tab">
									<div id="table_container" class="table-responsive">
										<table id="unlocked_data_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											
										</table>
									</div>
								</div>
                <div class="tab-pane fade" id="pills-download-data" role="tabpanel" aria-labelledby="pills-contact-tab">
									<div id="table_container" class="table-responsive">
										<table id="download_data_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											
										</table>
									</div>
								</div> 
								<div class="tab-pane fade" id="pills-time-logs-data" role="tabpanel" aria-labelledby="pills-contact-tab">
									<div id="table_container" class="table-responsive">
										<table id="time_log_data_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											
										</table>
									</div>
								</div> 
								<div class="tab-pane fade" id="pills-viewed-profile-data" role="tabpanel" aria-labelledby="pills-contact-tab">
									<div id="table_container" class="table-responsive">
										<table id="viewed_profile_data_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											
										</table>
									</div>
								</div>   
								<div class="tab-pane fade" id="pills-offers-input-data" role="tabpanel" aria-labelledby="pills-contact-tab">
									<div id="table_container" class="table-responsive">
										<table id="offers_input_data_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											
										</table>
									</div>
								</div>         
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

	<!-- Page level plugins -->
	<script src="<?= $rootpath;?>scripts/jquery.dataTables.min.js"></script>
	<script src="<?= $rootpath;?>scripts/dataTables.bootstrap4.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>

	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=<?=mt_rand(0,999)?>"></script>

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