<?php

    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    class Award{
        var $name;
        var $event;
        var $date;

        public function __construct($name, $event, $date){
            $this->name = $name;
            $this->date = $date;
            $this->event = $event;
        }
    }

    $username = $_SESSION['username'];

    $new_award = new Award($_POST['name'], $_POST['event'], $_POST['date']);   

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $awards = $document['awards'];

    $update_awards = array();

    for($i=0; $i<count($awards); $i++){
        array_push($update_awards, $awards[$i]);
    }

    array_push($update_awards, $new_award);

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['awards'=>$update_awards]]
    );
    header('Location: ./edit_profile.php');
?>