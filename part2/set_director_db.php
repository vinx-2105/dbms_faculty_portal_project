<?php
    include ("index.php");


    $update_q=pg_query($db_connection,"UPDATE FACULTY set post_rank=1 where faculty_id='".$_POST['director']."'");

    if(!$update_q){
        echo "Error";
    }
    else echo "Success";
    // header('Location: ./insert_dept_db.php');
?>

  