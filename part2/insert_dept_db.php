<?php
    include ("index.php");

    $dept_insert_query="INSERT INTO department (name) VALUES ('".$_POST[dept_name]."')";
    $result=pg_query($db_connection,$dept_insert_query);
    if(!$result){
        echo "Error";
    }
    else {
        echo "Success";
    } 
    // header('Location: ./insert_dept_db.php');
?>

  