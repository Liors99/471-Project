<?php 

    require("../config/db_connect.php");
    require("admin_session.php");

    $sql = "SELECT * FROM performance_review";
    $reviews = getQueryResults($sql);

    function getEmpName($id){
        $sql = "SELECT FName, LName FROM employee WHERE Employee_ID = '$id'";
        $res= getQueryResults($sql);
        
        $fname = $res[0]["FName"];
        $lname = $res[0]["LName"];

        return $fname . " " . $lname;
    }

?>

<html>
    <?php include ("logged_admin_header.php"); ?>
    
    <table class="centered" id="hover_table">

        <thead>
            <tr>
                <th> Employee</th>	<!-- These Are the Headers -->
                <th> Date</th>
                <th> Supervisor </th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($reviews as $review): 
                            
                    $emp_name = getEmpName($review["Employee_ID"]);
                    $sup_name = getEmpName($review["supervisor_ID"]);
                    $date = $review["date"];
    
                ?>
                <tr>
                    <td> <?php echo $emp_name?> </td>
                    <td> <?php echo $date?>  </td>
                    <td> <?php echo $sup_name?>  </td>
    
                </tr>
            <?php endforeach?>
        
        
        </tbody>
       

       

    </table>
    <?php include ("../templates/footer.php") ; ?>
</html>