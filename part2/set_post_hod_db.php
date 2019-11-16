<?php
    include ("index.php");

    $dept_q=pg_query($db_connection,"SELECT * FROM department");
    while ($row=pg_fetch_assoc($dept_q)){
        if($row['hod_faculty_id']!=$_POST['dept'.$row['dept_id']]){
            $update_q="UPDATE department SET hod_faculty_id ='".$_POST['dept'.$row['dept_id']]."' where dept_id=".$row['dept_id'];
            $update_result=pg_query($db_connection,$update_q);


            if(!$update_result){
                echo "Error at Dept : ".$row['name']."<br>";
            }
            else{
                echo "HOD set for Dept: ".$row['name']."<br>";
            }
        }
        
    }
    // header('Location: ./insert_dept_db.php');
?>

  