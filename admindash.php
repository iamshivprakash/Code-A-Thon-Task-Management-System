<?php
    include 'connection.php';
    session_start();
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }
    $email =$_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php
    include 'includes/links.php';
    ?>
    <link rel="stylesheet" href="css/admindash.css">
</head>
<body>
    <nav id="header">
        <div class="header_container">
            <div class="navbar">
                <div class="user">
                    <p>Hello <?php echo $_SESSION['email']; ?></p>
                </div>
                <div class="navlist">
                    <ul>
                        <li><a href="#ongoing_projects">ONGOING PROJECTS</a></li>
                        <li><a href="#assign_task">ASSIGN TASKS</a></li>
                        <li><a href="createtask.php">CREATE TASK <i class="far fa-calendar-plus"></i></a></li>
                        <li><a href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <section id="ongoing_projects">
    <div class="container">
        <h1>Ongoing Projects</h1>
        <div class="table">
        <table>
            <tr>
                <th>Project ID</th>
                <th>Project Title</th>
                <th>Assigned User ID</th>
                <th>Status</th>
            </tr>
            <?php   //selecting all projects from the Table....
                $selectquery = "select * from tasks";
                $query = mysqli_query($con, $selectquery);
                $res = mysqli_fetch_assoc($query);
                while($res=mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?=$res["tid"] ?></td>
                            <td><?=$res["task_title"] ?></td>
                            <td><?=$res["eid"] ?></td>
                            <td><?=$res["status"] ?></td>
                        </tr>
                    <?php
                }
            ?>
        </table>
        </div>
    </div>
    </section>


    <section id="assign_task">
    <div class="container">
        <h1>Assign Tasks</h1>
        <div class="table">
        <table>
            <tr>
                <th>Project ID</th>
                <th>Project Title</th>
                <th>Assign To:</th>
            </tr>
            <?php   //selecting all projects from the Table....
                $selectquery = "select * from tasks";
                $query = mysqli_query($con, $selectquery);
                $res = mysqli_fetch_assoc($query);
                while($res=mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?=$res["tid"] ?></td>
                            <td><?=$res["task_title"] ?></td>
                            <td>
                            <form action="" method="post">
                                <select name="eid" id="">
                                    <option value="0" default>Assign User</option>
                                    <?php
                                    $selectquery2 = "select * from tasks";
                                    $query2 = mysqli_query($con, $selectquery2);
                                    $res2 = mysqli_fetch_assoc($query2);
                                    while($res=mysqli_fetch_assoc($query2)){
                                        ?>
                                        <option value="<? $res2['eid']?>"><? $res2['email']?></option>
                                        <?php
                                    }
                                    ?>
                                    
                                </select>
                                    <input type="submit" name="assign" value="Assign">
                            </form>
                            </td>
                        </tr>
                        
                    <?php
                    if(isset($_POST['assign'])){
                        $new_emp_id = $_POST['eid'];   
                        $updatequery = "update tasks set eid='$new_emp_id' where tid='".$res2['tid']."'";
                        $query = mysqli_query($con, $updatequery);
                    }
                }
            ?>
        </table>
        </div>
    </div>
    </section>
    
    
</body>
<?php
    include 'includes/scripts.php';
?>
</html>