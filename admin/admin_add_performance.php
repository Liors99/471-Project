<?php
     require("../config/db_connect.php");
     require("admin_session.php");

    
    $sql = "SELECT * FROM employee";
    $emps = getQueryResults($sql);

    $date_error="";

    if(isset($_POST["submit"])){
        echo $_POST["other"];

        if(empty($_POST["date"])){
            $date_error="This field cannot be empty";
        }
        else{
            $selected_person_id = mysqli_real_escape_string($connection, $_POST["other"]);
            $selected_date = mysqli_real_escape_string($connection, $_POST["date"]);
            $sql = "INSERT INTO `performance_review` (`Employee_ID`, `date`, `supervisor_ID`) VALUES ('$selected_person_id', '$selected_date', '$this_user_id')";
            execQuery($sql);
        }
    }
?>

<html>
    <?php include ("logged_admin_header.php"); ?>

    <section class= "container grey-text">
        <h4 class="center"> Create Performance Review </h4>

        <form class ="white" action="admin_add_performance.php" method="POST"> 

            <label > Date: </label>
            <input type="text" name= "date" class="datepicker">
            <div class="red-text"> <?php echo $date_error;?></div>


            <label> Employee: </label>
            <select class="browser-default" name="other">
                <?php foreach($emps as $emp):?>
                    <option value='<?php echo $emp["Employee_ID"]?>'> <?php echo $emp["FName"] . " " . $emp["LName"] ?> </option>
                <?php endforeach?>
            </select>


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

    <?php include ("../templates/footer.php") ; ?>

    


</html>