<?php
    include ("index.php");
    // $_post_start_date=$_POST[fc_post_start_date];
    // $_post_end_date=$_POST[fc_post_end_date];
    // $leave_count=$_POST[fv_lv_count];

    // if($_POST[post_rank]==1){
    // $_post_start_date=NULL;
    // $_post_end_date=NULL;
    // }

    $count_q=pg_query($db_connection, "SELECT default_value from defaults where parameter='leave_count'");
    $count_r=pg_fetch_assoc($count_q);
    $leave_count=$count_r['default_value'];

    $route_q=pg_query($db_connection, "SELECT default_value from defaults where parameter='route_id'");
    $route_r=pg_fetch_assoc($route_q);
    $route_def=$route_r['default_value'];
// }

    $insert_query="INSERT INTO faculty(faculty_id, password, name,  dept_id,leave_count,leave_route_id) VALUES ('".$_POST['faculty_id']."','".$_POST['faculty_pwd']."','".$_POST['fc_name']."','".$_POST['fc_dept_id']."','".$leave_count."','".$route_def."')";
    $result=pg_query($db_connection,$insert_query);
    if(!$result){
        echo "Error";
    }
    else {
        echo "Success";
    } 
    // header('Location: ./insert_faculty.php');

    
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