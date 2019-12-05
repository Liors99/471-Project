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
                <th> Status </th>
            </tr>

        </thead>
        
        <tbody>
            <?php foreach($reqs as $req): 
                $type_file="";
                $output_string="#";
                if($req["type"] == "apt"){
                    $type_file = "admin_apt_details.php";
                    $output_string = $type_file . "?id=" . $req["Employee_ID"] . "&startTime=" . $req["start_time"] . "&startDate=" . $req["start_date"];
                }
                else{
                    $type_file = "admin_vac_details.php";
                    $output_string = $type_file . "?id=" . $req["Employee_ID"] . "&startDate=" . $req["start_date"];
                }
                    
                

                ?>
                <tr onclick="window.location='<?php echo $output_string;?>';">
                    <td> <?php echo htmlspecialchars ($req["type"])?> </td>
                    <td> <?php echo htmlspecialchars ($req["req_num"])?> </td>
                    <td> <?php echo htmlspecialchars ($req["start_time"])?> </td>
                    <td> <?php echo htmlspecialchars ($req["end_time"])?> </td>
                    <td> <?php echo htmlspecialchars ($req["date_submitted"])?> </td>
                    <td> <?php echo htmlspecialchars ($req["start_date"])?> </td>
                    <td> <?php echo htmlspecialchars ($req["end_date"])?> </td>
                    <td> <?php if($req["approved_id"] == NULL){ echo "NOT REVIEWED";}
                                else{echo "REVIEWED";}?> </td>

                </tr>
            <?php endforeach?>
        
        
        </tbody>

        

    </table>
    <?php include ("../templates/footer.php") ; ?>
</html>