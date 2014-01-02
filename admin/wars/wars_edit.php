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
 function renderForm($id, $date, $clan, $map1, $map1_score1, $map1_score2, $map2, $map2_score1, $map2_score2, $error)
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
<thead><tr><th>Read</th><th>Input</th></tr></thead>
 <td><strong>date</strong></td> <td><input type="text" name="date" value="<?php echo $date; ?>" /></td><tr>
 </tr><td><strong>clan</strong></td> <td><input type="text" name="clan" value="<?php echo $clan; ?>" /></td><tr>
 </tr><td><strong>map1</strong></td> <td><input type="text" name="map1" value="<?php echo $map1; ?>" /></td><tr>
 </tr><td><strong>map1_score1 *</strong></td> <td><input type="text" name="map1_score1" value="<?php echo $map1_score1; ?>" /><tr>
 </tr><td><strong>map1_score2</strong></td> <td><input type="text" name="map1_score2" value="<?php echo $map1_score2; ?>" /><tr>
 </tr><td><strong>map2</strong></td> <td><input type="text" name="map2" value="<?php echo $map2; ?>" /><tr>
 </tr><td><strong>map2_score1 *</strong></td> <td><input type="text" name="map2_score1" value="<?php echo $map2_score1; ?>" /><tr>
 </tr><td><strong>map2_score2</strong></td> <td><input type="text" name="map2_score2" value="<?php echo $map2_score2; ?>" /><tr>
 </tr><td><p>* fubar score</p><tr></td>
  </tr><td><input type="submit" name="submit" value="Submit"><td>
 </table>
 </div>
 </form> 

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
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $clan = mysql_real_escape_string(htmlspecialchars($_POST['clan']));
 $map1 = mysql_real_escape_string(htmlspecialchars($_POST['map1']));
 $map1_score1 = mysql_real_escape_string(htmlspecialchars($_POST['map1_score1']));
 $map1_score2 = mysql_real_escape_string(htmlspecialchars($_POST['map1_score2']));
 $map2 = mysql_real_escape_string(htmlspecialchars($_POST['map2']));
 $map2_score1 = mysql_real_escape_string(htmlspecialchars($_POST['map2_score1']));
 $map2_score2 = mysql_real_escape_string(htmlspecialchars($_POST['map2_score2']));
 
 // check that firstname/lastname fields are both filled in
 if ($date == '' || $clan == '' || $map1 == '' || $map1_score1 == '' || $map1_score2 == '' || $map2 == '' || $map2_score1 == '' || $map2_score2 == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $date, $clan, $map1, $map1_score1, $map1_score2, $map2, $map2_score1, $map2_score2, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE wars SET date='$date', clan='$clan', map1='$map1', map1_score1='$map1_score1', map1_score2='$map1_score2', map2='$map2', map2_score1='$map2_score1', map2_score2='$map2_score2' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./index.php?category=wars&page=wars"); 
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
 $result = mysql_query("SELECT * FROM wars WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db

 $date = $row['date'];
 $clan = $row['clan'];
 $map1 = $row['map1'];
 $map1_score1 = $row['map1_score1'];
 $map1_score2 = $row['map1_score2'];
 $map2 = $row['map2'];
 $map2_score1 = $row['map2_score1'];
 $map2_score2 = $row['map2_score2'];
 
 
 // show form
 renderForm($id ,$date, $clan, $map1, $map1_score1, $map1_score2, $map2, $map2_score1, $map2_score2, '');
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