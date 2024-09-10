<!-- autofill -->

<?php
// include_once('connection.php');
// $id = $_GET['id'];
// $sql = "SELECT * FROM patientregistration WHERE patientid = $id";
// $result = mysqli_query($conn, $sql) or die("Failed");
// $data = mysqli_fetch_array($result);
// print_r($data['gender']);
?>

<!-- tesseract example -->
<?php

// Replace 'path_to_tesseract_executable' with the actual path to the Tesseract executable
define('TESSERACT_EXECUTABLE', 'path_to_tesseract_executable');

// Check if the image file was uploaded successfully
if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    die('Error uploading file.');
}

// Move the uploaded file to a temporary location
$uploadedFile = $_FILES['image']['tmp_name'];

// Execute Tesseract OCR on the image
$output = shell_exec(TESSERACT_EXECUTABLE . ' ' . $uploadedFile . ' stdout');

// Output the recognized text
echo $output;
?>


<!DOCTYPE html>
<html>

<head>
    <title>OCR Web App</title>
    <script>
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault();

            const fileInput = document.getElementById('image');
            const file = fileInput.files[0];
            const formData = new FormData();

            formData.append('image', file);

            fetch('process_ocr.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.text())
                .then(text => {
                    document.getElementById('result').innerText = text;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</head>

<body>
    <h1>OCR Web App</h1>
    <form action="process_ocr.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <input type="submit" value="Upload and Recognize">
    </form>
    <div id="result"></div>
    <!-- <script src="script.js"></script> -->
</body>

</html>