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

    <section class="breadcrumbs" style="padding-top: 20px">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Change Variable</h2>
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
                <div class="row ">
                    <div class="col text-center">
                        <div class="row ">
                            <div class="col">
                                <button class="btn btn-primary" id="flag0" onclick="changeFlag(0)">Flag to 0</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" id="flag1" onclick="changeFlag(1)">Flag to 1</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4" style="text-align: right;">
                                <p class="mt-5">Flag Status:</p>
                            </div>
                            <div class="col-8" style="text-align: left;">
                                <p class="mt-5" id="status"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function changeFlag(value) {
                        // const flag0 = document.getElementById('flag0');
                        // const flag1 = document.getElementById('flag1');

                        // if flag0 is clicked then set the value of flag to '1'
                        // if flag1 is clicked then set the value of flag to '0'

                        $.ajax(
                            {
                                url: 'http://localhost:9080/changeflag',
                                type: 'POST',
                                data: {flag: value},
                                contentType: 'application/json',
                                crossDomain: true,
                                success: function (response) {
                                    $('#status').text(response);
                                    console.log(response);
                                },
                                error: function () {
                                    $('#status').text("Not responding");
                                    console.log("Not responding");
                                }
                            }
                        );
                    }
                    window.onload = function(){
                        $.ajax(
                            {
                                url: 'http://localhost:9080/changeflag',
                                type: 'GET',
                                // data: {flag: value},
                                contentType: 'application/json',
                                crossDomain: true,
                                success: function (response) {
                                    $('#status').text(response);
                                    console.log(response);
                                },
                                error: function () {
                                    $('#status').text("Not responding");
                                    console.log("Not responding");
                                }
                            }
                        );
                    }
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

        </style>
</body>

</html>