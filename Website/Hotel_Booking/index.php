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
  <form name='province_select_form' method='post'>
    <label>Select State: </label><br><br>
    <select name='province' id='province'>
      <?php
      $sql = "SELECT id,name FROM states;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
      echo "<option value=". $row["id"].">" . $row['name'] . "</option>";
    }
  } else {
    echo "0 results";
  }

        $conn->close();
  ?>
</select><br><br>
<input type='submit' name='getprovinceid' value='Next'></input>
</form>
  <?php
  if(array_key_exists('getprovinceid',$_POST)){
    header('Location: selectcity.php?province='.$_POST['province']);
  }
   ?>
</body>
</html>
