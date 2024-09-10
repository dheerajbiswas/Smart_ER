<?php
include("connection.php");
error_reporting(0);

$selected_id = $_GET['id'];

// Perform a new query to retrieve the details of the selected row using the provided id
$query = "SELECT * FROM patientregistration WHERE patientid = '$selected_id'";
$data = mysqli_query($conn, $query);

// Check if the query returned any data
if (mysqli_num_rows($data) > 0) {
    // Fetch the data of the selected row
    $selected_row = mysqli_fetch_assoc($data);

    // Display the details of the selected row
    echo "<h2>Selected Row Details</h2>";
    echo "<p>Patient Name: ".$selected_row['patientName']."</p>";
    echo "<p>Age: ".$selected_row['age']."</p>";
    echo "<p>Gender: ".$selected_row['gender']."</p>";
    echo "<p>Date: ".$selected_row['date']."</p>";
    echo "<p>Time: ".$selected_row['time']."</p>";
    echo "<p>Patient ID: ".$selected_row['patientid']."</p>";
    echo "<p>Presentation: ".$selected_row['presentation']."</p>";
} else {
    echo "Selected row not found.";
}
?>