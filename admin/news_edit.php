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
 function renderForm($titel, $text, $date, $poster, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
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
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
<div class="datagrid"><table width="800" align="center">
<thead><tr><th>Read</th><th>Input</th></tr></thead>
 <td><strong>titel</strong></td> <td><input type="text" name="titel" value="<?php echo $titel; ?>" /></td><tr><br/>
</tr><td><strong>text</strong></td> <td><input type="text" name="text" value="<?php echo $text; ?>" /></td><tr>
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
 include('./dbconn.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $titel = mysql_real_escape_string(htmlspecialchars($_POST['titel']));
 $text = mysql_real_escape_string(htmlspecialchars($_POST['text']));
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $poster = mysql_real_escape_string(htmlspecialchars($_POST['poster']));
 
 // check that firstname/lastname fields are both filled in
 if ($titel == '' || $text == '' || $date == '' || $poster == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $titel, $text, $date, $poster, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE news SET titel='$titel', text='$text', date='$date', poster='$poster' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ../wars.php"); 
 }
 echo "lol";
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error! 1234';
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
 $result = mysql_query("SELECT * FROM news WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db

 $titel = $row['titel'];
 $text = $row['text'];
 $date = $row['date'];
 $poster = $row['poster'];

 
 
 // show form
 renderForm($titel, $text, $date, $poster, '');
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