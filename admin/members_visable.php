<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:error.php');
}
/* 
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/

 // connect to the database
 include('./dbconn.php');
 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];

 
 // delete the entry
$result = mysql_query("UPDATE members SET `delete` = 'yes' WHERE id='$id'")


 
 or die(mysql_error()); 
 
 // redirect back to the view page
 header("Location: ./index.php?page=members");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: ./index.php");
 }
 
?>