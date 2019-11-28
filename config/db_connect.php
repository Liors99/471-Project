<?php   
    //Connect to database
    $connection = mysqli_connect("localhost","CPSC471","bestclassNA","471_schema");

    //Check connection
    if(!$connection){
        echo "Connection error" . mysqli_connect_error();
    }
?>