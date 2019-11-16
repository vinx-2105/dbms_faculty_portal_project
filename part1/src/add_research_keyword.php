<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $username = $_SESSION['username'];

    $add_keyword = $_POST['add_research_keyword'];

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $research_keywords = $document['research_keywords'];

    $update_research_keywords = array();

    for($i=0; $i<count($research_keywords); $i++){
        array_push($update_research_keywords, $research_keywords[$i]);
    }

    array_push($update_research_keywords, $add_keyword);

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['research_keywords'=>$update_research_keywords]]
    );
    header('Location: ./edit_profile.php');
?>