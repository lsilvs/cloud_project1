<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="jquery.fancybox-1.3.4.css" type="text/css">
	<script type='text/javascript' src='jquery.min.js'></script>
	<script type='text/javascript' src='jquery.fancybox-1.3.4.pack.js'></script>
	<script type="text/javascript">
		$(function() {
			$("a.group").fancybox({
				'nextEffect'	:	'fade',
				'prevEffect'	:	'fade',
				'overlayOpacity' :  0.8,
				'overlayColor' : '#000000',
				'arrows' : false,
			});			
		});
	</script>

	<h1>Cloud Project</h1>

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

	<?php foreach ($result->data as $post): ?>
		<!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->
		<a class="group" rel="group1" href="<?= $post->images->standard_resolution->url ?>"><img src="<?= $post->images->thumbnail->url ?>"></a>
	<?php endforeach ?>
</html>