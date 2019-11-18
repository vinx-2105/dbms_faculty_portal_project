<?php
    session_start();
    $host        = "host =localhost";
    $dbname      = "dbname = portal";
    $credentials = "user = postgres password=pass123";
    $db_connection = pg_connect( "$host $dbname $credentials");
    if(!$db_connection) {
        echo "Error : Unable to open database\n";
    }
?>