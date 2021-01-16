<?php 
 session_start();
 include("../operation/connection.php");
 $ride_id=$_GET['rideid'];
 $id=$_SESSION['user_id'];
$query="UPDATE `tbl_ride` SET `status`=0 WHERE customer_user_id='$id' and ride_id='$ride_id'";

if($conn->query($query)===TRUE){
    echo "<script>alert('Your ride is Canceled');</script>";
    header('Refresh:1; url=userdashboard.php');
}else{
    echo "failed to cancel";
}