<?php
 require_once(\ProcessWire\wire('files')->compile('includes/user-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

?>
				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800"></h1>
					</div>


					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ]">
						    <h3 style="margin-bottom: 0px !important;"><?=$page->title;?></h3>
                        </div>
                        
                        <div id="table_container_card_body" class="card-body">
                          <p><?=$page->text_description;?></p>
                        </div>
                    </div>
                        
					<!-- Content Row -->
					<!--<div class="container">-->
					    <!--<p><?=$page->text_description;?></p>-->
					    <!--<p><b>Pride Circle Corporate Dashboard</b></p>-->
					    <!--<p>A newly developed initiative/ A new digital hub/initiative by Pride Circle that enables an all-in-one management of their every engagement through this single platform.</p>-->
					    <!--<p>We have several exciting programs lined up for the next 12 months. </p>-->
					    <!--<p>To have a look at our list of events for the year and know more about each program, enlist your organisation on the Pride Circle Corporate Dashboard.</p>-->
					    <!--<p>Happy Pride!</p>-->
					<!--</div>-->

					<!-- Content Row -->

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<!--<footer class="sticky-footer bg-white">-->
			<!--	<div class="container my-auto">-->
			<!--		<div class="copyright text-center my-auto">-->
						<!--<span>Copyright &copy; Pride Circle 2019</span>-->
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
	<script src="<?=$rootpath?>scripts/chart.min.js"></script>
<script>
    $(document).ready(function(){
        if(window.innerWidth < 768){
            $( "#sidebarToggleTop" ).trigger( "click" );
        }
        
    });
</script>

</body>
</html>