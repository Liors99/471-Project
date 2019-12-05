<?php 

    include("templates/header.php"); 
    require("config/db_connect.php");

    //Make query
    $sql = "SELECT * FROM employee";

    //get results
    $results = mysqli_query($connection, $sql);

    //fetch resulting rows as arrays
    $emps = mysqli_fetch_all($results, MYSQLI_ASSOC);

    //print_r($emps);


    //Free result from memory
    mysqli_free_result($results);

    //Close connection to database
    mysqli_close($connection);

    


?>


<html>
<img src="circle_logo.png" alt="YNOTDIGITAL_LOGO"/>

<style>
img {
  padding: 100px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>

<?php  
    include("templates/footer.php");
?>

</body>
</html>