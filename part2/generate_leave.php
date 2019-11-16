<!DOCTYPE html>
<html>
    <head>
        <title>Generate Leave</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="container">

            <form action="/generate_leave_db.php" method="post">
                <fieldset>
                    
                    <label for="faculty_id">Faculty Id: </label>
                    <input type="email" name="faculty_id"><br>
                   
                    <label for="lv_start_date">Start Date:</label>
                    <input type="date" name="lv_start_date"><br>
  

                    <label for="lv_num_days">Num of Days </label>
                    <input type="number" name="lv_num_days"></br>

                    <label for="lv_purpose">Purpose (Comments) </label>
                    <input type="text" name="lv_purpose"></br>

                    <input type="submit" value="Submit">
                </fieldset>
            </form>
        </div>
    </body>
</html>