<?php

session_start();

if (isset ($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}

include ('connection.php');
$pid = isset ($_GET['id']) ? $_GET['id'] : "";


$pr = "";
$bp = "";
$rr = "";
$spo2 = "";
// echo "<br> " . $pr . "<br> " . $rr . "<br> " . $bp . "<br> " . $spo2;

$showfile = "";

$target_dir = "capture/";
$target_file = "";
$uploadOk = 1;
$imageFileType = "";
// echo isset($_POST['check']) ? $_POST['check']:"";

if (isset ($_POST['confirmSave'])) {  //in vital.php (previous version) : this was 'check' analyzing before submit

    /////////////////////////////////////////////////////////////////////////////////////////////
    // $pidim = $_POST['pidim']; //_GET['id'];
    // echo $pidim;
    $img = $_POST['image'];
    $folderPath = "capture/";
    // echo "<br><br><br><br><br>" . $img;
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    // $fileName = uniqid() . '.png';  

    //the file name should be patient id + .png
    $fileName = "$pid" . ".png";
    // $tempname = "temp" . ".png";
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    // file_put_contents($tempname, $image_base64);
    // $showfile = $tempname;
    ////////////////////////////////////////////////////////////////////////////////////////////////
    //running the ocr python script here in show-vitals.php


    // $pr = preg_replace('/[^0-9\/]/', '', $pr);
    // $pr = !empty($pr == null) ? 0 : "$pr";

    // $rr = preg_replace('/[^0-9\/]/', '', $rr);
    // $rr = !empty($rr == null) ? 0 : "$rr";

    // $bp = preg_replace('/\s/', "/", $bp, 1);
    // $bp = preg_replace('/[^0-9\/]/', '', $bp);
    // $bp = !empty($bp == null) ? "0/0" : "$bp";

    // $spo2 = preg_replace('/[^0-9\/]/', '', $spo2);
    // $s = substr((string) $spo2, 0, 3);      // echo"$s";
    // $spo2 = !empty((int) $s === 100) ? (int) $s : (int) (substr((string) $spo2, 0, 2));
    // $spo2 = !empty($spo2 == null) ? 0 : "$spo2";


    // echo "<br> " . $pr . "<br> " . $rr . "<br> " . $bp . "<br> " . $spo2;
    //pass the control to next webpage after execution of above code
    // header("Location: complaints.php?id=$pidim");


}

//header();
?>

<?php

if (isset ($_POST['confirmSave'])) {

    $vital_pr = $_POST['pulse'];
    $vital_bp = $_POST['bp'];
    $vital_rr = $_POST['rr'];
    $vital_spo = $_POST['spo2'];

    $query = "UPDATE patientregistration SET    pulse='$vital_pr',
                                                bp='$vital_bp',
                                                rr='$vital_rr',
                                                spo='$vital_spo'
                                                WHERE patientid='$pid'";

    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database'); :" . $query . "</script>";

        // echo $pid;
    } else {
        // echo "Error: " . mysqli_error($conn);
    }

    // echo $query;
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

    <!-- upload button -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


    <style>
        .box {

            border: 2px solid;
            border-radius: 0.3em;
            margin: 1px;
        }

        .spinner-border {
            height: 25px;
            width: 25px;
        }
    </style>

    <!-- =======================================================
  * Template Name: Moderna - v2.0.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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

                    <br>
                    <div class="row justify-content-center">
                        <div class="col">
                            <label for="monitorType"> Select monitor: </label>
                            <input type="radio" id="nihonMonitor" name="monitorType" value="Nihon">
                            <label for="nihonMonitor">Nihon</label>

                            <input type="radio" id="philipsMonitor" name="monitorType" value="Philips">
                            <label for="philipsMonitor">Philips</label>
                        </div>
                    </div><br>
                    <form method="POST" enctype="multipart/form-data" id="upload-file">
                        <!-- storeImage.php == action -->
                        <div class="row text-center" style="border: 2px solid black; border-radius: 0.3em;">
                            <!-- <div class="col align-center "> -->
                            <!-- <label for="fileToUpload">Click Monitor Image:</label> -->

                            <!-- <input type="submit" class="btn btn-default" value=""> -->
                            <!-- <input type="file" name="fileToUpload" id="fileToUpload" style="width: 250px;"> -->

                            <div class="col-md-4 text-center"
                                style="border: 1px solid #ccc; min-height 300; max-height: auto; width: 400;">
                                <h5>Monitor on-line</h5>
                                <hr>
                                <div class="row justify-content-center">
                                    <div id="my_camera" style="width: 100%; height: auto;"></div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col justify-content-between">
                                        <button type="button" name="inputImage" class="btn btn-primary" id="inputImage"
                                            style="width: auto; height: auto; display: none;" accept="image/*"
                                            value="Capture Monitor" onclick="take_snapshot()" capture="environment">
                                            <i class="fa-solid fa-camera"></i>
                                            &nbsp;
                                            Capture Monitor</button>
                                        <br>
                                        <!-- for mobile application {-->
                                        <input type="file" name="mobileCapture" id="mobileCapture" accept="image/*" />
                                        <label class="btn btn-primary m-2 mb-3" for="mobileCapture" id="mobileCapture"
                                            name="mobileCapture" style="width: 150px; height: auto; display: ;">
                                            <i class="fa-solid fa-upload"></i>
                                            &nbsp;
                                            Upload Vital</label>
                                        <br>

                                        <style>
                                            input[type="file"] {
                                                display: none;
                                            }
                                        </style>

                                        <!-- onChange="handleFile(this)"> -->
                                        <!-- <input type="submit" name="check" class="btn btn-primary" id="check"
                                            accept="image/*" capture="environment"> -->
                                        <!-- for mobile application }-->
                                        <input type="hidden" name="image" class="image-tag">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="border: 1px solid #ccc">
                                <h5>Catured Image</h5>
                                <hr>
                                <!-- <script>document.getElementById('results').innerHTML = '<img src="' + "<?php //echo $showfile;                                                       ?>" + '"/>';</script> -->
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
                                    <!-- showAfterImage -->
                                    <!-- <img id="output" <?php //echo file_exists($showfile) ? $showfile : "";                                                       ?>> -->
                                    <!-- .' style="display: none;"' -->
                                    <?php //echo $showfile;                                                                            ?>
                                    <img id="selectedImage"
                                        style="width: 100%; height: auto; display: none; border: 2px solid black; margin:2px; border-radius: 0.3em;" />
                                    <button id="analyze" type="button" name="analyze" class="btn btn-primary m-2"
                                        style="width: 150px; height: 40px; margin-top: 20px; display: none;"
                                        onclick="analyzeVitals();">Analyze</button>
                                </div>
                                <!-- <div id="results">Your captured image will appear here...</div> -->
                                <!-- <input type="hidden" name="pidim" value="<?php // echo $pid;                                                                             ?>"> -->
                                <!-- <input type="hidden" id="check" name="check" class="btn btn-primary btn-lg" value="Vitals" -->
                                <!-- onclick="window.location.href='complaints.php?id=<?php //echo $pid;                                                                             ?>';"> -->
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
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col" style="text-align: left;">
                                                <label for="pulse"
                                                    style="text-align: left; padding: 5px;">Pulse:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="pulse" name="pulse" value="<?php echo $pr; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col" style="text-align: left;">
                                                <label for="bright" style="text-align: left; padding: 5px;">Blood
                                                    Pressure:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="bp" name="bp" value="<?php echo $bp; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col" style="text-align: left;">
                                                <label for="rr" style="text-align: left; padding: 5px;">Respiratory
                                                    Rate:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="rr" name="rr" value="<?php echo $rr; ?>">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col" style="text-align: left;">
                                                <label for="spo" style="text-align: left; padding: 5px;">SpO2:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" id="spo2" name="spo2" value="<?php echo $spo2; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of vitals table -->
                                <div class="row">
                                    <div class="col">
                                        <p style="margin-top: 30px;text-align: left;">* Please click the confirm button
                                            if vitals
                                            are captured correctly.
                                            <br><br>
                                            * Click the capture monitor button to
                                            retake vitals.
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
                                <!-- onclick="window.location.href='complaints.php?id=<?php //echo $pid;                                     ?>';" -->
                                <!-- data-toggle="modal" data-target="#successModal"> -->
                                <!-- name="vitalsave"  id="vitalsave"-->

                            </div>
                        </div>
                    </form>

                    <!-- js for streaming camera input and capturing image -->

                    <!-- Configure a few settings and attach camera -->
                    <script>
                        //  language="JavaScript"


                        const uploadFile = document.getElementById("mobileCapture");
                        // const filename = document.getElementById("nameFile");
                        let fileuploaded = null;
                        let flag = false;


                        // Function to check if the user is on a mobile device
                        function isMobileDevice() {
                            // console.log(navigator.userAgent);
                            return /Mobile|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                        }

                        // Show the appropriate input element based on device type
                        window.onload = function () {
                            var fileInputMobile = document.getElementById('mobileCapture');
                            var fileInputDesktop = document.getElementById('inputImage');

                            if (isMobileDevice()) {
                                // fileInputMobile.style.display = ''; // Show mobile camera capture input
                                fileInputDesktop.style.display = 'none';
                                Webcam.reset();
                            } else {
                                fileInputDesktop.style.display = ''; // Show computer file upload input
                                // fileInputMobile.style.display = 'none';
                                Webcam.attach('#my_camera');
                            }
                        };


                        var imageData;

                        Webcam.set({
                            width: 400, //490,
                            height: 300,//390,
                            image_format: 'jpeg',
                            jpeg_quality: 100
                        });

                        // Webcam.attach('#my_camera');

                        function take_snapshot() {
                            Webcam.snap(function (data_uri) {
                                $(".image-tag").val(data_uri);
                                var selectedImage = document.getElementById('selectedImage');
                                selectedImage.src = data_uri; //'<img src="' + data_uri + '"/>';   //'result'.innerHTML
                                selectedImage.style.display = '';
                                // imageData = data_uri;
                                flag = true;
                                // Split the Base64 string to get the image type and data parts
                                var imageParts = data_uri.split(";base64,");
                                var imageTypeAux = imageParts[0].split("image/");
                                var imageType = imageTypeAux[1];

                                // Get the Base64 encoded image data
                                var imageBase64 = imageParts[1];

                                // // Decode the Base64 encoded image data
                                // var decodedImageData = atob(imageBase64);

                                fileuploaded = imageBase64;
                                document.getElementById('analyze').style.display = '';

                                // console.log(imageData);
                                // uploadFileToProcess(imageData);
                            });
                        }

                        // function handleFile(input) {
                        //     var file = input.files[0];
                        //     var reader = new FileReader();
                        //     reader.onload = function (e) {
                        //         var data_uri = e.target.result;
                        //         $(".image-tag").val(data_uri);
                        //         document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                        //     };
                        //     reader.readAsDataURL(file);
                        // }


                        function analyzeVitals() {
                            // console.log(fileuploaded);
                            if (fileuploaded === null) {
                                alert("No ecg image chosen.");
                            } else {
                                if (flag === true) {
                                    uploadFileToProcess(fileuploaded);
                                } else {
                                    var reader = new FileReader();
                                    reader.onload = function (event) {
                                        var imageData = event.target.result;

                                        // Check if the uploaded file is an image
                                        if (fileuploaded.type.match('image.*')) {
                                            $('.image-tag').val(imageData);

                                            // Get the Base64 encoded image data
                                            var imageBase64 = imageData.split(";base64,")[1];

                                            // Assign the Base64 image data to the imageData variable
                                            imageData = imageBase64;

                                            // Proceed with further processing or uploading
                                            uploadFileToProcess(imageData);
                                        } else {
                                            // Handle the case when the uploaded file is not an image
                                            console.error('The uploaded file is not an image.');
                                        }
                                    };
                                    reader.readAsDataURL(fileuploaded);
                                }
                            }
                        }



                        function uploadFileToProcess(imgfile) {
                            // var fileInput = document.getElementById("inputImage");
                            var loading = '<div class="spinner-border" role="status"> <span class="visually-hidden"></span> </div> Analyzing...';
                            var monitor = getSelectedMonitor();

                            // check if a file is selected
                            if (imgfile === null) {
                                alert('Please select/capture an image before analyzing');
                                return;
                            } else {

                                if (monitor === null) {
                                    alert("Select a monitor");
                                    return;
                                }

                                switch (monitor) {
                                    case 'Philips': scriptUrl = 'http://localhost:9080/perform-ocr'; break;
                                    case 'Nihon': scriptUrl = 'http://localhost:9080/perform-ocr-nihon'; break;
                                }
                                console.log(monitor);
                                // console.log(imgfile);
                                // buttonLoad = document.getElementById
                                $("#analyze").html(loading);
                                // $("#analyze").val(loading);
                                $("#analyze").prop("disabled", true);
                                // buttonLoad.html(load);

                                var formData = new FormData();
                                // formData.append('fileInput', imgfile);
                                formData = imgfile;
                                var scriptUrl = '';
                                $.ajax({
                                    url: 'http://localhost:9080/perform-ocr',
                                    // url: 'http://192.168.43.236:9080/perform-ocr',
                                    // url: 'http://10.10.54.231:9080/perform-ocr',
                                    // url: 'https://10.10.54.231/smart_er_v3/uploadImage.php',
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    crossDomain: true,
                                    success: function (response) {
                                        // $('#mri-result').html(response);
                                        $("#analyze").text("Analyze");
                                        // $("#analyze").val("Analyze");
                                        $("#analyze").prop("disabled", false);
                                        console.log(response);
                                        vitals(response);
                                    },
                                    error: function () {
                                        alert('Unable to read monitor');
                                        $("#analyze").text("Analyze");
                                        // $("#analyze").val("Analyze");
                                        $("#analyze").prop("disabled", false);
                                        // console.log(res)
                                    },
                                });
                            }
                        }


                        function vitals(response) {
                            // const textbox1 = document.getElementById('pulse');
                            // const textbox2 = document.getElementById('bp');
                            // const textbox3 = document.getElementById('rr');
                            // const textbox4 = document.getElementById('spo2');
                            // define vitals
                            var pr = 0;
                            var spo2 = 0;
                            var bp = 0;
                            var rr = 0;
                            response.forEach(function (x) {
                                x = x.split(':');
                                // console.log(x);
                                var coord = x[0]; //.split(",");
                                // Regular expression to match numbers
                                // var regex = /\d+/g;
                                var regex = /[\[\]]/g;

                                // Extract numbers from the string using match() method
                                // coord = coord[0].match(regex);
                                coord = coord.replace(regex, "");
                                coord = coord.split(",");
                                coord = coord.map(function (str) {
                                    return parseInt(str.trim(), 10); // Convert to integer with base 10 after trimming whitespace
                                });

                                // console.log(integers);
                                var x_coord = coord[0];
                                var y_coord = coord[1];
                                // console.log(x_coord, y_coord);
                                if (x_coord >= 10 && x_coord <= 145 && y_coord >= 160 && y_coord <= 260) {
                                    spo2 = x[1];
                                    spo2 = parseInt(spo2.replace(/[^0-9]/g, '').substring(0, 3), 10) || parseInt(spo2.replace(/[^0-9]/g, '').substring(0, 2), 10);
                                    // spo2 = !isNaN(parseInt(s, 10)) && parseInt(s, 10) === 100 ? parseInt(s, 10) : parseInt(spo2.substring(0, 2), 10);
                                }

                                if (x_coord >= 140 && x_coord <= 180 && y_coord >= 180 && y_coord <= 220) {
                                    pr = x[1];
                                    pr = pr.replace(/[^0-9]/g, '');
                                }

                                if (x_coord >= 200 && x_coord <= 400 && y_coord >= 190 && y_coord <= 270) {
                                    bp = x[1];
                                    bp = bp.trim();
                                    bp = bp.replace(/\s/g, "/").replace(/[^0-9/]/g, '');
                                }

                                if (x_coord >= 50 && x_coord <= 70 && y_coord >= 240 && y_coord <= 260) {
                                    rr = x[1];
                                    rr = rr.replace(/[^0-9]/g, '')
                                }
                            });
                            $("#pulse").val(pr);
                            $("#bp").val(bp);
                            $("#rr").val(rr);
                            $("#spo2").val(spo2);
                        }


                        // var xhr = new XMLHttpRequest();
                        // xhr.open('POST', '/upload_image', true);
                        // xhr.onload = function () {
                        //     if (xhr.status === 200) {
                        //         var imageName = xhr.responseText;
                        //         console.log('Image uploaded:', imageName);
                        //         // Store the image name in a JavaScript variable
                        //         // Example: var imageNameVariable = imageName;
                        //     } else {
                        //         console.error('Image upload failed:', xhr.statusText);
                        //     }
                        // };
                        // xhr.send(formData);


                        // ========================================================


                        // const pulse = document.getElementById("pulse");
                        // const pulse = document.getElementById("bp");
                        // const pulse = document.getElementById("rr");
                        // const userid = document.getElementById('fieldUserid');
                        // const passwd = document.getElementById('fieldPassword');

                        // userid.addEventListener('keyup', (e) => {
                        //     const value = e.currentTarget.value;
                        //     login.disabled = false;

                        //     if (value === "") {
                        //         login.disabled = true;
                        //     }
                        // });

                        // passwd.addEventListener('keyup', (e1) => {
                        //     const value1 = e1.currentTarget.value;
                        //     login.disabled = false;

                        //     if (value1 === "") {
                        //         login.disabled = true;
                        //     }
                        // });


                        // disable the vitals input until the capture monitor is clicked

                        //     document.getElementById("check").addEventListener("click", function () {
                        //         // Get references to the text elements
                        //         var text1 = document.getElementById("pulse");
                        //         var text2 = document.getElementById("bp");
                        //         var text3 = document.getElementById("rr");
                        //         var text4 = document.getElementById("spo");

                        //         // Enable the text elements by removing the disabled attribute
                        //         text1.removeAttribute("disabled");
                        //         text2.removeAttribute("disabled");
                        //         text3.removeAttribute("disabled");
                        //         text4.removeAttribute("disabled");
                        //     });
                        //=============================================================


                        // usefull

                        document.addEventListener('DOMContentLoaded', function () {
                            // Get references to the textboxes and the submit button
                            const textbox1 = document.getElementById('pulse');
                            const textbox2 = document.getElementById('bp');
                            const textbox3 = document.getElementById('rr');
                            const textbox4 = document.getElementById('spo2');
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

                            // console.log(navigator.userAgent);
                        });


                        //  Your PHP code to generate content


                        //  Display the PHP-generated text

                        //  JavaScript code to enable the button when there is text from PHP

                        document.addEventListener('DOMContentLoaded', function () {
                            const enableButton = document.getElementById('confirmSave');
                            // const submitButton = document.getElementById('submitButton');

                            // Check if there is text filled by PHP (modify this condition based on your content)
                            const phpText = "<?php echo $pr; ?>";
                            if (phpText.trim() !== '') {
                                enableButton.disabled = false;
                            }
                        });




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



                        uploadFile.addEventListener("change", function () {
                            // filename.innerHTML = "";
                            // console.log("hello");
                            if (uploadFile.files.length > 0) {
                                // filename.textContent = uploadFile.files[0].name;
                                fileuploaded = uploadFile.files[0];

                                // Create a FileReader object
                                const reader = new FileReader();
                                // Define a function to handle the file reading operation
                                reader.onload = function (event) {
                                    // Set the src attribute of the selectedImage element to the data URL
                                    document.getElementById('selectedImage').src = event.target.result;
                                };
                                // Read the file as a data URL
                                reader.readAsDataURL(fileuploaded);

                                document.getElementById('selectedImage').style.display = '';
                                // document.getElementById('selectedImage').src = fileuploaded; //reader object is already doing it
                                document.getElementById('analyze').style.display = '';
                                flag = false;
                            } else {
                                // filename.textContent = "Choose a file";
                            }

                        });




                        // Function to retrieve the selected value
                        function getSelectedMonitor() {
                            // Get all radio buttons with name "monitorType"
                            const monitorRadios = document.querySelectorAll('input[name="monitorType"]');

                            // Loop through the radio buttons to find the selected one
                            for (const radio of monitorRadios) {
                                if (radio.checked) {
                                    // Return the value of the selected radio button
                                    return radio.value;
                                }
                            }
                            // console.log("Selected monitor:", );

                            // If no radio button is selected, return null
                            return null;

                        }

                        // Example of how to use the function
                        // const selectedMonitor = getSelectedMonitor();









                        // Function to check input fields and enable/disable the button
                        function checkInputs() {
                            // Get the input fields
                            const input1 = document.getElementById('pulse').value.trim();
                            const input2 = document.getElementById('bp').value.trim();
                            const input3 = document.getElementById('rr').value.trim();
                            const input4 = document.getElementById('spo2').value.trim();

                            // Get the submit button
                            const submitButton = document.getElementById('confirmSave');

                            // Enable the button if all input fields are not empty, otherwise disable it
                            if (input1 !== '' || input2 !== '' || input3 !== '' || input4 !== '') {
                                submitButton.removeAttribute('disabled');
                            } else {
                                submitButton.setAttribute('disabled', 'disabled');
                            }
                        }

                        // Call the checkInputs function every 500 milliseconds (adjust as needed)
                        setInterval(checkInputs, 500);

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