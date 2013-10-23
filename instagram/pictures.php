<?php
	// Supply a user id and an access token
	$instagram['accessToken'] = "614631.ab103e5.86703194cbee4b3cbf7efd02920d8a71";
	$foursquare['oauth_token'] = "Y20FGZX51DY2LU5NIJE2FLTFS1BASWAVZEF25GQWT1F2MBHN";
	
	$foursquare_v2_id = $_POST['foursquare_id'];

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

	if($foursquare_v2_id) {
		$location_result = fetchData("https://api.instagram.com/v1/locations/search?foursquare_v2_id={$foursquare_v2_id}&access_token={$instagram['accessToken']}");
		$location_result = json_decode($location_result);

		$locationid = $location_result->data[0]->id;

		// Pulls and parses data.
		$instagram_media = fetchData("https://api.instagram.com/v1/locations/{$locationid}/media/recent?access_token={$instagram['accessToken']}");
		// $instagram_media = json_decode($instagram_media);
	}

	echo $instagram_media;
?>