<?php
    session_start();
    define('HOME_PATH', getcwd());

    $LATEST_NEWS_COUNT = 2;

    function get_abs_path($rel_path){
        return HOME_PATH.$rel_path;
    }

    if($_SESSION['loggedin']==false && isset($_GET['username'])==false){
        header('Location: ./login.php');
    }

    //query and store the document for the current user
    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $document = NULL;

    if(isset($_GET['username'])==true){
        $document = $collection->findOne(['username' => $_GET['username']]);
    }
    else{
        $document = $collection->findOne(['username' => $_SESSION['username']]);
    }
?>

<html>

   <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Faculty Profile Portal</title>
        <!-- <base href="localhost:8000/"> -->
        <script>
            $(document).ready(function(){
                $("#overview_div").show();
                $("#teaching_div").hide();
                $("#publications_div").hide();
                $("#grants_div").hide();
                $("#awards_div").hide();

                $("#overview_btn").click(function(){
                    $("#overview_div").show();
                    $("#teaching_div").hide();
                    $("#publications_div").hide();
                    $("#grants_div").hide();
                    $("#awards_div").hide();

                });
                $("#teaching_btn").click(function(){
                    $("#overview_div").hide();
                    $("#teaching_div").show();
                    $("#publications_div").hide();
                    $("#grants_div").hide();
                    $("#awards_div").hide();

                });
                $("#publications_btn").click(function(){
                    $("#overview_div").hide();
                    $("#teaching_div").hide();
                    $("#publications_div").show();
                    $("#grants_div").hide();
                    $("#awards_div").hide();

                });
                $("#grants_btn").click(function(){
                    $("#overview_div").hide();
                    $("#teaching_div").hide();
                    $("#publications_div").hide();
                    $("#grants_div").show();
                    $("#awards_div").hide();

                });
                $("#awards_btn").click(function(){
                    $("#overview_div").hide();
                    $("#teaching_div").hide();
                    $("#publications_div").hide();
                    $("#grants_div").hide();
                    $("#awards_div").show();

                });
            });
        </script>
   </head>

   <body>
        <div class="container">
            <div class="navigation">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="./index.php">Faculty Profile Portal</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./directory_home.php">Faculty Directory</a>
                        </li>
                        <?php
                            if($_SESSION['loggedin']==true){
                                echo "<li class='nav-item' 'navbar-right'><a class='nav-link' href='./profile_home.php'>My Profile</a></li>";
                                echo "<li class='nav-item' 'navbar-right'><a class='nav-link'>".$_SESSION['username']."</a></li>";
                                echo "<li class='nav-item' 'navbar-right'><a class='nav-link' href='./logout.php'>Logout</a></li>";
                            }
                            else{
                                echo "<li class='nav-item' 'navbar-right'><a class='nav-link' href='./login.php'>Login</a></li>";
                            }
                        ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <?php
                        $abs_path = get_abs_path('/../res/faculty_profile_images/default.png');
                        // echo "<img src='".$abs_path."' alt='Profile Pic'>" ;
                    ?>
                    <img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPO9CRBZvXer-YKt5Qicll9hyjJNEPt9GQGPNuJf3qjuP9Ep6aKw&s' alt='default-dp' height='150' width='150'>
                    <br>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <?php
                        echo "<h2>".$document['name']."</h2>";
                        echo "<p style='margin:5px;'><small>".$document['title']."</small></p>";
                        echo "<p style='margin:5px;'><small>".$document['designation'].", ".$document['department']."</small></p>";
                        echo "<p style='margin:5px;'><small>Email: ".$document['email']."</small></p>";
                        echo "<a  style='margin:5px;' href='".$document['google_scholar_link']."'><small>Google Scholar</small></a>";
                        echo "<p  style='margin:5px;' ><small>".$document['extra_line']."</small></p>";
                    ?>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-2"></div>
            </div>
            <br>
            <div class="row">
            <!-- background, publications, grants, awards, teachings -->
                <div class="col-md-1"></div>
                <div class="col-md-2"><button id="overview_btn" style="width:75%;margin:5px;" class="btn btn-primary">Overview</button></div>
                <div class="col-md-2"><button id="teaching_btn" style="width:75%;margin:5px;" class="btn btn-primary">Teaching</button></div>
                <div class="col-md-2"><button id="publications_btn" style="width:75%;margin:5px;" class="btn btn-primary">Publications</button></div>
                <div class="col-md-2"><button id="grants_btn" style="width:75%;margin:5px;" class="btn btn-primary">Grants</button></div>
                <div class="col-md-2"><button id="awards_btn" style="width:75%;margin:5px;" class="btn btn-primary">Awards</button></div>
                <div class="col-md-1"></div>
            </div>
            <div class="row">
                <div class="col-md-12"><br><br></div>
            </div>
            <!-- The overview container -->
            <div id="overview_div">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                        <h4>Personal Profile</h4>
                        <a href="./../edit_profile.php"><small>Edit Profile</small></a>
                    </div>
                    <div class="col-md-3">
                        <h6>Research Area Keywords</h6>
                        <?php
                            $research_keywords = $document['research_keywords'];
                            for($i=0; $i<count($research_keywords); $i++){
                                echo "<button style='margin:5px;' class='btn btn-sm btn-secondary'><small>".$research_keywords[$i]."</small></button>";
                            }
                        ?>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-7">
                            <h5><strong>Biography</strong></h5>
                            <?php
                                echo "<p><small>".$document['basic_bio']."</small></p>";

                                echo "<p><small><strong>Latest News</strong></small></p>";

                                $news = $document['news'];
                                for($i=0; $i<count($news)&&$i<$LATEST_NEWS_COUNT; $i++){
                                    $news_link = $news[$i]['link'];
                                    $news_content = $news[$i]['content'];
                                    $news_date = $news[$i]['date'];
                                    echo "<a target='blank' href='".$news_link."'><small>".$news_date." ".$news_content."</small></a><br>";
                                }
                                echo "<br>"
                            ?>
                            <!-- <p><small>May 2020 - Internship at Goldman Sachs</small></p>
                            <p><small>May 2021 - Joining the Civil Services</small></p> -->
                            <h6><small><strong>About Me</strong></small></h6>
                            <?php
                                echo "<p><small>".$document['about_me']."</small></p>";
                            ?>

                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-1"></div>
                </div>
            </div>

            <!-- the teaching container -->
            <div id="teaching_div">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-8">
                        <h4>Courses Taught</h4>
                        <?php
                            $courses_taught = $document['courses_taught'];
                            for($i=0; $i<count($courses_taught); $i++){
                                $start_date=$courses_taught[$i]['start_month'];
                                $end_date=$courses_taught[$i]['end_month'];
                                $course_code=$courses_taught[$i]['course_code'];
                                $course_title=$courses_taught[$i]['course_title'];
                                $course_website=$courses_taught[$i]['course_website'];

                                echo "<a href='".$course_website."'><small>".$start_date." to ".$end_date." --> ".$course_code." ".$course_title."</small></a><br>";                            
                            }
                        ?>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <!-- the publications container -->
            <div id="publications_div">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-8">
                        <h4>Publications</h4>
                        <?php
                            $publications = $document['publications'];
                            for($i=0; $i<count($publications);$i++){
                                $date=$publications[$i]['date'];
                                $link=$publications[$i]['link'];
                                $title=$publications[$i]['title'];
                                $conference=$publications[$i]['conference'];
                                $collaborators =$publications[$i]['collaborators'];

                                //link and title
                                echo "<h6><small><strong><a target='blank' href='".$link."'>".$title."</a></strong></small></h6>";

                                for($j=0; $j<count($collaborators);$j++){
                                    echo "<a style='margin:0;' target='blank' href='".$collaborators[$j]['link']."'><small>".$collaborators[$j]['name']."</small></a>";
                                    echo "<span>, </span>";
                                }

                                echo "<br>";

                                //date
                                echo "<p style='margin:0;'><small>".$date."</small></p>";
                                //conference
                                echo "<p style='margin:0;'><small>".$conference."</small></p><br>";
                            }
                        ?>

                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <!-- the grants container -->
            <div id="grants_div">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-8">
                        <h4>Grants</h4>
                        <?php
                            $grants  = $document['grants'];
                            for($i=0; $i<count($grants);$i++){
                                $name=$grants[$i]['name'];
                                $date=$grants[$i]['date'];
                                $sponsor=$grants[$i]['sponsor'];
    
                                echo "<h6><small><strong>".$name."</strong></small></h6>";
                                echo "<p style='margin:0;'><small>".$sponsor."</small></p>";
                                echo "<p style='margin:0; margin-bottom:0.4em;'><small>".$date."</small></p>";
                            }
                        ?>
                        <!-- <h6><small><strong>Best Paper Award</strong></small></h6>
                        <p style="margin:0;"><small>Dhall A.</small></p>
                        <p style="margin:0;"><small>July 2020</small></p> -->
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <!-- the awards container -->
            <div id="awards_div">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-8">
                        <h4>Awards</h4>
                        <?php
                            $awards  = $document['awards'];
                            for($i=0; $i<count($awards);$i++){
                                $name=$awards[$i]['name'];
                                $date=$awards[$i]['date'];
                                $event=$awards[$i]['event'];
    
                                echo "<h6><small><strong>".$name."</strong></small></h6>";
                                echo "<p style='margin:0;'><small>".$event."</small></p>";
                                echo "<p style='margin:0; margin-bottom:0.4em;'><small>".$date."</small></p>";
                            }
                        ?>
                        <!-- <h6><small><strong>Best Paper Award</strong></small></h6>
                        <p style="margin:0;"><small>Dhall A.</small></p>
                        <p style="margin:0;"><small>July 2020</small></p> -->
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

        </div>
        <div class="container" style="background-color:grey;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6"><p><small>Developed by Vineet Madan & Mehakjot Singh for CS-301 at IIT Ropar</small></p></div>
                <div class="col-md-3"></div>
            </div>
        </div>

   </body>
</html>