<?php
    include ("index.php");

    $count=0;
    for($index=1;$index<=5;$index++){
        if($_POST['node'.$index]!=''){
            $count++;
        }
        else{
            break;
        }
    }
    for($index=$count+1;$index<=5;$index++){
        $_POST['node'.$index]='NULL';
    }


    $route_query="INSERT INTO leave_routes (num_nodes,node1_rankid,node2_rankid,node3_rankid,node4_rankid,node5_rankid) VALUES (".$count.",".$_POST['node1'].",".$_POST['node2'].",".$_POST['node5'].",".$_POST['node4'].",".$_POST['node5'].")";
    

    $result=pg_query($db_connection,$route_query);

    if(!$result){
        echo "Error".$count;
    }
    else {
        echo "Success".$count;

    } 
    // header('Location: ./insert_dept_db.php');
?>