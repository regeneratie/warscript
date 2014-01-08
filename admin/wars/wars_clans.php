 <?php
 //connect to db.
include('dbconn.php');
 
//Make a function for selecting clans from the db.
function enemy_select()
 {
//Select data from database
$enemy = mysql_query("SELECT * FROM enemy WHERE `delete` = 'no' ORDER BY id DESC") or die(mysql_error());

  echo "<select name=clan>"; 
 while($row = mysql_fetch_array($enemy))
   {
 echo '<option  value=' . $row['tag'] . '> ' . $row['enemy'] . ' </option>';
  }
echo "</select>"; 
}

?>
