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
 function renderForm($titel, $text, $error)
 {
 



 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 <br>
 <form action="" method="post">
<div class='datagrid'>
<table width="800" align="center" class="table table-bordered">
<thead><tr><th></th><th><center>News Add</center></th></tr></thead>
 <td style="width:20%;"><strong>titel</strong></td> <td><input type="text" size="120" name="titel" value="<?php echo $titel; ?>" /></td><tr>
 </tr><td><strong>text</strong></td> <td><textarea cols="122" rows="15"type="text" name="text" value="<?php echo $text; ?>" /></textarea></td><tr>
 </tr><input type="hidden" name="poster" value="<?php echo $poster; ?>" /><tr>
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
 $poster = mysql_real_escape_string(htmlspecialchars($_SESSION[('UserName')]));


 // check to make sure both fields are entered
 if ($titel == '' || $text == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($titel, $text, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT news SET titel='$titel', text='$text', poster='$poster'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./index.php?category=news&page=news"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 