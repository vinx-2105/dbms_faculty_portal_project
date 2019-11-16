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
        
        <title>Edit Profile | Faculty Profile Portal</title>

        <script>
            $(document).ready(function(){
                $("#edit_overview_div").show();
                $("#edit_courses_div").hide();
                $("#edit_publications_div").hide();
                $("#edit_grants_div").hide();
                $("#edit_awards_div").hide();

                $("#edit_overview_btn").click(function(){
                    $("#edit_overview_div").show();
                    $("#edit_courses_div").hide();
                    $("#edit_publications_div").hide();
                    $("#edit_grants_div").hide();
                    $("#edit_awards_div").hide();

                });
                $("#edit_courses_btn").click(function(){
                    $("#edit_overview_div").hide();
                    $("#edit_courses_div").show();
                    $("#edit_publications_div").hide();
                    $("#edit_grants_div").hide();
                    $("#edit_awards_div").hide();

                });
                $("#edit_publications_btn").click(function(){
                    $("#edit_overview_div").hide();
                    $("#edit_courses_div").hide();
                    $("#edit_publications_div").show();
                    $("#edit_grants_div").hide();
                    $("#edit_awards_div").hide();

                });
                $("#edit_grants_btn").click(function(){
                    $("#edit_overview_div").hide();
                    $("#edit_courses_div").hide();
                    $("#edit_publications_div").hide();
                    $("#edit_grants_div").show();
                    $("#edit_awards_div").hide();

                });
                $("#edit_awards_btn").click(function(){
                    $("#edit_overview_div").hide();
                    $("#edit_courses_div").hide();
                    $("#edit_publications_div").hide();
                    $("#edit_grants_div").hide();
                    $("#edit_awards_div").show();

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
            <!-- background, publications, grants, awards, teachings -->
                <div class="col-md-1"></div>
                <div class="col-md-2"><button id="edit_overview_btn" style="width:75%;margin:5px;" class="btn btn-primary">Overview</button></div>
                <div class="col-md-2"><button id="edit_courses_btn" style="width:75%;margin:5px;" class="btn btn-primary">Teaching</button></div>
                <div class="col-md-2"><button id="edit_publications_btn" style="width:75%;margin:5px;" class="btn btn-primary">Publications</button></div>
                <div class="col-md-2"><button id="edit_grants_btn" style="width:75%;margin:5px;" class="btn btn-primary">Grants</button></div>
                <div class="col-md-2"><button id="edit_awards_btn" style="width:75%;margin:5px;" class="btn btn-primary">Awards</button></div>
                <div class="col-md-1"></div>
            </div>
            <!-- overview -->
            <div class="row"><div class="col-md-12"><br><br></div></div>
            <div id='edit_overview_div'>
                <!-- update name -->
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
                <div class="row edit_department_div">
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
                <div class="row edit_google_scholar_link_div">
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
                <div class="row edit_extra_line_div">
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
                <div class="row edit_research_keywords">
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
                <div class="row edit_bio_div">
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
                <div class="row edit_about_me_div">
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

                <!-- update news -->
                <div class="row" id ="edit_news_div">
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

            <!-- courses taught -->
            <div class="row" id="edit_courses_div">
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


            <!-- update publications section -->
            <div class="row" id="edit_publications_div">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <p><strong>Publications</strong></p>
                    <form class="row" action="/add_publication.php" method="post">
                        <?php
                            //date
                            echo "<label for='date' style='margin-right:1em;  font-size:0.8em;'>Date</label>";
                            echo "<input type='date' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='date' name='date'>";
                            // title
                            echo "<label for='title' style='margin-right:1em;   font-size:0.8em;'>Title</label>";
                            echo "<input type='text' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='title' name='title'>";
                            //link
                            echo "<label for='link' style='margin-right:1em;   font-size:0.8em;'>Link</label>";
                            echo "<input type='url' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='link' name='link'>";
                            //conference
                            echo "<label for='conference' style='margin-right:1em;  font-size:0.8em;'>Conference</label>";
                            echo "<input type='text' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='conference' name='conference'>";

                            echo "<br>";

                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-success">Add</button>
                    </form>
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
                            //collaborators
                            for($j=0; $j<count($collaborators);$j++){
                                echo "<form class='form-inline' action='./remove_collaborator.php' method='post'>";
                                echo "<a style='margin:0;' target='blank' href='".$collaborators[$j]['link']."'><small>".$collaborators[$j]['name']."</small></a>";
                                echo "<input type='hidden' id='colab_link' name='colab_link' value=".$collaborators[$j]['link'].">";
                                echo "<input type='hidden' id='publication_index' name='publication_index' value=".$i.">";
                                echo "<button type='submit'  style='margin-left:0.5em; font-size:0.5em;' class='btn btn-sm btn-danger'><small>Delete</small></button>";                                
                                echo "<span> </span></form>";
                            }
                            //date
                            echo "<p style='margin:0;'><small>".$date."</small></p>";
                            //conference
                            echo "<p style='margin:0;'><small>".$conference."</small></p><br>";

                            //add collaborator form
                            echo "<form class='form-inline' action='./add_collaborator.php' method='post'>";
                            echo "<button type='submit'  style='margin-right:0.5em;' class='btn btn-sm btn-danger'><small>Add Collaborator</small></button>";
                            //send publication_index using hidden
                            echo "<input type='hidden' id='publication_index' name='publication_index' value=".$i.">";
                            //name
                            echo "<label for='colab_name' style='margin-right:1em;  font-size:0.8em;'>Collaborator Name</label>";
                            echo "<input type='text' id='colab_name' style='font-size:0.8em;width:20%;' name='colab_name'>";
                            //link
                            echo "<label for='colab_link' style='margin-right:1em;  font-size:0.8em;'>Collaborator Link</label>";
                            echo "<input type='url' id='colab_link' style='font-size:0.8em; width:20%;' name='colab_link'></form>";
                            
                            //delete publication form
                            echo "<form class='form-inline' action='./remove_publication.php' method='post'>";
                            echo "<button type='submit'  style='margin-right:0.5em;' class='btn btn-sm btn-danger'><small>Delete</small></button>";
                            //link
                            echo "<input type='hidden' id='remove_link' name='remove_link' value="."\"".$link."\"".">";
                            //title
                            echo "<input type='hidden' id='remove_title' name='remove_title' value="."\"".$title."\"".">";
                            //conference
                            echo "<input type='hidden' id='remove_conference' name='remove_conference' value="."\"".$conference."\"".">";
                            //date
                            echo "<input type='hidden' id='remove_date' name='remove_date' value="."\"".$date."\""."></form>";
                        }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>

            <!-- update awards -->
            <div class="row" id="edit_awards_div">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <p><strong>Awards</strong></p>
                    <!-- add award -->
                    <form class="row" action="/add_award.php" method="post">
                        <?php
                            echo "<label for='name' style='margin-right:1em;  font-size:0.8em;'>Award Name</label>";
                            echo "<input type='text' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='name' name='name'>";
                            
                            echo "<label for='event' style='margin-right:1em;   font-size:0.8em;'>Event</label>";
                            echo "<input type='text' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='event' name='event'>";
                            
                            echo "<label for='date' style='margin-right:1em;  font-size:0.8em;'>Date</label>";
                            echo "<input type='date' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='date' name='date'>";
                            
                            echo "<br>";

                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-success">Add</button>
                    </form>
                    <!-- delete award -->
                    <?php
                        $awards = $document['awards'];
                        for($i=0; $i<count($awards);$i++){
                            $name=$awards[$i]['name'];
                            $date=$awards[$i]['date'];
                            $event=$awards[$i]['event'];

                            echo "<h6><small><strong>".$name."</strong></small></h6>";
                            echo "<p style='margin:0;'><small>".$event."</small></p>";
                            echo "<p style='margin:0;'><small>".$date."</small></p>";
                            
                            echo "<form class='form-inline' action='./remove_award.php' method='post'>";
                            
                            echo "<button type='submit'  style='margin-left:0.5em;' class='btn btn-sm btn-danger'><small>Delete</small></button>";
                            echo "<input type='hidden' id='remove_date' name='remove_date' value='".$date."'>";
                            echo "<input type='hidden' id='remove_name' name='remove_name' value='".$name."'>";
                            echo "<input type='hidden' id='remove_event' name='remove_event' value='".$event."'></form>";
                        }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>


            <!-- update grants -->
            <div class="row" id="edit_grants_div">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <br>
                    <p><strong>Grants</strong></p>
                    <!-- add award -->
                    <form class="row" action="/add_grant.php" method="post">
                        <?php
                            echo "<label for='name' style='margin-right:1em;  font-size:0.8em;'>Grant Name</label>";
                            echo "<input type='text' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='name' name='name'>";
                            
                            echo "<label for='sponsor' style='margin-right:1em;   font-size:0.8em;'>Sponsor</label>";
                            echo "<input type='text' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='sponsor' name='sponsor'>";
                            
                            echo "<label for='date' style='margin-right:1em;  font-size:0.8em;'>Date</label>";
                            echo "<input type='date' style='width:15%; margin-right:1em;   font-size:0.8em;' class='form-control' id='date' name='date'>";
                            
                            echo "<br>";

                        ?>
                        <button type="submit" style='margin-right:2em;' class="btn btn-sm btn-success">Add</button>
                    </form>
                    <!-- delete award -->
                    <?php
                        $grants = $document['grants'];
                        for($i=0; $i<count($grants);$i++){
                            $name=$grants[$i]['name'];
                            $date=$grants[$i]['date'];
                            $sponsor=$grants[$i]['sponsor'];

                            echo "<h6><small><strong>".$name."</strong></small></h6>";
                            echo "<p style='margin:0;'><small>".$sponsor."</small></p>";
                            echo "<p style='margin:0;'><small>".$date."</small></p>";
                            
                            echo "<form class='form-inline' action='./remove_award.php' method='post'>";
                            
                            echo "<button type='submit'  style='margin-left:0.5em;' class='btn btn-sm btn-danger'><small>Delete</small></button>";
                            echo "<input type='hidden' id='remove_date' name='remove_date' value='".$date."'>";
                            echo "<input type='hidden' id='remove_name' name='remove_name' value='".$sponsor."'>";
                            echo "<input type='hidden' id='remove_sponsor' name='remove_sponsor' value='".$sponsor."'></form>";
                        }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
    </div>
   </body>

</html>