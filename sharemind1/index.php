<?php 
include('config.php');
include('fun.php');
if( isset($_POST['regbtn']) ){
	if(empty($_POST["unm"])) {
		$msg.="Name is required<br>";
	}else{
		$name = test_input($_POST["unm"]);
		// check if name only contains letters and whitespace
		if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
			$msg.= "Only letters and white space allowed in Name<br>";
		}
	}
	if(empty($_POST['eml'])) {
		$msg.="Email is required<br>";
	}else{
		$email=test_input($_POST['eml']);
		// check if e-mail address is well-formed
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg.="Invalid email format<br>";
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
	if(empty($_POST['gender'])) {
		$msg.="Select gender<br>";
	}else{
		$gender=test_input($_POST['gender']);
	}
	if(empty($_POST['pwd'])) {
		$msg.="Plz Choose Pwd<br>";
	}else{
		$pwd=test_input($_POST['pwd']);
	}
	if($msg==""){
		$dor=date('Y-m-d');
		#Query Writing
		$sql="INSERT INTO `users` (`name`, `email`, `mobile`, `age`, `gender`, `pwd`, `dor`)
		VALUES ('$name','$email','$mobile','$age','$gender','$pwd','$dor')";
		if(mysqli_query($conn, $sql)) {
			$msg="Registration successfully";
		}else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	} 
}


if( isset($_POST['lgnbtn']) ){		
	if(empty($_POST['email1'])) {
		$msg.="Email is required<br>";
	}else{
		$email=test_input($_POST['email1']);
		// check if e-mail address is well-formed
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg.="Invalid email format<br>";
		}
	}
	if(empty($_POST['pswd'])) {
		$msg.="Password is required<br>";
	}else{
		$pwd=test_input($_POST['pswd']);
	}
	
	if($msg==""){
		#Query Writing
		$sql="SELECT * from `users` where `email`='$email' and `pwd`='$pwd'";
		$result=mysqli_query($conn, $sql);
		$num=mysqli_num_rows($result);
		if( $num==1 ) {
			$row=mysqli_fetch_assoc($result);
			//print_r($row);die;
			$_SESSION['userwaliid']=$row['userid'];
			if( isset($_POST['r_me']) &&  $_POST['r_me']==1 ){
				setcookie("ckuserid", $row['userid'], time()+60 );
			}
			header('Location: home.php');
		}else{
			$msg="Incorrect email or password. please Try Again";
		}
	}
}
	
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
	
    <title>share minds Login Page</title>
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
  </style>
  
<body>
<nav class="navbar navbar-expand-lg">
	<a href="#" class="navbar-brand">SHARE<b>MIND.</b><span>COM</span></a>  		
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div id="navbarCollapse" class="collapse navbar-collapse">
		<div class="navbar-nav"></div>
		<div class="navbar-nav ml-auto action-buttons">
			<a href="updateprofile.php" class=" btn  mr-5">Update</a> 
			<a href="changepassword.php" class=" btn  mr-5">Password</a> 
			<a href="allusername.php" class="btn register mr-5">See All User</a>
			<a href="home.php" class="btn register ">Home Page</a>
        </div>
	</div>
</nav>
	
    <div class="container my-5 bg-white" >
		<p class="text-center text-danger bg-white"><?php echo $msg; ?></p>
		<div class="row">
			<div class="col-md-5 shadow1" >
				<form class="img-thumbnail m-4 p-4 bg-light text-white shadow" action="" method="post" onsubmit="return loginvld();">
						<h3 class="text-center text-bold text-dark mb-3">LOGIN HERE</h3>
						<div class="form-group">
							<label class="text-dark" for="exampleInputEmail1">EMAIL-ADDRESS</label>
							<input type="email" class="form-control" id="email1" name="email1" aria-describedby="emailHelp" placeholder="Enter Your Email ID">
							<small id="emailHelp" class="form-text text-muted ">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<label class="text-dark" for="exampleInputPassword1">PASSWORD</label>
							<input type="password" class="form-control" id="pswd" name="pswd" placeholder="Enter Your Password">
						</div>
						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1" name="r_me" value="1">
							<label class="form-check-label text-dark" for="exampleCheck1 ">Remember me</label>
						</div>
						<button type="submit" id="lgnbtn" name="lgnbtn" class="btn btn-primary" value="Submit">Login</button>
						<hr>
						<button class="btn btn-success" type="button">Create New Account</button>
					</form>
				</div>
				<div class="col-md-2"></div>
			

			<div class="col-md-5  shadow1">
				<form class="img-thumbnail m-4 p-3 bg-light text-white" action="" method="post" onsubmit="return regvld ();">
					<h3 class="text-center text-dark">REGISTRATION HERE</h3><br>
					<input class="form-control"  id="unm" name="unm" type="text" placeholder="Name" aria-label="default input example"><br>
					<input class="form-control" id="eml" name="eml" type="text" placeholder="Email id" aria-label="default input example"><br>
					<input class="form-control" id="mbl" name="mbl" type="text" placeholder="Mobile Number" aria-label="default input example"><br>
					<input class="form-control" id="age" name="age" type="text" placeholder="Age" aria-label="default input example"><br>
						
					<div class="text-dark"><h6>Gender:-</h6></div>
					<div class="form-radio form-control"id="gender">							
					  <input type="radio" name="gender" value="male"> MALE
					  <input type="radio" name="gender" value="female"> FEMALE
					</div>
					<br>
				
					<input class="form-control" id="pwd" name="pwd" type="password" placeholder="choose password" aria-label="default input example"><br>
					<button type="submit" id="sub" name="regbtn" class="btn btn-primary" value="Submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
	

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>