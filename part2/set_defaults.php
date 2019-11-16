<!DOCTYPE html>
<html>
    <head>
        <title>Set Defaults</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="container">
            <form action="/set_default_db.php" method="post">
                <fieldset>
                    <legend>Set Defaults</legend>
                        <?php 
                            $defaults_q=pg_query($db_connection, "SELECT  * FROM defaults");
                            if(!$defaults_q){
                                echo "defaults not found";
                            }
                            while ($row=pg_fetch_assoc($defaults_q)){
                                echo "<label for='".$row['parameter']."'>".$row['parameter'] ." </label>";
                                echo "<input type='number' name='".$row['parameter']."' value='".$row['default_value']."'><br>";
                            }
                        ?>
                    <input type="submit" value="Submit">                    
                </fieldset>
            </form>
        </div>
    </body>
</html>