<?php
    include ("index.php");

    $dept_insert_query="DELETE FROM department WHERE dept_id=".$_POST[dlt_dept_id];
    $result=pg_query($db_connection,$dept_insert_query);
    if(!$result){
        echo "Error<br>";
        echo "Delete faculty related to this departement first.";
    }
    else {
        echo "Success";
    }
    $_POST[dlt_dept_id]=NULL;
    // header('Location: ./insert_dept_db.php');
?>

  