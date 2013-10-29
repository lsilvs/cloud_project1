<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Lucas Silvestre">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Project for Cloud Computing class</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.autocomplete.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="assets/css/jumbotron-narrow.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="assets/js/jquery.autocomplete.js"></script>

  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <h3 class="text-muted">Pic by Loc</h3>
      </div>

      <div class="jumbotron">
        <h1>Choose your venue</h1>
        <p class="lead">Enter the name of a place and let us look for photos taken on it.</p>
        <div class="input-group input-group-lg">
		      <input type="text" class="form-control" id="input_venue" name="input_venue" value="" />
		      <input type="hidden" class="form-control" id="venue_id" name="venue_id" value="" />
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button" id="venue_search">Go!</button>
		      </span>
		    </div><!-- /input-group -->
      </div>

      <div class="row marketing" id="pictures">
        
      </div>

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript">
    jQuery(document).ready(function($){

    	$("#input_venue").autocomplete('venues.php', {
        minChars: 3,
        onItemSelect: function(evt, ui) {
        	// when a venue is selected, populate related fields in this form
					$("#venue_id").val(evt.data);
					// this.form.state.value = ui.item.state;
				}
		  });

		  $( "#venue_search" ).click(function() {
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
				  });
			});

	  });
		</script>
  </body>
</html>
