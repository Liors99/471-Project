<?php 

    require("../config/db_connect.php");
    require("admin_session.php");

    $sql = "SELECT * FROM Employee";
    $emps = getQueryResults($sql);


?>

<html>
    <?php include ("logged_admin_header.php"); ?>
    
    <table class="centered" id="hover_table">
        <tr>
            <th>Employee ID </th>	<!-- These Are the Headers -->
            <th> First Name</th>
            <th>Last Name </th>
        </tr>

        <?php foreach($emps as $emp): 
                            
            $output_string = "admin_emp_details.php?id=" . $emp["Employee_ID"];

            ?>
            <tr onclick="window.location='<?php echo $output_string;?>';">
                <td> <?php echo $emp["Employee_ID"]?> </td>
                <td> <?php echo $emp["FName"]?> </td>
                <td> <?php echo $emp["LName"]?> </td>

            </tr>
        <?php endforeach?>

    </table>
    <?php include ("../templates/footer.php") ; ?>
</html>