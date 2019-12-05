<?php
    session_start();
    $user = mysqli_real_escape_string($connection,$_SESSION["currentUser"]);


    

    if($user==NULL){
        http_response_code(403);
        die('Forbidden');
    }
    else{
        $sql = "SELECT Employee_ID FROM employee WHERE username = '$user'";
        $this_user_id = mysqli_real_escape_string($connection, getQueryResults($sql)[0]["Employee_ID"]);
    }
    
    
?>