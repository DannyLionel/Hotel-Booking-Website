<?php
if ($_GET['province'] == null || $_GET['city'] == null || $_GET['bookin'] == null || $_GET['bookout'] == null || $_GET['hotelid'] == null || $_GET['roomid'] == null ||
$_GET['totaldays'] == null || $_GET['price'] == null) {
	header ("Location: index.php");
}
	else {
session_start();
if(!isset($_SESSION["sess_user"])){
		$_SESSION['redirecturl'] = $_SERVER['REQUEST_URI'];
	header("location:login.php");
} else {
  ?>
<html>
<?php
require 'config.php';
 ?>
 <body id='body'>
  <h1>Hotel Booking</h1>
    <h2>Welcome to the BookMyFunnyHotel.com</h2>
    <?php
		$sqlinfo = "SELECT firstname, lastname, signupdate, username, email FROM users WHERE id ='".$_SESSION['guestid']."'";
    $resultinfo = $conn->query($sqlinfo);
    if ($resultinfo->num_rows > 0) {
        while($row = $resultinfo->fetch_assoc()) {
          echo "<h3>Welcome ".$row['firstname']." ".$row['lastname']."</h3>";
          echo "<h4>|| Logged in as ".$row['username']." || Email:".$row['email']." || You are a member since ".date("m-d-Y", strtotime($row['signupdate']))." ||</h4>";
			  }
}
     ?>
    <a href="viewbookings.php"><button id="viewbookings">View Bookings</button></a>
    <a href="logout.php"><button id="logout">Logout</button></a>
		<p style='text-align:center'><br><img src="hotel.jpg" style="width:1170px;height:398px"></img></p><br>
<?php
$guestid = $_SESSION['guestid'];
$bookin = $_GET['bookin'];
$bookout = $_GET['bookout'];
$hotelid = $_GET['hotelid'];
$roomid = $_GET['roomid'];
$date=date("Y-m-d");
$user = $_SESSION["sess_user"];
$totaldays = $_GET['totaldays'];

$sql = "SELECT id FROM bookings";
$result = $conn->query($sql);
$count = 1;
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $count = $count + 1;
  }
  }

$sqla = "SELECT * FROM bookings where room='".$roomid."'";
$resulta = $conn->query($sqla);
if ($resulta->num_rows == 0) {

$sqlb="INSERT INTO bookings(id,date_in,date_out,user,number_of_nights,date,room) VALUES('$count','$bookin','$bookout','$guestid','$totaldays','$date','$roomid')";
$resultb=$conn->query($sqlb);
    if($resultb){
       echo "<br><label>Your room has been booked successfully</label><br>";

			 $sqlc = "UPDATE rooms SET occupied='1' WHERE id='".$roomid."'";
 			$resultc=$conn->query($sqlc);

 			if($resultc){
 			   echo "<br><label>Room status for the booked room has changed</label><br>";

 			  }
 			else {
 			   echo "<br><label>Failed to change room status</label><br>";
 			  }


      }
    else {
       echo "<br><label>Failed to book your room</label><br>";
      }

}
 ?>
<br>
 <form name="goback" method="post">
 <input type='submit' name='goback' value='Previous Page'></input>
</form>
<?php
if(array_key_exists('goback',$_POST)){
  header("Location: roomresults.php?province=".$_GET['province']."&city=".$_GET['city']."&bookin=".$_GET['bookin']."&bookout=".$_GET['bookout']."&hotelid=".$_GET['hotelid']."");
}
 ?>

</html>
<?php }} ?>
