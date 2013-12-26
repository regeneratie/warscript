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
 


//
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>New Record</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<!-- Bootstrap -->
			<link rel="stylesheet" href="../css/style.css" type="text/css">
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
<div class='datagrid'><table width="800" align="center">
<thead><tr><th>Read</th><th>Input</th></tr></thead>
 <td><<strong>nickname</strong></td> <td><input type="text" name="nickname" value="<?php echo $nickname; ?>" /></td><tr><br/>
 </tr><td><strong>surname</strong></td> <td><input type="text" name="surname" value="<?php echo $surname; ?>" /></td><tr><br/>
 </tr><td><strong>age</strong></td> <td><input type="text" name="age" value="<?php echo $age; ?>" /></td><tr><br/>
 </tr><td><strong>country</strong></td> <td><input type="text" name="country" value="<?php echo $country; ?>" /><tr><br/>
 </tr><td><strong>player_since</strong></td> <td><input type="text" name="player_since" value="<?php echo $player_since; ?>" /><tr><br/>
 </tr><td><strong>favorite_map</strong></td> <td><input type="text" name="favorite_map" value="<?php echo $favorite_map; ?>" /><tr><br/>
 </tr><td><strong>favorite_weapon *</strong></td> <td><input type="text" name="favorite_weapon" value="<?php echo $favorite_weapon; ?>" /><tr><br/>
 </tr><td><strong>favorite_item</strong></td> <td><input type="text" name="favorite_item" value="<?php echo $favorite_item; ?>" /><tr><br/>
 </tr><td><strong>old_clans</strong></td> <td><input type="text" name="old_clans" value="<?php echo $old_clans; ?>" /><tr><br/>
 </tr><td><strong>quote</strong></td> <td><input type="text" name="quote" value="<?php echo $quote; ?>" /><tr><br/>
 </tr><td><p>* fubar score</p><tr></td>
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
 header("Location: ./index.php?page=members"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 