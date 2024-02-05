<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}
	require_once 'includes/ticketing-header.php';
?>


        
        <div class="container" style="margin-top:2rem;">
            <h2 style="font-family: 'Montserrat', sans-serif;" class="text-center"><?=$page->title?></h2>
            
            <div>
                <?=$page->ticketing_terms_conditions?>
            </div>
            
        </div>
        
</body>
<?php
	require_once 'includes/ticketing-footer.php';
?>
</html>