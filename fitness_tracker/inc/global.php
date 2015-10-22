<?php

function getConnection() {
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "mydb";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
}
function getUserName() {
	$sql = "SELECT name FROM `users` WHERE login_name = 'jesse'";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
	return $user["name"];
}
