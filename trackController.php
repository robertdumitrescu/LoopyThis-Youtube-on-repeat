<?php





require_once 'classes/database.php';

// session_start();

$track_instance = new DatabaseQuery();

$postdata = file_get_contents("php://input");

$request = json_decode($postdata);



if (property_exists($request, "client_timestamp") && property_exists($request, "client_gmt")) {

    if (!empty($request->client_timestamp)) {
        $client_timestamp_track = $request->client_timestamp;
    } else {
        $client_timestamp_track = "Not found";
    }

    if (!empty($request->client_gmt)) {
        $client_gmt_track = $request->client_gmt;
    } else {
        $client_gmt_track = "Not found";
    }

} else {
    $client_timestamp_track = "Not found";
    $client_gmt_track = "Not found";
}




if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $client_ip = $_SERVER['HTTP_CLIENT_IP'];
} else {
    $client_ip = "Not found";
}

if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $x_forward_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $x_forward_for = "Not found";
}

if (!empty($_SERVER['REMOTE_ADDR'])) {
    $remote_adress = $_SERVER['REMOTE_ADDR'];
} else {
    $remote_adress = "Not found";
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];

$location = json_decode(file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']));

if (!empty($location->country_name) || isset($location->country_name)) {
    $country_name_track = $location->country_name;
} else {
    $country_name_track = "Not found";
}

if (!empty($location->city) || isset($location->city)) {
    $city_name_track = $location->city;
} else {
    $city_name_track = "Not found";
}

if (!empty($location->time_zone) || isset($location->time_zone)) {
    $time_zone_track = $location->time_zone;
} else {
    $time_zone_track = "Not found";
}




/*echo $client_ip;
echo "<br>";
echo $x_forward_for;
echo "<br>";
echo $remote_adress;
echo "<br>";
echo $user_agent;
echo "<br>";
echo $country_name_track;
echo "<br>";
echo $city_name_track;
echo "<br>";
echo $time_zone_track;*/

$track_instance->storeTrackData($client_ip, $x_forward_for, $remote_adress, $user_agent, $country_name_track, $city_name_track, $time_zone_track, $client_timestamp_track, $client_gmt_track);

?>


