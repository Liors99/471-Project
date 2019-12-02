<?php
    require("../config/db_connect.php");
    require("admin_session.php");
    
    include ("logged_admin_header.php"); 
    $props=["id" => "", "FName" => "", "LName" => "", "phone_number" => "", "job_type" => "", "start_date" => "", "hourly_wage" => "", "email" => "", "adr_street" => "", "adr_streetnumber" => "", "password" => ""];

?>

<html>

      <script type="text/JavaScript">
        $(document).ready(function(){
        $('.datepicker').datepicker();
      });

      </script>

    <section class= "container grey-text">
        <h4 class="center"> Add a user </h4>
    <form class ="white" action="login.php" method="POST">
        <label > ID: </label>
            <input type="text" name="id" value=<?php echo $props["id"];?> >
            <div></div>

        <label > First Name: </label>
            <input type="text" name="id" value=<?php echo $props["FName"];?> >
        
        <label > Last Name: </label>
            <input type="text" name="id" value=<?php echo $props["LName"];?> >

        <label > Phone Number (optional): </label>
            <input type="text" name="id" value=<?php echo $props["LName"];?> >

        <label > Job Type: </label>
            <input type="text" name="id" value=<?php echo $props["LName"];?> >

        <label > Start Date: </label>
            <input type="text" class="datepicker">       

        </form>
    </section>


    <?php include('../templates/footer.php'); ?>
</html>