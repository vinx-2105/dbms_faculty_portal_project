<!DOCTYPE html>
<html>
    <head>
        <title>Insert Department</title>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    </head>
    <body>
        <?php 
            include ("index.php");
        ?>
        <div class="container">
            <form action="/insert_dept_db.php" method="post">
                <fieldset>
                <label for="dept_name">Department Name:</label><br>
                <input type="text" name="dept_name"><br>
                <input type="submit" value="Submit">
                </fieldset>
            </form>
        </div>
    </body>
</html>