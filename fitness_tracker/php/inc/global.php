<?php

function getConnection() {
	include 'password.php';
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	return $conn; 
}

function fetchAll($sql) {
	$ret = array();
	$conn = getConnection();
	$results = $conn->query($sql);

	$error = $conn->error;
	if($error) {
		echo $error;
	}
	else {
		while($rs = $results->fetch_assoc()) {
			$ret[] = $rs;
		}
	}
	$conn->close();

	return $ret;
}

function getUserName($connection){
	$sql = "SELECT name FROM `users` WHERE login_name = 'jesse'";
	$result = mysqli_query($connection, $sql);
	$user = mysqli_fetch_assoc($result);
	return $user["name"];
}
function getUserName2($connection,$uName){
	$sql = "SELECT name FROM `users` WHERE login_name = '$uName'";
	$result = mysqli_query($connection, $sql);
	$user = mysqli_fetch_assoc($result);
	return $user["name"];
}
function checkPasswd($connection, $uName, $passwd) {
	$sql = "SELECT password FROM `users` WHERE login_name = '$uName'";
	$result = mysqli_query($connection, $sql);
	$dbPasswdArray = mysqli_fetch_assoc($result);
	$dbPasswd = $dbPasswdArray["password"];
	if(strcmp($dbPasswd, $passwd) == 0) {
		return true;
	}
	else {
		return false;
 	}
}
?>
