
<html>
 <?php 
 require("../config/db_connect.php");
 include ("logged_emp_header.php"); 
 require("emp_session.php");
 
 
 ?> ?>

<table>
	<tr>
		<th>Name</th>	<!-- These Are the Headers -->
		<th>Vacation Date</th>
		<th>End Date</th>
        <th>Date Submitted</th>
		<th>Approval</th>
	</tr>
        <?php 
        
            //Make query
            $sql = "SELECT start_date, end_date, date_requested, approved_flag FROM vacation"; // WHERE Employee_ID = session.getAttribute?username " ; //MIND THE SINGLE QUOUTE

            //get results
            $results = mysqli_query($connection, $sql);

            //fetch resulting rows as arrays
            //$emps = mysqli_fetch_all($results, MYSQLI_ASSOC);
            while($result = mysqli_fetch_assoc($results)) {
                //print_r($result);
                $aDate = ($result["start_date"]);
                $eDate = ($result["end_date"]);
                $rDate = ($result["date_requested"]);
                $approved = ($result["approved_flag"]);
                ?>
                <br/>
                <tr>
                <td>Name or ID</td>
			    <td><p><?php echo $aDate?></p?></td>
				<td><p><?php echo $eDate?></p?></td>
                <td><p><?php echo $rDate?></p?></td>
                <td><p><?php echo $approved?></p?></td>
				</tr>
           <?php } ?>

            

        <?php
            //Free result from memory
            mysqli_free_result($results);

            //Close connection to database
            mysqli_close($connection);
        
        ?>
	</table>

<?php include ("../templates/footer.php") ; ?>
</html>