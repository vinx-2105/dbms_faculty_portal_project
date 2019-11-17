<?php
    session_start();


    if($_SESSION['loggedin']==false){
        header("Location: ./login.php");
    }

    include('./index.php');

    $rank_title = $_POST['rank_title'];
    $special_post = $_POST['special_post'];
    $post_id = $_POST['post_id'];

    $faculty_q = pg_query($db_connection,"SELECT * FROM faculty WHERE faculty_id='".$_SESSION['username']."'");
    $faculty_r = pg_fetch_assoc($faculty_q);
    $department_id  = $faculty_r['dept_id'];

    $department_q = pg_query($db_connection, "SELECT * FROM department WHERE dept_id=".$department_id);
    $department_r = pg_fetch_assoc($department_q);
    $department_name = $department_r['name'];

    //TODO: show all the history of transactions by this hod

    //list of transactions pending with this person
    $trans_pending_q = pg_query($db_connection, "SELECT * FROM leave_history WHERE end_post_id='".$post_id."' AND status='pending'");

    while($trans_pending_r = pg_fetch_assoc($trans_pending_q)){
        $this_leave_q = pg_query($db_connection, "SELECT * FROM leave WHERE leave_id=".$trans_pending_r['leave_id']);
        $this_leave_r = pg_fetch_assoc($this_leave_q);
        echo "<div class='row' style='border-style:solid; background-color:#d5d8dc;'><div class='col-md-2'></div>";
        echo "<div class='col-md-8>";
        echo "<p>Leave ID - ".$trans_pending_r['leave_id']."</p><br>";
        echo "<p>Faculty ID - ".$this_leave_r['faculty_id']."</p><br>";
        echo "<p>Start Date of Leave - ".$this_leave_r['start_date']."</p><br>";
        echo "<p>End Date of Leave - ".date('Y-m-d', strtotime($this_leave_r['start_date'].'+'.$this_leave_r['num_days'].'days'))."</p><br>";
        echo "<p>Purpose of Leave - ".$this_leave_r['leave_purpose']."</p><br>";
        echo "<p>Remarks - ".$trans_pending_r['remarks']."</p><br>";
        //option 1 - accept
        echo "<form class='form-inline'  method='post'>";
        echo "<label for='remarks'>Remarks</label>";
        echo "<input type='text' placeholder='Enter Remarks' name='remarks' id='remarks' required>";

        echo "<input type='submit'  class='btn btn-sm btn-success' formaction='/accept_application.php' value='Accept'>";
        //option 2 - reject
        // echo "<input type='hidden' id='leave_application_id' name='leave_application_id' value='".$my_leaves_r['leave_id']."'>";
        echo "<input type='submit'  class='btn btn-sm btn-danger' formaction='/reject_application.php' value='Reject'>";
        //option 3 - review
        // echo "<input type='hidden' id='leave_application_id' name='leave_application_id' value='".$my_leaves_r['leave_id']."'>";
        // echo "<button type='submit'  class='btn btn-sm btn-danger'><small>Send for Review</small></button></form>";
        echo "<input type='submit'  class='btn btn-sm btn-warning' formaction='/review_application.php' value='Send for Review'>";

        echo "</div><div class='col-md-2'></div></div>";
    }

?>