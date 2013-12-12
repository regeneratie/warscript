<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:./error.php');
}


echo "<br/><center><a href='logout.php'>logout</a>  <a href='News.php'>news</a>  <a href='wars.php'>Wars</a></center>";

include "./wars.php";

include "./news.php";




?>