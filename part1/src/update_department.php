<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // $collection = $_SESSION['curr_collection'];
    $username = $_SESSION['username'];

    $update_department = $_POST['update_department'];

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['department'=>$update_department]]
    );

    header('Location: ./edit_profile.php');
?>