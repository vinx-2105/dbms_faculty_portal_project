<?php
    session_start();
    //current number leaves
    //button which redirects to leave history
    //generate new leave application
    //TODO: current leave status and summary if any
    //button to redirect to special portal if needed

    if($_SESSION['loggedin']==false){
        header("Location: ./login.php");
    }

    include('./index.php');

    $faculty_q = pg_query($db_connection,"SELECT * FROM faculty WHERE faculty_id='".$_SESSION['username']."'");

    $faculty_r = pg_fetch_assoc($faculty_q);

    $leave_count = $faculty_r['leave_count'];
?>

<html>

   <head>
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
         -->
        <title>Dashboard | Faculty Leave Portal</title>
   </head>

   <body>
        <div class="container">
            <!-- <div class="navigation">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="./login.php">Faculty Leave Portal</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <?php
                            if($_SESSION['loggedin']==true){
                                echo "<li class='nav-item' 'navbar-right'><a class='nav-link' href='./dashboard.php'>Dashboard</a></li>";
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
            </div> -->
            <br><br><br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php
                        if($leave_count<0){
                            echo "<h4>Leaves borrowed from future years : ".$leave_count."</h4>";
                        }
                        else echo "<h4>Number of leaves remaining this year : ".$leave_count."</h4>";

                        echo "<br>";

                        echo "<form class='form-inline' action='/my_leave_history.php' method='post'>";
                        echo "<button type='submit' style='width:30em; margin-right:2em;' class='btn  btn-primary'>My Leave History</button></form>";
                        echo "<br>";

                        echo "<form class='form-inline' action='/generate_leave.php' method='post'>";
                        echo "<button type='submit' style='width:30em; margin-right:2em;' class='btn  btn-primary'>Apply for Leave</button></form>";

                        echo "<br>";
                        if($_SESSION['special_post']!=0){
                            echo "<form class='form-inline' action='/special_portal.php' method='post'>";
                            echo "<button type='submit' style='width:30em; margin-right:2em;' class='btn btn-primary'>Go to ".$_SESSION['rank_title']." Portal</button></form>";
                        }

                    ?>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
   </body>

</html>