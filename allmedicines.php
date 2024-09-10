<?php
// Connect to your MySQL database
include("connection.php");
// Get selected hospital from AJAX request
$drug = $_POST['drug'];
// echo $drug;
// Query to retrieve specialists based on the selected hospital
$sql = "SELECT * FROM medicines WHERE medicine=?";
// $res = mysqli_query($conn, $sql);
// $r = mysqli_fetch_all($res);
// var_dump($r);

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $drug);
$stmt->execute();
$result = $stmt->get_result();

$medicinelist = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $medicinelist[] = $row;
        // $specialists[] = "Dr. ".$row['Name'];
        // $specialists[] = $row['salute'] ." " . $row['Name'];
    }
}

$stmt->close();
// $conn->close();

// Return specialists as JSON response
header('Content-Type: application/json');
echo json_encode($medicinelist);
?>
