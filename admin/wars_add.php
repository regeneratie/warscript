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
 function renderForm($clan, $map1, $map1_score1, $map1_score2, $map2, $map2_score1, $map2_score2, $error)
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
<thead><tr><th></th><th><center>Wars add</center></th></tr></thead>
 </tr><td style="width:20%;"><strong>clan</strong></td> <td><input type="text" size="120" name="clan" value="<?php echo $clan; ?>" /></td><tr>
 </tr><td><strong>map1</strong></td> <td><input type="text" size="120" name="map1" value="<?php echo $map1; ?>" /></td><tr>
 </tr><td><strong>map1_score1 *</strong></td> <td><input type="text" size="120" name="map1_score1" value="<?php echo $map1_score1; ?>" /><tr>
 </tr><td><strong>map1_score2</strong></td> <td><input type="text" size="120" name="map1_score2" value="<?php echo $map1_score2; ?>" /><tr>
 </tr><td><strong>map2</strong></td> <td><input type="text" size="120" name="map2" value="<?php echo $map2; ?>" /><tr>
 </tr><td><strong>map2_score1 *</strong></td> <td><input type="text" size="120" name="map2_score1" value="<?php echo $map2_score1; ?>" /><tr>
 </tr><td><strong>map2_score2</strong></td> <td><input type="text" size="120" name="map2_score2" value="<?php echo $map2_score2; ?>" /><tr>
 </tr><td><p>* fubar score</p><tr></td>
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
 $clan = mysql_real_escape_string(htmlspecialchars($_POST['clan']));
 $map1 = mysql_real_escape_string(htmlspecialchars($_POST['map1']));
 $map1_score1 = mysql_real_escape_string(htmlspecialchars($_POST['map1_score1']));
 $map1_score2 = mysql_real_escape_string(htmlspecialchars($_POST['map1_score2']));
 $map2 = mysql_real_escape_string(htmlspecialchars($_POST['map2']));
 $map2_score1 = mysql_real_escape_string(htmlspecialchars($_POST['map2_score1']));
 $map2_score2 = mysql_real_escape_string(htmlspecialchars($_POST['map2_score2']));

 // check to make sure both fields are entered
 if ($clan == '' || $map1 == '' || $map1_score1 == '' || $map1_score2 == '' || $map2 == '' || $map2_score1 == '' || $map2_score2 == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($clan, $map1, $map1_score1, $map1_score2, $map2, $map2_score1, $map2_score2, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT wars SET clan='$clan', map1='$map1', map1_score1='$map1_score1', map1_score2='$map1_score2', map2='$map2', map2_score1='$map2_score1', map2_score2='$map2_score2'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./index.php?page=wars"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 