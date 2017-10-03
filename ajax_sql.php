<?php 
	
  //Get the connection info for the DB. 
  require_once 'includes/config.php';
  
  //Establish a database connection
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  //Was there an error connecting to the database?
  if ($mysqli->errno) {
    //The page isn't worth much without a db connection so display the error and quit
    print($mysqli->error);
    exit();
  }

  $query = "SELECT * FROM Members INNER JOIN Images ON Members.image_id = Images.image_id";

  
	$stmt = $mysqli->stmt_init();
	if ($stmt->prepare($query)) {
		if (!$stmt->execute()){
			print("<p>Error with edit submission</p>");
		} else {
			$result = $stmt->get_result();
		}
	}
  

  while($row = $result->fetch_assoc()){
	$table_data[]= array("name"=>$row['name'],"email"=>$row['email'],"filename"=>$row['filename'],"bio"=>$row['bio'],"hometown"=>$row['hometown'],"voice_part"=>$row['voice_part']);
  }
	echo json_encode($table_data);

?>
