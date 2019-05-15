<head>
  <title>Hotel Booking</title>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Bungee' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Graduate' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Glegoo' rel='stylesheet'>
  <script src="js.js"></script>
<?php
$hostname = "192.168.64.2";
$username = "project1";
$password = "project1";
$database = "project";
$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
date_default_timezone_set('EST');
 ?>
</head>
