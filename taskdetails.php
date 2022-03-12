<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }
    $email = $_SESSION['email'];
    $emp_id = $_SESSION['eid'];
    $task_id = $_SESSION['tid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admindash.css">
    <?php
    include 'includes/links.php';
    ?>
    <title>Task Details</title>
</head>
<body>

<?php
    include 'connection.php';
    $selectquery = "select * from tasks where tid='$task_id'";
    $query = mysqli_query($con, $selectquery);
    $res = mysqli_fetch_assoc($query);
?>

    <nav id="header">
        <div class="header_container">
            <div class="navbar">
                <div class="user">
                    <p>Task Management System</p>
                    <!-- <img src="images/duser.png" alt="profile" class="img"> -->
                </div>
                <div class="navlist">
                    <ul>
                        <!-- <li><a href="#ongoing_projects">ONGOING PROJECTS</a></li> -->
                        <li>Status:<?=$res['status']?></li>
                        <li><a href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <section class="task_details">
    <div >
    <!-- <h1>Task Details will appear here.</h1> -->
        <h3><?=$res['task_title']?></h3>
        <div>
            <p><?=$res['task_desc']?></p>
        </div>
    </div>
    </section>
</body>
<?php
    include 'includes/scripts.php';
?>
</html>