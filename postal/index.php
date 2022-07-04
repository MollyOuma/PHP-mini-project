<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="author" content="Kashingi Web disigner">
	<title>Class Practicals</title>

	<!--link to bootstrap-->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<!--Main styleshet -->
	<link rel="stylesheet" type="text/css" href="bootstrap/main.css">
	<script>
		function checked()
		{
			if (document.getElementById('Password').value == document.getElementById('cpassword').value)
			{
				document.getElementById('message').style.color = 'green';
				document.getElementById('message').innerHTML = 'Password Mathched';
					return true;
			}
			else
			{
				document.getElementById('message').style.color = 'green';
				document.getElementById('message').innerHTML = 'Password do not match.';
					return false;
			}
		}
	</script>

</head>
<body>
	<div class="container" style="margin-top: 30px;">
		<!--The header Section -->
		<header class="jumbotron text-center row" style="margin-bottom: 2px; background: linear-gradient(white, #0073e6); padding: 20px;">
			<div class="col-sm-2">
				<img class="img-fluid float-left" src="bootstrap/image/logo.png" alt="logo">
			</div>
			<div class="col-sm-8">
				<h1 class="font-bold">Welcome to the world of designers</h1>
			</div>
			<div class="col-sm-2">
				<nav class="btn-group-vertical btn-group-sm" role="group" aria-label="button-group">
					<button type="button" class="btn btn-secondary" onclick="location.href='login.php'">Login</button>
					<button type="button" class="btn btn-secondary" onclick="location.href='register.php'">Register</button>
				</nav>
			</div>
		</header>
		<!--The body Section -->
		<div class="row" style="padding-left: 2px;">
			<!--The nav section -->
			<nav class="col-sm-2">
				<ul class="nav nav-pills flex-column">
					<?php
					include 'nav.php';
					?>
				</ul>
			</nav>
		</div>
		<!-- Validate input -->



		<aside class="col-sm-2 float-left">
			<?php
			include 'col.php';
			?>
		</aside>
		<!-- THe footer Section -->
		<footer class="jumbotron text-center row" style="padding-bottom: 1px; padding-top: 8px;">
			<?php
			include 'footer.php';
			?>
		</footer>
	</div>

	<link rel="stylesheet" type="text/css" href="bootstrap/js/bootstrap.js">
</body>
</html>