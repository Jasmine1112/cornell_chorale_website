<?php
	if ( isset( $_SESSION[ 'logged_user' ] ) ) {
		//Protected content here
		echo '	
		<div class="modal modal_add_image">
			<a class="exit"> X </a>

			<form method="post" enctype="multipart/form-data" class="form">
				New Image: <input type="file" name="new_image"><br>
				<span>Description: <input type="text" name="add_description" id="add_description" placeholder="optional"></span><br>
				<input type="submit" name="submit_add_image" value="Save" class="button submit_add_button"><br>
			</form>
		</div>';
	}


	if (isset($_POST["submit_add_image"])) {
		
		$allowed_types = ["image/jpeg", "image/png", "image/gif"];
		
		if ( !empty($_FILES['new_image']) && !empty($_POST['add_description'])) {
			
			$imageDescription = filter_input( INPUT_POST, 'add_description', FILTER_SANITIZE_STRING );
			$newImage = $_FILES['new_image'];
			$originalName = $newImage['name'];
			$tempName = $newImage['tmp_name'];
			
			if ( $newImage['error'] == 0 && in_array($newImage['type'], $allowed_types)){
				
				if ($newImage[ 'size' ] < 5242880){
					$extension = pathinfo($originalName,PATHINFO_EXTENSION);
					$name = pathinfo($originalName,PATHINFO_FILENAME);
					//make sure that the image file name does not exist in the img folder
					$count_file = "";
					$new_filename = "$name$count_file.$extension";
					while (file_exists("img/$new_filename")) {
						$count_file=$count_file+1;
						$new_filename = "$name$count_file.$extension";
					}
					
					require_once 'includes/config.php';
					//Establish a database connection
					$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
					
					//Was there an error connecting to the database?
					if ($mysqli->errno) {
						//The page isn't worth much without a db connection so display the error and quit
						print($mysqli->error);
						exit();
					}
					
					$sql_insert_image = "INSERT INTO Images (filename, description) VALUES (?,?);";
					$stmt = $mysqli->stmt_init();
					if ($stmt->prepare($sql_insert_image)) {
						
						if ($stmt->bind_param('ss', $new_filename, $imageDescription)) {
							if($stmt->execute()){
								print('<p>Info saved to database</p>');
							} else {
								print('<p>Error executing SQL<p>');
							}
						} else {
							print("<p>Error with parameters input</p>");
						}
					} else {
						print("<p>Error with SQL preperation</p>");
					}
					
					move_uploaded_file($tempName, "img/$new_filename");
					print("The file $new_filename was uploaded successfully.\n");
					
				} else {
					print("<p>Error with image size! File too large<p>");
				}
			} else {
				print("<p>Error with image type!<p>");
			}
		} else {
			print("<p>Please select a file and give a description!<p>");
		}
	}
?>