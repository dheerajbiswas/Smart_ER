<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include ("connection.php");
//Database handing: storing new data
if (isset ($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $salutation = $_POST['salutation'];
    $firstName = trim(ucfirst(strtolower($_POST["firstName"])));
    $middleName = trim(ucfirst(strtolower($_POST["middleName"])));
    $lastName = trim(ucfirst(strtolower($_POST["lastName"])));

    $Name = $firstName . " " . $middleName . " " . $lastName;
    // echo $Name;
    // $Name = $_POST['Name'];
    $Council_registration = trim($_POST['Council_registration']);
    $hospital = trim($_POST['hospital']);
    $phone_no = trim($_POST['phone_no']);
    $whatsapp_no = trim($_POST['whatsapp_no']);
    $email = trim($_POST['email']);
    $speciality = "None";

    $query = "INSERT INTO login (username, password, salute, Name, Council_registration, hospital, phone_no, whatsapp_no, email, speciality, role) 
              VALUES ('$username', '$password', '$salutation', '$Name', '$Council_registration', '$hospital','$phone_no', '$whatsapp_no', '$email', '$speciality', 'user')";

    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";

    } else {
        echo "Error: " . mysqli_error($conn);
    }
    // header line should be written inside the isset() condition
    header("Location: intro.php?token=1");

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

    <!-- Favicons  -->
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


    <!-- <style>
        .box {

            border: 2px solid;
            border-radius: 0.3em;
            margin: 1px;
        }c
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
    <style>
        th,
        table,
        td,
        tr {
            border: 1px solid black;
        }

        th {
            text-align: center;
            padding: 10px 30px;
        }

        table {
            margin-top: 20px;
            margin: auto;
        }

        td {
            padding-left: auto;
            padding-right: 50px;
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
    <header id="header" class="fixed-top" style="height: auto">
        <div class="container">

            <div class="logo float-left">
                <h1 class="text-light"><a href="#"><span>Smart-ER PLATFORM</span></a></h1>
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
                <!-- <h2>Field Login</h2> -->
                <!-- <ol>
                    <li><
                    a href="index.html">Home</a></li>
                    <li>Practitioner Login</li>
                </ol> -->
            </div>
        </div>
    </section>
    <!-- header and breadcrum section -->

    <main id="main" style="margin-top: 0; padding-top:10px;">

        <!-- ======= About Us Section ======= -->


        <!-- End Contact Section -->

        <section style="padding: 0px 0px;">
            <!--class="why-us section-bg> data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">-->
            <div class="container" style="margin-top: 20px;">

                <h2 style="text-align: center;">Field Practitioner Registration</h2>


            </div>
        </section>


        <section style="padding: 5px 5px;">
            <!--class="why-us section-bg> data-aos="fade-up" date-aos-delay="200"> -->
            <div class="container">
                <!-- Chest pain descriptors -->
                <form method="post">
                    <div class="row">
                        <div class='col'></div>
                        <div class="col-lg-6 box">
                            <!-- column-1 -->
                            <div class="row" style="margin-top: 10px;">
                                <!-- <div class="box"> -->
                                <!-- <div class="col" style="margin-top: 20px;"> section-title" id="gcc"> -->
                                <!-- <div class="col-1"></div> -->
                                <!-- </div> -->
                                <div class="col">

                                    <!-- <div class="form"> -->
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="firstName" style="text-align: left;">Salutation:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <select name="salutation" id="salutation" style="width: 190px;" required class="form-control">
                                                <option value="" disabled selected>Select</option>
                                                <option value="Dr.">Dr.</option>
                                                <option value="Mr.">Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Miss">Miss</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="firstName" style="text-align: left;">First Name:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="text" id="firstName" value="" class="form-control" name="firstName" required 
                                                onkeyup="capitalizeFirstLetter(this)">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="middleName" style="text-align: left; ">Middle Name:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="text" id="middleName" value="" class="form-control" name="middleName"
                                                onkeyup="capitalizeFirstLetter(this)">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="lastName" style="text-align: left;">Last Name:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="text" id="lastName" value="" class="form-control" name="lastName" required
                                                onkeyup="capitalizeFirstLetter(this)">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="Council_registration" style="text-align: left;">Medical Council
                                                Registration No.:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="text" id="Council_registration" name="Council_registration"
                                                required value="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="hospital" style="text-align: left;">Hospital:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="text" value="" class="form-control" name="hospital"
                                                onkeyup="capitalizeFirstLetter(this)">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="phone" style="text-align: left;">Mobile No.:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="text" value="" class="form-control" name="phone_no" required>
                                        </div>
                                    </div>


                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="whatsapp" style="text-align: left;">Whatsapp
                                                No.:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="text" value="" class="form-control" name="whatsapp_no">
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="email" style="text-align: left;">Email:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="email" id="email" value="" class="form-control" name="email" required>
                                            <p id="availability-email" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="username" style="text-align: left;">Set username:
                                            </label>
                                        </div>

                                        <div class="col-sm-12 col-">
                                            <input type="text" id="username" value="" class="form-control" name="username" required>
                                            <p id="availability-username" style="color: red;"></p>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="password" style="text-align: left;">Set password:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="password" value="" class="form-control" id="password" name="password" required>
                                            <p id="passwordError" class="error" style="color: red;"></p>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-sm-12 col-">
                                            <label for="confirmpass" style="text-align: left;">Confirm Password:
                                            </label>
                                        </div>
                                        <div class="col-sm-12 col-">
                                            <input type="password" value="" class="form-control" id="confirmpass" name="confirmpass"
                                                id="confirmpass" required>
                                            <p id="confirmPasswordError" class="error" style="color: red;"></p>
                                        </div>
                                    </div>

                                    <br>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                        <div class='col'></div>
                        <!-- </div> -->

                        <div class="container" style="margin: auto; padding-top: 30px">
                            <div class="row align-items-center">
                                <div class="col text-center">
                                    <input type="submit" class="btn btn-warning btn-lg" value="Submit" name="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


    </main>
    </section>
    <!-- ======= Footer ======= -->
    <!-- <footer id="footer">


        <div class="container">
            <div class="copyright">

            </div>
            <div class="credits">
                 All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->
    <!--
    </div>
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
    <!-- the below code is functionally same to the above code -->
    <!-- <script>
        function convertToUppercase(inputField) {
            let inputString = inputField.value;
            let words = inputString.split(' ');

            for (let i = 0; i < words.length; i++) {
                // words[i] = words[i][0].toUpperCase() + words[i].substr(1);
                if (words[i]) {
                    words[i] = words[i][0].toUpperCase() + words[i].substr(1);
                }
            }

            let uppercaseWords = words.join(' ');
            inputField.value = uppercaseWords;
        }

        let inputFields = document.querySelectorAll('.inputField');

        inputFields.forEach(function(inputField){
            inputField.addEventListener('keyup', function () {
                convertToUppercase(inputField);
            });
        });
    </script> -->


    <!-- checking password is matching with confirm password -->
    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmpass');
        const passwordError = document.getElementById('passwordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');

        passwordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validateConfirmPassword);

        function validatePassword() {
            const password = passwordInput.value.trim();

            if (password.length < 6) {
                passwordError.textContent = '* Password must be at least 6 characters.';
            } else {
                passwordError.textContent = '';
                validateConfirmPassword();
            }
        }

        function validateConfirmPassword() {
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();

            if (confirmPassword !== password) {
                confirmPasswordError.textContent = '* Passwords do not match.';
            } else {
                confirmPasswordError.textContent = '';
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // const submitButton = document.getElementById("submitButton");
            const patientidInput = document.getElementById("email");
            const availabilityMessage = document.getElementById("availability-email");

            const userInput = document.getElementById("username");
            const availabilityUsername = document.getElementById("availability-username");

            patientidInput.addEventListener("input", function () {
                const name = patientidInput.value.trim();

                if (name !== "") {
                    fetch("checkemail.php", {
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

            userInput.addEventListener("input", function () {
                const name = userInput.value.trim();

                if (name !== "") {
                    fetch("checkusername.php", {
                        method: "POST",
                        body: JSON.stringify({ name: name }),
                        headers: {
                            "Content-Type": "application/json",
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            availabilityUsername.textContent = data.message;
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
                    availabilityUsername.textContent = "";
                    // availabilityMessage.text("");
                    // submitButton.disabled = true;
                }
            });
        });
    </script>

</body>

</html>