<?php
include('./admin/dbconn.php');//para sa connection sang database

if (isset($_POST['submit'])) {//condition kun e click ang button
$UserName=$_POST['UserName'];//variable ang $Username kag ang $_POST['UserName'] ay value sang textbox nga UserName
$Password=md5($_POST['Password']);//variable ang $Username kag ang $_POST['Password'] ay value sang textbox nga Password
$result=mysql_query("select * from members where UserName='$UserName' and Password='$Password'")or die (mysql_error());//query sang database 
		
$count=mysql_num_rows($result);//isipon kn may tyakto sa query
$row=mysql_fetch_array($result);//ma return row sa database
		
		if ($count > 0){//kun may tyakto sa query e execute yah ang code sa dalom
		session_start();//para mag start ang session
		$_SESSION['member_id']=$row['member_id'];//kwaon ang id sang may tyakto nga username kag password ang ibotang sa $_SESSION['member_id']
		header('location:wars.php');
		}else{
		header('location:./index.php');
		}
}
?>

