<?php
    session_start();
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = NULL;
    // $_SESSION['curr_doc']=NULL;
    // $_SESSION["curr_collection"]=NULL;
    header("Location: ./index.php");
?>