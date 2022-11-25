<?php 
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	function getUserDetail($conn,$id){
		$sql="SELECT name,propic from `users` where `userid`='$id'";
		$result=mysqli_query($conn, $sql);
		$userdata=mysqli_fetch_assoc($result);
		return $userdata;
	}
?>