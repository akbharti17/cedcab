<?php

 include("../operation/connection.php");
 $email=$_GET['email'];

 $q="UPDATE `tbl_user` SET `status`=1 WHERE email_id='$email'";

 if ($conn->query($q) === TRUE) {
    echo "Updated successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }



 header("location: admindashboard.php");


?>