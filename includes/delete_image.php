<?php
	if ( isset( $_SESSION[ 'logged_user' ] ) ) {
		//Protected content here
		echo '	
		<div class="modal modal_delete_image">
			<a class="exit"> X </a>

			<form method="post" enctype="multipart/form-data" class="form">
				<img src="img/placeholder.jpg" alt="member to be deleted" id="image_tobe_deleted"><br>
				<input type="text" name="delete_image_id" id="delete_image_id" class="hidden">
				Are you sure you want to delete this image "<span id="delete_description"></span>" from gallery?<br>
				<input type="submit" name="submit_delete_image" value="Yes!" class="button submit_delete_button">
				<input type="submit" name="cancel_delete_image" value="Cancel" class="button cancel_delete_button"><br>
			</form>
		</div>';
	}


	if (isset($_POST["submit_delete_image"])) {
		$image_id_input = filter_input(INPUT_POST, 'delete_image_id',FILTER_SANITIZE_NUMBER_INT);

		require_once 'includes/config.php';
		//Establish a database connection
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		
		//Was there an error connecting to the database?
		if ($mysqli->errno) {
			//The page isn't worth much without a db connection so display the error and quit
			print($mysqli->error);
			exit();
		}

		//get the image id of the person to be deleted
		
		$query="SELECT filename FROM Images WHERE image_id = ?";
		
		$stmt = $mysqli->stmt_init();
		if ($stmt->prepare($query)) {
			if (!$stmt->bind_param('i', $image_id_input)) {
				print("<p>Error with edit parameters</p>");
			}
			if (!$stmt->execute()){
				print("<p>Error with edit submission</p>");
			} else {
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();
				$filename_deleted = $row['filename'];
			}
		}
		
		
		
		
		$query="DELETE FROM Images WHERE image_id = ?";
		
		//get the data
		$stmt = $mysqli->stmt_init();
		if ($stmt->prepare($query)) {
			if (!$stmt->bind_param('i', $image_id_input)) {
				print("<p>Error with edit parameters</p>");
			}
			if (!$stmt->execute()){
				print("<p>Error with edit submission</p>");
			} else {
				//on succesful delete from database, delete image
				if (file_exists("img/$filename_deleted")) {
					unlink("img/$filename_deleted");
				}
			}
		} else {
			print("<p>Error with edit preparation </p>");
		}
	}
?>