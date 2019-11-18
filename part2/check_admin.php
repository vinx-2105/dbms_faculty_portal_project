<?php
    session_start();

    include('./index.php');

    $username = $_POST['uname'];
    $password = $_POST['psw'];

    if($username=='admin'){
        $_SESSION['admin']=true;
        header('Location: ./links.php');
    }
    else{
        $_SESSION['admin']=false;
        header('Location: ./admin.php');
    }
?>