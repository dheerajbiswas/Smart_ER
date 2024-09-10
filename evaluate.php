<?php

session_start();

if (isset ($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}

include ('connection.php'); //include_once was written
$pid = $_GET['id'] ? $_GET['id'] : "";
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die ("Failed");
    $data = mysqli_fetch_array($result);
}
?>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include ("connection.php");
// $score = 0;
$pid = $_GET['id'];
if (isset ($_POST['evalNext'])) {
    // $cheifComplain = $_POST['cheifComplain'];
    // $datas = $_POST['comCheck'];
    $symTemplate = $_POST['symTemplate'];
    $diagTemplate = $_POST['diagTemplate'];
    // $alldata = implode(",", $datas);

    $query = "UPDATE patientregistration SET symTemplate='$symTemplate', 
                                                diagTemplate='$diagTemplate' WHERE patientid='$pid'";

    // $query = "UPDATE patientregistration SET cheifComplain='qwerty' WHERE patientid=12345";

    // correct query syntax
    // $query = "UPDATE patientregistration SET cheifComplain='$cheifComplain' WHERE patientid=$pid";



    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";
        // echo $pid;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    header("Location: chest-pain-proforma.php?id=$pid");
}

// exit;
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
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top " style="height: 70px">
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
                <h2>Field Login</h2>
                <!-- <ol>
                    <li><
                    a href="index.html">Home</a></li>
                    <li>Practitioner Login</li>
                </ol> -->
            </div>
        </div>
    </section>

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
                <form method="post" action="">
                    <div class="col text-center">
                        <div class="row">
                            <div class="col text-center">
                                <span>
                                    <h4>Select Evaluation Template</h4>
                                </span>
                            </div>
                        </div>
                        <br><br>
                        <div class="row" style="border: 2px solid black; border-radius: 0.3em;">
                            <div class="col">
                                <p>
                                    <br><br>
                                    <label for="symTemplate">Select symptom-based template:</label>
                                    <select name="symTemplate" id="symTemplate" style="width: 150px;">
                                        <option value="none">Select</option>
                                        <option value="Chest pain">Chest pain</option>
                                        <option disabled value="Shortness of breath">Shortness of breathe</option>
                                        <option disabled value="Fever">Fever</option>
                                        <option disabled value="Abdominal pain">Abdominal pain</option>
                                        <?php if ($data['presentation'] === "trauma") {
                                            echo '<option disabled value="Trauma">Trauma</option>';
                                        } ?>
                                        <option disabled value="Headache">Headache</option>
                                        <option disabled value="Altered sensorium">Altered sensorium</option>
                                        <option disabled value="Acute poisoning">Acute poisoning</option>
                                    </select>
                                </p>
                                <br>
                                <p>
                                    <label for="diagTemplate">Select diagnosis-based template:</label>
                                    <select name="diagTemplate" id="diagTemplate" style="width: 150px;">
                                        <option value="none">Select</option>
                                        <option disabled value="STEMI">STEMI</option>
                                        <option disabled value="Stroke">Stroke</option>
                                        <option disabled value="Sepsis">Sepsis</option>
                                        <option disabled value="Seizures">Seizures</option>
                                        <option disabled value="Organophosphate overdose">Organophosphate overdose
                                        </option>
                                        <option disabled value="Heart failure">Heart failure</option>
                                        <option disabled value="Acute pancreatitis">Acute pancreatitis</option>
                                    </select>
                                </p>
                                <br> <br>
                            </div>
                        </div>

                    </div>
                    <br>
                    <div class="row text-center">
                        <div class="col">
                            <p>
                                <input type="submit" id="next" class="btn btn-warning btn-lg " value="Next"
                                    name="evalNext"
                                    onclick="window.location.href='chest-pain-proforma.php?id=<?php echo $pid ?>';">
                            </p>
                        </div>
                    </div>
                </form>

                <script>
                    // for drop downs to be disabled and enabled
                    document.getElementById("symTemplate").onchange = function () {
                        document.getElementById("diagTemplate").setAttribute("disabled", "disabled");
                        if (this.value == 'none')
                            document.getElementById("diagTemplate").removeAttribute("disabled");
                    };
                    document.getElementById("diagTemplate").onchange = function () {
                        document.getElementById("symTemplate").setAttribute("disabled", "disabled");
                        if (this.value == 'none')
                            document.getElementById("symTemplate").removeAttribute("disabled");
                    };
                </script>

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