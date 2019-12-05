
<html>
 <?php 
    require("../config/db_connect.php");
    require("emp_session.php");
    include ("logged_emp_header.php");
    
    
     //Make query
     $sql = "SELECT appt_date, start_time, end_time, date_requested, approved_flag FROM appointment"; // WHERE Employee_ID = session.getAttribute?username " ; //MIND THE SINGLE QUOUTE

     //get results
     $results = getQueryResults($sql);
    
 ?>

<table class="centered">
    <thead>
    <tr>
		<th>Type </th>	<!-- These Are the Headers -->
		<th>Appointment Date</th>
		<th>Apointment time</th>
        <th>End Time</th>
        <th>Date Submitted</th>
		<th>Approval</th>
	</tr>
    </thead>

    <tbody>
    <?php  foreach($results as $result):
                $aDate = ($result["appt_date"]);
                $sTime = ($result["start_time"]);
                $eTime = ($result["end_time"]);
                $rDate = ($result["date_requested"]);

                $approved="";
                if($result["approved_flag"]==0){
                    $approved = "DENIED";
                }
                elseif($result["approved_flag"]==1){
                    $approved = "APPROVED";
                }
                else{
                    $approved = "NOT YET REVIEWED";
                }

                
        ?>
            <tr>
                <td>Appointment</td>
                <td> <?php echo $aDate?></td>
                <td> <?php echo $sTime?></td>
                <td> <?php echo $eTime?></td>
                <td> <?php echo $rDate?></td>
                <td> <?php echo $approved?></td>
            </tr>
        <?php endforeach ?>
    
    
    </tbody>
	
        
	</table>

<?php include ("../templates/footer.php") ; ?>
</html>