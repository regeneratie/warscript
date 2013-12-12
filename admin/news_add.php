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
 function renderForm($titel, $date, $text, $poster, $error)
 {
 


//
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>New Records</title>
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
 <td><strong>titel</strong></td> <td><input type="text" name="titel" value="<?php echo $titel; ?>" /></td><tr><br/>
 </tr><td><strong>text</strong></td> <td><textarea cols="40" rows="5"type="text" name="text" value="<?php echo $text; ?>" /></textarea></td><tr><br/>
 </tr><td><strong>date</strong></td> <td><input type="datetime-local" name="date" value="<?php echo $date; ?>" /></td><tr><br/>
 </tr><td><strong>poster</strong></td> <td><input type="text" name="poster" value="<?php echo $poster; ?>" /><tr><br/>
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
 $titel = mysql_real_escape_string(htmlspecialchars($_POST['titel']));
 $text = mysql_real_escape_string(htmlspecialchars($_POST['text']));
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $poster = mysql_real_escape_string(htmlspecialchars($_POST['poster']));


 // check to make sure both fields are entered
 if ($titel == '' || $text == '' || $date == '' || $poster == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($titel, $text, $date, $poster, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT news SET titel='$titel', text='$text', date='$date', poster='$poster'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ../wars.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 