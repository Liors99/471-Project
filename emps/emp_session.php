<?php
    session_start();
    $user = $_SESSION["currentUser"]; 


    $sql = "SELECT Employee_ID FROM employee WHERE username = '$user'";
    $this_user_id = getQueryResults($sql)[0]["Employee_ID"];
    
?>