<?php
if ($_GET['province'] == null || $_GET['city'] == null || $_GET['bookin'] == null || $_GET['bookout'] == null || $_GET['hotelid'] == null) {
	header ("Location: index.php");
}
	else { ?>
<html>
<?php
require 'config.php';
 ?>
 <body id='body'>
  <h1>Hotel Booking</h1>
    <h2>Welcome to the BookMyFunnyHotel.com</h2>
    <?php
		session_start();
		if(!isset($_SESSION["sess_user"])){
		$_SESSION['redirecturl'] = $_SERVER['REQUEST_URI'];
    echo "<a href='login.php'><button id='login'>Have an account? Login Now</button></a>";
		} else {
		$_SESSION['redirecturl'] = $_SERVER['REQUEST_URI'];
		$sqlinfo = "SELECT firstname, lastname, signupdate, username, email FROM users WHERE id ='".$_SESSION['guestid']."'";
		$resultinfo = mysqli_query ($conn,$sqlinfo);
    if ($resultinfo->num_rows > 0) {
        while($row = $resultinfo->fetch_assoc()) {
          echo "<h3>Welcome ".$row['firstname']." ".$row['lastname']."</h3>";
          echo "<h4>|| Logged in as ".$row['username']." || Email:".$row['email']." || You are a member since ".date("m-d-Y", strtotime($row['signupdate']))." ||</h4>";
					echo "<a href='viewbookings.php'><button id='viewbookings'>View Bookings</button></a>";
					echo " ";
					echo "<a href='logout.php'><button id='logout'>Logout</button></a>";
			  }}}
     ?>
<p style='text-align:center'><br><img src="hotel.jpg" style="width:1170px;height:398px"></img></p><br>
<?php
$arr = array(1 => 'Yes', 0 => 'No');
$sqlcheck="SELECT hotels.name AS v1, rooms.name As v2, type_of_rooms.name AS v3, rooms.price AS v4, rooms.smoking AS v5, rooms.free_breakfast AS v6, rooms.free_internet AS v7, rooms.occupied AS v8, rooms.hotel AS v9, rooms.id AS v10, rooms.weekend_price AS v11 FROM rooms INNER JOIN type_of_rooms ON rooms.room_type = type_of_rooms.id INNER JOIN hotels ON rooms.hotel = hotels.id WHERE hotel = '".$_GET['hotelid']."'AND occupied='0'";
$resultcheck = mysqli_query ($conn,$sqlcheck);
if ($resultcheck->num_rows > 0) {
	$sql="SELECT hotels.name AS v1, rooms.name As v2, type_of_rooms.name AS v3, rooms.price AS v4, rooms.smoking AS v5, rooms.free_breakfast AS v6, rooms.free_internet AS v7, rooms.occupied AS v8, rooms.hotel AS v9, rooms.id AS v10, rooms.weekend_price AS v11 FROM rooms INNER JOIN type_of_rooms ON rooms.room_type = type_of_rooms.id INNER JOIN hotels ON rooms.hotel = hotels.id WHERE hotel = '".$_GET['hotelid']."'";
	$result = $conn->query($sql);
  echo "<label>Following are rooms for selected Hotel:</label></br></br>";
  echo "<div id='hoteltable' align='center'><table><tr><th>Hotel Name</th><th>Room Name</th><th>Room Type</th><th>Room Price</th><th>Allowed Smoking</th><th>Free Breakfast</th><th>Free Internet</th><th>Availability</th></tr>";
  while($row = mysqli_fetch_array ($result)) {
      echo "<tr>";
      echo "<td>".$row["v1"]."</td>";
      echo "<td>".$row["v2"]."</td>";
      echo "<td>".$row["v3"]."</td>";
      echo "<td>$".$row["v4"]."</td>";
      echo "<td>".$arr[$row["v5"]]."</td>";
      echo "<td>".$arr[$row["v6"]]."</td>";
      echo "<td>".$arr[$row["v7"]]."</td>";
	  if ($row['v8']==0){
      echo "<td id='makebutton'><a href='confirm.php?province=".$_GET['province']."&city=".$_GET['city']."&bookin=".$_GET['bookin']."&bookout=".$_GET['bookout']."&hotelid=".$row['v9']."&roomid=".$row['v10']."&weekprice=".$row['v4']."&weekendprice=".$row['v11']."'><button id='reserverooms'>Reserve Now</button></a></td>";}
	  else {
		  echo "<td><img src='no.png'></img></td>";
	  }
      echo "</tr>";
  }
  echo "</table><div><br>";
  echo "<form name='goback' method='post'>";
  echo "<input type='submit' name='goback' value='Previous Page'></input>";
  echo "</form>";
  } else {
    echo "<label>No rooms avaliable in selected hotel</label></br></br>";
    echo "<form name='goback' method='post'>";
    echo "<input type='submit' name='goback' value='Previous Page'></input>";
    echo "</form>";
  }
  if(array_key_exists('goback',$_POST)){
header('Location: hotelresults.php?province='.$_GET['province'].'&city='.$_GET['city'].'&bookin='.$_GET['bookin'].'&bookout='.$_GET['bookout'].'');
  }
$conn->close();
?>

</body>
</html>
<?php } ?>
