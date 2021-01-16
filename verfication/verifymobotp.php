<?php
session_start();
$usrotp=$_POST["mobotp"];

if($_SESSION["mobotp"]==$usrotp){
    echo "verified";
}else{
    echo "incorrect otp";
}