<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $username = $_SESSION['username'];

    $remove_title = $_POST['remove_title'];
    $remove_link = $_POST['remove_link'];
    $remove_date = $_POST['remove_date'];
    $remove_conference = $_POST['remove_conference'];

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $publications = $document['publications'];

    $update_publications = array();

    for($i=0; $i<count($publications); $i++){
        $publication = $publications[$i];
        $publication_title = $publication['title'];
        $publication_conference = $publication['conference'];
        $publication_date = $publication['date'];
        $publication_link = $publication['link'];

        if($remove_date!=$publication_date || $remove_link!=$publication_link || $remove_conference!=$publication_conference || $remove_title!=$publication_title){
            array_push($update_publications, $publication);
        }
    }
    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['publications'=>$update_publications]]
    );
    header('Location: ./edit_profile.php');
?>