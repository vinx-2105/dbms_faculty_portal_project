<?php
    session_start();

    if($_SESSION['loggedin']==false){
        // echo $_SESSION['loggedin'];
        header("Location: ./login.php");
    }

    include('./index.php');

    $faculty_id = $_SESSION['username'];
    $my_leaves_q = pg_query($db_connection, "SELECT * FROM leave WHERE faculty_id='".$faculty_id."' ORDER BY(leave_id) DESC");
    

?>

<body>
    <table class="table table-striped table-dark">
    <thead>
        <tr>
        <th scope="col">Leave ID</th>
        <th scope="col">Filing Date</th>
        <th scope="col">Result Date</th>
        <th scope="col">Status</th><!--approve, rejected-->
        <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        <!-- <tr> -->
        <!-- <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td> -->
        <?php
            while($my_leaves_r = pg_fetch_assoc($my_leaves_q)){
                $this_leave_q = pg_query($db_connection, "SELECT * FROM leave_history WHERE faculty_id='".$faculty_id."' AND leave_id='".$my_leaves_r['leave_id']."' ORDER BY(transaction_time)");
                $i=0;
                $filing_date=NULL;
                $result_date=NULL;

                while($this_leave_r=pg_fetch_assoc($this_leave_q)){
                    if($i==0){
                        $filing_date = $this_leave_r['transactiontimestamp_time'];
                    }
                    if($my_leaves_r['status']!='pending'){
                        $result_date = $this_leave_r['transactiontimestamp_time'];
                    }
                }
                echo "<tr>";
                echo "<td>".$my_leaves_r['leave_id']."</td>";
                echo "<td>".$filing_date."</td>";
                if($result_date){
                    echo "<td>".$result_date."</td>";
                }
                else{
                    echo "<td>Pending</td>";
                }
                echo "<td>".$my_leaves_r['status']."</td>";

                echo "<form class='form-inline' action='/leave_application_detail.php' method='post'>";
                echo "<input type='hidden' id='leave_application_id' name='leave_application_id' value='".$my_leaves_r['leave_id']."'>";
                echo "<button type='submit'  class='btn btn-sm btn-danger'><small>See Detail</small></button></form>";
                echo "</tr>";
            }
        ?>

        </tr>
    </tbody>
    </table>
</body>