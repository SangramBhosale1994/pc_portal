	<?php
 require_once(\ProcessWire\wire('files')->compile('includes/editor-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						
            <div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
							<h3>Referrer Data</h3>
							<label class="btn btn-outline-primary"><input id='select_all_checkbox' class='select_all_referrer_checkbox' type='checkbox' style="padding-top:0.5rem;"> Select All</label>
							<button id="multiple_profile_add_points_btn" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#points-modal">Edit Points</button>
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

	<!-- MODAL :  Edit Profile modal -->
	<div id="edit_profile_modal" class="[ modal fade ]" tabindex="-1" role="dialog" aria-labelledby="edit_profile_modal" aria-hidden="true">
		<div class="[ modal-dialog modal-lg ]" role="document">
			<div class="[ modal-content ]">
				<div class="[ modal-header ]">
					<h5 class="[ modal-title ]" id="edit_profile_modal_title">Add Points</h5>
					<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form id="edit_profile_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
					<div id="edit_profile_modal_body" class="[ modal-body ]">
					    
					    <div class="[ mb-3 ][ form-group ]">
							<label for="referrer_title">Notifiation Title</label>
							<input id="referrer_title" class="form-control" type="text" name="referrer_title" required>

							<div class="invalid-tooltip">
								Please provide a valid title.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="referrer_reason">Notifiation Message</label>
							<input id="referrer_reason" class="form-control" type="text" name="referrer_reason" required>

							<div class="invalid-tooltip">
								Please provide a valid reason.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]">
							<label for="referrer_action">Action</label>
							<!--<input id="referrer_action" class="form-control" type="text" name="referrer_action" required>-->
							
							<select id="referrer_action" class="custom-select" name="referrer_action" required>
            					<option value="" selected hidden>Action</option>
            					<option value="increment">Increment</option>
            					<option value="decrement">Decrement</option>
            					
            				</select>

							<div class="invalid-tooltip">
								Please provide a valid action.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="referrer_points">Referrer Points <sub class="text-muted pb-1">(Numbers only)</sub></label>
							<input id="referrer_points" class="form-control" type="number" name="referrer_points" required>

							<div class="invalid-tooltip">
								Please provide a valid points.
							</div>
						</div>
						
						<div class="[ mb-3 ][ form-group ]" hidden>
							<label for="modal_referrer_id">Referrer Id</label>
							<input id="modal_referrer_id" class="form-control" type="text" name="modal_referrer_id" >

							<div class="invalid-tooltip">
								Please provide a valid title.
							</div>
						</div>
						<div class="[ mb-3 ][ form-group ]">
						
							<!--<input id="edit_skill_type" class="form-control" type="text" name="skill_type" hidden>-->

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

			<!-- MODAL : Referrer points add modal -->
			<div class="modal fade" id="points-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Points</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="referrer_points_container_form" class="[  ][  rounded tab-content ][ needs-validation ]" action="" method="POST" enctype="multipart/form-data" >
							<div id="referrer_points_error_msg">
								<p class="text-center mt-3">Please select an entry to add points!</p>
							</div>
							<div id="referrer_points_modal_body" class="[ modal-body ]">
									
								<div class="[ mb-3 ][ form-group ]">
									<label for="referrer_title">Notifiation Title</label>
									<input id="referrer_title" class="form-control" type="text" name="referrer_title" required>

									<div class="invalid-tooltip">
										Please provide a valid title.
									</div>
								</div>
								
								<div class="[ mb-3 ][ form-group ]">
									<label for="referrer_reason">Notifiation Message</label>
									<input id="referrer_reason" class="form-control" type="text" name="referrer_reason" required>

									<div class="invalid-tooltip">
										Please provide a valid reason.
									</div>
								</div>
								
								<div class="[ mb-3 ][ form-group ]">
									<label for="referrer_action">Action</label>
									<!--<input id="referrer_action" class="form-control" type="text" name="referrer_action" required>-->
									
									<select id="referrer_action" class="custom-select" name="referrer_action" required>
										<option value="" selected hidden>Action</option>
										<option value="increment">Increment</option>
										<option value="decrement">Decrement</option>
										
									</select>

									<div class="invalid-tooltip">
										Please provide a valid action.
									</div>
								</div>

								<div class="[ mb-3 ][ form-group ]">
									<label for="referrer_points">Referrer Points <sub class="text-muted pb-1">(Numbers only)</sub></label>
									<input id="referrer_points" class="form-control" type="number" name="referrer_points" required>

									<div class="invalid-tooltip">
										Please provide a valid points.
									</div>
								</div>
								
							</div>

							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button id="referrer_points_modal_submit" type="submit" class="[ btn btn-primary ]" >Submit</button>
							</div>
					</form>
				</div>
			</div>
		</div>
	<!-- MODAL :  Referrer points add modal End -->

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
