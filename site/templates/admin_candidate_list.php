<?php
    require_once 'includes/admin-header.php';
    	/* For column names and variables */

?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
							<button id="" class="[ btn btn-primary ]( selected-action-button )" type="button" data-toggle="modal" data-target="#column-select-modal">Select Columns</button>

							<button id="show_profile_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Show Profile</button>

							<button id="edit_profile_button" class="[ btn btn-primary ]( selected-action-button )" type="button">Edit Profile</button>

							<button id="delete_selected_modal_trigger_button" class="[ btn btn-danger ]( selected-action-button )" type="button" data-toggle="modal" data-target="#delete_selected_modal">Delete Selected</button>
						</div>

						<div id="table_container_card_body" class="card-body">
							<h3 id="table_loading" >Loading...</h3>

                            <table border=1>
                            <!-- <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr> -->
							<!-- older skills -->
							<!-- soft skills -->
							<!-- non-technical skills -->
							<table border=2>
								<tr><th>Non-technical Skills</th></tr>
                                <tr>
                                    <th>Title</th>
                                    <th>No. of People</th>
                                </tr>
                                
                            <?php
                            $counter = 0;
                            $data = array("ms office"=>"0", "ms word"=>"0", "ms excel"=>"0");
                             foreach ($pages->get("name=candidates")->children() as $candidate_page) {
                                 $technical=strtolower($candidate_page->non_technical_skills);
                                 $str_arr = explode (",", $technical); 
                                $str=array_filter($str_arr);
                                 
                                //  $result=array_intersect_key($data,$str_arr);
                                //    print_r($result);
                                
                                 foreach( $str as $key){
                                     $key=trim($key);
                                // foreach( array_key_exists("c", $str_arr) as $key){
                                   // print_r($str_arr);
                                     if(array_key_exists($key, $data)){
                                        // echo "found";
                                          $data[$key]++;
                                        }
                                        else{
                                            $data[$key]=1;
                                        }
                                    
                                 }
                                     
                                   // echo $result;
                                   // print_r($result); 
                                //  foreach ($str_arr as $technical){
                                    //  if($str_arr == $data){
                                    //      echo "<br>";
                                    //         echo $data;
                                    //  }
                                    // $result=array_intersect_key($str_arr,$data);
                                    //echo $result;
                                     
                                     //print_r($str_arr); 
                                      //$counter++;
                                 
                                // }
                             }
                              arsort($data);
                             //print_r($data);
                               foreach ($data as $key => $value) {
                                    echo "<tr>";
                                    echo "<td>" . $key . "</td>\n<td>" . $value . "</td>";
                                    echo "</tr>";
								} ?>
								</table>
							<!-- technical skills -->
                            <table border=2>
							<tr><th>technical Skills</th></tr>
                                <tr>
                                    <th>Title</th>
                                    <th>No. of People</th>
                                </tr>
                                
                            <?php
                            $counter = 0;
                            $data = array("c"=>"0", "c++"=>"0", "html"=>"0");
                             foreach ($pages->get("name=candidates")->children() as $candidate_page) {
								//  convert to lpwer case
								 $technical=strtolower($candidate_page->technical_skills);
								//  string to array
								 $str_arr = explode (",", $technical); 
								//  remove empty space
                                $str=array_filter($str_arr);
                                 
                                //  $result=array_intersect_key($data,$str_arr);
                                //    print_r($result);
                                
                                 foreach( $str as $key){
                                     $key=trim($key);
                                // foreach( array_key_exists("c", $str_arr) as $key){
								   // print_r($str_arr);
								//    check key in in array
                                     if(array_key_exists($key, $data)){
                                        // echo "found";
                                          $data[$key]++;
                                        }
                                        else{
                                            $data[$key]=1;
                                        }
                                    
                                 }
                                     
                                   // echo $result;
                                   // print_r($result); 
                                //  foreach ($str_arr as $technical){
                                    //  if($str_arr == $data){
                                    //      echo "<br>";
                                    //         echo $data;
                                    //  }
                                    // $result=array_intersect_key($str_arr,$data);
                                    //echo $result;
                                     
                                     //print_r($str_arr); 
                                      //$counter++;
                                 
                                // }
                             }
                              arsort($data);
                             //print_r($data);
                               foreach ($data as $key => $value) {
                                    echo "<tr>";
                                    echo "<td>" . $key . "</td>\n<td>" . $value . "</td>";
                                    echo "</tr>";
                                } 
                            ?></table>


							<!-- soft skills -->

							<table border=2>
								<tr><th>Soft Skills</th></tr>
                                <tr>
                                    <th>Title</th>
                                    <th>No. of People</th>
                                </tr>
                                
                            <?php
							$counter = 0;
							
                            $data = array("Inclusive Leadership Skills"=>"0", "Interpersonal Skills"=>"0", "Action-Oriented"=>"0");
                             foreach ($pages->get("name=candidates")->children() as $candidate_page) {
                                 $technical=strtolower($candidate_page->soft_skills);
                                 $str_arr = explode (",", $technical); 
                                $str=array_filter($str_arr);
                                 
                                //  $result=array_intersect_key($data,$str_arr);
                                //    print_r($result);
                                
                                 foreach( $str as $key){
                                     $key=trim($key);
                                // foreach( array_key_exists("c", $str_arr) as $key){
                                   // print_r($str_arr);
                                     if(array_key_exists($key, $data)){
                                        // echo "found";
                                          $data[$key]++;
                                        }
                                        else{
                                            $data[$key]=1;
                                        }
                                    
                                 }
                                     
                                   // echo $result;
                                   // print_r($result); 
                                //  foreach ($str_arr as $technical){
                                    //  if($str_arr == $data){
                                    //      echo "<br>";
                                    //         echo $data;
                                    //  }
                                    // $result=array_intersect_key($str_arr,$data);
                                    //echo $result;
                                     
                                     //print_r($str_arr); 
                                      //$counter++;
                                 
                                // }
                             }
                              arsort($data);
                             //print_r($data);
                               foreach ($data as $key => $value) {
                                    echo "<tr>";
                                    echo "<td>" . $key . "</td>\n<td>" . $value . "</td>";
                                    echo "</tr>";
								} ?>
								</table>

								<!-- older skills -->

							<table border=2>
								<tr><th>Skills</th></tr>
                                <tr>
                                    <th>Title</th>
                                    <th>No. of People</th>
                                </tr>
                                
                            <?php
							$counter = 0;
							 
                            $data = array();
                             foreach ($pages->get("name=candidates")->children() as $candidate_page) {
                                 $technical=strtolower($candidate_page->skills);
                                 $str_arr = explode (",", $technical); 
                                $str=array_filter($str_arr);
                                 
                                //  $result=array_intersect_key($data,$str_arr);
                                //    print_r($result);
                                
                                 foreach( $str as $key){
                                     $key=trim($key);
                                // foreach( array_key_exists("c", $str_arr) as $key){
                                   // print_r($str_arr);
                                     if(array_key_exists($key, $data)){
                                        // echo "found";
                                          $data[$key]++;
                                        }
                                        else{
                                            $data[$key]=1;
                                        }
                                    
                                 }
                                     
                                   // echo $result;
                                   // print_r($result); 
                                //  foreach ($str_arr as $technical){
                                    //  if($str_arr == $data){
                                    //      echo "<br>";
                                    //         echo $data;
                                    //  }
                                    // $result=array_intersect_key($str_arr,$data);
                                    //echo $result;
                                     
                                     //print_r($str_arr); 
                                      //$counter++;
                                 
                                // }
                             }
                              arsort($data);
                             //print_r($data);
                               foreach ($data as $key => $value) {
                                    echo "<tr>";
                                    echo "<td>" . $key . "</td>\n<td>" . $value . "</td>";
                                    echo "</tr>";
								} ?>
								</table>
                            	<!-- /* Empty filter to be added to the query */ -->
	<!-- $only_active_candidates_filter = ""; -->

	<!-- /* Create filter to add if the user account is of a recruiter */ -->
	<!-- if($session->user_designation == "recruiter"){
		$only_active_candidates_filter = "active_status=active";
	} -->
	<?php
        foreach ($pages->get("name=candidates")->children() as $candidate_page) {?>
        <!-- <table>
            <tr>Name</tr>
            <tr>Email</tr>
        </table> -->
        <!-- <ul>
        <li> -->
        <!-- <tr>
        <td> -->
            <?php
            //$candidate_page->first_name. " " . $candidate_page->last_name;
            //echo $candidate_page->first_name; 
              //echo $candidate_page->first_name. " " . $candidate_page->last_name;
              //echo $candidate_page->email;
            ?>
            <!-- </td>
              <td> -->
            <?php
            //$candidate_page->email;
            //echo $candidate_page->first_name; 
              //echo $candidate_page->first_name. " " . $candidate_page->last_name;
              //echo $candidate_page->email;
            ?>
            <!-- </td></tr> -->
        <!-- </li>
        </ul> -->
            <!-- echo $candidate_page->title; -->
	   <?php
	    }

    ?>
</table>
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
	<!-- <script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=4.22"></script> -->
</body>

</html>
