<?php
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = NULL;
    $_SESSION['rank_title'] = NULL;
    $_SESSION['special_post'] = NULL;
    $_SESSION['post_id'] = NULL;
    
    header("Location: ./login.php");
?>