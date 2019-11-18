<!DOCTYPE html>
<html>
    <head>
        <title>Set Post</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="container">
            <form action="/set_post_hod_db.php" method="post">
                <fieldset>
                    <legend>Head of Departments </legend>
                        <?php 
                            $departments_q=pg_query($db_connection, "SELECT  * FROM department");
                            if(!$departments_q){
                                echo "Departments not found";
                            }
                            while ($row=pg_fetch_assoc($departments_q)){
                                echo "<label for='dept".$row['dept_id']."'>".$row['name']."</label>";
                                echo "<input type='email' name='dept".$row['dept_id']."' value='".$row['hod_faculty_id']."'><br>";
                                echo "<input type='date' name='post_start_date".$row['dept_id']."'><br>";
                                echo "<input type='date' name='post_end_date".$row['dept_id']."'><br>";
                            }
                            echo "<input type='submit' value='Submit'>";
                        ?>
                </fieldset>
            </form>
        </div>
        <div class="container">
            <form action="/set_post_ccf_db.php" method="post">
                <fieldset>
                    <legend>Cross Cutting Faculty </legend>
                        <?php 
                            $ccf_q=pg_query($db_connection, "SELECT  * FROM cross_cut_faculty");
                            if(!$ccf_q){
                                echo "Faculty not found";
                            }
                            while ($row=pg_fetch_assoc($ccf_q)){
                                echo "<label for='ccf".$row['ccf_id']."'>".$row['title']."</label>";
                                echo "<input type='email' name='ccf".$row['ccf_id']."' value='".$row['faculty_id']."'><br>";
                            }
                            echo "<input type='submit' value='Submit'>";
                        ?>
                </fieldset>
            </form>
        </div>
        <div class="container">
            <form action="/set_director_db.php" method="post">
                <fieldset>
                    <legend>Director </legend>
                        <?php
                            $dir_q=pg_query($db_connection,"SELECT faculty_id from faculty where post_rank=1");
                            if(!$dir_q){
                                echo "No Director Found.";
                            }
                            $row=pg_fetch_assoc($dir_q);
                            echo "<input type='email' name='director' value=".$row['faculty_id']."><br>"  ;
                            echo "<input type='submit' value='Submit'>";
                        ?>
                </fieldset>
            </form>
        </div>
    </body>
</html>