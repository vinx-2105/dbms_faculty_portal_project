<?php
    session_start();

    require_once __DIR__ . "./../vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $username = $_SESSION['username'];

    $remove_course_taught_start_date = $_POST['remove_course_taught_start_date'];
    $remove_course_taught_end_date = $_POST['remove_course_taught_end_date'];
    $remove_course_taught_course_title = $_POST['remove_course_taught_course_title'];
    $remove_course_taught_course_code = $_POST['remove_course_taught_course_code'];
    $remove_course_taught_course_website = $_POST['remove_course_taught_course_website'];


    $document = $collection->findOne(['username' => $_SESSION['username']]);

    $courses_taught = $document['courses_taught'];

    $update_courses_taught = array();

    for($i=0; $i<count($courses_taught); $i++){
        $course_taught = $courses_taught[$i];
        $start_date = $course_taught['start_month'];
        $end_date = $course_taught['end_month'];
        $course_code = $course_taught['course_code'];
        $course_title = $course_taught['course_title'];
        $course_website = $course_taught['course_website'];

        if($remove_course_taught_start_date!=$start_date || $remove_course_taught_end_date!=$end_date || $remove_course_taught_course_website!=$course_website || $remove_course_taught_course_title!=$course_title || $remove_course_taught_course_code!=$course_code){
            array_push($update_courses_taught, $course_taught);
        }
    }
    $updated_collection = $collection->updateOne(
        ['username'=>$username],
        ['$set'=>['courses_taught'=>$update_courses_taught]]
    );
    header('Location: ./edit_profile.php');
?>