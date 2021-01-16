<?php
$servername = "localhost";
$username = "root";
$password = "";
$db="cedcab";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo md5("81dc9bdb52d04dc20036dbd8313ed055");
?>