<?php
    include("./index.php");
    include("./functions.php");

    $count_q=pg_query($db_connection, "SELECT default_value from defaults where parameter='leave_count'");
    $count_r=pg_fetch_assoc($count_q);
    $leave_count=$count_r['default_value'];

    $insert_query="INSERT INTO faculty(faculty_id, password, name,  dept_id,leave_count) VALUES ('".$_POST['faculty_id']."','".$_POST['faculty_pwd']."','".$_POST['fc_name']."','".$_POST['fc_dept_id']."','".$leave_count."')";
    $result=pg_query($db_connection,$insert_query);

    //insert the user into mongodb as well
    require_once __DIR__ . "./../part1/vendor/autoload.php";
    $client = (new MongoDB\Client);
    $collection = $client->FacultyProfiles->faculty_profiles;

    $insertResult = $collection->insertOne([
            'username'=>$_POST['faculty_id'],
            'password'=>$_POST['faculty_pwd'],
            'name'=>$_POST['fc_name'],
            'department'=>get_dept_name_from_id($db_connection, $_POST['fc_dept_id']),
            'visible'=>false,
            'title'=>'',
            'email'=>'',
            'extra_line'=>'',
            'google_scholar_link'=>'',
            'designation'=>'',
            'research_keywords'=>array(),
            'basic_bio'=>'',
            'about_me'=>'',
            'courses_taught'=>array(),
            'news'=>array(),
            'publications'=>array(),
            'awards'=>array(),
            'grants'=>array(),
            'pic_link'=>array(),
        ]
    );

    if(!$result){
        header('Location: ./error.php');
    }
    else {
        echo "Success";
    }

?>

<div class="card">
        <h4>Faculty</h4>
        <div class="container">
        <?php 
            $fac_q=pg_query($db_connection, "SELECT  * FROM faculty");
            if(!$fac_q){
                echo "Faculty Not Found";
            }
            while ($row=pg_fetch_assoc($fac_q)){
                echo $row['faculty_id']." ".$row['name']."<br>";
            }
        ?>
</div>
</div>