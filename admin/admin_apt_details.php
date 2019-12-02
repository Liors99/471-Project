<?php 

    require("../config/db_connect.php");
    require("admin_session.php");

    //Check GET request ID parameter
    if(isset($_GET["id"])){
        $id = mysqli_real_escape_string($connection , $_GET["id"]);

        if(!empty($_POST["approve"])){

            $sql = "UPDATE appointment SET approved_flag = 1  WHERE Employee_ID = '$id' ";
            execQuery($sql);

            
            $sql = "UPDATE request SET approved_id = '$this_user_id' WHERE Employee_ID = '$id'";
            execQuery($sql);
        }
        elseif(!empty($_POST["deny"])){
            $sql = "UPDATE appointment SET approved_flag = 0  WHERE Employee_ID = '$id' ";
            execQuery($sql);

            $sql = "UPDATE request SET approved_id = '$this_user_id' WHERE Employee_ID = '$id'";
            execQuery($sql);
        }

        $sql =  "SELECT * FROM appointment WHERE Employee_ID = '$id'";

        $res = getQueryResults($sql);

        if($res){
            $emp_id = $res[0]["Employee_ID"];

            $sql = "SELECT FName, LName FROM employee WHERE Employee_ID= ' $emp_id' ";
    
            $person_req = getQueryResults($sql);
    
        }

       
    }

?>

<html>
<?php include ("logged_admin_header.php"); ?>


<div class="container center">

    <?php if($res): ?>

        <h4> Requesting person: <?php echo $person_req[0]["FName"] . " " . $person_req[0]["LName"]?></h4>
        <h4> Type: Appoitment </h4>
        <h4> Date: <?php echo $res[0]["appt_date"]?></h4>
        <h4> Start time: <?php echo $res[0]["start_time"]?></h4>
        <h4> End Time: <?php echo $res[0]["end_time"]?></h4>
        <h4> Date requested: <?php echo $res[0]["date_requested"]?></h4>

        <h4> Approved: <?php  
                if($res[0]["approved_flag"]){ echo "YES";}
                else{ echo "NO" ;}
                ?>
        
        
        </h4>


        <form class ="blue lighten-5" action="admin_apt_details.php?id=<?php echo $emp_id?> " method="POST">
            <div class="center">
                <input type="submit" name = "approve" value="approve" class = "btn green z-depth-0">
                <input type="submit" name = "deny" value="deny" class = "btn red z-depth-0">
            </div>
        </form>


    <?php else: ?>

        <h5> No such appoitment found!</h5>

    <?php endif?>
        
    



</div>


<?php include ("../templates/footer.php") ; ?>
</html>