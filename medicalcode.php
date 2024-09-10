<?php

// Backend: medical store login

session_start();
include("connection.php");
// $message = "";
// $role = "";

if (isset($_POST["btnLogin"])) {
    $username = $_POST["medusername"];
    $password = $_POST["medPassword"];
    $query = "SELECT * FROM medicallogin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // if ($row["role"] === "expert")
            // {
            //     $_SESSION['user'] = $row["username"];
            //     $_SESSION['role'] = $row["role"];
            //     header('Location: patient-list.php');
            // }
            // $role = $row['role'];
            // if ($row["role"] === "medical") {
            $_SESSION['medusername'] = $row["username"];
            $_SESSION['shopno'] = $row['shopno'];
            $_SESSION['shopname'] = $row['storename'];
            $fullName = $row['keeper'];

            // Split the full name into first name and last name
            $nameParts = explode(" ", $fullName);

            // Check if there are at least two parts (first name and last name)
            if (count($nameParts) >= 2) {
                $_SESSION['name'] = $nameParts[0];
                // echo "First Name: " . $firstName;
            } else {
                // If there are not enough parts, assume the full input is the first name
                // echo "First Name: " . $fullName;
            }

            // $_SESSION['role'] = $row["role"];
            $_SESSION['token'] = "000";
            $_SESSION['login'] = "110010";
            header('Location: medical-dashboard.php');
            // } else {
            // header('Location: intro.php?token=3');
            // }
        }
    } else {
        echo mysqli_num_rows($result);

        header('Location: intro.php?error=1');
    }
}
?>