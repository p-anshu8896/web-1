<?php
	include('config.php');
	include('fun.php');
	if( isset($_COOKIE['ckuserid']) ){
		$_SESSION['userwaliid']=$_COOKIE['ckuserid'];
	}
	if( !(isset($_SESSION['userwaliid'])) ){
		header('Location: index.php');
	}
	$currentuserid=$_SESSION['userwaliid'];
	if( isset($_POST['searchterm']) ){
		//print_r( $_POST );
		$searchterm=$_POST['searchterm'];
		$sql="SELECT * FROM users where name LIKE '%$searchterm%' ";
		$result=mysqli_query($conn, $sql);
		$num=mysqli_num_rows($result);
		if( $num<1 ){
			echo '<li>No Result Found</li>';
		}else{
			while($userrow=mysqli_fetch_assoc($result)){ ?>
				<li><a href="profile.php?userid=<?php echo $userrow['userid']; ?>"><?php echo $userrow['name']; ?></a><li>
			<?php }
		}
	}
	if( isset($_POST['delete_id']) ){
		//print_r( $_POST );
		$delete_id=$_POST['delete_id'];
		$sql="DELETE FROM posts where postid='$delete_id' and userid='$currentuserid'";
		if(mysqli_query($conn, $sql) ){
			echo "Successfully DELETED";
		}else{
			
		}
	}
?>