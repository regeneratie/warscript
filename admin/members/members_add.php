<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}

/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($nickname, $surname, $age, $country, $player_since, $favorite_map, $favorite_weapon, $favorite_item, $old_clans, $quote, $error)
 {
 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 <br>
 <form action="" method="post">
<div class='form-group'>
<table width="800" align="center" class="table table-bordered">
<thead><tr><th></th><th><center>Members Add</center></th></tr></thead>
 <td style="width:20%;"><strong>Nickname</strong></td> <td><input type="text" size="120" name="nickname" value="<?php echo $nickname; ?>" /></td><tr>
 </tr><td><strong>Surname</strong></td> <td><input type="text" size="120" name="surname" value="<?php echo $surname; ?>" /></td><tr>
 </tr><td><strong>Age</strong></td> <td><input type="text" size="120" name="age" value="<?php echo $age; ?>" /></td><tr>
 </tr><td><strong>Country</strong></td> <td><input type="text" size="120" name="country" value="<?php echo $country; ?>" /><tr>
 </tr><td><strong>Player since</strong></td> <td><input type="text" size="120" name="player_since" value="<?php echo $player_since; ?>" /><tr>
 </tr><td><strong>Favorite map</strong></td> <td><input type="text" size="120" name="favorite_map" value="<?php echo $favorite_map; ?>" /><tr>
 </tr><td><strong>Favorite weapon</strong></td> <td><input type="text" size="120" name="favorite_weapon" value="<?php echo $favorite_weapon; ?>" /><tr>
 </tr><td><strong>Favorite item</strong></td> <td><input type="text" size="120" name="favorite_item" value="<?php echo $favorite_item; ?>" /><tr>
 </tr><td><strong>Old clans</strong></td> <td><input type="text" size="120" name="old_clans" value="<?php echo $old_clans; ?>" /><tr>
 </tr><td><strong>Quote</strong></td> <td><input type="text" size="120" name="quote" value="<?php echo $quote; ?>" /><tr>
  </tr><td><input type="submit" name="submit" value="Submit"><td>
 </table>
 </div>
 </form> 
 </body>
 </html>
 <?php 
 }
 
 
 

 // connect to the database
include('dbconn.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
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

 // check to make sure both fields are entered
 if ($nickname == '' || $surname == '' || $age == '' || $country == '' || $player_since == '' || $favorite_map == '' || $favorite_weapon == '' || $favorite_item == '' || $old_clans == '' || $quote == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($nickname, $surname, $age, $country, $player_since, $favorite_map, $favorite_weapon, $favorite_item, $old_clans, $quote, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT members SET nickname='$nickname', surname='$surname', age='$age', country='$country', player_since='$player_since', favorite_map='$favorite_map', favorite_weapon='$favorite_weapon', favorite_item='$favorite_item', old_clans='$old_clans', quote='$quote'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./index.php?category=members&page=members"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 