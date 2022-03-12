<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }
    $email = $_SESSION['email'];
    $emp_id = $_SESSION['eid'];
    include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <?php
    include 'includes/links.php';
    ?>
    <title>Create Task</title>
</head>
<body>
<section class="task">
    <div class="col-md-9">
        <form action="" method="post">
            <h3>Create Task here.</h3>
        <div class="box">
            <label for="title">Task Title *</label>
            <input type="text" name="task_title" placeholder="Enter a valid Task Title." required>
        </div>
        <div class="box">
            <label for="description">Task Description *</label>
            <!-- <input type="" name="task_title" placeholder="Enter a valid Task Title."> -->
            <textarea name="task_desc" id="" cols="38" rows="3" required></textarea>
        </div>
        <div class="box">
            <label for="user_assign">Assign To:</label>
            <select name="emp_id" id="emp_id">
                <option value="0" default>Select registered User</option>

                <?php //Fetching Registered user from employees....
                    $user = "User";
                    $selectquery = "select * from employees where role='$user'";
                    $query = mysqli_query($con, $selectquery);
                    $res = mysqli_fetch_assoc($query);
                    while($res=mysqli_fetch_assoc($query)){
                        ?>
                        <option value="<?=$res["eid"] ?>"><?=$res["email"] ?></option>
                        <?php
                    }
                ?>
                        <!-- <option value="1">emailof user1</option>
                        <option value=2>emailof user2</option> -->
            </select>
        </div>
        <div class="box">
            <label for="attachment">Upload File *</label>
            <input type="file" name="resume_file" required>
        </div>
        <div class="box">
            <input type="submit" name="create" value="Create">
        </div>
        </form>
    </div>
</section>
</body>
<?php
    include 'includes/scripts.php';
?>
</html>

<?php
    //checking if create button is clicked or not
    if(isset($_POST['create'])){
        $task_title = $_POST['task_title'];
        $task_desc = $_POST['task_desc'];
        $assign_to_eid = $_POST['emp_id'];
        $filepath = $_POST['resume_file'];

    //writing insert query
    $insertquery = "insert into tasks(eid,task_title,task_desc,resume_path)
                    values('$assign_to_eid','$task_title','$task_desc','$filepath')";

    //running insert query
    $res = mysqli_query($con, $insertquery);
    if($res){
        ?>
        <script>   
            location.replace("admindash.php");
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
?>