<?php
$msg="";
#database connection
$conn=mysqli_connect( 'localhost','root','','sharemind1' );
#Query Writing
$sql="SELECT * FROM users";
$result=mysqli_query($conn, $sql);
//echo mysqli_num_rows($result);
#$arr=mysqli_fetch_array($result);// it return both type of array indexed/associative
#$arr=mysqli_fetch_assoc($result);// it return associative array only
#print_r($arr);
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
	<title>Share mind all user list</title>
		<style>
	*{
	margin:0;
	padding:0;
	}
	#main{
	width:1000px;
	height:800px;
	background:green;
	margin:0 auto;
	}
	
	#header{
	height:100px;
	background:yellow;
	}
	
	#header a{
		font-size:20px;
		padding:20px;
		color:black;
		font-weight:500;
		text-decoration:none;
	}
	
	#content{
	height:800px;
	background:pink;
	}
	
	#footer{
	height:100px;
	background:blue;
	}
	
	#customers {
	  font-family: Arial, Helvetica, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	#customers td, #customers th {
	  border: 1px solid #ddd;
	  padding: 8px;
	}

	#customers tr:nth-child(even){background-color: #f2f2f2;}

	#customers tr:hover {background-color: #ddd;}

	#customers th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: left;
	  background-color: #04AA6D;
	  color: white;
	}
	</style>
</head>
<body>
	<div id="main">
		<div id="header">
			<a href="index.php">Index Page</a>
			<a href="home.php">Home Page</a>
		</div>
		<div id="content">
			<table id="customers">
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>MOBILE</th>
					<th>AGE</th>
					<th>GENDER</th>
					<th>PWD</th>
					<th>DOR</th>
					<th>ACTION</th>
				</tr>
				<?php while($userrow=mysqli_fetch_assoc($result)){ ?>
				 
					<tr>
						<td><?php echo $userrow['userid']; ?></td>
						<td><?php echo $userrow['name']; ?></td>
						<td><?php echo $userrow['email']; ?></td>
						<td><?php echo $userrow['mobile']; ?></td>
						<td><?php echo $userrow['age']; ?></td>
						<td><?php echo $userrow['gender']; ?></td>
						<td><?php echo $userrow['pwd']; ?></td>
						<td><?php echo $userrow['dor']; ?></td>
						<td>
							<a href="delete.php?usersDeleteId=<?php echo $userrow['userid']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">DELETE</a>
							<a href="allusername.php?userUpdateId=<?php echo $userrow['userid']; ?>" onclick="return confirm('Are you sure you want to Update this User?');">UPDATE</a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div id="footer"></div>
	</div>
</body>
</html>