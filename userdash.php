<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }
    $email = $_SESSION['email'];
    $emp_id = $_SESSION['eid'];
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
    <title>User Dashboard</title>
</head>
<body>
    <nav id="header">
        <div class="header_container">
            <div class="navbar">
                <div class="user">
                    <!-- <p>Hello></p> -->
                    <img src="images/duser.png" alt="profile" class="img">
                </div>
                <div class="navlist">
                    <ul>
                        <!-- <li><a href="#ongoing_projects">ONGOING PROJECTS</a></li> -->
                        <!-- <li><a href="#assign_task">ASSIGN TASKS</a></li> -->
                        <li><a href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="message">
        <p id="count_task" class="no_task"></p>
    </div>


    <?php 
        include 'connection.php';
        $selectquery = "select * from tasks where eid='$emp_id'";
        $query = mysqli_query($con, $selectquery);
        $counttask = mysqli_num_rows($query);
        $res = mysqli_fetch_assoc($query);


        if(!$counttask){
            ?>
            <script>
                document.getElementById('count_task').innerHTML = "No Task or Project/ Assigned.";
            </script>
            <?php

        }else{
            ?>
            <table>
            <tr>
                <th>Task Title</th>
                <th>Date Assigned</th>
                <th>Status</th>
            </tr>
            <?php  
                while($res=mysqli_fetch_assoc($query)){
                    $_SESSION['tid'] = $res['tid'];
                    
                    ?>
                        <tr>
                            <td><a href="taskdetails.php?tid=<?=$res["tid"] ?>"><?=$res["task_title"] ?></a></td>
                            <td><?=$res["time"] ?></td>
                            <td><?=$res["status"] ?></td>

                        </tr>
                    <?php
                }
            ?>
            </table>
            <?php
        }

    ?>
</body>
<?php
    include 'includes/scripts.php';
?>
</html>