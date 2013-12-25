<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:./error.php');
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>warscript</title>
    <link rel="stylesheet" href="../css/style.css" type="text/css">
  </head>
  <body>
	
<center>
<ul id="nav">

<li><a href="index.php?page=news">News</a>

<ul>
<li><a href="index.php?page=news_add">Add</a></li>
</ul>

</li>

<li><a href="index.php?page=wars">wars</a>

<ul>
<li><a href="index.php?page=wars_new">Add</a></li>
</ul>

</li>

<li><a href="index.php?page=members">Members</a>

<ul>
<li><a href="index.php?page=members_add">Add</a></li>
</ul>

</li>

<li><a href="index.php?page=logout">Logout</a>


</li>

</ul>
<br>
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
	
  </body>
</html>


