<?php
include('connection.php'); //include_once was written
$pid = $_GET['id'] ? $_GET['id'] : "";
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = $pid";
    $result = mysqli_query($conn, $sql) or die("Failed");
    $data = mysqli_fetch_array($result);
}

// print_r($data['gender']);

?>
<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// include("connection.php");


// $pf_history = 0;
// $pf_ecg = 0;
// $pf_age = 0;
// $pf_cv_risk = 0;
// // $pf_total = $_POST['total'];

// $total = $pf_history + $pf_ecg + $pf_age + $pf_cv_risk;

// //Database handing: storing new data
// if (isset($_POST['submit'])) {
//     //declare variables
//     $pflocation = $_POST['locatn'];
//     $pf_duration = $_POST['duration'];
//     $pf_charactr = $_POST['charactr'];
//     $pf_severity = $_POST['severe'];
//     $pf_radiation = $_POST['radiation'];

//     $pf_aggravate = $_POST['aggravate'];
//     $pf_agg = implode(",", $pf_aggravate);

//     $pf_comorbid = $_POST['comorbid'];
//     $pf_com = implode(",", $pf_comorbid);

//     $pf_athero = $_POST['athero'];
//     $pf_ath = implode(",", $pf_athero);

//     $pf_assoc_comp = $_POST['assoc_comp'];
//     $pf_ass = implode(",", $pf_assoc_comp);

//     $pf_pulse = $_POST['pulse'];
//     $pf_bp = $_POST['bp'];
//     $pf_rr = $_POST['rr'];
//     $pf_spo = $_POST['spo'];

//     $pf_on_exam = $_POST['on_exam'];
//     $pf_on = implode(",", $pf_on_exam);

//     $pf_auscult = $_POST['auscult'];
//     $pf_abdomentend = $_POST['abdomentend'];

//     $pf_cvs_tick = $_POST['cvs'];
//     $pf_cvs = implode(",", $pf_cvs_tick);

//     $pf_desc_abnorm = $_POST['desc_abnorm'];
//     $pf_clinic_in = $_POST['clinic_in'];

//     $pf_history = $_POST['history'];
//     $pf_ecg = $_POST['ecg'];
//     $pf_age = $_POST['cal_age'];
//     $pf_cv_risk = $_POST['cv_risk'];
//     $pf_total = $_POST['total'];

//     $total = $pf_history + $pf_ecg + $pf_age + $pf_cv_risk;

//     //write the query to update database
//     $query = "UPDATE patientregistration SET    locatn='$pflocation',
//                                                 duration='$pf_duration',
//                                                 charactr='$pf_charactr',
//                                                 severe='$pf_severity',
//                                                 radiation='$pf_radiation',
//                                                 aggravate='$pf_agg',
//                                                 comorbid='$pf_com',
//                                                 athero='$pf_ath',
//                                                 assoc_comp='$pf_ass',
//                                                 pulse='$pf_pulse',
//                                                 bp='$pf_bp',
//                                                 rr='$pf_rr',
//                                                 spo='$pf_spo',
//                                                 on_exam='$pf_on',
//                                                 auscult='$pf_auscult',
//                                                 abdomentend='$pf_abdomentend',
//                                                 cvs='$pf_cvs',
//                                                 desc_abnorm='$pf_desc_abnorm',
//                                                 clinic_in='$pf_clinic_in',
//                                                 history='$pf_history',
//                                                 ecg='$pf_ecg',
//                                                 cal_age='$pf_age',
//                                                 cv_risk='$pf_cv_risk',
//                                                 total='$pf_total'
//                                                 WHERE patientid=$pid";

//     // $query = "UPDATE patientregistration SET locatn='raipur', duration='1hour' WHERE patientid=$pid";


//     if (mysqli_query($conn, $query)) {
//         echo "<script>alert('Data inserted into the database');</script>";
//     } else {
//         echo "Error: " . mysqli_error($conn);
//     }
//     //write redirect link here
//     header("Location: chest-pain-proforma.php?id=$pid");


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


    <style>
        .box {

            border: 2px solid;
            border-radius: 0.3em;
            margin: 1px;
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

    <main id="main" style="margin-top: 0; padding-top:10px;">

        <!-- ======= About Us Section ======= -->


        <!-- End Contact Section -->

        <section style="padding: 0px 0px;">
            <!--class="why-us section-bg> data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">-->
            <div class="container" style="padding: 0px;">

                <!-- Patient details // action=""-->
                <div method="post" style="box-sizing: 20px; padding: 5px;" class="box">
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label for="name" style="text-align: left;padding: 5px;">Name:</label>
                                </div>
                                <div class="col">
                                    <input disabled type="text" id="name" value="<?php echo $data['patientName'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="uhid" style="text-align: left;padding: 5px;">UHID No.: </label>
                                </div>
                                <div class="col">
                                    <input disabled type="text" id="uhid" value="<?php echo $data['patientid'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label for="age_sex" style="text-align: center;padding: 5px;">Age/Sex: </label>
                                </div>
                                <div class="col">
                                    <input disabled type="text" id="age_sex"
                                        value="<?php echo $data['age'] . ' / ' . $data['gender'] ?>">
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <label for="date" style="text-align: right;padding: 5px;">Date: </label>
                                </div>
                                <div class="col">
                                    <input disabled type="text" id="date" value="<?php echo $data['date'] ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="time" style="text-align: right;padding: 5px;padding-right: 2px;">Time:

                                </div>
                                <div class="col">
                                    <input disabled type="text" id="time" value="<?php echo $data['time'] ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <br>
                <!-- <div class="container"></div> -->
                <h2 style="text-align: center;">Acute chest discomfort proforma</h2>

                <p style="text-align: center;">(Fill up when a patient presents to the ED with anterior chest
                    discomfort/upper abdominal pain/Jaw pain for < 7d duration)</p>
                        <p style="text-align: center; font-weight: bold;">Call for an ECG immediately</p>
            </div>
        </section>


        <!-- <div class="row">
            <div class="col">

            </div>
            <div class="col">

            </div>
        </div>

        <form> -->

        <section style="padding: 0px 0px;">
            <!--class="why-us section-bg> data-aos="fade-up" date-aos-delay="200"> -->
            <div class="container">
                <!-- Chest pain descriptors -->
                <div class="row">
                    <!-- column-1 -->
                    <div class="col box">
                        <!-- <div class="box"> -->
                        <div class="row" style="margin-top: 20px;"> <!-- section-title" id="gcc">-->
                            <div class="col text-center">
                                <h5>Chest pain descriptors</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">

                                <div class="row">
                                    <div class="col">
                                        <label for="locatn" style="text-align: left; padding: 5px;">Location:
                                        </label>
                                    </div>
                                    <div class="col">
                                        <input type="text" id="locatn" value="<?php echo $data['locatn']; ?>"
                                            name="locatn">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="duration" style="text-align: right;padding: 5px;">Duration:
                                        </label>

                                    </div>
                                    <div class="col">
                                        <input type="text" id="duration" name="duration"
                                            value="<?php echo $data['duration']; ?>">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="charactr" style="text-align: right;padding: 5px;">Character:
                                        </label>

                                    </div>
                                    <div class="col">
                                        <input type="text" value="<?php echo $data['charactr']; ?>" name="charactr">

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <label for="severity" style="text-align: right;padding: 5px;">Severity:
                                        </label>

                                    </div>
                                    <div class="col">
                                        <input type="text" name="severe" id="severity" style="width: 190px;"
                                            value="<?php echo $data['severe']; ?>">
                                            <!-- <option value="None">Select</option>
                                            <option value="Mild">Mild</option>
                                            <option value="Moderate">Moderate</option>
                                            <option value="Servere">Severe</option>  -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="radiation" style="text-align: right;padding: 5px;">Radiation:
                                        </label>

                                    </div>
                                    <div class="col">
                                        <input type="text" id="radiation" name="radiation"
                                            value="<?php echo $data['radiation']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <hr>
                        <div class="row " style="margin-top: 20px;">
                            <!-- section-title" id="gcc">-->
                            <div class="col text-center">
                                <h5>Vitals</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="pulse" style="text-align: left; padding: 5px;">Pulse:</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" id="pulse" name="pulse" value="<?php echo $data['pulse']; ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="bright" style="text-align: left; padding: 5px;">Blood
                                            Pressure:</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" id="bpright" name="bp" value="<?php echo $data['bp']; ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="rr" style="text-align: left; padding: 5px;">Respiratory
                                            Rate:</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" id="rr" name="rr" value="<?php echo $data['rr']; ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="spo2" style="text-align: left; padding: 5px;">SpO2:</label>
                                    </div>
                                    <div class="col">
                                        <input type="text" id="spo2" name="spo" value="<?php echo $data['spo']; ?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- <div class="col"> -->

                        <!-- </div> -->


                    </div>

                    <!-- column-2 -->
                    <div class="col box">
                        <div class="row" style="margin-top: 20px;">
                            <div class="col text-center">
                                <!-- <div class="section-title" id="gcc"> -->
                                <h5 for="aggFactor">Aggravating Factors</h5>
                                <!-- </div> -->
                                <textarea type="text" id="aggFactor" name="aggFactor" rows="8" cols="30"
                                    style="resize: none;"><?php echo !empty($data['aggravate']) ? $data['aggravate'] : ""; ?>
                                
<?php 
// $arr = explode(",", $data['athero']); 
//         var_dump($arr);
?>
                                
                                </textarea>
                            </div>
                        </div>
                        <hr style="margin-top: 30px; margin-bottom 30px;">
                        <div class="row" style="margin-top: 20px">
                            <div class="col text-center">
                                <!-- <div class="section-title" id="gcc"> -->
                                <h5 for="relieveFactor">Relieving Factors</h5>
                                <!-- </div> -->
                                <textarea type="text" id="relieveFactor" name="relieveFactor" rows="8" cols="30"
                                    style="resize: none;"><?php echo $data['comorbid']; ?></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- column-3 -->
                    <div class="col box">
                        <div class="row" style="margin-top: 20px;">

                            <!-- <div class="row"> -->
                            <div class="col">
                                <div>
                                    <h5>Tick:</h5>
                                </div>

                                <!-- <label for="Peripheral arterial disease">Peripheral arterial disease</label> -->

<?php
// $ath = explode(",", $data['athero']); 
// $ch = array();
// foreach($ath as $checks) {
    
?>
                                <input type="checkbox" id="noneTick" name="athero[]" value="None" <?php echo (strpos($data['athero'], "None")!==false) ? "checked":""; ?>>
                                <!-- onclick="check(this)"  -->
                                <label for="noneTick" style="text-align: left; padding: 1px;">None</label>
                                <br>
                                <input type="checkbox" id="Peripheral arterial disease"
                                    value="Peripheral arterial disease" name="athero[]" <?php echo (strpos($data['athero'], "Peripheral arterial disease")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;"
                                    for="Peripheral arterial disease">Peripheral arterial disease</label>
                                <br>
                                <input type="checkbox" id="Past MI" value="Past MI" name="athero[]" <?php echo (strpos($data['athero'], "Past MI")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="Past MI">Past MI</label>
                                <br>
                                <input type="checkbox" id="Past coronary revascularization" <?php echo (strpos($data['athero'], "Past coronary revascularization")!==false) ? "checked":""; ?>
                                    value="Past coronary revascularization" name="athero[]">
                                <label style="text-align: left; padding: 1px;"
                                    for="Past coronary revascularization">Past coronary revascularization</label>
                                <br>
                                <input type="checkbox" id="Stroke" value="Stroke" name="athero[]" <?php echo (strpos($data['athero'], "Stroke")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="Stroke">Stroke</label>
                                <hr>
<?php //} ?>
                                <div>
                                    <h5>Associated Complaints (Tick)</h5>
                                </div>
<?php
// $comp = explode(",", $data['assoc_comp']); 
// foreach($comp as $checks2) {
?>
                                <input type="checkbox" id="noneAssoc" name="assoc_comp[]" value="None" <?php echo (strpos($data['assoc_comp'], "None")!==false) ? "checked":""; ?>>
                                    <!-- onclick="check(this)"> -->
                                <label for="noneAssoc" style="text-align: left; padding: 1px;">None</label>
                                <br>
                                <input type="checkbox" id="NV" name="assoc_comp[]" value="Nausea and vomiting" <?php echo (strpos($data['assoc_comp'], "Nausea and vomiting")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="">Nausea and vomiting</label>
                                <br>
                                <input type="checkbox" id="SB" name="assoc_comp[]" value="Shortness of breath" <?php echo (strpos($data['assoc_comp'], "Shortness of breath")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="">Shortness of breath</label>

                                <br>
                                <input type="checkbox" id="syn" name="assoc_comp[]" value="Syncope" <?php echo (strpos($data['assoc_comp'], "Syncope")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="">Syncope</label>

                                <br>
                                <input type="checkbox" id="diaph" name="assoc_comp[]" value="Diaphoresis" <?php echo (strpos($data['assoc_comp'], "Diaphoresis")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="">Diaphoresis</label>

                                <br>
                                <input type="checkbox" id="fever" name="assoc_comp[]" value="Fever" <?php echo (strpos($data['assoc_comp'], "Fever")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="">Fever</label>

                                <br>
                                <input type="checkbox" id="expect" name="assoc_comp[]" value="Expectoration" <?php echo (strpos($data['assoc_comp'], "Expectoration")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="">Expectoration</label>

                                <br>
                                <input type="checkbox" id="hemosys" name="assoc_comp[]" value="Hemoptysis" <?php echo (strpos($data['assoc_comp'], "Hemoptysis")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="">Hemoptysis</label>

                                <br>
                                <input type="checkbox" id="trauma" name="assoc_comp[]" value="Recent trauma" <?php echo (strpos($data['assoc_comp'], "Recent trauma")!==false) ? "checked":""; ?>>
                                <label style="text-align: left; padding: 1px;" for="">Recent trauma</label>
<?php //} ?>
                                <br>


                                <div class="row" style="margin-top: 10px">
                                    <div class="col">
                                        <label for="oth" style="text-align: right; padding: 1px;" for="">Others:</label>
                                    </div>
                                    <div class="col">
                                        <textarea type="text" id="oth" name="oth" value="" rows="2" cols="25" name="others2"
                                            style="resize: none; margin-bottom: 10px;">
                                            <?php echo $data['others2']; ?>
                                        </textarea>
                                    </div>

                                    <br>
                                </div>
                                <script>
                                    function check(current) {
                                        var checkboxes = document.querySelectorAll('input[type=checkbox]');

                                        checkboxes.forEach(function (checkbox) {
                                            if (checkbox !== current) {
                                                checkbox.disabled = current.checked;
                                            }
                                        });
                                    }
                                </script>

                            </div>

                            <!-- <div class="col" style="border:1px solid black;">
                                <select name="severe" id="severity" style="width: 100px">
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div> -->
                            <!-- </div> -->
                        </div>

                    </div>
                </div>

                <!-- </form> -->
                <div class="row">
                    <div class="col box">
                        <div class="row" style="margin-top: 20px">
                            <div class="col">
                                <div>
                                    <h5>Known atherosclerotic vascular disease?</h5>
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" name="knowAthero" id="knowAthero" style="width: 190px;" value="<?php echo $data['knowAthero']; ?>">
                                    <!-- <option value="None">Select</option>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option> 
                                </select> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div>
                                    <lable for="miDrop">Pain similar to previous MI:</label>
                                    <!-- (Y/N): -->
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" name="miDrop" id="miDrop" style="width: 190px;" value="<?php echo $data['prevMI']; ?>">
                                    <!-- <option value="None">Select</option>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option> 
                                </select>-->
                            </div>
                        </div>

                        <hr>
                        <div class="row text-center">
                            <div class="col">
                                <h5>On Examination</h5>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <div class="row"> -->
                            <!-- <div class="col">
                            </div> -->
                            <!-- </div> -->
                            <div class="col">
                                <label for="pedal" style="text-align: left; padding: 5px;" for="Pedal">Pedal Edema:</label>
                                <!-- (Y/N) -->
                            </div>

                            <div class="col">
                                <input type="text" name="pedal" id="pedal" style="width: 190px;" value="<?php echo $data['pedal'];?>">
                                    <!-- <option value="None">Select</option>
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select> -->
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="calftend" style="text-align: left; padding: 5px;" for="calftender">Calf tenderness:</label>
                                    <!-- (Y/N) -->

                            </div>
                            <div class="col">
                                <input type="text" name="calftend" id="calftend" style="width: 190px;" value="<?php echo $data['calftend'];?>">
                                    <!-- <option value="None">Select</option>
                                    <option value="no">No</option>
                                    <option value="yes">Yes</option>
                                </select> -->

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="bilateral" style="text-align: left; padding: 5px;"
                                    for="bil_breath">Bilateral breath sounds (equal?): </label>

                            </div>
                            <div class="col">
                                <input type="text" name="bilateral" id="bilateral" style="width: 190px;" value="<?php echo $data['bilateral'];?>">
                                    <!-- <option value="None">Select</option>
                                    <option value="equal">Equal</option>
                                    <option value="unequal">Unequal</option>
                                </select> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="text-align: left; padding: 5px;" for="auscult">Any added auscultatory
                                    sounds:</label>

                            </div>
                            <div class="col">
                                <textarea type="text" id="auscult" name="auscult" rows="3" cols="30"
                                    style="resize: none; margin-bottom: 10px">
                                    <?php echo $data['auscult']; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="text-align: left; padding: 5px;" for="abdtender">Abdominal
                                    tenderness:</label>

                            </div>
                            <div class="col">
                                <textarea type="text" id="abdtender" name="abdtender" rows="3" cols="30"
                                    style="resize: none; margin-bottom: 10px;">
                                    <?php echo $data['abdomentend']; ?>
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col box ">
                        <div class="row text-center" style="margin-top: 20px;">
                            <div class="col">
                                <h5>CVS Examination</h5>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col">
                                <label style="text-align: left; padding: 5px;" for="s1">S1(normal/abnormal)</label>
                            </div>
                            <div class="col">
                                <input type="text" name="s1" id="s1" style="width: 190px;" value="<?php echo $data['s1'];?>">
                                    <!-- <option value="none">Select</option>
                                    <option value="normal">Normal</option>
                                    <option value="abnormal">Abnormal</option>
                                </select> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="text-align: left; padding: 5px;" for="s2">S2(normal/abnormal)</label>

                            </div>
                            <div class="col">
                                <input type="text" name="s2" id="s2" style="width: 190px;" value="<?php echo $data['s2'];?>">
                                    <!-- <option value="none">Select</option>
                                    <option value="normal">Normal</option>
                                    <option value="abnormal">Abnormal</option>
                                </select> -->

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="text-align: left; padding: 5px;" for="s3">S3(present/absent)</label>

                            </div>
                            <div class="col">
                                <input type="text" name="s3" id="s3" style="width: 190px;" value="<?php echo $data['s3'];?>">
                                    <!-- <option value="none">Select</option>
                                    <option value="present">Present</option>
                                    <option value="Absent">Absent</option>
                                </select> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label style="text-align: left; padding: 5px;" for="pericardial">Pericardial rub
                                    (present/absent)</label>

                            </div>
                            <div class="col">
                                <input type="text" name="pericardial" id="pericardial" style="width: 190px;" value="<?php echo $data['pericardial'];?>">
                                    <!-- <option value="none">Select</option>
                                    <option value="present">Present</option>
                                    <option value="Absent">Absent</option>
                                </select> -->

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label style="text-align: left; padding: 5px;"
                                    for="murmur">Murmur(present/absent)</label>


                            </div>
                            <div class="col">
                                <input type="text" name="murmur" id="murmur" style="width: 190px;" value="<?php echo $data['murmur'];?>">
                                    <!-- <option value="none">Select</option>
                                    <option value="present">Present</option>
                                    <option value="Absent">Absent</option>
                                </select> -->

                            </div>
                        </div>

                        <div class="row" style="margin-top: 30px;">
                            <div class="col">
                                <label style="text-align: left; padding: 5px;" for="desc_abnorm">Describe abnormalities (if
                                    any):</label>


                            </div>
                            <div class="col">
                                <textarea type="text" id="desc_abnorm" name="desc_abnorm" rows="3" cols="30"
                                    style="resize: none; margin-bottom: 10px;">
                                    <?php echo $data['desc_abnorm']; ?>
                                </textarea>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label style="text-align: left; padding: 5px;" for="clinic_in"><strong>Other clinical
                                        inputs:</strong></label>



                            </div>
                            <div class="col">
                                <textarea type="text" id="clinic_in" name="clinic_in" rows="3" cols="30"
                                    style="resize: none; margin-bottom: 10px;">
                                    <?php echo trim($data['clinic_in']); ?>
                                </textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section style="padding: 1px 1px">
            <!--class="why-us section-bg"> data-aos="fade-up" date-aos-delay="200"> -->
            <div class="container">


                <div class="row">
                    <!-- <div id="admin" class="col s12"> -->
                    <div class="card material-table box" style="margin: auto; padding-top: 40px; width: 100%;">
                        <style>
                            .tab {
                                background-color: #D6EEEE;
                            }
                        </style>

                        <table id="datatable">
                            <!-- <th colspan="3"></th> -->
                            <tr>
                                <th colspan="3" style="border: 2px solid black;">
                                    <!-- <tr> -->
                                    <h5>HEAR Score</h5>
                                    <!-- </tr> -->
                                </th>
                                <th style="border: 2px solid black;">
                                    <h5>Score</h5>
                                </th>
                            </tr>
                            <tr>
                                <th rowspan="3">History</th>
                                <td>
                                    <span>Slightly suspicious for Accute Coronary Syndrome</span>
                                </td>
                                <td> 0 </td>
                                <th rowspan="3">
                                    <input type="text" id="input1" name="history" value="<?php echo $data['history']; ?>">
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <span> Moderately suspicious </span>
                                </td>
                                <td> 1 </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Highly suspicious </span>
                                </td>
                                <td> 2 </td>
                            </tr>

                            <tr class="tab">
                                <th rowspan="3">ECG changes</th>
                                <td>
                                    <span>Normal</span>
                                </td>
                                <td> 0 </td>
                                <th rowspan="3">
                                    <input type="text" id="input2" name="ecg" value="<?php echo $data['ecg'];?>">
                                </th>
                            </tr>
                            <tr class="tab">
                                <td>
                                    <span> LBBB/LVH or other repolarization abnormalities </span>
                                </td>
                                <td> 1 </td>
                            </tr>
                            <tr class="tab">
                                <td>
                                    <span>Significant ST deviation </span>
                                </td>
                                <td> 2 </td>
                            </tr>



                            <tr>
                                <th rowspan="3">Age</th>
                                <td>
                                    <span>
                                        < 45 years </span>
                                </td>
                                <td> 0 </td>
                                <th rowspan="3">
                                    <input type="text" id="input3" name="cal_age" value="<?php echo $data['cal_age'];?>">
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <span>45-64 years </span>
                                </td>
                                <td> 1 </td>
                            </tr>
                            <tr>
                                <td>
                                    <span> > 65 years </span>
                                </td>
                                <td> 2 </td>
                            </tr>
                            <tr class="tab">
                                <th rowspan="4">CV risk factors</th>
                                <td>
                                    <span> No risk factors 0</span>
                                </td>
                                <td> 0 </td>
                                <th rowspan="4">
                                    <input type="text" id="input4" name="cv_risk" value="<?php echo $data['cv_risk'];?>">
                                </th>
                            </tr>
                            <tr class="tab">
                                <td>
                                    <span>1 or 2 risk factors </span>
                                </td>
                                <td> 1 </td>
                            </tr>
                            <tr class="tab">
                                <td>
                                    <span> > 3 risk factors or documented </span>
                                </td>
                                <td> 2 </td>
                            </tr>
                            <tr class="tab">
                                <td>
                                    <span> Atherosclerotic vascular disease </span>
                                </td>
                                <td> 2 </td>
                            </tr>
                            <tr>
                                <th style="padding-left: 10px; "><strong>Total Score:</strong>
                                </th>

                                <th colspan="2"><input type="hidden" name="hiddenscore"></th>

                                <th>
                                    <input type="text" id="totalScore" name="total" readonly value="<?php echo $data['total']?>">
                                    <!-- value="<?php //echo $total; ?>"> -->
                                </th>
                            </tr>
                        </table>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // Get references to the input text boxes and the total textbox
                                const input1 = document.getElementById('input1');
                                const input2 = document.getElementById('input2');
                                const input3 = document.getElementById('input3');
                                const input3 = document.getElementById('input4');
                                const totalTextbox = document.getElementById('totalScore');

                                // Function to calculate and update the total
                                function updateTotal() {
                                    // Parse input values to numbers (or 0 if empty or non-numeric)
                                    const value1 = parseFloat(input1.value) || 0;
                                    const value2 = parseFloat(input2.value) || 0;
                                    const value3 = parseFloat(input3.value) || 0;
                                    const value3 = parseFloat(input4.value) || 0;

                                    // Calculate the total
                                    const total = value1 + value2 + value3 + value4;

                                    // Update the total textbox
                                    totalTextbox.value = total;
                                }

                                // Add event listeners to input text boxes to trigger the calculation
                                input1.addEventListener('input', updateTotal);
                                input2.addEventListener('input', updateTotal);
                                input3.addEventListener('input', updateTotal);
                                input4.addEventListener('input', updateTotal);
                            });
                        </script>


                        <br>
                        <br>
                        <br>


                    </div>
                    <!-- </div> -->
                </div>
            </div>
            <div class="container" style="margin: auto; padding-top: 30px">
                <div class="row align-items-center">
                    <div class="col text-center">
                        <!-- <input type="submit" -->
                        <!-- onclick="window.location.href='chest-pain-proforma.php?id=<?php //echo $pid; ?>';" -->
                        <!-- class="btn btn-warning btn-lg" value="Submit" name="submit"> -->

                        <!-- <input type="button" id="next" class="btn btn-warning btn-lg " value="Next"
                            onclick="window.location.href='next-step.html';" ;> -->
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </section>

        </form>

        </div>
        </div>


    </main>
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

</body>

</html>