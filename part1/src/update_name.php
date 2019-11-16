<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // $collection = $_SESSION['curr_collection'];
    $username = $_SESSION['username'];

    $update_name = $_POST['update_name'];

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['name'=>$update_name]]
    );

    header('Location: ./edit_profile.php');
?>