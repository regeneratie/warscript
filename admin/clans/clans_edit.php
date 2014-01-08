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
 function renderForm($id, $tag, $enemy, $country, $url, $error)
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
<thead><tr><th></th><th><center>enemys add</center></th></tr></thead>
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
 include('./dbconn.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $tag = mysql_real_escape_string(htmlspecialchars($_POST['tag']));
 $enemy = mysql_real_escape_string(htmlspecialchars($_POST['enemy']));
 $country = mysql_real_escape_string(htmlspecialchars($_POST['country']));
 $url = mysql_real_escape_string(htmlspecialchars($_POST['url']));

 
 // check that firstname/lastname fields are both filled in
 if ($tag == '' || $enemy == '' || $country == '' || $url == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $tag, $enemy, $country, $url, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE enemy SET tag='$tag', enemy='$enemy', country='$country', url='$url' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ./index.php?category=clans&page=clans_view"); 
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
 $result = mysql_query("SELECT * FROM enemy WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db

 $tag = $row['tag'];
 $enemy = $row['enemy'];
 $country = $row['country'];
 $url = $row['url'];

 
 // show form
 renderForm($id ,$tag, $enemy, $country, $url, '');
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