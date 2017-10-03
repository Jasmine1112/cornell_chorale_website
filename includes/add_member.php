<?php
	if ( isset( $_SESSION[ 'logged_user' ] ) ) {
		//Protected content here
		echo '	
		<div class="modal modal_add_member">
			<a class="exit"> X </a>
			<form method="post" enctype="multipart/form-data" class="form">
				Profile picture: <input type="file" name="new_image"><br>
				<span>Name: <input type="text" name="add_name" id="add_name" placeholder="required"></span><br>
				<span>Email: <input type="text" name="add_email" id="add_email"></span><br>
				<span>Bio: <input type="text" name="add_bio" id="add_bio"></span><br>
				<span>Hometown: <input type="text" name="add_hometown" id="add_hometown" placeholder="required"></span><br>
				<span>Voice part: <input type="text" name="add_voice_part" id="add_voice_part"></span><br>
				<input type="submit" name="submit_add_member" value="Save" class="button submit_add_button"><br>
			</form>
		</div>';
	}


	if (isset($_POST["submit_add_member"])) {
		
		$name_input = filter_input(INPUT_POST, 'add_name', FILTER_SANITIZE_STRING);
		$email_input = filter_input(INPUT_POST, 'add_email',FILTER_SANITIZE_STRING);
		$bio_input = filter_input(INPUT_POST, 'add_bio',FILTER_SANITIZE_STRING);
		$hometown_input = filter_input(INPUT_POST, 'add_hometown',FILTER_SANITIZE_STRING);
		$voice_part_input = filter_input(INPUT_POST, 'add_voice_part',FILTER_SANITIZE_STRING);

		//fine the last name of name_input, make it the filename of the new image
		$last_name = end(explode( ' ', $name_input ));

		//if name or hometown field is not filled out
		//since name and hometown field can't be null in db
		if (empty($name_input)||empty($hometown_input)) {
			echo "<p>Member failed to be added. Please make sure that you filled out the name and hometown fields.</p>";
		}
		elseif (!is_uploaded_file($_FILES['new_image']['tmp_name'])) {
			require_once 'includes/config.php';
			//Establish a database connection
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			//Was there an error connecting to the database?
			if ($mysqli->errno) {
				//The page isn't worth much without a db connection so display the error and quit
				print($mysqli->error);
				exit();
			}
			//if no photo is uploaded, then use placeholder image as profile picture
			$sql_insert_member = "INSERT INTO Members (name, email, image_id, bio, hometown, voice_part) VALUES (?,?,1,?,?,?);";
			$stmt = $mysqli->stmt_init();
			if ($stmt->prepare($sql_insert_member)) {
				if (!$stmt->bind_param('sssss', $name_input, $email_input, $bio_input, $hometown_input, $voice_part_input)) {
					print("<p>Error with parameters input</p>");
				}
				if (!$stmt->execute()){
					print("<p>Error with submission</p>");
				}
			} else {
				print("<p>Error with add preparation </p>");
			}
		}else{//if there is a photo uploaded, and fields not null are filled out
			
			$file_input = $_FILES['new_image'];
			$originalName = $file_input[ 'name' ]; 
			$tempName = $file_input[ 'tmp_name' ]; 
			$size_in_bytes = $file_input[ 'size' ];
			$extension = pathinfo($originalName,PATHINFO_EXTENSION);
			//make sure that the image file name does not exist in the img folder
			$count_file = "";
			while (file_exists("img/$last_name$count_file.$extension")) {
				$count_file=$count_file+1;
			}
			$new_filename = "$last_name$count_file.$extension";

			//if the image is too large than 1200px*1200px
			if ($size_in_bytes>2880000) {
				echo "<p>The image file is too large, please resize it or change a different one so that image uploaded is smaller than 1200px*1200px.</p>";
			}

			//if the type of the file is not common image type
			elseif (strtolower($extension)!="jpeg"&&strtolower($extension)!="jpg"&&strtolower($extension)!="png") {
				echo "<p>Sorry the uploading does not support $extension file. Please change extension or change a different image to make sure you upload a jpeg/jpg/png file.</p>";
			} else {
				require_once 'includes/config.php';
				//Establish a database connection
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				
				//Was there an error connecting to the database?
				if ($mysqli->errno) {
					//The page isn't worth much without a db connection so display the error and quit
					print($mysqli->error);
					exit();
				}
				
				$sql_insert_image = "INSERT INTO Images (filename, description, date_added) VALUES (?,?,CURRENT_DATE);";
				$stmt = $mysqli->stmt_init();
				if ($stmt->prepare($sql_insert_image)) {
					if (!$stmt->bind_param('ss', $new_filename, $name_input)) {
						print("<p>Error with parameters input</p>");
					}
					if (!$stmt->execute()){
						print("<p>Error with inserting image</p>");
					}else{//if successfully inserted the new image
						//then move the image to img folder
						move_uploaded_file($tempName, "img/$new_filename");
						//get the image id of the new image
						$sql_get_imageid = "SELECT filename, image_id FROM Images ORDER BY image_id DESC LIMIT 1";
						$imageid_result = $mysqli->query($sql_get_imageid);
						//if no result, print the error
						if (!$imageid_result) {
							print($mysqli->error);
							exit();
						}else{
							$row = $imageid_result->fetch_assoc();
							$last_filename=$row['filename'];
							$last_imageid=$row['image_id'];
							//if the result is not the image just added
							if (!$last_filename==$new_filename) {
								print("<p>Error with locating the new image</p>");
							}else{
								$sql_insert_member = "INSERT INTO Members (name, email, image_id, bio, hometown, voice_part) VALUES (?,?,?,?,?,?);";
								$stmt = $mysqli->stmt_init();
								if ($stmt->prepare($sql_insert_member)) {
									if (!$stmt->bind_param('ssisss', $name_input, $email_input, $last_imageid, $bio_input, $hometown_input, $voice_part_input)) {
										print("<p>Error with parameters input</p>");
									}
									if (!$stmt->execute()){
										print("<p>Error with submission</p>");
									}
								} else {
									print("<p>Error with add preparation </p>");
								}
							}
						}
						
					}
				} else {
					print("<p>Error with insert image preparation </p>");
				}
				
			}
		}
		
	}
?>