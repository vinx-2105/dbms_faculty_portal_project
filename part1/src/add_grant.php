<?php

    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    class Grant{
        var $name;
        var $sponsor;
        var $date;

        public function __construct($name, $sponsor, $date){
            $this->name = $name;
            $this->date = $date;
            $this->sponsor = $sponsor;
        }
    }

    $username = $_SESSION['username'];

    $new_grant = new Grant($_POST['name'], $_POST['sponsor'], $_POST['date']);   

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $grants = $document['grants'];

    $update_grants = array();

    for($i=0; $i<count($grants); $i++){
        array_push($update_grants, $grants[$i]);
    }

    array_push($update_grants, $new_grant);

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['grants'=>$update_grants]]
    );
    header('Location: ./edit_profile.php');
?>