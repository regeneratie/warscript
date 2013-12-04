<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}
//
include('./admin/dbconn.php');

$result = mysql_query("SELECT * FROM news ORDER BY id DESC") or die(mysql_error());

//Get info out of the database if in array
while($row = mysql_fetch_array($result))
  {
echo "<div class='datagrid'><table width='800' align='center'>";
echo "<tr><td>";
echo "<th>head</th>"$row['head'];
echo "</tr></td>";
echo "<tr><td>";
echo $row['date'];
echo "</tr></td>";
echo "<tr><td>";
echo $row['text'];
echo "</tr></td>";
  }


mysql_close;
?>
