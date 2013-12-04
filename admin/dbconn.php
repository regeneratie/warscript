<?php

//connect to your database

mysql_connect("localhost","root","XXXXXXX"); //(host, username, password)


//specify database

mysql_select_db("warscript") or die("Unable to select database"); //select which database we're using

?>
