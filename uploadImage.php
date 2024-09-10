<?php

// Check if file is uploaded
if(isset($_FILES['formData']) && $_FILES['formData']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['formData'];
    $fileName = $file['name'];
    $tmpName = $file['tmp_name'];

    $image_parts = explode(";base64,", $file);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $tempName = $image_parts[1];
    // Send the image file to Flask server
    sendImageToFlask($fileName, $tmpName);
} else {
    echo "Error uploading file to the php server.";
}

// Function to send image to Flask server using cURL
function sendImageToFlask($fileName, $tmpName) {
    // URL of the Flask server
    $url = 'http://10.10.54.231:9080/perform-ocr';

    // Create a cURL handle
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'image' => new CURLFile($tmpName)  //, 'image/jpeg', $fileName
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set CORS headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Origin: https://10.10.54.231/smart_er_v3/show-vitals.php', // Replace with your PHP server domain
    ]);

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if(curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }

    // Close cURL handle
    curl_close($ch);

    // Output response from Flask server
    echo $response;
}
