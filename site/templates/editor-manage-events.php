<?php
	require_once 'includes/editor-header.php';
?>
	<!-- include summernote css -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
				
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">

							<button id="create_new_modal_trigger_button" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#create_new_modal"><i class="[ mr-2 ][ fas fa-plus-circle ]"></i> New Event</button>

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
					<h5 class="modal-title" id="exampleModalLabel">Do you really wish to delete the events with following names?</h5>
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
		<div class="[ modal-dialog modal-lg ]" role="document">
			<div class="[ modal-content ]">
				<div class="[ modal-header ]">
					<h5 class="[ modal-title ]" id="create_new_modal_title">Create New Event</h5>
					<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form id="create_new_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
					<div id="edit_profile_modal_body" class="[ modal-body ]">

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_title">Title</label>
							<input id="create_new_event_title" class="form-control" type="text" name="event_title" required>

							<div class="invalid-tooltip">
								Please provide a valid title.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_event_facilitated_by">Facilitated by</label>
							<input id="create_new_event_event_facilitated_by" class="form-control" type="text" name="event_event_facilitated_by" required>

							<div class="invalid-tooltip">
								Please provide a valid input.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_location">Location</label>
							<input id="create_new_event_location" class="form-control" type="text" name="event_location" required>

							<div class="invalid-tooltip">
								Please provide a valid location.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_summary">Summary</label>
							<textarea id="create_new_event_summary" class="form-control" type="textarea" name="event_summary" required></textarea>

							<div class="invalid-tooltip">
								Please provide a valid summary.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_speaker_details">Speaker/Trainer Details</label>
							<textarea id="create_new_event_speaker_details" class="form-control" type="textarea" name="event_speaker_details"></textarea>

							<div class="invalid-tooltip">
								Please provide a valid input.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_event_start_date">Event Start Date</label>
							<input id="create_new_event_event_start_date" class="form-control" type="date" name="event_event_start_date" required>

							<div class="invalid-tooltip">
								Please provide a valid date.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_event_end_date">Event End Date <sub class="[ text-muted ]">(Skip if single day event.)</sub></label>
							<input id="create_new_event_event_end_date" class="form-control" type="date" name="event_event_end_date">

							<div class="invalid-tooltip">
								Please provide a valid date.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_event_start_time">Event Start Time</label>
							<input id="create_new_event_event_start_time" class="form-control" type="text" name="event_event_start_time" required>

							<div class="invalid-tooltip">
								Please provide a time.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_event_end_time">Event End Time</label>
							<input id="create_new_event_event_end_time" class="form-control" type="text" name="event_event_end_time" required>

							<div class="invalid-tooltip">
								Please provide a time.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_application_deadline">Register Before</label>
							<input id="create_new_event_application_deadline" class="form-control" type="date" name="event_application_deadline" required>

							<div class="invalid-tooltip">
								Please provide a valid application deadline.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_who_can_attend">Who Can Attend</label>
							<input id="create_new_event_who_can_attend" class="form-control" type="text" name="event_who_can_attend">

							<div class="invalid-tooltip">
								Please provide a valid input.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_ticket_price">Ticket</label>
							<input id="create_new_event_ticket_price" class="form-control" type="text" name="event_ticket_price">

							<div class="invalid-tooltip">
								Please provide a valid ticket price.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_event_event_link">Event Link</label>
							<input id="create_new_event_event_link" class="form-control" type="url" name="event_event_link">

							<div class="invalid-tooltip">
								Please provide a valid URL.
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
		<div class="[ modal-dialog modal-lg ]" role="document">
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
							<label for="edit_event_title">Title</label>
							<input id="edit_event_title" class="form-control" type="text" name="event_title" required>

							<div class="invalid-tooltip">
								Please provide a valid title.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_event_facilitated_by">Facilitated by</label>
							<input id="edit_event_event_facilitated_by" class="form-control" type="text" name="event_event_facilitated_by" required>

							<div class="invalid-tooltip">
								Please provide a valid input.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_location">Location</label>
							<input id="edit_event_location" class="form-control" type="text" name="event_location" required>

							<div class="invalid-tooltip">
								Please provide a valid location.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_summary">Summary</label>
							<textarea id="edit_event_summary" class="form-control" type="textarea" name="event_summary" required></textarea>

							<div class="invalid-tooltip">
								Please provide a valid summary.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_speaker_details">Speaker/Trainer Details</label>
							<textarea id="edit_event_speaker_details" class="form-control" type="textarea" name="event_speaker_details"></textarea>

							<div class="invalid-tooltip">
								Please provide a valid input.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_event_start_date">Event Start Date</label>
							<input id="edit_event_event_start_date" class="form-control" type="date" name="event_event_start_date" required>

							<div class="invalid-tooltip">
								Please provide a valid date.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_event_end_date">Event End Date <sub class="[ text-muted ]">(Skip if single day event.)</sub></label>
							<input id="edit_event_event_end_date" class="form-control" type="date" name="event_event_end_date">

							<div class="invalid-tooltip">
								Please provide a valid date.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_event_start_time">Event Start Time</label>
							<input id="edit_event_event_start_time" class="form-control" type="text" name="event_event_start_time" required>

							<div class="invalid-tooltip">
								Please provide a time.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_event_end_time">Event End Time</label>
							<input id="edit_event_event_end_time" class="form-control" type="text" name="event_event_end_time" required>

							<div class="invalid-tooltip">
								Please provide a time.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_application_deadline">Register Before</label>
							<input id="edit_event_application_deadline" class="form-control" type="date" name="event_application_deadline" required>

							<div class="invalid-tooltip">
								Please provide a valid application deadline.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_who_can_attend">Who Can Attend</label>
							<input id="edit_event_who_can_attend" class="form-control" type="text" name="event_who_can_attend">

							<div class="invalid-tooltip">
								Please provide a valid input.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_event_ticket_price">Ticket</label>
							<input id="edit_event_event_ticket_price" class="form-control" type="text" name="event_ticket_price">

							<div class="invalid-tooltip">
								Please provide a valid ticket price.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_event_event_link">Event Link</label>
							<input id="edit_event_event_link" class="form-control" type="url" name="event_event_link">

							<div class="invalid-tooltip">
								Please provide a valid URL.
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


	<!-- include summernote js -->
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
	
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>

	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=<?=mt_rand(0,999)?>"></script>
</body>

</html>
