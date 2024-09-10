<?php
session_start();

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


error_reporting(E_ALL);
ini_set('display_errors', 1);

include ("connection.php");
//error_reporting(0);
// $pid = $_GET['id'] ? $_GET['id']:"";

// $query = "SELECT * FROM patientregistration";
// $data = mysqli_query($conn, $query);

// $data = mysqli_num_rows($data);


if (isset ($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}

$pid = $_GET['id'] ? $_GET['id'] : "";
// $field = $_GET['doc'] ? $_GET['doc'] : "";

// $field = str_replace("%20", " ", $field);
// echo $pid . " ". $field;

if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die ("Failed");
    $data = mysqli_fetch_array($result);
    $hear = $data['total'];
    $patientname = $data['patientName'];
    $patientid = $data['patientid'];
    $field = $data['expertname'];
    $img_path = $data['ecgpath'];

    // echo $hear;
}

if ($data['expertOpinion'] === "Completed") {
    header("Location: intro.php");
}
// print_r($data['gender']);

if ($field !== "") {
    // $field = $_GET['field'];
    $sql = "SELECT * FROM login WHERE Name = '$field'";
    $pract = mysqli_query($conn, $sql) or die ("Failed");
    $pract_detail = mysqli_fetch_array($pract);
    $pract_name = $pract_detail['Name'];
    $pract_wno = $pract_detail['whatsapp_no'];
    $pract_hosp = $pract_detail['hospital'];
    $pract_email = $pract_detail['email'];
    // echo $pract_wno;
}

// var_dump($_SESSION['items']);

$target_dir = "uploads/" . $pid . "/";
// Check if directory already exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
} else {
    // echo "Directory does not exist.";
}

// echo "uploads/" . $pid . "/" . $pid . ".txt";
// echo $file;
if (isset ($_POST['saveAdvice'])) {

    // $_SESSION['items'] = $_POST['items'];
    // echo $_SESSION['items'];
    // echo $_POST['remarks'];
    // echo '<script>console.log("done");</script>';
    // echo "uploads/".$pid."/".$pid.".txt";
    $impress = $_POST['impression'];

    $pres = fopen($target_dir . $pid . "_ex_impress.txt", "w") or die ("Unable to open file.");
    fwrite($pres, $impress);
    fclose($pres);

    $file = $_POST['prescribe'];
    // echo $file;

    $pres = fopen($target_dir . $pid . "_ex_px.txt", "w") or die ("Unable to open file.");
    fwrite($pres, $file);
    fclose($pres);
    // ./uploads/".$pid."/".
    // file_put_contents($pid.".txt", $file, FILE_APPEND);

    // $body = file_get_contents("uploads/" . $pid . "/" . $pid . ".txt");
    // var_dump($body);
    // echo $impress;
    // echo $file;
    header('Location: expert-advice-summary.php?id=' . $pid . "&doc=" . $pract_name);
}


if (isset ($_POST['send'])) {
    $body = "SMART-ER ALERT\n\n Below is the interview for the patient Name:$patientname UHID No.:$patientid.\n\n" . $_POST['link'] . "\n\n Below are the Expert contact details:\nExpert: Dr. " . $pract_name . "\nWhatsapp No.: " . $pract_wno;
    $mail->setFrom("email", "SMART-ER System");
    $mail->addAddress($pract_email, "Field Doctor");
    // echo $body;
    $mail->Subject = "SMART-ER Alert";
    $mail->Body = $body;
    // $mail->send();
    // header("Refresh: 0.1;");
}




// $medicines = array();
// $medicines = ['Aspirin 100mg', 'Clopitru 75mg', 'tenetase 20mg Vial', 'Heparin 25000iu Vial'];

// $shoplist = array();

// $sql = "SELECT storename, location FROM medicallogin WHERE drug = 'Aspirin'";
// // $medicals = mysqli_query($conn, $sql) or die("Failed");
// // $medicals_detail = mysqli_fetch_assoc($medicals);

// // Query to fetch table names from TableList
// $sql = "SELECT shopno FROM medicallogin";
// $result = mysqli_query($conn, $sql) or die ("Failed");
// // print_r($result->fetch_assoc()['username']);
// if ($result) {
//     $unionQuery = "";

//     // Construct the UNION query dynamically
//     while ($row = mysqli_fetch_assoc($result)) {
//         $tableName = $row['shopno'];
//         $unionQuery .= "SELECT * FROM $tableName  WHERE drug = '$medicines[0]' UNION ALL ";
//     }

//     // Remove the trailing "UNION ALL" from the query
//     $unionQuery = rtrim($unionQuery, " UNION ALL ");
//     // $unionQuery .=  " WHERE drug = '$medicines[0]'" ;

//     // echo $unionQuery;

//     // Execute the UNION query
//     // $finalResult = $mysqli->query($unionQuery);
//     $finalResult = mysqli_query($conn, $unionQuery) or die ("Failed");

//     if ($finalResult) {
//         // Process and display the results
//         // while ($row = mysqli_fetch_assoc($finalResult)) {
//         //     // Process and display row data
//         //     print_r($row);
//         //     echo "<br>";
//         // }
//     } else {
//         // echo "Error executing UNION query: " . $mysqli->error;
//     }
// } else {
//     // echo "Error fetching table names: " . $mysqli->error;
// }


// $query2 = "SELECT DISTINCT drug FROM medicines";
// $medlist = mysqli_query($conn, $query2);
// $medicinelist = mysqli_num_rows($medlist);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- <meta name="viewport" content="width=1024">  -->

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

            </div> -->
        </section>
        <!-- End About Us Section -->

        <!-- ======= About Section ======= -->
        <section class="about"> <!--data-aos="fade-up"> -->

            <div class="container">
                <div class="row">
                    <div class="col">
                        <!-- <div class="row"> 
                        <div class="col text-center" style="border: 1px solid black; ; ">
                            <span>
                                <h4>Presenting Complaints</h4>
                            </span>
                        </div>
                    </div>
                    <br><br> -->
                        <div class="row text-center">
                            <div class="col">
                                <h4 id="patientname" name="patientname" <?php // echo "readonly";?>><strong>
                                        <?php echo $patientname; ?>
                                    </strong></h4>
                                <h4 id="patientid" name="patientid" <?php // echo "readonly";?>><strong>Patient Id:
                                        <?php echo $pid; ?>
                                    </strong></h4>
                                <br>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 box">
                                <div class="row">
                                    <div class="col m-2">
                                        <label for="clinical">Click to view clinical details:</label>
                                    </div>
                                    <div class="col m-2">
                                        <p>
                                            <input type="button" target="_blank" class="btn btn-primary"
                                                onclick="window.location.href='proforma-summary2.php?id=<?php echo !empty ($pid) ? $pid : ''; ?>'"
                                                id="clinical" style="width: 250px;" value="Click">
                                            <!-- proforma-sum-expert -->
                                            <script>
                                                document.getElementById("clinical").onclick = function () {
                                                    // Replace "https://www.example.com" with the URL of the page you want to open
                                                    window.open("proforma-summary2.php?id=<?php echo !empty ($pid) ? $pid : ''; ?>", "_blank");
                                                };
                                            </script>

                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col m-2">
                                        <label for="viewecg">Click to view ECG:</label>
                                    </div>
                                    <div class="col m-2">
                                        <p>
                                            <input type="button" name="Click" id="viewecg" style="width: 250px;"
                                                data-toggle="modal" class="btn btn-primary" data-target="#Click"
                                                value="Click">
                                        </p>
                                        <script>
                                            document.getElementById("viewecg").onclick = function () {
                                                window.open("<?php echo $img_path; ?>", "_blank");
                                            };
                                        </script>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m-2">
                                        <label for="interview">Send a link for interview:</label>
                                    </div>
                                    <div class="col m-2">
                                        <form method="POST">
                                            <p> <input type="text" name="link" id="interview" style="width: 250px;"></p>
                                            <p> <input type="submit" id="interview" name="send" value="Click"
                                                    class="btn btn-primary"></p>
                                            <!-- data-toggle="modal" data-target="#notify" -->
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col m-2">
                                        <label for="impression">Your impression:</label>
                                    </div>
                                    <div class="col m-2">
                                        <form method="POST">
                                            <p> <textarea type="text" id="impression" name="impression" value=""
                                                    rows="4" style="resize: none; width: 250px;"></textarea>
                                            </p>
                                            <!-- style="width: 250px;" cols="27"-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <input type="submit" id="saveAdvice" name="saveAdvice"
                                            class="btn btn-warning btn-lg" style="margin-top:10px;" data-toggle="modal"
                                            data-target="#expertAdvice" value="Expert Advice">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Modal content -->
                        <!-- MODAL FOR EXPERT LOGIN -->
                        <div class="modal fade" id="expertAdvice_" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <p>
                                        <h5>Please mention your advice</h5>
                                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                        </p>


                                    </div>
                                    <!-- <form method="POST"> -->

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-5">

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="name"
                                                            style="text-align: left;padding: 5px;">Name:</label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="name" value="">
                                                            <?php echo $data['patientName']; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="uhid" style="text-align: left;padding: 5px;">UHID
                                                            No.:
                                                        </label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="uhid" value="">
                                                            <?php echo $data['patientid']; ?>
                                                        </label>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col">
                                                        <label for="age_sex"
                                                            style="text-align: center;padding: 5px;">Age/Sex:
                                                        </label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="age_sex" value="">
                                                            <?php echo $data['age'] . ' / ' . $data['gender']; ?>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-1">
                                            </div>

                                            <div class="col-6">

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="date" style="text-align: right;padding: 5px;">Date:
                                                        </label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="date" value="">
                                                            <?php echo $data['date']; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="time"
                                                            style="text-align: right;padding: 5px;padding-right: 2px;">Time:

                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="time" value="">
                                                            <?php echo $data['time']; ?>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Treated by"
                                                            style="text-align: center;padding: 5px;">Treated
                                                            by: </label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="treated_by" value="">
                                                            <?php echo $pract_detail['salute'] . " " . $field; ?>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col" style="text-align: center;">
                                                <textarea id="prescribe" name="prescribe" cols="70" rows="20"
                                                    style="resize: none;" placeholder="Write your prescription here"
                                                    value=""></textarea>
                                                <?php //echo isset($body) ? $body : "";            ?>
                                            </div>
                                        </div>


















































                                        <br>
                                        <div class="row">
                                            <div class=" col text-center">
                                                <button type="submit" id="saveAdvice" name="saveAdvice_"
                                                    class="btn btn-warning" value="Save">Save</button>
                                                <!-- onclick="window.location.href='expert-advice-summary.php?id=<?php //echo $pid;           ?>';" -->
                                            </div>
                                        </div>


                                        <script type="text/javascript">
                                            const expert_login = document.getElementById("expertLogin");
                                            const expert_userid = document.getElementById('userid');
                                            const expert_passwd = document.getElementById('password');

                                            // expert_userid.addEventListener('keyup', (e) => {
                                            //     const value = e.currentTarget.value;
                                            //     expert_login.disabled = false;

                                            //     if (value === "") {
                                            //         expert_login.disabled = true;
                                            //     }
                                            // });

                                            // expert_passwd.addEventListener('keyup', (e1) => {
                                            //     const value1 = e1.currentTarget.value;
                                            //     expert_login.disabled = false;

                                            //     if (value1 === "") {
                                            //         expert_login.disabled = true;
                                            //     }
                                            // });
                                        </script>

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
                                    </form>

                                    <!-- <div class="modal-footer"></div> -->
                                </div>
                            </div>
                        </div>




                        <!-- MODAL FOR EXPERT LOGIN -->
                        <div class="modal fade" id="notify" role="dialog">
                            <div class="modal-dialog">
                                <!-- modal-lg"> -->
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <p>
                                        <h5>Interview</h5>
                                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                        </p>


                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col" style="text-align: center;">
                                                <!-- <textarea cols="50" rows="20" style="resize: none;"></textarea> -->
                                                <p>The link has been sent to the field user</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class=" col text-center">
                                                <button type="button" id="sendlink" name="sendlink"
                                                    class="btn btn-warning" value="Save"
                                                    data-dismiss="modal">OK</button>
                                                <!-- onclick="window.location.href='expert-advice-summary.html';"> -->
                                            </div>
                                        </div>




                                    </div>

                                    <!-- <div class="modal-footer"></div> -->
                                </div>
                            </div>
                        </div>


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

        <!-- <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a> -->

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
        <!-- <script>
            function redirectToProforma(patientId) {
              // Redirect the user to the "proforma11.php" page with the patient ID as a parameter
              window.location.href = '."'proforma-summary1.php?id=".$result['patientid']."'             
            }
            </script>-->
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