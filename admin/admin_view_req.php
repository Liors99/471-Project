<?php 

    require("../config/db_connect.php");
    require("admin_session.php");

    $sql = "SELECT * FROM request";
    $reqs = getQueryResults($sql);


?>

<html>
    <?php include ("logged_admin_header.php"); ?>
    
    <table class="centered" id="hover_table">
        <thead>
            <tr class="center">
                <th>Type </th>	<!-- These Are the Headers -->
                <th>Number</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Date Submitted</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>

        </thead>
        
        <tbody>
            <?php foreach($reqs as $req): 
                $type_file="";
                $output_string="#";
                if($req["type"] == "apt"){
                    $type_file = "admin_apt_details.php";
                }
                else{
                    $type_file = "admin_vac_details.php";
                }
                    
                $output_string = $type_file . "?id=" . $req["Employee_ID"];

                ?>
                <tr onclick="window.location='<?php echo $output_string;?>';">
                    <td> <?php echo $req["type"]?> </td>
                    <td> <?php echo $req["req_num"]?> </td>
                    <td> <?php echo $req["start_time"]?> </td>
                    <td> <?php echo $req["end_time"]?> </td>
                    <td> <?php echo $req["date_submitted"]?> </td>
                    <td> <?php echo $req["start_date"]?> </td>
                    <td> <?php echo $req["end_date"]?> </td>

                </tr>
            <?php endforeach?>
        
        
        </tbody>

        

    </table>
    <?php include ("../templates/footer.php") ; ?>
</html>