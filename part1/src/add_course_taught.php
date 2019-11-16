<?php

    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    class CourseTaught{
        var $start_month;
        var $end_month;
        var $course_code;
        var $course_title;
        var $course_website;

        public function __construct($startMonth, $endMonth, $courseCode, $courseTitle, $courseWebsite){
            $this->start_month = $startMonth;
            $this->end_month = $endMonth;
            $this->course_code = $courseCode;
            $this->course_title = $courseTitle;
            $this->course_website = $courseWebsite;
        }
    }

    $username = $_SESSION['username'];

    $new_course_taught = new CourseTaught($_POST['start_month'], $_POST['end_month'], $_POST['course_code'], $_POST['course_title'], $_POST['course_website']);   

    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $courses_taught = $document['courses_taught'];

    $update_courses_taught = array();

    for($i=0; $i<count($courses_taught); $i++){
        array_push($update_courses_taught, $courses_taught[$i]);
    }

    array_push($update_courses_taught, $new_course_taught);

    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['courses_taught'=>$update_courses_taught]]
    );
    header('Location: ./edit_profile.php');
?>