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
 function renderForm($date, $clan, $map1, $map1_score1, $map1_score2, $map2, $map2_score1, $map2_score2, $error)
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
 <td><strong>date</strong></td> <td><input type="datetime-local" name="date" value="<?php echo $date; ?>" /></td><tr><br/>
 </tr><td><strong>clan</strong></td> <td><input type="text" name="clan" value="<?php echo $clan; ?>" /></td><tr><br/>
 </tr><td><strong>map1</strong></td> <td><input type="text" name="map1" value="<?php echo $map1; ?>" /></td><tr><br/>
 </tr><td><strong>map1_score1 *</strong></td> <td><input type="text" name="map1_score1" value="<?php echo $map1_score1; ?>" /><tr><br/>
 </tr><td><strong>map1_score2</strong></td> <td><input type="text" name="map1_score2" value="<?php echo $map1_score2; ?>" /><tr><br/>
 </tr><td><strong>map2</strong></td> <td><input type="text" name="map2" value="<?php echo $map2; ?>" /><tr><br/>
 </tr><td><strong>map2_score1 *</strong></td> <td><input type="text" name="map2_score1" value="<?php echo $map2_score1; ?>" /><tr><br/>
 </tr><td><strong>map2_score2</strong></td> <td><input type="text" name="map2_score2" value="<?php echo $map2_score2; ?>" /><tr><br/>
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
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $clan = mysql_real_escape_string(htmlspecialchars($_POST['clan']));
 $map1 = mysql_real_escape_string(htmlspecialchars($_POST['map1']));
 $map1_score1 = mysql_real_escape_string(htmlspecialchars($_POST['map1_score1']));
 $map1_score2 = mysql_real_escape_string(htmlspecialchars($_POST['map1_score2']));
 $map2 = mysql_real_escape_string(htmlspecialchars($_POST['map2']));
 $map2_score1 = mysql_real_escape_string(htmlspecialchars($_POST['map2_score1']));
 $map2_score2 = mysql_real_escape_string(htmlspecialchars($_POST['map2_score2']));

 // check to make sure both fields are entered
 if ($date == '' || $clan == '' || $map1 == '' || $map1_score1 == '' || $map1_score2 == '' || $map2 == '' || $map2_score1 == '' || $map2_score2 == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($date, $clan, $map1, $map1_score1, $map1_score2, $map2, $map2_score1, $map2_score2, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT wars SET date='$date', clan='$clan', map1='$map1', map1_score1='$map1_score1', map1_score2='$map1_score2', map2='$map2', map2_score1='$map2_score1', map2_score2='$map2_score2'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./wars.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 