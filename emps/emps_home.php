<?php 
    require("../config/db_connect.php");
    require("emp_session.php");
?>

<html>
 <?php 
    include ("logged_emp_header.php"); 
    
 ?>
<div class="buttonMenu">
<div class="center">
    <div class="linkButtons"><a href="emps_appointments.php?id=<?php echo $this_user_id?>" width=130 class="waves-effect waves-light btn-large">View Appointments</a></div>
</div>

<div class="center">
    <div class="linkButtons"><a href="emps_vacations.php?id=<?php echo $this_user_id?>" width=130 class="waves-effect waves-light btn-large">View Vacations</a></div>
</div>

<div class="center">
    <div class="linkButtons"><a href="emp_view_performance.php" width=130 class="waves-effect waves-light btn-large">View Performance Reviews</a></div>
</div>

<div class="center">
    <div class="linkButtons"><a href="make_appointment.php?id=<?php echo $this_user_id?>" width=130 class="waves-effect waves-light btn-large">Create Appointment</a></div>
</div>

<div class="center">
    <div class="linkButtons"><a href="make_vacation.php?id=<?php echo $this_user_id?> " width=130 class="waves-effect waves-light btn-large">Create Vacation</a></div>
</div>

</div>
<?php include ("../templates/footer.php") ; ?>
</html>
