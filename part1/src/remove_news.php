<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $username = $_SESSION['username'];

    $remove_news_date = $_POST['remove_news_date'];
    $remove_news_link = $_POST['remove_news_link'];
    $remove_news_content = $_POST['remove_news_content'];

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $news = $document['news'];

    $update_news = array();

    for($i=0; $i<count($news); $i++){
        $old_news = $news[$i];
        $news_date = $old_news['date'];
        $news_content = $old_news['content'];
        $news_link = $old_news['link'];

        if($remove_news_date!=$news_date || $news_content!=$remove_news_content || $news_link!=$remove_news_link){
            array_push($update_news, $old_news);
        }
    }
    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['news'=>$update_news]]
    );
    header('Location: ./edit_profile.php');
?>