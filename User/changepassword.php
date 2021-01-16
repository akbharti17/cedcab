<?php
session_start();
include("../operation/connection.php");
$pass=$_POST['pass'];
$npass=$_POST['npass'];
$cpass=$_POST['cpass'];
$email=$_SESSION['email'];
$encrptPass=md5($npass);

$q="select * from tbl_user where email_id='$email'";

$result=$conn->query($q);
$row=$result->fetch_assoc();

$dbpass=$row['password'];

if(md5($pass)==$dbpass){
    if($npass==$cpass){
        $upq="update tbl_user set password='$encrptPass' where email_id='$email'";
        if($conn->query($upq)===TRUE){
            echo "password changed";
        }else{
            echo "failed to change password";
        }
    }else{
        echo "mismatch password";
    }

}else{
    echo "Incorrect Password";
}
 



?>