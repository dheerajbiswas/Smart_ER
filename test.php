<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "patientdetails";
$pid = $_GET['id'];
// echo $id;
// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
//   }

include("connection.php");

$cheifComplain = 'asdfnl';
$comCheck1 = '';
$sql = "UPDATE patientregistration SET cheifComplain='$cheifComplain', comCheck1='$comCheck1' WHERE patientid=$pid";

if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}




mysqli_close($conn);
?>