<?php
	require_once 'includes/editor-header.php';
	function check_pass_type($value){
	    switch($value){
	        case "vipd1d2f":
	            return "P1";
	        case "vipd1f":
	            return "P2";
	        case "vipd2f":
	            return "P3";
	        case "d1d2f":
	            return "P1";
	        case "d1f":
	            return "P2";
	        case "d2f":
	            return "P3";
	        case "d1s1":
	            return "P4";
	        case "d1s2":
	            return "P5";
	        case "d2s1":
	            return "P6";
	        case "d2s2":
	            return "P7";
	        default:
	            return $value;
	    }
	}
	$all_data_to_show=Array();

    
	
	/*
	    get all VIP attendee page
	*/
	
	foreach($pages->get("name=vip-attendee")->children("sort=-published,verification=verified") as $ticketing_vip_page) {
            $temp_object=new stdClass();
            $temp_object->id=$ticketing_vip_page->serial_id;
            $temp_object->first_name=$ticketing_vip_page->first_name;
            $temp_object->last_name=$ticketing_vip_page->last_name;
            $temp_object->pronoun=$ticketing_vip_page->pronoun;
            $temp_object->country_code=$ticketing_vip_page->phone_country_code;
            $temp_object->phone_number=$ticketing_vip_page->phone_number;
            $temp_object->email=$ticketing_vip_page->email;
            $temp_object->company_name=$ticketing_vip_page->company_name;
            $temp_object->ticket_type="";
            foreach($ticketing_vip_page->children() as $single_ticket)
            {
                if($temp_object->ticket_type==""){
                    $temp_object->ticket_type=$temp_object->ticket_type.check_pass_type($single_ticket->title());
                }
                else{
                    $temp_object->ticket_type=$temp_object->ticket_type." , ".check_pass_type($single_ticket->title());
                
                }
            }
            $temp_object->registation_time=$ticketing_vip_page->created;
            array_push($all_data_to_show,$temp_object);
	}
	
	
	/*
	    get all buyer attendee page
	*/
	
	foreach($pages->get("name=attendee")->children("sort=-published") as $ticketing_vip_page) {
            $temp_object=new stdClass();
            $temp_object->id=$ticketing_vip_page->serial_id;
            $temp_object->first_name=$ticketing_vip_page->first_name;
            $temp_object->last_name=$ticketing_vip_page->last_name;
            $temp_object->pronoun=$ticketing_vip_page->pronoun;
            $temp_object->country_code=$ticketing_vip_page->phone_country_code;
            $temp_object->phone_number=$ticketing_vip_page->phone_number;
            $temp_object->email=$ticketing_vip_page->email;
            $temp_object->company_name=$ticketing_vip_page->company_name;
            $temp_object->ticket_type="";
            foreach($ticketing_vip_page->children() as $single_ticket)
            {
                if($temp_object->ticket_type==""){
                    $temp_object->ticket_type=$temp_object->ticket_type.check_pass_type($single_ticket->title());
                }
                else{
                    $temp_object->ticket_type=$temp_object->ticket_type." , ".check_pass_type($single_ticket->title());
                
                }
            }
            $temp_object->registation_time=$ticketing_vip_page->created;
            array_push($all_data_to_show,$temp_object);
	}
    
    /*
        get all job fair page
    */	

		 /* Code by Amruta jagtap 27-04-2021 split_name($name) is used for spliting first name and last name */
     function split_name($name) {
			$name = trim($name);
			$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
			$first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
			return array($first_name, $last_name);
		}
		/* End Code by Amruta jagtap 27-04-2021 split_name($name) is used for spliting first name and last name*/

	foreach($pages->get("name=pass-applicants")->children("sort=published,pass_verification=verified") as $job_fair_page) {
	    
    	if($pages->get("name=candidates")->child("id=".$job_fair_page->candidate_profile_id.",lgbtq_verification=Confirmed")->id!=0){
            $temp_object=new stdClass();
            $temp_object->id=$job_fair_page->serial_id;

						/* Code by Amruta jagtap 27-04-2021 split first name and last name for display in all attendee data*/
            //$name =$job_fair_page->title;
						$name_array = Array();
						$name_array = split_name($job_fair_page->title);
						//print_r($name_array);
							$temp_object->first_name=$name_array[0];
							 // echo $name_array[0];
							 // echo "-----------------";
							 $temp_object->last_name=$name_array[1];
							// echo $name_array[1];
							 
							 // $temp_object->first_name=$job_fair_page->title;
							 // $temp_object->last_name=$job_fair_page->title;
							 
							 /* End Code by Amruta jagtap 27-04-2021 split first name and last name for display in all attendee data*/

            // $temp_object->first_name=$job_fair_page->title;
            // $temp_object->last_name=$job_fair_page->title;
            $temp_object->pronoun=$job_fair_page->pronoun;
            $temp_object->country_code=$job_fair_page->phone_country_code;
            $temp_object->phone_number=$job_fair_page->phone_number;
            $temp_object->email=$job_fair_page->email;
            $temp_object->company_name="-";
            $temp_object->ticket_type="P8";
            $temp_object->registation_time=$job_fair_page->created;
            array_push($all_data_to_show,$temp_object);
    	    
    	}
	}
	
// 	var_dump($all_data_to_show);
// 	die();
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
						
                        <div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
							<h3>All Attendee Data</h3>
						</div>

						<div id="table_container_card_body" class="card-body">
							<div id="table_container" class="table-responsive">
								<table id="dataTable" class="[ table table-striped table-bordered ]" width="100%" cellspacing="0">
								         <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>First_name</th>
                                                    <th>Last_name</th>
                                                    <th>Pronoun</th>
                                                    <th>country_code</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Company Name</th>
                                                    <th>Tickets Type</th>
                                                    <th>Registation time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach($all_data_to_show as $single_attendee_data){
                                                ?>
                                                    
                                                <tr>
                                                    <td><?=$single_attendee_data->id?></td>
                                                    <td><?=$single_attendee_data->first_name?></td>
                                                    <td><?=$single_attendee_data->last_name?></td>
                                                    <td><?=$single_attendee_data->pronoun?></td>
                                                    <td><?=$single_attendee_data->country_code?></td>
                                                    <td><?=$single_attendee_data->phone_number?></td>
                                                    <td><?=$single_attendee_data->email?></td>
                                                    <td><?=$single_attendee_data->company_name?></td>
                                                    <td><?=$single_attendee_data->ticket_type?></td>
                                                    <td><?=$single_attendee_data->registation_time?></td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>First_name</th>
                                                    <th>Last_name</th>
                                                    <th>Pronoun</th>
                                                    <th>country_code</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Company Name</th>
                                                    <th>Tickets Type</th>
                                                    <th>Registation time</th>
                                                </tr>
                                            </tfoot>
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

	<!--	</div>-->
		<!-- End of Content Wrapper -->

	<!--</div>-->
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<!--<a class="scroll-to-top rounded" href="#page-top">-->
	<!--	<i class="fas fa-angle-up"></i>-->
	<!--</a>-->

	<!-- MODAL :  Edit Profile modal -->
	<!--<div id="sub_user_modal" class="[ modal fade ]" tabindex="-1" role="dialog" aria-labelledby="sub_user_modal" aria-hidden="true">-->
	<!--	<div class="[ modal-dialog modal-lg ]" role="document">-->
	<!--		<div class="[ modal-content ]">-->
	<!--			<div class="[ modal-header ]">-->
	<!--				<h5 class="[ modal-title ]" id="edit_profile_modal_title">Sub-users</h5>-->
	<!--				<button type="button" class="[ close ]" data-dismiss="modal" aria-label="Close">-->
	<!--					<span aria-hidden="true">&times;</span>-->
	<!--				</button>-->
	<!--			</div>-->

	<!--			<form id="sub_user_modal_form" class="[ needs-validation ]" action="" method="POST" enctype="multipart/form-data">-->
	<!--				<div id="edit_profile_modal_body" class="[ modal-body ]">-->
					    
	<!--				</div>-->

	<!--			</form>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<!-- MODAL :  Edit Profile modal End -->
	
	<!-- MODAL :  Column select modal -->
	<!--<div class="modal fade" id="column-select-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
	<!--	<div class="modal-dialog modal-lg" role="document">-->
	<!--		<div class="modal-content">-->
	<!--			<div class="modal-header">-->
	<!--				<h5 class="modal-title" id="exampleModalLabel">Select columns to be shown.</h5>-->
	<!--				<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
	<!--					<span aria-hidden="true">&times;</span>-->
	<!--				</button>-->
	<!--			</div>-->
	<!--			<div id="column_select_checkbox_container" class="modal-body">-->
	<!--				<?php?>-->
						<!--/* Based on what type of user has logged in, decide columns availability */-->
	<!--					$available_columns_to_show = $columns_for_admin;-->


						<!--/* Loop through all the possible column names */-->
	<!--					foreach ($all_columns as $section_title => $checkbox_array) {-->
	<!--				?>-->

	<!--				<div class="[ mt-3 ]">-->
	<!--					<h3><?=$section_title?></h3>-->
	<!--				</div>-->

	<!--				<div class="[ row ]">-->

	<!--					<?php?>-->
	<!--						foreach ($checkbox_array as $column_checkbox_id => $column_checkbox_title) {-->
								<!--/* Check if that column is allowed to be shown, if not continue. */-->
	<!--							if(!array_key_exists($column_checkbox_id, $available_columns_to_show)){-->
	<!--								continue;-->
	<!--							}-->

	<!--							$is_selected = (in_array($column_checkbox_id, json_decode($pages->get($session->user_page_id)->candidate_table_column_array))) ? "checked": "";-->
	<!--					?>-->

	<!--					<div class="[ col-md-4 form-group ]">-->
	<!--						<input id="<?=$column_checkbox_id?>" class="( column_select_checkbox )" type="checkbox" <?=$is_selected?>>-->
	<!--						<label for="<?=$column_checkbox_id?>"><?=$column_checkbox_title?></label>-->
	<!--					</div>-->

	<!--					<?php?>-->
	<!--						}-->
	<!--					?>-->

	<!--				</div>-->

	<!--				<?php?>-->
	<!--					}-->
	<!--				?>-->

	<!--			</div>-->

	<!--			<div class="modal-footer">-->
	<!--				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
	<!--				<button id="column_select_modal_submit" type="button" class="[ btn btn-primary ]" data-dismiss="modal">Save changes</button>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
	<!-- MODAL :  Column select modal End -->

	<!-- MODAL :  Confirm Delete selected modal -->
	<!--<div id="delete_selected_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_selected_modal" aria-hidden="true">-->
	<!--	<div class="modal-dialog" role="document">-->
	<!--		<div class="modal-content">-->
	<!--			<div class="modal-header">-->
	<!--				<h5 class="modal-title" id="exampleModalLabel">Do you really wish to delete the entries with following IDs?</h5>-->
	<!--				<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
	<!--					<span aria-hidden="true">&times;</span>-->
	<!--				</button>-->
	<!--			</div>-->

	<!--			<div id="delete_selected_list_container" class="[ modal-body text-center ]">-->
	<!--				Please select an entry to delete!-->
	<!--			</div>-->

	<!--			<div class="modal-footer">-->
	<!--				<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>-->
	<!--				<button id="delete_selected_modal_submit" type="button" class="[ btn btn-danger ]" data-dismiss="modal" disabled>Delete Permanently</button>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
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
	
	
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>	


	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=4.22"></script>
    <script>
        $(document).ready(function() {
             $('#dataTable').DataTable( {
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv'
                ]
            });
            table.buttons().container().appendTo( '#dataTable_wrapper .col-md-6:eq(0)' );
        } );
    </script>    
</body>

</html>
