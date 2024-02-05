<?php
	// require_once(\ProcessWire\wire('files')->compile('includes/admin-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>
				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->

					<!-- DataTales Example -->
					<div class="card shadow mb-4">
            <div class="[ card-header ][ py-3 ][ d-flex flex-row justify-content-between ]">
                        
							<a href="<?=$config->urls->httpRoot ?>resume/pc-admin/admin-candidate-table/"><button id="" class="[ btn btn-primary ]( selected-action-button )" type="button"><i class="fa fa-arrow-alt-circle-left"></i> Back</button></a>

						</div>
					
						<div id="table_container_card_body" class="card-body">
							<div id="table_container" class="table-responsive">
                <!-- <input id="searchInput" type="text">  -->
								<table id="dataTable" class="[ table table-bordered hover ]" width="100%" cellspacing="0" >
                 <div class="text-left">
                    <?php
                    read_resume();
                    ?>
                  </div>
								</table>
							</div>
						</div>
          </div>
        </div>

<?php

    function read_resume(){
      /** install pdfparser-master and composer then inlude for pdf reading */
 include_once(\ProcessWire\wire('files')->compile(\ProcessWire\wire('config')->paths->templates.'pdfparser-master/vendor/autoload.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
        echo "Following resumes are read:-<br>";
        // $current_date=
         /** get current date timestamp */
        $current_date=strtotime(date("Y-m-d"));
        // $current_date=strtotime("2022-04-19");
        /** minus 24 hours in current date timestamp because check candidate resume upload or add timestamp is greater than current date */
        $current_timestamp=$current_date - 24*60*60;
				// echo date("Y-m-d",$current_timestamp);
        // $current_timestamp=$current_date;
			
      foreach(\ProcessWire\wire('pages')->get("name=candidates")->children("created|modified>".$current_timestamp) as $candidate_page){
        // echo $candidate_page->published;
        // echo $candidate_page->modified;
        $candidate_resume=$candidate_page->resume;
				// try{
					
					if($candidate_page->resume->ext =='pdf' ){
          
						// Parse pdf file and build necessary objects.
						$parser = new \Smalot\PdfParser\Parser();
						// $pdf    = $parser->parseFile('Complaint_And_Monitoring_Docfinal.pdf');
						// echo filesize($candidate_page->resume);
						// if($candidate_page->id=="1084"){
							
						// 	continue;

						// }
						
						// echo $candidate_page->resume->filename;
						if(filesize($candidate_page->resume->filename)!=0){
							/** get uploaded file in processwire or db is assing to $pdf */
							$pdf    = $parser->parseFile($candidate_page->resume->httpUrl);
						
							/** for reading text of pdf use getText() is assign to $text */
							$resume_text = $pdf->getText();
							/** All extracting text is set to new page means candidate page resume_content field */
							
								$candidate_page->resume_contents=$resume_text;
								$candidate_page->of(false);
								$candidate_page->save();
								// echo "Resume read successfully!<br>";
								// echo "$candidate_page->id";
								echo "$candidate_page->oauth_gmail - Done.<br>";
						}
						else{
							echo "$candidate_page->oauth_gmail - Content not present in file.<br>";
						}
						
					}
					else{
						 echo "$candidate_page->oauth_gmail - Uploaded resume is not a pdf file.<br>";
					}

				// }
				// catch(Exception $e){

				// }
        

      }
    }
   
?>

<script>
	   // $(document).ready(function(){
	   //     $("#reset").on("click",function(){
	   //         //$('#search_container_form')[0].reset();
	   //         //$('#search_container_form').val("");
	   //         $('#key_skills').tagator('refresh');
	   //        // $('#preferred_location').tagator('refresh');
	   //        // $('#lgbt_verification').tagator('refresh');
	   //     })
	        
	   // });
	   //function demoreset(){
	   //    $('#search_container_form').reset();
	   //    $('#key_skills').tagator('refresh');
	   //}
	    
	    
	</script>
	<!-- Bootstrap core JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.min.js"></script>
	<script src="<?= $rootpath;?>scripts/popper.min.js"></script>
	<script src="<?= $rootpath;?>scripts/bootstrap.min.js"></script>
		
	

	<!-- Core plugin JavaScript-->
	<script src="<?= $rootpath;?>scripts/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= $rootpath;?>scripts/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?= $rootpath;?>scripts/jquery.dataTables.min.js?v=<?=mt_rand(0,999)?>"></script>
	<script src="<?= $rootpath;?>scripts/dataTables.bootstrap4.min.js"></script>


	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js "></script>
	
	<script src="<?= $rootpath;?>scripts/fm.tagator.jquery.js"></script>


	<!-- Page level custom scripts -->
	<script src="<?= $rootpath;?>scripts/<?=$page->template?>.js?v=<?=mt_rand(0,999)?>"></script>
	
	
	<!--<script>-->
	<!--	$(document).ready( function () {-->
	<!--		$('#dataTable').DataTable({-->
	<!--			"paging": true-->
	<!--		});-->

	<!--		$('#dataTable').show();-->


	<!--	} );-->
	<!--</script>-->


</body>

</html>