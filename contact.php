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
            <?php include 'includes/nav.php';?>
    
            <div id="homecontent">
            
                <div id="banner" class="contactban">
                    <div class="overlay">
                        <div id="contactform" class="contactform"> <!--beginning form div-->
                        <h1 id="contact">Contact Us!</h1>
                     
                        <form action="contact.php" method="GET"> <!--form begins-->
                            <p>
                                <label>Name</label>
                                <input type="text" name="name" placeholder="Joe Smith"/></p>
                            <p>
                                <label>Email</label>
                                <input type="email" name="email" placeholder="love2sing@gmail.com"/></p>
                            <p>
                                <label id="commenttag">Comment</label>
                                <input type="text" name="comment" id="commentbox"/></p>
                            <p>
                            <p><input type="submit" name="submit" value="Submit"/></p>
                        </form> <!--form ends-->
                    </div>
                </div> <!--end banner div-->

                    <?php #this is where the PHP for the form starts!
                        if (isset($_GET["submit"])){
                            echo "You submitted! ";

                            $name = $_GET["name"];
                            $email = $_GET["email"];
                            $comment = $_GET["comment"];
                            $contactreason = $_GET["contactreason"];

                            $formdata = $name . ", " . $email . ", " . $comment . ", " . $contactreason;
                            echo $formdata;

                            mail("ngs46@cornell.edu","2300 p1",$formdata);
                        }
                    ?> <!--ending of the php for the form!-->

                </div> <!--end form div-->
                
            </div> <!--end content div-->
        
            <?php //include 'footer.php';?>
            
        </div> <!--end container div-->
        
    </body>

</html>      