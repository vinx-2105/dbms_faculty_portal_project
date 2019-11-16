<!DOCTYPE html>
<html>
    <head>
        <title>View DB</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="card">
        <h4>Departments</h4>
        <div class="container">
        <?php 
            $departments_q=pg_query($db_connection, "SELECT  * FROM department");
            if(!$departments_q){
                echo "Departments not found";
            }
            while ($row=pg_fetch_assoc($departments_q)){
                echo $row['dept_id']." ".$row['name']." ".$row['hod_faculty_id']."<br>";
            }
        ?>
        </div>
        </div>

        <div class="card">
        <h4>Posts</h4>
        <div class="container">
        <?php 
            $posts_q=pg_query($db_connection, "SELECT  * FROM post_rank");
            if(!$posts_q){
                echo "Posts Not Found";
            }
            while ($row=pg_fetch_assoc($posts_q)){
                echo $row['rank_id']." ".$row['rank_title']."<br>";
            }
        ?>
        </div>
        </div>

        <div class="card">
        <h4>Faculty</h4>
        <div class="container">
        <?php 
            $fac_q=pg_query($db_connection, "SELECT  * FROM faculty");
            if(!$fac_q){
                echo "Faculty Not Found";
            }
            while ($row=pg_fetch_assoc($fac_q)){
                echo $row['faculty_id']." ".$row['name']." ".$row['dept_id']."<br>";
            }
        ?>
        </div>
        </div>

        <div class="card">
        <h4>Routes</h4>
        <div class="container">
        <?php 
            $fac_q=pg_query($db_connection, "SELECT  * FROM leave_routes");
            if(!$fac_q){
                echo "Routes Not Found";
            }
            while ($row=pg_fetch_assoc($fac_q)){
                echo $row['route_id']." ".$row['num_nodes']." ".$row['node1_rankid']." ".$row['node2_rankid']." ".$row['node3_rankid']." ".$row['node4_rankid']." ".$row['node5_rankid']."<br>";
            }
        ?>
        </div>
        </div>
    </body>
</html>