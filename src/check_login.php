<?php
    session_start();
?>

<?php
    require_once __DIR__ . "./../vendor/autoload.php";
    // echo extension_loaded("mongodb") ? "loaded\n" : "not loaded\n";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    
    $document = $collection->findOne(['username' => $_POST["uname"], 'password' => $_POST["psw"]]);
      
    if($document){
        $_SESSION["loggedin"]=true;
        $_SESSION["username"]=$document['username'];
        header("Location: ./index.php");
    }

    else {
        header("Location: ./login.php");
    }
?>