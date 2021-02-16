<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ospedale";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con) {
  echo "<script>alert('failed');</script>";
  die("Connection failed: " . mysqli_connect_error());
}
else{
  //echo "<script>alert('welcome');</script>";
}
?>