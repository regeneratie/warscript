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
 function renderForm($tag, $enemy, $country, $url, $error)
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
<thead><tr><th></th><th><center>Clans add</center></th></tr></thead>
 </tr><td style="width:20%;"><strong>tag</strong></td> <td><input type="text" size="120" name="tag" value="<?php echo $tag; ?>" /></td><tr>
 </tr><td><strong>enemy *</strong></td> <td><input type="text" size="120" name="enemy" value="<?php echo $enemy; ?>" /><tr>
 </tr><td><strong>country</strong></td> <td><input type="text" size="120" name="country" value="<?php echo $country; ?>" /><tr>
 </tr><td><strong>url</strong></td> <td><input type="text" size="120" name="url" value="<?php echo $url; ?>" /><tr>
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
 $tag = mysql_real_escape_string(htmlspecialchars($_POST['tag']));
 $enemy = mysql_real_escape_string(htmlspecialchars($_POST['enemy']));
 $country = mysql_real_escape_string(htmlspecialchars($_POST['country']));
 $url = mysql_real_escape_string(htmlspecialchars($_POST['url']));


 // check to make sure both fields are entered
 if ($tag == '' || $enemy == '' || $country == '' || $url == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields! ';
 
 // if either field is blank, display the form again
 renderForm($tag, $enemy, $country, $url, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT enemy SET tag='$tag', enemy='$enemy', country='$country', url='$url'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./index.php?category=clans&page=clans_view"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 