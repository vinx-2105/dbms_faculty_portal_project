<?php
    session_start();

    include('./index.php');

    $login_q = pg_query($db_connection,"SELECT * FROM faculty WHERE faculty_id='".$_POST['uname']."' AND password='".$_POST['psw']."'");

    if(pg_num_rows($login_q)==1){
        $_SESSION["loggedin"]=true;
        $_SESSION["username"]=$_POST['uname'];
        // $_SESSION[""]
        header("Location: ./dashboard.php");
    }
    else{
        $_SESSION["loggedin"]=false;
        $_SESSION["username"]=NULL;
        // $_SESSION["num_nodes"]=NULL;
        header("Location: ./login.php");
    }
?>