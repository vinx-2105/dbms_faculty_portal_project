<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // $collection = $_SESSION['curr_collection'];
    $username = $_POST['username'];

    $document = $collection->findOne(['username' => $username]);
    $current = $document['visible'];

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['visible'=>!$current]]
    );

    header('Location: ./admin.php');
?>