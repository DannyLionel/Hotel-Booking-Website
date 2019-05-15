 <html>
 <?php
 require 'config.php';
 ?>

 <body id='body'>
  <h1>Hotel Booking</h1>
    <h2>Views</h2>



    <?php
     echo "<label>View 1: Computes a Join of atleast three tables.</label><br><br>";
     $sql1 = "SELECT users.firstname AS v1, users.lastname AS v2, hotels.name AS v3, rooms.name AS v4 FROM bookings INNER JOIN users ON bookings.user = users.id INNER JOIN rooms ON bookings.room = rooms.id INNER JOIN hotels ON rooms.hotel = hotels.id";
     echo "<label id='views'>$sql1</label><br><br>";
     $result1 = mysqli_query ($conn,$sql1);
     echo "<div id='hoteltable' align='center'><table><tr><th>First Name</th><th>Last Name</th><th>Hotel Name</th><th>Room Name</th></tr>";
     while($row = mysqli_fetch_array ($result1)) {
       echo "<tr>";
       echo "<td>".$row["v1"]."</td>";
       echo "<td>".$row["v2"]."</td>";
       echo "<td>".$row["v3"]."</td>";
       echo "<td>".$row["v4"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result1->close();
    ?>




    <?php
     echo "<label>View 2: Use nested queries with ANY or ALL operator and use a GROUP BY clause.</label><br><br>";
     $sql2 = "SELECT hotels.name AS v1, hotels.rating AS v2 FROM hotels WHERE hotels.id = ANY (SELECT hotel FROM rooms WHERE price = 500) GROUP BY hotels.rating";
     echo "<label id='views'>$sql2</label><br><br>";
     $result2 = mysqli_query ($conn,$sql2);
     echo "<div id='hoteltable' align='center'><table><tr><th>Hotel Name</th><th>Rating</th></tr>";
     while($row = mysqli_fetch_array ($result2)) {
       echo "<tr>";
       echo "<td>".$row["v1"]."</td>";
       echo "<td>".$row["v2"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result2->close();
    ?>




    <?php
     echo "<label>View 3: A Correlated nested query.</label><br><br>";
     $sql3 = "SELECT hotels.name AS v1, rooms.price AS v2 FROM hotels INNER JOIN rooms ON rooms.hotel = hotels.id WHERE rooms.price > (SELECT AVG (rooms.price) FROM rooms)";
     echo "<label id='views'>$sql3</label><br><br>";
     $result3 = mysqli_query ($conn,$sql3);
     echo "<div id='hoteltable' align='center'><table><tr><th>Hotel Name</th><th>Price</th></tr>";
     while($row = mysqli_fetch_array ($result3)) {
       echo "<tr>";
       echo "<td>".$row["v1"]."</td>";
       echo "<td>".$row["v2"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result3->close();
    ?>




    <?php
     echo "<label>View 4: Uses a FULL JOIN.</label><br><br>";
     $sql4 = "SELECT firstname AS v1, lastname AS v2, number_of_nights AS v3 FROM users FULL JOIN bookings ON FULL.id = bookings.user";
     echo "<label id='views'>$sql4</label><br><br>";
     $result4 = mysqli_query ($conn,$sql4);
     echo "<div id='hoteltable' align='center'><table><tr><th>First Name</th><th>Last Name</th><th>Number of Nights of Stay</th></tr>";
     while($row = mysqli_fetch_array ($result4)) {
       echo "<tr>";
       echo "<td>".$row["v1"]."</td>";
       echo "<td>".$row["v2"]."</td>";
       echo "<td>".$row["v3"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result4->close();
    ?>




    <?php
     echo "<label>View 5: Uses nested queries with any of the set operations UNION, EXCEPT, or INTERSECT.</label><br><br>";
     $sql5 = "SELECT cities.name AS v1, states.name as v2 FROM cities, states WHERE cities.state = states.id AND states.id = (SELECT MIN(id) FROM states) UNION SELECT cities.name, states.name FROM cities, states WHERE cities.state = states.id AND states.id = 2 ";
     echo "<label id='views'>$sql5</label><br><br>";
     $result5 = mysqli_query ($conn,$sql5);
     echo "<div id='hoteltable' align='center'><table><tr><th>City Name</th><th>State Name</th></tr>";
     while($row = mysqli_fetch_array ($result5)) {
       echo "<tr>";
       echo "<td>".$row["v1"]."</td>";
       echo "<td>".$row["v2"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result5->close();
    ?>




    <?php
     echo "<label>View 6: Using the AVG.</label><br><br>";
     $sql6 = "SELECT AVG (rooms.price) AS Average FROM rooms";
     echo "<label id='views'>$sql6</label><br><br>";
     $result6 = mysqli_query ($conn,$sql6);
     echo "<div id='hoteltable' align='center'><table><tr><th>Average Price</th></tr>";
     while($row = mysqli_fetch_array ($result6)) {
       echo "<tr>";
       echo "<td>".$row["Average"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result6->close();
    ?>




    <?php
     echo "<label>View 7: Use INNER JOIN to join the same table and retrieve results.</label><br><br>";
     $sql7 = "SELECT USER1.username, USER2.email FROM users AS USER1 INNER JOIN users AS USER2 where USER1.id = USER2.id";
     echo "<label id='views'>$sql7</label><br><br>";
     $result7 = mysqli_query ($conn,$sql7);
     echo "<div id='hoteltable' align='center'><table><tr><th>Username</th><th>Email</th></tr>";
     while($row = mysqli_fetch_array ($result7)) {
       echo "<tr>";
       echo "<td>".$row["username"]."</td>";
       echo "<td>".$row["email"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result7->close();
    ?>


    <?php
     echo "<label>View 8: Use COUNT.</label><br><br>";
     $sql8 = "SELECT COUNT(date_in) AS total FROM bookings WHERE date_in > '2018-10-23'";
     echo "<label id='views'>$sql8</label><br><br>";
     $result8 = mysqli_query ($conn,$sql8);
     echo "<div id='hoteltable' align='center'><table><tr><th>Total bookings after 2018-10-23</th></tr>";
     while($row = mysqli_fetch_array ($result8)) {
       echo "<tr>";
       echo "<td>".$row["total"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result8->close();
    ?>



    <?php
     echo "<label>View 9: Use SUM.</label><br><br>";
     $sql9 = "SELECT SUM(price) AS total FROM rooms WHERE price >= (SELECT AVG(price) FROM rooms WHERE price >= 100 )";
     echo "<label id='views'>$sql9</label><br><br>";
     $result9 = mysqli_query ($conn,$sql9);
     echo "<div id='hoteltable' align='center'><table><tr><th>Sum of price of rooms greater than the average price of room above or equal to 100</th></tr>";
     while($row = mysqli_fetch_array ($result9)) {
       echo "<tr>";
       echo "<td>".$row["total"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result9->close();
    ?>



    <?php
     echo "<label>View 10: Use ORDER BY to list something in ascending order .</label><br><br>";
     $sql10 = "SELECT * FROM users ORDER BY firstname ASC";
     echo "<label id='views'>$sql10</label><br><br>";
     $result10 = mysqli_query ($conn,$sql10);
     echo "<div id='hoteltable' align='center'><table><tr><th>Username</th><th>Email</th></tr>";
     while($row = mysqli_fetch_array ($result10)) {
       echo "<tr>";
       echo "<td>".$row["username"]."</td>";
       echo "<td>".$row["email"]."</td>";
       echo "</tr>";
     }
     echo"</table></div><br><br><br>";
     $result10->close();
    ?>



 </html>
