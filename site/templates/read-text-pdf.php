<?php
 
// Include Composer autoloader if not already done.
include 'includes/pdfparser-master/pdfparser-master/vendor/autoload.php';
 
// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('Complaint_And_Monitoring_Docfinal.pdf');
 
$text = $pdf->getText();
echo $text;
 
?>