<?php 
    require("../config/db_connect.php");
    require("admin_session.php");

?>

<html>
 <?php include ("logged_admin_header.php"); ?>
<div class="buttonMenu">
 <div class="center">
    <div class="linkButtons"> <a href="admin_add_user.php" class="waves-effect waves-light btn-large">Add users</a></div>
</div>

<div class="center">
    <div class="linkButtons"> <a href="admin_add_performance.php" class="waves-effect waves-light btn-large">Add a performance review</a></div>
</div>

<div class="center">
    <div class="linkButtons"> <a href="admin_view_req.php" class="waves-effect waves-light btn-large">View Requests</a></div>
</div>


<div class="center">
    <div class="linkButtons"> <a href="admin_view_emps.php" class="waves-effect waves-light btn-large">View All Employees</a></div>
</div>


<div class="center">
    <div class="linkButtons"> <a href="admin_view_performance.php" class="waves-effect waves-light btn-large">View performance reviews</a></div>
</div>
</div>

<?php include ("../templates/footer.php") ; ?>
</html>