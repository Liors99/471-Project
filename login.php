<?php 

    require("config/db_connect.php");

    $errors=array("user"=>"", "pass" => "");

    //Initialized to keep to persistent, i.e. after invalid submission, values do not reset.
    $username = "";
    $password = "";

    if(isset($_POST["submit"])){

        //Check that login information is not empty
        if(empty($_POST["username"])) {
            $errors["user"] = "username is required";
        }
        else{
            $username = htmlspecialchars($_POST["username"]) ; //htmlspecialchars prevents XSS attacks
        }


        if(empty($_POST["password"])) {
            $errors["pass"] = "password is required ";
        }
        else {
            $password = htmlspecialchars($_POST["password"]) ;
        }

        //If there are no errors (applys lambda function to every element in array, and checks that it is not empty)
        if(!array_filter($errors)){
            
            //header("Location: index.php");

            //Make query
            $sql = "SELECT password_hash FROM employee WHERE username = '$username' " ; //MIND THE SINGLE QUOUTE

            //get results
            $results = mysqli_query($connection, $sql);

            //fetch resulting rows as arrays
            $emps = mysqli_fetch_all($results, MYSQLI_ASSOC);
            

            print_r($emps);

            if($emps[0]["password_hash"] == $password){
                echo "SUCCESSS!!!!!!!!";
            }


            //Free result from memory
            mysqli_free_result($results);

            //Close connection to database
            mysqli_close($connection);
        
        }
    }

    


?>

<html>
    <?php include('templates/header.php'); ?>
    <section class= "container grey-text">
        <h4 class="center"> Login</h4>
        <form class ="white" action="login.php" method="POST"> 
            <label > Username: </label>
            <input type="text" name="username" value=<?php echo $username;?> >
            <div class="red-text"> <?php echo $errors["user"];?></div> 

            <label > Password: </label>
            <input type="text" name="password" value=<?php echo $password;?>>
            <div class="red-text"> <?php echo $errors["pass"];?></div>  

            <div class="center">
                <input type="submit" name = "submit" value="submit" class = "btn brand z-depth-0">

            </div>

        </form>
    </section>

</html>