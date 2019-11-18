<?php
    function get_route_by_id($db_connection, $route_id){
        $q = pg_query($db_connection, "SELECT * FROM leave_routes WHERE route_id=".$route_id);
        $r = pg_fetch_assoc($q);
        
        $num_nodes = $r['num_nodes'];


        $node_1 = $r['node1_rankid'];
        $node_2 = $r['node2_rankid'];

        $node_3 = $r['node3_rankid'];
        $node_4 = $r['node4_rankid'];

        $node_5 = $r['node5_rankid'];

        return array($num_nodes, $node_1, $node_2, $node_3, $node_4, $node_5);
    }

    function get_faculty_by_id($db_connection, $faculty_id){
        $q = pg_query($db_connection, "SELECT * FROM faculty WHERE faculty_id=".$faculty_id);
        $r = pg_fetch_assoc($q);
        return $r;
    }

    function get_faculty_by_post($db_connection, $post_rank)
    {
        $q = pg_query($db_connection, "SELECT * FROM faculty WHERE post_rank=".$post_rank);
        $r = pg_fetch_assoc($q);
        return $r;
    }
    function get_leave_by_id($db_connection, $leave_id){
        $q = pg_query($db_connection, "SELECT * FROM leave WHERE leave_id=".$leave_id);
        $r = pg_fetch_assoc($q);
        return $r;
    }

    function get_leave_trans_by_id($db_connection, $trans_id){
        $q = pg_query($db_connection, "SELECT * FROM leave_history WHERE transaction_id=".$trans_id);
        $r = pg_fetch_assoc($q);
        return $r;
    }
?>