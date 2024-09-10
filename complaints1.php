<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

$pid = $_GET['id'];
if (isset($_POST['save'])) {
    $cheifComplain = $_POST['cheifComplain'];
    // $comCheck1 = $_POST['comCheck1'];
    // $comCheck2 = $_POST['comCheck2'];
    // $comCheck3 = $_POST['comCheck3'];
    // $comCheck4 = $_POST['comCheck4'];
    // $comCheck5 = $_POST['comCheck5'];
    // $comCheck6 = $_POST['comCheck6'];
    // $comCheck7 = $_POST['comCheck7'];
    // $comCheck8 = $_POST['comCheck8'];
    // $comCheck9 = $_POST['comCheck9'];
    // $comCheck10 = $_POST['comCheck10'];
    // $comCheck11 = $_POST['comCheck11'];
    // $comCheck12 = $_POST['comCheck12'];
    $datas = $_POST['comCheck'];
    $others = $_POST['others'];
    $allergy = $_POST['allergy'];
    $alldata = implode(",", $datas);

    // $query = "UPDATE `patientregistration` SET  `cheifComplain`='$cheifComplain',
    //                                             `comCheck1`='$comCheck1',
    //                                             `comCheck2`='$comCheck2',
    //                                             `comCheck3`='$comCheck3',
    //                                             `comCheck4`='$comCheck4',
    //                                             `comCheck5`='$comCheck5',
    //                                             `comCheck6`='$comCheck6',
    //                                             `comCheck7`='$comCheck7',
    //                                             `comCheck8`='$comCheck8',
    //                                             `comCheck9`='$comCheck9',
    //                                             `comCheck10`='$comCheck10',
    //                                             `comCheck11`='$comCheck11',
    //                                             `comCheck12`='$comCheck12',
    //                                             `others`='$others',
    //                                             `allergy`='$allergy'
    //                                             WHERE patientid='{$id}'";

    $query = "UPDATE patientregistration SET    cheifComplain='$cheifComplain',
                                                comorbidities='$alldata', 
                                                others='$others', 
                                                allergy='$allergy' WHERE patientid=$pid";

    // correct query syntax
    // $query = "UPDATE patientregistration SET cheifComplain='$cheifComplain' WHERE patientid=$pid";
    // $query = "UPDATE patientregistration SET cheifComplain='qwerty' WHERE patientid=12345";


    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data inserted into the database');</script>";
        // echo $pid;
    } else {
        echo "Error: " . mysqli_error($conn);
    }


    // $sql = "UPDATE patientregistration SET cheifComplaints='qwerty' WHERE id=12345";

    header("Location: evaluate.php?id=$pid");
    // exit;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- form validation jscript -->
    <!-- <script>
        // Function to show the success modal
        function showSuccessModal() {
            $('#successModal').modal('show');
        }

        function validateForm() {
            const presentationSelect = document.getElementById("submit");

            if (presentationSelect.value === "none") {
                alert("Please select a Type of Presentation.");
                return false;
            }

            // If form validation is successful, show the success modal and prevent form submission
            showSuccessModal();
            return false;
        }
    </script> -->
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
    <header id="header" class="fixed-top " style="height: auto">
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

    <main id="main" >

        <!-- ======= About Us Section ======= -->
        <!-- <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Field Login</h2>
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Practitioner Login</li>
                    </ol>
                </div>

            </div>
        </section> -->
        <!-- End About Us Section -->

        <!-- ======= About Section ======= -->
        <section style="padding-top: 0px; margin: 0px"> <!-- class="about" data-aos="fade-up"> -->

            <div class="container">
                <div class="col">
                    <div class="row">
                        <div class="col text-center">
                            <span>
                                <h4>Presenting Complaints</h4>
                            </span>
                        </div>
                    </div>
                    <br><br>


                    <form action="#" method="POST">
                        <div class="row" style="border: 2px solid black; border-radius: 0.3em;">
                            <div class="col-lg-6" style="margin-top: 20px;">
                                <div class="row" style="margin: auto;">
                                    <div class="col-lg-*">
                                        <label for="cheifComplain">Cheif Complaints:
                                        </label>
                                    </div>
                                    <div class="col-lg-*">
                                        <textarea type="text" id="cheifComplain" name="cheifComplain" rows=" 5"
                                            cols="30" style="resize: none;" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" style="margin-top: 20px;">
                                <div class="row ">
                                    <div class="col text-center">
                                        <p>
                                            <strong>Known comorbidities: (please tick)</strong>
                                        </p>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col text-align">
                                        <input type="checkbox" id="None" name="comCheck[]" value="None"
                                            onclick="check(this)">
                                        <label for="None">None</label>
                                        <br>

                                        <input type="checkbox" id="Diabetes" name="comCheck[]" value="Diabetes">
                                        <label for="Diabetes">Diabetes</label>
                                        <br>
                                        <input type="checkbox" id="Hypertension" name="comCheck[]" value="Hypertension">
                                        <label for="Hypertension">Hypertension</label>
                                        <br>
                                        <input type="checkbox" id="Hypothyroidism" name="comCheck[]"
                                            value="Hypothyroidism">
                                        <label for="Hypothyroidism">Hypothyroidism</label>
                                        <br>
                                        <input type="checkbox" id="cad" name="comCheck[]"
                                            value=" Coronary artery disease (CAD)">
                                        <label for="Coronary artery disease (CAD)">Coronary artery disease (CAD)
                                        </label>
                                        <br>
                                        <input type="checkbox" id="Hypcholest" name="comCheck[]"
                                            value="Hypercholesterolemia">
                                        <label for="Hypercholesterolemia">Hypercholesterolemia</label>
                                    </div>
                                    <div class="col">
                                        <input type="checkbox" id="Smoker" name="comCheck[]" value="Smoker">
                                        <label for="Smoker">Smoker</label>
                                        <br>
                                        <input type="checkbox" id="ckd" name="comCheck[]" value="ckd">
                                        <label for="ckd">Chronic Kidney Disease</label>
                                        <br>
                                        <input type="checkbox" id="cld" name="comCheck[]" value="Chronic liver disease">
                                        <label for="Chronic liver disease">Chronic liver disease</label>
                                        <br>
                                        <input type="checkbox" id="COPD" name="comCheck[]" value="COPD">
                                        <label for="COPD">COPD
                                        </label>
                                        <br>
                                        <input type="checkbox" id="Malignancy" name="comCheck[]" value="Malignancy">
                                        <label for="Malignancy">Malignancy</label>
                                        <br>
                                        <input type="checkbox" id="Obesity" name="comCheck[]" value="Obesity">
                                        <label for="Obesity">Obesity</label>
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">

                                        <p><label for="allergy">Allergies:</label></p>
                                        <p><label for="others">Others:</label></p>
                                    </div>
                                    <div class="col">

                                        <input type="text" id="allergy" name="allergy" required></p>
                                        <textarea type="text" id="others" name="others" rows=" 5" cols="30"
                                            style="resize: none;" required></textarea></p>
                                    </div>

                                    <!--<script>
                                        function check(current) {
                                            var checkboxes = document.querySelectorAll('input[type=checkbox]');

                                            checkboxes.forEach(function (checkbox) {
                                                if (checkbox !== current) {
                                                    checkbox.disabled = current.checked;
                                                }
                                            });
                                        }
                                    </script>-->

                                    <div class="col-md-5"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col text-center" style="margin-top: 20px;">
                            <input type="submit" id="SaveComplain" class="btn btn-warning btn-lg" name="save"
                                value="Save">
                            <!-- data-toggle="modal" data-target="#successModal"> -->
                            <!-- onclick="validateForm()" -->
                        </div>
                    </form>


                    <!-- successfully save modal -->
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
                                        onclick="window.location.href='evaluate.php?id=<?php echo $pid ?>';">Ok</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

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
   $(document).ready(function () {
    $("input[type='checkbox']").change(function () {
        if ($(this).attr("id") === "None") {
            if ($(this).prop("checked")) {
                $("input[type='checkbox']").not(this).prop("checked", false).prop("disabled", true);
            } else {
                $("input[type='checkbox']").not(this).prop("disabled", false);
            }
        } else {
            if ($(this).prop("checked")) {
                $("#None").prop("checked", false).prop("disabled", true);
            } else {
                $("#None").prop("disabled", false);
            }
        }
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const saveButton = document.getElementById("SaveComplain");
    saveButton.addEventListener("click", function (event) {
        const requiredFields = document.querySelectorAll("[required]");

        for (const field of requiredFields) {
            if (!field.value.trim()) {
                alert("Please fill in all required fields.");
                event.preventDefault(); // Prevent form submission
                return;
            }
        }

        // Continue with form submission if all required fields are filled
    });
});
</script>


</body>

</html>


<?php
//    if(isset($_POST['register']))
//   {
//     $patientName = $_POST['patientName'];
//     $age = $_POST['age'];
//     $gender = $_POST['gender'];
//     $date = $_POST['date'];
//     $time = $_POST['time'];
//     $patientid = $_POST['patientid'];
//     $presentation = $_POST['presentation'];



//     $query = "INSERT INTO patientregistration values('$patientName','$age','$gender','$date','$time','$patientid','$presentation')";

//     $data = mysqli_query($conn,$query);


//     if($data)
//     {
//       //echo "data inserted into database";
//     }
//     else
//     {
//       echo "Failed";
//     }

//   }

?>