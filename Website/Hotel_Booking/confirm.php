<?php
if ($_GET['province'] == null || $_GET['city'] == null || $_GET['bookin'] == null || $_GET['bookout'] == null || $_GET['hotelid'] == null || $_GET['roomid'] == null ||
$_GET['weekprice'] == null || $_GET['weekendprice'] == null) {
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
 <body id="body">
<h1>Hotel Booking</h1>
<h2>Welcome to the BookMyFunnyHotel.com</h2>
<?php
$sqlinfo = "SELECT firstname, lastname, signupdate, username, email FROM users WHERE id ='".$_SESSION['guestid']."'";
$resultinfo = $conn->query($sqlinfo);
if ($resultinfo->num_rows > 0) {
		while($row = $resultinfo->fetch_assoc()) {
			echo "<h3>Welcome ".$row['firstname']." ".$row['lastname']."</h3>";
			echo "<h4>|| Logged in as ".$row['username']." || Email:".$row['email']." || You are a member since ".date("m-d-Y", strtotime($row['signupdate']))." ||</h4>";
			echo "<a href='viewbookings.php'><button id='viewbookings'>View Bookings</button></a>";
		}
}
 ?>
<a href="viewbookings.php"><button id="viewbookings">View Bookings</button></a>
<a href="logout.php"><button id="logout">Logout</button></a>
<p style='text-align:center'><br><img src="hotel.jpg" style="width:1170px;height:398px"></img></p><br>

<?php
$bookin = $_GET['bookin'];
$bookout = $_GET['bookout'];
$weekprice = $_GET['weekprice'];
$weekendprice = $_GET['weekendprice'];

function number_of_working_days($from, $to) {
    $workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $workingDays)) continue;
        $days++;
    }
    return $days;
}

$totalweekdays = number_of_working_days($bookin, $bookout);

function number_of_nonworking_days($from, $to) {
    $nonworkingDays = [6, 7]; # date format = N (1 = Monday, ...)

    $from = new DateTime($from);
    $to = new DateTime($to);
    $to->modify('+1 day');
    $interval = new DateInterval('P1D');
    $periods = new DatePeriod($from, $interval, $to);

    $days = 0;
    foreach ($periods as $period) {
        if (!in_array($period->format('N'), $nonworkingDays)) continue;
        $days++;
    }
    return $days;
}

$totalweekends = number_of_nonworking_days($bookin, $bookout);
$newdisplaybookin = date("m-d-Y", strtotime($bookin));
$newdisplaybookout = date("m-d-Y", strtotime($bookout));

echo "<br><h3 id='bookingsummaryheading3'>Your Booking Summary for the Selected Hotel Room</h3>";
echo "<div id='bookingtable' align='center'><table>";
echo "<tr>";
echo "<th>Hotel Name</th>";
echo "<th>Room Type</th>";
echo "<th>Check-In</th>";
echo "<th>Check-Out</th>";
echo "<th>Price for Weekdays</th>";
echo "<th>Price for Weekends</th>";
echo "<th>Total Duration of Stay</th>";
echo "</tr><tr>";
$sql="SELECT hotels.name AS v1, type_of_rooms.name as v2 FROM rooms INNER JOIN type_of_rooms ON rooms.room_type = type_of_rooms.id INNER JOIN hotels ON rooms.hotel = hotels.id WHERE rooms.id='".$_GET['roomid']."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
echo "<td>".$row['v1']."</td>";
echo "<td>".$row['v2']."</td>";
echo "<td>".$newdisplaybookin."</td>";
echo "<td>".$newdisplaybookout."</td>";
echo "<td>$".$weekprice.".00</td>";
echo "<td>$".$weekendprice."</td>";
echo "<td>".($totalweekdays+$totalweekends)." Day(s)</td>";
}}
echo "</tr>";
echo "</table></div>";
echo "<br>";
echo "<h3 id='bookingsummaryheading3'>Total for weekdays = ".$totalweekdays." Weekday(s) * $".$weekprice.".00 = $".($totalweekdays*$weekprice).".00<br>";
echo "<h3 id='bookingsummaryheading3'>Total for weekends = ".$totalweekends." Weekend(s) * $".$weekendprice." = $".($totalweekends*$weekendprice).".00<br><br>";
echo "<h3 id='bookingsummaryheading3'>Grand Total</h3>";
echo "<div id='final_total'>$".(($totalweekdays*$weekprice) + ($totalweekends*$weekendprice)).".00</div><br><br>";
 ?>
<form name='confim_booking_form' method='post'>
  <input type='submit' name='booknow' value='Confirm & Book Now'></input>
</form>
<?php
if(array_key_exists('booknow',$_POST)){
  header("Location: book.php?province=".$_GET['province']."&city=".$_GET['city']."&bookin=".$_GET['bookin']."&bookout=".$_GET['bookout']."&hotelid=".$_GET['hotelid']."&roomid=".$_GET['roomid']."&totaldays=".($totalweekdays+$totalweekends)."&price=".(($totalweekdays*$weekprice) + ($totalweekends*$weekendprice))."");
}
 ?>
 <form name="goback" method="post">
 <input type='submit' name='goback' value='Previous Page'></input>
</form>
<?php
if(array_key_exists('goback',$_POST)){
  header("Location: roomresults.php?province=".$_GET['province']."&city=".$_GET['city']."&bookin=".$_GET['bookin']."&bookout=".$_GET['bookout']."&hotelid=".$_GET['hotelid']."");
}
 ?>
</body>
</html>
<?php } }?>
