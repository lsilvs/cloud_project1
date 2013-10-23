<?php
	// Supply a user id and an access token
	$instagram['userid'] = "614631";
	$instagram['accessToken'] = "614631.ab103e5.86703194cbee4b3cbf7efd02920d8a71";
	$foursquare['oauth_token'] = "Y20FGZX51DY2LU5NIJE2FLTFS1BASWAVZEF25GQWT1F2MBHN";
	$foursquare['query'] = "mineirao";

	// Gets our data
	function fetchData($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		$result = curl_exec($ch);
		curl_close($ch); 
		return $result;
	}

	if($_GET['location']) {
		$foursquare_v2_id = $_GET['location'];
		$location_result = fetchData("https://api.instagram.com/v1/locations/search?foursquare_v2_id={$foursquare_v2_id}&access_token={$instagram['accessToken']}");
		$location_result = json_decode($location_result);

		foreach ($location_result->data as $location) {
			$locationid = $location->id;	
		}

		// Pulls and parses data.
		$result = fetchData("https://api.instagram.com/v1/locations/{$locationid}/media/recent?access_token={$instagram['accessToken']}");
		$result = json_decode($result);
	} else {
		$foursquare_result = fetchData("https://api.foursquare.com/v2/venues/search?intent=global&query={$foursquare['query']}&oauth_token={$foursquare['oauth_token']}&v=20131022");
		$foursquare_result = json_decode($foursquare_result);

		foreach ($foursquare_result->response->venues as $location) {
			// $foursquare_v2_id = $location->id;	
			echo "<a href='/instagram/?location={$location->id}'>{$location->name}</a><br/>";
		}
	}
?>


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
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <div class="input-group input-group-lg">
		      <input type="text" class="form-control" id="input_venue" name="input_venue" value="" />
		      <input type="hidden" class="form-control" id="venue_id" name="venue_id" value="" />
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="button">Go!</button>
		      </span>
		    </div><!-- /input-group -->
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div> <!-- /container -->

    <?php foreach ($result_asdf->data as $post): ?>
			<!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->
			<a class="group" rel="group1" href="<?= $post->images->standard_resolution->url ?>"><img src="<?= $post->images->thumbnail->url ?>"></a>
		<?php endforeach ?>


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
	  });
		</script>
  </body>
</html>
