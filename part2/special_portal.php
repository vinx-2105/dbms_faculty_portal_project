<?php
    session_start();


    if($_SESSION['loggedin']==false){
        header("Location: ./login.php");
    }

    include('./index.php');

    $rank_title = $_SESSION['rank_title'];
    $special_post = $_SESSION['special_post'];
    $post_id = $_SESSION['post_id'];

    $faculty_q = pg_query($db_connection,"SELECT * FROM faculty WHERE faculty_id='".$_SESSION['username']."'");
    $faculty_r = pg_fetch_assoc($faculty_q);
    $department_id  = $faculty_r['dept_id'];

    $department_q = pg_query($db_connection, "SELECT * FROM department WHERE dept_id=".$department_id);
    $department_r = pg_fetch_assoc($department_q);
    $department_name = $department_r['name'];


    //list of transactions pending with this person
    $trans_pending_q = pg_query($db_connection, "SELECT * FROM leave_history WHERE end_post_id='".$post_id."' AND status='pending'");

    if(pg_num_rows($trans_pending_q)==0){
        echo "<div class='row'><div class='col-md-12'><br><h4>No Leaves Pending With Me</h4><br></div></div>";
    }

    $i=1;
    while($trans_pending_r = pg_fetch_assoc($trans_pending_q)){
        $this_leave_q = pg_query($db_connection, "SELECT * FROM leave WHERE leave_id=".$trans_pending_r['leave_id']);
        $this_leave_r = pg_fetch_assoc($this_leave_q);
        echo "<div class='row' style='border-style:solid; background-color:#d5d8dc;' ><div class='col-md-2'>";
        echo "<br><p>     # ".$i."</p></div>";
        echo "<div class='col-md-8'><h3>Pending With Me</h3><br>";
        echo "<p><small>Leave ID - ".$trans_pending_r['leave_id']."</small></p>";
        echo "<p><small>Faculty ID - ".$this_leave_r['faculty_id']."</small></p>";
        echo "<p><small>Start Date of Leave - ".$this_leave_r['start_date']."</small></p>";
        $effective_num_days = $this_leave_r['num_days']-1;
        echo "<p><small>End Date of Leave - ".date('Y-m-d', strtotime($this_leave_r['start_date'].'+'.$effective_num_days.'days'))."</small></p>";
        echo "<p><small>Purpose of Leave - ".$this_leave_r['leave_purpose']."</small></p>";
        echo "<p><small>Latest Remarks - ".$trans_pending_r['remarks']."</small></p>";
        // option 1 - accept
        echo "<form class='form-inline'  method='post'>";
        echo "<label for='remarks' style='margin-right:0.2em;'><small>Remarks</small></label>";
        echo "<input type='text' style='font-size:0.8em; width:50%; margin-right:0.4em;' placeholder='Enter Remarks' name='remarks' id='remarks' required>";
        echo "<input type='hidden' name='transaction_id' id='transaction_id' value='".$trans_pending_r['transaction_id']."'>";
        echo "<input type='submit'  style='margin-right:0.4em;' class='btn btn-sm btn-success' formaction='/accept_application.php' value='Accept'>";
        //option 2 - reject
        echo "<input type='submit' style='margin-right:0.4em;' class='btn btn-sm btn-danger' formaction='/reject_application.php' value='Reject'>";
        //option 3 - review
        echo "<input type='submit' style='margin-right:0.4em;' class='btn btn-sm btn-warning' formaction='/review_application.php' value='Send for Review'></form>";

        echo "</div><div class='col-md-2'></div></div>";
        $i++;
    }

    //show all the history of transactions by this hod
    //get the distinct leave ids of the transactions where this guy is involved

    $leave_ids_q = pg_query($db_connection, "SELECT distinct(leave_id) FROM leave_history WHERE start_post_id=".$post_id."OR end_post_id=".$post_id);

    echo "<div class='row'><div class='col-md-12'><h4><br>Past Leave Applications For Me</h4><br>";
    
    echo "<table class='table table-striped table-dark'><thead><tr><th scope='col'>Leave ID</th><th scope='col'>Faculty</th><th scope='col'>Status</th><th scope='col'>See Detail</th></tr></thead>";


    while($leave_ids_r=pg_fetch_assoc($leave_ids_q)){
        $leave_id = $leave_ids_r['leave_id'];

        //get the record of this leave from the leaves table
        $this_leave_q = pg_query($db_connection, "SELECT * FROM leave WHERE leave_id=".$leave_id);
        $this_leave_r = pg_fetch_assoc($this_leave_q);

        echo "<tr>";
        echo "<td>".$leave_id."</td>";

        echo "<td>".$this_leave_r['faculty_id']."</td>";

        echo "<td>".$this_leave_r['status']."</td>";

        echo "<td>";
        echo "<form class='form-inline' action='/leave_application_detail.php' method='get'>";
        echo "<input type='hidden' id='leave_id' name='leave_id' value='".$leave_id."'>";
        echo "<button type='submit'  class='btn btn-sm btn-danger'><small>See Detail</small></button></form></td>";
        echo "</tr>";
    }

    echo "</table></div></div>";

?>