<?php
// // Check if the selectedItems parameter exists in the POST data
// if (1) { //isset($_POST['selectedItems'])
//     // Get the JSON string from the POST data and decode it into an array
//     // $selectedItemsJSON = $_POST['selectedItems'];
//     // $selectedItems = json_decode($selectedItemsJSON);
//     $selectedItems = ['Alpyrin 150 mg', 'Alpyrin 75 mg'];

//     // Perform a search for shops based on the selected medicines
//     $results = searchShops1($selectedItems);

//     // Send the results as a JSON response
//     echo json_encode($results);
// } else {
//     // If selectedItems parameter is not received, send an error response
//     echo json_encode(['error' => 'Selected items not found in POST data']);
// }

// // Function to simulate searching for shops based on selected medicines
// function searchShops($selectedItems) {
//     // Replace this with your actual database query to search for shops
//     // Here, we'll simulate results with random data
//     $shops = [];

//     foreach ($selectedItems as $item) {
//         // Simulate searching for shops that have the selected item in stock
//         $shopName = "Shop " . rand(1, 10);
//         $shops[] = ['shopName' => $shopName, 'medicine' => $item];
//     }

//     return $shops;
// }

// function searchShops1($selectedItems) {
//     // Replace this with your actual database query to search for shops
//     // Here, we'll simulate results with random data
//     $shops = [];

//     foreach ($selectedItems as $item) {
//         // Simulate searching for shops that have the selected item in stock
//         $query = "SELECT shopno FROM WHERE medicine = '$item'";

//         $shopName = ;
//         $shops[] = ['shopName' => $shopName, 'medicine' => $item];
//     }

//     return $shops;
// }
?>


<?php
// Database connection 
include("connection.php");

// Medicines array
$selectedItemsJSON = $_POST['selectedItems'];
$selectedItems = json_decode($selectedItemsJSON);
$medicines = $selectedItems; //['Alpyrin 75 mg'];

// List of shop-specific tables (modify this according to your database structure)
$shopTables = ['shop1', 'shop2'];

// Initialize an array to store shop IDs that have all specified medicines
$commonShopIds = [];

// Loop through each shop's table
foreach ($shopTables as $shopTable) {
    $shopHasAllMedicines = true;

    // Search for each medicine in the shop's table
    foreach ($medicines as $medicine) {
        $sql = "SELECT COUNT(*) as count FROM $shopTable WHERE medicine = ?";
        // echo $sql;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $medicine);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $count = $row['count'];

        // If the medicine is not found in this shop's table, mark it as incomplete
        if ($count == 0) {
            $shopHasAllMedicines = false;
            break;
        }

        $stmt->close();
    }

    // If the shop has all specified medicines, add its ID to the commonShopIds array
    if ($shopHasAllMedicines) {
        // Extract shop ID from the table name (modify this according to your table naming convention)
        $shopId = extractShopIdFromTableName($shopTable);
        $commonShopIds[] = $shopId;
    }
}

// Retrieve shop information for the common shop IDs
$commonShops = [];

// echo "<br>";
// var_dump($commonShopIds);



// Initialize an array to store results
$shopData = [];

foreach ($commonShopIds as $shopId) {
    // Query to retrieve information for the current shop ID
    $sql = "SELECT * FROM `medicallogin` WHERE shopno = ?";
    
    // Prepare the SQL query
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Error in prepare statement: " . $conn->error);
    }
    
    // Bind the shop ID as a parameter
    if (!$stmt->bind_param("s", $shopId)) {
        die("Error in bind_param: " . $stmt->error);
    }
    
    // Execute the query
    if (!$stmt->execute()) {
        die("Error in execute: " . $stmt->error);
    }
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch the data and add it to the array
    while ($row = $result->fetch_assoc()) {
        $shopData[] = $row;
    }
    
    // Close the statement for the current shop ID
    $stmt->close();
}

// Close the database connection
// $conn->close();

// Convert the array to JSON
$jsonData = json_encode($shopData);

// Return the JSON data
echo $jsonData;













// if (!empty($commonShopIds)) {
//     $sql = "SELECT * FROM medicallogin WHERE shopno IN (" . implode(",", $commonShopIds) . ")";
//     echo $sql;
//     $result = $conn->query($sql);
// echo "<br>";

//     var_dump($result);
//     while ($row = $result->fetch_assoc()) {
//         $commonShops[] = $row;
//     }
// }

// Close the database connection
// $conn->close();

// Return the list of shops that have all the specified medicines
// echo json_encode($commonShops);

// Function to extract shop ID from table name (customize based on your table naming convention)
function extractShopIdFromTableName($tableName) {
    // Implement the logic to extract the shop ID from the table name
    // For example, if the table name is 'shop1_medicine_shop', you can extract 'shop1'
    // return substr($tableName, 0, strpos($tableName, '_medicine_shop'));
    return $tableName;

}

?>