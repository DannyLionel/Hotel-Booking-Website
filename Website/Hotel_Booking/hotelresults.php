<?php
if ($_GET['province'] == null || $_GET['city'] == null || $_GET['bookin'] == null || $_GET['bookout'] == null) {
	header ("Location: index.php");
}
	else { ?>
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
			$sqlinfo = "SELECT firstname, lastname, signupdate, username, email FROM users WHERE id ='".$_SESSION['guestid']."'";
	    $resultinfo = $conn->query($sqlinfo);
	    if ($resultinfo->num_rows > 0) {
	        while($row = $resultinfo->fetch_assoc()) {
	          echo "<h3>Welcome ".$row['firstname']." ".$row['lastname']."</h3>";
	          echo "<h4>|| Logged in as ".$row['username']." || Email:".$row['email']." || You are a member since ".date("m-d-Y", strtotime($row['signupdate']))." ||</h4>";
						echo "<a href='viewbookings.php'><button id='viewbookings'>View Bookings</button></a>";
						echo " ";
						echo "<a href='logout.php'><button id='logout'>Logout</button></a>";
				  }
}}
     ?>
<p style='text-align:center'><br><img src="hotel.jpg" style="width:1170px;height:398px"></img></p><br>
<?php
$sql="SELECT * FROM hotels WHERE city='".$_GET['city']."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<label>Following are Hotels in selected city:</label></br></br>";
  echo "<div id='hoteltable' align='center'><table><tr><th>Hotel Name</th><th>Address</th><th>Postal Code</th><th>Picture</th><th>Select</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row["name"]."</td>";
    echo "<td>".$row["street_address"]."</td>";
    echo "<td>".$row["zip_code"]."</td>";
    echo "<td><img src='data:image/jpeg;base64,".base64_encode($row['image'])."'/></td>";
    echo "<td id='makebutton'><a href='roomresults.php?province=".$_GET['province']."&city=".$_GET['city']."&bookin=".$_GET['bookin']."&bookout=".$_GET['bookout']."&hotelid=".$row['id']."'><button id='viewrooms'>View Rooms</button></a></td>";
    echo "</tr>";
  }
  echo "</table></div><br>";
  echo "<form name='goback' method='post'>";
  echo "<input type='submit' name='goback' value='Previous Page'></input>";
  echo "</form>";
  }
 else {
  echo "<label>No Hotels in selected city</label></br></br>";
  echo "<form name='goback' method='post'>";
  echo "<input type='submit' name='goback' value='Previous Page'></input>";
  echo "</form>";
}
if(array_key_exists('goback',$_POST)){
 $URL="options.php?province=".$_GET['province']."&city=".$_GET['city']."";
 echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
 echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';}
?>

</body>
</html>
<?php } ?>
