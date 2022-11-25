<?php 
	if( isset($_GET['userDeleteId']) ){
		#print_r( $_GET );
		$deleteid=$_GET['userDeleteId'];
		#database connection
		$conn=mysqli_connect( 'localhost','root','','sharemind1	' );
		$query="DELETE FROM users where userid='$deleteid'";
		if(mysqli_query($conn,$query)){
			header('Location: allusername.php');
		}else{
			echo "Not delete";
		}
	}
	
?>