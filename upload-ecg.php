<?php
$pid = isset ($_GET['id']) ? $_GET['id'] : "";
// $pulse = "";

$pr = "";
$bp = "";
$rr = "";
$spo = "";


$target_dir = "uploads/";
$target_file = "";
$uploadOk = 1;
$imageFileType = "";

// Check if image file is a actual image or fake image
if (isset ($_POST["uploadECG"])) {

    $target_file = $target_dir . basename($_FILES["fileToUploadECG"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUploadECG"]["tmp_name"]);
    if ($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    // if(!is_dir($target_dir)){
    //     echo "Directory does not exist.";
    // } else {
    //     mkdir($target_dir, 0755, true);
    // }

    // Check file size
    if ($_FILES["fileToUploadECG"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUploadECG"]["tmp_name"], $target_file)) {
            // echo "The file " . htmlspecialchars(basename($_FILES["fileToUploadECG"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    //run python ocr script

    // header("Location: readVitals.php?file=$target_file");

}
?>

<?php
// Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     // Check if there is an uploaded file
//     if(isset($_POST["uploadECG"])) {
//     echo isset($_FILES["fileToUploadECG"]) ? $_FILES["fileToUploadECG"]: "";
//     if (isset($_FILES["fileToUploadECG"]) && $_FILES["fileToUploadECG"]["error"] === UPLOAD_ERR_OK) {
//         // Specify the target directory to save the uploaded image
//         $targetDir = "capture/";
//         // Create the directory if it doesn't exist
//         if (!file_exists($targetDir)) {
//             mkdir($targetDir, 0777, true);
//         }

//         // Generate a unique name for the uploaded file
//         $targetFile = $targetDir . uniqid() . "_" . $_FILES["fileToUploadECG"]["name"];

//         // Move the uploaded file to the target location
//         if (move_uploaded_file($_FILES["fileToUploadECG"]["tmp_name"], $targetFile)) {
//             echo "Image uploaded successfully. File path: " . $targetFile;
//         } else {
//             echo "Failed to upload image.";
//         }
//     } else {
//         echo "Error uploading image. Please make sure you selected a file.";
//     }
// }
// }
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
    <!-- upload button -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Moderna - v2.0.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <!-- bootstrap cnd -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script> -->


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
    <!-- header and breadcrum section -->

    <main id="main">

        <!-- <section class="breadcrumbs" style="padding-top: 80px">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Field Login</h2>
                    <!- <ol>
                    <li><
                    a href="index.html">Home</a></li>
                    <li>Practitioner Login</li>
                </ol> ->
                </div>
            </div>
        </section> -->


        <!-- ======= About Section ======= -->
        <section class="about"> <!--data-aos="fade-up"> -->

            <div class="container">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col text-center box">
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

                                    <br><br>
                                    <!-- <input type="button"  class="btn btn-primary" name="captureECG" id="captureECG" /> -->
                                    <!-- data-toggle="modal"data-target="#ptureEcg" -->

                                    <input type="file" capture="environment" accept="image/*" />
                                    <button class="btn btn-primary" for="mobileCapture" id="mobileCapture"
                                        name="mobileCapture" style="display: none;">
                                        <i class="fa-solid fa-camera"></i>
                                        &nbsp;
                                        Capture ECG</button>
                                    <br>

                                    <button type="button" class="btn btn-primary" name="captureECG" id="captureECG"
                                        style="display: none;" onclick="captureCam();">
                                        <i class="fa-solid fa-camera"></i>
                                        &nbsp;
                                        Capture ECG</button>
                                    <br>
                                </div>
                                <!-- HTML for the button -->
                                <!-- <button id="captureButton" onclick="captureOrUpload()">Capture or Upload</button> -->

                            </div>

                            <div class="row justify-content-center m-2" id="CamSection" style="display: none;">

                                <div class="col box"
                                    style="border: 0px solid #ccc; min-height 450; max-height: auto; min-width: 450;">
                                    <h5>Camera</h5>
                                    <div class="row justify-content-center">
                                        <!-- <div id="containCam" class="col" style="min-height 450; max-height: auto; min-width: 450;"> -->
                                        <div id="my_camera"></div>
                                        <!-- </div> -->
                                    </div>

                                    <br />
                                    <div class="row">
                                        <div class="col">
                                            <button type="button" name="inputImage" class="btn btn-primary m-2"
                                                id="inputImage" style="width: 150px; height: 50px;" accept="image/*"
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
                                <input type="submit" id="imageSave" class="btn btn-warning btn-lg m-3" value="Save"
                                    name="uploadECG">
                                <!-- onclick="window.location.href='proforma-summary.php?id=<?php //echo $pid;         ?>';">  -->
                                <!--'patientdata.html';"> -->
                            </p>
                        </div>
                        <div class="col text-center box">
                            <span>
                                <h4>ECG Image</h4>
                            </span>
                            <hr><br>
                            <div id="results">
                                <img id="selectedImage"
                                    style="width: 400px; height: 300px; display: none; border: 2px solid black; margin:2px; border-radius: 0.3em;" />
                                <!-- <button id='analyze' style="display: none;" onClick="tak"></button> -->
                            </div>
                            <button id="analyze" type="button" name="analyze" class="btn btn-primary m-2"
                                style="width: 150px; height: 40px; margin-top: 20px; display: none;"
                                onclick="analyzeECG();">Analyze</button>
                            <br><br>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center box">
                            <span>
                                <h4>Analysis</h4>
                            </span>
                            <hr><br>
                            <div id="analysis" style="text-align: left;">
                                <p><i>Analysis from machine learning engine...</i></p>
                            </div>
                            <input type="hidden" name="jsonData" id="jsonData" value="">
                            <br>
                        </div>
                        <div class="col text-center box">
                            <span>
                                <h4>Heatmap Assistance </h4>
                            </span>
                            <hr><br>
                        </div>

                    </div>

                </form>
            </div>

            <!-- </div> -->
        </section>


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
                // filename.innerHTML = "";
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
                var loading = '<div class="spinner-border" role="status"> \
                                        <span class="invisible">Loading</span>\
                                </div> Analyzing...';

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

                            // url: 'http://192.168.54.122:9080/perform-ocr',
                            // url: 'https://10.10.54.231/smart_er_v3/uploadImage.php',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            crossDomain: true,
                            // success: function (response) {
                            //     const container = document.getElementById('analysis');
                            //     container.textContent = '';
                            //     container.textContent = response + '%';
                            //     console.log(response);
                            //     $("#analyze").text("Analyze");
                            //     $("#analyze").prop("disabled", false);
                            //     $('#jsonData').val(response);
                            // },
                            success: function (response) {
                                var resp = JSON.parse(response)
                                // $('#mri-result').html(response);
                                $("#analyze").text("Analyze");
                                // $("#analyze").val("Capture Monitor");
                                $("#analyze").prop("disabled", false);
                                console.log(resp);
                                // const container = document.getElementById('analysis');

                                var jsonString = postTheResponse(resp);
                                $('#jsonData').val(jsonString);
                                var inp = $('#jsonData').val();
                                console.log(inp);
                                fileuploaded = null;
                                // Set the value of the hidden input field to the JSON string
                                // $(document).ready(function () {
                                // $('#jsonData').val(jsonString);
                                // Get the value of the input element and print it to the console
                                // var value = $('#jsonData').val();
                                // console.log(value);
                                // });
                            },
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
                    // Create a <p> element for the label
                    const labelPara = document.createElement('p');

                    switch (label) {
                        case "CD": labelful = "Conduction Disturbance"; break;
                        case "MI": labelful = "Myocardial Infarction"; break;
                        case "STTC": labelful = "ST and T Changes"; break;
                        case "NORM": labelful = "Normal"; break;
                        case "HYP": labelful = "Hypertropy"; break;
                    }
                    labelPara.innerHTML = '<strong>' + labelful + ": </strong>";
                    analysisReport += '(' + labelful + ':';
                    // Append the label paragraph to the container
                    container.appendChild(labelPara);

                    // Create a <ul> element for the statements
                    const ul = document.createElement('ul');

                    // Loop through each statement and create <li> elements
                    statements.forEach((statement) => {
                        const li = document.createElement('li');
                        li.textContent = statement;
                        ul.appendChild(li);
                        analysisReport += statement + ',';
                    });
                    analysisReport += ')/';
                    // Append the <ul> element to the container
                    container.appendChild(ul);
                }
                return analysisReport;
            }










        </script>

        <!-- ======= Tetstimonials Section ======= -->


        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="container">
                <div class="copyright">
                    <!-- &copy; Copyright <strong><span></span></strong>. All Rights Reserved -->
                    <!-- </div> -->
                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->
                        <!-- Designed by -->
                        <!-- <a href="https://bootstrapmade.com/">Bootstrapmade</a> -->
                    </div>
                </div>
        </footer><!-- End Footer -->

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

</body>

</html>