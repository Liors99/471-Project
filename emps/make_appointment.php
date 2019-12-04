<?php
require("../config/db_connect.php");
require("emp_session.php");


$apptDate_error="";
$startTime_error="";
$endTime_error="";
$apptDate= "";
$startTime = "";
$endTime = "";

$currentDate = date('Y-m-d');
echo $currentDate;

    if(isset($_POST["submit"])){
    
        $apptDate = mysqli_real_escape_string($connection, $_POST["startDate"]);
        $startTime = mysqli_real_escape_string($connection, $_POST["startTime"]);
        $endTime = mysqli_real_escape_string($connection, $_POST["endTime"]);
        $isValid = true;

        if(empty($_POST["startDate"])){
            $apptDate_error="This field cannot be empty";
            $isValid=false;
        }
        else{
            $apptDate = $_POST["startDate"];
        }
        
        if(empty($_POST["startTime"])){
            $startTime_error="This field cannot be empty";
            $isValid=false;
        }
        else{
            $startTime = $_POST["startTime"];
        
        }if(empty($_POST["endTime"])){
            $endTime_error="This field cannot be empty";
            $isValid=false;
        }
        else{
            $endTime = $_POST["endTime"];
        }

        if($isValid){
            //Insert basic attributes
            $sql = "INSERT INTO `appointment` (`Employee_ID`, `appt_date`, `start_time`, `end_time`, `date_requested`, `approved_flag`)
            VALUES ('$this_user_id', '$apptDate', '$startTime', '$endTime', '$currentDate', '-1')";
            execQuery($sql);


            //Insert into request
            $sql = "INSERT INTO 'request' ('Employee_ID', 'type', 'start_time', 'end_time', 'date_submitted', 'start_date', 'end_date', 'approved_id')
                VALUES('$this_user_id','apt','$startTime','$endTime','$currentDate', '$apptDate','$apptDate', 'NULL')";
            
            execQuery($sql);
        }
    }


?>
<html>

    <?php include ("logged_emp_header.php");  ?>
    
    <section class= "container grey-text">
        <h4 class="center"> Create Appointment </h4>

        <form class ="white" action="make_appointment.php" method="POST"> 

            <label > Appointment date: </label>
            <input type="text" name= "startDate" class="datepicker" value=<?php echo $apptDate;?>>
            <div class="red-text"> <?php echo $apptDate_error;?></div>

            <label > Start Time: </label>
            <input type="text" name= "startTime" class="timepicker" value=<?php echo $startTime;?>>
            <div class="red-text"> <?php echo $startTime_error;?></div>

            <label > End Time: </label>
            <input type="text" name= "endTime" class="timepicker1" value=<?php echo $endTime;?>>
            <div class="red-text"> <?php echo $endTime_error;?></div>

            <div class ="center"> 
                <input type="submit" value="submit" name="submit" class = "btn brand z-depth-0"> 
            </div>
        </form>
    </section>


      <!-- Script for calendar view -->
 
    <script>
        const Calendar = document.querySelector('.datepicker');
            M.Datepicker.init(Calendar, {
                format: 'yyyy-mm-dd'

            });
    </script>
    <script>
         Clock = document.querySelector('.timepicker');
            M.Timepicker.init(Clock, {twelveHour: false
            });
    
    </script>
    <!-  They need to be seperate to allow for multiple pickers ->
    <script>
         Clock = document.querySelector('.timepicker1');
            M.Timepicker.init(Clock, {twelveHour: false
            });
    </script>
 

    <?php include('../templates/footer.php'); ?>
</html>