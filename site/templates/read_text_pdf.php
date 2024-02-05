<?php
 
// Include Composer autoloader if not already done.
include 'pdfparser-master/vendor/autoload.php';
 
// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
// $pdf    = $parser->parseFile('Complaint_And_Monitoring_Docfinal.pdf');
$pdf    = $parser->parseFile("../../../..".$page->resume->url);

$text = $pdf->getText();
$page->resume_contents=$text;
$page->of(false);
$page->save();
//$text->save($page->$resume_contents);
echo $text;
 
?>