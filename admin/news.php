<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}
include('./dbconn.php');

$result = mysql_query("SELECT * FROM news WHERE `delete` = 'no' ORDER BY date DESC") or die(mysql_error());

//Get info out of the database if in array
while($row = mysql_fetch_array($result))
  {
echo "<table width='800' align='center' class='table table-bordered'>";
echo "<br>";
echo "<td><b>" . $row[titel] . "</b></td>";
echo "<tr>";
echo nl2br("<td><br>" . $row[text] . "</td>");
echo "<tr>";
echo "<td><br>Posted by <b>" . $row[poster] . '</b>  ' . $row[date] ."</td>";
echo "<tr>";
echo '<td><br><a href="./index.php?page=news_edit&id=' . $row['id'] . '"><img src="../pics/edit.png" />
			  <a href="./news_visable.php?id=' . $row['id'] . '"><img src="../pics/visable.png" />
			</a></td>';
echo "</table>";
  }


mysql_close;
?>
