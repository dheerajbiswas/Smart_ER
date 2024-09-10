<?php
include("connection.php"); //include_once was written

require __DIR__ . "/vendor/autoload.php";
use Dompdf\Dompdf;
use Dompdf\Options;

// Initialize Dompdf options
$options = new Options();
$options->set('chroot', __DIR__);
$options->set("isHtml5ParserEnabled", true);
$options->set("isPhpEnabled", true);

$dompdf = new Dompdf($options);
echo "Testing dompdf converter";

$dompdf->setPaper("A4", "portrait");

$pid = $_GET['id'];
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die("Failed");
    $data = mysqli_fetch_array($result);
    // $hear = $data['total'];
    // echo $hear;

    $field = $data['treated_by'];
    $sql1 = "SELECT * FROM login WHERE Name = '$field'";
    $result1 = mysqli_query($conn, $sql1) or die("Failed");
    $data1 = mysqli_fetch_array($result1);
}

$diagnosis = file_get_contents("uploads/" . $pid . "/". $pid . "_diagnosis.txt");
// Convert newline characters to HTML line breaks
$diagnosis = nl2br($diagnosis);

$body = file_get_contents("uploads/" . $pid . "/" . $pid . "_field.txt");
// Convert newline characters to HTML line breaks
$body = nl2br($body);

// echo $body;
// Load the content of the PHP file
$phpFileContent = file_get_contents("field-prescription.php");
// $phpFileContent = str_replace(
//     ["{{ patientName }}", "{{ patientid }}", "{{ age/sex }}", "{{ date }}", "{{ time }}", "{{ treated_by }}", "{{ prescription }}"],
//     [$data['patientName'], $data['patientid'], $data['age'] . "/" . $data['gender'], $data['date'], $data['time'], $data['treated_by'], $body],
//     $phpFileContent
// );
$phpFileContent = str_replace(  ["{{ patientName }}", 
                                "{{ patientid }}", 
                                "{{ age/sex }}", 
                                "{{ date }}", 
                                "{{ time }}", 
                                "{{ treated_by }}", 
                                "{{ hospital }}",
                                "{{ diagnosis }}",
                                "{{ prescription }}"],
                                [$data['patientName'], 
                                $data['patientid'], 
                                $data['age'] . "/" . $data['gender'], 
                                $data['date'], 
                                $data['time'], 
                                $data['treated_by'], 
                                $data1['hospital'], 
                                $diagnosis, 
                                $body],
                                $phpFileContent
);

// Load the HTML content into Dompdf
$dompdf->loadHtml($phpFileContent);

try {
    // Generate the PDF
    $dompdf->render();
    // Set the output path and filename for the generated PDF on the server
    // $outputPath = __DIR__ . '/pdf_output/';
    $outputPath = __DIR__ . "/uploads/" . $pid . "/";
    $outputFilename = $pid . '.pdf';

    // Ensure the output folder exists
    if (!is_dir($outputPath)) {
        mkdir($outputPath, 0777, true);
    }

    $pdfContent = $dompdf->output();

    // Save the generated PDF to the specified output folder on the server
    file_put_contents($outputPath . $outputFilename, $pdfContent);

    // echo "Everything is working fine.";
    // $dompdf->stream($outputPath . $outputFilename, ["Attachment" => 1]);
    // $dompdf->stream($outputPath . $outputFilename,  array('Attachment' => true));

    // Set appropriate headers to trigger the download on the client side
    // header('Content-Type: application/pdf');
    // header('Content-Disposition: attachment; filename="' . $outputFilename . '"');
    // header('Content-Length: ' . strlen($pdfcontent));

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $outputFilename . '"');
    header('Content-Length: ' . strlen($pdfContent));
    // echo $pdfContent;
    // . filesize($outputPath . $outputFilename));
    // readfile($outputPath . $outputFilename);

    // Exit to prevent any additional output

    // header('Location: patient-register.php?token=2');
    // header('Refresh: 3; url=patient-register.php?token=2');
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>