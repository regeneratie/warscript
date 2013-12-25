<?php
include('./dbconn.php');

$result = mysql_query("SELECT * FROM members WHERE `delete` = 'no' ORDER BY id DESC") or die(mysql_error());

//Get info out of the database if in array
while($row = mysql_fetch_array($result))
  {
echo "<table width='800' align='center'>";

echo "<td><strong>Nickname</strong></td><td>" . $row[nickname] . "</td>";
echo "<tr><td><strong>Surname</strong></td><td>" . $row[surname] . "</td></tr>";
echo "<tr><td><strong>age</strong></td><td>" . $row[age] . "</td></tr>";
echo "<tr><td><strong>country</strong></td><td>" . $row[country] . "</td></tr>";
echo "<tr><td><strong>PLaying aq2 since</strong></td><td>" . $row[player_since] . "</td></tr>";
echo "<tr><td><strong>favorite map</strong></td><td>" . $row[favorite_map] . "</td></tr>";
echo "<tr><td><strong>favorite weapon</strong></td><td>" . $row[favorite_weapon] . "</td></tr>";
echo "<tr><td><strong>favorite item</strong></td><td>" . $row[favorite_item] . "</td></tr>";
echo "<tr><td><strong>former clans</strong></td><td>" . $row[old_clans] . "</td></tr>";
echo "<tr><td><strong>quote</strong></td><td>" . $row[quote] . "</td></tr>";
echo '<tr><td><strong>Add, Dell, Edit</strong></td><td><a href="./members_edit.php?id=' . $row['id'] . '"><img src="../pics/edit.png" />
		  <a href="./members_add.php"><img src="../pics/add.png" />
		  <a href="./members_visable.php?id=' . $row['id'] . '"><img src="../pics/visable.png" />
		  <a href="./members_delete.php?id=' . $row['id'] . '"><img src="../pics/delete.png" />
		  </a></td></tr>';
echo "<br></table>";
  }


mysql_close;
?>
