<?php
// Connect to your MySQL database
include("connection.php");


// $target_file = $_POST['file'];

// Command to run the MATLAB script
$command = "matlab -r 'your_matlab_script; exit;'";

// matlab -nodisplay -nodesktop -r '."run('"."predict_ecg.m(".'C:\Users\91887\Downloads\internet_ecg.jpeg'"."'));exit"
// Execute the MATLAB script
$output = shell_exec($command);

// Process the output as needed
$response = array('result' => trim($output));

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);