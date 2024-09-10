<?php
// echo "hello world"

$pidim = $_POST['pidim']; //_GET['id'];
// echo $pidim;
$img = $_POST['image'];
$folderPath = "capture/";

$image_parts = explode(";base64,", $img);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];

$image_base64 = base64_decode($image_parts[1]);
// $fileName = uniqid() . '.png';  

//the file name should be patient id + .png
$fileName = "$pidim" . ".png";  

$file = $folderPath . $fileName;
file_put_contents($file, $image_base64);

//run the ocr python script here
// $output = shell_exec('python hello.py');
// echo $output;


// print_r($fileName);

//pass the control to next webpage after execution of above code
header("Location: complaints.php?id=$pidim");
// exit;

?>