<?php
 require_once(\ProcessWire\wire('files')->compile('includes/user-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	//echo $session->company_name;
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						
						<div class="[ card-header ][ py-3 ]">
						    <h3 style="margin-bottom: 0px !important;"><?=$page->title;?></h3>
                        </div>
                        
                        <div id="table_container_card_body" class="card-body">
                          <p><?=$page->text_description;?></p>
                        </div>
					</div>

				</div>
				<!-- /.container-fluid -->
            <div>
			<?php
 include(\ProcessWire\wire('files')->compile('includes/general_footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
    		?>
            </div>
			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<!--<footer class="sticky-footer bg-white">-->
			<!--	<div class="container my-auto">-->
			<!--		<div class="copyright text-center my-auto">-->
						 <!--<span>Copyright &copy; Pride Circle 2019</span> -->
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
		
		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>


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
