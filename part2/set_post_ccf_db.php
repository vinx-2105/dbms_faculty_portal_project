<?php
    include ("index.php");

    $ccf_q=pg_query($db_connection,"SELECT * FROM cross_cut_faculty");
    while ($row=pg_fetch_assoc($ccf_q)){
        if($row['faculty_id']!=$_POST['ccf'.$row['ccf_id']]){
            $update_q="UPDATE cross_cut_faculty SET faculty_id ='".$_POST['ccf'.$row['ccf_id']]."' where ccf_id=".$row['ccf_id'];
            $update_result=pg_query($db_connection,$update_q);
            if(!$update_result){
                echo $update_q;
                // echo "Error at CCF Title: ".$row['title']."<br>";
            }
            else{
                echo "Done";
            }
        }
    }
    // header('Location: ./insert_dept_db.php');
?>

  