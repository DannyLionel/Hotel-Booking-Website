<?php
require 'config.php';
$sqla = "DELETE FROM bookings";
$resulta = $conn->query($sqla);
$sqlb = "UPDATE rooms SET occupied = '0' WHERE rooms.occupied = '1'";
$resultb = $conn->query($sqlb);

if($resulta & $resultb){
  echo "<h1>Success</h1>";
   echo "<h2>Cleared all bookings for all users and reseted all room status to 0</h2><br>";
  }
else {
  echo "<h1>Error</h1>";
   echo "<h2>Failed to clear all bookings and change all room status</h2><br>";
  }

 ?>
