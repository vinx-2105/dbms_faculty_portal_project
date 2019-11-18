<?php
    include ("index.php");
    include ("functions.php");

    $check_pending_q=pg_query($db_connection,"SELECT * FROM leave WHERE faculty_id='".$_SESSION['username']."' AND status='pending' ");
    if(!$check_pending_q){
        echo "Error";
    }
    if(pg_num_rows($check_pending_q)>0){
        echo "Already has leave";
    }
    else{
        $faculty_r=get_faculty_by_id($db_connection,$_SESSION['username']);
        $post_r=get_post_by_id($db_connection,$faculty_r['post_rank']);


        // $faculty_q=pg_query($db_connection,"SELECT * FROM faculty WHERE faculty_id='".$_SESSION['username']."'");
        
            echo "Leave Route ".$faculty_r['faculty_id']." ".$post_r['leave_route_id'];

            $insert_q="INSERT INTO leave (faculty_id,leave_purpose,start_date,num_days,leave_route_id) VALUES('".$_SESSION['username']."','".$_POST['lv_purpose']."','".$_POST['lv_start_date']."',".$_POST['lv_num_days'].",".$post_r['leave_route_id'].")";
            $insert_r=pg_query($db_connection,$insert_q);
            if(!$insert_r){
                header('Location: ./error.php');
            }
            else{
                header('Location: ./my_leave_history.php');
            }
    }
?>

  