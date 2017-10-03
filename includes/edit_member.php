<?php
	if ( isset( $_SESSION[ 'logged_user' ] ) ) {
		//Protected content here
		echo '	
		<div class="modal modal_edit_member">
			<a class="exit"> X </a>
			<img src="img/placeholder.jpg" alt="member to be edited">
			<form method="post" enctype="multipart/form-data" class="form">
				<input type="text" name="edit_member_id" id="edit_member_id" class="hidden">
				<span>Name: <input type="text" name="edit_name" id="edit_name"></span><br>
				<span>Email: <input type="text" name="edit_email" id="edit_email"></span><br>
				<span>Bio: <input type="text" name="edit_bio" id="edit_bio"></span><br>
				<span>Hometown: <input type="text" name="edit_hometown" id="edit_hometown"></span><br>
				<span>Voice part: <input type="text" name="edit_voice_part" id="edit_voice_part"></span><br>
				<input type="submit" name="submit_edit_member" value="Save" class="button submit_edit_button"><br>
				<span id="delete_member_button" class="button">*DELETE*</span>
				<div class="hidden confirmation">
					<input type="submit" name="delete_confirmed" value="Delete" class="button">
					<input type="submit" name="cancel" value="Cancel" class="button">
				</div>
			</form>
		</div>';
	}


	if (isset($_POST["submit_edit_member"])) {
		$member_id_input = filter_input(INPUT_POST, 'edit_member_id',FILTER_SANITIZE_NUMBER_INT);
		$name_input = filter_input(INPUT_POST, 'edit_name', FILTER_SANITIZE_STRING);
		$email_input = filter_input(INPUT_POST, 'edit_email',FILTER_SANITIZE_STRING);
		$bio_input = filter_input(INPUT_POST, 'edit_bio',FILTER_SANITIZE_STRING);
		$hometown_input = filter_input(INPUT_POST, 'edit_hometown',FILTER_SANITIZE_STRING);
		$voice_part_input = filter_input(INPUT_POST, 'edit_voice_part',FILTER_SANITIZE_STRING);

		//if name or hometown field is not filled out
		//since name and hometown field can't be null in db
		if (empty($name_input)||empty($hometown_input)) {
			echo "<p>Member failed to be edited. Please make sure that you filled out the name and hometown fields.</p>";
		} else {
			//update 
			//get data from Members
			require_once 'includes/config.php';
			//Establish a database connection
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			//Was there an error connecting to the database?
			if ($mysqli->errno) {
				//The page isn't worth much without a db connection so display the error and quit
				print($mysqli->error);
				exit();
			}
			
			$query = "UPDATE Members SET name = ?, email = ?, bio = ?, hometown = ?, voice_part = ? WHERE member_id = ?";
	
			$stmt = $mysqli->stmt_init();
			if ($stmt->prepare($query)) {
				if (!$stmt->bind_param('sssssi', $name_input, $email_input, $bio_input, $hometown_input, $voice_part_input, $member_id_input)) {
					print("<p>Error with edit parameters</p>");
				}
				if (!$stmt->execute()){
					print("<p>Error with edit submission</p>");
				}
			} else {
				print("<p>Error with edit preparation </p>");
			}
		}
	}
	
	//if delete image button is clicked
	if (isset($_POST["delete_confirmed"])) {
		$member_id_input = filter_input(INPUT_POST, 'edit_member_id',FILTER_SANITIZE_NUMBER_INT);

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
		
		$query="SELECT Members.image_id, Images.filename FROM Members INNER JOIN Images ON Members.image_id = Images.image_id WHERE Members.member_id = ?;";
		
		//get the data
		
		$stmt = $mysqli->stmt_init();
		if ($stmt->prepare($query)) {
			if (!$stmt->bind_param('i', $member_id_input)) {
				print("<p>Error with edit parameters</p>");
			}
			if (!$stmt->execute()){
				print("<p>Error with edit submission</p>");
			} else {
				$result = $stmt->get_result();
			}
		} else {
			print("<p>Error with edit preparation </p>");
		}
		
		$row = $result->fetch_assoc();
		$image_id_deleted = $row['image_id'];
		$filename_deleted = $row['filename'];

		//prepare statements for deleting image, member
		
		$delete1="DELETE FROM Members WHERE member_id = ?";
		$stmt = $mysqli->stmt_init();
		if ($stmt->prepare($delete1)) {
			if (!$stmt->bind_param('i', $member_id_input)) {
				print("<p>Error with delete parameters</p>");
			}
			if (!$stmt->execute()){
				print("<p>Error with delete submission</p>");
			}
		} else {
			print("<p>Error with delete preparation </p>");
		}

		//make sure the deleted image is not the placeholder image
		if ($filename_deleted!="placeholder.jpg") {
			$delete2="DELETE FROM Images WHERE image_id = ?";
			$stmt = $mysqli->stmt_init();
			if ($stmt->prepare($delete2)) {
				if (!$stmt->bind_param('i', $image_id_deleted)) {
					print("<p>Error with delete parameters</p>");
				}
				if (!$stmt->execute()){
					print("<p>Error with delete submission</p>");
				} else {
					
					//on succesful delete from database, delete image
					if (file_exists("img/$filename_deleted")) {
						unlink("img/$filename_deleted");
					}
				}
			} else {
				print("<p>Error with delete preparation </p>");
			}
		}
		

	}
?>