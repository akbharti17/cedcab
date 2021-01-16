<?php
session_start();
$usrotp=$_POST["emailotp"];
if($_SESSION["emailotp"]==$usrotp){
    echo "verified";
}else{
    echo "incorrect otp";
}