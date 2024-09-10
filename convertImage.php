<?php
// Load the PNG image
$pngFilePath = 'capture/p90.png'; // Replace with the path to your PNG image
$pngImage = imagecreatefrompng($pngFilePath);

if ($pngImage !== false) {
    // Define the output JPEG file path
    $jpgFilePath = 'p90.jpg'; // Replace with the desired output path

    // Convert and save the image as JPEG
    imagejpeg($pngImage, $jpgFilePath, 100); // 100 is the JPEG quality (0-100)

    // Free up memory by destroying the image resources
    imagedestroy($pngImage);

    echo "PNG image converted to JPG successfully!";
} else {
    echo "Failed to load the PNG image.";
}
?>
