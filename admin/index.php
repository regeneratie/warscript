<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:./error.php');
}
?>

<center>
<a href="index.php?page=news">News</a>
<a href="index.php?page=wars">Wars</a>
<a href="index.php?page=member">Members</a>
<a href="index.php?page=logout">Logout</a>
</center>

<?php


	$page = $_GET['page'];
	if (!empty($page)) {
		$page .= '.php';
		include($page);
	}
	else {
		include('news.php');
	}


?>