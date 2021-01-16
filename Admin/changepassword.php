<?php
 include("../operation/connection.php");
 $pass=$_POST['pass'];
 $npass=$_POST['npass'];
 $cpass=$_POST['cpass'];
 $encrptPass=md5($npass);

 $q="select * from tbl_user where email_id='admin@gmail.com'";

 $result=$conn->query($q);
 $row=$result->fetch_assoc();
 $dbpass=$row['password'];

 if(md5($pass)==$dbpass){
    if($npass==$cpass){
        $upq="update tbl_user set password='$encrptPass' where email_id='admin@gmail.com'";
        if($conn->query($upq)===TRUE){
            echo "password changed";
        }else{
            echo "failed to change password";
        }
    }else{
        echo "mismatch password";
    }

 }else{
     echo "Your Password is wrong";
 }



