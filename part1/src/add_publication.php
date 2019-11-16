<?php

    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;


    class Publication{
        var $title;
        var $link;
        var $date;
        var $conference;//or journal
        var $collaborators;

        public function __construct($title, $link, $date, $conference){
            $this->collaborators = NULL;
            $this->conference = $conference;
            $this->date = $date;
            $this->link = $link;
            $this->title = $title;
        }
    }

    $username = $_SESSION['username'];

    $publication = new Publication($_POST['title'], $_POST['link'], $_POST['date'], $_POST['conference']);

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $publications = $document['publications'];

    $update_publications = array();

    for($i=0; $i<count($publications); $i++){
        array_push($update_publications, $publications[$i]);
    }

    array_push($update_publications, $publication);

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['publications'=>$update_publications]]
    );
    header('Location: ./edit_profile.php');
?>