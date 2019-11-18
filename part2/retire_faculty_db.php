<?php
    include("./index.php");
    include("./functions.php");


    $retire_query="UPDATE faculty set post_rank=-1 WHERE faculty_id='".$_POST['faculty_id']."'";
    $result=pg_query($db_connection,$retire_query);

    header('Location: ./links.php');
?>