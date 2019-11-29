<?php   
    //Connect to database
    $connection = mysqli_connect("localhost","CPSC471","bestclassNA","471_schema");



    //Gets query results from the specified in query in an array format
    function getQueryResults($sql){

        global $connection;
        //get results
        $results = mysqli_query($connection, $sql);

        //fetch resulting rows as arrays
        $fethed_results = mysqli_fetch_all($results, MYSQLI_ASSOC);

        //Free result from memory
        mysqli_free_result($results);

        return $fethed_results;
    }

    //Check connection
    if(!$connection){
        echo "Connection error" . mysqli_connect_error();
    }
?>