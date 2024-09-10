<?php
// Establish a database connection here if not already done
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  
  if (isset($data['name'])) {
    $name = $data['name'];

    // Perform a MySQL query to check name availability
    $query = "SELECT COUNT(*) AS count FROM login WHERE username = '$name'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      $count = (int) $row['count'];

      if ($count > 0) {
        $response = array('message' => '*Username already exist');
      } else {
        $response = array('message' => '');
      }

      echo json_encode($response);
    } else {
      // echo json_encode(array('message' => 'Error checking name availability'));
      echo json_encode(array('message' => $name));

    }

    // Close the database connection here if needed
  }
}
?>