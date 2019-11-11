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
                            echo "<button type='submit' class='btn btn-sm btn-danger'>Delete</button></form>";
                        }
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
   </body>

</html>