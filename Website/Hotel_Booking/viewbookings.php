<?php
session_start();
if(!isset($_SESSION["sess_user"])){
		$_SESSION['redirecturl'] = $_SERVER['REQUEST_URI'];
	header("location:login.php");
} else {
  ?>
<html>
<?php
require 'config.php';
$guestid = $_SESSION['guestid'];
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
    <a href="logout.php"><button id="logout">Logout</button></a>
    <p style='text-align:center'><br><img src="hotel.jpg" style="width:1170px;height:398px"></img></p><br>
    <h3 id='viewbookingsheading3'>The following are your current bookings:</h3>
<?php
$sql="SELECT hotels.name AS v1, rooms.name AS v2, type_of_rooms.name AS v3, rooms.number AS v4, bookings.date_in AS v5, bookings.date_out AS v6, bookings.number_of_nights AS v7, bookings.date AS v8 FROM rooms INNER JOIN type_of_rooms ON rooms.room_type = type_of_rooms.id INNER JOIN hotels ON rooms.hotel = hotels.id INNER JOIN bookings ON rooms.id = bookings.room WHERE user='".$guestid."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo "<div id='bookingtable' align='center'><table><tr><th>Hotel Name</th><th>Room Name</th><th>Room Type</th><th>Room Number</th><th>Check-In</th><th>Check-Out</th><th>Duration of Stay</th><th>Booking Date</th></tr>";
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["v1"]."</td>";
        echo "<td>".$row["v2"]."</td>";
        echo "<td>".$row["v3"]."</td>";
        echo "<td>".$row["v4"]."</td>";
        echo "<td>".date("m-d-Y", strtotime($row["v5"]))."</td>";
        echo "<td>".date("m-d-Y", strtotime($row["v6"]))."</td>";
        echo "<td>".$row["v7"]." Days(s)</td>";
        echo "<td>".date("m-d-Y", strtotime($row["v8"]))."</td>";
        echo "</tr>";
      }
      echo "</table></div><br>";
      echo "<form name='goback' method='post'>";
      echo "<input type='submit' name='searchhotels' value='Search Hotels'></input>";
      echo "</form>";
      }

      else {
        echo "<label>You don't have any bookings yet.</label><br><br>";
        echo "<form name='goback' method='post'>";
        echo "<input type='submit' name='searchhotels' value='Search Hotels'></input>";
        echo "</form>";
      }

      if(array_key_exists('searchhotels',$_POST)){
        header('Location: index.php');
      }


 ?>




</html>
<?php } ?>
