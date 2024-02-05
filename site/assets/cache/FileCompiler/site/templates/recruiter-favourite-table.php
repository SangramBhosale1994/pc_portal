<?php
 require_once(\ProcessWire\wire('files')->compile('includes/recruiter-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>
				<!-- Begin Page Content -->
				<div class="container-fluid recruiter_datatable_section">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
							<label class="btn btn-outline-primary"><input id='select_all_checkbox' class='select_all_candidate_checkbox' type='checkbox' style="padding-top:0.5rem;"> Select All</label>

							<label class="btn btn-outline-primary"><input id='show_only_mine_checkbox' class='show_only_mine_checkbox' type='checkbox' style="padding-top:0.5rem;"> My Favourites</label>

							<button id="" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#column-select-modal">Select Columns</button>

							<!-- <button id="show_profile_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Show Profile</button> -->
							

							<button id="unlcok_profiles_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Unlock Selected</button>

							<!-- <button id="edit_profile_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Edit Profile</button> -->

							<button id="unlist_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#unlist_selected_modal">Unlist Selected</button>
						</div>

						<div id="table_container_card_body" class="card-body">
							
								<div id="filter_controls">
									<form id="candidate_filter_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
										<div class="row" style="justify-content: flex-start;margin-bottom: 1rem;">
											<div class="d-flex">
												<div class="col-md-12">
													<button id="candidate_status_btn_filters_all"  class="[ badge bg-light ]( selected-action-button )" value="All"  type="button" style="margin-right:1rem;border: 1px solid #4e73df;">All Candidates</button>
													<button id="candidate_status_btn_filters_shortlisted" class="[ badge bg-light ]( selected-action-button )"  value="CV Shortlisted"  type="button" style="margin-right:1rem;border: 1px solid #4e73df;">CV Shorlisted</button>
													<button id="candidate_status_btn_filters_notviewed"  class="[ badge bg-light ]( selected-action-button )" value="Not Viewed"  type="button" style="margin-right:1rem;border: 1px solid #4e73df;">Not Viewed</button>
												</div>
											</div>
										</div>
										<h3 id="table_loading" >Loading...</h3>
										<div class="row" style="justify-content: flex-start;" id="recruiter_candidate_status_filter">
												<div class="d-flex">
														<div class="col-md-8">
																<div class="[  ][ form-group ]">
																		<label for="recruiter_candidate_status">Candidate Status Filter</label>
																		<select id="recruiter_candidate_status" class="custom-select" name="recruiter_candidate_status" >
																				<option value="" selected >All Candidates</option>
																				<?php
																				$candidate_status_array=Array();
																				foreach($pages->get("name=candidate-status-sections")->children() as $candidate_status){
																					$candidate_status_array[]=$candidate_status->title;
																				}
																				$candidate_status_array[]="Not Viewed";
																				foreach($candidate_status_array as $single_candidate_status){
																						// $candidate_status_array[]=addslashes($candidate_status->title);
																				
																				?>
																				<option value="<?=$single_candidate_status?>"><?=$single_candidate_status?></option>
																				<!-- <option value="New Applicants">New Applicants</option> -->
																				<?php
																				}
																				?>
																		</select>
																		<div class="invalid-tooltip">
																				Please select an option.
																		</div>
																</div>
														</div>
														<div class="col-md-6" style="margin-top:2rem;">
																<button id="candidate_status_filters" class="[ btn btn-primary ]( selected-action-button )" type="button" style="">Apply Filters</button>
														</div>
												</div>
										</div>
									</form>
								</div>
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
						$available_columns_to_show = $columns_for_recruiter;

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

	<!-- MODAL :  Confirm Unlist selected modal -->
	<div id="unlist_selected_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="unlist_selected_modal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Do you really wish to unlist profiles with follwing IDs from favourites?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div id="unlist_selected_list_container" class="[ modal-body text-center ]">
					Please select an entry to unlist!
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
					<button id="unlist_selected_modal_submit" type="button" class="[ btn btn-danger ]" data-dismiss="modal" disabled>Unlist Profile</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL :  Confirm Unlist selected modal End -->

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

	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>


	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=28.03.23"></script>

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
