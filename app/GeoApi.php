<?php
namespace App;

class GeoApi
{
    public static function generateLatLon($address) {
    	$api_key = env("GOOGLE_MAP_API");
        $prepAddr = preg_replace('/[^A-Za-z0-9\-]/', '+', $address);
        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&key=' . $api_key . '&sensor=false');
        $output = json_decode($geocode);
        // $latitude = $output->results[0]->geometry->location->lat;
        // $longitude = $output->results[0]->geometry->location->lng;
        return $output->results[0]->geometry->location;
    }

}
