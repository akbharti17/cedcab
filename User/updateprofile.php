<?php
 session_start();
 include("../operation/connection.php");
 $name=$_POST['name'];
 $mob=$_POST['mobile'];
 $email=$_SESSION['email'];
 $upq="update tbl_user set name='$name',mobile='$mob' where email_id='$email'";
 if($conn->query($upq)===TRUE){
     echo "Profile Updated Successfully";
 }else{
     echo "failed to update profile";
 }






