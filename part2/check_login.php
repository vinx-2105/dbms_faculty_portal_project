<?php
    session_start();

    include('./index.php');

    $login_q = pg_query($db_connection,"SELECT * FROM faculty WHERE faculty_id='".$_POST['uname']."' AND password='".$_POST['psw']."'");

    if(pg_num_rows($login_q)==1){
        $_SESSION["loggedin"]=true;
        $_SESSION["username"]=$_POST['uname'];

        $faculty_q = pg_query($db_connection,"SELECT * FROM faculty WHERE faculty_id='".$_SESSION['username']."'");

        $faculty_r = pg_fetch_assoc($faculty_q);

        $special_post = $faculty_r['post_rank'];

        $post_id = $faculty_r['post_rank'];

        if($post_id==-1){
            //check if faculty is retired
            header('Location: ./login.php');
        }

        if($special_post>10 && $special_post<100){
            $special_post=10;
        }

        $special_post_q = pg_query($db_connection, "SELECT * FROM post_rank WHERE rank_id='".$special_post."'");
        $special_post_r = pg_fetch_assoc($special_post_q);
        $rank_title = $special_post_r['rank_title'];


        $_SESSION['rank_title'] = $rank_title;
        $_SESSION['special_post'] = $special_post;
        $_SESSION['post_id'] = $post_id;

        header("Location: ./dashboard.php");
    }
    else{
        $_SESSION["loggedin"]=false;
        $_SESSION["username"]=NULL;
        // $_SESSION["num_nodes"]=NULL;
        header("Location: ./login.php");
    }
?>