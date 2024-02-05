<?php
	require_once 'includes/admin-header.php';
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<!--<div class="card shadow mb-4">-->
					<!--    <div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">-->
					<!--        <button id="delete_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#delete_selected_modal"><i class="[ mr-2 ][ fas fa-trash ]"></i> Delete Selected</button>-->
						
      <!--                  <div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">-->
						<!--	<h3>Job Fair Verification</h3>-->
						<!--</div>-->

						<!--<div id="table_container_card_body" class="card-body">-->
						<!--	<h3 id="table_loading" >Loading...</h3>-->

						<!--	<div id="table_container" class="table-responsive">-->
						<!--		<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">-->
						<!--		</table>-->
						<!--	</div>-->
						<!--</div>-->
					<!--	</div>-->
					<!--</div>-->
					
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
								
							<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist" style="width:100%;">
									<!-- <li class="nav-item">
											<a class="nav-link active" id="pills-lgbt-verified-tab" data-toggle="pill" href="#pills-lgbt-verified" role="tab" aria-controls="pills-home" aria-selected="true">LGBT+ Verified</a>
									</li> -->
									<li class="nav-item">
											<a class="nav-link active" id="pills-applicants-tab" data-toggle="pill" href="#pills-job-fair-applicants" role="tab" aria-controls="pills-profile" aria-selected="false">Applicants</a>
									</li>
									<li class="nav-item">
											<a class="nav-link" id="pills-job-fair-verified-tab" data-toggle="pill" href="#pills-job-fair-verified" role="tab" aria-controls="pills-contact" aria-selected="false">Accepted Applicants</a>
									</li>
									<li class="nav-item">
											<a class="nav-link" id="pills-job-fair-unverified-tab" data-toggle="pill" href="#pills-job-fair-unverified" role="tab" aria-controls="pills-contact" aria-selected="false">Rejected Applicants</a>
									</li>
							</ul>
                            
                            
						</div>
						
						<!--<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">-->

						<!--	 <button id="delete_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#delete_selected_modal"><i class="[ mr-2 ][ fas fa-trash ]"></i> Verify Selected</button>-->
						<!--</div>-->
						

						<div id="table_container_card_body" class="card-body">
							<h3 id="table_loading" >Loading...</h3>

							<div class="tab-content" id="pills-tabContent">
									<!-- <div class="tab-pane fade show active" id="pills-lgbt-verified" role="tabpanel" aria-labelledby="pills-home-tab">
										<div id="table_container" class="table-responsive">
											<table id="lgbt_verified_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											</table>
										</div>
									</div> -->

								<div class="tab-pane fade show active" id="pills-job-fair-applicants" role="tabpanel" aria-labelledby="pills-profile-tab">
									<div class="btn-group mb-3" role="group" style="margin-right: 1rem;">
										<label class="btn btn-outline-primary"><input id='select_all_checkbox' class='select_all_candidate_checkbox' type='checkbox' style="padding-top:0.5rem;"> Select All</label>
										<label id="btnGroupDrop1" type="button" class="btn btn-outline-primary " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
												<!-- <span class="caret"></span> -->
												<i class="fa fa-angle-down"></i>
										</label>
										<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
												<a class="dropdown-item" id="multi_verify_button" href="#"><i class="[ mr-2 ][ fas fa-check ]"></i> Accept</a>
												<a class="dropdown-item" id="multi_unverify_button" href="#"><i class="[ mr-2 ][ fas fa-times ]"></i> Reject</a>
										</div>
									</div>
									<div id="table_container" class="table-responsive">
										<table id="job_fair_applicants_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											
										</table>
									</div>
								</div>
                <div class="tab-pane fade" id="pills-job-fair-verified" role="tabpanel" aria-labelledby="pills-contact-tab">
									<div id="table_container" class="table-responsive">
										<table id="job_fair_verified_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-job-fair-unverified" role="tabpanel" aria-labelledby="pills-contact-tab">
									<div id="table_container" class="table-responsive">
										<table id="job_fair_unverified_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											
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

	<!-- MODAL :  Edit Profile modal -->
	<!--<div id="sub_user_modal" class="[ modal fade ]" tabindex="-1" role="dialog" aria-labelledby="sub_user_modal" aria-hidden="true">-->
	<!--	<div class="[ modal-dialog modal-lg ]" role="document">-->
	<!--		<div class="[ modal-content ]">-->
	<!--			<div class="[ modal-header ]">-->
	<!--				<h5 class="[ modal-title ]" id="edit_profile_modal_title">Sub-users</h5>-->
	<!--				<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">-->
	<!--					<span aria-hidden="true">&times;</span>-->
	<!--				</button>-->
	<!--			</div>-->

	<!--			<form id="sub_user_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">-->
	<!--				<div id="edit_profile_modal_body" class="[ modal-body ]">-->
					    
	<!--				</div>-->

	<!--			</form>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<!-- MODAL :  Edit Profile modal End -->
	
	<!-- MODAL :  Column select modal -->
	<div class="modal fade" id="column-select-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Select columns to be shown.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="column_select_checkbox_container" class="modal-body">
					<?php
						/* Based on what type of user has logged in, decide columns availability */
						$available_columns_to_show = $columns_for_admin;


						/* Loop through all the possible column names */
						foreach ($all_columns as $section_title => $checkbox_array) {
					?>

					<div class="[ mt-3 ]">
						<h3><?=$section_title?></h3>
					</div>

					<div class="[ row ]">

						<?php
							foreach ($checkbox_array as $column_checkbox_id => $column_checkbox_title) {
								/* Check if that column is allowed to be shown, if not continue. */
								if(!array_key_exists($column_checkbox_id, $available_columns_to_show)){
									continue;
								}

								$is_selected = (in_array($column_checkbox_id, json_decode($pages->get($session->user_page_id)->candidate_table_column_array))) ? "checked": "";
						?>

						<div class="[ col-md-4 form-group ]">
							<input id="<?=$column_checkbox_id?>" class="( column_select_checkbox )" type="checkbox" <?=$is_selected?>>
							<label for="<?=$column_checkbox_id?>"><?=$column_checkbox_title?></label>
						</div>

						<?php
							}
						?>

					</div>

					<?php
						}
					?>

				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="column_select_modal_submit" type="button" class="[ btn btn-primary ]" data-dismiss="modal">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL :  Column select modal End -->

	<!-- MODAL :  Confirm Delete selected modal -->
	<div id="delete_selected_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_selected_modal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Do you really wish to delete the entries with following IDs?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div id="delete_selected_list_container" class="[ modal-body text-center ]">
					Please select an entry to delete!
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
					<button id="delete_selected_modal_submit" type="button" class="[ btn btn-danger ]" data-dismiss="modal" disabled>Delete Permanently</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL :  Confirm Delete selected modal End -->

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

  <!-- Data table export and copty button scripts -->
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>


	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=21.04"></script>
</body>

</html>
