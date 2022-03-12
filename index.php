<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <?php
    include 'includes/links.php';
    ?>
    <link rel="stylesheet" href="css/login.css">
    <!-- <link rel="stylesheet" href="css/header.css"> -->
    <title>Login</title>
</head>
<body>
<div class="col-md-6 form_container">
        <form action="" method="post">
        <h3>Login here.</h3>
        <p id="err-msg" class="text-danger ml-3"></p>
            <div class="box">
            <label for="email">Select Role:</label>
                <select name="role" required>
                    <option value="Select Role" default> Select Role</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="User">User</option>
                </select>
            </div>
            <div class="box">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="youremail@gmail.com" required>
            </div>
            <div class="box">
                <label for="Password">Password:</label>
                <input type="password" name="password" placeholder="Enter your Password" required>
            </div>
            <div class="submit">
                <input type="submit" name="login" value="Login">
            </div>
            <div class="box">
                <p class="text-center mt-4">Don't have an account? 
                    <br>
                    <a href="register.php">Click to register</a>
                </p>
            </div>
        </form>
    </div>
</body>
<?php
    include 'includes/scripts.php';
?>
</html>

<?php

include 'connection.php';

       // checking if submit button is clicked or not
        if (isset($_POST['login'])){
          $email = $_POST['email'];
          $password = $_POST['password'];
          $input_role = $_POST['role'];
        //Checking if Email is already registered or not
            $emailsearch = "select * from employees where email='$email'";
            $query = mysqli_query($con, $emailsearch);
            $emailcount =mysqli_num_rows($query);
        //If email found then store encrypted password for validation.
            if($emailcount){
                $res = mysqli_fetch_assoc($query);
                $dbpassword = $res['password'];
                $role = $res['role'];
                $admin = "ADMIN";

                //Session Variables
                $_SESSION['email'] =$res['email'];
                $_SESSION['eid'] =$res['eid'];

                //verify password with real password.
                // $pass_decode = password_verify($password, $realpassword);
                if($password==$dbpassword){
                    if($input_role=="ADMIN" AND $input_role==$role){  //If password is correct and user is Admin
                        ?>
                    <script>
                      location.replace("admindash.php");
                    </script>
                    <?php
                    }else if($input_role=="User" AND $input_role==$role){  //if password is correct and user is not admin.
                        ?>
                    <script>
                      location.replace("userdash.php");
                    </script>
                    <?php
                    }else{
                        ?>
                        <script>
                            document.getElementById('err-msg').innerHTML = "Please select the correct role.";
                        </script>
                        <?php
                    }
                  }else{  //if password in not correct.
                    ?>
                    <script>
                        // alert("Password is not matching.")
                      document.getElementById('err-msg').innerHTML = "Wrong email and/or password.";
                    </script>
                    <?php
                  }
            }else{   //if email is not valid and/or user is not registered.
                ?>
                <script>
                    document.getElementById('err-msg').innerHTML = "This email is not registered yet.";
                </script>
                <?php
            }
        }     

?>


