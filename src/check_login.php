<?php
    require_once __DIR__ . "./../vendor/autoload.php";
    // echo extension_loaded("mongodb") ? "loaded\n" : "not loaded\n";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;
    // echo $_POST["uname"];
    $collection->insertOne(['username' => 'yogesh']);
    // $document = $collection->findOne(['username' => $_POST["uname"]]);
    // var_dump($document);
?>