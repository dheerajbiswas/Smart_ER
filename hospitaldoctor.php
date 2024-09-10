<?php
// Connect to your MySQL database
include("connection.php");
// Get selected hospital from AJAX request
$selectedHospital = $_POST['hospital'];

// Query to retrieve specialists based on the selected hospital
$sql = "SELECT Name, salute FROM login WHERE hospital = ? AND role = 'expert'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $selectedHospital);
$stmt->execute();
$result = $stmt->get_result();

$specialists = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // $specialists[] = $row['Name'];
        // $specialists[] = "Dr. ".$row['Name'];
        $specialists[] = $row['salute'] ." " . $row['Name'];
    }
}

$stmt->close();
$conn->close();

// Return specialists as JSON response
header('Content-Type: application/json');
echo json_encode($specialists);
?>
