<?php

/** create XML file */

require 'config.php';

$query = "SELECT id, name, rating, city, state, street_address, zip_code FROM hotels";

$hotelsArray = array();

if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
       array_push($hotelsArray, $row);
    }
    if(count($hotelsArray)){
         createXMLfile($hotelsArray);
     }
    $result->free();
}

$conn->close();

function createXMLfile($hotelsArray){

   $filePath = 'hotels.xml';
   $dom     = new DOMDocument('1.0', 'utf-8');
   $root      = $dom->createElement('hotels');

   for($i=0; $i<count($hotelsArray); $i++){

     $id      =  $hotelsArray[$i]['id'];
     $name  = htmlspecialchars($hotelsArray[$i]['name']);
     $rating    =  $hotelsArray[$i]['rating'];
     $city     =  $hotelsArray[$i]['city'];
     $state = $hotelsArray[$i]['state'];
     $address =  $hotelsArray[$i]['street_address'];
     $zip =  $hotelsArray[$i]['zip_code'];

     $hotel = $dom->createElement('hotel');
     $hotelid     = $dom->createElement('id', $id);
     $hotel->appendChild($hotelid);
     $hotelname     = $dom->createElement('name', $name);
     $hotel->appendChild($hotelname);
     $hotelrating     = $dom->createElement('rating', $rating);
     $hotel->appendChild($hotelrating);
     $hotelcity    = $dom->createElement('city', $city);
     $hotel->appendChild($hotelcity);
     $hotelstate    = $dom->createElement('state', $state);
     $hotel->appendChild($hotelstate);
     $hotelstreet_address     = $dom->createElement('address', $address);
     $hotel->appendChild($hotelstreet_address);
     $hotelzip_code     = $dom->createElement('zip', $zip);
     $hotel->appendChild($hotelzip_code);
     $root->appendChild($hotel);

   }

   $dom->appendChild($root);
   $dom->save($filePath);
 }
  ?>
