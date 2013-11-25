jQuery(document).ready(function($){

	$("#input_venue").autocomplete('venues.php', {
	  minChars: 3,
	  onItemSelect: function(evt, ui) {
	  	// when a venue is selected, populate related fields in this form
			$("#venue_id").val(evt.data);
	    $( "#venue_search" ).click();
		}
	});

	$( "#venue_search" ).click(function() {
	  $( "#venue_search" ).addClass("acLoading");
		$.ajax({
		  type: "POST",
		  dataType: 'json',
		  url: "pictures.php",
		  data: { foursquare_id: $("#venue_id").val() }
		})
		  .done(function( msg ) {
		  	html = "";
		  	for (pic in msg.data) {
		  		html += "<a class='group col-md-3' rel='group1' href='"+msg.data[pic].images.standard_resolution.url+"'><img class='img-thumbnail' src='"+msg.data[pic].images.thumbnail.url+"'></a>"
				}
				if(html == "") {
		    	alert("No pictures for selected venue");
		    } else {
		    	$( "#pictures" ).html( html );
		    }
	      $( "#venue_search" ).removeClass("acLoading");
		  });
		});
	});

$(function() {
  $('a.group').live('mouseover', function(){ $(this).fancybox() });
});
