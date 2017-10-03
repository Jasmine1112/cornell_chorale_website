<?php session_start(); ?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>CU Chorale</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Yantramanav" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/js.js"></script>
    </head>
    
    <body>
        <div id="container">
            <?php include 'includes/nav.php';
            ?>
    
            <div id="homecontent">
            
                <div id="banner" class="galleryban">
                    <h2 class="add_button_h2"><span>Image Gallery</span></h2>
                    <?php
                        if ( isset($_SESSION['logged_user'] ) ) {
                    ?>
                    <span class="add_button add_image_button">+</span>
                    <?php
                        }
                    
                        include 'includes/delete_image.php';
                        include 'includes/add_image.php';
                    ?>
                </div> <!--end banner div-->
                    
                <div id="gallerycontent">
                    <?php
                        include 'includes/functions.php';
                        //Get the config file
						require_once 'includes/config.php';
						$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
						if( $mysqli->connect_errno ) {
							//uncomment the next line for debugging
							echo "<p>$mysqli->connect_error<p>";
							die( "Couldn't connect to database");
						}
						
						$images_result = get_images($mysqli);
                        while ( $row = $images_result->fetch_assoc() ) {
                            $filename = $row[ 'filename' ];
                            $description = $row[ 'description' ]; 
                            $image_id = $row['gallery_imageid'];
                            echo '<img src="img/'.$filename.'" alt="'.$description.'">';
                            if ( isset($_SESSION['logged_user'] ) ) {
                                echo '<span class="delete_button delete_image_button" onClick=\'delete_image("'.$image_id.'","'.$filename.'","'.$description.'")\'>&#10060</span>';
                            }
                            
                        }

                    ?>
                </div> <!--end gallerycontent div-->
                
            </div> <!--end content div-->
        
            <?php //include 'footer.php';?>
            
        </div> <!--end container div-->
        
    </body>

</html>