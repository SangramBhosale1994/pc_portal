<?php
	// if($session->user_designation!="admin" && $session->user_designation!="editor" && $session->user_designation!="recruiter"){
	// require_once(\ProcessWire\wire('files')->compile('includes/resume_header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	// }
 require_once(\ProcessWire\wire('files')->compile('includes/referral-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));

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
                        <?php
                        $email=$session->email;
                        $referrer_page=$pages->get("name=referral-profiles")->child("referrer_email=".$email);
                        $referrer_member_code= $referrer_page->referrer_member_code;
                         $referrer_link =$pages->get("name=login-with-email")->httpUrl."?referrer_code=$referrer_member_code";
                       // $referrer_link =$pages->get("name=resume")->httpUrl."?referrer_code=$referrer_member_code";
                        
                        if($referrer_page->referrer_points==""){
                            $referrer_page->referrer_points='{"points_details_array":[]}';
                        }
                        /* Amrut Todkar 2021-02-06 The following shows the timeline of all the points added to the referrer in a timeline. The dashboard is split into two sections. */
                        
                        /* Get the array of all the points details that the referrer has earned */
                            $points_details_object= json_decode($referrer_page->referrer_points);
                            //print_r($referrer_page->referrer_points);
                            $points_details_array = $points_details_object->points_details_array;
                            
                            $total_points=0;
                            foreach($points_details_array as $points_details){
                                if($points_details->points_increment_decrement=="increment")
                                {
                                    $total_points+=$points_details->points;
                                }
                                elseif($points_details->points_increment_decrement=="decrement"){
                                    $total_points-=$points_details->points;
                                }
                            }
                        
                        ?>
                        
                        <div id="table_container_card_body" class="card-body">
                            
				
					<!-- Content Row -->
                            <div class="[ row ]">
                                <div class="[ col-md-7 ]">
                                    <!--<h4>Your Points : <span class="badge badge-success rounded-circle"><?=$total_points;?></span></h4>-->
                                    <!--<br>-->
                                    <!--<h4>Referrer Member Code : <span class="badge badge-primary"><?=$referrer_page->referrer_member_code;?></span></h4>-->
                                    <!--<br>-->
                                    <!--<h4>Referrer Link :</h4><p class="text-primary"><?=$referrer_link;?></p> -->
                                    
                                    <!-- Content Row -->
                					<div class="row">
                
                						<!-- Earnings (Monthly) Card Example -->
                						<div class="col-md-6 mb-4">
                						    <div class="card border-left-primary shadow h-100 py-2">
                								<div class="card-body">
                									<div class="row no-gutters align-items-center">
                										<div class="col mr-2">
                											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Your Points</div>
                											<div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total_points;?></div>
                										</div>
                										<div class="col-auto">
                											<i class="fas fa-user-friends fa-2x text-gray-300"></i>
                										</div>
                									</div>
                								</div>
                							</div>
                						</div>
                
                						<!-- Earnings (Monthly) Card Example -->
                						<div class="col-md-6 mb-4">
                						    <div class="card border-left-success shadow h-100 py-2">
                								<div class="card-body">
                									<div class="row no-gutters align-items-center">
                										<div class="col mr-2">
                											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Referrer Member Code</div>
                											<div class="h5 mb-0 font-weight-bold text-gray-800">
                												<?=$referrer_page->referrer_member_code;?>
                												</div>
                										</div>
                										<div class="col-auto">
                											<i class="fas fa-calendar fa-2x text-gray-300"></i>
                										</div>
                									</div>
                								</div>
                							</div>
                						</div>
                
                					</div>
                					<div class="row">
                					    <!-- Earnings (Monthly) Card Example -->
                						<div class="col-md-12 mb-4">
                							<div class="card border-left-info shadow h-100 py-2">
                								<div class="card-body">
                									<div class="row no-gutters align-items-center">
                										<div class="col mr-2">
                											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Referrer Link</div>
                											<div class="row no-gutters align-items-center">
                												<div class="col-auto">
                													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="referrer_link" ><sub><?=$referrer_link;?></sub></div>
                												</div>
                												<div class="col">
                												</div>
                											</div>
                										</div>
                										<div class="col-auto">
                											<button class="btn btn-primary referral_dashboard_copy_btn" id="copy_link"><i class="fas fa-copy "></i> Copy link</button>
                										</div>
                									</div>
                								</div>
                							</div>
                						</div>
                					</div>
                					
                					<div class="row">
                					    <?php
                					         $job_page = $pages->get("name=jobs")->httpUrl;
                					    ?>
                					    <!-- Earnings (Monthly) Card Example -->
                						<div class="col-md-12 mb-4">
                							<div class="card border-left-info shadow h-100 py-2">
                								<div class="card-body">
                									<div class="row no-gutters align-items-center">
                										<div class="col mr-2">
                											<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Job Page Link</div>
                											<div class="row no-gutters align-items-center">
                												<div class="col-auto">
                													<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="referrer_link" >To check latest jobs, <a target="_blank" href="<?=$job_page;?>">click here</a></div>
                												</div>
                												<div class="col">
                												</div>
                											</div>
                										</div>
                										<div class="col-auto">
                										
                										</div>
                									</div>
                								</div>
                							</div>
                						</div>
                					</div>
                
                					<!-- Content Row -->
                                    
                                </div>
                                <div class="card border-left-warning shadow h-100 py-2 [ col-md-5 ]">
                    				<div class="card-body">
                                        <div id="referrer_points_details_container" >
                                         <h4>Notifications</h4>
                                         <div style="    overflow-y: auto; height: 300px;">
                                        <?php
                                        if($referrer_page->referrer_points == ""){
                                            echo "No points to show.";
                                        }
                                            
    
                                            /* If no points, show  */
                                            if(count($points_details_array) == 0){
                                                echo "No points to show.";
                                            }else{
                                                /* Show each point notification in a foreach loop */
                                                $points_details_array=array_reverse($points_details_array);
                                                foreach($points_details_array as $points_details_object){
                                                    $border_color="primary";
                                                    if($points_details_object->points_increment_decrement=="decrement"){
                                                         $border_color="danger";
                                                    }
                                                    
                                                    $points_to_show="";
                                                    $points_hidden="";
                                                    if($points_details_object->points > 0 && $points_details_object->points_increment_decrement=="decrement"){
                                                         $points_to_show="-".$points_details_object->points;
                                                    }
                                                    elseif($points_details_object->points > 0 && $points_details_object->points_increment_decrement=="increment"){
                                                         $points_to_show="+".$points_details_object->points;
                                                    }
                                                    else{
                                                        $points_hidden=" d-none ";
                                                    }
                                                   
                                        ?>
    
                                        <div class="border-left-<?=$border_color;?> shadow [ card ][ my-3 mr-2 p-3 ]">
                                            <div class="[ d-flex justify-content-between ]">
                                                <div style="float:left">
                                                    <strong><?=$points_details_object->title;?> <span class='<?=$points_hidden;?> badge badge-<?=$border_color;?> p-2 ' style="border-radius:1.35rem !important;"> <?=$points_to_show;?></span> </strong>
                                                </div>
                                                
                                                <div style="float:right">
                                                    <?=date('j M g:i a', $points_details_object->timestamp)?>
                                                </div>
                                            </div>
                                            
                                            <hr class="">
                                            
                                            <div>
                                                <?=$points_details_object->message;?>
                                            </div>
                                            
                                        </div>
                                        
                                        <?php
                                                    
                                                }
                                            }
                                            
                                        ?>
                                        
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div><?=$page->text_description;?></div>
                                </div>
                            </div>
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
// function myFunction() {
//   var copyText = document.getElementById("referrer_link");
//   copyText.select();
//   copyText.setSelectionRange(0, 99999)
//   document.execCommand("copy");
//   alert("Copied the text: " + copyText.value);
// }

// var copyTextareaBtn = document.querySelector('#copy_link');

// copyTextareaBtn.addEventListener('click', function(event) {
//   var copyTextarea = document.querySelector('#referrer_link');
//   copyTextarea.focus();
// //   copyTextarea.select();

//   try {
//     var successful = document.execCommand('copy');
//     var msg = successful ? 'successful' : 'unsuccessful';
//     console.log('Copying text command was ' + msg);
//   } catch (err) {
//     console.log('Oops, unable to copy');
//   }
// });
/* copy link using js */
$(document).on('click', '#copy_link', function(){
    let copy_text="<?php echo $referrer_link;?>";
    Clipboard_CopyTo(copy_text);
});

function Clipboard_CopyTo(value) {
  var tempInput = document.createElement("input");
  tempInput.value = value;
  document.body.appendChild(tempInput);
  tempInput.select();
  document.execCommand("copy");
  document.body.removeChild(tempInput);
}
/*End copy link using js*/
</script>

<script>
    $(document).ready(function(){
        if(window.innerWidth < 768){
            $( "#sidebarToggleTop" ).trigger( "click" );
        }
        
    });
</script>

</body>
</html>