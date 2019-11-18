<?php
    session_start();
?>

<?php
    //insert into mongo db as well

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

?>

<?php

    $document = $collection->findOne([
        'username'=>$_POST['uname'],
        'password'=>$_POST['psw']
    ]);
    if($document){
        $_SESSION["loggedin"]=true;
        $_SESSION["username"]=$document['username'];
        // $_SESSION["curr_doc"]=$document;
        // $_SESSION["curr_collection"]=$collection;
        header("Location: ./index.php");
    }

    else {
        header("Location: ./login.php");
    }
?>