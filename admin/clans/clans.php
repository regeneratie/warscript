<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}
//
include('./dbconn.php');

$result = mysql_query("SELECT * FROM enemy WHERE `delete` = 'no' ORDER BY id DESC") or die(mysql_error());

//Get info out of the database if in array
while($row = mysql_fetch_array($result))
  {
		echo "<br>";
		echo "<table width='800' align='center' class='table table-bordered'>";

		echo "<tr><td style='width:20%;'><strong>TAG</strong></td><td>" . $row[tag] . "</td></tr>";
		echo "<tr><td><strong>enemy</strong></td><td>" . $row[enemy] . "</td></tr>";
		echo "<tr><td><strong>country</strong></td><td>" . $row[country] . "</td></tr>";
		echo "<tr><td><strong>url</strong></td><td>" . $row[url] . "</td></tr>";
		echo '<td><a href="./index.php?category=clans&page=clans_edit&id=' . $row['id'] . '"><img src="../pics/edit.png" /></a></td>';
		echo '<td><a href="./index.php?category=clans&page=clans_visable&id=' . $row['id'] . '"><img align="right" src="../pics/visable.png" /></a>';
		echo "</table>";
		echo "<br>";
	
	
	
  }

mysql_close;
?>
