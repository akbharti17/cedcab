<?php

 include("../operation/connection.php");
 $userid=$_GET['id'];
 $ride_id=$_GET['ride_id'];

 echo $userid,$ride_id;
 $q="UPDATE `tbl_ride` SET `status`=2 WHERE ride_id='$ride_id' and customer_user_id='$userid'";

 if ($conn->query($q) === TRUE) {
    echo "Updated successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }



 header("location: admindashboard.php");


?>