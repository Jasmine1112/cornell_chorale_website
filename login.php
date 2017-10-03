<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>CU Chorale</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Khula' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/js.js"></script>
</head>
<body>
<div id="container">
	
	<div id="homecontent" class="login_homecontent">
		<?php 
			include 'includes/functions.php';
			$input_username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
			$input_password = filter_input( INPUT_POST, 'password', FILTER_SANITIZE_STRING );
			if ( empty( $input_username ) || empty( $input_password ) ) {
		?>
			<div id="banner" class="loginban">
	            <h2><span>Administrator Login</span></h2>
	        </div> <!--end banner div-->
			
			<form action="login.php" method="post" class="form">
				Username: <input type="text" name="username"> <br>
				Password: <input type="password" name="password"> <br>
				<input type="submit" value="Login" id="login_submit">
			</form>
			
		<?php

		} else {
			//Get the config file
			require_once 'includes/config.php';
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if( $mysqli->connect_errno ) {
				//uncomment the next line for debugging
				echo "<p>$mysqli->connect_error<p>";
				die( "Couldn't connect to database");
			}

			if (login($mysqli, $input_username,$input_password)){
				$_SESSION['logged_user'] = $input_username;
				print("<p>Welcome $input_username! Now you are logged in as Adminstrator and you can edit the website content onw :)</p>");
			} else {
				print("<p>Unsuccesful login submission</p>");
				echo '<p>Please <a href="login.php">login</a>.</p>';
			}
		} 
		?>
	</div>  <!--end content div-->
	<?php include 'includes/nav.php';?>

	<?php //include 'footer.php';?>

</div> <!--end container div-->
	
</body>
</html>