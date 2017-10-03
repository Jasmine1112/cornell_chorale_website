<?php session_start(); ?>

<!DOCTYPE html>

<html>
    
    <head>
        <meta charset="utf-8">
        <title>CU Chorale</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Yantramanav" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/ajax.js"></script>
		<script src="js/js.js"></script>
	</head>
    
    <body>
        <div id="container">
            <?php include 'includes/nav.php';?>
    
            <div id="homecontent">
            
                <div id="banner" class="membersban">
                    <h2 class="add_button_h2"><span>Our Members</span></h2>
                    <?php
                        if ( isset($_SESSION['logged_user'] ) ) {
                    ?>
                    <span class="add_button add_member_button">+</span>
                    <?php
                        }
                    ?>
                </div> <!--end banner div-->

                <div id="search_member">
                    <form id="search_member_form" class="form">
                        Search: 
                        <input type="text" id="search_member_input" placeholder="e.g. name, email"><br>
                    </form>
                </div>

                <?php
                    include 'includes/modal_div.php';
                    include 'includes/edit_member.php';
                    include 'includes/add_member.php';
                ?>

                <?php
                    if(isset($_SESSION['logged_user'])){
                        echo "<input type=\"text\" name=\"session\" id=\"session\" class=\"hidden\" value=\"session\">";
                    }else{
                        echo "<input type=\"text\" name=\"session\" id=\"session\" class=\"hidden\" value=\"\">";
                    }
                ?>
                    
                <div id="memberscontent">
                    <?php
                        // $images = array(
                        //     'img/placeholder.jpg' => 'Placeholder',
                        // );
                        // function print_image($url, $alt) {
                        //     echo '<img src="'.$url.'" alt="'.$alt.'">';
                        // }

                        // foreach ($images as $url => $alt){
                        //     print_image($url, $alt);
                        // }
                        //Get the config file
						require_once 'includes/config.php';
						$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
						if( $mysqli->connect_errno ) {
							//uncomment the next line for debugging
							echo "<p>$mysqli->connect_error<p>";
							die( "Couldn't connect to database");
						}
						
                        include 'includes/functions.php';
                        $Sopranos_result = get_members($mysqli, "Sopranos");
                        $Altos_result = get_members($mysqli, "Altos");
                        $Tenors_result = get_members($mysqli, "Tenors");
                        $Basses_result = get_members($mysqli, "Basses");
                        $Others_result = get_members($mysqli, "Others");
                        $Voice_parts = array("Sopranos" => $Sopranos_result, "Altos" => $Altos_result, "Tenors" => $Tenors_result, "Basses" => $Basses_result, "Others" => $Others_result);
                        foreach ($Voice_parts as $group => $members_result) {
                            echo '<div class="voice_part">';
                            echo "<h3>$group</h3>";
                            while ( $row = $members_result->fetch_assoc() ) {
                                //make sure that the quotation marks will not mess up the set_info() later.
                                $name = $row[ 'name' ];
                                $name = str_replace("'","\'",$name);
                                $name = str_replace('"','\"',$name);

                                $email = $row[ 'email' ]; 
                                $email = str_replace("'","\'",$email);
                                $email = str_replace('"','\"',$email);

                                $filename = $row[ 'filename' ]; 
                                $filename = str_replace("'","\'",$filename);
                                $filename = str_replace('"','\"',$filename);

                                $bio = $row[ 'bio' ]; 
                                $bio = str_replace("'","\'",$bio);
                                $bio = str_replace('"','\"',$bio);

                                $hometown = $row[ 'hometown' ]; 
                                $hometown = str_replace("'","\'",$hometown);
                                $hometown = str_replace('"','\"',$hometown);

                                $member_id = $row[ 'member_id' ]; 
                                if ($email==null) {
                                    $email="";
                                }
                                if ($bio==null) {
                                    $bio="";
                                }
                                echo '<div class="member_cell">';
                                echo '<img src="img/'.$filename.'" alt="'.$name."\" onClick=\"set_info('$name','$email','$filename','$bio','$hometown')\">";
                                echo '<div class="member_info">';
                                echo '<span>'.$name.'</span>';
                                echo '</div> <!--end member info div-->';
                                if ( isset($_SESSION['logged_user'] ) ) {
                                    echo"
                                        <span class=\"button\" onClick=\"edit_member('$name','$email','$filename','$bio','$hometown', '$member_id', '$group')\">Edit</span>";
                                }
                                echo '</div> <!--end member cell div-->';

                            }
                            echo '</div> <!--end voice part div-->';
                        }

                        
                    ?>
                </div> <!--end memberscontent div-->
                
            </div> <!--end content div-->
        
            <?php //include 'footer.php';?>
            
        </div> <!--end container div-->
        
    </body>

</html>