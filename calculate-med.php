<?php

// Backend: calculating medicine cost and returns the json
session_start();

include_once("whatsapp.php");
include('connection.php');


$commonShopIds = $_POST['id'];
// $commonShopIds = 'shop1';
$sum = 0.0;

$pid = $_SESSION['pid'] ? $_SESSION['pid'] : "";

// fetching data for patient
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die("Failed");
    $data = mysqli_fetch_array($result);
    $hear = $data['total'];
    $patientname = $data['patientName'];
    $patientid = $data['patientid'];
}

$medicines = explode(",", $data['medicines']); //['Alpyrin 75 mg'];


$medicineData = [];
$druglist = [];

foreach ($medicines as $medicine) {
    // Query to retrieve information for the current shop ID
    $sql = "SELECT * FROM `$commonShopIds` WHERE medicine = ?";

    // Prepare the SQL query
    $stmt = $conn->prepare($sql);

    // Bind the shop ID as a parameter
    if (!$stmt->bind_param("s", $medicine)) {
        die("Error in bind_param: " . $stmt->error);
    }

    // Execute the query
    if (!$stmt->execute()) {
        die("Error in execute: " . $stmt->error);
    }

    // Get the result
    $result1 = $stmt->get_result();

    // Fetch the data and add it to the array
    while ($row1 = $result1->fetch_assoc()) {
        $medicineData[] = $row1;
        $druglist[] = [$row1['drug'], $row1['dose'], $medicine];
        // echo "<br>".$row1['price'];
        $sum += $row1['price'];

    }

    // Close the statement for the current shop ID
    $stmt->close();
}

// echo "<br>".$sum;
// var_dump($druglist);
// echo "<br><br>";












$gerenic = array();

// foreach ($medicines as $medicine) {
// Query to retrieve information for the current shop ID
$sql = "SELECT * FROM `$commonShopIds`";

// Prepare the SQL query
// $stmt = $conn->prepare($sql);


// Bind the shop ID as a parameter
// if (!$stmt->bind_param("s", $medicine)) {
//     die("Error in bind_param: " . $stmt->error);
// }

// Execute the query
// if (!$stmt->execute()) {
//     die("Error in execute: " . $stmt->error);
// }

// Get the result
$results2 = mysqli_query($conn, $sql);

// Fetch the data and add it to the array
while ($row2 = mysqli_fetch_assoc($results2)) {
    if ($row2['gen'] === "generic") {
        $gerenic[] = array("medicine" => $row2['medicine'], "price" => $row2['price']);
    }
}

// Close the statement for the current shop ID
// $stmt->close();
// }





$alterantives = [];

foreach ($druglist as $idx => $drugs) {
    // var_dump($drugs);
    $drug = $drugs[0];
    $dose = $drugs[1];
    $medNot = $drugs[2];
    $query3 = "SELECT drug, medicine, price FROM `$commonShopIds` WHERE drug = ? AND dose = ?";

    $stmt = $conn->prepare($query3);
    $stmt->bind_param("ss", $drug, $dose);
    $stmt->execute();
    $result2 = $stmt->get_result();

    while ($row3 = $result2->fetch_assoc()) {
        if ($row3['medicine'] !== $medNot) {
            $alterantives[] = [$medNot, $row3['medicine'], $row3['price']];
        }
    }
}

















// Calculate the total price and create a new array with desired data
$medicineDetails = array();
$totalPrice = 0.0;

foreach ($medicineData as $medicine) {
    $medicineQuantity = $medicine['Quantity'];
    $medicinePrice = $medicine['price'];
    $medicineTotalDiscount = $medicine['totaldiscount'];

    // Calculate the final price after applying the total discount
    if ($medicineTotalDiscount == 0 || $medicineTotalDiscount === "Null") {
        $medicineDiscount = $medicine['discount'];
    } else {
        $medicineDiscount = 0;
    }

    // Calculate the discounted price
    $discountedPrice = $medicinePrice - ($medicinePrice * $medicineDiscount / 100);

    // echo $discountedPrice;

    $finalPrice = $discountedPrice;


    // Add the medicine details to the new array
    $medicineDetails[] = array(
        "medicine" => $medicine['medicine'],
        "quantity" => $medicineQuantity,
        "price" => $medicine['price'],
        "discountedPrice" => $discountedPrice,
        // Discounted price
        "discount" => $medicine['discount'],
        "totaldiscount" => $medicineTotalDiscount,
    );

    // Add the price to the total price   
    $totalPrice += $finalPrice;

}

// Calculate the final price after applying the total discount
if ($medicineTotalDiscount != 0 && $medicineTotalDiscount != "Null") {
    // $finalPrice = max($discountedPrice - $medicineTotalDiscount, 0);
    if ($totalPrice >= $medicineTotalDiscount) {
        $totalPrice = $totalPrice - ($totalPrice * $medicine['discount'] / 100);
    }
}

// Create an array with the total price
$totalData = array(
    "totalPrice" => $totalPrice,
    "totalPrice2" => $sum,
);

// Combine the medicine details and the total price
$resultData = array(
    "medicineDetails" => $medicineDetails,
    "totalData" => $totalData,
    "generic" => $gerenic,
    "alternatives" => $alterantives,
);

// Encode the result as JSON
$resultJson = json_encode($resultData);

// Output the JSON
echo $resultJson;




// $json = json_encode($medData);
// echo $json;

?>