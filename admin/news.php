<?php
include('./dbconn.php');

$result = mysql_query("SELECT * FROM news ORDER BY id DESC") or die(mysql_error());

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
echo "<tr>";
echo '<td><a href="./news_edit.php?id=' . $row['id'] . '"><img src="../pics/edit.png" />
		  <a href="./news_delete.php?id=' . $row['id'] . '"><img src="../pics/delete.png" />
		  <a href="./news_add.php"><img src="../pics/add.png" />
		  </a></td>';
echo "</table>";
  }


mysql_close;
?>