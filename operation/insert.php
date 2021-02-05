<?php
include("connection.php");
$email = $_POST['email'];
$mobile = $_POST['mobile'];
// $usrid = $_POST["usrid"];
$name = $_POST["name"];
$pass = md5($_POST["pass"]);
// echo $email;

$sql = "INSERT INTO tbl_user( `email_id`, `name`, `mobile`, `password`)
 VALUES ('$email','$name','$mobile','$pass')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
