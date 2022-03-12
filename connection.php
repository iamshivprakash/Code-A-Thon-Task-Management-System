<?php
$username ="root";
$password ="";
$server ="localhost";
$dbname ="tms";
$con= mysqli_connect($server,$username,$password,$dbname);

if($con){
    // <!-- echo "connection successful"; -->
}else{
  //echo " No connection";
  die("no connectiom" . mysqli_connect_error());
}
?>
