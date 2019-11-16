<?php
    include ("index.php");

    $defaults_q=pg_query($db_connection, "SELECT  * FROM defaults");
    if(!$defaults_q ){
        echo "defaults not found";
    }
    while ($row=pg_fetch_assoc($defaults_q)){
        $set_default_query="UPDATE defaults SET default_value='".(int)$_POST[$row['parameter']]."' where parameter='".$row['parameter']."'";
        // $set_default_query="update defaults set default_value=7 where parameter='leave_count';";

        echo $_POST[$row['parameter']]." ";
        echo $row['parameter']." ";
        $result_q=pg_query($db_connection,$set_default_query);
        if(!$result_q){
            echo "Error";
        }
        else {
            echo "Success";
        } 
    }
    // header('Location: ./insert_dept_db.php');
?>

  