<!DOCTYPE html>
<html>
    <head>
        <title>Set Leave Rotue</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="container">
            <form action="/set_route_db.php" method="post">
                <fieldset>
                    <legend>Set Route</legend>
                        <?php 
                            $posts_q=pg_query($db_connection, "SELECT  * FROM post_rank");
                            if(!$posts_q){
                                echo "Posts not found";
                            }
                            while ($posts_r=pg_fetch_assoc($posts_q)){
                                echo "<fieldset>";
                                echo "<label for='post_".$posts_r['rank_id']."'> ".$posts_r['rank_title']." </label><br>";
                                $routes_q=pg_query($db_connection, "SELECT  * FROM leave_routes");
                                if(!$routes_q){
                                    echo "Routes Not Found";
                                }
                                while ($row=pg_fetch_assoc($routes_q)){
                                    echo "<input type='radio' name='post_".$posts_r['rank_id']."' value='".$row['route_id']."'> ".$row['route_id']." ";
                                }
                                echo "<br></fieldset>";
                            }
                        ?>
                    <input type="submit" value="Submit">                    
                </fieldset>
            </form>
        </div>
    </body>
</html>