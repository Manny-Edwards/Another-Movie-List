<?php
	session_start();

 ?>

<DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name=viewport content="width-device-width, initial-scale=1">
		<title></title>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link href="dist/css/tabulator_midnight.min.css" rel="stylesheet">
		<script type="text/javascript" src="dist/js/tabulator.min.js"></script>
		<script type="text/javascript" src="dist/js/jquery_wrapper.min.js"></script>
		<style>
		#example-table .tabulator-row table{
			vertical-align: middle;
			border-collapse:collapse;
		}

		#example-table .tabulator-row table img{
			border:2px solid #fff;
		}

		#example-table .tabulator-row table tr td{
			 border:none;
		}

		#example-table .tabulator-row table tr td:first-of-type{
			width:95%;
		}

		#example-table .tabulator-row table tr td div{
			padding:5px;
		}
		</style>
		</head>
		<body>
			<header>
				<div class="w3-container w3-blue" style="position:relative">
					<a href="index.php"><h1 class="w3-xxlarge w3-text-white" style="text-shadow:1px 1px 0 #444; margin-top:10px; float:left; text-decoration:none">Another Movie List</h1></a>


					<button id="login" onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black w3-right" style="margin:16px">Login</button>
					<div id="id01" class="w3-modal" >
						<form class="w3-modal-content" action="includes/login.inc.php" method="post">
						  <div class="w3-container">
							<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
							<header class="w3-text-black"><h3>Login</h3></header>
							<p><input class="w3-input" type="text" placeholder="Username" name="username" style="width:90%" required></p>
							<p><input class="w3-input" type="password" placeholder="Password" name="password" style="width:90%" required></p>

							<p>
							<button class="w3-button w3-section w3-teal w3-ripple" type="submit" name="login-submit"> Log in </button></p>


						  </div>
						</form>
					</div>

					<button id="register" onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-black w3-right" style="margin:16px">Register</button>
					<div id="id02" class="w3-modal" >
						<form class="w3-modal-content" action="includes/signup.inc.php" method="post">
						  <div class="w3-container">
							<span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
							<header class="w3-text-black"><h3>Register</h3></header>
							<p><input class="w3-input" type="text" placeholder="First Name" name="Fname" style="width:90%" value="" required></p>
							<p><input class="w3-input" type="text" placeholder="Last Name" name="Lname" style="width:90%" value="" required></p>
							<p><input class="w3-input" type="text" placeholder="Username" name="username" style="width:90%" value="" required></p>
							<p><input class="w3-input" type="text" placeholder="E-Mail" name="email" style="width:90%" value="" required></p>
							<p><input class="w3-input" type="password" placeholder="Password" name="password" style="width:90%" value="" required></p>
							<p><input class="w3-input" type="password" placeholder="Repeat Password" name="password-repeat" style="width:90%" value="" required></p>
							<p><button class="w3-button w3-section w3-teal w3-ripple" type="submit" name="register-submit"> Sign up </button></p>
						  </div>
						</form>
					</div>

					<form action="includes/logout.inc.php" method="post">
						<button id="logout" class="w3-button w3-black w3-right" style="margin:16px">Logout</button>
					</form>

					<form action="movieEdit.php" method="post">
						<button id="edit" class="w3-button w3-black w3-right" style="margin:0; display:none">Add Movie</button>
					</form>



					<?php
					if (isset($_SESSION['userId'])) {
						echo '<script type="text/javascript">
							document.getElementById("register").style.display = "none";
							document.getElementById("login").style.display = "none";
						</script>';
						if (isset($_SESSION['Admin'])) {
							echo '<script type="text/javascript">
								document.getElementById("edit").style.display = "inline";
							</script>';
			      }
					}
					else {
						echo '<script type="text/javascript">
							document.getElementById("logout").style.display = "none";
							document.getElementById("edit").style.display = "none";
						</script>';
					}
					?>
			</header>
