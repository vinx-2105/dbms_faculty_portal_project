<?php
    session_start();
    $allowed = false;
    if($_SESSION['admin']==true){
        $allowed = true;
    }

    if($allowed=='false'){
        header("Location: ./error.php");
    }
?>

<a href="/insert_faculty.php">Insert Faculty</a><br>
<a href="/insert_dept.php">Insert Dept</a><br>
<a href="/insert_ccf.php">Insert CCF</a><br>
<a href="/delete_dept.php">Delete Dept</a><br>
<a href="/view.php">View</a><br>
<a href="/set_defaults.php">Set Defaults</a><br>
<a href="/create_route.php">Create Route</a><br>
<a href="/set_post.php">Set Posts</a><br>
<!-- <a href="/generate_leave.php">Generate Leave</a><br> -->
<a href="/set_route.php">Set Route</a><br>
<form>
<button formaction="admin_logout/.php">Admin Logout<button>
</form>



