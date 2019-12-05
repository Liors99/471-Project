<?php 

    require("../config/db_connect.php");
    require("admin_session.php");

    $username_error="";
    $password_error="";
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

    $emp_user="";
    $emp_pass="";
    $emp_fn = "";
    $emp_ln = "";
    $emp_phone ="";
    $emp_jobtype =""; 
    $emp_startdate = "";
    $emp_wage = "";
    $emp_email = "";

    $emp_street= "";
    $emp_house = "";
    $emp_city= "" ;
    $emp_postal= "" ;

    $emp_vac="";

    $adm_title="";
    $adm_error="";
    

    if(isset($_POST["submit"])){

        $emp_id=rand();
        while(true){
            $sql = "SELECT * FROM employee WHERE Employee_ID = '$emp_id'";
            $res = getQueryResults($sql);
            if(sizeof($res)==0){
                break;
            }
            $emp_id=rand();
        }


        $deal_with_adm_error=false;
        if($_POST["position"]){
            $deal_with_adm_error=true;
        }
        
        
    
        $emp_user=mysqli_real_escape_string($connection,$_POST["username"]);
        $emp_pass=mysqli_real_escape_string($connection,$_POST["password"]);
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

        $adm_title=mysqli_real_escape_string($connection, $_POST["adm_title"]);

        $isValid = true;
        

        if(empty($_POST["username"])){
            $username_error="This field cannot be empty";
            $isValid=false;
        }
        else{
                $sql = "SELECT * FROM employee WHERE username='$emp_user'";

                if(sizeof(getQueryResults($sql))!=0){
                    $isValid=false;
                    $username_error="Username already taken";
                }  
        }

        if(empty($_POST["password"])){
            $password_error="This field cannot be empty";
            $isValid=false;
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
            $wage_error="This field cannot be empty";
            $isValid=false;
        }
        else{
            $wage = $_POST["wage"];
            if(!preg_match("/^[0-9]*$/", $_POST["wage"])){
                $wage_error="Please provide a valid wage";
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
            $isValid=false;
        }

        

        if($isValid){
            $sql = "INSERT INTO employee(Employee_ID,username, password_hash,FName, LName, phone_number, job_type, start_date, hourly_wage, email, adr_street, adr_housenumber,adr_city,adr_postalcode) 
                        VALUES ('$emp_id','$emp_user','$emp_pass','$emp_fn','$emp_ln','$emp_phone','$emp_jobtype','$emp_startdate','$emp_wage','$emp_email','$emp_street', '$emp_house' , '$emp_city', '$emp_postal')" ;

            execQuery($sql);

            if($_POST["position"]=="adm"){
                //Check if we are "promoting the user"
                $sql = "SELECT * FROM admin where Employee_ID='$emp_id'";
                if( sizeof(getQueryResults($sql))==0 ){
                    $sql = "INSERT INTO admin  VALUES ('$emp_id', '$adm_title')"; //NEED TO CHANGE THE ADMIN TITLE
                    execQuery($sql);
                }

            }
            $sql = "INSERT INTO vacation_days(Employee_ID, total, used) VALUES ('$emp_id', '$emp_vac', '0')";
            execQuery($sql);

        }
    }


    

?>

<html>
<?php include ("logged_admin_header.php"); ?>

    <form class ="white" action="admin_add_user.php" method="POST"> 

        <label> Username </label>
        <input type="text" name="username" value='<?php echo $emp_user;?>'>
        <div class="red-text"> <?php echo $username_error;?></div>

        <label> Password: </label>
        <input type="password" name="password">
        <div class="red-text"> <?php echo $password_error;?></div>

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

        <label > Start Date: </label>
        <input type="text" name= "startDate" class="datepicker" value=<?php echo $emp_startdate;?>>
        <div class="red-text"> <?php echo $startDate_error;?></div>

        <label > House Number: </label>
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


        <label > Vacation Days: </label>
        <input type="text" name="vac" value=<?php echo $emp_vac;?>>
        <div class="red-text"> <?php echo $vac_error;?></div>

        <label>Select Position: </label>
        <select class="browser-default" name="position">
            <option value="emp">Employee </option>
            <option value="adm">Admin </option>
        </select>

        <label > Admin Title (ONLY IF ADMIN IS SELECTED): </label>
        <input type="text" name="adm_title" value='<?php echo $adm_title;?>'>
        <div class="red-text"> <?php echo $adm_error;?></div>

        <div class="center">
            <input type="submit" name = "submit" value="submit" class = "btn brand z-depth-0">
        </div>

    </form>


    <!-- Script for calendar view -->
    <script>
        const Calendar = document.querySelector('.datepicker');
            M.Datepicker.init(Calendar, {
                format: 'yyyy-mm-dd'

            });
    </script>

    <?php include ("../templates/footer.php") ; ?>
</html>