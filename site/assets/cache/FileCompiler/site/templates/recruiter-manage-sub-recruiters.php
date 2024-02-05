<?php
if($session->user_designation=="admin"){
 require_once(\ProcessWire\wire('files')->compile('includes/admin-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
}
elseif($session->user_designation=="editor"){
 require_once(\ProcessWire\wire('files')->compile('includes/editor-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
}
else{
 require_once(\ProcessWire\wire('files')->compile('includes/recruiter-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
}
	
?>
				<!-- Begin Page Content -->
				<div class="container-fluid recruiter_datatable_section">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
						<?php
							if($session->user_designation=="recruiter"){
						?>
							<div>
								<span>
								<?php 
								$recruiter_page=\ProcessWire\wire('pages')->get($session->user_page_id);
								$sub_recruiters_count=$recruiter_page->children()->count();
								$remaining_sub_recruiter_quota=($recruiter_page->sub_recruiter_quota)-($sub_recruiters_count);
									$bg_color="";
										$text_color="";
										$px="";
										$py="";
										$btn_disable="enabled";
									if($remaining_sub_recruiter_quota == 0 || $remaining_sub_recruiter_quota == "" )
									{
											$bg_color="danger";
											$text_color="light"; 
											$px="3";
											$py="1";
											$btn_disable="disabled";
									}
								?>
								<button id="create_new_modal_trigger_button" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#create_new_modal" <?=$btn_disable?>><i class="[ mr-2 ][ fas fa-plus-circle ]"></i> New Recruiter</button>

								<br><br>
								<span class="[ px-<?=$px?> py-<?=$py?> ] bg-<?=$bg_color?> text-<?=$text_color?> rounded"> <?php if($recruiter_page->sub_recruiter_quota !=""){
									echo "You have ".$remaining_sub_recruiter_quota." sub recruiter quota remaining.";
									}
									else{
											echo "You have 0 sub recruiter quota remaining.";
									}
									?>
								</span>
								</span>
								<span id="sub_reccruiter_quota"></span>
							</div>
							<div style="padding-right:6rem">
								<button id="more_filters_btn" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#search-modal">Generate Usage Report</button>
							</div>
							<div>
								<button id="delete_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#delete_selected_modal"><i class="[ mr-2 ][ fas fa-trash ]"></i> Delete Selected</button>
							</div>
						<?php
							}
						?>
							
						</div>
							

						<div id="table_container_card_body" class="card-body">
							<h3 id="table_loading" >Loading...</h3>

							<div id="table_container" class="table-responsive">
								<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
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

	<!-- MODAL :  Confirm Delete selected modal -->
	<div id="delete_selected_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_selected_modal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Do you really wish to delete the recruiters with following names?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div id="delete_selected_list_container" class="[ modal-body text-center ]">
					Please select an entry to delete!
				</div>

				<div class="modal-footer">
					<div id="delete_selected_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>

					<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>

					<button id="delete_selected_modal_submit" type="button" class="[ btn btn-danger ]" disabled>Delete Permanently</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL :  Confirm Delete selected modal End -->

	<!-- MODAL :  Create New modal -->
	<div id="create_new_modal" class="[ modal fade ]" tabindex="-1" role="dialog" aria-labelledby="create_new_modal" aria-hidden="true">
		<div class="[ modal-dialog ]" role="document">
			<div class="[ modal-content ]">
				<div class="[ modal-header ]">
					<h5 class="[ modal-title ]" id="create_new_modal_title">Create New Recruiter</h5>
					<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form id="create_new_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
					<div id="create_new_modal_body" class="[ modal-body ]">

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_sub_recruiter_name">Name<span style="color:red;">*</span></label>
							<input id="create_new_sub_recruiter_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="sub_recruiter_name" required>

							<div class="invalid-tooltip">
								Please provide a valid name.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_sub_recruiter_email">Email<span style="color:red;">*</span></label>
							<input id="create_new_sub_recruiter_email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="sub_recruiter_email" required>

							<div class="invalid-tooltip">
								Please provide a valid email address.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_sub_recruiter_password">Password<span style="color:red;">*</span></label>
							<input id="create_new_sub_recruiter_password" class="form-control" type="password" name="sub_recruiter_password" required>

							<div class="invalid-tooltip">
								Please provide a valid password.
							</div>
						</div>
					</div>

					<div class="[ modal-footer ]">
						<div id="create_new_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>

						<button type="button" class="[ btn btn-outline-primary ]" data-dismiss="modal">Close</button>
						<button id="create_new_modal_submit" type="submit" class="[ btn btn-primary ]">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL :  Create New modal End -->

	<!-- MODAL :  Edit Profile modal -->
	<div id="edit_profile_modal" class="[ modal fade ]" tabindex="-1" role="dialog" aria-labelledby="edit_profile_modal" aria-hidden="true">
		<div class="[ modal-dialog ]" role="document">
			<div class="[ modal-content ]">
				<div class="[ modal-header ]">
					<h5 class="[ modal-title ]" id="edit_profile_modal_title">Edit Profile</h5>
					<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form id="edit_profile_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
					<div id="edit_profile_modal_body" class="[ modal-body ]">

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_sub_recruiter_name">Name<span style="color:red;">*</span></label>
							<input id="edit_profile_sub_recruiter_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="sub_recruiter_name" required>

							<div class="invalid-tooltip">
								Please provide a valid name.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_sub_recruiter_email">Email<span style="color:red;">*</span></label>
							<input id="edit_profile_sub_recruiter_email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="sub_recruiter_email" required>

							<div class="invalid-tooltip">
								Please provide a valid email address.
							</div>
						</div>
						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_sub_recruiter_password">New Password <span class="[ text-muted ]">(Leave blank if you don't want to change password)</span></label>
							<input id="edit_profile_sub_recruiter_password" class="form-control" type="text" name="sub_recruiter_password">

							<div class="invalid-tooltip">
								Please provide a valid password.
							</div>
						</div>
					</div>

					<div class="[ modal-footer ]">
						<div id="edit_profile_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>

						<button type="button" class="[ btn btn-outline-primary ]" data-dismiss="modal">Close</button>
						<button id="edit_profile_modal_submit" type="submit" class="[ btn btn-primary ]">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- MODAL :  Edit Profile modal End -->
		<!-- MODAL : Sub-recruiter search modal -->
		<div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Generate Report <br><span style="font-size:1rem">(Duration for Posted Jobs, Candidate Status and Total Time Spent)<span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				 <form id="search_container_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
				    <div id="" class="modal-body">
				    	<div class="container">
								<div class="row">
									<!-- <label>Duration for Posted Jobs, Candidate Status and Total Time Spent</label> -->
									<div class="col-md-6">
											<div class="[  ][ form-group ]">
												<label for="from_date">Date From </label>
												<input id="from_date" name="from_date" type="date" class="form-control"  >
												<div class="invalid-tooltip">
													Please enter date from.
												</div>
											</div>
									</div>
									<div class="col-md-6">
											
											<div class="[  ][ form-group ]">
												<label for="to_date">Date To </label>
												<input id="to_date" name="to_date" type="date" class="form-control"  >
												<div class="invalid-tooltip">
													Please enter date to.
												</div>
											</div>
									</div>
								</div>	      
				    </div>

    				
    				<div class="modal-footer justify-content-between">
						<div id="search_modal_error" class="[ px-3 py-1 ][ bg-danger text-light rounded ]" style="display: none" ></div>
    					<a href="<?=$page->httpUrl;?>">
    					    <button  class="btn btn-secondary" id="reset" >Clear Filter</button>
    					</a>
    					<button id="search_modal_submit" type="button" class="[ btn btn-primary ]" >Generate</button>
    				</div>
				  </form>
			</div>
		</div>
	</div>
	<!-- MODAL :  Sub-recruiter search modal End -->

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

	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>
	
	
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>

	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=26.2"></script>

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
