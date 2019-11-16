<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $username = $_SESSION['username'];

    $remove_date = $_POST['remove_date'];
    $remove_event = $_POST['remove_event'];
    $remove_name = $_POST['remove_name'];

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $awards = $document['awards'];

    $update_awards = array();

    for($i=0; $i<count($awards); $i++){
        $award = $awards[$i];
        
        $date = $award['date'];
        $event = $award['event'];
        $name = $award['name'];

        if($date!=$remove_date || $event!=$remove_event || $name!=$remove_name){
            array_push($update_awards, $award);
        }
    }
    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['awards'=>$update_awards]]
    );
    header('Location: ./edit_profile.php');
?>