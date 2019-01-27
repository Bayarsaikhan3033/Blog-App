<?php 
	session_start();
	// Өгөгдлийн сантай холбох
	$conn = mysqli_connect("localhost", "root", "", "complete-blog-php");

	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
    // constants глобал тодорхойлох
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/complete-blog-php/');
?>