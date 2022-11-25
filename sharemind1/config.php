<?php 
	session_start();
	$msg="";
	
	//database connection
	$hostname="localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="sharemind1";
	$conn=mysqli_connect($hostname, $dbusername, $dbpassword, $dbname);
	// Check connection
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>