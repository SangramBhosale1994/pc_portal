<?php
 require_once(\ProcessWire\wire('files')->compile('includes/user-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	//echo $session->company_name;
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
						    <div>
						        <h3>Manage Users</h3>
						    	<!--<div class="[ mt-3 ][ text-center  ]">-->
                    	     <span>
                    		You can add and manage upto 5 users.<br> If a user's link expires, you can simply add their email again.</span>
						    </div>
						    	
                    	<!--</div>-->
						    	<!--<h5>You can have upto 5 sub-users.</h5>-->

							<button id="create_new_modal_trigger_button" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#add_subuser_modal"><i class="[ mr-2 ][ fas fa-plus-circle ]"></i> Add User</button>

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
			<!--<footer class="sticky-footer bg-white">-->
			<!--	<div class="container my-auto">-->
			<!--		<div class="copyright text-center my-auto">-->
						<!-- <span>Copyright &copy; Pride Circle 2019</span> -->
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
			
			<?php
 include(\ProcessWire\wire('files')->compile('includes/general_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
    		?>

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- MODAL :  Column select modal -->
	<div class="modal fade" id="add_subuser_modal" tabindex="-1" role="dialog" aria-labelledby="add_subuserLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add user</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="add_subuser_modal_form">
    				<div class="modal-body">
    				    <div class="form-group">
                            <label for="subuser_email">Please enter the official email ID of the user to add<br><sub>(The email will get a verification link which will be valid for 10 minutes)</sub> </label>
                            <input type="email" name="subuser_email" class="form-control" id="subuser_email" placeholder="abc@xyz.com">
                            <sub class="text-muted">*Registration through official email ID only</sub>
                        </div>
    
    				</div>
    
    				<div class="modal-footer" >
    					<button type="submit" id="btn_add_subuser" class=" [ btn btn-primary ] px-4" data-dismiss="modal">Submit</button>
    					<!--<div class="[ d-flex flex-row justify-content-end mb-4 ]">-->
                			<!--<button value="submit" id="submit" class="[ btn btn-primary ]( btn-submit )" type="submit">-->
                			<!--		Submit-->
                			<!--</button>-->
                		<!--</div>-->
    				</div>
				</form>
	
			</div>
		</div>
	</div>
	<!-- MODAL :  Column select modal End -->
	


	<!-- Bootstrap core JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>

	
	<script type="text/javascript">
		$(document).ready(function(e){

			$('#btn_add_subuser').click(function(){

				var email = $('#subuser_email').val();
				
				var reg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)([\w-]+\.)+[\w-]{2,4})?$/;

					if (reg.test(email))
					{
						return 0;
						//$(this).closest('form').submit();
					}
					else
					{
					 	alert('Please Enter Business Email Address');
						console.log("Please Enter Business Email Address");
						return false;

					}

			});

		});
	</script>


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
