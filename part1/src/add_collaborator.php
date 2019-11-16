<?php

    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    class Collaborator{
        var $name;
        var $link;

        public function __construct($name, $link){
            $this->name = $name;
            $this->link = $link;
        }
    }

    $username = $_SESSION['username'];
    $document = $collection->findOne(['username' => $_SESSION['username']]);
    //the index of the publication in the publications array
    $publication_index = (int)$_POST['publication_index'];
    $collaborator = new Collaborator($_POST['colab_name'], $_POST['colab_link']);

    $publications = $document['publications'];

    $collaborators = $document['publications'][$publication_index]['collaborators'];

    $update_collaborators = array();

    for($i=0; $i<count($collaborators); $i++){
        array_push($update_collaborators, $collaborators[$i]);
    }
    array_push($update_collaborators, $collaborator);

    // echo $publications;

    $publications[$publication_index]['collaborators'] = $update_collaborators;

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['publications'=>$publications]]
    );

    header('Location: ./edit_profile.php');
?>

