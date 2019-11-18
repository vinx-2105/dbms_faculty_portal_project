<?php
    session_start();

    include('./index.php');

    $username = $_POST['uname'];
    $password = $_POST['psw'];

    $_SESSION['admin']=false;
    header('Location: ./login.php');
?>