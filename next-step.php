<?php
session_start();

include_once("whatsapp.php");
include('connection.php'); //include_once was written
// require_once __DIR__ . "/vendor/autoload.php";

// --------- PHPMailer initialization ------------------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = 3; //uncomment to see the debuging
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "emailid";
$mail->Password = "password";
// ---------- PHPMailer initialization over ---------------


if(isset($_SESSION['login']) || $_SESSION['login'] === "110010"){
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}


$pid = $_GET['id'] ? $_GET['id'] : "";
// $field = $_GET['doc'] ? $_GET['doc'] : "";
// $field = str_replace("%20", " ", $field);
// echo $pid . " ". $field;

// fetching data for patient
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die("Failed");
    $data = mysqli_fetch_array($result);
    $hear = $data['total'];
    $patientname = $data['patientName'];
    $patientid = $data['patientid'];
}

// fetching the doctors list from login table
// if (isset($_GET['doc'])) {
    // $doctor = $_GET['doc'];
    $query1 = "SELECT * FROM login WHERE role='expert'";
    $query2 = "SELECT DISTINCT hospital FROM login WHERE role='expert'";
    // $query = "SELECT * FROM patientregistration";
    $list = mysqli_query($conn, $query1);
    $hospitallist = mysqli_query($conn, $query2);
    $expertlist = mysqli_num_rows($list);
// }


// fetching data for practitioner
$field = $data['treated_by'];
// echo $field;
if ($field !== "") {
    $sql = "SELECT * FROM login WHERE Name = '$field'";
    $pract = mysqli_query($conn, $sql) or die("Failed");
    $pract_detail = mysqli_fetch_array($pract);
    $pract_name = $pract_detail['Name'];
    $pract_wno = $pract_detail['whatsapp_no'];
    $pract_hosp = $pract_detail['hospital'];
    $salutation = $pract_detail['salute'];
}

// ------------------------consult button=> send mail------------------------------ 
if (isset($_POST['consult'])) {
    $_SESSION['token'] = "101";
    $Name = trim(substr($_POST['selectSpecialist'], 4));
    // echo $Name;
    $pf_stat = $data['stat']; //"Pending";
    $expertOpinion = "Pending";
    // $expertOpinion = "Not Taken";  //for testing only
    $expertname = $Name;
    $query = "UPDATE patientregistration SET stat='$pf_stat', expertOpinion='$expertOpinion', expertname='$expertname' WHERE patientid='$pid'";
    // $sql = "SELECT * FROM login WHERE Name = '$Name'";
    // $expert = mysqli_query($conn, $sql) or die("Failed");
    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $sql = "SELECT * FROM login WHERE Name = '$Name'";
    $expert = mysqli_query($conn, $sql) or die("Failed");
    $expert_details = mysqli_fetch_array($expert);
    $expert_email = $expert_details['email'];
    // $whats = "whatsapp:+91"; //$expert_no['whatsapp_no'];
    // $whats = "+91"; //"+91";
    // echo $expert_email;

    $body = "SMART-ER Alert\n\nA prompt has been generated for teleconsultation of a patient (Name: $patientname, UHID NO.: $patientid) seen at $pract_hosp. \n\nPossible STEMI\nHEAR Score: $hear \n\nPlease contact for further details.\n$salutation $pract_name \nContact: $pract_wno\nVisit SMART-ER Platform: https://healthtech.iitbhilai.ac.in/smart_er_v3/intro.php";

    $msgFile = fopen("file.txt", "w") or die("Unable to open file.");
    fwrite($msgFile, $body);
    fclose($msgFile);
    // $body = file_get_contents("file.txt");
    // print_r($body);

    //// send message to the expert doctor ------------ Twilio
    // $message = $twilio->messages
    //   ->create($whats, // to +91
    //     array(
    //       "from" => "+12", //"whatsapp:+14",          // this is for sms
    //       "body" => $body//"Hi Dheeraj, from twilio"
    //     )
    //   );
    // print($message->sid);

    //for mailing using PHPMailer --------------------- PHPMailer
    try{
        $mail->setFrom("emailid", "SMART-ER System");
        $mail->addAddress($expert_email, "Hub Doctor");
        $mail->Subject = "SMART-ER Alert";
        $mail->Body = $body;
        $mail->send();
    } catch (Exception $e) {
        "";
    }

    ////for mailing with php mailing ------------------ php mail()
    // var_dump(mail("emailid", " ", $body));

    ////CM.com method of sending sms ------------------ CM.com
    // $client = new \CMText\TextClient("api");
    // $msg = $client->SendMessage($body,'Smart-ER', ['']); //no reference is added
    // var_dump($msg);

    // echo '<script>alert('.'"An alert has been sent to Expert'."'s mail".'");</script>';
    header('Location: field-patient-list.php?token=1&doc='.$pract_name);
}


// ----------------------------modal actions----------------------------
$target_dir = "uploads/" . $pid . "/";
// Check if directory already exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
} else {
    // echo "Directory does not exist.";
}

// echo "uploads/" . $pid . "/" . $pid . ".txt";

if (isset($_POST['download'])) {
    $file = $_POST['prescibe'];
    // echo $file;
    $pres = fopen($target_dir . $pid . ".txt", "w") or die("Unable to open file.");
    fwrite($pres, $file);
    fclose($pres);
    // file_put_contents($pid.".txt", $file, FILE_APPEND);

    // $body = file_get_contents("uploads/" . $pid . "/" . $pid . ".txt");
    // var_dump($body);
    header('Location: download-field-pdf.php?id='.$pid);
}


$prescExpert = $data['expert_presc_path'];
$prescField = $data['prescription_path'];
$img_path = $data['ecgpath'];

if (isset($_POST['saveAdvice'])) {
    $_SESSION['token'] = "110";
    $diagnosis = $_POST['diagnosis'];
    $pres = $_POST['prescibe'];
    // echo $file;
    $file = fopen($target_dir . $pid . "_diagnosis.txt", "w") or die("Unable to open file.");
    fwrite($file, $diagnosis);
    fclose($file);

    $file = fopen($target_dir . $pid . "_field.txt", "w") or die("Unable to open file.");
    fwrite($file, $pres);
    fclose($file);
    // file_put_contents($pid.".txt", $file, FILE_APPEND);

    // $body = file_get_contents("uploads/" . $pid . "/" . $pid . ".txt");
    // var_dump($body);


    $pf_stat = "Completed";
    // $expertOpinion = "Not Taken";
    if($data['expertOpinion'] === "Pending"){
        $expertOpinion = "Not Taken";
    } else {
        $expertOpinion = $data['expertOpinion'];
    }
    $query = "UPDATE patientregistration SET stat='$pf_stat', expertOpinion='$expertOpinion' WHERE patientid='$pid'";
    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // send the control to save pdf and direct to field patient list
    header('Location: save-field-pdf.php?id='.$pid);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Smart-ER</title>
    <meta content="" name="descriptison">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/image_logo.png" rel="icon">
    <link href="assets/img/image_logo.png" rel="favicon">
    <link href="assets/img/IIT_Bhilai_logo.png" rel="logo">
    <link href="assets/img/Aims logo.png" rel="logo">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Moderna - v2.0.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  
    <!-- <style>
        .box {

            border: 2px solid;
            border-radius: 0.3em;
            padding-top: 20px;
            padding-bottom: 20px;
            margin: 5px;
        }
    </style> -->

    <style>
        .box {

            /* border: 2px solid; */
            border-radius: 0.3em;
            background-color: #fff;
            box-shadow: 2px 1px 4px;
            padding-top: 20px;
            padding-bottom: 20px;
            margin: 5px;
        }
    </style>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top" style="height: 70px;">
        <div class="container">

            <div class="logo float-left">
                <!-- <h1 class="text-light"><a href="#"><span>Smart-ER PLATFORM</span></a></h1> -->
                <h1 class="text-light"><a href="#">
            <img src="assets/img/Logo_IIT_Bhilai.png" height="50px" width="50px">
            <span>Smart-ER PLATFORM</span>
            <img src="assets/img/Aims logo.png" height="50px" width="50px">
          </a>
        </h1>
                <br>

                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>


            <nav class="nav-menu float-right d-none d-lg-block">
                <ul>
                    <li><a href="intro.php">Home</a></li>
                    <!-- about was attributed: class="active" -->
                    <li><a href="about.html">About</a></li>
                    <li><a href="blog.html">Contact Us</a></li>
                    <li><a href="logoutpage.php" >Logout</a></li>
                </ul>
            </nav>
        </div>
    </header><!-- End Header -->

    <section class="breadcrumbs" style="padding-top: 80px">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Field Login</h2>
                <!-- <ol>
                    <li><
                    a href="index.html">Home</a></li>
                    <li>Practitioner Login</li>
                </ol> -->
            </div>
        </div>
    </section>
    <!-- header and breadcrum section -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <!-- <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Practitioner Login</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>About</li>
                    </ol>
                </div>

            </div>
        </section> -->
        <!-- End About Us Section -->

        <!-- ======= About Section ======= -->
        <section class="about"> <!--data-aos="fade-up"> -->

            <div class="container">
                <div class="col p-0">
                    <div class="row">
                        <div class="col text-center">
                            <h4><strong>
                                Next Step
                            </h4></strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <h5 id="patientid" name="patientid" <?php // echo "readonly"; ?>><strong>Patient Id:
                                    <?php echo $pid; ?>
                                </strong></h5>
                            <br>
                        </div>
                    </div>  
                    <br>

                    <div class="row">
                        <!-- external column-1 -->
                        <div class="col-sm-6">

                            <!-- <div class="row"> -->
                                <!-- column-1 -->
                                <div class="row">
                                    <div class="col-lg text-center box">
                                        <div class="row text-center" style="margin-top: 15px;">
                                            <div class="col">
                                                <h5 id="patientid" name="patientid" <?php // echo "readonly"; ?>><strong>Patient Details
                                                    <?php //echo $pid; ?></strong>
                                                </h5>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <!-- <div class="col"><label for="clinical">View clinical details:</label></div> -->
                                            <div class="col">
                                                <input type="button" class="btn btn-primary" target="_blank" 
                                                    onclick="window.location.href='proforma-sum-expert.php?id=<?php echo !empty($pid) ? $pid : ''; ?>'"
                                                    id="clinical" style="width: 100%; max-width: 250px; border-radius: 0.0em; margin-top: 10px;" value="View clinical details">
                                                    <script>
                                                        document.getElementById("clinical").onclick = function () {
                                                            // Replace "https://www.example.com" with the URL of the page you want to open
                                                            window.open("proforma-summary2.php?id=<?php echo !empty($pid) ? $pid : ''; ?>", "_blank");
                                                            // proforma-sum-expert
                                                        };
                                                    </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- <div class="col"><label for="viewecg">View ECG:</label></div> -->
                                            <div class="col">
                                                <input type="button" class="btn btn-primary" name="Click" id="viewecg" 
                                                    style="width: 100%; max-width: 250px; border-radius: 0.0em; margin-top: 10px;"  value="View ECG">
                                                    <!-- target="_blank" onclick="window.location.href='uploads/421/421.jpg'" -->
                                                <script>
                                                    document.getElementById("viewecg").onclick = function () {
                                                        window.open("<?php echo $img_path; ?>", "_blank");
                                                        // window.open("<?php //echo "uploads/".$pid."/".$pid.".jpg" ?>", "_blank");
                                                    };
                                                </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- <div class="col"><label for="interview">View expert's prescription:</label></div> -->
                                            <div class="col">
                                                <input type="button" class="btn btn-primary" id="expert_prescription" 
                                                style="width: 100%; max-width: 250px; border-radius: 0.0em; margin-top: 10px;" target="_blank" 
                                                    <?php //echo $data['expertOpinion'] !== "Completed"? "disabled": "";?>
                                                    value="View expert's prescription">
                                                <script>
                                                    document.getElementById("expert_prescription").onclick = function () {
                                                        window.open("<?php echo $prescExpert; ?>", "_blank");
                                                        // uploads/421/.pdf?id=
                                                    };
                                                </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- <div class="col"><label for="interview">View your prescription:</label></div> -->
                                            <div class="col">
                                                <input type="button" class="btn btn-primary" id="field_prescription" style="width: 100%; max-width: 250px; border-radius: 0.0em; margin-top: 10px;" target="_blank" 
                                                    <?php echo $data['stat'] === "Pending"? "disabled": "";?> value="View your prescription">
                                                    <!-- onclick="window.location.href='uploads/421/patientdetails.pdf'"  -->

                                                <script>
                                                    document.getElementById("field_prescription").onclick = function () {
                                                        window.open("<?php echo $prescField; ?>", "_blank");
                                                        // uploads/421/421_field.pdf?id=
                                                    };
                                                </script>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col text-center box">
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col">
                                            <h5 ><strong>Clinical Algorithms</strong></h5>
                                            </div>
                                        </div>
                                        <!-- onclick="window.location.href='patient-register.html';"  -->
                                        <hr><br>
                                        <p >
                                            <a style="text-decoration: underline;" href="assets/STEMI algorithm.pdf" target="_blank">Click for initial management of STEMI</a>
                                        </p>
                                        <!-- <br> -->
                                        <p>
                                            <a style="text-decoration: underline;" href="assets/reperfusion decision.pdf" target="_blank">Click for deciding reperfusion therapy</a>
                                        </p>
                                            <!-- style="text-decoration: underline;" -->
                                        <br>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center box">
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col">
                                            <h5 ><strong>In case of thrombolysis find the proformas below</strong></h5>
                                            </div>
                                        </div>
                                        <!-- onclick="window.location.href='patient-register.html';"  -->
                                        <hr><br>
                                        <p>
                                                <a style="text-decoration: underline;" href="assets/Thrombolysis templates.pdf" target="_blank">Click for thrombolysis in STEMI</a>
                                        </p>
                                        <br>
                                        
                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>

                        <div class="col-sm-6">
                            <!-- column-2 -->
                            <div class="row">
                                <div class="col-lg text-center box">
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col">
                                        <h5 ><strong>Treatment Advice</strong></h5>
                                        </div>
                                    </div>
                                    <!-- onclick="window.location.href='patient-register.html';"  -->
                                    <hr><br>
                                    <p class="mt-5">
                                        For prescribing treament click the treatment advice below
                                    </p>
                                    <footer>
                                    <p style="margin-bottom: 64px;">
                                        <input type="button" id="treat" class="btn btn-warning"  style="width: 100%; max-width: 150px;"
                                            value="Treatment Advice" <?php echo ($data['stat'] === "Completed") ? "disabled" : "";?>
                                            data-toggle="modal" data-target="#prescribeAdvice" style="width: 200px;"></p>
                                            </footer>
                                            
                                </div>
                            </div>
                            

                            <!-- column-3 -->
                            <div class="row">
                                <div class="col-lg text-center box" style="margin-top:;">
                                    <form method="POST">
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col" >
                                            <h5><strong>Take Consultation</strong></h5>

                                            </div>
                                        </div>
                                        
                                        <hr><br>
                                        <p class="mt-2">
                                            
                                                <label for="hospital" class="mb-0">Select hospital:</label>
                                                <div class="row justify-content-center">
                                                <select name="hospital" id="hospital" class="form-control mt-0 mb-3" style="width: 100%; max-width: 200px;" required <?php echo ($data['expertOpinion'] === "Not Taken" && $data['stat'] === "Pending") ? "": "disabled";?>>
                                                        <option value="" selected>Select</option>
                                                        <?php
                                                        while ($hls = mysqli_fetch_assoc($hospitallist)) {
                                                            if ($hls['hospital']) {
                                                                echo '<option value="'.$hls['hospital'].'">'.$hls['hospital'].'</option>';
                                                            }
                                                        } 
                                                        ?>
                                                        <!-- <option value="AIIMS RAIPUR">AIIMS RAIPUR</option> -->
                                                        <option disabled value="District Hospital">District Hospital</option>
                                                        <option disabled value="Ambedkar Hospital">Ambedkar Hospital</option>
                                                    </select>
                                                </div>
                                                    
                                                
                                            
                                        </p>

                                        <p>
                                            <label for="selectSpecialist" class="mt-2 mb-0">Select Specialist:</label>
                                            <div class="row justify-content-center">
                                                <select name="selectSpecialist" id="selectSpecialist" <?php echo ($data['expertOpinion'] === "Not Taken" && $data['stat'] === "Pending") ? "": "disabled";?>
                                                    class="form-control  mt-0 mb-3" style="width: 100%; max-width: 200px;" required>
                                                    <option value="" selected>Select</option>
                                                    
                                                    <!-- // while ($ls = mysqli_fetch_assoc($list)) { -->
                                                    
                                                    <!-- // echo '<option value="Dr. '.$ls['Name'].'">Dr. '.$ls['Name'].'</option>' -->
                                                    <!-- ?> -->
                                                    <!-- <option value="Dr. Preeti Tiwari">Dr. Preeti Tiwari</option> -->
                                                    <!-- <option value="Dr. Naman Agrawal">Dr. Naman Agrawal</option> -->
                                                    <!-- <option disabled value="Dr. Chandan Kumar Dey">Dr. Chandan Kumar Dey</option>
                                                    <option disabled value="Dr. Varun Anand">Dr. Varun Anand</option>
                                                    <option disabled value="Dr. Santosh Rathia">Dr. Santosh Rathia</option>
                                                    <option disabled value="Dr.Pallavi Shende">Dr.Pallavi Shende</option> -->
                                                    <!-- <option disabled value="Oncall">Oncall</option> -->
                                                </select>
                                            </div>

                                        </p>
                                        
                                        <p>
                                            <input type="submit" id="consult" name="consult" class="btn btn-warning mt-2" style="width: 100%; max-width: 150px;"
                                            <?php echo ($data['expertOpinion'] === "Not Taken" && $data['stat'] === "Pending") ? "": "disabled";?>
                                                value="Consult an Expert">
                                            <!-- data-toggle="modal" data-target="#whatsapp" -->
                                        </p>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).ready(function() {
                                            $('#hospital').change(function() {
                                                var selectedHospital = $(this).val();

                                                // Make an AJAX request to get specialists based on the selected hospital
                                                $.ajax({
                                                    url: 'hospitaldoctor.php', // Replace with your PHP script's URL
                                                    type: 'POST',
                                                    data: { hospital: selectedHospital },
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        var specialistDropdown = $('#selectSpecialist');
                                                        specialistDropdown.empty();

                                                        // Add an empty option to keep the "null" option
                                                        specialistDropdown.append($('<option>', {
                                                            value: '', // Empty value
                                                            text: 'Select' // Display text
                                                        }));
                                                        
                                                        $.each(data, function(index, specialist) {
                                                            specialistDropdown.append($('<option>', {
                                                                value: specialist,
                                                                text: specialist
                                                            }));
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                        </script>
                                    </form>
                                    <br>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                    


                    <!-- Modal content -->
                    <!-- MODAL FOR  PRESCRIPTION-->
                    <div class="modal fade" id="prescribeAdvice" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                
                                    <p style="text-align: center;">
                                        <h5>Please mention your advice</h5>
                                        
                                    </p>
                                    <button type="button" class="close float-right" data-dismiss="modal">&times;</button>

                                </div>

                                <!-- <div method="post" style="box-sizing: 20px; padding: 2px;" class="box"> -->

                                <form method="POST">
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <label for="diagnosis"><strong>Details</strong></label>
                                                </div>
                                            </div>            
                                        
                                            <div class="row">
                                                <div class="col mt-3">
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-4 col-">
                                                            <label for="name"
                                                                style="text-align: left;">Name:</label>
                                                        </div>
                                                        <div class="col-lg-8 col- mb-2">
                                                            <label disabled type="text" id="name"
                                                                value=""><?php echo $data['patientName']; ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-">
                                                            <label for="uhid" style="text-align: left;">UHID No.:</label>
                                                        </div>
                                                        <div class="col-lg-8 col- mb-2">
                                                            <label disabled type="text" id="uhid"
                                                                value=""><?php echo $data['patientid']; ?></label>
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col-lg-4 col-">
                                                            <label for="age_sex"
                                                                style="text-align: center;">Age/Sex:
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-8 col- mb-2">
                                                            <label disabled type="text" id="age_sex"
                                                                value=""><?php echo $data['age'] . ' / ' . $data['gender']; ?></label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- <div class="col-1"></div> -->

                                                <div class="col mt-3">

                                                    <div class="row">
                                                        <div class="col-lg-4 col-">
                                                            <label for="date" style="text-align: right;">Date:
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-8 col- mb-2">
                                                            <label disabled type="text" id="date"
                                                                value=""><?php echo $data['date']; ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-">
                                                            <label for="time"
                                                                style="text-align: right;padding-right: 2px;">Time:

                                                        </div>
                                                        <div class="col-lg-8 col- mb-2">
                                                            <label disabled type="text" id="time"
                                                                value=""><?php echo $data['time']; ?></label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-4 col-">
                                                            <label for="Treated_by"
                                                                style="text-align: center;">Treated
                                                                by: </label>
                                                        </div>
                                                        <div class="col-lg-8 col- mb-2">
                                                            <label disabled type="text" id="treated_by"
                                                                value=""><?php echo $data['treated_by']; ?></label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                            
                                            <!-- <div class="col" style="text-align: center;"> -->
                                            <div class="col mt-3" style="text-align: center;">
                                                <label for="diagnosis"><strong>Diagnosis</strong></label>
                                            </div>
                                            <!-- <div class="col"> -->
                                                <textarea type="text" id="diagnosis" name="diagnosis" value=""  rows="5" 
                                                    style="resize: none; width: 100%;"
                                                    placeholder="Write your diagnostic here..."><?php echo isset($body) ? $body : ""; ?></textarea>
                                                    <!-- cols="70" -->
                                            <!-- </div> -->
                                            </div>

                                            <div class="row">
                                                <!-- <div class="col" style="text-align: center;"> -->
                                                <div class="col mt-3" style="text-align: center;">
                                                    <label for="prescibe"><strong>Advice</strong></label>
                                                </div>
                                                <!-- <div class="col"> -->
                                                    <textarea type="text" id="prescibe" name="prescibe" value=""  rows="10"  
                                                        style="resize: none;  width: 100%;"
                                                        placeholder="Write your prescription here..."><?php echo isset($body) ? $body : ""; ?></textarea>
                                                        <!-- cols="70" -->
                                                <!-- </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col mt-3 text-center">
                                                <button type="submit" id="download" name="download"
                                                        class="btn btn-warning" value="Save">Download</button>
                                                    <button type="submit" id="saveAdvice" name="saveAdvice"
                                                        class="btn btn-warning" value="Save"
                                                    onclick="window.location.href='patient-register.php?token=2';">Save</button>
                                                </div>
                                            </div>

                                        </div>
                                        

                                    </div>
                                    <!-- 

                                <script type="text/javascript">
                                    const expert_login = document.getElementById("expertLogin");
                                    const expert_userid = document.getElementById('userid');
                                    const expert_passwd = document.getElementById('password');

                                    expert_userid.addEventListener('keyup', (e) => {
                                        const value = e.currentTarget.value;
                                        expert_login.disabled = false;

                                        if (value === "") {
                                            expert_login.disabled = true;
                                        }
                                    });

                                    expert_passwd.addEventListener('keyup', (e1) => {
                                        const value1 = e1.currentTarget.value;
                                        expert_login.disabled = false;

                                        if (value1 === "") {
                                            expert_login.disabled = true;
                                        }
                                    });
                                </script> -->

                                    <style>
                                        #text-2676752626 {
                                            text-align: left;
                                            padding-left: 50px;
                                            padding-top: 15px;
                                            color: rgb(35, 35, 35);
                                        }

                                        #text-2676752626>* {
                                            color: rgb(35, 35, 35);
                                        }
                                    </style>
                                </form>
                            </div>

                            <!-- <div class="modal-footer"></div> -->
                        </div>
                    </div>



                </div>


                <!-- MODAL FOR WHATSAPP NOTIFICATION -->
                <div class="modal fade" id="whatsapp" role="dialog">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <p>
                                <h5>An alert has been sent to expert's whatsapp</h5>
                                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                </p>
                            </div>

                            <div class="modal-footer">
                                <!-- <span> -->

                                <button type="button" id="goback" class="btn btn-primary"
                                    value="Go back to registration"
                                    onclick="window.location.href='patient-register.php';">Go back to
                                    registration</button>
                            </div>
<!-- 
                            <script type="text/javascript">
                                const expert_login = document.getElementById("expertLogin");
                                const expert_userid = document.getElementById('userid');
                                const expert_passwd = document.getElementById('password');

                                expert_userid.addEventListener('keyup', (e) => {
                                    const value = e.currentTarget.value;
                                    expert_login.disabled = false;

                                    if (value === "") {
                                        expert_login.disabled = true;
                                    }
                                });

                                expert_passwd.addEventListener('keyup', (e1) => {
                                    const value1 = e1.currentTarget.value;
                                    expert_login.disabled = false;

                                    if (value1 === "") {
                                        expert_login.disabled = true;
                                    }
                                });
                            </script> -->

                            <style>
                                #text-2676752626 {
                                    text-align: left;
                                    padding-left: 50px;
                                    padding-top: 15px;
                                    color: rgb(35, 35, 35);
                                }

                                #text-2676752626>* {
                                    color: rgb(35, 35, 35);
                                }
                            </style>
                        </div>

                        <!-- <div class="modal-footer"></div> -->
                    </div>
                </div>

            </div>

            <br>
            <br>
            <br>
        </section>



        <!-- ======= Tetstimonials Section ======= -->


        <!-- ======= Footer ======= -->
        <!-- <footer id="footer" >
            <div class="container">
                <div class="copyright"> -->
        <!-- &copy; Copyright <strong><span></span></strong>. All Rights Reserved -->
        <!-- </div> -->
        <!-- <div class="credits"> -->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->
        <!-- Designed by -->
        <!-- <a href="https://bootstrapmade.com/">Bootstrapmade</a> -->
        <!-- </div>
                </div>
        </footer> -->
        <!-- End Footer -->

        <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/jquery/jquery.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>
        <script src="assets/vendor/venobox/venobox.min.js"></script>
        <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
        <script src="assets/vendor/counterup/counterup.min.js"></script>
        <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/aos/aos.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>
        <script>
            $(window).scroll(function () {
                if ($(window).scrollTop() > 100) {
                    // Calculate opacity based on scroll position
                    var opacity = 1 - ($(this).scrollTop() / 100); // Adjust the denominator to change the scroll sensitivity

                    // Ensure opacity stays within range [0, 1]
                    opacity = Math.min(Math.max(opacity, 0), 1);

                    // Set the opacity of the header
                    $('#header').css('opacity', opacity);
                } else {
                    $('#header').css('opacity', 1);
                }
            });
        </script>
        <style>
            @media (max-width: 575.98px) {
                #header span {
                    font-size: 12px;
                }

                #header img {
                    width: 10%;
                    height: auto;
                }
            }

            @media (min-width: 575.99) {
                #header img {
                    width: 20%;
                }
            }
        </style>
</body>

</html>