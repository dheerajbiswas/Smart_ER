<?php

session_start();

if(isset($_SESSION['login']) || $_SESSION['login'] === "110010"){
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}

include('connection.php');
$pid = isset($_GET['id']) ? $_GET['id'] : "";


$pr = "";
$bp = "";
$rr = "";
$spo = "";

$showfile = "";

$target_dir = "capture/";
$target_file = "";
$uploadOk = 1;
$imageFileType = "";
// echo isset($_POST['check']) ? $_POST['check']:"";

if (isset($_POST['check'])) {

    ///////////////////////////////////////////////////////////
    // $pidim = $_POST['pidim']; //_GET['id'];
    // echo $pidim;
    $img = $_POST['image'];
    $folderPath = "capture/";

    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    // $fileName = uniqid() . '.png';  

    //the file name should be patient id + .png
    $fileName = "$pid" . ".png";
    $tempname = "temp" . ".png";
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    file_put_contents($tempname, $image_base64);
    $showfile = $tempname;
    // $showfile = "C:\\xampp\\htdocs\\smart_er_v3\\capture\\tip2.png";
    /////////////////////////////////////////////////////////////
    //run the ocr python script here
    // $output = shell_exec('python hello.py');
    // echo $output;


    // print_r($fileName);


    //run python ocr script

    // $file = $_GET['file'];
    // echo $file;

    // $output = shell_exec("python capture/imageOCR.py C:\\xampp\\htdocs\\smart_er_v3\\capture\\tip2.png"); //for testing ocr and autofill 
    $output = shell_exec("python capture/imageOCR.py $file"); // $output, $return_var); 

    // $output = exec("python capture/imageOCR.py nihon", $output, $return_var);

    // echo $output;
    $arr = json_decode($output, true);
    // var_dump($arr); //very useful to check what is the output of the json file
    // echo $arr;

    $pulse = array();

    for ($i = 0; $i < count($arr); $i++) {

        $x = explode(": ", $arr[$i]);
        // var_dump($x);

        $y = explode(", ", $x[0]);
        // var_dump($y);

        // echo "<br> x = ";
        $z1 = explode("[[", $y[0]);
        // var_dump($z1[1]);
        $x1 = $z1[1]; //x-coordinate

        // echo "<br> y = ";
        $z2 = explode("]", $y[1]);
        // var_dump($z2[0]);
        $y1 = $z2[0]; //y-coordinate
        // echo "$x1 $y1 <br>";

        // for nihon vital monitor
        // if ($x1 > 150)
        //     continue;
        // if ($x1 >= 20 && $x1 <= 25 && $y1 >= 90 && $y1 <= 110) {
        //     // echo $x[1];
        //     $pulse[] = $x[1];
        // }
        // if ($x1 >= 0 && $x1 <= 10 && $y1 >= 190 && $y1 <= 200) {
        //     // echo $x[1];
        //     $pulse[] = $x[1];
        // }
        // if ($x1 >= 85 && $x1 <= 95 && $y1 >= 320 && $y1 <= 325) {
        //     // echo $x[1];
        //     $pulse[] = $x[1];
        // }

        // for philis vital monitor
        // pulse rate
    if ($x1 >= 150 && $x1 <= 160 && $y1 >= 190 && $y1 <= 210) {
        // echo "<br> $x[1]";
        // $pulse[] = $x[1];
        $pr = $x[1];

    }
    // bp
    if ($x1 >= 220 && $x1 <= 240 && $y1 >= 200 && $y1 <= 220) {
        // echo $x[1];
        $bp = $x[1];
    }
    //spo2
    if ($x1 >= 45 && $x1 <= 65 && $y1 >= 190 && $y1 <= 200) {
        // echo "<br> $x[1]";
        // $pulse[] = $x[1];
        $spo = $x[1];
    }
    // rr
    if ($x1 >= 50 && $x1 <= 70 && $y1 >= 240 && $y1 <= 260) {
        // echo "<br> $x[1]";
        // $pulse[] = $x[1];
        $rr = $x[1];
    }
    $rr = "---";//For demo at IITK only. Must be remove after that

    }

    // echo $pulse;
    // var_dump($pulse);

    // for nihon
            // $pr = rtrim($pulse[0], "<br>");
            // $bp = rtrim($pulse[1], "<br>");
            // // $rr = $pulse[2], "<br>");
            // $spo = rtrim($pulse[2], "<br>");


    //for phillip's

    // $pr = rtrim($pulse[1], "<br>");
    $pr = preg_replace('/[^0-9]/', '', $pr); //gives correct answer
    $rr = preg_replace('/[^0-9]/', '', $rr); //gives correct answer

    // $bp = $bp;
    // $bp = rtrim($pulse[1], "<br>");
    // $rr = $pulse[2], "<br>");
    // $spo = rtrim($pulse[0], "<br>");
    $spo = preg_replace('/[^0-9]/', '', $spo); //gives correct answer
    $s = substr((string) $spo, 0, 3);
    $spo = !empty((int) $s === 100) ? (int) $s : (int) substr((string) $s, 0, 2);


    //pass the control to next webpage after execution of above code
    // header("Location: complaints.php?id=$pidim");


}

//header();
?>

<?php

if (isset($_POST['confirmSave'])) {

    $vital_pr = $_POST['pulse'];
    $vital_bp = $_POST['bp'];
    $vital_rr = $_POST['rr'];
    $vital_spo = $_POST['spo'];

    $query = "UPDATE patientregistration SET    pulse='$vital_pr',
                                                bp='$vital_bp',
                                                rr='$vital_rr',
                                                spo='$vital_spo'
                                                WHERE patientid='$pid'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data inserted into the database'); :" . $query . "</script>";
        // echo $pid;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    echo $query;
    header("Location: complaints.php?id=$pid");
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

    <!-- required links for capturing the camera -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style type="text/css">
        /* #results {
            padding: 20px;
            border: 1px solid;
            background: #ccc;
        } */
    </style>

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


    <style>
        .box {

            border: 2px solid;
            border-radius: 0.3em;
            margin: 1px;
        }
    </style>

    <!-- =======================================================
  * Template Name: Moderna - v2.0.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
                        <li>Practitioner Login</li>
                    </ol>
                </div>

            </div> 
        </section> -->
        <!-- End About Us Section -->

        <!-- ======= About Section ======= -->
        <section class="about"> <!--data-aos="fade-up"> -->

            <div class="container" style="margin: auto; padding: 0px 0px; max-width: 1260px;">
                <div class="col text-center">
                    <span>
                        <h4>Patient Vital Parameters</h4>
                    </span>
                    <br><br>
                    <form method="POST">
                        <!-- storeImage.php == action -->
                        <div class="row text-center" style="border: 2px solid black; border-radius: 0.3em;">
                            <!-- <div class="col align-center "> -->
                            <!-- <label for="fileToUpload">Click Monitor Image:</label> -->

                            <!-- <input type="submit" class="btn btn-default" value=""> -->
                            <!-- <input type="file" name="fileToUpload" id="fileToUpload" style="width: 250px;"> -->

                            <div class="col-md-4 text-center"
                                style="border: 1px solid #ccc; min-height 300; max-height: auto; width: 400;">
                                <h5>Monitor on-line</h5>
                                <div id="my_camera"></div>
                                <br />
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="check" class="btn btn-primary" id="check"
                                            value="Capture Monitor" onClick="take_snapshot()">
                                        <input type="hidden" name="image" class="image-tag">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="border: 1px solid #ccc">
                                <h5>Catured Image</h5>
                                <!-- <script>document.getElementById('results').innerHTML = '<img src="' + "<?php echo $showfile; ?>" + '"/>';</script> -->
                                <?php
                                // checks the captured image in the directory and show/hide the image in the image display. 
                                // this is for image to not to cleared when the form is submitted.
                                
                                // if (file_exists($showfile)) {
                                //     // echo "<br><br><br> $showfile";
                                //     echo '<script>document.getElementById("showAfterImage").scr = "' . $showfile . '" </script>';
                                // } else {
                                //     echo '<script>document.getElementById("showAfterImage").style.display = "none";</script>';
                                // }
                                ?>

                                <div id="results">
                                    <img id="showAfterImage"
                                        src="<?php echo file_exists($showfile) ? $showfile : ""; ?>">
                                    <!-- .' style="display: none;"' -->
                                    <?php //echo $showfile;?>

                                </div>
                                <!-- <div id="results">Your captured image will appear here...</div> -->
                                <!-- <input type="hidden" name="pidim" value="<?php // echo $pid; ?>"> -->
                                <!-- <input type="hidden" id="check" name="check" class="btn btn-primary btn-lg" value="Vitals" -->
                                <!-- onclick="window.location.href='complaints.php?id=<?php //echo $pid; ?>';"> -->
                                <br />
                            </div>
                            <!-- </div> -->
                            <!-- <br> <br> <br><br> <br> <br> -->
                            <div class="col-md-4" style="border: 1px solid #ccc; ">
                                <!-- widht: auto; height: 400px; -->




                                <!-- start of vitals table -->
                                <div class="row "><!-- style="margin-top: 20px;"> -->
                                    <!-- section-title" id="gcc">-->
                                    <div class="col text-center">
                                        <h5>Vitals</h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label for="pulse"
                                                    style="text-align: left; padding: 5px;">Pulse:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="pulse" name="pulse" value="<?php echo $pr; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label for="bright" style="text-align: left; padding: 5px;">Blood
                                                    Pressure:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="bp" name="bp" value="<?php echo $bp; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label for="rr" style="text-align: left; padding: 5px;">Respiratory
                                                    Rate:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="rr" name="rr" value="<?php echo $rr; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label for="spo" style="text-align: left; padding: 5px;">SpO2:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="spo" name="spo" value="<?php echo $spo; ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end of vitals table -->
                                <div class="row">
                                    <div class="col ">
                                        <p style="margin-top: 30px;">Please click the confirm button if vitals are capture correctly.
                                            <br> Click the capture monitor button to retake vitals.
                                        </p>

                                        <!-- <div class="row">
                                            <div class="col">
                                                <input type="button" id="confirmSave" class="btn btn-primary"
                                                    name="confirmsave" disabled value="Confirm"
                                                    style="margin-top: 0px;">
                                            </div>
                                        </div> -->
                                    </div>
                                </div>

                            </div>

                            <!-- </form> -->

                        </div>
                        <br>
                        <!-- <form method="POST"> -->
                        <div class="row text-center">
                            <div class="col">
                                <input type="submit" class="btn btn-warning" value="Confirm" id="confirmSave"
                                    name="confirmSave" disabled>
                                <!-- onclick="window.location.href='complaints.php?id=<?php //echo $pid ?>';" -->
                                <!-- data-toggle="modal" data-target="#successModal"> -->
                                <!-- name="vitalsave"  id="vitalsave"-->

                            </div>
                        </div>
                    </form>


                    <!-- js for streaming camera input and capturing image -->

                    <!-- Configure a few settings and attach camera -->
                    <script language="JavaScript">
                        Webcam.set({
                            width: 400, //490,
                            height: 300,//390,
                            image_format: 'jpeg',
                            jpeg_quality: 100
                        });

                        Webcam.attach('#my_camera');

                        function take_snapshot() {
                            Webcam.snap(function (data_uri) {
                                $(".image-tag").val(data_uri);
                                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                                // document.getElementById('check').innerHTML = "hello";
                            });
                        }
                    </script>

                    <!-- 
                <script type="text/javascript">
                    const pulse = document.getElementById("pulse");
                    const pulse = document.getElementById("bp");
                    const pulse = document.getElementById("rr");
                    const userid = document.getElementById('fieldUserid');
                    const passwd = document.getElementById('fieldPassword');

                    userid.addEventListener('keyup', (e) => {
                        const value = e.currentTarget.value;
                        login.disabled = false;

                        if (value === "") {
                            login.disabled = true;
                        }
                    });

                    passwd.addEventListener('keyup', (e1) => {
                        const value1 = e1.currentTarget.value;
                        login.disabled = false;

                        if (value1 === "") {
                            login.disabled = true;
                        }
                    });
                </script> -->

                <!-- disable the vitals input until the capture monitor is clicked -->
                    <!-- <script>
                        document.getElementById("check").addEventListener("click", function () {
                            // Get references to the text elements
                            var text1 = document.getElementById("pulse");
                            var text2 = document.getElementById("bp");
                            var text3 = document.getElementById("rr");
                            var text4 = document.getElementById("spo");

                            // Enable the text elements by removing the disabled attribute
                            text1.removeAttribute("disabled");
                            text2.removeAttribute("disabled");
                            text3.removeAttribute("disabled");
                            text4.removeAttribute("disabled");
                        });
                    </script> -->

                    
                    <!-- usefull -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Get references to the textboxes and the submit button
                            const textbox1 = document.getElementById('pulse');
                            const textbox2 = document.getElementById('bp');
                            const textbox3 = document.getElementById('rr');
                            const textbox4 = document.getElementById('spo');
                            const submitButton = document.getElementById('confirmSave');

                            // Function to check textbox values and enable/disable the submit button
                            function checkTextboxes() {
                                const value1 = textbox1.value.trim();
                                const value2 = textbox2.value.trim();
                                const value3 = textbox3.value.trim();
                                const value4 = textbox4.value.trim();


                                // Enable the submit button only if both textboxes have values
                                submitButton.disabled = !(value1 || value2 || value3 || value4);
                            }

                            // Add event listeners to textboxes to trigger the checking
                            textbox1.addEventListener('keyup', checkTextboxes);
                            textbox2.addEventListener('keyup', checkTextboxes);
                            textbox3.addEventListener('keyup', checkTextboxes);
                            textbox4.addEventListener('keyup', checkTextboxes);

                        });
                    </script>

                    <!-- Your PHP code to generate content -->


                    <!-- Display the PHP-generated text -->

                    <!-- JavaScript code to enable the button when there is text from PHP -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const enableButton = document.getElementById('confirmSave');
                            // const submitButton = document.getElementById('submitButton');

                            // Check if there is text filled by PHP (modify this condition based on your content)
                            const phpText = "<?php echo $pr; ?>";
                            if (phpText.trim() !== '') {
                                enableButton.disabled = false;
                            }
                        });
                    </script>


                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Get references to the buttons and the form
                            const enableButton = document.getElementById('confirmSave');
                            const submitButton = document.getElementById('vitalSave');
                            const form = document.querySelector('form');

                            // Function to enable the submit button
                            function enableSubmitButton() {
                                submitButton.disabled = false;
                            }

                            // Add click event listener to the enableButton
                            enableButton.addEventListener('click', function () {
                                enableSubmitButton();
                            });

                            // Add submit event listener to the form to prevent submission when submitButton is disabled

                            // form.addEventListener('submit', function (event) {
                            //     if (submitButton.disabled) {
                            //         event.preventDefault();
                            //         alert('Please press the "Enable Submit Button" first.');
                            //     }
                            // });
                        });
                    </script>





                    <!-- 
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Get references to the conditional button and the submit button
                        const conditionalButton = document.getElementById('confirmSave');
                        const submitButton = document.getElementById('vitalSave');

                        // Add click event listener to the conditional button
                        conditionalButton.addEventListener('click', function () {
                            // Enable the submit button when the conditional button is clicked
                            submitButton.disabled = false;
                        });
                    });
                </script> -->


        </section>



        <!-- ======= Tetstimonials Section ======= -->


        <!-- ======= Footer ======= -->
        <!-- <footer id="footer"> -->
        <!-- <div class="container"> -->
        <!-- <div class="copyright"> -->
        <!-- &copy; Copyright <strong><span></span></strong>. All Rights Reserved -->
        <!-- </div> -->
        <!-- <div class="credits"> -->
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->
        <!-- Designed by -->
        <!-- <a href="https://bootstrapmade.com/">Bootstrapmade</a> -->
        <!-- </div> -->
        <!-- </div> -->
        <!-- </footer> -->
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

</body>

</html>