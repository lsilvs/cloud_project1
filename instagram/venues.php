<?php

  $foursquare['oauth_token'] = "Y20FGZX51DY2LU5NIJE2FLTFS1BASWAVZEF25GQWT1F2MBHN";

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

/*
 * Results array
 */
$results = array();

/*
 * Autocomplete formatter
 */
function autocomplete_format($results) {
    foreach ($results as $result) {
        echo $result[0] . '|' . $result[1] . "\n";
    }
}

/*
 * Search for term if it is given
 */
if (isset($_GET['q'])) {
    $q = strtolower($_GET['q']);
    $q = str_replace(' ', '+', $q);
    $foursquare_result = fetchData("https://api.foursquare.com/v2/venues/search?ll=53.34,-6.25&query={$q}&oauth_token={$foursquare['oauth_token']}&v=20131022");
    $foursquare_result = json_decode($foursquare_result);
    
    if ($q) {
        foreach ($foursquare_result->response->venues as $value) {
            $results[] = array(
                "{$value->name} ({$value->location->city}, {$value->location->country})",
                $value->id
            );
        }
    }
}

/*
 * Output format
 */
$output = 'autocomplete';
if (isset($_GET['output'])) {
    $output = strtolower($_GET['output']);
}

/*
 * Output results
 */
if ($output === 'json') {
    echo json_encode($results);
} else {
    echo autocomplete_format($results);
}

?>