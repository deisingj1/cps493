<!DOCTYPE html>
<?php
	session_start();
	
	$post_name = $_POST["username"];
	include "inc/global.php";
	$conn = getConnection();
	$name = getUserName2($conn, $post_name);
	$cpasswd = checkPasswd($conn, $post_name, $_POST["password"]);
?>
<?=$name?>
</br>
<?php
	if($cpasswd) {
		echo "Correct password";
	}
	else {
		echo "Incorrect password";
	}
?>
</br>
<form method="post">
Username: <input id="username" name="username" type="text" \>
Password: <input name="password" type="password" \>
<button action="login.php" method="post">Login</button>
</form>
