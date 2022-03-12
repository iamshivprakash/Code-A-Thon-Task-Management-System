<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <?php
    include 'includes/links.php';
    ?>
    <link rel="stylesheet" href="css/register.css">
    <title>Register</title>
</head>
<body>
    <!-- <center> -->
    <!-- <h1>Task Management System.</h1> -->
    <div class="col-md-6 form_container">
        <form action="" method="post">
            <h3>Register here.</h3>
            <p id="err-msg" class="text-danger ml-3"></p>
            <div class="box">
            <label for="email">Select Role:</label>
                <select name="role" id="role" required>
                    <option value="Select Role" default> Select Role</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div class="box">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="example@mail.com" required>
                <!-- <label for="fname">First name:</label><br>
                <input type="text" id="fname" name="fname"><br>
                <label for="lname">Last name:</label><br>
                <input type="text" id="lname" name="lname"> -->
            </div>
            <div class="box">
                <label for="Password">Password:</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="submit">
                <input type="submit" name="register" value="Register">
            </div>
            <div class="box">
                <p class="text-center mt-4">Already have an account? 
                    <br>
                    <a href="index.php">Click to login</a>
                </p>
            </div>
        </form>
    </div>
    <!-- </center> -->
</body>
<?php
    include 'includes/scripts.php';
    ?>
</html>


<?php

       include 'connection.php';

       // checking if submit button is clicked or not
        if (isset($_POST['register'])){
          $email = $_POST['email'];
          $password = $_POST['password'];
          $role = $_POST['role'];

        // Password Encrypion
        
         $crypt_pass = password_hash($password, PASSWORD_BCRYPT);
        
        //Check if user is already registered with the email or not
        $searchemailquery = "select email from employees where email='$email'";
        $runquery = mysqli_query($con, $searchemailquery);
        $emailcount =mysqli_num_rows($runquery);

        if($emailcount){
            ?>
            <script>
                document.getElementById('err-msg').innerHTML = "This email is already registered.";
            </script>
            <?php
        }else{

         // Writing Insert Query
         $insertquery = "insert into employees(email, password, role)
                            values('$email', '$password', '$role')";

        // Running Insert Query

        $res = mysqli_query($con, $insertquery);
        
        if($res){
            ?>
            <script>   
                location.replace("index.php");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("There is some error, try again!");
            </script>
            <?php
        }
        }
        }     
?>