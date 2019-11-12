<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // $collection = $_SESSION['curr_collection'];
    $username = $_SESSION['username'];

    $update_about_me = $_POST['update_about_me'];

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['about_me'=>$update_about_me]]
    );

    header('Location: ./edit_profile.php');
?>