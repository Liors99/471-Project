<?php
require("../config/db_connect.php");
$props=["Appointment date" => "", "Start Time" => "", "End Time" => ""];
?>
<html>

      <script type="text/JavaScript">
        $(document).ready(function(){
        $('.datepicker').datepicker();
      });

      </script>


    <?php include ("logged_emp_header.php");  ?>
    <section class= "container grey-text">
        <h4 class="center"> Create Appointment </h4>
    <form class ="white" action="login.php" method="POST">

        <label > Appointment Date: </label>
            <input type="text" class="datepicker">

        <label > Start Time: </label>
            <input type="text" name="id" value=<?php echo $props["Start Time"];?> >
        
        <label > End Time: </label>
            <input type="text" name="id" value=<?php echo $props["End Time"];?> >

        <div class ="center"> <input type="submit" value="Create Request" class = "btn brand z-depth-0"> </div>
        <!- An employee ID, date_requested, and approved flag are also need to make the sql insert ->
        <br>
        </form>
    </section>


    <?php include('../templates/footer.php'); ?>
</html>