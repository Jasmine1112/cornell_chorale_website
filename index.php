<?php session_start(); ?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>CU Chorale</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Yantramanav" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="js/js.js"></script>
    </head>
    
    <body>
        <div id="container">
            <?php include 'includes/nav.php';?>
    
            <div id="homecontent">
            
                <div id="banner" class="homeban">
                    <div class="overlay"></div>
                    <div id="hometext">
                        <h2>Cornell University Chorale</h2>
                    </div>
                    <img class="mySlides" src="img/banner_1.jpg">
                    <img class="mySlides" src="img/banner_2.jpg">
                    <img class="mySlides" src="img/banner_3.jpg">
                </div> <!--end banner div-->
            
                <script>
                    var myIndex = 0;
                    carousel();

                    function carousel() {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        for (i = 0; i < x.length; i++) {
                           x[i].style.display = "none";  
                        }
                        myIndex++;
                        if (myIndex > x.length) {myIndex = 1}    
                        x[myIndex-1].style.display = "block";  
                        setTimeout(carousel, 5000); // Change image every 5 seconds
                    }
                </script>
            </div> <!--end content div-->
        
            <?php //include 'footer.php';?>
            
        </div> <!--end container div-->
        
    </body>

</html>