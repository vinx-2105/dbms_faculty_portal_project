<?php
    session_start();

    include('./index.php');
    include('./functions.php');

    $transaction_id = $_POST['transaction_id'];
    $remarks = $_POST['remarks'];

    $transaction = get_leave_trans_by_id($db_connection, $transaction_id);

    $leave = get_leave_by_id($db_connection, $transaction['leave_id']);

    $faculty_id = $leave['faculty_id'];

    $route_id = $transaction['route_id'];
    $route = get_route_by_id($db_connection, $route_id);

    $route_num_nodes = $route[0];

    $q = pg_query($db_connection, "UPDATE leave_history SET status='sent for review' WHERE transaction_id=".$transaction_id);

    $approval_faculty=get_faculty_by_post($db_connection,$transaction['start_post_id'])['faculty_id'];

    $insert_q1 = "INSERT INTO leave_history(leave_id, route_id, curr_node, start_post_id, end_post_id,approval_faculty, status, remarks, transaction_time) ";
    $insert_q2 = "VALUES(".$transaction['leave_id'].",".$transaction['route_id'].",".$transaction['curr_node'].",".$transaction['end_post_id'].",".$transaction['start_post_id'].",'".$approval_faculty."','pending', '".$_POST['remarks']."', now())";

    $q = pg_query($db_connection, $insert_q1.$insert_q2);

    Header('Location: ./my_leave_history.php');

?>