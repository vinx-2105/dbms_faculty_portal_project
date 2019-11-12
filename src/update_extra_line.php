<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // $collection = $_SESSION['curr_collection'];
    $username = $_SESSION['username'];

    $update_extra_line = $_POST['update_extra_line'];

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['extra_line'=>$update_extra_line]]
    );

    header('Location: ./edit_profile.php');
?>