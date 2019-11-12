<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // $collection = $_SESSION['curr_collection'];
    $username = $_SESSION['username'];

    $update_basic_bio = $_POST['update_basic_bio'];

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['basic_bio'=>$update_basic_bio]]
    );

    header('Location: ./edit_profile.php');
?>