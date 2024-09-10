<?php
session_start();

// checking sessions and redirecting to intro page if not logged in
if (isset($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    // header("Location: intro.php");
}

include ('connection.php'); //include_once was written
$pid = $_GET['id'] ? $_GET['id'] : "";
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die("Failed");
    $data = mysqli_fetch_array($result);
}

$username = $_SESSION['username'];
$que = "SELECT * FROM login WHERE username='$username'";
$res = mysqli_query($conn, $que);
$da = mysqli_fetch_array($res);

if ($data['proformaSubmit'] === 'True') {
    header("Location: field-patient-list.php?doc=" . $da['Name']);
}

// print_r($data['gender']);

?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// include ("connection.php");

$target_dir = "uploads/" . $pid . "/"; // The directory where uploaded files will be stored
$target_file = "";
$uploadOk = 1;
$imageFileType = "";
// echo $data['total'];
// $score = 0;
// $pid = isset($_GET['id'])?$_GET['id']:"";
if (isset($_POST['saveproforma'])) {


    //  The below section was used in previous version for uploading only the file path to server
    // $image_file = $_FILES["fileToUploadECG"]['name'];

    // $targetDir = "uploads/"; // The directory where uploaded files will be stored
    // $targetFile = $targetDir . basename($_FILES["fileToUploadECG"]["name"]); // Full path to the uploaded file
    // echo "<br><br><br> $target_dir";

    // Check if directory already exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    } else {
        echo "Directory does not exist.";
    }

    $targetFile = $target_dir . $pid . ".jpg";

    // Check if the file is allowed (optional, based on your needs)
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedTypes = array("jpg", "jpeg", "png", "gif", "pdf");

    if (!in_array($fileType, $allowedTypes)) {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";

    } elseif ($targetFile !== "") {
        if (move_uploaded_file($_FILES["fileToUploadECG"]["tmp_name"], $targetFile)) {
            // echo "The file " . basename($_FILES["fileToUploadECG"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // $analysis = $_POST['jsonData'];
    // analysis='$analysis'

    // $ecgpath = $targetFile;
    $query = "UPDATE patientregistration SET ecgpath='$targetFile'  WHERE patientid='$pid'";

    // $query = "UPDATE patientregistration SET cheifComplain='qwerty' WHERE patientid=12345";

    // correct query syntax
    // $query = "UPDATE patientregistration SET cheifComplain='$cheifComplain' WHERE patientid=$pid";

    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";
        // echo $pid;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    header("Location: proforma-summary1.php?id=$pid");
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


    <!-- required links for capturing the camera -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />


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

    <!-- upload button  (already used above)-->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->


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

        .spinner-border {
            height: 25px;
            width: 25px;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top " style="height: 70px;">
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
                        <li>Practitioner Login</li>
                    </ol>
                </div>

            </div>
        </section> -->
        <!-- End About Us Section -->

        <!-- ======= About Section ======= -->
        <section class="about"> <!--data-aos="fade-up"> -->

            <div class="container">
                <div class="row">
                    <div class="col text-center">
                        <div class="row">
                            <div class="col">
                                <span>
                                    <h4>Chest Pain Proforma</h4>
                                </span>
                            </div>
                        </div>


                        <!-- <div class="row" style="text-justify: inter-word; text-align: justify;">
                        <div class="col-md-2" style="border: 1px solid black;">
                            <p>Patient Name:</p>
                            <p>Age(in years):</p>
                            <p>Gender:</p>
                        </div>

-->
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <!-- style="border: 2px solid black; border-radius: 0.3em;"> -->
                                <!-- <div class="col-3" style="margin: 0px;">
                                </div> -->
                                <div class="col justify-content-center" style="margin: 20px;">
                                    <!-- <div class="col"> -->
                                    <p>
                                        <!-- "assets/acp-approach.jpeg" -->
                                        <a href="assets/acp-approach-mod.pdf" target="_blank"
                                            style="text-decoration: underline;">
                                            View the steps for approach to acute chest pain
                                        </a>
                                    </p>
                                    <br>
                                    <!-- </div> -->
                                    <div class="row text-center justify-content-center">
                                        <!-- <div class="col-3" style="border: 1px solid black;"></div> -->
                                        <div class="col-12 col-lg-10 box">
                                            <span>
                                                <h4>Fill acute chest pain proforma</h4>
                                            </span>
                                            <hr>
                                            <label class="btn btn-primary" id="fillproforma">Proforma</label>
                                            <!-- onclick="window.location.href='proforma11.php?id='+ encodeURIComponent(<?php //echo $pid;        ?>);" -->
                                            <p>
                                                <label for="proformastatus">Proforma Status:</label>
                                                <label id="proformastatus">
                                                    <?php echo ($data['proformaSubmit'] === "Filled") ? "Completed" : "Pending"; ?>
                                                </label>
                                            </p>



                                            <!-- start -->
                                            <!-- <input type="file" name="fileToUploadECG" id="fileToUploadECG"
                                                onchange="loadFile(event)" />
                                            <label class="btn btn-primary" for="fileToUploadECG">
                                                <i class="fa-solid fa-upload"></i>
                                                &nbsp;
                                                Upload ECG</label>
                                            <style>
                                                input[type="file"] {
                                                    display: none;
                                                }
                                            </style>
                                            <p for="fileToUploadECG" id="nameFile">Choose an ECG</p> -->
                                            <!-- end -->

                                            <!-- <div class="row"  >
                                                <div class="col"  > -->
                                            <label for="score">HEAR Score:</label>
                                            <label id="score"
                                                style="<?php echo ($data['total'] < 3) ? 'color: green;' : 'color: red; animation: blink 1s infinite;'; ?>"><strong>
                                                    <?php echo !empty($data['total']) ? $data['total'] : ""; ?>
                                                </strong>
                                            </label>
                                            <?php if ($data['proformaSubmit'] === "Filled") {
                                                echo ($data['total'] < 3) ? '<p style="color: green;">Low risk of Myocardial Ischemia</p>' : '<p style="color: red; animation: blink 1s infinite;">High risk of Myocardial Ischemia</p>';
                                                echo "";
                                            }
                                            ?>
                                            <style>
                                                /* Define the animation */
                                                @keyframes blink {
                                                    0% {
                                                        opacity: 1;
                                                    }

                                                    50% {
                                                        opacity: 0;
                                                    }

                                                    100% {
                                                        opacity: 1;
                                                    }
                                                }

                                                /* Apply the animation to the element */
                                                .blinking {
                                                    animation: blink 1s infinite;
                                                }
                                            </style>
                                            <!-- <a href="assets/HEAR score.pdf" target="_blank"> -->
                                            <!-- <p style="text-decoration: underline;">Click to know more</p> -->
                                            <!-- </a> -->
                                        </div>
                                        <!-- <div class="col"  style="border: 1px solid black;"  > -->
                                        <!-- <p><input type="text" id="score" value="<?php //echo $data['total'];       ?>"></p> -->
                                        <!-- <p><h3 id="score" -->
                                        <!-- style="<?php //echo ($data['total'] < 3) ? 'color: green;' : 'color: red;';       ?>"> -->
                                        <!-- <?php //echo $data['total'];                    ?> -->
                                        <!-- </h3> --> <!-- </p> --> <!-- </div> -->
                                        <!-- </div  >
                                        </div  > -->


                                        <div class="col-12 col-lg-5 text-center box">
                                            <span>
                                                <h4>Upload Patient's ECG</h4>
                                            </span>
                                            <hr><br>

                                            <div class="row">
                                                <div class="col align-center ">
                                                    <input type="file" name="fileToUploadECG" id="fileToUploadECG" />
                                                    <label class="btn btn-primary" for="fileToUploadECG">
                                                        <i class="fa-solid fa-upload"></i>
                                                        &nbsp;
                                                        Upload ECG</label>

                                                    <!-- <input type="submit" class="btn btn-default" value=""> -->
                                                    <style>
                                                        input[type="file"] {
                                                            display: none;
                                                        }
                                                    </style>
                                                    <div>
                                                        <p for="fileToUploadECG" id="nameFile">No file chosen</p>
                                                    </div>


                                                    <!-- <input type="button"  class="btn btn-primary" name="captureECG" id="captureECG" /> -->
                                                    <!-- data-toggle="modal"data-target="#ptureEcg" -->

                                                    <input type="file" capture="environment" accept="image/*" />
                                                    <button class="btn btn-primary" for="mobileCapture"
                                                        id="mobileCapture" name="mobileCapture" style="display: none;">
                                                        <i class="fa-solid fa-camera"></i>
                                                        &nbsp;
                                                        Capture ECG</button>
                                                    <br>

                                                    <button type="button" class="btn btn-primary" name="captureECG"
                                                        id="captureECG" style="display: none;" onclick="captureCam();">
                                                        <i class="fa-solid fa-camera"></i>
                                                        &nbsp;
                                                        Capture ECG</button>
                                                    <br><br>
                                                </div>
                                                <!-- HTML for the button -->
                                                <!-- <button id="captureButton" onclick="captureOrUpload()">Capture or Upload</button> -->

                                            </div>

                                            <div class="row justify-content-center m-2" id="CamSection"
                                                style="display: none;">

                                                <div class="col box"
                                                    style="border: 0px solid #ccc; min-height 450; max-height: auto; min-width: 450;">
                                                    <h5>Camera</h5>
                                                    <div class="row justify-content-center">
                                                        <!-- <div id="containCam" class="col" style="min-height 450; max-height: auto; min-width: 450;"> -->
                                                        <div id="my_camera" style="width: 100%; height: auto;"></div>
                                                        <!-- </div> -->
                                                    </div>

                                                    <br />
                                                    <div class="row">
                                                        <div class="col">
                                                            <button type="button" name="inputImage"
                                                                class="btn btn-primary m-2" id="inputImage"
                                                                style="width: 150px; height: 50px;" accept="image/*"
                                                                value="Capture Monitor" onclick="take_snapshot();"
                                                                capture="environment">Capture ECG</button>

                                                            <!-- for mobile application {-->
                                                            <!-- <input type="file" name="check" class="btn btn-primary" id="check"
                                            accept="image/*" capture="environment"> -->
                                                            <!-- onChange="handleFile(this)"> -->
                                                            <!-- <input type="submit" name="check" class="btn btn-primary" id="check"
                                            accept="image/*" capture="environment"> -->
                                                            <!-- for mobile application }-->
                                                            <input type="hidden" name="image" class="image-tag">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <p>
                                                <!-- <input type="submit" id="imageSave" class="btn btn-warning btn-lg m-3"
                                                    value="Save" name="uploadECG"> -->
                                                <!-- onclick="window.location.href='proforma-summary.php?id=<?php echo $pid; ?>';">  -->
                                                <!--'patientdata.html';"> -->
                                            </p>
                                        </div>

                                        <div class="col-12 col-lg-5 text-center box">
                                            <span>
                                                <h4>ECG Image</h4>
                                            </span>
                                            <hr><br>
                                            <div id="results">
                                                <img id="selectedImage"
                                                    style="width: 100%; height: auto; display: none; border: 2px solid black; margin:2px; border-radius: 0.3em;" />
                                                <!-- <button id='analyze' style="display: none;" onClick="tak"></button> -->
                                            </div>
                                            <button id="analyze" type="button" name="analyze"
                                                class="btn btn-primary m-2"
                                                style="width: 150px; height: 40px; margin-top: 20px; display: none;"
                                                onclick="analyzeECG();">Analyze</button>
                                            <br><br>



                                            <!-- this section is to show the analysis of the ecg -->
                                            <span>
                                                <h4>Analysis</h4>
                                            </span>
                                            <hr><br>
                                            <div id="analysis" style="text-align: center;">
                                                <p><i>Possibiltiy of STEMI with confidence...</i></p>
                                            </div>
                                            <input type="hidden" name="jsonData" id="jsonData" value="">
                                        </div>









                                        <!-- upload image section -->
                                        <!-- <div class="col-2" style="border: 1px solid black;"> -->

                                        <!-- <br> -->

                                        <!-- </div> -->

                                        <script>
                                            // const uploadFile = document.getElementById("fileToUploadECG");
                                            // const filename = document.getElementById("nameFile");

                                            // uploadFile.addEventListener("change", function () {
                                            //     // filename.innerHTML = "";
                                            //     // console.log("hello");
                                            //     if (uploadFile.files.length > 0) {

                                            //         filename.textContent = uploadFile.files[0].name;
                                            //     } else {
                                            //         filename.textContent = "Choose an ECG";
                                            //     }

                                            // });
                                        </script>
                                        <!-- <div class="col-3" style="border: 1px solid black;"></div> -->


                                    </div>


                                </div>
                                <!-- <div class="col-3"
                                    style="margin-top: 20px;margin-right: 10px;margin-left: 0px; border: 2px solid black; border-radius: 0.3em; height: 200px; width: 200px; background-color: #F5FAFF">
                                    <img id="output" height="200px" width="200px"
                                        style="display: <?php //echo !empty($data['ecgpath']) ? "" : "none";                   ?>; padding: 5px;"
                                        src="<?php //echo !empty($data['ecgpath']) ? $data['ecgpath'] : "";                   ?>">
                                    <label for="output"
                                        style="display:<?php //echo !empty($data['ecgpath']) ? "none" : "";                   ?>;">Uploaded
                                        ECG</label>

                                     // script for image loading dynamically 
                                    <script>
                                        // var loadFile = function (event) {
                                        //     var reader = new FileReader();
                                        //     reader.onload = function () {
                                        //         var output = document.getElementById("output");
                                        //         output.src = reader.result;
                                        //     };

                                        //     $('#output').show();
                                        //     reader.readAsDataURL(event.target.files[0]);
                                        // };
                                    </script>

                                </div> -->
                            </div>
                            <p>
                                <input type="submit" id="chestSave" class="btn btn-warning btn-lg " value="Save"
                                    name="saveproforma">
                                <!-- onclick="window.location.href='proforma-summary1.php?id=<?php //echo $pid;                    ?>';" -->
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>








        <!-- JAVASCRIPT -->
        <script>
            document.getElementById("fillproforma").onclick = function () {
                // Replace "https://www.example.com" with the URL of the page you want to open
                const variableValue = "<?php echo $pid; ?>";

                const url = "proforma11.php?id=" + encodeURIComponent(variableValue);

                // Navigate to the PHP page with the variable as a query parameter
                window.location.href = url;
                // window.open("proforma11.php?id="+);
                // proforma-sum-expert
            };
        </script>
        <script>
            const uploadFile = document.getElementById("fileToUploadECG");
            const filename = document.getElementById("nameFile");
            let fileuploaded = null;
            let flag = false;


            // Function to check if the user is on a mobile device
            function isMobileDevice() {
                console.log(navigator.userAgent);
                return /Mobile|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            }

            // Show the appropriate input element based on device type
            window.onload = function () {
                var fileInputMobile = document.getElementById('mobileCapture');
                var fileInputDesktop = document.getElementById('captureECG');

                if (isMobileDevice()) {
                    // fileInputMobile.style.display = ''; // Show mobile camera capture input
                    fileInputDesktop.style.display = 'none';
                } else {
                    fileInputDesktop.style.display = ''; // Show computer file upload input
                    // fileInputMobile.style.display = 'none';
                }
            };


            uploadFile.addEventListener("change", function () {
                filename.innerHTML = "";
                // console.log("hello");
                if (uploadFile.files.length > 0) {
                    filename.textContent = uploadFile.files[0].name;
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
                    filename.textContent = "Choose a file";
                }

            });



            // var imageData;

            Webcam.set({
                width: 400, //490,
                height: 300,//390,
                image_format: 'jpeg',
                jpeg_quality: 100
            });



            function captureCam() {

                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    console.log('Capturing device online.');
                } else {
                    alert("No capturing device found.")
                }
                camSection = document.getElementById('CamSection');
                captureBtn = document.getElementById('captureECG');

                if (camSection.style.display === "none") {
                    camSection.style.display = '';
                    captureBtn.className = "btn btn-danger";
                    captureBtn.innerHTML = '<i class="fa-solid fa-close"></i> &nbsp; Close camera';
                    // promise = navigator.mediaDevices.getUserMedia({ video: true });
                    Webcam.attach('#my_camera');

                } else {
                    camSection.style.display = 'none';
                    captureBtn.className = "btn btn-primary";
                    captureBtn.innerHTML = '<i class="fa-solid fa-camera"></i>  &nbsp; Capture ECG';
                    // navigator.mediaDevices.getUserMedia({video:false});
                    Webcam.reset();
                }

                captureBtn.blur();

            }


            // Capture image from webcam
            // document.getElementById('captureBtn').addEventListener('click', function () {
            // Webcam.snap(function (data_uri) {
            // console.log("Captured image:", data_uri);

            // Store the captured image data URL in a variable or use it as needed
            // For example, you can display the captured image in an <img> element
            // var capturedImage = document.createElement('img');
            // capturedImage.src = data_uri;
            // document.body.appendChild(capturedImage);

            // Stop webcam capture
            // Webcam.reset();
            // });

            // } else {
            //     // If user chooses to upload a file, trigger file upload dialog
            //     var fileInput = document.createElement('input');
            //     fileInput.setAttribute('type', 'file');
            //     fileInput.setAttribute('accept', 'image/*');
            //     fileInput.click();
            // }


            // Webcam.attach('#my_camera');

            function take_snapshot() {
                Webcam.snap(function (data_uri) {
                    $(".image-tag").val(data_uri);
                    var selectedImage = document.getElementById('selectedImage');
                    selectedImage.src = data_uri; //'<img src="' + data_uri + '"/>';   //'result'.innerHTML
                    selectedImage.style.display = '';
                    // document.getElementById('check').innerHTML = "hello";
                    // imageData = data_uri;
                    // console.log(data_uri);
                    flag = true;

                    // Split the Base64 string to get the image type and data parts
                    var imageParts = data_uri.split(";base64,");
                    var imageTypeAux = imageParts[0].split("image/");
                    var imageType = imageTypeAux[1];

                    // Get the Base64 encoded image data
                    var imageBase64 = imageParts[1];

                    // // Decode the Base64 encoded image data
                    // var decodedImageData = atob(imageBase64);

                    fileuploaded = imageBase64;  // imageData was previously assigned
                    document.getElementById('analyze').style.display = '';
                    // uploadCaptureFile(imageData);
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



            function analyzeECG() {
                // console.log(fileuploaded);
                if (fileuploaded === null) {
                    alert("No ecg image chosen.");
                } else {
                    if (flag === true) {
                        uploadCaptureFile(fileuploaded);
                    } else {
                        var reader = new FileReader();
                        reader.onload = function (event) {
                            var imageData = event.target.result;
                            $(".image-tag").val(imageData);

                            // Check if the uploaded file is an image
                            if (fileuploaded.type.match('image.*')) {
                                // Get the Base64 encoded image data
                                var imageBase64 = imageData.split(";base64,")[1];

                                // Assign the Base64 image data to the imageData variable
                                imageData = imageBase64;

                                // Proceed with further processing or uploading
                                uploadCaptureFile(imageData);
                            } else {
                                // Handle the case when the uploaded file is not an image
                                console.error('The uploaded file is not an image.');
                            }
                        };
                        reader.readAsDataURL(fileuploaded);
                    }
                }
            }


            function uploadCaptureFile(imgfile) {
                // var fileInput = document.getElementById("inputImage");
                var loading = '<div class="spinner-border" role="status"> <span class="visually-hidden"></span> </div> Analyzing...';

                // check if a file is selected
                if (imgfile === null) {
                    alert('Please select a file before analyzing');
                } else {
                    // console.log(imgfile);
                    // buttonLoad = document.getElementById
                    $("#analyze").html(loading);
                    // $("#inputImage").val(loading);
                    $("#analyze").prop("disabled", true);
                    // buttonLoad.html(load);

                    var formData = new FormData();
                    // formData.append('fileInput', imgfile);
                    formData = imgfile;

                    $.ajax(
                        {
                            url: 'http://localhost:9080/perform-ecg',
                            // url: 'http://192.168.43.236:9080/perform-ecg',

                            // url: 'http://10.10.54.231:9080/perform-ocr',
                            // url: 'https://10.10.54.231/smart_er_v3/uploadImage.php',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            crossDomain: true,
                            success: function (response) {
                                const container = document.getElementById('analysis');
                                container.textContent = '';
                                // container.textContent = response + '%';
                                // Split response into lines

                                
                                const lines = response.split('. ');

                                // Create a paragraph element for the response text
                                const responsePara = document.createElement('p');
                                responsePara.textContent = lines[0]; // Display the first line of the response


                                // Append the response paragraph to the container
                                container.appendChild(responsePara);

                                // Create a paragraph element for confidence line
                                const confidencePara = document.createElement('p');
                                confidencePara.textContent = '(' + lines[1] + '%)'; // Display the confidence line
                                container.appendChild(confidencePara);

                                // Determine the color and blinking based on response
                                if (lines[0].startsWith("Likely Stemi")) {
                                    responsePara.style.color = 'red'; // Set text color to red
                                    responsePara.style.animation = 'blinkingText 1s infinite'; // Add blinking animation
                                    confidencePara.style.color = 'red'; // Set text color to red
                                    confidencePara.style.animation = 'blinkingText 1s infinite'; // Add blinking animation
                                } else {
                                    responsePara.style.color = 'green'; // Set text color to green
                                    confidencePara.style.color = 'green'; // Set text color to green
                                }


                                console.log(response);
                                $("#analyze").text("Analyze");
                                $("#analyze").prop("disabled", false);
                                $('#jsonData').val(response);
                            },
                            // success: function (response) {
                            //     var resp = JSON.parse(response)
                            //     // $('#mri-result').html(response);
                            //     $("#analyze").text("Analyze");
                            //     // $("#analyze").val("Capture Monitor");
                            //     $("#analyze").prop("disabled", false);
                            //     console.log(resp);
                            //     // const container = document.getElementById('analysis');

                            //     var jsonString = postTheResponse(resp);
                            //     $('#jsonData').val(jsonString);
                            //     var inp = $('#jsonData').val();
                            //     console.log(inp);
                            //     fileuploaded = null;
                            //     // Set the value of the hidden input field to the JSON string
                            //     // $(document).ready(function () {
                            //     // $('#jsonData').val(jsonString);
                            //     // Get the value of the input element and print it to the console
                            //     // var value = $('#jsonData').val();
                            //     // console.log(value);
                            //     // });
                            // },
                            error: function () {
                                alert('Unable to process image.');
                                $("#analyze").text("Analyze");
                                // $("#analyze").val("Capture Monitor");
                                $("#analyze").prop("disabled", false);
                                // console.log(res)
                            },
                        }
                    );

                }

            }




            function postTheResponse(data) {
                // var statements = data.statements;

                // Get the container element where you want to add the labels and statements
                const container = document.getElementById('analysis');
                container.textContent = '';
                var analysisReport = '';
                // Loop through each label and its corresponding statements
                for (let i = 0; i < data.pred_labels.length; i++) {
                    const label = data.pred_labels[i];
                    const statements = data.statements[i];
                    var labelful;


                    const probable = data.confidence[i].toFixed(3);

                    // Create a <p> element for the label
                    const labelPara = document.createElement('p');

                    switch (label) {
                        // case "CD": labelful = "Conduction Disturbance"; break;
                        case "MI": labelful = "Myocardial Infarction " + "Confidence: " + probable; break;
                        case "STTC": labelful = "ST and T Changes " + "Confidence: " + probable; break;
                        case "NORM": labelful = "Normal " + "Confidence: " + probable; break;
                        // case "HYP": labelful = "Hypertropy"; break;
                        default: labelful = '';
                    }
                    if (label !== '') {
                        // labelPara.innerHTML = '<strong>' + labelful + " </strong>";  //previous version
                        labelPara.innerHTML = labelful;
                        analysisReport += '(' + labelful + ':';
                        // Append the label paragraph to the container
                        container.appendChild(labelPara);
                    }


                    // this section was used in upload-ecg.php
                    // start
                    // // Create a <ul> element for the statements
                    // const ul = document.createElement('ul');

                    // // Loop through each statement and create <li> elements
                    // statements.forEach((statement) => {
                    //     const li = document.createElement('li');
                    //     li.textContent = statement;
                    //     ul.appendChild(li);
                    //     analysisReport += statement + ',';
                    // });
                    // analysisReport += ')/';
                    // // Append the <ul> element to the container
                    // container.appendChild(ul);
                    // end
                }
                return analysisReport;
            }

        </script>








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