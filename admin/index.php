<!DOCTYPE html>

<?php
session_start();
if (!isset($_SESSION['member_id'])){
header('location:./error.php');
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin panel</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <style>
	body {margin-top: 60px;}
    </style>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">News<b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="index.php?page=news">View <img align="right" src="../pics/view.png" /></a></li>
					  <li><a href="index.php?page=news_add">ADD <img align="right" src="../pics/add.png" /></a></li>
					  <li><a href="index.php?page=news_trash">Trash <img align="right" src="../pics/visable.png" /></a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Wars<b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="index.php?page=wars">View <img align="right" src="../pics/view.png" /></a></li>
					  <li><a href="index.php?page=wars_add">ADD <img align="right" src="../pics/add.png" /></a></li>
					  <li><a href="index.php?page=wars_trash">Trash <img align="right" src="../pics/visable.png" /></a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Members<b class="caret"></b></a>
					<ul class="dropdown-menu">
					  <li><a href="index.php?page=members">View <img align="right" src="../pics/view.png" /></a></li>
					  <li><a href="index.php?page=members_add">ADD <img align="right" src="../pics/add.png" /></a></li>
					  <li><a href="index.php?page=members_trash">Trash <img align="right" src="../pics/visable.png" /></a></li>
					</ul>
				</li>
				<li>
				<a href="index.php?page=logout">LogOut -> <?php echo $_SESSION[('UserName')] ?></a>
				</li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>

    <div class="container">

      <div class="row">
        <div class="col-lg-12">

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
		
        </div>
      </div>

    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.js"></script>

  </body>
</html>