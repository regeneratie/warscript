<?php
include('./admin/dbconn.php');

$result = mysql_query("SELECT * FROM news ORDER BY id DESC") or die(mysql_error());
$result2 = mysql_query("SELECT * FROM news ORDER BY id DESC") or die(mysql_error());

//Get info out of the database if in array
while($row = mysql_fetch_array($result))
  {
echo "<table width='800' align='center'>";

echo "<td><b>" . $row[titel] . "</b></td>";
echo "<tr>";
echo "<td>" . $row[text] . "</td>";
echo "<tr>";
echo "<td>" . $row[date] . "</b></td>";
echo "<tr>";
echo "<td>Posted by <b>" . $row[poster] . '</b>  ' . $row[date] ."</td>";
echo "</table>";
  }


mysql_close;
?>
