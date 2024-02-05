// Call the dataTables jQuery plugin
$(document).ready(function() {
	$('#dataTable').DataTable({
		dom: 'Bfrtip',
		buttons: [
		'copy', 'excel'
		],
		 "order": [[ 0, "desc" ]]
		/*buttons: [
		'copy', 'csv', 'excel', 'pdf', 'print'
		]*/
		/*"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]*/
	});
});
