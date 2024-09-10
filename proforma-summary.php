<?php
include('connection.php'); //include_once was written
$pid = $_GET['id'];
$sql = "SELECT * FROM patientregistration WHERE patientid = $pid";
$result = mysqli_query($conn, $sql) or die("Failed");
$data = mysqli_fetch_array($result);
// print_r($data['gender']);

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

    <!-- =======================================================
  * Template Name: Moderna - v2.0.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container">

            <div class="logo float-left">
                <h1 class="text-light"><a href="index.html"><span>Smart-ER platform</span></a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav class="nav-menu float-right d-none d-lg-block">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><a href="about.html">About</a></li>

                    <li><a href="blog.html">Contact Us</a></li>

                </ul>

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= About Us Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Proforma Preview</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Proforma Preview</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Contact Section -->




        <section class="fill proforma" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
            <div class="container">

                <form action="" method="post" style="box-sizing: 20px; border: 1px solid black;padding: 5px;">
                    <label for="name" style="text-align: left;padding: 5px;">Name:</label>
                    <input type="text" id="name" value="<?php echo $data['patientName'] ?>">
                    <label for="age_sex" style="text-align: center;padding: 5px;">Age/Sex: </label>
                    <input type="text" id="age_sex" value="<?php echo $data['age'] . ' / ' . $data['gender'] ?>">
                    <label for="date" style="text-align: right;padding: 5px;">Date: </label>
                    <input type="text" id="date" value="<?php echo $data['date'] ?>">
                    <br>
                    <label for="uhid" style="text-align: left;padding: 5px;">UHID No.: </label>
                    <input type="text" id="uhid" value="<?php echo $data['patientid'] ?>">
                    <label for="time" style="text-align: right;padding: 5px;padding-right: 2px;">Time: </label>
                    <input type="text" id="time" value="<?php echo $data['time'] ?>">
                    <!-- </form> -->

                    <div class="container">


                    </div>
                    <h2 style="text-align: center;">Acute chest discomfort proforma</h2>

                    <p style="text-align: center;">
                        (Fill up when a patient presents to the ED with anterior chest discomfort/upper
                        abdominal pain/Jaw pain for < 7d duration) </p>
                            <p style="text-align: center; font-weight: bold;">Call for an ECG immediately</p>

                            <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
                                <div class="container">

                                    <div class="section-title" id="gcc">
                                        <h2>Chest pain descriptors:</h2>
                                    </div>
                                    <!-- <form> -->
                                    <label for="time" style="text-align: right;padding: 5px;">Location: </label>
                                    <input type="text" id="location" name="locatn" value="<?php echo $data['locatn'] ?>">
                                    <br>
                                    <label for="time" style="text-align: right;padding: 5px;">Duration: </label>
                                    <input type="text" name="duration" value="<?php echo $data['duration'] ?>">
                                    <br>
                                    <label for="time" style="text-align: right;padding: 5px;">Character: </label>
                                    <input type="text" name="charactr" value="<?php echo $data['charactr'] ?>">
                                    <br>
                                    <label for="time" style="text-align: right;padding: 5px;">Severity: </label>

                                    <select name="severe" id="severity">
                                        <option value="none">Select</option>
                                        <option value="Mild">Mild</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Servere">Severe</option>
                                    </select>
                                    <br>
                                    <label for="time" style="text-align: right;padding: 5px;">Radiation: </label>
                                    <input type="text" name="radiation">
                                    <br>

                                    <!-- </form> -->
                                </div>
                            </section>

                            <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
                                <div class="container">

                                    <div class="section-title" id="gcc">
                                        <h2>Aggravating/relieving factors:</h2>
                                    </div>



                                    <br>
                                    Tick:
                                    <br>
                                    <input type="checkbox" id="Position" value="Position">
                                    <label for="Position" >Position</label>
                                    <br>
                                    <input type="checkbox" id="Exertion" name="aggravate[]" value="Exertion">
                                    <label for="Exertion" >Exertion</label>
                                    <br>
                                    <input type="checkbox" id="Meals" name="aggravate[]" value="Meals">
                                    <label for="Meals" >Meals</label>
                                    <br>
                                    <input type="checkbox" id="Diurnal" name="aggravate[]" value="Diurnal">
                                    <label for="Diurnal" >Diurnal</label>
                                    <br>
                                    <input type="checkbox" id="Palpation" name="aggravate[]" value="Palpation">
                                    <label for="Palpation" >Palpation</label>
                                    <br>
                                    <input type="checkbox" id="Response to medicines" name="aggravate[]" value="Response to medicines">
                                    <label for="Response to medicines" >Response to medicines</label>
                                    <br>
                                    <br>

                                    Pain similar to previous MI (Y/N):
                                    <input type="checkbox" id="mi" value="yes">
                                    <br>
                                </div>
                            </section>
                            <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
                                <div class="container">

                                    <div class="section-title" id="gcc">
                                        <h2>Comorbidities:</h2>
                                    </div>


                                    <input type="checkbox" name="comorbid[]" id="Diabetes" value="Diabetes">
                                    <label for="Diabetes">Diabetes</label>
                                    <br>
                                    <input type="checkbox" name="comorbid[]" id="Hypertension" value="Hypertension">
                                    <label for="Hypertension">Hypertension</label>
                                    <br>
                                    <input type="checkbox" name="comorbid[]" id="Smoker" value="Smoker">
                                    <label for="Smoker">Smoker</label>
                                    <br>
                                    <input type="checkbox" name="comorbid[]" id="Obesity" value="Obesity">
                                    <label for="Obesity">Obesity</label>
                                    <br>
                                    <input type="checkbox" name="comorbid[]" id="Hypercholesterolemia"
                                        value="Hypercholesterolemia">
                                    <label for="Hypercholesterolemia">Hypercholesterolemia</label>
                                    <br>
                                    <input type="checkbox" name="comorbid[]" id="Family history of CAD"
                                        value="Family history of CAD">
                                    <label for="Family history of CAD">Family history of CAD</label>
                                    <br>
                                    <input type="checkbox" name="comorbid[]" id="Other" value="Other">
                                    <label for="Other">Other</label>
                                    <br>
                                </div>
                            </section>
                            <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
                                <div class="container">

                                    <div class="section-title" id="gcc">
                                        <h2>Known atherosclerotic vascular disease?</h2>
                                    </div>
                                    <input type="checkbox" id="Peripheral arterial disease"
                                        value="Peripheral arterial disease" name="athero[]">
                                    <label for="Peripheral arterial disease">Peripheral arterial disease</label>
                                    <br>
                                    <input type="checkbox" id="Past MI" value="Past MI" name="athero[]">
                                    <label for="Past MI">Past MI</label>
                                    <br>
                                    <input type="checkbox" id="Past coronary revascularization"
                                        value="Past coronary revascularization" name="athero[]">
                                    <label for="Past coronary revascularization">Past coronary revascularization</label>
                                    <br>
                                    <input type="checkbox" id="Stroke" value="Stroke" name="athero[]">
                                    <label for="Stroke">Stroke</label>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </section>
                            <table>
                                <th colspan="2">Associated Complaints (Tick)</th>
                                <tr>
                                    <td>Nausea and vomiting</td>
                                    <td><input type="checkbox" id="NV" name="assoc_comp[]" value="NV"></td>
                                </tr>
                                <tr>
                                    <td>Shortness of breath</td>
                                    <td><input type="checkbox" id="SB" name="assoc_comp[]" value="SB"></td>
                                </tr>
                                <tr>
                                    <td>Syncope </td>
                                    <td><input type="checkbox" id="syn" name="assoc_comp[]" value="syn"></td>
                                </tr>
                                <tr>
                                    <td>Diaphoresis</td>
                                    <td><input type="checkbox" id="diaph" name="assoc_comp[]" value="diaph"></td>
                                </tr>
                                <tr>
                                    <td>Fever</td>
                                    <td><input type="checkbox" id="fever" name="assoc_comp[]" value="fever"></td>
                                </tr>
                                <tr>
                                    <td>Expectoration</td>
                                    <td><input type="checkbox" id="expect" name="assoc_comp[]" value="expect"></td>
                                </tr>
                                <tr>
                                    <td>Hemoptysis</td>
                                    <td><input type="checkbox" id="hemosys" name="assoc_comp[]" value="hemosys"></td>
                                </tr>
                                <tr>
                                    <td>Recent trauma</td>
                                    <td><input type="checkbox" id="trauma" name="assoc_comp[]" value="trauma"></td>
                                </tr>
                                <tr>
                                    <td>Others</td>
                                    <td><input type="checkbox" id="oth" name="assoc_comp[]" value="oth"></td>
                                </tr>
                            </table>

                            <br>
                            <br>
                            <br>

                            <table>
                                <th colspan="2">Vitals</th>
                                <tr>
                                    <td>Pulse</td>
                                    <td><input type="text" id="pulse" name="pulse"></td>
                                </tr>
                                <tr>
                                    <td>BP</td>
                                    <td><input type="text" id="bpright" name="bp"></td>
                                </tr>
                                <!-- <tr>
                        <td>BP (Left)</td>
                        <td><input type="text" id="bpleft" name="bpleft"></td>
                    </tr> -->
                                <tr>
                                    <td>RR</td>
                                    <td><input type="text" id="rr" name="rr"></td>
                                </tr>
                                <tr>
                                    <td>SpO2</td>
                                    <td><input type="text" id="spo2" name="spo"></td>
                                </tr>
                            </table>
                            <br>
                            <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
                                <div class="container">

                                    <div class="section-title" id="gcc">
                                        <h2>On examination:</h2>
                                    </div>

                                    <label for="Pedal">Pedal Edema (Y/N): </label>Pedal edema (Y/N):
                                    <input type="checkbox" id="Pedal" name="on_exam[]" value="Pedal">
                                    <br>
                                    <label for="calftender">Calf tenderness (Y/N): </label>Pedal edema (Y/N):
                                    <input type="checkbox" id="calftender" name="on_exam[]" value="calftender">
                                    <br>
                                    <label for="bil_breath">Bilateral breath sounds (equal?): </label>

                                    <input type="checkbox" id="bil_breath" name="on_exam[]" value="bil_breath">
                                    <br>
                                    Added auscultatory sounds:<input type="text" id="auscul" name="auscult">
                                    <br>
                                    Abdominal tenderness:<input type="text" id="abdtender" name="abdomentend">
                                    <br>
                                </div>
                            </section>
                            <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
                                <div class="container">

                                    <div class="section-title" id="gcc">
                                        <h2>CVS examination:</h2>
                                    </div>


                                    S1 (normal /<input type="checkbox" id="s1" name="cvs[]" value="s1"><label
                                        for="s1"></label>abnormal)
                                    <br>

                                    S2 (normal /<input type="checkbox" id="s2" name="cvs[]" value="s2"><label
                                        for="s2"></label>abnormal),
                                    <br>
                                    S3 (present /<input type="checkbox" id="s3" name="cvs[]" value="s3"><label
                                        for="s3"></label>absent)
                                    <br>
                                    Pericardial rub (present /<input type="checkbox" id="pericard" name="cvs[]"
                                        value="pericard"><label for="pericard"></label>absent)
                                    <br>
                                    Murmur (present /<input type="checkbox" id="murmur" name="cvs[]"
                                        value="murmur"><label for="murmur"></label>absent)
                                    <br>
                                    Describe abnormalities (if any):<input type="text" id="otherAbnormal"
                                        name="desc_abnorm">
                                    <br>
                                    <br>
                                    <br>
                                    <strong>Other clinical inputs:</strong><input type="text" id="otherClinical"
                                        name="clinic_in">
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </section>
                            <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
                                <div class="container">

                                    <div class="section-title" id="gcc">
                                        <h3>HEAR Score</h3>
                                    </div>
                                    <div class="row">
                                        <div id="admin" class="col s12">
                                            <div class="card material-table">
                                                <div class="table-header">
                                                    <h3><span class="table-title"></span></h3>
                                                    <div class="actions">

                                                    </div>
                                                </div>
                                                <table id="datatable">
                                                    <th colspan="3"></th>
                                                    <tr>
                                                        <td>History</td>
                                                        <td>
                                                            <p>
                                                                Slightly suspicious for ACS 0 <br>
                                                                Moderately suspicious 1 <br>
                                                                Highly suspicious 2 <br>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="history" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>ECG changes</td>
                                                        <td>
                                                            <p>
                                                                Normal 0 <br>
                                                                LBBB/LVH or other repolarization abnormalities 1 <br>
                                                                Significant ST deviation 2 <br>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="ecg" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Age</td>
                                                        <td>
                                                            <p>
                                                                < 45 years 0 <br>
                                                                    45-64 years 1 <br>
                                                                    > 65 years 2 <br>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cal_age" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>CV risk factors</td>
                                                        <td>
                                                            <p>
                                                                No risk factors 0 <br>
                                                                1 or 2 risk factors 1 <br>
                                                                > 3 risk factors or documented 2 <br>
                                                                Atherosclerotic vascular disease 2 <br>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cv_risk" value="">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Score:</td>

                                                        <td><input type="hidden" name=""></td>

                                                        <td><input type="text" id="totalScore" name="total" value=""></td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <br>
                                                <br>

                                                <!-- </p> -->
                                                <!-- </td> -->
                                                <!-- </tr> -->
                                                <!-- </table> -->
                                            </div>
                                        </div>
                                    </div>

            <div class="row">
                <div class="col text-center">
                    <!-- <input type="button" id="sumEdit" class="btn btn-warning btn-lg " value="Edit"
                        onclick="window.location.href='patient-register.html';">

                    <input type="button" id="sumSave" class="btn btn-warning btn-lg " value="Save"
                        onclick="window.location.href='next-step.html';"> -->
                    <input type="button" id="next" class="btn btn-warning btn-lg " value="Next"
                        onclick="window.location.href='next-step.html';" ;>
                </div>
            </div>

            </form>

            </div>
            </div>
        </section>

    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer">


        <div class="container">
            <div class="copyright">

            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->

            </div>
        </div>
    </footer><!-- End Footer -->
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