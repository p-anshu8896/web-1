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

if( isset($_POST['postbtn']) ){
	if(empty($_POST["postcontent"])) {
		$msg.="Post content is required<br>";
	}else{
		$postcontent = test_input($_POST["postcontent"]);
	}
	if($msg==""){
		$dt=date('Y-m-d H:i:s');
		#Query Writing
		$sql = "INSERT INTO `posts` (`postcontent`, `userid`, `dt`) VALUES ('$postcontent', '$currentuserid', '$dt')";
		if(mysqli_query($conn, $sql)) {
			$msg="Posted successfully";
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <title>share mind</title>
</head>
	  <style>
  .navbar {
	background: #fff;
	padding-left: 20px;
	padding-right: 20px;
	border-bottom: 1px solid #dfe3e8;
	border-radius: 0;
	background: #e6e6e6;
}

.navbar .navbar-brand {
	padding-left: 0;
	font-size: 19px;
	padding-right: 50px;
}
.navbar .navbar-brand b {
	color: #33cabb;		
}

.navbar .navbar-brand span{
	color: #8080ff;
}

.navbar .form-inline {
	display: inline-block;
}

.navbar a {
	color: #888;
	font-size: 20px;
}

.list-group a{
	font-size:18px;
	font-weight:bold;
}

.img-thumbnail button{
	color:white;
	font-size:18px;
	font-weight:bold;
}

.nav-stack li i{
	font-size:22px;
	color:black;
}

.nav-stack li i:hover{
	color:blue;
	font-weight:bold;
}


  </style>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light pt-3 pb-3">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
	   <span class="navbar-toggler-icon"></span>
	  </button>
	  <a class="navbar-brand" href="#">SHARE<b>MIND.</b><span>COM</span></a>
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
		<ul class="navbar-nav mx-auto mt-4 mt-lg-0">
		  <li class="nav-item active">
			<a class="nav-link" href="index.php">Index <span class="sr-only">(current)</span></a>
		  </li>
		  <li class="nav-item active">
			<a class="nav-link" href="logout.php">Logout</a>
		  </li>
		</ul>
		 <form class="navbar-form form-inline">
			<div class="input-group search-box">								
				<input type="text" id="search" class="form-control" placeholder="Search here...">
				<div class="input-group-append">
					<span class="input-group-text">
						<i class="fa fa-search" aria-hidden="true"></i>
					</span>
				</div>
			</div>
		</form>
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
				  <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">Email: <?php echo $userrow['email']; ?></a>
				  <a href="updateprofile.php" class="list-group-item list-group-item-action list-group-item-info">Update Profile</a>
				  <a href="changepassword.php" class="list-group-item list-group-item-action list-group-item-warning">Change Password</a>
				  <a href="logout.php" class="list-group-item list-group-item-action list-group-item-danger">Logout</a>
				</div>
				
			</div>
				<div class="col-md-8">
					<div class="m-2">
						<form action="" method="post">
						<div class="form-group">
						  <textarea class="form-control" rows="3" id="comment" name="postcontent" placeholder="Write here ... what is in your mind.."></textarea>
						</div>
						<input type="submit" value="POST" name="postbtn" class="btn btn-primary" />
						</form>
					</div>
					<hr>
					<div class="m-2">
						<?php 
						$sqlp="SELECT * FROM posts order by dt DESC";
						$resultp=mysqli_query($conn, $sqlp);
						while($rowp=mysqli_fetch_assoc($resultp)){ 
							$userdata=getUserDetail($conn,$rowp['userid']);
							//print_r($userdata);
						?>
						<div class="card mb-3">
							<div class="card-header border-0 pb-0">
								<div class="d-flex align-items-center justify-content-between">
								  <div class="d-flex align-items-center">
									<!-- Avatar -->
									<div class="avatar avatar-story me-2">
									  <a href="#!">
										<img class="avatar-img rounded-circle" src="<?php echo $userdata['propic'] ?>"> 
									  </a>
									</div>
									<!-- Info -->
									<div>
									  <div class="nav nav-divider">
										<h6 class="nav-item card-title m-1"> <a href="#!"> <?php echo $userdata['name'] ?> </a></h6>
									  </div>
									  <p class="mb-0 small">
									  <?php
										$time = strtotime($rowp['dt']);
										echo $myFormatForView = date("d-M-Y g:i A", $time);
									  ?>
									  </p>
									</div>
								  </div>
								</div>
							  </div>
							<div class="card-body">
								<p><?php echo $rowp['postcontent']; ?></p>
								<!-- Feed react START -->
								<ul class="nav nav-stack py-3 small">
								  <li class="nav-item">
									<?php if( $rowp['userid']==$currentuserid ) { ?>
									<button class="btn btn-danger text-white postdeletebtn" value="<?php echo $rowp['postid']; ?>">
										<i class="fa fa-trash-o text-white" aria-hidden="true"></i>
									</button>
									<?php } ?>
								  </li>
								  <li class="nav-item">
									<a class="nav-link" href="#!"> <i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
								  </li>
								</ul>
								<!-- Feed react END -->
								<!-- Comment wrap END -->
							  </div>
							</div>
						<?php } ?>
							
					</div>
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