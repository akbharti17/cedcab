<?php
session_start();
include("operation/connection.php");

$pickpt = $_POST['pickpt'];
$droppt = $_POST['droppt'];
$cabtype = $_POST['cabtype'];
$wt = $_POST['wt'];
$src="SELECT `name`, `distance`FROM `tbl_location` WHERE name='$pickpt'";
$des="SELECT `name`, `distance`FROM `tbl_location` WHERE name='$droppt'";

$r1=$conn->query($src);
$r2=$conn->query($des);
$srcar=$r1->fetch_assoc();
$desar=$r2->fetch_assoc();
$obj=new Car;

echo $srcar['name']."->".$desar['name']."<br>";

$distance = abs($srcar['distance'] -$desar['distance']);
echo "Distance is " . $distance . " Km.<br>";

if ($cabtype == "CedMicro") {
  $tfair=$obj->cedMicro($distance);
  echo "Fair Amount is : " . $obj->cedMicro($distance) . " Rs";
} elseif ($cabtype == "CedMini") {
  if ($wt == '' || $wt <= 0) {
    $tfair=$obj->cedMini($distance);
    echo "Fair Amount is : " . $obj->cedMini($distance) . " Rs";
  }
  if ($wt > 0 && $wt <= 10) {
    $tfair=($obj->cedMini($distance) + 50);
    echo "Fair Amount is : " . ($obj->cedMini($distance) + 50) . " Rs";
  } elseif ($wt > 10 && $wt <= 20) {
    $tfair=($obj->cedMini($distance) + 100);
    echo "Fair Amount is : " . ($obj->cedMini($distance) + 100) . " Rs";
  } elseif ($wt > 20) {
    $tfair=($obj->cedMini($distance) + 200);
    echo "Fair Amount is : " . ($obj->cedMini($distance) + 200) . " Rs";
  }
} elseif ($cabtype == "CedRoyal") {
  if ($wt == '' || $wt == 0) {
    $tfair=$obj->cedRoyal($distance);
    echo "Fair Amount is : " . $obj->cedRoyal($distance) . " Rs";
  }
  if ($wt > 0 && $wt <= 10) {
    $tfair=($obj->cedRoyal($distance) + 50);
    echo "Fair Amount is : " . ($obj->cedRoyal($distance) + 50) . " Rs";
  } elseif ($wt > 10 && $wt <= 20) {
    $tfair=($obj->cedRoyal($distance) + 100);
    echo "Fair Amount is : " . ($obj->cedRoyal($distance) + 100) . " Rs";
  } elseif ($wt > 20) {
    $tfair=($obj->cedRoyal($distance) + 200);
    echo "Fair Amount is : " . ($obj->cedRoyal($distance) + 200) . " Rs";
  }
} elseif ($cabtype == "CedSUV") {
  if ($wt == '' || $wt == 0) {
    $tfair=$obj->cedSUV($distance);
    echo "Fair Amount is : " . $obj->cedSUV($distance) . " Rs";
  }
  if ($wt > 0 && $wt <= 10) {
    $tfair=($obj->cedSUV($distance) + 100);
    echo "Fair Amount is : " . ($obj->cedSUV($distance) + 100) . " Rs";
  } elseif ($wt > 10 && $wt <= 20) {
    $tfair=($obj->cedSUV($distance) + 200);
    echo "Fair Amount is : " . ($obj->cedSUV($distance) + 200) . " Rs";
  } elseif ($wt > 20) {
    $tfair=($obj->cedSUV($distance) + 400);
    echo "Fair Amount is : " . ($obj->cedSUV($distance) + 400) . " Rs";
  }
}
class Car{
function cedMicro($distance)
{
  $bookingAmount = 50;
  $fairAmt = 0;
  if ($distance == 10) {
    $fairAmt = $distance * 13.50;
  } else if ($distance > 10 && $distance <= 60) {
    $remdes = $distance - 10;
    $fairAmt = $remdes * 12 + (10 * 13.50);
  } else if ($distance > 60 && $distance <= 160) {
    $remdes = $distance - 60;
    $fairAmt = $remdes * 10.20 + (50 * 12) + (10 * 13.50);
  } else if ($distance > 160) {
    $remdes = $distance - 160;
    $fairAmt = ($remdes * 8.50) + (50 * 12) + (10 * 13.50) + (100 * 10.20);
  }
  $totalfair=$fairAmt + $bookingAmount;
  return $fairAmt + $bookingAmount;
}

function cedMini($distance)
{
  $bookingAmount = 150;
  $fairAmt = 0;
  if ($distance == 10) {
    $fairAmt = $distance * 14.50;
  } else if ($distance > 10 && $distance <= 60) {
    $remdes = $distance - 10;
    $fairAmt = $remdes * 13 + (10 * 14.50);
  } else if ($distance > 60 && $distance <= 160) {
    $remdes = $distance - 60;
    $fairAmt = $remdes * 11.20 + (50 * 13) + (10 * 14.50);
  } else if ($distance > 160) {
    $remdes = $distance - 160;
    $fairAmt = ($remdes * 9.50) + (50 * 13) + (10 * 14.50) + (100 * 11.20);
  }
  $totalfair=$fairAmt + $bookingAmount;
  return $totalfair;
}

function cedRoyal($distance)
{
  $bookingAmount = 200;
  $fairAmt = 0;
  if ($distance == 10) {
    $fairAmt = $distance * 15.50;
  } else if ($distance > 10 && $distance <= 60) {
    $remdes = $distance - 10;
    $fairAmt = $remdes * 14 + (10 * 15.50);
  } else if ($distance > 60 && $distance <= 160) {
    $remdes = $distance - 60;
    $fairAmt = $remdes * 12.20 + (50 * 14) + (10 * 15.50);
  } else if ($distance > 160) {
    $remdes = $distance - 160;
    $fairAmt = ($remdes * 10.50) + (50 * 14) + (10 * 15.50) + (100 * 12.20);
  }
  $totalfair=$fairAmt + $bookingAmount;
  return $totalfair;
}

function cedSUV($distance)
{
  $bookingAmount = 250;
  if ($distance == 10) {
    $fairAmt = $distance * 16.50;
  } else if ($distance > 10 && $distance <= 60) {
    $remdes = $distance - 10;
    $fairAmt = $remdes * 15 + (10 * 16.50);
  } else if ($distance > 60 && $distance <= 160) {
    $remdes = $distance - 60;
    $fairAmt = $remdes * 13.20 + (50 * 15) + (10 * 16.50);
  } else if ($distance > 160) {
    $remdes = $distance - 160;
    $fairAmt = ($remdes * 11.50) + (50 * 15) + (10 * 16.50) + (100 * 13.20);
  }
  $totalfair=$fairAmt + $bookingAmount;
  return $totalfair;
}

}

$_SESSION['from']=$pickpt;
$_SESSION['to']=$droppt;
$_SESSION['distance']=$distance;
$_SESSION['luggage']=$wt;
$_SESSION['fair']=$tfair;
$_SESSION['c_type']=$cabtype;

