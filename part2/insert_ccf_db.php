<?php
    include ("index.php");

    $dept_insert_query="INSERT INTO cross_cut_faculty (title) VALUES ('".$_POST['post_name']."')";
    $result=pg_query($db_connection,$dept_insert_query);
    $post_query=pg_query($db_connection,"SELECT * FROM cross_cut_faculty where title='".$_POST['post_name']."'");
    $post_row=pg_fetch_assoc($post_query);
    $post_insert="INSERT INTO post_rank VALUES (100+".$post_row['ccf_id'].",'".$post_row['title']."')";
    $post_result=pg_query($db_connection,$post_insert);

    if(!$result&!$post_result){
        echo "Error";
    }
    else {
        echo "Success";

    } 
    // header('Location: ./insert_dept_db.php');
?>

  