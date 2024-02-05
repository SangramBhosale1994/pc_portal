<?php
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>


        
        <div class="container" style="margin-top:2rem;">
            <h2 style="font-family: 'Montserrat', sans-serif;" class="text-center"><?=$page->title?></h2>
            
            <div>
                <?=$page->ticketing_terms_conditions?>
            </div>
            
        </div>
        
</body>
<?php
 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-footer.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>
</html>