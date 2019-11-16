<?php

    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $username = $_SESSION['username'];
    $document = $collection->findOne(['username' => $_SESSION['username']]);
    //the index of the publication in the publications array
    $colab_link = $_POST['colab_link'];
    $publication_index = $_POST['publication_index'];

    $publications = $document['publications'];

    $collaborators = $document['publications'][$publication_index]['collaborators'];

    $update_collaborators = array();

    for($i=0; $i<count($collaborators); $i++){
        if($collaborators[$i]['link']!=$colab_link)
            array_push($update_collaborators, $collaborators[$i]);
    }

    $publications[$publication_index]['collaborators'] = $update_collaborators;

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['publications'=>$publications]]
    );

    header('Location: ./edit_profile.php');
?>

