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
 



 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
<div class='datagrid'>
<table width="800" align="center" class="table table-bordered">
<thead><tr><th>Read</th><th>Input</th></tr></thead>
 <td><strong>titel</strong></td> <td><input type="text" size="158" name="titel" value="<?php echo $titel; ?>" /></td><tr><br/>
 </tr><td><strong>text</strong></td> <td><textarea cols="160" rows="5"type="text" name="text" value="<?php echo $text; ?>" /></textarea></td><tr><br/>
 </tr><td><strong>poster</strong></td> <td><input type="text" name="poster" value="<?php echo $poster; ?>" /><tr><br/>
  </tr><td><input type="submit" name="submit" value="Submit"><td>
 </table>
 </div>
 </form> 

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
 $poster = mysql_real_escape_string(htmlspecialchars($_POST['poster']));


 // check to make sure both fields are entered
 if ($titel == '' || $text == '' || $poster == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($titel, $text, $poster, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT news SET titel='$titel', text='$text', poster='$poster'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./index.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 