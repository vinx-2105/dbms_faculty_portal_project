<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // $collection = $_SESSION['curr_collection'];
    $username = $_SESSION['username'];

    $update_gs_link = $_POST['update_gs_link'];

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['google_scholar_link'=>$update_gs_link]]
    );

    header('Location: ./edit_profile.php');
?>