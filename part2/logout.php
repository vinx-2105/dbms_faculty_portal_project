<?php
    session_start();
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = NULL;
    header("Location: ./login.php");
?>