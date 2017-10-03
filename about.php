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
            
                <div id="banner" class="aboutban">
                    <div class="overlay">
                        <h1 id="about">About</h1>
                        <img src="img/dropdownarrow.png" alt="arrow" id="downarrow">
                    </div>
                </div> <!--end banner div-->
                    <div id ="text" class="abouttext">
                        <h1>About Us</h1>
                        
                        <h2 id="conductors">Our Director</h2>
                            <p id="director"><img src="img/conductor.jpg" alt="conductor" id="conductor">Stephen Spinelli is the assistant director of choral programs at Cornell University, where he conducts the Cornell Chorale and Chamber Singers, and serves as the assistant director of the Glee Club and Chorus. Stephen spent the majority of the previous decade working in the Philadelphia region, where he served as the director of middle and upper school choirs at Abington Friends School, and as an assistant conductor for the Pennsylvania Girlchoir. He held additional posts at a number of universities, including Moravian College, Villanova University, and Philadelphia University. In addition to his conducting work, he performs as an accompanist and a choral tenor. He has sung and recorded with the critically acclaimed chamber choir The Crossing, with whom he has performed at noteworthy venues in New York City, Philadelphia, and Washington, DC. Stephen is also the accompanist for the Bennington Voice Workshops in Bennington, VT. He serves on the board of directors of the vocal octet Roomful of Teeth, for whom he assisted in the production of a Grammy Award-winning debut album, as well as their recently Grammy-nominated sophomore album, Render. He holds degrees from Williams College (BA, music) and Temple University (MM, choral conducting), and is currently a Doctor of Musical Arts candidate in choral conducting at Northwestern University.
                            </p>
                        
                        <h2 id="audition">The Audition Process</h2>
                            <h4>Eligibility</h4>
                            <p>The Cornell University Chorale is the only choir ensemble in Cornell that is open to the general public. Whether you are a student, a faculty or a community member, you are welcomed to sign up for the audition.</p>
                        
                            <h4>How to sign up for an Audition</h4>
                            <p>The Cornell University Chorale holds auditions jointly with the Cornell University Chorus, the Cornell University Glee Club, and the Cornell Chamber Singers. Auditions are held during Orientation Week before the fall semester and during the first week of classes during the spring semester.  You can sign up in advance at <a href="http://sage.music.cornell.edu">http://sage.music.cornell.edu</a> or come as a walk-in for fall and spring auditions.</p>
                        
                            <h4>The Audition Process</h4>
                            <p>The Cornell University Chorale holds auditions jointly with the Cornell University Chorus, the Cornell University Glee Club, and the Cornell Chamber Singers at the beginning of each academic semester. Scheduling your audition in advance is recommended, but walk-in auditions are generally allowed if the audition schedule permits.
                            Each singer is evaluated individually according to vocal range, pitch-matching ability, and sight-reading skill, demonstrated through a series of guided exercises. There is no need to prepare anything. In particular, sight-reading skill is not a prerequisite for Chorale. All auditionees will be notified of their results by phone or email within a week, and a list of new Chorale members will be posted on this website.</p>
                        
                            <h4>FAQ</h4>
                            <p id="q1">What is the difference between the different singing groups at Cornell? Which one is right for me?</p>
                            <p>Go to Singing at Cornell to read more about choral opportunities offered here.</p>
                        
                            <p id="q2">What is the time commitment like being a member of the Chorale?</p>
                            <p>We hold rehearsal every Friday from 4:30pm to 6:45pm. There will be one performance at the end of each semester. To find out more about the typical Chorale schedule and time commitment, go to <a href="syllabus.php">Syllabus.</a></p>
                        
                            <p id="q3">When/where can I hear the Chorale sing to find out what the Chorale sounds like?</p>
                            <p>You can go to <a href="gallery.php">Gallery</a> to hear recordings of past concerts.</p>
                        
                    </div>
                
            </div> <!--end content div-->
        
            <?php //include 'footer.php';?>
            
        </div> <!--end container div-->
        
    </body>

</html>