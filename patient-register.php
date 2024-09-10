<?php
session_start();
if (empty($_SESSION['username'])) {
    session_abort();
    header("Location: intro.php?token=2");
}

if (isset($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

// fetching data for practitioner
$field = $_SESSION['username'];
if ($field !== "") {
    $sql = "SELECT * FROM login WHERE username = '$field'";
    $pract = mysqli_query($conn, $sql) or die("Failed");
    $pract_detail = mysqli_fetch_array($pract);
    $pract_name = $pract_detail['Name'];
    // echo $pract_name;
    // $pract_wno = $pract_detail['whatsapp_no'];
    $pract_hosp = $pract_detail['hospital'];
}


if (isset($_POST['register'])) {
    $patientName = $_POST['patientName'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $patientid = $_POST['patientid'];
    $presentation = $_POST['presentation'];

    $query = "INSERT INTO patientregistration (patientName, age, gender, date, time, patientid, presentation, treated_by, hospital) 
              VALUES ('$patientName', '$age', '$gender', '$date', '$time', '$patientid', '$presentation', '$pract_name', '$pract_hosp')";

    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }
    // header line should be written inside the isset() condition
    header("Location: patient-vital.php?id=$patientid");

}

// exit;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        // Function to get the current date in YYYY-MM-DD format
        function getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            let month = today.getMonth() + 1;
            let day = today.getDate();

            // Add leading zeros if needed
            if (month < 10) {
                month = "0" + month;
            }
            if (day < 10) {
                day = "0" + day;
            }

            return year + "-" + month + "-" + day;
        }

        // Function to get the current time in HH:MM format
        function getCurrentTime() {
            const today = new Date();
            let hours = today.getHours();
            let minutes = today.getMinutes();

            // Add leading zeros if needed
            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }

            return hours + ":" + minutes;
        }

        // Function to set the date and time fields in the form
        function setDateTimeFields() {
            const currentDate = getCurrentDate();
            const currentTime = getCurrentTime();

            // Set the values for the date and time input fields
            document.getElementById("date").value = currentDate;
            document.getElementById("time").value = currentTime;
        }


        // Call the setDateTimeFields function when the page is loaded
        window.onload = setDateTimeFields;
    </script>

    <!-- tried date using format but did not work -->
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dateInput = document.getElementById("date");

            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = String(currentDate.getMonth() + 1).padStart(2, "0");
            const day = String(currentDate.getDate()).padStart(2, "0");

            const formattedDate = `${year}-${month}-${day}`;

            dateInput.value = formattedDate;
        });
    </script> -->


    <!-- validating form for presentation -->
    <script>
        function validateForm() {
            const presentationSelect = document.getElementById("presentation");

            if (presentationSelect.value === "none") {
                alert("Please select a Type of Presentation.");
                return false;
            }

            return true;
        }
    </script>

    <script>
        // Function to show the success modal
        function showSuccessModal() {
            $('#successModal').modal('show');
        }

        function validateForm() {
            const presentationSelect = document.getElementById("presentation");

            if (presentationSelect.value === "none") {
                alert("Please select a Type of Presentation.");
                return false;
            }

            // If form validation is successful, show the success modal and prevent form submission
            showSuccessModal();
            return false;
        }
    </script>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


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
                        <li>About</li>
                    </ol>
                </div>

            </div> -->
        </section><!-- End About Us Section -->

        <!-- ======= About Section ======= -->
        <section class="about"> <!--data-aos="fade-up"> -->

            <div class="container">
                <span>
                    <h4 style="text-align: center;">Patient Registration</h4>
                </span>

                <form action="" method="POST" id="nameForm">
                    <div class="row box" style="margin-top: 30px;">
                        <div class="col text-center">

                            <div class="row" style="text-justify: inter-word; text-align: justify; padding-top: 20px;">
                                <!-- <p class="font-text-body" ></p>                       -->

                                <!-- <div class="col-1"></div> -->
                                <div class="col justify-content-center">
                                    <div class="row mt-2">
                                        <div class="col m-1">
                                            <label for="patientName">Patient Name:</label>
                                        </div>
                                        <div class="col mr-4 m-1">
                                            <p><input type="text" id="patientName" name="patientName" required
                                                    style="width: 200px;" onkeyup="capitalizeFirstLetter(this)"></p>

                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col m-1">
                                            <label for="age">Age(in years):</label>
                                        </div>
                                        <div class="col mr-4 m-1">
                                            <p><input type="text" id="age" name="age" required style="width: 200px;">
                                            </p>

                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col m-1">
                                            <label for="gender">Gender:</label>
                                        </div>
                                        <div class="col mr-4 m-1">
                                            <div class="custom_select">
                                                <select name="gender" id="gender" required style="width: 200px;">
                                                    <option value="">Select</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-1"></div> -->


                                <div class="col justify-content-center">

                                    <div class="row mt-2">
                                        <div class="col m-1">
                                            <label for="date">Date:</label>
                                        </div>
                                        <div class="col mr-4 m-1">
                                            <p><input type="date" id="date" name="date" required style="width: 200px;">
                                            </p>

                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col m-1">
                                            <label for="time">Time:</label>
                                        </div>
                                        <div class="col mr-4 m-1">
                                            <p><input type="time" id="time" name="time" required style="width: 200px;">
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col m-1">
                                            <label for="patientid">Patient ID:</label>
                                        </div>
                                        <div class="col mr-4 m-1">
                                            <p><input type="text" id="patientid" name="patientid" required
                                                    style="width: 200px;"></p>
                                            <p id="availability-message" style="color: red;"></p>

                                            <!-- <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    const patientidInput = document.getElementById("patientid");
                                                    const availabilityMessage = document.getElementById("availability-message");

                                                    patientidInput.addEventListener("input", function () {
                                                        const pid = patientidInput.value.trim();
                                                        console.log(pid);
                                                        if (pid !== "") {
                                                            fetch(`check-pid-available.php?patientid=${encodeURIComponent(pid)}`)
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    availabilityMessage.textContent = data.message;
                                                                })
                                                                .catch(error => {
                                                                    // console.error("Error:", error);
                                                                });
                                                        } else {
                                                            availabilityMessage.textContent = "";
                                                        }
                                                    });
                                                });
                                            </script> -->

                                            <script>
                                                document.addEventListener("DOMContentLoaded", function () {
                                                    // const submitButton = document.getElementById("submitButton");
                                                    const patientidInput = document.getElementById("patientid");
                                                    const availabilityMessage = document.getElementById("availability-message");

                                                    patientidInput.addEventListener("input", function () {
                                                        const name = patientidInput.value.trim();

                                                        if (name !== "") {
                                                            fetch("checkpatientid.php", {
                                                                method: "POST",
                                                                body: JSON.stringify({ name: name }),
                                                                headers: {
                                                                    "Content-Type": "application/json",
                                                                },
                                                            })
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    availabilityMessage.textContent = data.message;
                                                                })
                                                                .catch(error => {
                                                                    // console.error("Error:", error);
                                                                });
                                                            // if (data.message === "*Patient ID already exist") {
                                                            //     submitButton.disabled = true;
                                                            // } else {
                                                            //     submitButton.disabled = false;
                                                            // }
                                                        } else {
                                                            availabilityMessage.textContent = "";
                                                            // availabilityMessage.text("");
                                                            // submitButton.disabled = true;
                                                        }
                                                    });
                                                });
                                            </script>


                                            <!-- <script>
                                                $(document).ready(function () {
                                                    const nameInput = $("#patientid");
                                                    const availabilityMessage = $("#availability-message");

                                                    nameInput.on("input", function () {
                                                        const name = nameInput.val().trim();

                                                        if (name !== "") {
                                                            $.ajax({
                                                                url: "/checkpatientid.php",
                                                                method: "POST",
                                                                data: JSON.stringify({ name: name }),
                                                                contentType: "application/json",
                                                                dataType: "json",
                                                                success: function (data) {
                                                                    availabilityMessage.text(data.message);
                                                                },
                                                                error: function (error) {
                                                                    // console.error("Error:", error);
                                                                }
                                                            });
                                                        } else {
                                                            availabilityMessage.text("");
                                                        }
                                                    });
                                                });
                                            </script> -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>

                            <div class="row">
                                <div class="col align-center ">
                                    <label for="presentation">Type of Presentation:</label>
                                    <select id="presentation" name="presentation" style="width: 200px;" required>
                                        <option value="none">Select</option>
                                        <option value="Trauma">Trauma </option>
                                        <option value="Non-trauma">Non-Trauma</option>
                                    </select>
                                </div>
                                <br>

                            </div>

                            <br>

                        </div>

                    </div>
                    <div class="row text-center" style="margin-top: 10px;">
                        <div class="col">
                            <input type="submit" class="btn btn-warning btn-lg" value="Register" name="register"
                                id="submitButton"
                                onclick="window.location.href='vitals.php?id=<?php echo $patientid ?>';">
                            <!-- data-toggle="modal" data-target="#successModal"> -->
                        </div>
                    </div>
                </form>
                <!-- modal is not being used -->
                <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                    aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="successModalLabel">Success!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Successfully registered!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onclick="window.location.href='vitals.php?id=<?php echo $patientid ?>';">Ok</button></a>
                            </div>
                        </div>
                    </div>
                </div>



                <script>
                    function capitalizeFirstLetter(input) {
                        let value = input.value;
                        let words = value.split(' ');

                        if (value.length === 0) {
                            input.value = ''; // Handle the case where the field is cleared
                            return;
                        }

                        for (let i = 0; i < words.length; i++) {
                            // words[i] = words[i][0].toUpperCase() + words[i].substr(1);
                            if (words[i]) {
                                words[i] = words[i][0].toUpperCase() + words[i].substr(1);
                            }
                        }

                        // let firstLetter = value.charAt(0).toUpperCase();
                        // let restOfName = value.slice(1).toLowerCase();
                        // input.value = firstLetter + restOfName;
                        input.value = words.join(' ');
                    }
                </script>

                <script>
                    // document.addEventListener("DOMContentLoaded", function () {
                    //     const numberInput = document.getElementById("patientid");

                    //     numberInput.addEventListener("input", function () {
                    //         const inputValue = numberInput.value.trim();

                    //         if (!/^\d{0,10}$/.test(inputValue)) {
                    //             numberInput.setCustomValidity("Invalid input. Please enter a number with up to 10 digits.");
                    //         } else {
                    //             numberInput.setCustomValidity("");
                    //         }
                    //     });
                    // });


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
                    <!-- </div> -->
                <!-- </div> -->
        <!-- </footer> -->
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