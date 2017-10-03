<?
function get_members($mysqli, $voice_part) {
	
	//galery only display images that are not photo of members
	if ($voice_part=="Sopranos"||$voice_part=="Altos"||$voice_part=="Tenors"||$voice_part=="Basses") {
		$sql="SELECT * FROM Members INNER JOIN Images ON Members.image_id=Images.image_id WHERE Members.voice_part=\"$voice_part\" ORDER BY Images.filename;";
	}else{//if voice_part is none of the 4 voice part, return the others 
		$sql="SELECT * FROM Members INNER JOIN Images ON Members.image_id=Images.image_id WHERE Members.voice_part!=\"Sopranos\" AND Members.voice_part!=\"Altos\" AND Members.voice_part!=\"Tenors\" AND Members.voice_part!=\"Basses\" OR Members.voice_part IS NULL;";
	}
	
	//get the data
	$result = $mysqli->query($sql);
	if (!$result) {
		print($mysqli->error);
		exit();
	}
	return $result;
}

function get_images($mysqli) {
	
	//galery only display images that are not photo of members
	$sql="SELECT *,Images.image_id AS gallery_imageid FROM Images LEFT JOIN Members ON Images.image_id=Members.image_id WHERE Members.member_id IS NULL AND NOT Images.image_id=1;";
	//get the data
	$result = $mysqli->query($sql);
	if (!$result) {
		print($mysqli->error);
		exit();
	}
	return $result;
}


function add_member($mysqli, $input_array){
	#$input_array is array of sanitized fields from a form
	#for each field in array, bind_param() to a prepared statement
}

function add_image($mysqli, $input_array){
	#$input_array is array of sanitized fields from a form
	#for each field in array, bind_param() to a prepared statement
}

function add_event($mysqli, $input_array){
	#$input_array is array of sanitized fields from a form
	#for each field in array, bind_param() to a prepared statement
}

function delete_member($mysqli, $member_id){
	#prepared statement delete where member_id = $member_id
}

function delete_image($mysqli, $image_id){
	#prepared statement delete where image_id = $image_id
}

function delete_event($mysqli, $event_id){
	#prepared statement delete where event_id = $event_id
}

function login($mysqli, $username, $password){
	
	$query = "SELECT * FROM Admins WHERE username = ?;";
	
	$stmt = $mysqli->stmt_init();
	if ($stmt->prepare($query)) {
		$stmt->bind_param('s', $username);
		if (!$stmt->execute()){
			print("<p>Error with login submission</p>");
		} else {
			$result = $stmt->get_result();
		}
	} else {
		print("<p>Error with login submission</p>");
	}
	
	if($result && $result->num_rows == 1) {
		
		$row = $result->fetch_assoc();
		$hash_pass = $row[ 'password' ];
		
		if( password_verify($password, $hash_pass)){
			return True;
		} else {
			print("<p>Unsuccesful login submission</p>");
		}
	}
	return False;
}
?>