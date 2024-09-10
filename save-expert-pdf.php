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

// $pid = $_GET['id'];
$pid = $_GET['id'] ? $_GET['id'] : "";
$expert = $_GET['doc'] ? $_GET['doc'] : "";

if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die("Failed");
    $data = mysqli_fetch_array($result);

    $field = $data['treated_by'];
    $sql1 = "SELECT * FROM login WHERE Name = '$field'";
    $result1 = mysqli_query($conn, $sql1) or die("Failed");
    $data1 = mysqli_fetch_array($result1);

}


if ($expert !== "") {
    // $expert = $_GET['expert'];
    $query = "SELECT * FROM login WHERE Name = '$expert'";
    $expert_ = mysqli_query($conn, $query) or die("Failed");
    $expert_detail = mysqli_fetch_array($expert_);
    // $expert_name = $expert_detail['Name'];
    // $expert_wno = $expert_detail['whatsapp_no'];
    // echo $expert_name;
}

$impress = file_get_contents("uploads/" . $pid . "/" . "impress.txt");
// Convert newline characters to HTML line breaks
$impress = nl2br($impress);

$body = file_get_contents("uploads/" . $pid . "/" . $pid . ".txt");
// Convert newline characters to HTML line breaks
$body = nl2br($body);

// echo $body;
// Load the content of the PHP file
$phpFileContent = file_get_contents("expert-prescription.php");
$phpFileContent = str_replace( ["{{ patientName }}", 
                                "{{ patientid }}", 
                                "{{ age/sex }}", 
                                "{{ date }}", 
                                "{{ time }}",
                                "{{ hospital }}", 
                                "{{ treated_by }}", 
                                "{{ expertname }}",
                                "{{ mcino }}",
                                "{{ speciality }}",
                                "{{ experthospital }}",
                                "{{ impression }}",
                                "{{ prescription }}"],
    
                                [$data['patientName'], 
                                $data['patientid'], 
                                $data['age'] . "/" . $data['gender'], 
                                $data['expertDate'], 
                                $data['expertTime'], 
                                $data1['hospital'], 
                                $data['treated_by'], 
                                $expert_detail['Name'], 
                                $expert_detail['Council_registration'], 
                                $expert_detail['speciality'],
                                $expert_detail['hospital'],
                                $impress, 
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
    $outputFilename = $pid . '_expert.pdf';

    // Ensure the output folder exists
    if (!is_dir($outputPath)) {
        mkdir($outputPath, 0777, true);
    }

    $pdfContent = $dompdf->output();

    // Save the generated PDF to the specified output folder on the server
    file_put_contents($outputPath . $outputFilename, $pdfContent);

    $targetFile = "uploads/" . $pid . "/" . $outputFilename;
    // store the path of the expert prescription
    $query = "UPDATE patientregistration SET expert_presc_path='$targetFile' WHERE patientid='$pid'";
    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // echo "Everything is working fine.";
    // $dompdf->stream($outputPath . $outputFilename, ["Attachment" => 1]);

    // Set appropriate headers to trigger the download on the client side
    // header('Content-Type: application/pdf');
    // header('Content-Disposition: attachment; filename="' . $outputFilename . '"');
    // header('Content-Length: ' . strlen($pdfcontent));
    // echo $pdfContent;
    //. filesize($outputPath . $outputFilename));
    // readfile($outputPath . $outputFilename);

    // Exit to prevent any additional output

    header('Location: patient-list.php?id=' . $pid . "&doc=" . $expert_detail['Name']);
    exit();
    // Use JavaScript to trigger redirection after a delay
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>