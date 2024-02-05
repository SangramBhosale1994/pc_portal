<?php
    require_once 'includes/admin-header.php';
    	/* For column names and variables */

?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<?php
						$data = new stdClass;
							//soft skills decode data
							$soft_skills_data_matrix=$page->soft_skills_matrix;
							$soft_skills_data_json=json_decode($soft_skills_data_matrix);
							foreach( $soft_skills_data_json as $key => $value){
								$value->number_of_candidates=0;
							}
							
							//technical skills decode data
							$technical_skills_data_matrix=$page->technical_skills_matrix;
							$technical_skills_data_json=json_decode($technical_skills_data_matrix);
							foreach( $technical_skills_data_json as $key => $value){
								$value->number_of_candidates=0;
							}

							//non technical skills decode data
							$non_technical_skills_data_matrix=$page->non_technical_skills_matrix;
							$non_technical_skills_data_json=json_decode($non_technical_skills_data_matrix);
							foreach( $non_technical_skills_data_json as $key => $value){
								$value->number_of_candidates=0;
							}
					
												
					foreach ($pages->get("name=candidates")->children() as $candidate_page) {

						//for skills 
						$skills_arr=strtolower($candidate_page->skills);
						$str_arr = explode (",", $skills_arr); 
						$str=array_filter($str_arr);
				
						foreach( $str as $key){
							$key=trim($key);
						// foreach( array_key_exists("c", $str_arr) as $key){
						// print_r($str_arr);
							if(array_key_exists($key, $skills_data)){
								// echo "found";
								$skills_data[$key]++;
								
							}
							else{
								$skills_data[$key]=1;
							}
							
						}
						$skills_data=$skills_data;

						//for soft skills
						$soft_skills_arr=strtolower($candidate_page->soft_skills);
						$str_arr = explode (",", $soft_skills_arr); 
						$str=array_filter($str_arr);
				
						foreach( $str as $key){
							$key=trim($key);
						// foreach( array_key_exists("c", $str_arr) as $key){
						// print_r($str_arr);
							if(isset($soft_skills_data_json->$key)){
								// echo "found";
								//$data[$key]++;
								$soft_skills_data_json->$key->number_of_candidates++;
							}
							else{
								//$data[$key]=1;
								$soft_skills_data_json->$key=new stdClass;
								$soft_skills_data_json->$key->number_of_candidates=1;
								$soft_skills_data_json->$key->synonyms=array();
							}
							
						}
						//$soft_skills_data=$soft_skills_data;

						// for technical skills
						$technical_skills_arr=strtolower($candidate_page->technical_skills);
						$str_arr = explode (",", $technical_skills_arr); 
						$str=array_filter($str_arr);
				
						foreach( $str as $key){
							$key=trim($key);
						// foreach( array_key_exists("c", $str_arr) as $key){
						// print_r($str_arr);
							if(isset($technical_skills_data_json->$key)){
								// echo "found";
								//$data[$key]++;
								$technical_skills_data_json->$key->number_of_candidates++;
							}
							else{
								//$data[$key]=1;
								$technical_skills_data_json->$key=new stdClass;
								$technical_skills_data_json->$key->number_of_candidates=1;
								$technical_skills_data_json->$key->synonyms=array();
							}
							
						}
						//$technical_skills_data=$technical_skills_data;

						// for non-technical skills
						$non_technical_skills_arr=strtolower($candidate_page->non_technical_skills);
						$str_arr = explode (",", $non_technical_skills_arr); 
						$str=array_filter($str_arr);
				
						foreach( $str as $key){
							$key=trim($key);

							if(isset($non_technical_skills_data_json->$key)){
								// echo "found";
								//$data[$key]++;
								$non_technical_skills_data_json->$key->number_of_candidates++;
							}
							else{
								//$data[$key]=1;
								$non_technical_skills_data_json->$key=new stdClass;
								$non_technical_skills_data_json->$key->number_of_candidates=1;
								$non_technical_skills_data_json->$key->synonyms=array();
							}
							
						}
						//$non_technical_skills_data=$non_technical_skills_data;

					}
					arsort($skills_data);
					arsort($soft_skills_data_json);
					arsort($technical_skills_data_json);
					arsort($non_technical_skills_data_json);

					//print_r($data);
						//soft skills data
						$data_json_soft_skills=json_encode($soft_skills_data_json);
						//echo $data_json_soft_skills;
						$page->soft_skills_matrix=$data_json_soft_skills;

						//technical skills data
						$data_json_technical_skills=json_encode($technical_skills_data_json);
						//echo $data_json_technical_skills;
						$page->technical_skills_matrix=$data_json_technical_skills;

						//non-technical skills data
						$data_json_non_technical_skills=json_encode($non_technical_skills_data_json);
						//echo $data_json_non_technical_skills;
						$page->non_technical_skills_matrix=$data_json_non_technical_skills;

						$page->of(false);
						$page->save();
					?>
					<div class="card shadow mb-4">
						<div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
                            <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist" style="width:100%;">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-skills-tab" data-toggle="pill" href="#pills-skills" role="tab" aria-controls="pills-home" aria-selected="true">Skills</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-soft-skills-tab" data-toggle="pill" href="#pills-soft-skills" role="tab" aria-controls="pills-profile" aria-selected="false">Soft Skills</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-technical-skills-tab" data-toggle="pill" href="#pills-technical-skills" role="tab" aria-controls="pills-contact" aria-selected="false">Technical Skills</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-non-technical-skills-tab" data-toggle="pill" href="#pills-non-technical-skills" role="tab" aria-controls="pills-contact" aria-selected="false">Non-Technical Skills</a>
                                </li>
                            </ul>
                            
						</div>

						<div id="table_container_card_body" class="card-body">
							<h3 id="table_loading" ></h3>

                           <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-skills" role="tabpanel" aria-labelledby="pills-home-tab">
									<div id="table_container" class="table-responsive">
										<table id="skills_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Skill</th>
													<th>Candidates</th>
												</tr>
											</thead>
												<tbody>
													<?php
													foreach ($skills_data as $key => $value) {
														// echo "<tr>";
														// echo "<td>" . $key . "</td>\n<td>" . $value . "</td>";
														// echo "</tr>";
													
													?>
														<tr>
															<td><?=$key;?></td>
															<td><?=$value;?></td>
														</tr>
												<?php } ?>
													</tbody>
													
										</table>
									
									</div>
                                </div>
                                <div class="tab-pane fade" id="pills-soft-skills" role="tabpanel" aria-labelledby="pills-profile-tab">
									<div id="table_container" class="table-responsive">
										<table id="soft_skills_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Skill</th>
													<th>Candidates</th>
												</tr>
											</thead>
											
													<tbody>
														<?php
														foreach ($data as $key => $value) {
															// echo "<tr>";
															// echo "<td>" . $key . "</td>\n<td>" . $value . "</td>";
															// echo "</tr>";
														
														?>
															<tr>
																<td><?=$key;?></td>
																<td><?=$value;?></td>
															</tr>
													<?php } ?>
													</tbody>
										</table>
									</div>
								
								</div>
                                <div class="tab-pane fade" id="pills-technical-skills" role="tabpanel" aria-labelledby="pills-contact-tab">
									<div id="table_container" class="table-responsive">
										<?php
												//$data=array();
												$data = new stdClass;
												$data=$page->non_technical_skills_matrix;
													$data_json=json_decode($data);
													foreach( $data_json as $key => $value){
														$value->number_of_candidates=0;
													}
											?>
										<table id="technical_skills_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Skill</th>
													<th>Candidates</th>
												</tr>
											</thead>
											<?php
												$data = array();
												foreach ($pages->get("name=candidates")->children() as $candidate_page) {
													$technical_skills_arr=strtolower($candidate_page->technical_skills);
													$str_arr = explode (",", $technical_skills_arr); 
													$str=array_filter($str_arr);
											
													foreach( $str as $key){
														$key=trim($key);
													// foreach( array_key_exists("c", $str_arr) as $key){
													// print_r($str_arr);
														if(array_key_exists($key, $data)){
															// echo "found";
															//$data[$key]++;
															$data[$key]['number_of_candidates']++;
														}
														else{
															//$data[$key]=1;
															$data[$key]['number_of_candidates']=1;
															$data[$key]['synonyms']=array();
														}
														
													}
												}
												arsort($data);
												//print_r($data);
												$data_json=json_encode($data);
												echo $data_json;
													$page->technical_skills_matrix=$data_json;
													$page->of(false);
													$page->save();
												?>
													<tbody>
														<?php
														foreach ($data as $key => $value) {
															// echo "<tr>";
															// echo "<td>" . $key . "</td>\n<td>" . $value . "</td>";
															// echo "</tr>";
														
														?>
															<tr>
																<td><?=$key;?></td>
																<td><?=$value;?></td>
															</tr>
													<?php } ?>
													</tbody>
										</table>
									</div>
								</div>
                                <div class="tab-pane fade" id="pills-non-technical-skills" role="tabpanel" aria-labelledby="pills-contact-tab">
									<div id="table_container" class="table-responsive">
										
											<?php
												//$data=array();
												$data = new stdClass;
												$data=$page->non_technical_skills_matrix;
													$data_json=json_decode($data);
													//echo $data_json;
													//print_r($data_json);
													//foreach( $data_json as $key){
														// if(isset($data_json->$key)){
														// 	// echo "found";
														// 	//$data[$key]++;
														// 	$data_json->$key->number_of_candidates++;
														// }
														// else{
														// 	//$data[$key]=1;
														// 	$data_json->$key->number_of_candidates=0;
														// 	$data_json[$key]['synonyms']=array();
														
														// }
													// 	$data_json->$key->number_of_candidates=0;
													// }

													foreach( $data_json as $key => $value){
														// if(isset($data_json->$key)){
														// 	// echo "found";
														// 	//$data[$key]++;
														// 	$data_json->$key->number_of_candidates++;
														// }
														// else{
														// 	//$data[$key]=1;
														// 	$data_json->$key->number_of_candidates=0;
														// 	$data_json[$key]['synonyms']=array();
														
														// }
														//print "$key => $value";
														//echo "<hr>";
														$value->number_of_candidates=0;
													}



											?>
											<table id="non_technical_skills_dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Skill</th>
													<th>Candidates</th>
												</tr>
											</thead>
											<?php
												foreach ($pages->get("name=candidates")->children() as $candidate_page) {
													$non_technical_skills_arr=strtolower($candidate_page->non_technical_skills);
													$str_arr = explode (",", $non_technical_skills_arr); 
													$str=array_filter($str_arr);
													
													// $data_json=json_encode($data_json);
													// echo $data_json;
													foreach( $str as $key){

														$key=trim($key);
													// foreach( array_key_exists("c", $str_arr) as $key){
													// print_r($str_arr);
														if(isset($data_json->$key)){
															// echo "found";
															//$data[$key]++;
															$data_json->$key->number_of_candidates++;
														}
														else{
															//$data[$key]=1;
															$data_json->$key=new stdClass;
															$data_json->$key->number_of_candidates=1;
															$data_json->$key->synonyms=array();
														// $data[$key]['number_of_candidates']++;
														// }
														// else{
														// 	//$data[$key]=1;
														// 	$data[$key]['number_of_candidates']=1;
														// 	$data[$key]['synonyms']=array();
														}
														
													}
												}
												//arsort($data_json);
												//print_r($data);
													$data_json=json_encode($data_json);
													 echo $data_json;
													$page->non_technical_skills_matrix=$data_json;
													$page->of(false);
													$page->save();
												?>
													<tbody>
														<?php
														foreach ($data as $key => $value) {
															// echo "<tr>";
															// echo "<td>" . $key . "</td>\n<td>" . $value . "</td>";
															// echo "</tr>";
														
														?>
															<tr>
																<td><?=$key;?></td>
																<td><?=$value;?></td>
															</tr>
													<?php } ?>
													</tbody>
										</table>
									</div>
								</div>
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
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=4.22"></script>
</body>

</html>
