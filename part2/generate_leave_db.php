<?php
    include ("index.php");

    $check_pending_q=pg_query($db_connection,"SELECT * FROM leave WHERE faculty_id='".$_SESSION['username']."'");
    if(!$check_pending_q){
        echo "Error";
    }
    if(pg_num_rows($check_pending_q)>0){
        echo "Already has leave";
    }
    

    $faculty_q=pg_query($db_connection,"SELECT * FROM faculty WHERE faculty_id='".$_SESSION['username']."'");
    if(!$faculty_q||pg_num_rows($faculty_q)<=0){
        echo "Error";
    }
    else{
        $row=pg_fetch_assoc($faculty_q);
        echo "Leave Route ".$row['faculty_id']." ".$row['leave_route_id'];
        if(($row['leave_count']-$_POST['lv_num_days'])<0){
            $borrowed=1;
        }
        else $borrowed=0;
        
        $insert_q="INSERT INTO leave (faculty_id,leave_purpose,start_date,num_days,borrowed,leave_route_id) VALUES('".$_SESSION['username']."','".$_POST['lv_purpose']."','".$_POST['lv_start_date']."',".$_POST['lv_num_days'].",".$borrowed.",".$row['leave_route_id'].")";
        $insert_r=pg_query($db_connection,$insert_q);
        if(!$insert_r){
            echo "Error";
        }
        else{
            echo "Success";
        }
    }


    // header('Location: ./insert_dept_db.php');
?>

  