
<html>
 <?php 
 require("../config/db_connect.php");
 include ("logged_emp_header.php"); 
 require("emp_session.php");
 
     //Make query
     $sql = "SELECT start_date, end_date, date_requested, approved_flag FROM vacation WHERE Employee_ID = $this_user_id";
     $results = getQueryResults($sql);
 
 ?>

<table class="centered">

    <thead>

        <tr>
            <th>Name</th>	<!-- These Are the Headers -->
            <th>Vacation Date</th>
            <th>End Date</th>
            <th>Date Submitted</th>
            <th>Approval</th>
        </tr>
    
    </thead>

    <tbody>
    
        <?php 
            
            foreach($results as $result) :
                //print_r($result);
                $aDate = ($result["start_date"]);
                $eDate = ($result["end_date"]);
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
                <td>Vacation</td>
                <td><?php echo $aDate?></td>
                <td><?php echo $eDate?></td>
                <td><?php echo $rDate?></td>
                <td><?php echo $approved?></td>
                </tr>
        
            <?php endforeach ?>
        
    </tbody>
	
       
            

       
	</table>

<?php include ("../templates/footer.php") ; ?>
</html>