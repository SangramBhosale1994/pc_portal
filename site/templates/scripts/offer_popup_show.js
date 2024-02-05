<script>
	// Wait for the document to load

	$(document).ready(function() {
		$('#offer_popup_modal').modal({
			backdrop: 'static',
			keyboard: false
		});
		// Get the modal
		const modal = $("#offer_popup_modal");
		
		<?php
		global $show_popup,$admin_show_popup;
		// modal.modal("hide");
		// echo "script";
		// echo $show_popup;
		// echo "*****";
		// echo $admin_show_popup;
		if($show_popup == "true" && $admin_show_popup =="true") {
		?>
			// Show the modal
			console.log("show");
			modal.modal("show");
		<?php
		}
		else{
			// echo "else";
		?>
		
		// modal.modal("hide");
		modal.modal("hide");
		$("#offer_popup_modal").modal('hide');
		console.log("hide");
		setTimeout(function() {
			modal.modal("hide");
		}, 100);
		<?php
		}
		?>
	});
</script>