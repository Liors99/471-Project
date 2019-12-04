<?php
    session_start();
    $user = $_SESSION["currentUser"]; 
    echo $user;


    $sql = "SELECT Employee_ID FROM employee WHERE username = '$user'";
    $this_user_id = getQueryResults($sql)[0]["Employee_ID"];

    echo $this_user_id;
    
?>