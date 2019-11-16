<!DOCTYPE html>
<html>
    <head>
        <title>Create Route for Leave Application</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="container">
        <h4>Add Route</h4>
            <form action="/create_route_db.php" method="post">
                <fieldset>
                    <label for='node1'>Step 1</label>
                    <select name='node1'>
                    <?php 
                        $posts_q=pg_query($db_connection, "SELECT  * FROM post_rank");
                        if(!$posts_q){
                            echo "Posts not found";
                        }
                        while ($row=pg_fetch_assoc($posts_q)){
                            //faculty is not displayed for creating leave rotue
                            if($row['rank_id']>0)                 
                            echo "<option value='".$row['rank_id']."'>".$row['rank_title']."</option>";
                        }  
                    ?>
                    </select><br>
                    <label for='node2'>Step 2</label>
                    <select name='node2'>
                    <option value=''>None</option>    
                    <?php 
                        $posts_q=pg_query($db_connection, "SELECT  * FROM post_rank");
                        if(!$posts_q){
                            echo "Posts not found";
                        }
                        while ($row=pg_fetch_assoc($posts_q)){
                            //faculty is not displayed for creating leave rotue
                            if($row['rank_id']>0)                 
                            echo "<option value='".$row['rank_id']."'>".$row['rank_title']."</option>";
                        }  
                    ?>
                    </select><br>
                    <label for='node3'>Step 3</label>
                    <select name='node3'>
                    <option value=''>None</option>    

                    <?php 
                        $posts_q=pg_query($db_connection, "SELECT  * FROM post_rank");
                        if(!$posts_q){
                            echo "Posts not found";
                        }
                        while ($row=pg_fetch_assoc($posts_q)){
                            //faculty is not displayed for creating leave rotue
                            if($row['rank_id']>0)                 
                            echo "<option value='".$row['rank_id']."'>".$row['rank_title']."</option>";
                        }  
                    ?>
                    </select><br>
                    <label for='node4'>Step 4</label>
                    <select name='node4'>
                    <option value=''>None</option>    

                    <?php 
                        $posts_q=pg_query($db_connection, "SELECT  * FROM post_rank");
                        if(!$posts_q){
                            echo "Posts not found";
                        }
                        while ($row=pg_fetch_assoc($posts_q)){
                            //faculty is not displayed for creating leave rotue
                            if($row['rank_id']>0)                 
                            echo "<option value='".$row['rank_id']."'>".$row['rank_title']."</option>";
                        }  
                    ?>
                    </select><br>
                    <label for='node5'>Step 5</label>
                    <select name='node5'>
                    <option value=''>None</option>    

                    <?php 
                        $posts_q=pg_query($db_connection, "SELECT  * FROM post_rank");
                        if(!$posts_q){
                            echo "Posts not found";
                        }
                        while ($row=pg_fetch_assoc($posts_q)){
                            //faculty is not displayed for creating leave rotue
                            if($row['rank_id']>0){                 
                            echo "<option value='".$row['rank_id']."'>".$row['rank_title']."</option>";}
                        }  
                    ?>
                    </select><br>
                </fieldset>
                <input type="submit" value="Submit">
            </form>
        <div class="card">
        <h5>Note:</h5>
        <ls>Maximum steps for a leave route =5, Minimum steps for leave route =1</ls>
        <ls>Donot Leave Gaps in between</ls>
        </div>
        </div>
    </body>
</html>