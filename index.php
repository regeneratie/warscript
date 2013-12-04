<!DOCTYPE html>
<html>
		<head>
			<title>warscript</title>
		</head>
<body>


<div class="menu"> 
<div class="datagrid"><table width="300" align="center">
<thead><tr><th></th><th>Login</th></tr></thead>
<form method="post" action="../admin/login.php"> 
<tr><td>Username:</td><td><input type="text" name="UserName"/></td>
<tr><td>Password:</td><td><input type="password" name="Password"/></td>
<tr><td><input type="submit" name="submit" value="Login"/></td>
</form>
</div>
</div>


<?php

include "wars.php";

?>
  
</body>
</html>