<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $nickname, $surname, $age, $country, $player_since, $favorite_map, $favorite_weapon, $favorite_item, $old_clans, $quote, $error)
 {

 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 

 <br>
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
<div class="datagrid">
<table width="800" align="center" class="table table-bordered">
<thead><tr><th></th><th>Members Edit</th></tr></thead>
 <td><<strong>Nickname</strong></td> <td><input type="text" name="nickname" value="<?php echo $nickname; ?>" /></td><tr>
 </tr><td><strong>Surname</strong></td> <td><input type="text" name="surname" value="<?php echo $surname; ?>" /></td><tr>
 </tr><td><strong>Age</strong></td> <td><input type="text" name="age" value="<?php echo $age; ?>" /></td><tr>
 </tr><td><strong>Country</strong></td> <td><input type="text" name="country" value="<?php echo $country; ?>" /><tr>
 </tr><td><strong>Player since</strong></td> <td><input type="text" name="player_since" value="<?php echo $player_since; ?>" /><tr>
 </tr><td><strong>Favorite map</strong></td> <td><input type="text" name="favorite_map" value="<?php echo $favorite_map; ?>" /><tr>
 </tr><td><strong>Favorite weapon *</strong></td> <td><input type="text" name="favorite_weapon" value="<?php echo $favorite_weapon; ?>" /><tr>
 </tr><td><strong>Favorite item</strong></td> <td><input type="text" name="favorite_item" value="<?php echo $favorite_item; ?>" /><tr>
 </tr><td><strong>Old clans</strong></td> <td><input type="text" name="old_clans" value="<?php echo $old_clans; ?>" /><tr>
 </tr><td><strong>Quote</strong></td> <td><input type="text" name="quote" value="<?php echo $quote; ?>" /><tr>
  </tr><td><input type="submit" name="submit" value="Submit"><td>
 </table>
 </div>

 <?php
 }



 // connect to the database
 include('./dbconn.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $nickname = mysql_real_escape_string(htmlspecialchars($_POST['nickname']));
 $surname = mysql_real_escape_string(htmlspecialchars($_POST['surname']));
 $age = mysql_real_escape_string(htmlspecialchars($_POST['age']));
 $country = mysql_real_escape_string(htmlspecialchars($_POST['country']));
 $player_since = mysql_real_escape_string(htmlspecialchars($_POST['player_since']));
 $favorite_map = mysql_real_escape_string(htmlspecialchars($_POST['favorite_map']));
 $favorite_weapon = mysql_real_escape_string(htmlspecialchars($_POST['favorite_weapon']));
 $favorite_item = mysql_real_escape_string(htmlspecialchars($_POST['favorite_item']));
 $old_clans = mysql_real_escape_string(htmlspecialchars($_POST['old_clans']));
 $quote = mysql_real_escape_string(htmlspecialchars($_POST['quote']));
 
 // check that firstname/lastname fields are both filled in
 if ($nickname == '' || $surname == '' || $age == '' || $country == '' || $player_since == '' || $favorite_map == '' || $favorite_weapon == '' || $favorite_item == '' || $old_clans == '' || $quote == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $nickname, $surname, $age, $country, $player_since, $favorite_map, $favorite_weapon, $favorite_item, $old_clans, $quote, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE members SET nickname='$nickname', surname='$surname', age='$age', country='$country', player_since='$player_since', favorite_map='$favorite_map', favorite_weapon='$favorite_weapon', favorite_item='$favorite_item', old_clans='$old_clans', quote='$quote' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./index.php?category=members&page=members"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM members WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db

 $nickname = $row['nickname'];
 $surname = $row['surname'];
 $age = $row['age'];
 $country = $row['country'];
 $player_since = $row['player_since'];
 $favorite_map = $row['favorite_map'];
 $favorite_weapon = $row['favorite_weapon'];
 $favorite_item = $row['favorite_item'];
 $old_clans = $row['old_clans'];
 $quote = $row['quote'];
 
 // show form
 renderForm($id ,$nickname, $surname, $age, $country, $player_since, $favorite_map, $favorite_weapon, $favorite_item, $old_clans, $quote, '');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
 

?>