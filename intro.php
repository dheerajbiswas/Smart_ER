<?php
session_start();
include ("connection.php");

$tok = isset ($_GET['token']) ? $_GET['token'] : '';
// echo $tok;
if ($tok === '1') {
    echo "<script>alert('Successfully Regitered');</script>";
} elseif ($tok === '2') {
    echo '<script>alert("User Logout");</script>';
    session_unset();
    session_destroy();
    // echo "<script>alert('Successfully Regitration');</script>";
} elseif ($tok === '3') {
    echo '<script>alert("Expert username and password has been entered in Field Login. Try using Expert Login");</script>';
    session_unset();
    session_destroy();
}





// elseif(!isset($_SESSION['token'])) {
//     echo '<script>alert("Please login");</script>';
// }
// $message = $_GET['error']
// $role = "";



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
        href="https://fonts.googleapis.com/css?family=Open+Sans:200,200i,400,400i,600,600i,700,700i|Roboto:200,200i,400,400i,500,500i,700,700i&display=swap"
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
    <header id="header" class="fixed-top header-transparent" style="height: 120px;">
        <div class="col">

            <div class="container">
                <div class="logo">
                    <h1 class="text-light text-center">
                        <span>
                            <a href="intro.php">
                                <div class="row mt-5">
                                    <div class="col text-center">
                                        <img src="assets/img/Logo_IIT_Bhilai.png">
                                    </div>
                                    <div class="col-6 text-center justify-content-between">
                                        <span>SMART-ER</span>
                                        <br>
                                        <span>An IIT Bhilai and AIIMS Raipur Initiative</span>
                                    </div>
                                    <div class="col text-center">
                                        <img src="assets/img/Aims logo.png" class="logo">
                                    </div>
                                </div>
                            </a>
                        </span>
                    </h1>
                </div>
                <!-- Uncomment below if you prefer to use an image logo -->
                <style>
                    @media (max-width: 575.98px) {
                        #header span {
                            font-size: 20px;
                        }

                        #header img {
                            width: 100%;
                        }
                    }

                    @media (min-width: 575.99) {
                        #header img {
                            width: 200%;
                        }
                    }
                </style>

            </div>

        </div>
    </header><!-- End Header -->

    <!-- MODAL FOR Field LOGIN -->
    <div class="modal fade" id="practitionerLogin" role="dialog" style="top: 10%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Field Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="row p-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col-4" style="text-align: right;">
                                        <label class="p-2" for="fieldUserid">Username:</label>
                                    </div>
                                    <div class="col"><input type="text" name="username" id="fieldUserid" value=""
                                            class="form-control" placeholder="Practitioner"></div>
                                </div>

                                <!-- <br><br> -->
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col-4" style="text-align: right;">
                                        <label class="p-2" for="fieldPassword">Password:</label>
                                    </div>
                                    <div class="col">
                                        <input type="password" name="password" id="fieldPassword" value=""
                                            class="form-control" placeholder="Practitioner@123">
                                    </div>
                                </div>
                                <!-- <br><br> -->
                                <!-- <span style="font-size: 100%; ">Password:</span> -->
                            </div>
                        </div>
                        <!-- <div class="col">
                            <?php //echo '<p class="text-center" style="color:red;">' . ($message) ? $message : '' . '<p/>';                             ?>
                        </div> -->
                    </div>

                    <div class="modal-footer justify-content-center">
                        <!-- <span> -->

                        <button type="submit" id="fieldLogin" class="btn btn-warning" value="Login" name="btnLogin">
                            <!-- onclick="window.location.href='patient-register.php';" -->
                            Login</button>

                        <!-- </span> -->
                        <script type="text/javascript">
                            const login = document.getElementById("practitionerLogin");
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
            </div>
        </div>
    </div>

    <!-- MODAL FOR EXPERT LOGIN -->
    <div class="modal fade" id="expertLogin" role="dialog" style="top: 10%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Expert Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="expertcode.php" method="POST">
                    <div class="modal-body">
                        <div class="row p-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col-4" style="text-align: right;">
                                        <label class="p-2" for="expUserid">Username:</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="username" id="expUserid" value="" class="form-control"
                                            placeholder="Expert">
                                    </div>

                                </div>
                            </div>

                            <!-- <br><br> -->
                        </div>

                        <div class="row p-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col-4" style="text-align: right;">
                                        <label class="p-2" for="expPassword">Password:</label>
                                    </div>
                                    <div class="col">
                                        <input type="password" name="password" id="expPassword" value=""
                                            class="form-control" placeholder="Expert@123">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="row">
                            <div class="col" style="text-align: center;">
                                <label for="expUserid">Username:</label>
                                <br><br>
                                <label for="expPassword">Password:</label>
                            </div>
                            <div class="col" style="align-content: left;">
                                <input type="text" name="username" id="expUserid" value="" placeholder="expert">
                                <br><br>
                                <span style="font-size: 100%; ">Password:</span>
                                <input type="password" name="password" id="expPassword" value="" placeholder="password">
                            </div>
                        </div> -->
                    </div>

                    <div class="modal-footer justify-content-center">
                        <!-- <span> -->

                        <button type="submit" id="expLogin" class="btn btn-warning" value="Login"
                            name="btnLogin">Login</button>
                        <!-- onclick="window.location.href='patient-list.php';" -->

                        <!-- </span> -->
                        <script type="text/javascript">
                            const expert_login = document.getElementById("expertLogin");
                            const expert_userid = document.getElementById('expUserid');
                            const expert_passwd = document.getElementById('expPassword');

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
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL FOR Patient LOGIN -->
    <div class="modal fade" id="patientLogin" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Patient Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="patientcode.php" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col" style="text-align: center;">
                                <label for="patientlogin">Registration No.:</label>
                                <!-- <br><br>
                                <label for="fieldPassword">Password:</label> -->
                            </div>

                            <div class="col" style="align-content: left;">
                                <input type="text" name="patientLogin" id="patientLogin" value=""
                                    placeholder="e.g., 20122345">
                                <!-- <br><br> -->
                                <!-- <span style="font-size: 100%; ">Password:</span> -->
                                <!-- <input type="password" name="password" id="fieldPassword" value="" placeholder="password"> -->
                            </div>
                        </div>
                        <div class="col">
                            <?php //echo '<p class="text-center" style="color:red;">' . ($message) ? $message : '' . '<p/>';                             ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <span> -->

                        <button type="submit" id="patientLoginBtn" class="btn btn-warning" value="Login"
                            name="btnLogin">
                            <!-- onclick="window.location.href='patient-register.php';" -->
                            Login</button>

                        <!-- </span> -->
                        <script type="text/javascript">
                            const practitionerLogin = document.getElementById("practitionerLogin");
                            const practitionerUserid = document.getElementById('fieldUserid');
                            const practitionerPasswd = document.getElementById('fieldPassword');

                            practitionerUserid.addEventListener('keyup', (e) => {
                                const value = e.currentTarget.value;
                                practitionerLogin.disabled = false;

                                if (value === "") {
                                    practitionerLogin.disabled = true;
                                }
                            });

                            practitionerPasswd.addEventListener('keyup', (e1) => {
                                const value1 = e1.currentTarget.value;
                                practitionerLogin.disabled = false;

                                if (value1 === "") {
                                    practitionerLogin.disabled = true;
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
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL FOR Medical Store LOGIN -->
    <div class="modal fade" id="medicalshopLogin" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Medical Store Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <form action="medicalcode.php" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col" style="text-align: center;">
                                <label for="medusername">Username:</label>
                                <br><br>
                                <label for="medPassword">Password:</label>
                            </div>

                            <div class="col" style="align-content: left;">
                                <input type="text" name="medusername" id="medusername" value="" placeholder="username">
                                <br><br>
                                <!-- <span style="font-size: 100%; ">Password:</span> -->
                                <input type="password" name="medPassword" id="medPassword" value=""
                                    placeholder="password">
                            </div>
                        </div>
                        <div class="col">
                            <?php //echo '<p class="text-center" style="color:red;">' . ($message) ? $message : '' . '<p/>';                             ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <span> -->

                        <button type="submit" id="medicalLogin" class="btn btn-warning" value="Login" name="btnLogin">
                            <!-- onclick="window.location.href='patient-register.php';" -->
                            Login</button>

                        <!-- </span> -->
                        <script type="text/javascript">
                            const medicalLogin = document.getElementById("practitionerLogin");
                            const medicalUserid = document.getElementById('fieldUserid');
                            const medicalPasswd = document.getElementById('fieldPassword');

                            medicalUserid.addEventListener('keyup', (e) => {
                                const value = e.currentTarget.value;
                                medicalLogin.disabled = false;

                                if (value === "") {
                                    medicalLogin.disabled = true;
                                }
                            });

                            medicalPasswd.addEventListener('keyup', (e1) => {
                                const value1 = e1.currentTarget.value;
                                medicalLogin.disabled = false;

                                if (value1 === "") {
                                    medicalLogin.disabled = true;
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
                </form>
            </div>
        </div>
    </div>



    <style type="text/css">
        .blinking {
            animation: blinkingText 0.8s infinite;
            font-style: italic;
        }

        @keyframes blinkingText {
            0% {
                color: red;
            }

            50% {
                color: transparent;
            }

            75% {
                color: transparent;
            }

            100% {
                color: red;
            }
        }
    </style>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
    </section>
    <!-- End Hero -->
    <section class="d-flex justify-content-center">
        <div class="container">
            <div class="row">
                <nav class="nav-menu float-left d-none d-lg-block">
                    <ul>
                        <li class="active" style="color: black; "><a href="">Home</a></li>
                        <li><a href="about.html" style="color: black; ">About </a></li>
                        <li><a href="contact.html" style="color: black; ">Contact Us</a></li>
                    </ul>
                </nav><!-- .nav-menu -->
            </div>
        </div>
    </section>

    <section class="why-us section-bg"> <!--  data-aos="fade-up" date-aos-delay="20"> -->
        <div class="container">
            <div class="section-title">
                <div class="section-content relative">

                    <div id="gap-383814002" class="gap-element clearfix" style="display:block; height:auto;">

                        <style>
                            #gap-383814002 {
                                padding-top: 50px;
                            }
                        </style>
                    </div>

                    <div class="row align-middle align-center" id="row-1368557726">
                        <div id="col-1419722239" class="col medium-10 small-12 large-10">
                            <div class="col-inner text-center">
                                <h3> <span style="font-size: 100%; color: #232323;">SMART-ER PLATFORM</span></h3>
                                <div class="is-divider divider clearfix"
                                    style="max-width:150px;background-color:rgb(211, 17, 17);">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-equal align-center row-box-shadow-3 row-box-shadow-5-hover"
                        id="row-361995169">

                        <div id="col-1793169867" class="col medium-4 small-12 large-4">
                            <div class="col-inner">
                                <div id="divd" class="icon-box featured-box icon-box-center text-align"
                                    style="padding-top: 0px;">
                                    <!-- <div class="icon-box-img"
                                        style="max-width:300px;background-color:rgb(211, 17, 17); padding-left: 150px; ">
                                        <div class="icon">
                                            <div class="icon-inner" style="color:rgb(34, 34, 34); ">
                                                <img width="120" height="120" src="assets/img/loginimage.jpg"
                                                    class="attachment-medium size-medium" alt="" loading="lazy">
                                            </div>
                                        </div>
                                    </div> -->




                                    <div id="chooseLogin" class="icon-box-text last-reset">
                                        <div id="text-2676752626__" class="text-center">

                                            <!-- <span style="font-size: 100%; ">User Name:</span>
                                            <input type="text" name="userid" id="userid" value="">
                                            <br><br>

                                            <span style="font-size: 100%; ">Password:</span>
                                            <input type="password" name="password" id="password" value="">
                                            <br><br> -->
                                            <span>
                                                <input type="button" id="practitionerLogin" data-toggle="modal"
                                                    data-target="#practitionerLogin" style="width: 250px;"
                                                    class="btn btn-primary btn-lg " value="Field Login">
                                                <!-- onclick="window.location.href='index.html';" -->
                                                <br><br>
                                                <a href="fieldregistration.php"
                                                    style="text-decoration: underline;">Register as a field
                                                    practitioner</a>
                                            </span>
                                            <!-- <script type="text/javascript">
                                                const login = document.getElementById("login");
                                                const userid = document.getElementById('userid');
                                                const passwd = document.getElementById('password');
                                                var isthere = "";

                                                userid.addEventListener('keyup', (e) => {
                                                    const value = e.currentTarget.value;
                                                    login.disabled = false;
                                                    isthere = value;

                                                    if (value === "") {
                                                        login.disabled = true;
                                                    }

                                                    passwd.addEventListener('keyup', (e1) => {
                                                        const value1 = e1.currentTarget.value;
                                                        send.disabled = false;

                                                        if (value1 === "") {
                                                            if (isthere === "") {
                                                                send.disabled = true;
                                                            }
                                                        }
                                                    });

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

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-inner p-0" style="height: 0;">
                                <div id="divd" class="icon-box featured-box icon-box-center text-align"
                                    style="padding-top: 0px;">
                                    <!-- <div class="icon-box-img"
                                        style="max-width:300px;background-color:rgb(211, 17, 17); padding-left: 150px; ">
                                        <div class="icon">
                                            <div class="icon-inner" style="color:rgb(34, 34, 34); ">
                                                <img width="120" height="120" src="assets/img/loginimage.jpg"
                                                    class="attachment-medium size-medium" alt="" loading="lazy">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div id="chooseLogin" class="icon-box-text last-reset">
                                        <div id="text-2676752626__" class="text-center">

                                            <!-- <span style="font-size: 100%; ">User Name:</span>
                                            <input type="text" name="userid" id="userid" value="">
                                            <br><br>

                                            <span style="font-size: 100%; ">Password:</span>
                                            <input type="password" name="password" id="password" value="">
                                            <br><br> -->

                                            <!-- the button for patient login is deactivated -->
                                            <!-- <span>
                                                <input type="button" id="patientLogin" data-toggle="modal"
                                                    data-target="#patientLogin" style="width: 250px;"
                                                    class="btn btn-primary btn-lg " value="Patient Login"> -->
                                            <!-- onclick="window.location.href='index.html';" -->
                                            <!-- <br><br>
                                                <p
                                                    style="color: green;">Patient registered by Field Practitioner can login</p>
                                            </span> -->



                                            <!-- <script type="text/javascript">
                                                const login = document.getElementById("login");
                                                const userid = document.getElementById('userid');
                                                const passwd = document.getElementById('password');
                                                var isthere = "";

                                                userid.addEventListener('keyup', (e) => {
                                                    const value = e.currentTarget.value;
                                                    login.disabled = false;
                                                    isthere = value;

                                                    if (value === "") {
                                                        login.disabled = true;
                                                    }

                                                    passwd.addEventListener('keyup', (e1) => {
                                                        const value1 = e1.currentTarget.value;
                                                        send.disabled = false;

                                                        if (value1 === "") {
                                                            if (isthere === "") {
                                                                send.disabled = true;
                                                            }
                                                        }
                                                    });

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

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div> <!-- end first icon and icon text-->





                        <div id="col-1793169867" class="col medium-4 small-12 large-4">
                            <div class="col-inner">
                                <div class="icon-box featured-box icon-box-center text-align" style="padding-top: 0px;">
                                    <!-- <div class="icon-box-img"
                                        style="max-width:300px;background-color:rgb(211, 17, 17); padding-left: 150px; ">
                                        <div class="icon">
                                            <div class="icon-inner" style="color:rgb(34, 34, 34); ">
                                                <img width="120" height="120" src="assets/img/loginimage.jpg"
                                                    class="attachment-medium size-medium" alt="" loading="lazy">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div id="login" class="icon-box-text last-reset">
                                        <div id="text-2676752626__" class="text-center">
                                            <!-- 
                                            <span style="font-size: 100%; ">User Name:</span>
                                            <input type="text" name="userid" id="userid" value="">
                                            <br><br>

                                            <span style="font-size: 100%; ">Password:</span>
                                            <input type="password" name="password" id="password" value="">
                                            <br><br> -->
                                            <span>
                                                <input type="button" id="expertLogin" data-toggle="modal"
                                                    data-target="#expertLogin" class="btn btn-primary btn-lg"
                                                    style="width: 250px;" value="Expert Login">
                                                <!-- onclick="window.location.href='index.html';" -->
                                                <br><br>
                                                <a href="expertregistration.php"
                                                    style="text-decoration: underline;">Register as an expert</a>

                                            </span>
                                            <!-- 
                                            <script type="text/javascript">
                                                const login = document.getElementById("login");
                                                const userid = document.getElementById('userid');
                                                const passwd = document.getElementById('password');
                                                var isthere = "";

                                                userid.addEventListener('keyup', (e) => {
                                                    const value = e.currentTarget.value;
                                                    login.disabled = false;
                                                    isthere = value;

                                                    if (value === "") {
                                                        login.disabled = true;
                                                    }

                                                    passwd.addEventListener('keyup', (e1) => {
                                                        const value1 = e1.currentTarget.value;
                                                        send.disabled = false;

                                                        if (value1 === "") {
                                                            if (isthere === "") {
                                                                send.disabled = true;
                                                            }
                                                        }
                                                    });

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

                                        </div>
                                    </div>

                                </div>
                                <script type="text/javascript">
                                    function changeDiv() {
                                        var div = document.getElementById('divd').innerHTML;
                                        console.log(div);
                                        if (div === "chooseLogin") {
                                            document.getElementById('divd').innerHTML = login;
                                        }
                                    }
                                </script>
                            </div>


                            <div class="col-inner p-0" style="height: 0px;">
                                <div id="divd" class="icon-box featured-box icon-box-center text-align"
                                    style="padding-top: 0px;">
                                    <!-- <div class="icon-box-img"
                                        style="max-width:300px;background-color:rgb(211, 17, 17); padding-left: 150px; ">
                                        <div class="icon">
                                            <div class="icon-inner" style="color:rgb(34, 34, 34); ">
                                                <img width="120" height="120" src="assets/img/loginimage.jpg"
                                                    class="attachment-medium size-medium" alt="" loading="lazy">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div id="chooseLogin" class="icon-box-text last-reset">
                                        <div id="text-2676752626__" class="text-center">

                                            <!-- <span style="font-size: 100%; ">User Name:</span>
                                            <input type="text" name="userid" id="userid" value="">
                                            <br><br>

                                            <span style="font-size: 100%; ">Password:</span>
                                            <input type="password" name="password" id="password" value="">
                                            <br><br> -->




                                            <!-- the button for medical login is deactivated -->
                                            <!-- <span>
                                                <input type="button" id="medicalshopLogin" data-toggle="modal"
                                                    data-target="#medicalshopLogin" style="width: 250px;"
                                                    class="btn btn-primary btn-lg " value="Medical shop Login"> -->
                                            <!-- onclick="window.location.href='index.html';" -->
                                            <!-- <br><br>
                                                <a href="medical-register.php"
                                                    style="text-decoration: underline;">Create store account</a>
                                            </span> -->




                                            <!-- <script type="text/javascript">
                                                const login = document.getElementById("login");
                                                const userid = document.getElementById('userid');
                                                const passwd = document.getElementById('password');
                                                var isthere = "";

                                                userid.addEventListener('keyup', (e) => {
                                                    const value = e.currentTarget.value;
                                                    login.disabled = false;
                                                    isthere = value;

                                                    if (value === "") {
                                                        login.disabled = true;
                                                    }

                                                    passwd.addEventListener('keyup', (e1) => {
                                                        const value1 = e1.currentTarget.value;
                                                        send.disabled = false;

                                                        if (value1 === "") {
                                                            if (isthere === "") {
                                                                send.disabled = true;
                                                            }
                                                        }
                                                    });

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

                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div> <!-- end second icon and icon text-->





                        <style>
                            #row-361995169>.col>.col-inner {
                                padding: 40px 20px 50px 20px;
                                border-radius: 35px;
                            }
                        </style>

                    </div>


                </div>
            </div>
        </div>


    </section>


    <main id="main">
        <!-- <center class="mb-3"> -->
        <!--<h3>Expression of Interest (EOI) for Empanelment of Service Providers for IT Manpower Insourcing. 
                <a href=" ">Click to know more</a>.</h3>-->

        <!-- </center> -->

    </main><!-- End #main -->

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
</body>

</html>