<?php
    session_start();

    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = NULL;
    $_SESSION['rank_title'] = NULL;
    $_SESSION['special_post'] = NULL;
    $_SESSION['post_id'] = NULL;

    // echo "Logged out";

    header("Location: ./login.php");
?>