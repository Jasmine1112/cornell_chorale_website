<?php
	//Need to start a session in order to access it to be able to end it
	session_start();
	
	if (isset($_SESSION['logged_user'])) {
		$olduser = $_SESSION['logged_user'];
		unset($_SESSION['logged_user']);
	} else {
		$olduser = false;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <title>CU Chorale</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/js.js"></script>
	</head>

	<body>

		<div id="container">
			<?php include 'includes/nav.php';?>
			<div id="homecontent" class="login_homecontent">
				<div id="banner" class="loginban">
            		<h2><span>Administrator Logout</span></h2>
        		</div> <!--end banner div-->
				<?php
					if ( $olduser ) {
						print("<p>Thanks for using our page, $olduser!</p>");
						print("<p>Return to our <a href='login.php' class='no_decoration'>login page</a></p>");
						print("<p>or go back to our <a href='index.php' class='no_decoration'>homepage</a> as a regular user.</p>");

					} else {
						print("<p>You logged out.</p>");
						print("<p>Go to our <a href='login.php' class='no_decoration'>login page</a></p>");
						print("<p>or go back to our <a href='index.php' class='no_decoration'>homepage</a> as a regular user.</p>");
					}
				?>
			</div>  <!--end content div-->

			<?php //include 'footer.php';?>

		</div> <!--end container div-->

		
	</body>
</html>