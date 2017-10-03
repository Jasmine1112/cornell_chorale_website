
            <div id="navbar">
                <!--Navigation-->
                <ul>
                    <div id="logo">
                        <a href="index.php"> <img src="img/logo_1.png" id="chorale" alt="logo"></a>
                    </div>
                    <div class="underline">
                        <li id="homenav"><a href="index.php">Home</a></li>
                        <li id="gallerynav"><a href="gallery.php">Gallery</a></li>
                        <li id="membersnav"><a href="members.php">Members</a></li>
                        <li id="eventsnav"><a href="syllabus.php">Syllabus</a></li>
                        <div id="about_dropdown">
                            <li id="aboutnav"><a href="about.php">About</a></li>
                            <li class="dropdown"><a href="about.php#audition">Audition</a></li>
                            <li class="dropdown"><a href="about.php#conductors">Conductors</a></li>
                        </div>
                        <li id="contactnav"><a href="contact.php">Contact</a></li>
                    </div>
                    <?php
                        if ( !isset($_SESSION['logged_user'] ) ) {
                            echo "<li id=\"loginnav\"><a href=\"login.php\">Login</a></li>";
                        } else{
                            echo "<li id=\"logoutnav\"><a href=\"logout.php\">Logout</a></li>";
                        }
                    ?>
                    <!--Footer links-->
                    <div id="socialmedia">
                            <li>Follow Us!</li>
                                <a href="https://www.facebook.com/CornellChorale/"> <img src="img/Facebook_Icon.png" id="FB" alt="FBlogo"></a>
                                <a href="https://www.youtube.com/watch?v=Nwd_NYYmUVg"> <img src="img/YT_Icon.png" id="YT" alt="YTlogo"></a>
                    </div>
                </ul>
            </div>