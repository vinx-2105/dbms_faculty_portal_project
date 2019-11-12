<?php

    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    class News{
        var $date;
        var $content;
        var $link;

        public function __construct($date, $content, $link){
            $this->date = $date;
            $this->content = $content;
            $this->link = $link;
        }
    }

    $username = $_SESSION['username'];

    $new_news = new News($_POST['news_date'], $_POST['news_content'], $_POST['news_link']);

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $news = $document['news'];

    $update_news = array();

    for($i=0; $i<count($news); $i++){
        array_push($update_news, $news[$i]);
    }

    array_push($update_news, $new_news);

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['news'=>$update_news]]
    );
    header('Location: ./edit_profile.php');
?>