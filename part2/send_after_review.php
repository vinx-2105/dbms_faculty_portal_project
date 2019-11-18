<?php
    session_start();

    include('./index.php');
    include('./functions.php');

    $transaction_id = $_POST['transaction_id'];
    $remarks = $_POST['remarks'];

    echo $transaction_id."\n";
    echo $remarks."\n";
    // $transaction = get_leave_trans_by_id($db_connection, $transaction_id);

    // $leave = get_leave_by_id($db_connection, $transaction['leave_id']);

    // $faculty_id = $leave['faculty_id'];

    // $route_id = $transaction['route_id'];
    // $route = get_route_by_id($db_connection, $route_id);

    // $route_num_nodes = $route[0];

?>