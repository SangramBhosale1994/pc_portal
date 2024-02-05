<?php
	require_once 'includes/editor-header.php';
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">

							<button id="create_new_modal_trigger_button" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#create_new_modal"><i class="[ mr-2 ][ fas fa-plus-circle ]"></i> New Recruiter</button>

							<button id="delete_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#delete_selected_modal"><i class="[ mr-2 ][ fas fa-trash ]"></i> Delete Selected</button>
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
							<label for="create_new_recruiter_name">Name<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="recruiter_name" required>

							<div class="invalid-tooltip">
								Please provide a valid name.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_email">Email<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="recruiter_email" required>

							<div class="invalid-tooltip">
								Please provide a valid email address.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_company_name">Company Name<span style="color:red;">*</span></label>
							<input id="create_new_company_name" class="form-control"  type="text" name="recruiter_company_name" required>

							<div class="invalid-tooltip">
								Please provide a valid company name.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_password">Password<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_password" class="form-control" type="password" name="recruiter_password" required>

							<div class="invalid-tooltip">
								Please provide a valid password.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_type">Recruiter Type<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_type" name="recruiter_type" type="text" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Regular Recruiter',
															'Internship Recruiter'
															]
													">
							<div class="invalid-tooltip">
								Please enter recruiter type.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_subscription_from">Subscription From (00:01 Hrs)<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_subscription_from" class="form-control"  name="recruiter_subscription_from" type="date" required>

							<div class="invalid-tooltip">
								Please provide a valid date.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_subscription_to">Subscription To (23:59 Hrs)<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_subscription_to" class="form-control"  name="recruiter_subscription_to" type="date" required>

							<div class="invalid-tooltip">
								Please provide a valid date.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_unlock_quota">General Unlock Quota<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_unlock_quota" class="form-control"  name="recruiter_unlock_quota" type="number" required>

							<div class="invalid-tooltip">
								Please provide a valid number.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_applicants_unlock_quota">Applicants Unlock Quota<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_applicants_unlock_quota" class="form-control"  name="recruiter_applicants_unlock_quota" type="number" required>

							<div class="invalid-tooltip">
								Please provide a valid number.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_job_limit">Jobs limit<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_job_limit" class="form-control"  name="recruiter_job_limit" type="number" required>

							<div class="invalid-tooltip">
								Please provide a valid number.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_recruiter_sub_recruiter_quota">Sub Recruiter Quota<span style="color:red;">*</span></label>
							<input id="create_new_recruiter_sub_recruiter_quota" class="form-control"  name="recruiter_sub_recruiter_quota" type="number" required>

							<div class="invalid-tooltip">
								Please provide a valid number.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<div id="create_new_recruiter_accessible_sections_block">
								<label for="create_new_recruiter_accessible_sections">Accessible Sections<span style="color:red;">*</span></label>
								<!-- <input id="create_new_accessible_sections" class="form-control" type="text" name="accessible_sections" required> -->
								<?php
									$counter=1;
									foreach($pages->get("name=pc-recruiter")->children() as $accessible_sections_name){
												//echo $accessible_sections_name;
												if($accessible_sections_name->name=="recruiter-login"){
													continue;
												}
												if($accessible_sections_name->name=="recruiter-report-page"){
													continue;
												}
											if($counter==1){
													$checked="checked";
											}
											else{
													$checked="";
											}
								?>
								<div>
								<input  type="checkbox" value="<?=$accessible_sections_name->id;?>" name="recruiter_accessible_sections[]" id="create_new_recruiter_accessible_sections_<?=$accessible_sections_name->name;?>" >
														<label class="form-check-label" for="create_new_recruiter_accessible_sections">
																<?=$accessible_sections_name->title;?>
														</label>
															</div>
								<?php
									$counter++;
									}
								?>

								<div class="invalid-tooltip">
									Please provide a valid section.
								</div>
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
							<label for="edit_profile_recruiter_name">Name<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="recruiter_name" required>

							<div class="invalid-tooltip">
								Please provide a valid name.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_email">Email<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="recruiter_email" required>

							<div class="invalid-tooltip">
								Please provide a valid email address.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_company_name">Company Name<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_company_name" class="form-control"  type="text" name="recruiter_company_name" required>

							<div class="invalid-tooltip">
								Please provide a valid company name.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_password">New Password <span class="[ text-muted ]">(Leave blank if you don't want to change password)</span></label>
							<input id="edit_profile_recruiter_password" class="form-control" type="text" name="recruiter_password">

							<div class="invalid-tooltip">
								Please provide a valid password.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_type">Recruiter Type<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_type" name="recruiter_type" type="text" class="form-control tagator" required value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['Regular Recruiter',
															'Internship Recruiter'
															]
													">
							<div class="invalid-tooltip">
								Please enter recruiter type.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_subscription_from">Subscription From (00:01 Hrs)<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_subscription_from" class="form-control"  name="recruiter_subscription_from" type="date" required>

							<div class="invalid-tooltip">
								Please provide a valid date.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_subscription_to">Subscription To (23:59 Hrs)<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_subscription_to" class="form-control"  name="recruiter_subscription_to" type="date" required>

							<div class="invalid-tooltip">
								Please provide a valid date.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_unlock_quota">General Unlock Quota<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_unlock_quota" class="form-control"  name="recruiter_unlock_quota" type="number" required>

							<div class="invalid-tooltip">
								Please provide a valid number.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_applicants_unlock_quota">Applicants Unlock Quota<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_applicants_unlock_quota" class="form-control"  name="recruiter_applicants_unlock_quota" type="number" required>

							<div class="invalid-tooltip">
								Please provide a valid number.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_job_limit">Remaining Jobs<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_job_limit" class="form-control"  name="recruiter_job_limit" type="number" required>

							<div class="invalid-tooltip">
								Please provide a valid number.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_sub_recruiter_quota">Sub Recruiter Quota<span style="color:red;">*</span></label>
							<input id="edit_profile_recruiter_sub_recruiter_quota" class="form-control"  name="recruiter_sub_recruiter_quota" type="number" required>

							<div class="invalid-tooltip">
								Please provide a valid number.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_recruiter_accessible_sections">Accessible Sections<span style="color:red;">*</span></label>
							<!-- <input id="create_new_accessible_sections" class="form-control" type="text" name="accessible_sections" required> -->
							<?php
							  
							   foreach($pages->get("name=pc-recruiter")->children() as $accessible_sections_name){
									if($accessible_sections_name->name=="recruiter-login"){
										continue;
									}
									if($accessible_sections_name->name=="recruiter-report-page"){
										continue;
									}
							?>
							<div> 
							<input  type="checkbox" value="<?=$accessible_sections_name->id;?>" name="accessible_sections[]" class="edit_profile_recruiter_accessible_sections" id="edit_profile_recruiter_accessible_sections_<?=$accessible_sections_name->name;?>" >
                           <label class="form-check-label" for="edit_profile_recruiter_accessible_sections">
                               <?=$accessible_sections_name->title;?>
                           </label>
                            </div>
                            <?php
                            
							   }
                            ?>

							<div class="invalid-tooltip" id="accessible_sections">
								Please provide a valid section.
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

	
</body>

</html>
