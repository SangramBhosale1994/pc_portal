<?php
/*
	File created 2021-03-07
	Primary code by Amrut Todkar

	This page will show all the tickets added to the cart and the total to the user.
	Page will contain:
	-After adding all the tickets, the user will go to the cart page. The cart page will show a list of all the tickets that the user has added with the information filled for each ticket.
	-The user can remove a ticket from their cart at this point.
	-There will be a button to go back to the Tickets page if they want to go back and add more tickets.
	-Once satisfied with the ticket information, the user can click on “Checkout” page
*/

 require_once(\ProcessWire\wire('files')->compile('includes/ticketing-header.php',array('includes'=>true,'namespace'=>true,'modules'=>true,'skipIfNamespace'=>true)));
?>