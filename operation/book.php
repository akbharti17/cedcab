<?php
session_start();
include("conncetion.php");
$pickpt= $_SESSION['from'];
$droppt= $_SESSION['to'];
$distance=$_SESSION['distance'];
$wt= $_SESSION['luggage'];
$tfair =$_SESSION['fair'];
$q = "INSERT INTO
   `tbl_ride`( `from`, `to`, `cab_type`, `total_distance`, `luggage`, `total_fair`)
   VALUES ('$pickpt','$droppt','$distance','$wt','$tfair')";
