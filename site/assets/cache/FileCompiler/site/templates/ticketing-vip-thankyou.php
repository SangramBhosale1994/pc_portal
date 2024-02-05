	<?php

 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
 include(\ProcessWire\wire('files')->compile('includes/send_mail_ticketing.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>
	<div class="container">
				<h1 class="text-center">	 </h1>
	
		<div class="row" style="margin-left: 2rem; margin-right: 2rem;">
			<div class=" col-md-12 text-center " style="border:3px solid #000033">
			    <h1 class="text-center"></h1>
				
				<p class="" style="">
					<?=$page->ticketing_vip_thankyou?>
				</p>
			</div>
		</div>
		<div class="[ container ] [ mb-5 ]" style="/*height:300px;*/">
			<div class="d-flex justify-content-center" style="margin-top:3rem;">
				<a target="_blank" href="https://www.thepridecircle.com/rise2021/"  ><button class="btn btn-primary text-center">VISIT RISE-2021</button></a>
				
			</div>
			
		</div>
		
		<!--<div class="row" style="margin-left: 2rem; margin-right: 2rem;">-->
		<!--	<div class=" col-md-12" style="border:3px solid #000033">-->
		<!--		<p class="text-center" style="">-->
		<!--			<?=$page->ticketing_terms_conditions?>-->
		<!--		</p>-->
		<!--	</div>-->
		<!--</div>-->
		
	</div>



	<html>
	
	<body>
	

		
		
	













	

	<?php
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
	?>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

	<script type="text/javascript">
	/*
	--------------------------------------------------
	JQuery required
	By Amrut Todkar 2021-03-16 (copied from IWEI code, form page script: script.js)
	--------------------------------------------------
	*/

	$(document).ready(function(){
console.log(1);
	/* Convert form to PDF */
	// var doc = new jsPDF();
	// var specialElementHandlers = {
	//     '#editor': function (element, renderer) {
	//         return true;
	//     }
	// };
// invoice-container

		$('#invoice-download-button').click(function () {
			$(this).html('downloading...');
			$(this).prop('disabled', 'true');
console.log(2);
		 	CreatePDFfromHTML();
	//     doc.fromHTML($('#content').html(), 15, 15, {
	//         'width': 170,
	//             'elementHandlers': specialElementHandlers
	//     });
	//     doc.save('sample-file.pdf');
		});
/* Convert form to PDF END */

		/* funciton to convert to pdf */
		function CreatePDFfromHTML() {
			var HTML_Width = $(".pdfs").width();
			var HTML_Height = $(".pdfs").height();
			var top_left_margin = 15;
			var PDF_Width = HTML_Width + (top_left_margin * 2);
			var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
			var canvas_image_width = HTML_Width;
			var canvas_image_height = HTML_Height;
			var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;


			//var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);

			//let canvas_array = [];

			//let loop_counter = 0;
			//$(".section-pills").each(function(){
			//$("#home-tab").click();

			// $("#PoliciesandBenefits").tab('show');
			// $("#TheEmployeeLifecycle").tab('show');
			// $("#LGBTEmployeeResourceGroup").tab('show');
			// $("#AlliesAndRoleModels").tab('show');
			// $("#SeniorLeadership").tab('show');
			// $("#Monitoring").tab('show');
			// $("#Procurement").tab('show');
			// $("#CommunityEngagement").tab('show');


			// $("#AdditionalWork").tab('show');

			// $("#PoliciesandBenefits").tab('show');
			html2canvas($(".pdfs")[0]).then(function (canvas){
				// HTML_Width = $(".pdfs").width();
				// HTML_Height = $(".pdfs").height();
				// top_left_margin = 15;
				// PDF_Width = HTML_Width + (top_left_margin * 2);
				// PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
				// canvas_image_width = HTML_Width;
				// canvas_image_height = HTML_Height;
				// totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
				//var imgData = canvas.toDataURL("image/jpeg", 1.0);
				//canvas_array.push(imgData);
				//loop_counter++;
				var imgData = canvas.toDataURL("image/jpeg", 1.0);	
				var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);

				pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
				for (var i = 1; i <= totalPDFPages; i++) { 
console.log("asd");
					pdf.addPage(PDF_Width, PDF_Height);
					pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
				}
				//pdf.addPage(PDF_Width, PDF_Height);
				 //download_pdf(loop_counter);
				//$(".html-content").hide();
				// $("#home-tab").click();
				// $("#AdditionalWork").removeClass('active')
				// $("#PoliciesandBenefits").tab('show')
				$('#invoice-download-button').html('Download Survey');
				$('#invoice-download-button').prop('disabled', false); 

				pdf.save("RISE2021_INVOICE.pdf");
			});
		}
		/* funciton to convert to pdf END */
	});
	</script>

	</body>

	</html>
