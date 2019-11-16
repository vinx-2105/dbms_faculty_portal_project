<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $username = $_SESSION['username'];

    $remove_date = $_POST['remove_date'];
    $remove_sponsor = $_POST['remove_sponsor'];
    $remove_name = $_POST['remove_name'];

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $grants = $document['grants'];

    $update_grants = array();

    for($i=0; $i<count($awards); $i++){
        $grant = $grants[$i];
        
        $date = $grant['date'];
        $sponsor = $grant['sponsor'];
        $name = $grant['name'];

        if($date!=$remove_date || $sponsor!=$remove_sponsor || $name!=$remove_name){
            array_push($update_grant, $grant);
        }
    }
    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['grants'=>$update_grants]]
    );
    header('Location: ./edit_profile.php');
?>