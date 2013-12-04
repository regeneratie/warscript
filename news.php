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
echo "<thead><tr><th>head</th></tr></thead>";
echo "<tr><td>";
echo $row['head'];
echo "</tr></td>";
echo $row['date'];
echo "</td><td>";
echo $row['text'];
echo "</td>";
  }


mysql_close;
?>
