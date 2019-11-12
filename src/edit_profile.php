<?php
    session_start();

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
        <title>Faculty Profile Portal</title>
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
                <div class="col-md-10">
                    <form class="form-inline" action="/update_name.php" method="post">
                        <label for="update_name" style="margin-right:2em;">Name</label>
                        <?php
                            echo "<input type='text' style='width:50%; margin-right:2em;' class='form-control' id='update_name' placeholder="."\"".$document['name']."\""." name='update_name'>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update Name</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- update email -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form class="form-inline" action="/update_email.php" method="post">
                        <label for="update_email" style="margin-right:2em;">Email</label>
                        <?php
                            echo "<input type='text' style='width:50%; margin-right:2em;' class='form-control' id='update_email' placeholder="."\"".$document['email']."\""." name='update_email'>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update Email</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- update title -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form class="form-inline" action="/update_title.php" method="post">
                        <label for="update_title" style="margin-right:2em;">Title</label>
                        <?php
                            echo "<input type='text' style='width:50%; margin-right:2em;' class='form-control' id='update_title' placeholder="."\"".$document['title']."\""." name='update_title'>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update Title</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- update designation -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form class="form-inline" action="/update_designation.php" method="post">
                        <label for="update_designation" style="margin-right:2em;">Designation</label>
                        <?php
                            echo "<input type='text' style='width:50%; margin-right:2em;' class='form-control' id='update_designation' placeholder="."\"".$document['designation']."\""." name='update_designation'>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update Designation</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- update department -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form class="form-inline" action="/update_department.php" method="post">
                        <label for="update_department" style="margin-right:2em;">Department</label>
                        <?php
                            echo "<input type='text' style='width:50%; margin-right:2em;' class='form-control' id='update_department' placeholder="."\"".$document['department']."\""." name='update_department'>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update Department</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- update google scholar link -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form class="form-inline" action="/update_gs_link.php" method="post">
                        <label for="update_email" style="margin-right:2em;">Google Scholar Link</label>
                        <?php
                            echo "<input type='text' style='width:50%; margin-right:2em;' class='form-control' id='update_gs_link' placeholder="."\"".$document['google_scholar_link']."\""." name='update_gs_link'>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update Google Scholar Link</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- update extra line link -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <form class="form-inline" action="/update_extra_line.php" method="post">
                        <label for="update_extra_line" style="margin-right:2em;">One Liner</label>
                        <?php
                            echo "<input type='text' style='width:50%; margin-right:2em;' class='form-control' id='update_extra_line' placeholder="."\"".$document['extra_line']."\""." name='update_extra_line'>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update One Liner</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- update research keywords -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <p><strong>Research Keywords</strong></p>
                    <form class="form-inline" action="/add_research_keyword.php" method="post">
                        <!-- <label for="add_research_keyword" style="margin-right:2em;">Add Research Keyword</label> -->
                        <?php
                            echo "<input type='text' style='width:50%; margin-right:2em;' class='form-control' id='add_research_keyword' name='add_research_keyword'>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-success">Add</button>
                    </form>
                    <?php
                        // get the existing research keywords array
                        $r_keys = $document['research_keywords'];
                        for($i=0; $i<count($r_keys); $i++){
                            echo "<form class='form-inline' action='/remove_research_keyword.php' method='post'>";
                            echo "<input type='hidden' id='remove_research_keyword' name='remove_research_keyword' value="."\"".$r_keys[$i]."\"".">";
                            echo "<button  style='margin-right:2em;' class='btn btn-sm btn-secondary'><small>".$r_keys[$i]."</small></button>";
                            echo "<button type='submit'  class='btn btn-sm btn-danger'><small>Delete</small></button></form>";
                        }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>
            <!-- update basic bio -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <p><strong>Basic Bio</strong></p>
                    <form class="form-inline" action="/update_basic_bio.php" method="post">
                        <!-- <label for="update_basic_bio" style="margin-right:2em;">Basic Bio</label> -->
                        <?php
                            echo "<textarea rows='5' style='width:70%; margin-right:2em;' class='form-control' id='update_basic_bio' placeholder="."\"".$document['basic_bio']."\""." name='update_basic_bio'></textarea>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update Basic Bio</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>

            <!-- update about me -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <p><strong>About Me</strong></p>
                    <form class="form-inline" action="/update_about_me.php" method="post">
                        <!-- <label for="update_basic_bio" style="margin-right:2em;">Basic Bio</label> -->
                        <?php
                            echo "<textarea rows='8' style='width:70%; margin-right:2em;' class='form-control' id='update_about_me' placeholder="."\"".$document['about_me']."\""." name='update_about_me'></textarea>";
                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-primary">Update About Me</button>
                    </form>
                </div>
                <div class="col-md-1"></div>
            </div>


            <!-- courses taught -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <p><strong>Courses Taught</strong></p>
                    <form class="row" action="/add_course_taught.php" method="post">
                        <?php
                            echo "<label for='start_month' style='margin-right:1em;  font-size:0.8em;'>Start Month</label>";
                            echo "<input type='date' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='start_month' name='start_month'>";
                            echo "<label for='end_month' style='margin-right:1em;   font-size:0.8em;'>End Month</label>";
                            echo "<input type='date' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='end_month' name='end_month'>";
                            echo "<label for='course_code' style='margin-right:1em;   font-size:0.8em;'>Course Code</label>";                            
                            echo "<input type='text' style='width:10%; margin-right:1em;   font-size:0.8em;' class='form-control' id='course_code' name='course_code'>";
                            echo "<label for='course_title' style='margin-right:1em;   font-size:0.8em;'>Course Title</label>";                    
                            echo "<input type='text' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='course_title' name='course_title'>";
                            echo "<label for='course_website' style='margin-right:1em;   font-size:0.8em;'>Course Website</label>";                            
                            echo "<input type='text' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='course_website' name='course_website'>";

                            echo "<br>";

                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-success">Add</button>
                    </form>
                    <?php
                        $courses_taught = $document['courses_taught'];
                        for($i=0; $i<count($courses_taught);$i++){
                            $start_date=$courses_taught[$i]['start_month'];
                            $end_date=$courses_taught[$i]['end_month'];
                            $course_code=$courses_taught[$i]['course_code'];
                            $course_title=$courses_taught[$i]['course_title'];
                            $course_website=$courses_taught[$i]['course_website'];

                            echo "<form class='form-inline' action='/remove_course_taught.php' method='post'>";
                            echo "<a href='".$course_website."'><small>".$start_date." to ".$end_date." --> ".$course_code." ".$course_title."</small></a>";
                            echo "<button type='submit'  style='margin-left:0.5em;' class='btn btn-sm btn-danger'><small>Delete</small></button>";
                            echo "<input type='hidden' id='remove_course_taught_start_date' name='remove_course_taught_start_date' value="."\"".$start_date."\"".">";
                            echo "<input type='hidden' id='remove_course_taught_end_date' name='remove_course_taught_end_date' value="."\"".$end_date."\"".">";
                            echo "<input type='hidden' id='remove_course_taught_course_code' name='remove_course_taught_course_code' value="."\"".$course_code."\"".">";
                            echo "<input type='hidden' id='remove_course_taught_course_title' name='remove_course_taught_course_title' value="."\"".$course_title."\"".">";
                            echo "<input type='hidden' id='remove_course_taught_course_website' name='remove_course_taught_course_website' value="."\"".$course_website."\""."></form>";
                        }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>

            <!-- news -->
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <p><strong>News</strong></p>
                    <form class="row" action="/add_news.php" method="post">
                        <?php
                            echo "<label for='news_date' style='margin-right:1em;  font-size:0.8em;'>Date</label>";
                            echo "<input type='date' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='news_date' name='news_date'>";
                            echo "<label for='news_link' style='margin-right:1em;   font-size:0.8em;'>News Link</label>";
                            echo "<input type='url' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='news_link' name='news_link'>";
                            echo "<label for='news_content' style='margin-right:1em;  font-size:0.8em;'>Content</label>";
                            echo "<input type='news_content' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='news_content' name='news_content'>";
                            echo "<br>";

                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-success">Add</button>
                    </form>
                    <?php
                        $news = $document['news'];
                        for($i=0; $i<count($news);$i++){
                            $news_date=$news[$i]['date'];
                            $news_link=$news[$i]['link'];
                            $news_content=$news[$i]['content'];

                            echo "<form class='form-inline' action='./remove_news.php' method='post'>";
                            echo "<a target='blank' href='".$news_link."'><small>".$news_date." ".$news_content."</small></a>";
                            echo "<button type='submit'  style='margin-left:0.5em;' class='btn btn-sm btn-danger'><small>Delete</small></button>";
                            echo "<input type='hidden' id='remove_news_date' name='remove_news_date' value="."\"".$news_date."\"".">";
                            echo "<input type='hidden' id='remove_news_content' name='remove_news_content' value="."\"".$news_content."\"".">";
                            echo "<input type='hidden' id='remove_news_link' name='remove_news_link' value="."\"".$news_link."\""."></form>";
                        }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
   </body>

</html>