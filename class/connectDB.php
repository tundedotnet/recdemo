<?php 
	// Create connection
	$conn = new mysqli('localhost', 'root', '', 'movielensdata');

	// Change character set to utf8
	mysqli_set_charset($conn,"utf8");


	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
?>