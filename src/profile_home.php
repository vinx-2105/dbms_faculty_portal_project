<?php
    session_start();
    define('HOME_PATH', getcwd());

    $LATEST_NEWS_COUNT = 2;

    function get_abs_path($rel_path){
        return HOME_PATH.$rel_path;
    }

    if($_SESSION['loggedin']==false){
        header('Location: ./login.php');
    }

    //query and store the document for the current user
    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $document = $collection->findOne(['username' => $_SESSION['username']]);
?>

<html>

   <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Faculty Profile Portal</title>
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
                        <a href="./edit_profile.php"><small>Edit Profile</small></a>
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
                                $news_arr = $document['news_arr'];
                                for($i=0; $i<count($news_arr)&&$i<$LATEST_NEWS_COUNT; $i++){
                                    echo "<p><small>".$news_arr[$i]['date']." - ".$news_arr[$i]['news']."</small></p>";
                                }
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
                                echo"<p><small></small></p>";
                            }
                        ?>
                        <h6><small><strong>Spring 2019</strong></small></h6>
                        <a href="https://google.com"><small>CS-501 Computer Vision</small></a><br>
                        <a href="https://google.com"><small>CS-529 Applied Artificial Intelligence</small></a><br>
                        <a href="https://google.com"><small>CS-302 Maths for CS</small></a><br>
                        <h6><small><strong>Fall 2019</strong></small></h6>
                        <a href="https://google.com"><small>CS-501 Computer Vision</small></a><br>
                        <a href="https://google.com"><small>CS-529 Applied Artificial Intelligence</small></a><br>
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
                        <h6><small><strong><a href="https://google.com">Domain adaptation based topic modeling techniques for engagement estimation in the wild</a></strong></small></h6>
                        <p style="margin:0;"><small>Dhall A., Madan V.</small></p>
                        <p style="margin:0;"><small>December 2019</small></p>
                        <p style="margin:0;"><small>Conference on Computer Vsion and Pattern Recognition 2019</small></p><br>

                        <h6><small><strong><a href="https://google.com">Domain adaptation based topic modeling techniques for engagement estimation in the wild</a></strong></small></h6>
                        <p style="margin:0;"><small>Dhall A., Madan V.</small></p>
                        <p style="margin:0;"><small>December 2019</small></p>
                        <p style="margin:0;"><small>Conference on Computer Vsion and Pattern Recognition 2019</small></p><br>
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
                        <h6><small><strong>Microsoft India Research Grant</strong></small></h6>
                        <p style="margin:0;"><small>Microsoft India</small></p>
                        <p style="margin:0;"><small>July 2020</small></p>
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
                        <h6><small><strong>Best Paper Award</strong></small></h6>
                        <p style="margin:0;"><small>Dhall A.</small></p>
                        <p style="margin:0;"><small>July 2020</small></p>
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

   </body>

</html>