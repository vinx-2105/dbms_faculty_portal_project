<!DOCTYPE html>
<html>
    <head>
        <title>Delete Department</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="container">
            <form action="/delete_dept_db.php" method="post">
                <fieldset>
                    <label for="dlt_dept_id">Choose From Department Name:</label><br>
                        <?php 
                            $departments_q=pg_query($db_connection, "SELECT  * FROM department");
                            $count_dept=0;
                            if(!departments_q){
                                echo "Departments not found";
                            }
                            while ($row=pg_fetch_assoc($departments_q)){
                                $count_dept=1;
                                echo "<input type='radio' name='dlt_dept_id' value='".$row['dept_id']."'>".$row['name']."<br>";
                            }
                            if($count_dept==1){
                                echo "<input type='submit' value='Submit'>";
                            }
                            else{
                                echo "No departments inserted.<br>";
                                echo "<a href='./insert_dept.php'> Insert Dept</a>";
                            }
                        ?>
                    
                    
                </fieldset>
            </form>
        </div>
    </body>
</html>