<?php
	require_once 'includes/recruiter-header.php';
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
							<!-- <button id="" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#column-select-modal">Select Columns</button> -->

							<!-- <button id="show_profile_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Show Profile</button> -->

							<!-- <button id="edit_profile_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Edit Profile</button> -->

							<!-- <button id="unlist_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#unlist_selected_modal">Unlist Selected</button> -->
						</div>

						<div id="table_container_card_body" class="card-body">
							<h3 id="table_loading" >Loading...</h3>
							<div id="filter_controls">
									<form id="candidate_filter_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
										<div class="row" style="justify-content: flex-start;">
												<div class="d-flex">
														<div class="col-md-8">
																<div class="[  ][ form-group ]">
																		<?php
																				$candidate_status_array=array();
																				foreach($pages->get("name=candidate-status-sections")->children() as $candidate_status){
																						$candidate_status_array[]=addslashes($candidate_status->title);
																				}
																				$candidate_status_array[] = "Not Viewed";
																				// print_r($candidate_status_array);
																				// echo "***********";
																				/**natcasesort() is a function which is sort data alphabaticaly. natcasesort means Natural Sort Case Sensitive*/
																				// natcasesort($candidate_status_array);
																				$candidate_status_data=implode("','",$candidate_status_array);
																				// echo $candidate_status_data;
																		?>
																		<label for="candidate_status">Candidate Status </label>
																		<input id="recruiter_candidate_status_filter" name="recruiter_candidate_status" type="text" class="form-control tagator" value="" data-tagator-show-all-options-on-focus="true" data-tagator-autocomplete="['<?=$candidate_status_data?>']" style="padding: 2px 12px;">
                                                    
																</div>
														</div>
														<div class="col-md-6" style="margin-top:2rem;">
																<button id="candidate_status_filters" class="[ btn btn-primary ]( selected-action-button )" type="button" style="padding: 3px 19px;">Apply Filters</button>
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
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=4.22"></script>
</body>

</html>
