<!DOCTYPE html>
<html>
    <head>
        <title>Insert Faculty</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="container">

            <form action="/insert_faculty_db.php" method="post">
                <fieldset>
                    
                    <label for="faculty_id">Faculty Id:</label><br>
                    <input type="email" name="faculty_id"><br>
                   
                    <label for="fc_name">Name:</label><br>
                    <input type="text" name="fc_name"><br>
  
                    <!-- <label for="fc_lv_count">Leave Count:</label><br>
                    <input type="number" name="fc_lv_count"><br> -->

                    <label for="fc_dept_id">Department Name:</label><br>
                    <?php 
                        $departments_q=pg_query($db_connection, "SELECT  * FROM department");
                        if(!$departments_q){
                            echo "Departments not found";
                        }
                        while ($row=pg_fetch_assoc($departments_q)){
                            echo "<input type='radio' name='fc_dept_id' value='".$row['dept_id']."'>".$row['name']."<br>";
                        }
                    ?>

                    <!-- <label for="fc_post_rank">Post:</label><br>
                    <?php 
                        $posts_q=pg_query($db_connection, "SELECT  * FROM post_rank");
                        if(!$posts_q){
                            echo "Posts Not Found";
                        }
                        while ($row=pg_fetch_assoc($posts_q)){
                            echo "<input type='radio' name='fc_post_rank' value='".$row['rank_id']."'>".$row['rank_title']."<br>";
                        }
                    ?>
                    <label for='fc_post_start_date'>Post Start Date:</label><br>
                    <input type="date" name="fc_post_start_date"><br>
                    

                    <label for='fc_post_end_date'>Post End Date:</label><br>
                    <input type="date" name="fc_post_end_date"><br>

                    <label for ='fc_leave_route'>Rotue ID For Leaves:</label><br>
                    <?php 
                        $routes_q=pg_query($db_connection, "SELECT  * FROM leave_routes");
                        if(!$routes_q){
                            echo "Routes Not Found";
                        }
                        while ($row=pg_fetch_assoc($routes_q)){
                            echo "<input type='radio' name='fc_leave_route' value='".$row['route_id']."'>".$row['route_id']."<br>";
                        }
                    ?> -->
</fieldset>
                <fieldset>
                    <input type="submit" value="Submit">
                </fieldset>
            </form>
        </div>
    </body>
</html>