<?php
    session_start();

    if($_SESSION['loggedin']==false){
        // echo $_SESSION['loggedin'];
        header("Location: ./login.php");
    }

    // include('./connect_db.php');
    include('./index.php');

?>
<html>
    <head>
        <title>Generate Leave</title>
    </head>
    <body>
        <div class="container">

            <form action="/generate_leave_db.php" method="post">
                <fieldset>
                    <!-- TODO: check if date is valid i.e after today -->

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