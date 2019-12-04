<?php
require("../config/db_connect.php");
require("emp_session.php");

$startDate_error="";
$endDate_error="";

$startDate= "";
$endDate = "";

$currentDate = date('m-d-Y');
echo $currentDate;


    if(isset($_POST["Create Request"])){
    
        $startDate = mysqli_real_escape_string($connection, $_POST["startDate"]);
        $endDate = mysqli_real_escape_string($connection, $_POST["endDate"]);
        $isValid = true;

        if(empty($_POST["startDate"])){
            $startDate_error="This field cannot be empty";
            $isValid=false;
        }
        else{
            $startDate = $_POST["startDate"];
        }
        
        if(empty($_POST["endDate"])){
            $endDate_error="This field cannot be empty";
            $isValid=false;
        }
        else{
            $endDate = $_POST["endDate"];
        }

        if($isValid){
            echo "INPUT IS VALID";
            //Insert basic attributes
            $sql = "INSERT INTO `vacation` (`Employee_ID`, `start_date`, `end_date`, `date_requested`, `approved_flag`)
             VALUES ('$this_user_id', '$startDate', '$endDate', '$currentDate', '-1')";
            execQuery($sql);
        }
    }


?>
<html>

    <?php include ("logged_emp_header.php");  ?>
    
    <section class= "container grey-text">
        <h4 class="center"> Create Appointment </h4>

        <form class ="white" action="make_vacation.php?id=<?php echo $id?>" method="POST"> 

            <label > Start date: </label>
            <input type="text" name= "startDate" class="datepicker" value=<?php echo $startDate;?>>
            <div class="red-text"> <?php echo $startDate_error;?></div>

            <label > End date: </label>
            <input type="text" name= "startDate" class="datepicker1" value=<?php echo $endDate;?>>
            <div class="red-text"> <?php echo $endDate_error;?></div>

            <div class ="center">
                <input type="submit" name ="Create Request" value="Create Request" class = "btn brand z-depth-0">
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