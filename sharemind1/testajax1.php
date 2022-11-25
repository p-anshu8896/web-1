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
  
<body>
	<h1>Ajax ki testing </h1>
	<button id="btn">Click me to get all data without reloading the page</button>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
	<script>
	$(document).ready( function() {
		
		$("#btn").click( function() {
			$.ajax({
				type: 'POST',
				url: 'allusername.php',
				data: '',
				beforeSend: function() {
					alert("Ready to go");
				},
				success: function(kut) {
					$("h1").html(kut);
				},
				error: function() {
					alert("Error AA Gyi");
				},
				complete: function() {
					alert("Complete");
				}
			});
		});
		
	});
	</script>
  </body>
</html>