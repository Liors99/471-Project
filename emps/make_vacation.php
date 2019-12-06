<?php
require("../config/db_connect.php");
require("emp_session.php");

$startDate_error="";
$endDate_error="";

$startDate= "";
$endDate = "";

$submit_error="";
$submit_confirm="";

$currentDate = date('Y-m-d');


    if(isset($_POST["submit"])){
    
        $startDate = mysqli_real_escape_string($connection, $_POST["startDate"]);
        $endDate = mysqli_real_escape_string($connection, $_POST["endDate"]);
        $isValid = true;

        if(empty($_POST["startDate"])){
            $startDate_error="This field cannot be empty";
            $isValid=false;
        }
        else{
            $startDate = $_POST["startDate"];
            $startDate_encoded = strtotime($startDate);
        }
        
        if(empty($_POST["endDate"])){
            $endDate_error="This field cannot be empty";
            $isValid=false;
        }
        else{
            $endDate = $_POST["endDate"];
            $endDate_encoded = strtotime($endDate);
            
            if($isValid){
                $diff = ($endDate_encoded- $startDate_encoded)/60/60/24;
                
                $sql = "SELECT total,used FROM vacation_days WHERE Employee_ID = '$this_user_id'";
                $vac_table = getQueryResults($sql);

                $days_allowed = $vac_table[0]["total"] - $vac_table[0]["used"];

                if(($diff + 1) > $days_allowed){
                    echo "<script type='text/javascript'>alert('Vacation time has exceeded your off days');</script>";
                    $submit_error = "VACATION TIME EXCEEDS YOUR OFF DAYS";
                    $isValid=false;
                }
                elseif($diff < 0){
                    echo "<script type='text/javascript'>alert('invalid days are selected');</script>";
                    $submit_error = "NOT VALID DAYS SELECTED";
                    $isValid=false;
                }

            }
        }


        //See if there is an overlap with vacation
        $sql = "SELECT * FROM vacation WHERE start_date = '$startDate' AND Employee_ID='$this_user_id'";
        $res=getQueryResults($sql);
        if(sizeof($res)!=0){
            $submit_error = "YOU ALREADY HAVE A VACATION STARTING AT THIS DATE";
            echo "<script type='text/javascript'>alert('You already have a vacation at this date');</script>";
            $isValid = false;
        }

        if($isValid){
            //Insert basic attributes
            $sql = "INSERT INTO `vacation` (`Employee_ID`, `start_date`, `end_date`, `date_requested`, `approved_flag`)
             VALUES ('$this_user_id', '$startDate', '$endDate', '$currentDate', '-1')";
            execQuery($sql);

            $dummy_time = "00:00";

             //Insert into request
             $sql = "INSERT INTO `request` (`Employee_ID`, `req_num`, `type`, `start_time`, `end_time`, `date_submitted`, `start_date`, `end_date`, `approved_id`) 
            VALUES ('$this_user_id', NULL, 'vac', '$dummy_time', '$dummy_time', '$currentDate', '$startDate', '$endDate', NULL)";
            execQuery($sql);

            $new_used= $vac_table[0]["used"] + $diff + 1;

            $sql="UPDATE vacation_days SET used='$new_used' WHERE Employee_ID='$this_user_id'";
            execQuery($sql);

            echo "<script type='text/javascript'>alert('Vacation request has been sent');</script>";
            $submit_confirm="VACATION REQUEST HAS BEEN SENT";
        }
    }


?>
<html>

    <?php include ("logged_emp_header.php");  ?>
    
    <section class= "container grey-text">
        <h4 class="center"> Create Vacation </h4>

        <form class ="white" action="make_vacation.php?id=<?php echo $this_user_id?>" method="POST"> 

            <label > Start date: </label>
            <input type="text" name= "startDate" class="datepicker" value=<?php echo $startDate;?>>
            <div class="red-text"> <?php echo $startDate_error;?></div>

            <label > End date: </label>
            <input type="text" name= "endDate" class="datepicker1" value=<?php echo $endDate;?>>
            <div class="red-text"> <?php echo $endDate_error;?></div>

            <div class ="center">
                <input type="submit" name ="submit" value="submit" class = "btn brand z-depth-0">
            </div>

            <!-- 
            <div class="red-text"> <?php //echo $submit_error;?></div>
            <div class="green-text"> <?php //echo $submit_confirm;?></div>
            -->
            
        </form>
    </section>


      <!-- Script for calendar view -->
    <script>
         Calendar = document.querySelector('.datepicker');
            M.Datepicker.init(Calendar, {
                format: 'yyyy-mm-dd'

            });
    </script>
     <script>
         Calendar = document.querySelector('.datepicker1');
            M.Datepicker.init(Calendar, {
                format: 'yyyy-mm-dd'
            });
    </script>

    <?php include('../templates/footer.php'); ?>
</html>