<?php
include ('connection.php'); //include_once was written
require_once './vendor/autoload.php';

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

session_start();

if (isset ($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}

$pid = $_GET['id'] ? $_GET['id'] : "";
$expert = $_GET['doc'] ? $_GET['doc'] : "";

$target_dir = __DIR__ . "/uploads/" . $pid . "/";
// check if the file does not exists
if (file_exists($target_dir . $pid . "_ex_impress.txt")) {
    $impress = file_get_contents($target_dir . $pid . "_ex_impress.txt");
} else {
    $impress = "NA";
}

$body = file_get_contents($target_dir . $pid . ".txt");

// Set the time zone to your desired value
date_default_timezone_set('Asia/Kolkata'); // Replace with your time zone

// Get the current time
$currentTime = time(); // Current timestamp

// $input = explode("000", $_GET['input']);
// print_r($input);
// $pid = $input[0];
$expert = str_replace("%20", " ", $expert);
// echo $pid . " " . $expert;


// $pid = $_GET['id'] ? $_GET['id'] : "";
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die ("Failed");
    $data = mysqli_fetch_array($result);

    $treated_by = $data['treated_by'];
    $sql1 = "SELECT * FROM login WHERE Name = '$treated_by'";
    $result1 = mysqli_query($conn, $sql1) or die ("Failed");
    $data1 = mysqli_fetch_array($result1);
    $pract_email = $data1['email'];
    // echo $data1['hospital'];

}


if ($expert !== "") {
    // $expert = $_GET['expert'];
    $query = "SELECT * FROM login WHERE Name = '$expert'";
    $expert_ = mysqli_query($conn, $query) or die ("Failed");
    $expert_detail = mysqli_fetch_array($expert_);
}

if ($data['expertOpinion'] === "Completed") {
    header("Location: patient-list.php");
}



$query2 = "SELECT DISTINCT drug FROM medicines";
$medlist = mysqli_query($conn, $query2);
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include ("connection.php");
// $pid = $_GET['id'];
if (isset ($_POST['exAdviceSave'])) {
    $_SESSION['token'] = "110";
    // $pf_stat = "Completed";
    $expertOpinion = "Completed";
    $date = $_POST['date'];
    $time = $_POST['time'];


    $impress = $_POST['impress'];
    $pres = fopen($target_dir . $pid . "_ex_impress.txt", "w") or die ("Unable to open file.");
    fwrite($pres, $impress);
    fclose($pres);

    $file = $_POST['prescribe'];
    $pres = fopen($target_dir . $pid . "_ex_px.txt", "w") or die ("Unable to open file.");
    fwrite($pres, $file);
    fclose($pres);





    $query = "UPDATE patientregistration SET    expertDate='$date',
                                                expertTime='$time',
                                                expertOpinion='$expertOpinion'
                                                WHERE patientid='$pid'";
    // -- stat='$pf_stat' 

    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }


    // header line should be written inside the isset() condition
    // header("Location: patient-list.php");
    // echo $query;


    $exname = $expert_detail['Name'];
    $exhospital = $expert_detail['hospital'];
    $exno = $expert_detail['phone_no'];
    // send mail
    $msg = "SMART-ER Alert
            \n\nA prescription has been suggested by Dr. $exname at $exhospital.
            \n\nVisit the SMART-ER Platform to view the prescription. contact the expert for further details at 
            \n\nMobile no.: $exno
            \n\nVisit SMART-ER Platform: https://healthtech.iitbhilai.ac.in/smart_er_v3/intro.php";

    $mail->setFrom("email", "SMART-ER System");
    $mail->addAddress($pract_email, "Field Doctor");

    // Attach the PDF
    // $pdfFilePath = $target_dir;

    // if (copy($target_dir. $pid . '.pdf', "./".$pid . '.pdf')) {
    //     echo "The file is copied";
    // } else {
    //     echo 'File not copied.';
    // }

    // $file = file_get_contents($target_dir. $pid . '.pdf');
    // $mail->addAttachment($target_dir, $pid . '.pdf');
    // $mail->addAttachment();

    // echo $msg."\n\n\n".$file;
    $mail->Subject = "SMART-ER Alert";
    $mail->Body = $msg;
    $mail->send();
    // echo $body;
    // echo $pract_email;
    // unlink("./".$pid . '.pdf');  //commented because there is no such file or directory

    header("Location: save-expert-pdf.php?id=" . $pid . "&doc=" . $exname);


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- <meta name="viewport" content="width=1024"> -->


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
                <!-- <h1 class="text-light"><a href="#"><span>SMART-ER PLATFORM</span></a></h1> -->
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
                    <li><a href="logoutpage.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header><!-- End Header -->

    <section class="breadcrumbs" style="padding-top: 80px">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Expert Login</h2>
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
                    <h2>Expert Login</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Expert Login</li>
                    </ol>
                </div>

            </div>
        </section> -->
        <!-- End About Us Section -->

        <!-- ======= About Section ======= -->
        <section class="about"> <!--data-aos="fade-up"> -->

            <div class="container">
                <form method="post">

                    <div class="col box">
                        <!-- style="border: 2px solid black; border-radius: 0.3em;"> -->
                        <div class="row" style="margin-top: 20px;">
                            <div class="col text-center">
                                <span>
                                    <h4>Expert advice on tele-consult through SMART-ER platform</h4>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <p style="text-align: right;">
                            <label for="date" value="">
                                Date:
                                <?php echo date('d-m-Y'); ?>
                            </label>
                            <input type="hidden" id="date" name="date" value="<?php echo date('d-m-Y'); ?>">

                            <br>
                            <label for="date" value="">
                                Time:
                                <?php echo date('g:i A', $currentTime); ?>
                                <span id="time" name="time" value=""></span>
                            </label>
                            <input type="hidden" id="time" name="time"
                                value="<?php echo date('g:i A', $currentTime); ?>">
                        </p>

                        <!-- <p style="text-align: center;">
                            for</p> -->













































                        <div class="row justify-content-center">
                            <div class="col-md-10 col-12">
                                <div class="row">
                                    <div class="col mt-2">

                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="name" style="text-align: left;">Patient Name:</label>
                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <?php $salutation = ($data['gender'] === "Male") ? "Mr. " : "Miss "; ?>
                                                <label disabled type="text" id="name" value="">
                                                    <?php echo $salutation . $data['patientName']; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="uhid" style="text-align: left;">UHID No.:</label>
                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <label disabled type="text" id="uhid" value="">
                                                    <?php echo $data['patientid']; ?>
                                                </label>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="age_sex" style="text-align: center;">Age/Sex:
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <label disabled type="text" id="age_sex" value="">
                                                    <?php echo $data['age'] . ' / ' . $data['gender']; ?>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <div class="col-1"></div> -->

                                    <div class="col mt-2">

                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="Treated_by" style="text-align: center;">Treated
                                                    by: </label>
                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <label disabled type="text" id="treated_by" value="">
                                                    <?php echo $data1['salute'] . " " . $data['treated_by']; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="hospital" style="text-align: right;">Hospital:</label>
                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <label disabled type="text" id="hospital" value="">
                                                    <?php echo $data1['hospital']; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-4">
                                    <div class="col mt-2">
                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="name" style="text-align: left;">Expert
                                                    Name:</label>
                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <?php $salutation = ($data['gender'] === "Male") ? "Mr. " : "Miss "; ?>
                                                <label disabled type="text" id="name" value="">
                                                    <?php echo $expert_detail['salute'] . " " . $expert_detail['Name']; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="uhid" style="text-align: left;">MCI reg. no.:
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <label disabled type="text" id="uhid" value="">
                                                    <?php echo $expert_detail['Council_registration']; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-2">
                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="age_sex" style="text-align: center;">Designation:
                                                </label>
                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <label disabled type="text" id="age_sex" value="">
                                                    <?php echo $expert_detail['speciality']; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-">
                                                <label for="hospital" style="text-align: right;">Hospital:

                                            </div>
                                            <div class="col-lg-8 col- mb-2">
                                                <label disabled type="text" id="hospital" value="">
                                                    <?php echo $expert_detail['hospital']; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


























                        <!-- <p> -->
                        <!-- Expert’s name, MCI reg. no, designation, Hospital -->
                        <!-- <strong> -->
                        <?php //echo "Dr. " . $expert_detail['Name'] . ", MCI reg. no.: " . $expert_detail['Council_registration'] . ", Designation: " . $expert_detail['speciality'] . ", Hospital: " . $expert_detail['hospital'];                ?>
                        <!-- </strong> -->
                        <!-- Expert's Name:  -->
                        <!-- </p> -->
                        <p>
                        <h5 style="text-align: center;">
                            <strong>Expert impression</strong>
                        </h5>
                        <div class="row">
                            <div class="col">
                                <p style="text-align: center;">
                                    <textarea id="impress" name="impress" rows="5" val=""
                                        style="resize: none;  border-radius: 0.3em; width: 100%;"
                                        placeholder="Write your impression here..."
                                        value=""><?php echo $impress; ?></textarea>
                                    <!-- cols="70" -->
                                </p>
                            </div>
                        </div>

                        </p>
                        <h5 style="text-align: center;">
                            <strong>Expert advice
                            </strong>
                        </h5>
                        <p style="text-align: center;">
                            <textarea id="prescribe" name="prescribe" rows="20" val=""
                                style="resize: none;  border-radius: 0.3em; width: 100%;"
                                placeholder="Write your prescription here..."
                                value=""><?php //echo isset ($body) ? $body : "";     ?></textarea>
                            <!-- cols="70" -->

                        </p>
                        <hr>
                        <p style="text-align: center;">
                            <strong>
                                Disclaimer:
                                This advice is given based on tele-consultation. The discretion of the attending
                                physician
                                will be final.
                                <!-- Disclaimer: This advice is meant to guide the treating physician in
                            managing the patient in resource-limited settings.
                            This should not be taken as a prescription. The treating physician may use his/her
                            discretion for treatment -->
                            </strong>
                        </p>

                        <br>

                    </div>
                    <div class="col text-center" style="margin-top: 10px;">
                        <!-- <input type="button" id="exAdviceEdit" class="btn btn-warning btn-lg"
                            onclick="window.location.href='expert-options.html';" value="Edit"> -->
                        <input type="submit" id="exAdviceSave" class="btn btn-warning btn-lg" name="exAdviceSave"
                            value="Save">
                        <!-- onclick="window.location.href='patient-list.php';"  -->
                </form>
            </div>


            </div>
        </section>



        <!-- ======= Tetstimonials Section ======= -->


        <!-- ======= Footer ======= -->
        <!-- <footer id="footer">
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