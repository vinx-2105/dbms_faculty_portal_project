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

            <form action="/retire_faculty_db.php" method="post">
                <fieldset>
                    <label for="faculty_id">Faculty Id:</label><br>
                    <input type="email" name="faculty_id"><br>

                    <input type="submit" value="Submit">
                </fieldset>
            </form>
        </div>
    </body>
</html>