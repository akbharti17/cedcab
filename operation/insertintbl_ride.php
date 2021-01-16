<?php
session_start();
include("connection.php");
if (isset($_SESSION['email'])) {
   $pickpt = $_SESSION['from'];
   $droppt = $_SESSION['to'];
   $distance = $_SESSION['distance'];
   $wt = $_SESSION['luggage'];
   $usrid = $_SESSION['user_id'];
   $tfair = $_SESSION['fair'];
   $cabtype = $_SESSION['c_type'];
   $q = "INSERT INTO
   `tbl_ride`( `from`, `to`, `cab_type`, `total_distance`, `luggage`, `total_fair`, `status`, `customer_user_id`)
   VALUES ('$pickpt','$droppt','$cabtype','$distance','$wt','$tfair','1','$usrid')";

   if ($conn->query($q) === TRUE) {
      header('Refresh:1; url= ../User/userdashboard.php');
      // echo "New record created successfully";
      header("location:");
      echo "<script>alert('Your Ride Booked Successfully but pending from Admin side');</script>";
   } else {
      echo "Error: " . $q . "<br>" . $conn->error;
   }
} else {
   header("location: ../login.php");
   $_SESSION["booking"] = 'book';
}
