<?php

$rootpath = $config->urls->templates;
?>
		
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <link rel="icon" href="<?=$urls->httpTemplates?>images/index.png" sizes="32x32" /> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- old css for datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
	<!-- Document Title
	============================================= -->
	<title>Access Demo Modules Data | Elearn</title>
<style>
  .table-container {
  overflow-x: scroll !important;
  width: 100% !important;
}

table {
  width: auto !important;
  white-space: nowrap !important;
}
div.dataTables_wrapper {
        /* width: 800px; */
        margin: 0 auto;
    }
</style>

</head>


<body class="stretched">

<div class="table-container container-fluid table-responsive py-3"> 
<h1 style="font-weight: 900 !important;text-align:center;">Access Demo Modules Data</h1>

<table  id="contact-us-info" class="display mt-4" style="width:100%">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Sr.No</th>
      <th scope="col">User Name</th>
      <th scope="col">Email Address</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Designation</th>
      <th scope="col">Company Name</th>
      <th scope="col">Our Offerings</th>
      <th scope="col">Monthly Updates</th>
      <th scope="col">Submit Date</th>
      <th scope="col">Submit Time</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    $counter = 1;
    foreach($page->children() as $data){
    ?>
    <tr>
      <th scope="row"><?php echo $counter ;?></th>
      <td><?=$data->title?></td>
      <td><?=$data->heading2?></td>
      <td><?=$data->first_name?></td>
      <td><?=$data->heading4?></td>
      <td><?=$data->heading5?></td>
      <td><?=$data->heading6?></td>
      <td><?=$data->heading7?></td>
      <td><?php echo date('d/m/Y', $data->published + 60*60*5.50);?></td>
      <td><?php echo date('h:i A', $data->published + 60*60*5.50);?></td>
    </tr>
    <?php
    $counter++;
    }
    ?>
    
  </tbody>
</table>
</div>
<script>
  const table = document.getElementById("table");
const tableContainer = document.querySelector(".table-container");

tableContainer.addEventListener("scroll", function() {
  table.style.transform = `translateX(-${this.scrollLeft}px)`;
});

</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- js by pooja for datatable -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<!-- js by pooja for datatable -->
<script>
		$(document).ready(function () {
			$('#contact-us-info').DataTable({
				// scrollX: true,
			});
		});
</script>
</body>
</html>
