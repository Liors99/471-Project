<?php
require("../config/db_connect.php");
require("emp_session.php");

$startDate_error="";
$endDate_error="";

$startDate= "";
$endDate = "";

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
                $res = getQueryResults($sql);

                $days_allowed = $res[0]["total"] - $res[0]["used"];

                echo $days_allowed;

                if($diff > $days_allowed){
                    echo "YOU HAVE USED ALL YOUR DAYS";
                    $isValid=false;
                }
                elseif($diff < 0){
                    echo "NOT VALID";
                    $isValid=false;
                }

            }
        }

        if($isValid){
            echo "INPUT IS VALID";
            //Insert basic attributes
            $sql = "INSERT INTO `vacation` (`Employee_ID`, `start_date`, `end_date`, `date_requested`, `approved_flag`)
             VALUES ('$this_user_id', '$startDate', '$endDate', '$currentDate', '-1')";
            execQuery($sql);

            $dummy_time = "00:00";

             //Insert into request
             $sql = "INSERT INTO `request` (`Employee_ID`, `req_num`, `type`, `start_time`, `end_time`, `date_submitted`, `start_date`, `end_date`, `approved_id`) 
            VALUES ('$this_user_id', NULL, 'vac', '$dummy_time', '$dummy_time', '$currentDate', '$startDate', '$endDate', NULL)";
            execQuery($sql);

            $sql="UPDATE vacation_days SET used='$diff' WHERE Employee_ID='$this_user_id'";
            execQuery($sql);
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