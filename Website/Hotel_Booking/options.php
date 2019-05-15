<?php
if ($_GET['province'] == null || $_GET['city'] == null) {
	header ("Location: index.php");}
	else {?>
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
<form name="options_form" method="post">
<label for='arrivaldate'>Arrival Date:</label><br>
<input type="date" id="arrivaldate" name="arrivaldate" value="2018-12-14">
<br><br>
<label for='departuredate'>Departure Date:</label><br>
<input type="date" id="departuredate" name="departuredate" value="2018-12-20">
<br><br>
<label for='numberofadults'>Number of adults:</label><br><br>
<input type="radio"  id="numberofadults" name="adults" value="0" checked="checked"><label for='numberofadults'> 0</label><br>
<input type="radio"  id="numberofadults" name="adults" value="1"><label for='numberofadults'> 1</label><br>
<input type="radio"  id="numberofadults" name="adults" value="2"><label for='numberofadults'> 2</label><br>
<input type="radio"  id="numberofadults" name="adults" value="3"><label for='numberofadults'> 3</label><br>
<input type="radio"  id="numberofadults" name="adults" value="4"><label for='numberofadults'> 4</label><br>
<input type="radio"  id="numberofadults" name="adults" value="5"><label for='numberofadults'> 5</label><br>
<br><br>
<label for='numberofkids'>Number of kids:</label><br><br>
<input type="radio"  id="numberofkids" name="kids" value="0" checked="checked"><label for='numberofkids'> 0</label><br>
<input type="radio"  id="numberofkids" name="kids" value="1"><label for='numberofkids'> 1</label><br>
<input type="radio"  id="numberofkids" name="kids" value="2"><label for='numberofkids'> 2</label><br>
<input type="radio"  id="numberofkids" name="kids" value="3"><label for='numberofkids'> 3</label><br>
<input type="radio"  id="numberofkids" name="kids" value="4"><label for='numberofkids'> 4</label><br>
<input type="radio"  id="numberofkids" name="kids" value="5"><label for='numberofkids'> 5</label><br>
</br>
<input type='submit' name='next' value='Next' onclick="return validate()"></input>
</form>
<?php
if(array_key_exists('next',$_POST)){
  header('Location: hotelresults.php?province='.$_GET['province'].'&city='.$_GET['city'].'&bookin='.$_POST['arrivaldate'].'&bookout='.$_POST['departuredate'].'');
}
 ?>
 <form name="goback" method="post">
 <input type='submit' name='goback' value='Previous Page'></input>
</form>
<?php
if(array_key_exists('goback',$_POST)){
  header('Location: selectcity.php?province='.$_GET['province'].'');
}
 ?>
</body>
</html>
<?php } ?>
