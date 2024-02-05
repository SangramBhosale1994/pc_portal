<?php
	require_once 'includes/admin-header.php';
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
							<h3>Unlock Requests from Editors</h3>
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
					<h5 class="modal-title" id="exampleModalLabel">Do you really wish to delete the editors with following names?</h5>
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
					<h5 class="[ modal-title ]" id="create_new_modal_title">Create New Editor</h5>
					<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form id="create_new_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">
					<div id="create_new_modal_body" class="[ modal-body text-center ]">

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_editor_name">Name</label>
							<input id="create_new_editor_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="editor_name" required>

							<div class="invalid-tooltip">
								Please provide a valid name.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="create_new_editor_email">Email</label>
							<input id="create_new_editor_email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="editor_email" required>

							<div class="invalid-tooltip">
								Please provide a valid email address.
							</div>
						</div>

						<div class="[ my-1 ][ form-group ]">
							<label for="create_new_editor_password">Password</label>
							<input id="create_new_editor_password" class="form-control" type="password" name="editor_password" required>

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
					<div id="edit_profile_modal_body" class="[ modal-body text-center ]">

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_editor_name">Name</label>
							<input id="edit_profile_editor_name" class="form-control" pattern="^[A-Za-z'\s\.\-]{1,}[\.]{0,}[A-Za-z'\s\.\-]{0,}$" type="text" name="editor_name" required>

							<div class="invalid-tooltip">
								Please provide a valid name.
							</div>
						</div>

						<div class="[ mb-3 ][ form-group ]">
							<label for="edit_profile_editor_email">Email</label>
							<input id="edit_profile_editor_email" class="form-control" type="email" pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' name="editor_email" required>

							<div class="invalid-tooltip">
								Please provide a valid email address.
							</div>
						</div>

						<div class="[ my-1 ][ form-group ]">
							<label for="edit_profile_editor_password">New Password</label>
							<input id="edit_profile_editor_password" class="form-control" type="password" name="editor_password" required>

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
