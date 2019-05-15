<html>
<?php
require 'config.php';
 ?>
 <h1>Hotel Booking</h1>
 <h2>Get data using XML</h2>
 <body id="body">
  <br>
  <div id='hoteltable' align='center'><table><tr><th>ID</th><th>Hotel Name</th><th>Rating</th><th>City
  </th><th>State</th><th>Address</th><th>Zip Code</th></tr>
<?php

    $hotel = simplexml_load_file('hotels.xml');

  $n = 0;
  foreach($hotel as $info)
  {
    $id = $info->id;
    $name = $info->name;
    $rating = $info->rating;
    $city = $info->city;
    $state = $info->state;
    $address = $info->address;
    $zip = $info->zip;
    echo "<tr><td>".$id."</td><td>".$name."</td><td>".$rating."</td><td>".
      $city."</td><td>".$state."</td><td>".$address."</td><td>".$zip."</td><tr>";
  }
?>
</table></div>
<br><br><br>
</body>
</html>
