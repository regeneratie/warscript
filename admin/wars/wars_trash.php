<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}
//
include('./dbconn.php');

$result = mysql_query("SELECT * FROM wars WHERE `delete` = 'yes' ORDER BY id DESC") or die(mysql_error());


//check if the trashbox is emty
if(mysql_num_rows($result) > 0)
{
//Begin of the table
echo "<div><table width='800' align='center' class='table table-striped'>";
echo "<br><thead><tr><th>Versus</th><th>Map I</th><th>Score I</th><th>map II</th><th>Score II</th><th>+/-</th><th>W|D|L</th><th>Edit</th><th>Restore</th><th>Delete</th></tr></thead>";




//Get info out of the database if in array
while($row = mysql_fetch_array($result))
  {
//calc wars played 
$warsplayed++;  

//Hack around table color
if(is_int($warsplayed/2))
{
   echo("<tr class='alt'><td>");
}
else
{
   echo("<tr><td>");
}
echo $row['clan'];
echo "</td><td>";
echo ucfirst($row['map1']);
echo "</td><td>";
echo $row['map1_score1']  . " - " . $row['map1_score2'];
echo "</td><td>";
echo ucfirst($row['map2']);
echo "</td><td>";
echo $row['map2_score1'] . " - " . $row['map2_score2'];
echo "</td><td>";
//Count rounds won/lost
$roundswon = $roundswon + $row['map1_score1'] + $row['map2_score1'];
$roundslost = $roundslost + $row['map1_score2'] + $row['map2_score2'];
$map1_score1 = $map1_score1 + $row['map1_score1'];
$map1_score2 = $map1_score2 + $row['map1_score2'];
$map2_score1 = $map2_score1 + $row['map1_score1'];
$map2_score2 = $map2_score2 + $row['map1_score2'];
//end Count rounds won/lost
$scoreteam1 = $row['map1_score1'] + $row['map2_score1'];
$scoreteam2 = $row['map1_score2'] + $row['map2_score2'];
$finalscore = $scoreteam1 - $scoreteam2;
// WIN/DRAW/LOST calculate.
if ($finalscore > 0)
{
	echo "<span style='color: green'>+</span>$finalscore";
	echo "</td><td>";
	echo "<span style='color: green'><b>Won</b>";
	$cw_won++;
}
elseif($finalscore < 0)
{
	echo $finalscore;
	echo "</td><td>";
	echo "<span style='color: yellow'><b>Lost</b>";
	$cw_lost++;
}
else
{
	echo $finalscore;
	echo "</td><td>";
	echo "<span style='color: blue'><b>Draw</b>";
	$cw_draw++;
}
echo '<td><a href="./index.php?category=wars&page=wars_edit&id=' . $row['id'] . '"><img src="../pics/edit.png" /></a></td>';
echo '<td><a href="./index.php?category=wars&page=wars_undo&id=' . $row['id'] . '"><img src="../pics/undo.png" /></a></td>';
echo '<td><a href="./index.php?category=wars&page=wars_delete&id=' . $row['id'] . '"><img src="../pics/delete.png" /></a></td>';


echo "</td>";
  }

//count average
$map1_score1 = $map1_score1 / $warsplayed;
$map1_score2 = $map1_score2 / $warsplayed;
$map2_score1 = $map2_score1 / $warsplayed;
$map2_score2 = $map2_score2 / $warsplayed;  

echo "<thead><tr><th>Total played</th><th></th><th>Gem totaal map I </th><th></th><th>Gem totaal map II</th><th></th><th></th><th></th><th></th></tr></thead>";
echo "<tr class='alt'><td>";
echo $warsplayed;
echo "</td><td>";
echo "";
echo "</td><td>";
echo number_format($map1_score1, 2, ',', ' ');
echo " - ";
echo number_format($map1_score2, 2, ',', ' ');
echo "</td><td>";
echo "";
echo "</td><td>";
echo number_format($map2_score1, 2, ',', ' ');
echo " - ";
echo number_format($map2_score2, 2, ',', ' ');
echo "</td><td>";
echo "";
echo "</td><td>";
echo "";
echo "</td><td>";
echo "";
echo "</td><td>";
echo "";
echo "</td>";
echo "</table>";


$roundwon = $roundswon / $warsplayed;
$roundsplayed = $roundswon + $roundslost;   
$count_win = $cw_won + $cw_lost + $cw_draw;
$uitkomst_win = 100 / $count_win * $cw_won;
$uitkomst_draw = 100 / $count_win * $cw_draw;
$uitkomst_lost = 100 / $count_win * $cw_lost;


echo "<br>";
echo "<br>"; 
echo "<br>"; 
echo "<div class='datagrid'><table width='800' align='center' class='table table-bordered'>";
echo "<thead><tr><th>Won</th><th>Draw</th><th>Lost</th></tr></thead>";
echo("<tr><td>");
echo $cw_won . ' X won,  is %' . number_format($uitkomst_win, 2, ',', ' ');
echo "</td><td>";
echo $cw_draw  . ' X draw, is %' . number_format($uitkomst_draw, 2, ',', ' ');
echo "</td><td>";
echo $cw_lost . ' X lost, is %' . number_format($uitkomst_lost, 2, ',', ' ');
echo "</td></tr>";
echo "<thead><tr><th>Rounds WON</th><th>Rounds LOST</th><th>Total Rounds Played</th></tr></thead>";
echo("<tr><td>");
echo $roundswon;
echo "</td><td>";
echo $roundslost;
echo "</td><td>";
echo $roundsplayed;
echo "</td></tr>";
echo "</table>";
  
  
}
else
{
	echo "<br>";
    echo "<br>";
	echo "Trash box is emty ! !";
}

mysql_close;
?>
