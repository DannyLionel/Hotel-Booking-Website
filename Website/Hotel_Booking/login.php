<html>
<?php
require 'config.php';
?>
<body id="body">
  <h1>Hotel Booking</h1>
    <h2>Welcome to the BookMyFunnyHotel.com</h2>
    <a href="index.php"><button id="searchhotel">Search Hotels</button></a>
    <a href="register.php"><button id="register">No Account? Register Now</button></a>
    <p style='text-align:center'><br><img src="hotel.jpg" style="width:1170px;height:398px"></img></p><br>
  <form id="loginform" method="post" action="">
  <label>Username:</label><br>
  <input name="user" type="text"></input><br><br>
  <label>Password:</label><br>
  <input name="pass" type="password"></input><br><br>
  <?php
  if(isset($_POST["submit"])){

  if(!empty($_POST['user']) && !empty($_POST['pass'])) {
  	$user=$_POST['user'];
  	$pass=$_POST['pass'];
  	$sql="SELECT * FROM users WHERE username='".$user."' AND password='".$pass."'";
    $result = $conn->query($sql);
  	if($result->num_rows > 0)
  	{
  	while($row = $result->fetch_assoc())
  	{
  	$dbusername=$row['username'];
  	$dbpassword=$row['password'];
    $dbguestid=$row['id'];
  	}
  	if($user == $dbusername && $pass == $dbpassword)
  	{
  	session_start();
  	$_SESSION['sess_user']=$user;
    $_SESSION['guestid']=$dbguestid;
    if ($_SESSION['redirecturl'] != null){
    header('Location: ' . $_SESSION['redirecturl'].'');
    }
    else {
    header('Location: index.php');
    }
  	}
  	} else {
  	echo "<label>Invalid username or password!</label><br><br>";
  	}

  } else {
  	echo "<label>All fields are required!</label><br><br>";
  }
  }
  ?>
<input type="submit" value="Login" name="submit"></input>
</form>
</html>
