<?php

 include("../operation/connection.php");
 $id=$_GET['id'];
 echo $userid,$ride_id;
 $q="DELETE FROM `tbl_location` WHERE id='$id'";

 if ($conn->query($q) === TRUE) {
    echo "Deleted Successfully";
  } else {
    echo "Error: " . $q . "<br>" . $conn->error;
  }



 header("location: admindashboard.php");


?>