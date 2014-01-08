<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}
include('./dbconn.php');

$result = mysql_query("SELECT * FROM news WHERE `delete` = 'yes' ORDER BY id DESC") or die(mysql_error());

//check if the trashbox is emty
if(mysql_num_rows($result) > 0)
{
//Get info out of the database if in array
while($row = mysql_fetch_array($result))
  {
echo "<table width='800' align='center' class='table table-bordered'>";
echo "<br>";
echo "<td><b><h3>" . $row[titel] . "</h3></b>";
echo '<a href="./index.php?category=news&page=news_delete&id=' . $row['id'] . '"><img align="right" src="../pics/delete.png" /></a></td>';
echo "<tr>";
echo nl2br("<td><br>" . $row[text] . "</td>");
echo "<tr>";
echo "<td><br>Posted by <b>" . $row[poster] . '</b>  ' . $row[date] ."</td>";
echo "<tr>";
echo '<td><br><a href="./index.php?category=news&page=news_trash_edit&id=' . $row['id'] . '"><img src="../pics/edit.png" />
		  <a href="./index.php?category=news&page=news_undo&id=' . $row['id'] . '"><img align="right" src="../pics/undo.png" />
		  </a></td>';
echo "</table>";
  }
mysql_close;
}
else
{
	echo "<br>";
    echo "<br>";
	echo "Trash box is emty ! !";
	mysql_close;	
}



?>
