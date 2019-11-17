<?php
    session_start();

    //1. current status of the application
    //2. Do some action like give remarks if the application has been sent back..
    //only if application's current node is this person
    //3. Be able to withdraw an application
    //4. Be able to view the current status of the application
    //5. Display the history of this particular leave in tabular format

    if($_SESSION['loggedin']==false){
        header("Location: ./login.php");
    }

    include('./index.php');

    $faculty_id = $_SESSION['username'];
    $leave_id = $_POST['leave_application_id'];

    $transactions_q = pg_query($db_connection, "SELECT * FROM leave_history WHERE faculty_id='".$faculty_id."' AND leave_id='".$leave_id."' ORDER BY(transaction_time)");

    function get_faculty_name_from_id(string $faculty_id){
        $q = pg_query($db_connection, "SELECT * FROM faculty WHERE faculty_id='".$faculty_id."'");
        $r = pg_fetch_assoc($q);

        return $r['name'];
    }

    function get_post_from_faculty_id(string $faculty_id){
        $q = pg_query($db_connection, "SELECT * FROM faculty WHERE faculty_id='".$faculty_id."'");
        $r = pg_fetch_assoc($q);
        $post_rank = $r['post_rank'];
        // if()
        //TODO: complete this function
    }

?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <!-- //the head of the table -->
            <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">Origin Faculty</th>
                <th scope="col">Destination Faculty</th>
                <th scope="col">Date & Time</th>
                <th scope="col">Status</th>
                <th scope="col">Remarks</th>
                </tr>
            </thead>

            <?php
                while($transactions_r = pg_fetch_assoc($transactions_q)){
                    $origin_faculty_id = $transactions_r['start_faculty_id'];
                    $destination_faculty_id = $transactions_r['end_faculty_id'];
                    $dt = $transactions_r['transaction_time'];
                    $status = $transactions_r['status'];
                    $remarks = $transactions_r['remarks'];

                    
                }
            ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</body>