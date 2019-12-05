<?php 

    require("../config/db_connect.php");
    require("admin_session.php");


    $fname_error="";
    $lname_error="";
    $email_error="";
    $phone_error="";
    $jobType_error="";
    $startDate_error="";
    $wage_error="";
    
    $street_error="";
    $houseNum_error="";
    $city_error="";
    $postal_error="";

    $vac_error="";


    $adm_error="";
    $adm_title="";


    //Check GET request ID parameter
    if(isset($_GET["id"])){
        $id = mysqli_real_escape_string($connection , $_GET["id"]);

        $sql =  "SELECT * FROM employee WHERE Employee_ID = '$id'";

        $res = getQueryResults($sql);

        $sql = "SELECT total FROM vacation_days WHERE Employee_ID='$id'";
        $vac_days_toal = getQueryResults($sql)[0]["total"];


        $deal_with_adm_error=false;
        $sql= "SELECT * FROM admin WHERE Employee_ID='$id'";
        $admins = getQueryResults($sql);
        if(sizeof($admins)!=0){
            $adm_title=$admins[0]["position_title"];
            $deal_with_adm_error=true;
        }
        
        

        if(isset($_POST["submit"])){
        
            $emp_id = $res[0]["Employee_ID"];
            $emp_fn = mysqli_real_escape_string($connection,$_POST["fname"]);
            $emp_ln = mysqli_real_escape_string($connection, $_POST["lname"]);
            $emp_phone = mysqli_real_escape_string($connection, $_POST["phone"]);
            $emp_jobtype = mysqli_real_escape_string($connection, $_POST["jobType"]);
            $emp_startdate = mysqli_real_escape_string($connection, $_POST["startDate"]);
            $emp_wage = mysqli_real_escape_string($connection, $_POST["wage"]);
            $emp_email = mysqli_real_escape_string($connection, $_POST["email"]);

            $emp_street= mysqli_real_escape_string($connection, $_POST["street"]);
            $emp_house = mysqli_real_escape_string($connection, $_POST["house_num"]);
            $emp_city= mysqli_real_escape_string($connection, $_POST["city"]);
            $emp_postal= mysqli_real_escape_string($connection, $_POST["postal"]);



            $emp_vac=mysqli_real_escape_string($connection, $_POST["vac"]);

            $emp_title = mysqli_real_escape_string($connection, $_POST["adm_title"]);

            $isValid = true;

            if($_POST["position"]=="adm"){
                $deal_with_adm_error=true;
            }
            
            if(empty($_POST["fname"])){
                $fname_error="This field cannot be empty";
                $isValid=false;
            }
            else{
                $fname = $_POST["fname"];
                if(!preg_match('/^[a-z,A-Z,\s]*$/', $_POST["fname"])){
                    $fname_error="This field must contain only letters";
                    $isValid=false;
                }
            }
            if(empty($_POST["lname"])){
                $lname_error="This field cannot be empty";
                $isValid=false;
            }
            else{
                $lname = $_POST["lname"];
                if(!preg_match('/^[a-z,A-Z,\s]*$/', $_POST["lname"])){
                    $lname_error="This field must contain only letters";
                    $isValid=false;
                }
    
            }
    
            if(empty($_POST["phone"])){
                $phone_error="This field cannot be empty";
                $isValid=false;
            }
            else{
                $phone = $_POST["phone"];
                if(!preg_match("/^[0-9]*$/", $_POST["phone"])){
                    $phone_error="Please provide a valid phone number";
                    $isValid=false;
                }
            }
    
            if(empty($_POST["jobType"])){
                $jobType_error="This field cannot be empty";
                $isValid=false;
            }
            else{
                $job_type = $_POST["jobType"];
                if(!preg_match('/^[a-z,A-Z,\s]*$/', $_POST["jobType"])){
                    $jobType_error="This field must contain only letters";
                    $isValid=false;
                }
            }

            if(empty($_POST["wage"])){
                $phone_error="This field cannot be empty";
                $isValid=false;
            }
            else{
                $wage = $_POST["wage"];
                if(!preg_match("/^[0-9]*$/", $_POST["phone"])){
                    $phone_error="Please provide a valid wage";
                    $isValid=false;
                }
            }
    
            if(empty($_POST["email"])){
                $email_error="This field cannot be empty";
                $isValid=false;
            }
            else{
                $email = $_POST["email"];
                if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                    $email_error="Email is not in the correct form!";
                    $isValid=false;
                }
                
            }
            if(empty($_POST["startDate"])){
                $startDate_error="This field cannot be empty";
                $isValid=false;
            }
            else{
                $start_date = $_POST["startDate"];
            }
    
            if(empty($_POST["street"])){
                $street_error ="This field cannot be empty";
                $isValid=false;
            }
            else{
                $street = $_POST["street"];
            }
            
            if(empty($_POST["house_num"])){
                $houseNum_error ="This field cannot be empty";
                $isValid=false;
            }
            else{
                $house_num = $_POST["house_num"];
                if(!preg_match("/^[0-9]*$/", $_POST["house_num"])){
                    $houseNum_error="Please provide a valid house number";
                    $isValid=false;
                }
            }
    
            if(empty($_POST["city"])){
                $city_error ="This field cannot be empty";
                $isValid=false;
            }
            else{
                $city = $_POST["city"];
                if(!preg_match('/^[a-z,A-Z,\s]*$/', $_POST["city"])){
                    $city_error="This field must contain only letters";
                    $isValid=false;
                }
            }
    
            if(empty($_POST["postal"])){
                $postal_error ="This field cannot be empty";
                $isValid=false;
            }
            else{
                $postal = $_POST["postal"];
                if(!preg_match("/^[a-z,A-Z][0-9][a-z,A-Z][0-9][a-z,A-Z][0-9]$/", $_POST["postal"])){
                    $postal_error="Please provide a valid postal number";
                    $isValid=false;
                }
            }


            if(empty($_POST["vac"])){
                $vac_error ="This field cannot be empty";
                $isValid=false;
            }
            else{
                if(!preg_match("/^[0-9]*$/", $_POST["vac"])){
                    $vac_error="Please provide a valid number of vacation days";
                    $isValid=false;
                }
            }


            if(empty($_POST["adm_title"]) && $deal_with_adm_error){
                $adm_error ="This field cannot be empty";
                $adm_title="";
                $isValid=false;
            }

            if($isValid){


                //Update basic attributes
                $sql = "UPDATE employee SET 
                        FName = '$emp_fn',
                        LName = '$emp_ln',
                        phone_number = '$emp_phone',
                        job_type = '$emp_jobtype',
                        start_date = '$emp_startdate',
                        hourly_wage = '$emp_wage',
                        email = '$emp_email',
                        adr_street ='$emp_street',
                        adr_housenumber = '$emp_house',
                        adr_city = '$emp_city',
                        adr_postalcode = '$emp_postal'

                        WHERE Employee_ID = '$id'
                    ";

                execQuery($sql);

                //Update vacation days
                $sql = "UPDATE vacation_days SET total='$emp_vac' WHERE Employee_ID = '$id'";
                execQuery($sql);

                if($_POST["position"]=="emp"){
                    //Check if we are "demoting the user"
                    $sql = "SELECT * FROM admin where Employee_ID='$id'";
                    if( sizeof(getQueryResults($sql))!=0 ){
                        $sql = "DELETE  FROM admin WHERE Employee_ID='$id'";
                        execQuery($sql);
                    }
                }

                elseif($_POST["position"]=="adm"){
                    //Check if we are "promoting the user"
                    $sql = "SELECT * FROM admin where Employee_ID='$id'";
                    if( sizeof(getQueryResults($sql))==0 ){
                        $sql = "INSERT INTO admin  VALUES ('$id', '$emp_title')"; //NEED TO CHANGE THE ADMIN TITLE
                        execQuery($sql);
                    }
                    else{
                        $sql="UPDATE admin SET position_title='$emp_title' WHERE Employee_ID='$id'";
                        execQuery($sql);
                    }

                    $adm_title=$emp_title;

                }

            }
        }

        else{
            $emp_id = $res[0]["Employee_ID"];
            $emp_fn = $res[0]["FName"];
            $emp_ln = $res[0]["LName"];
            $emp_phone = $res[0]["phone_number"];
            $emp_jobtype = $res[0]["job_type"];
            $emp_startdate = $res[0]["start_date"];
            $emp_wage = $res[0]["hourly_wage"];
            $emp_email = $res[0]["email"];

            $emp_house = $res[0]["adr_housenumber"];
            $emp_street= $res[0]["adr_street"];
            $emp_city= $res[0]["adr_city"];
            $emp_postal= $res[0]["adr_postalcode"];

            $emp_vac=$vac_days_toal;

        }

    $sql = "SELECT * FROM admin WHERE Employee_ID = '$id'";

    if( sizeof(getQueryResults($sql))!=0 ){
        $isAdmin = true;
    }
    else{
        $isAdmin=false;
    }


       
    }

    

?>

<html>
<?php include ("logged_admin_header.php"); ?>



    <?php if($res): ?>

        <form class ="white" action="admin_emp_details.php?id=<?php echo $id?>" method="POST"> 

            <label> First Name: </label>
            <input type="text" name="fname" value='<?php echo $emp_fn;?>'>
            <div class="red-text"> <?php echo $fname_error;?></div>
            
            <label > Last Name: </label>
            <input type="text" name="lname" value='<?php echo $emp_ln;?>'>
            <div class="red-text"> <?php echo $lname_error;?></div>

            <label > Phone Number: </label>
            <input type="text" name="phone" value=<?php echo $emp_phone;?>>
            <div class="red-text"> <?php echo $phone_error;?></div>

            <label > Email: </label>
            <input type="text" name="email" value=<?php echo $emp_email;?>>
            <div class="red-text"> <?php echo $email_error;?></div>

            <label > Job Type: </label>
            <input type="text" name="jobType" value='<?php echo $emp_jobtype;?>'>
            <div class="red-text"> <?php echo $jobType_error;?></div>

            <label > Hourly Wage: </label>
            <input type="text" name="wage" value=<?php echo $emp_wage;?>>
            <div class="red-text"> <?php echo $wage_error;?></div>

            <label > Start date: </label>
            <input type="text" name= "startDate" class="datepicker" value=<?php echo $emp_startdate;?>>
            <div class="red-text"> <?php echo $startDate_error;?></div>

            <label > House number: </label>
            <input type="text" name="house_num" value=<?php echo $emp_house;?>>
            <div class="red-text"> <?php echo $houseNum_error;?></div>

            <label > Street Address: </label>
            <input type="text" name="street" value='<?php echo $emp_street;?>'>
            <div class="red-text"> <?php echo $street_error;?></div>

            <label > City: </label>
            <input type="text" name="city" value='<?php echo $emp_city;?>'>
            <div class="red-text"> <?php echo $city_error;?></div>

            <label > Postal Code: </label>
            <input type="text" name="postal" value=<?php echo $emp_postal;?>>
            <div class="red-text"> <?php echo $postal_error;?></div>

            <label > Vacation days: </label>
            <input type="text" name="vac" value=<?php echo $emp_vac;?>>
            <div class="red-text"> <?php echo $vac_error;?></div>

            <label>Select position: </label>
            <select class="browser-default" name="position">
                <option value="emp" <?php if(!$isAdmin){ echo ("selected"); }?>>Employee </option>
                <option value="adm" <?php if($isAdmin){ echo ("selected"); }?>>Admin </option>
            </select>

            <label > Admin title (ONLY IF ADMIN IS SELECTED): </label>
            <input type="text" name="adm_title" value='<?php echo $adm_title;?>'>
            <div class="red-text"> <?php echo $adm_error;?></div>

            <div class="center">
                <input type="submit" name = "submit" value="submit" class = "btn brand z-depth-0">
            </div>

        </form>

    <?php else: ?>

        <h5> No such person found!</h5>

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