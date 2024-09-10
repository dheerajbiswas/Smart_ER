<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  // $dbname = "patientdetails";
  $dbname = "patientdatabase";


  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn)
  {
  	echo "connection failed".mysqli_connect_error();
  }

