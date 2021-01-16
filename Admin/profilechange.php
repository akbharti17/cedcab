<?php
 include("../operation/connection.php");
 $name=$_POST['name'];
 $mob=$_POST['mobile'];
 $upq="update tbl_user set name='$name',mobile='$mob' where email_id='admin@gmail.com'";
 if($conn->query($upq)===TRUE){
     echo "Profile Updated Successfully";
 }else{
     echo "failed to update profile";
 }

 setcookie('name',$row['name'],time()-(86400 * 30));



