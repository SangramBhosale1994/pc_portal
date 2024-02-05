$(document).ready(function() {
console.log(454)

	/* Searching the event cards on keypress in search */
	$(document).on("keyup", "#events_searchword", function(){
		/* Get search value from the search input */
		let searchword = $(this).val();
console.log(searchword)

		/* Hide all cards */
		$('.event-card-container').hide();

		/* Show cards containing the keyword */
		$('.event-card-container:contains("'+searchword+'")').show();
	})
	/* Searching the event cards END */

	/* Code to make searching case insensitive */
	$.expr[":"].contains = $.expr.createPseudo(function(arg) {
		return function( elem ) {
			return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
	};
	/* Code to make searching case insensitive END */
});
});
