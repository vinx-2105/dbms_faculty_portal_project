<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // $collection = $_SESSION['curr_collection'];
    $username = $_SESSION['username'];

    $update_designation = $_POST['update_designation'];

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['designation'=>$update_designation]]
    );

    header('Location: ./edit_profile.php');
?>