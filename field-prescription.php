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

    <main id="main">
        <section class="about"> <!--data-aos="fade-up"> -->

            <div class="container-fluid" >
                <div class="row text-center" style="text-align: center;">
                    <div class="col" style="text-align: center;">
                        <h2>SMART-ER Platorm<br>Field Treatment Prescription</h2>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col">

                        <div class="row">
                            <!-- <div class="col-2" > -->
                            <span for="name" style="text-align: left;padding: 0px;">Patient name:</span>
                            <!-- </div> -->
                            <!-- <div class="col-3" > -->
                            <span disabled type="text" id="name" value="">
                                <?php //echo $data['patientName']; ?>{{ patientName }}
                            </span><br>
                            <!-- </div> -->
                            <!-- <div class="col-2">
                            </div>   -->
                            <!-- <div class="col-2"> -->
                            <span for="date" style="text-align: left;padding: 0px;">Date:
                            </span>
                            <!-- </div> -->
                            <!-- <div class="col-3"> -->
                            <span disabled type="text" id="date" value="">
                                <?php //echo $data['date']; ?>{{ date }}
                            </span><br>
                            <!-- </div> -->
                            <!-- <div class="row">
                                
                            </div> -->

                            <!-- </div> -->
                            <!-- <div class="row"> -->
                            <!-- <div class="col-2"> -->
                            <span for="uhid" style="text-align: left;padding: 0px;">UHID No.:
                            </span>
                            <!-- </div> -->
                            <!-- <div class="col-3"> -->
                            <span disabled type="text" id="uhid" value="">
                                <?php //echo $data['patientid']; ?>{{ patientid }}
                            </span><br>
                            <!-- </div> -->

                            <!-- <div class="col-2">
                            </div> -->
                            <span for="time" style="text-align: left;padding: 0px;padding-right: 0px;">Time:</span>
                            <!-- </div> -->
                            <!-- <div class="col-3"> -->
                            <span disabled type="text" id="time" value="">
                                <?php //echo $data['time']; ?>{{ time }}
                            </span><br>
                            <!-- </div> -->
                            <!-- </div> -->
                            <!-- <div class="row"> -->
                            <!-- <div class="col-2"> -->
                            <span for="age_sex" style="text-align: center;padding: 0px;">Age/Sex:
                            </span>
                            <!-- </div> -->

                            <!-- <div class="col-3"> -->
                            <span disabled type="text" id="age_sex" value="">
                                <?php //echo $data['age'] . ' / ' . $data['gender']; ?> {{ age/sex }}
                            </span><br>
                            <!-- </div> -->
                            <!-- </div> -->
                            <!-- <div class="col-2">
                                </div> -->
                            <!-- <div class="row" >  -->
                            <!-- <div class="col-2"> -->
                            <span for="Treated by" style="text-align: center;padding: 0px;">Treated
                                by: </span>
                            <!-- </div> -->

                            <!-- <div class="col-3"> -->
                            <span disabled type="text" id="treated_by" value="">
                                <?php //echo $data['treated_by']; ?>{{ treated_by }}</span><br>

                                <span for="Treated by" style="text-align: center;padding: 0px;">Hospital: </span>

                                <span disabled type="text" id="treated_by" value="">
                                <?php //echo $data['treated_by']; ?>{{ hospital }}</span><br><br>
                            <!-- </div> -->
                        </div>
                    </div>
                    <!-- <div class="col-1">
                        </div> -->
                    <!-- 
                        <div class="col-4" >

                            
                        


                        </div> -->
                    <!-- <div class="col-4" >
                        </div> -->
                </div>
                
                <div class="row">
                    <!-- <div class="col-2">
                    </div> -->
                    <!-- <div class="col" style="text-align: left;"> -->
                        <!-- <textarea type="text" id="" name="prescibe" value="" cols="50" rows="20" style="resize: none;" -->
                        <!-- placeholder="Write your prescription here"><?php //echo isset($body) ? $body : ""; ?>{{ prescription }}</textarea> -->
                        <span for="prescribe"><strong>Diagnosis:</strong></span><br>
                        <span id="prescribe">{{ diagnosis }}</span> <br><br>


                        <span for="prescribe"><strong>Prescription:</strong></span><br>
                        <span id="prescribe">{{ prescription }}</span>
                    <!-- </div> -->
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
            </div>

            <!-- <div class="modal-footer"></div> -->
            </div>
            </div>



            </div>

            </div>

            <br>
            <br>
            <br>
        </section>



        <!-- ======= Tetstimonials Section ======= -->


        <!-- ======= Footer ======= -->
        <!-- <footer id="footer" >
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