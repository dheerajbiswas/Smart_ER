<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
//error_reporting(0);
$pid = $_GET['id'] ? $_GET['id'] : "";

$query = "SELECT * FROM patientregistration WHERE patientid=$pid";
$result = mysqli_query($conn, $query);

// $total = mysqli_num_rows($data);
$data = mysqli_fetch_array($result);


//if folder doesnot exist then make one
$target_dir = "uploads/" . $pid . "/";
// Check if directory already exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
} else {
    // echo "Directory does not exist.";
}

// $target_dir = "/uploads/" . $pid . "/";
// $prescExpert = $target_dir.$pid."_expert.pdf";
// $prescExpert = "uploads/421/421_expert.pdf";
$prescExpert = $data['expert_presc_path'];

// echo $prescExpert;
// echo "<br>";

// $target_dir = __DIR__ . "/uploads/" . $pid . "/";
// $prescField = $target_dir.$pid."_field.pdf";
$prescField = $data['prescription_path'];
// echo $prescField;


if (isset($_POST['saveAdvice'])) {
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
    if($data['expertOpinion'] !== "Completed"){
        $expertOpinion = "Not Taken";
    } else {
        $expertOpinion = $data['expertOpinion'];
    }
    $query = "UPDATE patientregistration SET stat='$pf_stat', expertOpinion='$expertOpinion' WHERE patientid=$pid";

    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }

    header('Location: save-field-pdf.php?id='.$pid);

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SMART-ER</title>
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
    <header id="header" class="fixed-top" style="height: auto">
        <div class="container">

            <div class="logo float-left">
                <h1 class="text-light"><a href="#"><span>SMART-ER PLATFORM</span></a></h1>
                <br>

                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>


            <nav class="nav-menu float-right d-none d-lg-block">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <!-- about was attributed: class="active" -->
                    <li><a href="about.html">About</a></li>

                    <li><a href="blog.html">Contact Us</a></li>
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
                            <h4 id="patientid" name="patientid" <?php // echo "readonly"; ?>><strong>Patient Id:
                                    <?php echo $pid; ?>
                                </strong></h4>
                            <br><br><br>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-3"></div>

                        <div class="col-lg-3 ">
                            <p><label for="clinical">View clinical details:</label></p>
                            <p><label for="viewecg">View ECG:</label></p>
                            <p><label for="interview">View expert's prescription:</label></p>
                            <p><label for="interview">View your prescription:</label></p>
                            <br><br>
                            <!-- <p><label for="impression">Your impression:</label></p> -->
                            <!-- <div class="row ">
                                <div class="col-md-*"></div>
                                <div class="col-md-* " >
                                    
                                </div>
                                <div class="col-md-*">
                                    
                                </div>
                                <div class="col-md-*"></div>
                            </div>-->

                            <br>

                        </div>

                        <div class="col-lg-3">

                            <p>
                                <input type="button" target="_blank"
                                    onclick="window.location.href='proforma-sum-expert.php?id=<?php echo !empty($pid) ? $pid : ''; ?>'"
                                    id="clinical" style="width: 250px;" value="Click">
                                <script>
                                    document.getElementById("clinical").onclick = function () {
                                        // Replace "https://www.example.com" with the URL of the page you want to open
                                        window.open("proforma-summary2.php?id=<?php echo !empty($pid) ? $pid : ''; ?>", "_blank");
                                        // proforma-sum-expert
                                    };
                                </script>
                            </p>


                            <p>
                                <!-- <img id="imageDisplay" src="" alt="Image" style="margin: 0; padding: 0;"> -->
                                <input type="button" name="Click" id="viewecg"
                                    style="width: 250px; margin: 0; padding: 0;" target="_blank"
                                    onclick="window.location.href='uploads/421/421.jpg'" value="Click">
                                <script>
                                    document.getElementById("viewecg").onclick = function () {
                                        window.open("<?php echo "uploads/".$pid."/".$pid.".jpg" ?>", "_blank");
                                    };
                                </script>

                            </p>


                            <!-- <p> <input type="text" id="interview" style="width: 250px;"></p> -->
                            <p> <input type="button" id="expert_prescription" style="width: 250px;" target="_blank" <?php echo $data['expertOpinion'] !== "Completed"? "disabled": "";?>
                                     value="Click">
                            </p>

                            
    
    <!-- <script>
    function openPDF() {
        window.open('<?php //echo $pdfPath; ?>', '_blank');
    }
    </script> -->
                            <script>
                                document.getElementById("expert_prescription").onclick = function () {
                                    window.open("<?php echo $prescExpert; ?>", "_blank");
                                    // uploads/421/.pdf?id=
                                };
                            </script>
                            <!-- <p> <textarea type="text" id="impression" name="impression" value="" rows="4"
                                                cols="27" style="resize: none; margin-bottom: 10px;"></textarea></p>
                            style="width: 250px;" -->


                            <p> <input type="button" id="field_prescription" style="width: 250px;" target="_blank" 
                            <?php echo $data['stat'] === "Pending"? "disabled": "";?> value="Click">
                                    <!-- onclick="window.location.href='uploads/421/patientdetails.pdf'"  -->
                            </p>
                            <script>
                                document.getElementById("field_prescription").onclick = function () {
                                    window.open("<?php echo $prescField; ?>", "_blank");
                                    // uploads/421/421_field.pdf?id=
                                };
                            </script>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    <!-- <br><br> -->
                    <div class="col text-center">
                        <input type="button" id="SaveComplain" class="btn btn-warning btn-lg" data-toggle="modal"
                            data-target="#" onclick="window.location.href='field-patient-list.php?doc=<?php echo $data['treated_by']?>';"
                            value="Go Back">

                            <?php if($data['stat'] === "Pending") {?>
                                <!-- $data['expertOpinion'] === "Pending" && -->
                                <input type="button" id="" class="btn btn-warning btn-lg" data-toggle="modal"
                                data-target="#prescribeAdvice" value="Prescribe">
                                <!-- onclick="window.location.href='patient-list.php'" -->
                            <?php } ?>
                    </div>
                    <br>
                    <br>
                    <br>

                </div>


                <!-- MODAL FOR  PRESCRIPTION-->
                <div class="modal fade" id="prescribeAdvice" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <p>
                                    <h5>Please mention your advice</h5>
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    </p>


                                </div>

                                <!-- <div method="post" style="box-sizing: 20px; padding: 2px;" class="box"> -->

                                <form method="POST">
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-5">

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="name"
                                                            style="text-align: left;padding: 5px;">Name:</label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="name"
                                                            value=""><?php echo $data['patientName']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="uhid" style="text-align: left;padding: 5px;">UHID
                                                            No.:
                                                        </label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="uhid"
                                                            value=""><?php echo $data['patientid']; ?></label>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col">
                                                        <label for="age_sex"
                                                            style="text-align: center;padding: 5px;">Age/Sex:
                                                        </label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="age_sex"
                                                            value=""><?php echo $data['age'] . ' / ' . $data['gender']; ?></label>
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
                                                        <label disabled type="text" id="date"
                                                            value=""><?php echo $data['date']; ?></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="time"
                                                            style="text-align: right;padding: 5px;padding-right: 2px;">Time:

                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="time"
                                                            value=""><?php echo $data['time']; ?></label>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Treated by"
                                                            style="text-align: center;padding: 5px;">Treated
                                                            by: </label>
                                                    </div>
                                                    <div class="col">
                                                        <label disabled type="text" id="treated_by"
                                                            value=""><?php echo $data['treated_by']; ?></label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            
                                            <div class="col" style="text-align: center;">
                                            <div class="col" style="text-align: center;">
                                                <label for="diagnosis"><strong>Diagnosis</strong></label>
                                            </div>
                                                <textarea type="text" id="diagnosis" name="diagnosis" value="" cols="70" rows="5"
                                                    style="resize: none;"
                                                    placeholder="Write your prescription here"><?php //echo isset($body) ? $body : ""; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col" style="text-align: center;">
                                            <div class="col" style="text-align: center;">
                                                <label for="prescibe"><strong>Advice</strong></label>
                                            </div>
                                                <textarea type="text" id="prescibe" name="prescibe" value="" cols="70" rows="20"
                                                    style="resize: none;"
                                                    placeholder="Write your prescription here"><?php //echo isset($body) ? $body : ""; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" col text-center">
                                            <button type="submit" id="download" name="download"
                                                    class="btn btn-warning" value="Save">Download</button>
                                                <button type="submit" id="saveAdvice" name="saveAdvice"
                                                    class="btn btn-warning" value="Save"
                                                onclick="window.location.href='patient-.php?token=2';">Save</button>
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



                <!-- Modal content -->
                <!-- MODAL FOR EXPERT LOGIN -->
                <!-- <div class="modal fade" id="expertAdvice" role="dialog"> 
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <p>
                                <h5>Please mention your advice</h5>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button> 
                                </p>


                            </div>-->

                <!-- <div class="modal-body"> 
                                <div class="row">
                                    <div class="col" style="text-align: center;">
                                        <textarea cols="50" rows="20" style="resize: none;"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col text-center">
                                        <button type="button" id="saveAdvice" class="btn btn-warning" value="Save"
                                            onclick="window.location.href='expert-advice-summary.php?id=<?php //echo $pid; ?>';">Save</button>
                                    </div>
                                </div>-->




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

            <!-- <div class="modal-footer"></div> -->
            </div>
            </div>
            </div>




            <!-- MODAL FOR EXPERT LOGIN -->
            <!-- <div class="modal fade" id="notify" role="dialog">
                <div class="modal-dialog"> -->
                    <!-- modal-lg"> -->
                    <!-- <div class="modal-content">
                        <div class="modal-header ">
                            <p>
                            <h5>Interview</h5> -->
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <!-- </p>


                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col" style="text-align: center;"> -->
                                    <!-- <textarea cols="50" rows="20" style="resize: none;"></textarea> -->
                                    <!-- <p>The link has been sent to the field user</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class=" col text-center">
                                    <button type=" button" id="saveAdvice" class="btn btn-warning" value="Save"
                                        data-dismiss="modal">OK</button> -->
                                    <!-- onclick="window.location.href='expert-advice-summary.html';"> -->
                                <!-- </div>
                            </div>




                        </div> -->

                        <!-- <div class="modal-footer"></div> -->
                    <!-- </div>
                </div>
            </div> -->



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