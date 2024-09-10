<?php

session_start();

if (isset ($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}

include ('connection.php'); //include_once was written
$pid = $_GET['id'] ? $_GET['id'] : "";
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die ("Failed");
    $data = mysqli_fetch_array($result);
}

// print_r($data['gender']);

?>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include ("connection.php");

// check boxex have none value fixed
// $pf_athero[0] = "Non";


$pf_history = 0;
$pf_ecg = 0;
$pf_age = 0;
$temp = $data['age'];
if ($temp < 45) {
    $pf_age = 0;
} elseif ($temp >= 45 && $temp <= 64) {
    $pf_age = 1;
} elseif ($temp > 64) {
    $pf_age = 2;
}


$pf_cv_risk = 0;

// $pf_total = 0; //$_POST['total'];

$pf_total = $pf_history + $pf_ecg + $pf_age + $pf_cv_risk;

//Database handing: storing new data
if (isset ($_POST['submit'])) {
    //declare variables
    $pflocation = $_POST['locatn'];
    $pf_duration = $_POST['duration'];
    $pf_charactr = $_POST['charactr'];
    $pf_severity = $_POST['severe'];
    $pf_radiation = $_POST['radiation'];

    $pf_aggravate = $_POST['aggravate'];
    // $pf_agg = implode(",", $pf_aggravate);

    $pf_comorbid = $_POST['relieveFactor'];
    // $pf_com = implode(",", $pf_comorbid);

    $pf_athero = isset ($_POST['athero']) ? $_POST['athero'] : "None";
    $pf_ath = $pf_athero === "None" ? $pf_athero : implode(",", $pf_athero);

    $pf_assoc_comp = isset ($_POST['assoc_comp']) ? $_POST['assoc_comp'] : "None";
    $pf_ass = $pf_assoc_comp === "None" ? $pf_assoc_comp : implode(",", $pf_assoc_comp);

    $others2 = $_POST['others2'];

    // $pf_pulse = $_POST['pulse'];
    // $pf_bp = $_POST['bp'];
    // $pf_rr = $_POST['rr'];
    // $pf_spo = $_POST['spo'];

    // $knowAthero = $_POST['knowAthero'];
    $prevMI = $_POST['prevMI'];

    $pf_pedal = $_POST['pedal'];
    $pf_calftend = $_POST['calftend'];
    $pf_bilateral = $_POST['bilateral'];
    // $pf_on = implode(",", $pf_on_exam);

    $pf_auscult = $_POST['auscult'];
    $pf_abdomentend = $_POST['abdomentend'];

    // $pf_cvs = $_POST['cvs'];
    // $pf_cvs = implode(",", $pf_cvs_tick);
    $pf_s1 = $_POST['s1'];
    $pf_s2 = $_POST['s2'];
    $pf_s3 = $_POST['s3'];
    $pf_pericard = $_POST['pericardial'];
    $pf_murmur = $_POST['murmur'];

    $pf_desc_abnorm = $_POST['desc_abnorm'];
    $pf_clinic_in = $_POST['clinic_in'];

    $pf_history = $_POST['history'];
    $pf_ecg = $_POST['ecg'];
    $pf_age = $_POST['cal_age'];
    $pf_cv_risk = $_POST['cv_risk'];
    $pf_total = $_POST['total'];

    $pf_total = (int) $pf_history + (int) $pf_ecg + (int) $pf_age + (int) $pf_cv_risk;

    $pf_stat = "Pending";
    $expertOpinion = "Not Taken";
    $pf_risk = ($pf_total >= 3) ? "High risk" : "Low risk";
    //write the query to update database
    $query = "UPDATE patientregistration SET    locatn='$pflocation',
                                                duration='$pf_duration',
                                                charactr='$pf_charactr',
                                                severe='$pf_severity',
                                                radiation='$pf_radiation',
                                                aggravate='$pf_aggravate',
                                                comorbid='$pf_comorbid',
                                                athero='$pf_ath',
                                                assoc_comp='$pf_ass',
                                                others2='$others2',
                                                prevMI='$prevMI',
                                                
                                                pedal='$pf_pedal',
                                                calftend='$pf_calftend',
                                                bilateral='$pf_bilateral',
                                                auscult='$pf_auscult',
                                                abdomentend='$pf_abdomentend',
                                                
                                                s1='$pf_s1',
                                                s2='$pf_s2',
                                                s3='$pf_s3',
                                                pericardial='$pf_pericard',
                                                murmur='$pf_murmur',

                                                desc_abnorm='$pf_desc_abnorm',
                                                clinic_in='$pf_clinic_in',
                                                history='$pf_history',
                                                ecg='$pf_ecg',
                                                cal_age='$pf_age',
                                                cv_risk='$pf_cv_risk',
                                                total='$pf_total',

                                                stat='$pf_stat',
                                                risk='$pf_risk',
                                                expertOpinion='$expertOpinion',
                                                proformaSubmit='Filled'
                                                WHERE patientid='$pid'";

    // -- pulse='$pf_pulse',
//                                                 -- bp='$pf_bp',
//                                                 -- rr='$pf_rr',
//                                                 -- spo='$pf_spo',

    // $query = "UPDATE patientregistration SET locatn='raipur', duration='1hour' WHERE patientid=$pid";


    if (mysqli_query($conn, $query)) {
        // echo "<script>alert('Data inserted into the database');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    //write redirect link here
    header("Location: chest-pain-proforma.php?id=$pid");
    // echo $query;
    // TESTING check box null exceptions
    // $arr = explode(",",$pf_ath);
    // echo $arr[0];

    // $arr1 = explode(",",$pf_ass);
    // echo $arr1[0];

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta content="width=device-width, initial-scale=1.0" name="viewport"> -->
    <meta name="viewport" content="width=1024">


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



    <?php
    $count = 0;
    // echo $data['comorbidities'];
    // echo strpos($data['comorbidities'], "Diabetes");
    if (strpos($data['comorbidities'], "Diabetes") !== false) {
        $count++;
    }
    if (strpos($data['comorbidities'], "Hypertension") !== false) {
        $count++;
    }
    // if (strpos($data['comorbidities'], "Coronary artery disease (CAD)") !== false) {
    //     $count++;
    // }
    if (strpos($data['comorbidities'], "Hypercholesterolemia") !== false) {
        $count++;
    }
    if (strpos($data['comorbidities'], "Obesity") !== false) {
        $count++;
    }
    if (strpos($data['comorbidities'], "Smoker") !== false) {
        $count++;
    }
    if (strpos($data['comorbidities'], "FamCAD") !== false) {
        $count++;
    }

    // echo "<br><br> $count";
    if ($count >= 3) {
        $pf_cv_risk = 2;
    } elseif ($count > 0) {
        $pf_cv_risk = 1;
    } else {
        $pf_cv_risk = 0;
    }

    if ($pf_cv_risk === 0) {
        // echo "cv risk is 0";
        ?>

        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const input4 = document.getElementById('input4');
                const totalTextbox = document.getElementById('totalScore');

                let pointsChanged1 = false;
                let pointsChanged2 = false;

                // Get references to the input text boxes and the total textbox
                // const input1 = document.getElementById('default1');
                const checkbox2 = document.getElementById('noneTick');
                const checkbox3 = document.getElementById('Peripheral_arterial_disease');
                const checkbox4 = document.getElementById('Past_MI');
                const checkbox5 = document.getElementById('Past_coronary_revascularization');
                const checkbox6 = document.getElementById('Stroke');

                //add event listners to the checkboxes
                checkbox2.addEventListener("change", updateValues);
                checkbox3.addEventListener("change", updateValues);
                checkbox4.addEventListener("change", updateValues);
                checkbox5.addEventListener("change", updateValues);
                checkbox6.addEventListener("change", updateValues);
                input4.addEventListener("input", updateValues);

                function updateValues() {
                    // const input4Value = checkbox3.checked || checkbox4.checked || checkbox5.checked || checkbox6.checked ? 2 : 0;
                    // const inputTotalValue = checkbox3.checked || checkbox4.checked || checkbox5.checked || checkbox6.checked ? 2 : -2;

                    if (!pointsChanged1 && !checkbox2.checked) {
                        if (checkbox3.checked || checkbox4.checked || checkbox5.checked || checkbox6.checked) {
                            input4.value = parseInt(input4.value) + 2;
                            pointsChanged1 = true;
                        } else {
                            //this portion doesnot get the flow
                            // input4.value = parseInt(input4.value) - 2;
                        }
                        // pointsChanged1 = true;
                    } else if (pointsChanged1 && checkbox2.checked) {
                        input4.value = parseInt(input4.value) - 2;
                        pointsChanged1 = false;
                    } else if (pointsChanged1 && !checkbox3.checked && !checkbox4.checked && !checkbox5.checked && !checkbox6.checked) {
                        input4.value = parseInt(input4.value) - 2;
                        pointsChanged1 = false;
                    }

                    // input4.value = input4Value;

                    if (!pointsChanged2 && !checkbox2.checked) {
                        if (checkbox3.checked || checkbox4.checked || checkbox5.checked || checkbox6.checked) {
                            totalTextbox.value = parseInt(totalTextbox.value) + 2;
                            pointsChanged2 = true;
                        } else {
                            //this portion doesnot get the flow
                            // totalTextbox.value = parseInt(totalTextbox.value) - 2;
                        }
                        // pointsChanged2 = true;
                    } else if (pointsChanged2 && checkbox2.checked) {
                        totalTextbox.value = parseInt(totalTextbox.value) - 2;
                        pointsChanged2 = false;
                    } else if (pointsChanged2 && !checkbox3.checked && !checkbox4.checked && !checkbox5.checked && !checkbox6.checked) {
                        totalTextbox.value = parseInt(totalTextbox.value) - 2;
                        pointsChanged2 = false;
                    }
                }
            });

        </script>

        <?php
    } elseif ($pf_cv_risk === 1) {
        // echo "cv risk is 1";
        ?>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <script>
            // $(document).ready(function () {
            document.addEventListener('DOMContentLoaded', function () {

                const input4 = document.getElementById('input4');
                const totalTextbox = document.getElementById('totalScore');

                let pointsChanged1 = false;
                let pointsChanged2 = false;


                // Get references to the input text boxes and the total textbox
                // const input1 = document.getElementById('default1');
                const checkbox2 = document.getElementById('noneTick');
                const checkbox3 = document.getElementById('Peripheral_arterial_disease');
                const checkbox4 = document.getElementById('Past_MI');
                const checkbox5 = document.getElementById('Past_coronary_revascularization');
                const checkbox6 = document.getElementById('Stroke');

                //add event listners to the checkboxes
                checkbox2.addEventListener("change", updateValues);
                checkbox3.addEventListener("change", updateValues);
                checkbox4.addEventListener("change", updateValues);
                checkbox5.addEventListener("change", updateValues);
                checkbox6.addEventListener("change", updateValues);
                input4.addEventListener("input", updateValues);

                function updateValues() {
                    // const input4Value = checkbox3.checked || checkbox4.checked || checkbox5.checked || checkbox6.checked ? 2 : 0;
                    // const inputTotalValue = checkbox3.checked || checkbox4.checked || checkbox5.checked || checkbox6.checked ? 1 : -1;

                    console.log(pointsChanged1);
                    if (!pointsChanged1 && !checkbox2.checked) {
                        if (checkbox3.checked || checkbox4.checked || checkbox5.checked || checkbox6.checked) {
                            input4.value = parseInt(input4.value) + 1;
                            pointsChanged1 = true;
                            console.log(pointsChanged1);
                        } else {
                            //this portion doesnot get the flow
                            // totalTextbox.value = parseInt(totalTextbox.value) - 1;
                        }
                        // pointsChanged1 = true;
                    } else if (pointsChanged1 && checkbox2.checked) {
                        input4.value = parseInt(input4.value) - 1;
                        pointsChanged1 = false;
                    }
                    else if (pointsChanged1 && !checkbox3.checked && !checkbox4.checked && !checkbox5.checked && !checkbox6.checked) {
                        input4.value = parseInt(input4.value) - 1;
                        pointsChanged1 = false;
                    }


                    // input4.value = input4Value;

                    if (!pointsChanged2 && !checkbox2.checked) {
                        if (checkbox3.checked || checkbox4.checked || checkbox5.checked || checkbox6.checked) {
                            totalTextbox.value = parseInt(totalTextbox.value) + 1;
                            pointsChanged2 = true;

                        } else {
                            //this portion doesnot get the flow
                            // totalTextbox.value = parseInt(totalTextbox.value) - 1;
                        }
                        // pointsChanged2 = true;
                    } else if (pointsChanged2 && checkbox2.checked) {
                        totalTextbox.value = parseInt(totalTextbox.value) - 1;
                        pointsChanged2 = false;
                    }
                    else if (pointsChanged2 && !checkbox3.checked && !checkbox4.checked && !checkbox5.checked && !checkbox6.checked) {
                        totalTextbox.value = parseInt(totalTextbox.value) - 1;
                        pointsChanged2 = false;
                    }
                    // }
                }

                // const checkBoxSet1 = $(".checkBoxSet1");
                // var cvRisk = 0;
                // const totalTextbox = document.getElementById('totalScore');

                // function updateTotal1() {
                //     // Calculate the total
                //     const total = value4;

                //     // Update the total textbox
                //     totalTextbox.value = total;
                // }

                // Function to set the value4 if any of the athero[] check is present with the specified class
                // checkBoxSet1.on("change", function () {
                //     var tmp = parseInt(totalTextbox.value);
                //     const value = $(this).val();

                //     console.log(value);
                //     if ($(this).is(":checked") && value !== "None") {
                //         cvRisk += 2;

                //     } else {
                //         cvRisk -= 2;
                //     }

                //     if (cvRisk >= 2) {
                //         // var intemp = parseInt(input4.value);
                //         input4.value = 2;
                //         input4.addEventListener("change", updateTotal1);
                //         // totalTextbox.value = tmp + parseInt(input4.value);
                //     } else {
                //         input4.value = 0;

                //     }
                //     console.log(input4.value);

                //     console.log(" tmp " + tmp);

                //     // input4.value = cvRisk;
                //     // totalTextbox.value = 0;
                //     // const total = input4.value;

                //     console.log(totalTextbox.value);

                // });
                // checkBoxSet1.addEventListener()
                // const totalTextbox = document.getElementById('totalScore');
            });

        </script>


        <?php
    }
    ?>


    <?php
    $pf_total += $pf_cv_risk;
    ?>

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
        <form method="POST">
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
                                            <input type="text" id="locatn" value="" name="locatn">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="duration" style="text-align: right;padding: 5px;">Duration:
                                            </label>

                                        </div>
                                        <div class="col">
                                            <input type="text" id="duration" name="duration" value="">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="charactr" style="text-align: right;padding: 5px;">Character:
                                            </label>

                                        </div>
                                        <div class="col">
                                            <input type="text" value="" name="charactr">

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <label for="severity" style="text-align: right;padding: 5px;">Severity:
                                            </label>

                                        </div>
                                        <div class="col">
                                            <select name="severe" id="severity" style="width: 190px;">
                                                <option value="None">Select</option>
                                                <option value="Mild">Mild</option>
                                                <option value="Moderate">Moderate</option>
                                                <option value="Servere">Severe</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="radiation" style="text-align: right;padding: 5px;">Radiation:
                                            </label>

                                        </div>
                                        <div class="col">
                                            <input type="text" id="radiation" name="radiation">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <lable for="prevMI">Pain similar
                                                    to previous MI:</label>
                                                    <!-- (Y/N -->
                                            </div>
                                        </div>
                                        <div class="col">
                                            <select name="prevMI" id="prevMI" style="width: 190px;">
                                                <!-- <option value="None">Select</option> -->
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
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
                                            <label for="pulse" diabled
                                                style="text-align: left; padding: 5px;">Pulse:</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" id="pulse" name="pulse" readonly
                                                value="<?php echo $data['pulse']; ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="bright" diabled style="text-align: left; padding: 5px;">Blood
                                                Pressure:</label>
                                        </div>
                                        <div class="col">
                                            <td><input type="text" id="bpright" name="bp" readonly
                                                    value="<?php echo $data['bp']; ?>"></td>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="rr" diabled style="text-align: left; padding: 5px;">Respiratory
                                                Rate:</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" id="rr" name="rr" readonly
                                                value="<?php echo $data['rr']; ?>">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="spo2" diabled
                                                style="text-align: left; padding: 5px;">SpO2:</label>
                                        </div>
                                        <div class="col">
                                            <input type="text" id="spo2" name="spo" readonly
                                                value="<?php echo $data['spo']; ?>">
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
                                    <h5 for="aggravate">Aggravating Factors</h5>
                                    <!-- </div> -->
                                    <textarea type="text" id="aggravate" name="aggravate" rows="8" cols="30"
                                        style="resize: none;"></textarea>
                                </div>
                            </div>
                            <hr style="margin-top: 30px; margin-bottom 30px;">
                            <div class="row" style="margin-top: 20px">
                                <div class="col text-center">
                                    <!-- <div class="section-title" id="gcc"> -->
                                    <h5 for="relieveFactor">Relieving Factors</h5>
                                    <!-- </div> -->
                                    <textarea type="text" id="relieveFactor" name="relieveFactor" rows="8" cols="30"
                                        style="resize: none;"></textarea>
                                </div>
                            </div>

                        </div>

                        <!-- column-3 -->
                        <div class="col box">
                            <div class="row" style="margin-top: 20px;">

                                <!-- <div class="row"> -->
                                <div class="col">
                                    <!-- <div>
                                        <h5>Tick:</h5>
                                    </div> -->
                                    <div class="row">
                                        <div class="col">
                                            <div>
                                                <h5>Known atherosclerotic vascular disease? (Tick)</h5>
                                            </div>
                                        </div>
                                        <!-- <div class="col">
                                            <select name="knowAthero" id="knowAthero" style="width: 100px;">
                                                <option value="None">Select</option>

                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div> -->
                                    </div>

                                    <!-- <label for="Peripheral arterial disease">Peripheral arterial disease</label> -->


                                    <!-- <input type="hidden" id="default1" name="athero[]" value="Null" checked> -->
                                    <!-- <label for="default" style="text-align: left; padding: 1px;"></label> -->

                                    <input type="checkbox" id="noneTick" name="athero[]" value="None" checked>
                                    <!-- onclick="check(this)"  -->
                                    <label for="noneTick" style="text-align: left; padding: 1px;">None</label>
                                    <br>
                                    <input type="checkbox" id="Peripheral_arterial_disease"
                                        value="Peripheral arterial disease" class="checkBoxSet1" disabled
                                        name="athero[]">
                                    <label style="text-align: left; padding: 1px;"
                                        for="Peripheral arterial disease">Peripheral arterial disease</label>
                                    <br>
                                    <input type="checkbox" id="Past_MI" value="Past MI" class="checkBoxSet1" disabled
                                        name="athero[]">
                                    <label style="text-align: left; padding: 1px;" for="Past MI">Past MI</label>
                                    <br>
                                    <input type="checkbox" id="Past_coronary_revascularization"
                                        value="Past coronary revascularization" class="checkBoxSet1" disabled
                                        name="athero[]">
                                    <label style="text-align: left; padding: 1px;"
                                        for="Past coronary revascularization">Past coronary revascularization</label>
                                    <br>
                                    <input type="checkbox" id="Stroke" value="Stroke" class="checkBoxSet1" disabled
                                        name="athero[]">
                                    <label style="text-align: left; padding: 1px;" for="Stroke">Stroke</label>
                                    <hr>
                                    <div>
                                        <h5>Associated Complaints (Tick)</h5>
                                    </div>

                                    <!-- <input type="hidden" id="default2" name="assoc_comp[]" value="Null" checked> -->

                                    <input type="checkbox" id="noneAssoc" name="assoc_comp[]" value="None" checked>
                                    <!-- onclick="check(this)"  -->
                                    <label for="noneAssoc" style="text-align: left; padding: 1px;">None</label>
                                    <br>
                                    <input type="checkbox" id="NV" name="assoc_comp[]" value="Nausea and vomiting"
                                        class="checkBoxSet2" disabled>
                                    <label style="text-align: left; padding: 1px;" for="">Nausea and vomiting</label>
                                    <br>
                                    <input type="checkbox" id="SB" name="assoc_comp[]" value="Shortness of breath"
                                        class="checkBoxSet2" disabled>
                                    <label style="text-align: left; padding: 1px;" for="">Shortness of breath</label>

                                    <br>
                                    <input type="checkbox" id="syn" name="assoc_comp[]" value="Syncope"
                                        class="checkBoxSet2" disabled>
                                    <label style="text-align: left; padding: 1px;" for="">Syncope</label>

                                    <br>
                                    <input type="checkbox" id="diaph" name="assoc_comp[]" value="Diaphoresis"
                                        class="checkBoxSet2" disabled>
                                    <label style="text-align: left; padding: 1px;" for="">Diaphoresis</label>

                                    <br>
                                    <input type="checkbox" id="fever" name="assoc_comp[]" value="Fever"
                                        class="checkBoxSet2" disabled>
                                    <label style="text-align: left; padding: 1px;" for="">Fever</label>

                                    <br>
                                    <input type="checkbox" id="expect" name="assoc_comp[]" value="Expectoration"
                                        class="checkBoxSet2" disabled>
                                    <label style="text-align: left; padding: 1px;" for="">Expectoration</label>

                                    <br>
                                    <input type="checkbox" id="hemosys" name="assoc_comp[]" value="Hemoptysis"
                                        class="checkBoxSet2" disabled>
                                    <label style="text-align: left; padding: 1px;" for="">Hemoptysis</label>

                                    <br>
                                    <input type="checkbox" id="trauma" name="assoc_comp[]" value="Recent trauma"
                                        class="checkBoxSet2" disabled>
                                    <label style="text-align: left; padding: 1px;" for="">Recent trauma</label>

                                    <br>


                                    <div class="row" style="margin-top: 10px">
                                        <div class="col">
                                            <label for="others2" style="text-align: right; padding: 1px;"
                                                for="">Others:</label>
                                        </div>
                                        <div class="col">
                                            <textarea type="text" id="others2" name="others2" value="" rows="2"
                                                cols="25" style="resize: none; margin-bottom: 10px;"></textarea>
                                        </div>

                                        <br>
                                    </div>
                                    <!-- <script> //I not used. 
                                        function check(current) {
                                            var checkboxes = document.querySelectorAll('input[type=checkbox]');

                                            checkboxes.forEach(function (checkbox) {
                                                if (checkbox !== current) {
                                                    checkbox.disabled = current.checked;
                                                }
                                            });
                                        }
                                    </script> -->
                                    <script>
                                        const noneCheckbox1 = document.getElementById("noneTick");
                                        const checkboxes1 = document.querySelectorAll(".checkBoxSet1");

                                        const noneCheckbox2 = document.getElementById("noneAssoc");
                                        const checkboxes2 = document.querySelectorAll(".checkBoxSet2");

                                        noneCheckbox1.addEventListener("change", function () {
                                            // If "None" checkbox is checked, disable and uncheck other checkboxes
                                            if (this.checked) {
                                                checkboxes1.forEach(checkbox => {
                                                    checkbox.disabled = true;
                                                    checkbox.checked = false;
                                                });
                                            } else {
                                                checkboxes1.forEach(checkbox => {
                                                    checkbox.disabled = false;
                                                });
                                            }
                                        });

                                        noneCheckbox2.addEventListener("change", function () {
                                            // If "None" checkbox is checked, disable and uncheck other checkboxes
                                            if (this.checked) {
                                                checkboxes2.forEach(checkbox => {
                                                    checkbox.disabled = true;
                                                    checkbox.checked = false;
                                                });
                                            } else {
                                                checkboxes2.forEach(checkbox => {
                                                    checkbox.disabled = false;
                                                });
                                            }
                                        });

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
                            <!-- <div class="row" style="margin-top: 20px">
                                <div class="col">
                                    <div>
                                        <h5>Known atherosclerotic vascular disease?</h5>
                                    </div>
                                </div>
                                <div class="col">
                                    <select name="knowAthero" id="knowAthero" style="width: 100px;">
                                        <option value="None">Select</option>

                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                            </div> -->

                            <!-- <div class="row">
                                <div class="col">
                                    <div>
                                        <lable for="prevMI">Pain similar to previous MI:</label>
                                             (Y/N)
                                    </div>
                                </div>
                                <div class="col">
                                    <select name="prevMI" id="prevMI" style="width: 100px;">
                                        <option value="None">Select</option>
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                            </div> -->

                            <!-- <hr> -->

                            <div class="row text-center" style="margin-top: 20px;">
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
                                    <label for="pedal" style="text-align: left; padding: 5px;" for="Pedal">Pedal
                                        Edema:</label>
                                </div>

                                <div class="col">
                                    <select name="pedal" id="pedal" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="calftend" style="text-align: left; padding: 5px;" for="calftender">Calf
                                        tenderness:</label>

                                </div>
                                <div class="col">
                                    <select name="calftend" id="calftend" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="bilateral" style="text-align: left; padding: 5px;"
                                        for="bil_breath">Bilateral breath
                                        sounds: </label>

                                </div>
                                <div class="col">
                                    <select name="bilateral" id="bilateral" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="equal">Equal</option>
                                        <option value="unequal">Unequal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="abdomentend">Abdominal
                                        tenderness:</label>

                                </div>
                                <div class="col">
                                    <select name="abdomentend" id="calftend" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="auscult">Any added auscultatory
                                        sounds:</label>

                                </div>
                                <div class="col">
                                    <textarea type="text" id="auscult" name="auscult" rows="3" cols="30"
                                        style="resize: none; margin-bottom: 10px" value=""></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="abdomentend">Abdominal
                                        tenderness:</label>

                                </div> -->
                                <!-- <div class="col">
                                    <textarea type="text" id="abdomentend" name="abdomentend" rows="3" cols="30"
                                        style="resize: none; margin-bottom: 10px;"></textarea>
                                </div> -->
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
                                    <label style="text-align: left; padding: 5px;" for="s1">S1:</label>
                                </div>
                                <div class="col">
                                    <select name="s1" id="s1" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="Normal">Normal</option>
                                        <option value="Abnormal">Abnormal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="s2">S2:</label>

                                </div>
                                <div class="col">
                                    <select name="s2" id="s2" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="Normal">Normal</option>
                                        <option value="Abnormal">Abnormal</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="s3">S3:</label>

                                </div>
                                <div class="col">
                                    <select name="s3" id="s3" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="Present">Present</option>
                                        <option value="Absent">Absent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="pericardial">Pericardial
                                        rub:</label>

                                </div>
                                <div class="col">
                                    <select name="pericardial" id="pericardial" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="Present">Present</option>
                                        <option value="Absent">Absent</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="murmur">Murmur:</label>


                                </div>
                                <div class="col">
                                    <select name="murmur" id="murmur" style="width: 190px;">
                                        <!-- <option value="None">Select</option> -->
                                        <option value="Present">Present</option>
                                        <option value="Absent">Absent</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row" style="margin-top: 30px;">
                                <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="desc_abnorm">Describe
                                        abnormalities (if
                                        any):</label>


                                </div>
                                <div class="col">
                                    <textarea type="text" id="desc_abnorm" name="desc_abnorm" rows="3" cols="30"
                                        style="resize: none; margin-bottom: 10px;"></textarea>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label style="text-align: left; padding: 5px;" for="clinic_in"><strong>Other
                                            clinical
                                            inputs:</strong></label>



                                </div>
                                <div class="col">
                                    <textarea type="text" id="clinic_in" name="clinic_in" rows="3" cols="30"
                                        style="resize: none; margin-bottom: 10px;"></textarea>
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

                            <table id="datatable" style="width: 100%;">
                                <!-- <th colspan="3"></th> -->
                                <tr>
                                    <th colspan="3" style="border: 2px solid black;">
                                        <!-- <tr> -->
                                        <h5>HEAR Score</h5>
                                        <p><a style="text-decoration: underline;" href="assets/HEAR score 2.pdf"
                                                target="_blank">Understand more about HEAR score</a></p>
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
                                        <input type="text" id="input1" name="history" value="<?php echo $pf_history; ?>"
                                            placeholder="<?php echo $pf_history; ?>">
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
                                        <input type="text" id="input2" name="ecg" value="<?php echo $pf_ecg; ?>"
                                            placeholder="<?php echo $pf_ecg; ?>">
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
                                        <input type="text" id="input3" name="cal_age"
                                            placeholder="<?php echo $pf_age; ?>" value="<?php echo $pf_age; ?>" readonly
                                            style="background-color: #9DD;">
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
                                        <input type="text" id="input4" name="cv_risk" value="<?php echo $pf_cv_risk; ?>"
                                            placeholder="<?php echo $pf_cv_risk; ?>" readonly
                                            style="background-color: #9DD;">
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
                                        <span> >= 3 risk factors or documented </span>
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
                                        <input type="text" id="totalScore" name="total" readonly
                                            style="background-color: #9DD;" value="<?php echo $pf_total; ?>">
                                        <!-- placeholder="<?php //echo $pf_total;    ?>"> -->
                                    </th>
                                </tr>
                            </table>


<!-- 
                            <style>
                                /* CSS for mobile devices */
                                @media (max-width: 768px) {

                                    /* Hide the "Score" column */
                                    #datatable th:last-child,
                                    #datatable td:last-child {
                                        display: none;
                                    }

                                    /* Move the last header cell to the bottom */
                                    #datatable th[colspan="2"] {
                                        position: relative;
                                        top: 20px;
                                        /* Adjust the top offset as needed */
                                    }
                                }
                            </style> -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    // Get references to the input text boxes and the total textbox
                                    const input1 = document.getElementById('input1');
                                    const input2 = document.getElementById('input2');
                                    const input3 = document.getElementById('input3');
                                    const input4 = document.getElementById('input4');
                                    // const input5 = document.getElementsByClassName('checkBoxSet1');
                                    const totalTextbox = document.getElementById('totalScore');

                                    // Function to calculate and update the total
                                    function updateTotal() {
                                        // Parse input values to numbers (or 0 if empty or non-numeric)
                                        const value1 = parseInt(input1.value) || 0;
                                        const value2 = parseInt(input2.value) || 0;
                                        const value3 = parseInt(input3.value) || 0;
                                        const value4 = parseInt(input4.value) || 0;

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
                                    // input5.on("change", function() {

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
                            <input type="submit"
                                onclick="window.location.href='chest-pain-proforma.php?id=<?php echo $pid; ?>';"
                                class="btn btn-warning btn-lg" value="Submit" name="submit">
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