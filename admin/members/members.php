<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}
include('./dbconn.php');

$result = mysql_query("SELECT * FROM members WHERE `delete` = 'no' ORDER BY id DESC") or die(mysql_error());

//Get info out of the database if in array
while($row = mysql_fetch_array($result))
  {
echo "<br>";
echo "<table width='800' align='center' class='table table-bordered'>";

echo "<tr><td style='width:20%;'><strong>Nickname</strong></td><td>" . $row[nickname] . "</td></tr>";
echo "<tr><td><strong>Surname</strong></td><td>" . $row[surname] . "</td></tr>";
echo "<tr><td><strong>Age</strong></td><td>" . $row[age] . "</td></tr>";
echo "<tr><td><strong>Country</strong></td><td>" . $row[country] . "</td></tr>";
echo "<tr><td><strong>Playing aq2 since</strong></td><td>" . $row[player_since] . "</td></tr>";
echo "<tr><td><strong>Favorite map</strong></td><td>" . $row[favorite_map] . "</td></tr>";
echo "<tr><td><strong>Favorite weapon</strong></td><td>" . $row[favorite_weapon] . "</td></tr>";
echo "<tr><td><strong>Favorite item</strong></td><td>" . $row[favorite_item] . "</td></tr>";
echo "<tr><td><strong>Old clans</strong></td><td>" . $row[old_clans] . "</td></tr>";
echo "<tr><td><strong>Quote</strong></td><td>" . $row[quote] . "</td></tr>";
echo '<tr><td><strong>Edit, Trash</strong></td><td><a href="./index.php?category=members&page=members_edit&id=' . $row['id'] . '"><img src="../pics/edit.png" />
		  <a href="./index.php?category=members&page=members_visable&id=' . $row['id'] . '"><img align="right" src="../pics/visable.png" />
		  </a></td></tr>';
echo "</table>";
echo "<br>";
  }


mysql_close;
?>
