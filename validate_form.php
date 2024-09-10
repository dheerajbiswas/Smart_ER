<?php 
include("connection.php");

$firstName = trim($_POST['firstName']);
// $middleName = trim($_POST['middleName']);
$lastName = trim($_POST['lastName']);

$mci = $_POST['Council_registration'];
$hospital = $_POST['hospital'];
$phone_no = $_POST['phone_no'];
$whatsapp_no = $_POST['whatsapp_no'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmpass = $_POST['confirmpass'];

$error = array();

if(empty($firstName)) {
    $error['firstName'] = "Please enter the first name.";
} elseif(!preg_match('/^[a-zA-Z]+$/', $firstName)) {
    $error['firstName'] = "Name should contain only letters.";
}

// if(empty($middleName)) {
//     $error['firstName'] = "Please enter the middle name.";
// } elseif(!preg_match('/^[a-zA-Z]+$/', $middleName)) {
//     $error['firstName'] = "Name should contain only letters.";
// }

if(empty($lastName)) {
    $error['firstName'] = "Please enter the last name.";
} elseif(!preg_match('/^[a-zA-Z]+$/', $lastName)) {
    $error['firstName'] = "Name should contain only letters.";
}

if(empty($mci)) {
    $error['mci'] = "Enter medical council registration number.";
}

if(empty($hospital)) {
    $error['hospital'] = "Enter hospital name.";
}

if(empty($phone_no)) {
    $error['phone_no'] = "Enter mobile number.";
} elseif(!preg_match('/^\d{10}$/', $phone_no)) {
    $error['$phone_no'] = "Enter 10 digit mobile number.";
}

if(empty($whatsapp_no)) {
    $error['$whatsapp_no'] = "Enter mobile number.";
} elseif(!preg_match('/^\d{10}$/', $whatsapp_no)) {
    $error['$whatsapp_no'] = "Enter 10 digit mobile number.";
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Enter a valid email address.";
}

if(strlen($password) < 8) {
    $error['password'] = "Password must be alteast 8 characters.";
}

if($confirmpass !== $password) {
    $error['confirmpass'] = "Password mismatch.";
}


if (empty($errors)) {
    // Perform database insertion or other necessary actions
    // If successful, you can redirect or return a success message
    // If not successful, you can redirect back to the form with error messages
} else {
    // Redirect back to the form with error messages
    // You can use the $errors array to display specific error messages next to fields
}
?>