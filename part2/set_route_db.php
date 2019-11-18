<?php
    include ("index.php");

    //traverse posts, if the set route is not null then update ther route in the faculty
    $posts_q=pg_query($db_connection,"SELECT * from post_rank");
    if(!$posts_q){
        echo "Error";
    }
    else{
        while($posts_r=pg_fetch_assoc($posts_q)){
            $index='post_'.$posts_r['rank_id'];
            if($_POST[$index]!=''){
                $update_q=pg_query($db_connection,"UPDATE post_rank SET leave_route_id='".$_POST[$index]."' WHERE rank_id='".$posts_r['rank_id']."'");
                if(!$update_q){
                    echo "Error";
                }
            }
        }
    }
    // header('Location: ./insert_dept_db.php');
?>

  