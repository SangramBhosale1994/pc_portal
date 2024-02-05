<?php
			include 'includes/general_header.php';
		?>
		
<div data-module="Tokens" 
     data-module-endpoint="tokens.json?q=${term}" 
     data-module-strict="false" 
     data-action="focus" 
     data-module-initial="One, Two">
     <div data-name="tokensContainer"></div>
     <input type="text"
        name="value"
        data-name="input"
        data-action="search"
        data-action-type="input"
        placeholder="Search for something">
     <div data-name="resultsContainer"></div>
</div><br>