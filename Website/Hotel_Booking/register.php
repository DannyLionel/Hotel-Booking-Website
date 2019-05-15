<html>
<?php
require 'config.php';
?>
<body id="body">
  <h1>Hotel Booking</h1>
    <h2>Welcome to the BookMyFunnyHotel.com</h2>
    <a href="index.php"><button id="searchhotel">Search Hotels</button></a>
    <a href="login.php"><button id="login">Have an account? Login Now</button></a>
    <p style='text-align:center'><br><img src="hotel.jpg" style="width:750px;height:468.75px"></img></p><br>
  <form id="registerform" method="post" action="">
  <label>Enter First Name:</label><br>
  <input type="text" name="firstname"></input><br><br>
  <label>Enter Last Name:</label><br>
  <input type="text" name="lastname"></input><br><br>
  <label>Enter Username:</label><br>
  <input type="text" name="user"></input><br><br>
  <label>Enter Password:</label><br>
  <input type="password" name="pass"></input><br><br>
  <label>Re-enter Password:</label><br>
  <input type="password" name="pass1"></input><br><br>
  <label>Enter Email:</label><br>
  <input type="text" name="email"></input><br><br>
  <?php
  if(isset($_POST["register"])){

    $sql = "SELECT id FROM users";
    $result = $conn->query($sql);
    $count = 1;
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $count = $count + 1;
      }
      }

    // Check if all fields filled or not

    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['email'])) {

    // First name check

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];

    if ((preg_match("/^[a-zA-Z ]*$/",$firstname)) && (preg_match("/^[a-zA-Z ]*$/",$lastname)) ) {

    // Next check if username exists

    $user=$_POST['user'];

    if (preg_match("/^[a-zA-Z0-9.]*$/",$user)) {
    // Next check if username exists

    $sqla="SELECT * FROM users WHERE username='".$user."'";
    $resulta = $conn->query($sqla);
    if($resulta->num_rows == 0) {

    $pass=$_POST['pass'];
    $pass1=$_POST['pass1'];

    // Check if passwords match

    if ($pass == $pass1) {

    $email=$_POST['email'];
    $date=date("Y-m-d");

    // Check if it is a valid Email

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $sqlb="INSERT INTO users(id,firstname,lastname,signupdate,username,password,email) VALUES('$count','$firstname','$lastname','$date','$user','$pass','$email')";
	  $resultb=$conn->query($sqlb);
    if($resultb){
    echo "<label>Account successfully created. Redirecting you to login page in 5 seconds.</label><br><br>";
    header('Refresh: 5; URL=login.php');
  	}
    else {
    echo "<label>Failed to register user</label><br><br>";
    }}
    else {
    echo "<label>Please enter a valid email</label></br></br>";
    }}
    else {
    echo "<label>Passwords do not match</label><br><br>";
    }}
    else {
    echo "<label>Please try a different usename</label></br></br>";
    }}
    else {
    echo "<label>Please enter a proper username</label></br></br>";
    }}
    else {
    echo "<label>Please enter a valid name</label></br></br>";
    }}
    else {
  	echo "<label>All fields are required</label><br><br>";
    }}
  ?>
<input type="submit" value="Register" name="register"></input>
</form>
</html>
