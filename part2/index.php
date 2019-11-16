<html>
<head> <title>LeavePortal</title>
</head>
<body>
<?php
   $host        = "host =localhost";
   $dbname      = "dbname = trail1";
   $credentials = "user = postgres password=pass123";
   $db_connection = pg_connect( "$host $dbname $credentials"  );
   if(!$db_connection) {
      echo "Error : Unable to open database\n";
   }
?>

<a href="/links.php">Links</a><br>

<!-- <a href="insert_faculty.php">Insert Faculty </a> -->

</body>
</html>