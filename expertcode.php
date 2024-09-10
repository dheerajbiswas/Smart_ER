<?php
session_start();
include("connection.php");
$message = "";
$role = "";

if (isset($_POST["btnLogin"])) 
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
            if ($row["role"] === "expert")
            {
                $_SESSION['user'] = $row["username"];
                $_SESSION['role'] = $row["role"];
                $_SESSION['login'] = "110010";
                $_SESSION['token'] = "000";
                header('Location: patient-list.php?doc=' . $row['Name']);    //role=' . $role . '&
            }
            else
            // if($row["role"] === "user")
            {
                // $_SESSION['user'] = $row["username"];
                // $_SESSION['role'] = $row["role"];
                // header('Location: patient-register.php');
                header('Location: intro.php?token=3');

            }
        }
    }
    else
    {
        echo mysqli_num_rows($result);
        
        header('Location: intro.php?error=1');
    }
}
?>
