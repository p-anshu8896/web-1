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

if( isset($_POST['uplbtn']) ){
	//echo "<pre>";
	//print_r($_FILES);
	//echo "</pre>";
	$name=$_FILES['pic']['name'];
	$type=$_FILES['pic']['type'];
	$tmp_name=$_FILES['pic']['tmp_name'];
	$error=$_FILES['pic']['error'];
	$size=$_FILES['pic']['size'];
	$arr=explode(".",$name);
	//print_r($arr);
	$ext=end($arr);
	$ext=strtolower($ext);
	$allowedExt=array('jpg','jpeg','png');
	if( in_array($ext,$allowedExt) ){
		if( ($size/1024)<500 ){
			$path='upl/'.time().$name;
			if( move_uploaded_file($tmp_name,$path) ){
				$sql="UPDATE `users` set `propic`='$path' where userid='$currentuserid'";
				if(mysqli_query($conn, $sql)) {
					$msg="Propic Updated successfully";
				}else{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}else{
				$msg="server error";
			}
		}else{
			$msg="File Size Should be less than 500kb";
		} 
	}else{
		$msg="Invalid File Type";
	}	
} 

if( isset($_POST['updatebtn']) ){
	if( empty($_POST["unm"]) ) {
		$msg.="Name is required<br>";
	}else{
		$name = test_input($_POST["unm"]);
		// check if name only contains letters and whitespace
		if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
			$msg.= "Only letters and white space allowed in Name<br>";
		}
	}
	
	if(empty($_POST['mbl'])) {
		$msg.="Mobile Number is required<br>";
	}else{
		$mobile=test_input($_POST['mbl']);
		// check if name only contains letters and whitespace
		if(!preg_match("/^[0-9']*$/",$mobile)) {
			$msg.= "Only digits allowed in Mobile<br>";	
		}	
	}
	if(empty($_POST['age'])) {
		$msg.="Age is required<br>";
	}else{
		$age=test_input($_POST['age']);
		// check if name only contains letters and whitespace
		if(!preg_match("/^[0-9']*$/",$age)) {
			$msg.= "Only digits allowed in Age <br>";	
		}	
	}
	if($msg==""){
		$sql="UPDATE `users` set `name`='$name', `mobile`='$mobile', `age`='$age' where userid='$currentuserid'";
		if(mysqli_query($conn, $sql)) {
			$msg="Profile Updated successfully";
		}else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}	
	
	$sql="SELECT * from `users` where `userid`='$currentuserid'";
	$result=mysqli_query($conn, $sql);
	$userrow=mysqli_fetch_assoc($result);
	
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css
	">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <title>share mind</title>
</head>
<style>
	.img-thumbnail button{
	color:white;
	font-size:18px;
	font-weight:bold;
}

.list-group a{
	font-size:16px;
	font-weight:bold;
	text-align:center;
}
#searchhints{
	display:none;
	list-style:none;
	padding:0px;
	background:red;
	min-width:200px;
	position:absolute;
	left:5px;
	top:35px;
}
#searchhints li{
	border-bottom:1px solid #fff;
}
#searchhints a{
	display:block;
	background:yellow;
	padding:5px;
}
	  
</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
	  <div class="container">
	  <a class="navbar-brand text-white font-weight-bold" href="#">Shareminds</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	  <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<div class="form-inline my-2 my-lg-0" style="position:relative;">
		  <input class="form-control mr-sm-2" type="search" id="searchterm" placeholder="Search" aria-label="Search">
		  <ul id="searchhints">
		  	<li><a href="#">Ramu 1</a></li>
		  	<li><a href="#">Ramu 1</a></li>
		  	<li><a href="#">Ramu 1</a></li>
		  </ul>
		</div>
		<ul class="navbar-nav ml-auto">
			 <li class="nav-item active">
				<a class="nav-link text-white font-weight-bold" href="#">Hi<?php echo $userrow['name'];?> <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link text-white font-weight-bold " href="index.php">INDEX<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link text-white font-weight-bold " href="home.php">HOME<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white font-weight-bold" href="logout.php">LOGOUT</a>
			</li>
		 </ul>
	  </div>
	  </div>
	</nav>
	
	<div class="container my-5">
		<div class="text-center"><?php echo $msg; ?></div>
		<div class="row">
			<div class="col-md-4 img-thumbnail">
				<div class="p-2 text-center">
					<img src="<?php echo $userrow['propic']; ?>" class="img-fluid img-thumbnail">
				</div>
				<button class="btn btn-secondary btn-block" data-toggle="modal" data-target="#changeProPicForm">CHANGE PROFILE:-</button>
				<div class="list-group text-center">
				  <a href="#" class="list-group-item list-group-item-action"><?php echo $userrow['name']; ?></a>
				  <a href="#" class="list-group-item list-group-item-action list-group-item-success">Gender: <?php echo $userrow['gender']; ?> </a>
				  <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">Email6: <?php echo $userrow['email']; ?></a>
				  <a href="updateprofile.php" class="list-group-item list-group-item-action list-group-item-info">Update Profile</a>
				  <a href="changepassword.php" class="list-group-item list-group-item-action list-group-item-warning">Change Password</a>
				  <a href="logout.php" class="list-group-item list-group-item-action list-group-item-danger">Logout</a>
				</div>
				
			</div>
				<div class="col-md-8">
					<form class="img-thumbnail m-4 p-3 bg-light text-white" action="" method="post" onsubmit="return regvld ();">
					<h3 class="text-center text-dark">Update Profile Here</h3><br>
					<input class="form-control"  id="unm" name="unm" value="<?php echo $userrow['name']; ?>" type="text" placeholder="Name" aria-label="default input example"><br>
					<input class="form-control" id="mbl" name="mbl" value="<?php echo $userrow['mobile']; ?>" type="text" placeholder="Mobile Number" aria-label="default input example"><br>
					<input class="form-control" id="age" name="age" type="text" value="<?php echo $userrow['age']; ?>" placeholder="Age" aria-label="default input example"><br>
					<button type="submit" id="sub" name="updatebtn" class="btn btn-primary" value="Submit"> Update Profile</button>
				</form>
				</div>
			</div>
		</div>
	</div>
	
	<!-- The Modal -->
	<div class="modal" id="changeProPicForm">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Change Profile Pic</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>
		  <!-- Modal body -->
		  <div class="modal-body">
			<form action="" method="post" enctype="multipart/form-data">
				<input type="file" name="pic" class="form-control"><br><br>
				<input class="btn btn-success" type="submit" name="uplbtn" value="Upload Propic ">
			</form>
		  </div>
		  <!-- Modal footer -->
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		  </div>

		</div>
	  </div>
	</div>
	<script src="js/jquery.3.6.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/main.js"></script>
	
</body>
</html>