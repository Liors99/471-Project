<?php 

    require("../config/db_connect.php");
    require("admin_session.php");

    //Check GET request ID parameter
    if(isset($_GET["id"])){
        $id = mysqli_real_escape_string($connection , $_GET["id"]);

        $sql =  "SELECT * FROM employee WHERE Employee_ID = '$id'";

        $res = getQueryResults($sql);

        $emp_id = $res[0]["Employee_ID"];
        $emp_fn = $res[0]["FName"];
        $emp_ln = $res[0]["LName"];
        $emp_phone = $res[0]["phone_number"];
        $emp_jobtype = $res[0]["job_type"];
        $emp_startdate = $res[0]["start_date"];
        $emp_wage = $res[0]["hourly_wage"];
        $emp_email = $res[0]["email"];

       
    }

    if(isset($_POST["submit"])){
        
    }

?>

<html>
<?php include ("logged_admin_header.php"); ?>



    <?php if($res): ?>

        <form class ="white" action="admin_emp_details.php" method="POST"> 
            <label > Fist Name: </label>
            <input type="text" name="fname" value=<?php echo $emp_fn;?> >

            <label > Last Name: </label>
            <input type="text" name="lname" value=<?php echo $emp_ln;?>>

            <label > Phone Number: </label>
            <input type="text" name="phone" value=<?php echo $emp_phone;?>>

            <label > Email: </label>
            <input type="text" name="lname" value=<?php echo $emp_email;?>>

            <label > Job Type: </label>
            <input type="text" name="lname" value=<?php echo $emp_jobtype;?>>

            <label > Hourly Wage: </label>
            <input type="text" name="lname" value=<?php echo $emp_wage;?>>

            <label > Start date: </label>
            <input type="text" id="date" class="datepicker" value=<?php echo $emp_startdate;?>>


            <div class="center">
                <input type="submit" name = "submit" value="submit" class = "btn brand z-depth-0">

            </div>

        </form>

    <?php else: ?>

        <h5> No such appoitment found!</h5>

    <?php endif?>

    <!-- Script for calendar view -->
    <script>
        const Calendar = document.querySelector('.datepicker');
            M.Datepicker.init(Calendar, {
                format: 'yyyy-mm-dd'

            });
    </script>

    <?php include ("../templates/footer.php") ; ?>
</html>