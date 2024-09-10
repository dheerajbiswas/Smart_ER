<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
// echo $_GET['token'];
// $token = isset($_GET['token'])? $_GET['token']:"";
// if ($token === '1') {
//     echo '<script>alert(' . '"An alert has been sent to Expert' . "'s mail" . '");</script>';
// } elseif ($token === '2') {
//     echo '<script>alert("Treatment completed");</script>';
// }
// $_SESSION['login'] === "110010";

if (isset($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}

if ($_SESSION['token'] === "101") {
    echo '<script>alert("An alert has been sent to expert.");</script>';
} elseif ($_SESSION['token'] === "110") {
    echo '<script>alert("Prescription saved successfully.");</script>';
}
$_SESSION['token'] = "000";

//error_reporting(0);
if (isset($_SESSION['medusername'])) {
    $med = $_SESSION['shopno'];
    // $query1 = "SELECT shopno FROM medicallogin WHERE username='$med'"; 
    // $result1 = mysqli_query($conn, $query) or die("Failed");
    $query = "SELECT * FROM $med";
    $data = mysqli_query($conn, $query) or die("Failed");
    // $total = mysqli_num_rows($data);
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

    <!-- Favicons -->
    <link href="assets/img/image_logo.png" rel="icon">
    <link href="assets/img/image_logo.png" rel="favicon">

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />




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
    <header id="header" class="fixed-top" style="height: 70px;">
        <div class="container">

            <div class="logo float-left">
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
                <?php //if($_GET['role'] === "user") { ?>
                <h2>Store Login:
                    <?php echo $_SESSION['name'] . " (" . $_SESSION['shopname'] . ")"; ?>
                </h2>
                <?php //}else{ ?>
                <!-- <h2>Expert Login</h2> -->
                <?php //} ?>
                <!-- <ol>
                    <li><
                    a href="index.html">Home</a></li>
                    <li>Practitioner Login</li>
                </ol> -->
            </div>
        </div>
    </section>
    <!-- header and breadcrum section -->

    <!-- <main id="main">

    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Expert Login</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Expert Login</li>
          </ol>
        </div>

      </div>
    </section> -->
    <!-- End Our Services Section -->

    <!-- ======= Services Section ======= -->
    <!-- <section class="" style="margin-top: 0px; width: 100%;"> -->
    <!-- <div class="container" style="width: 200%; margin-left: auto;"> -->

    <div class="row text-center" style="margin: 50px;">
        <div class="col">
            <?php
            echo '<div class="col" style="text-align: right;">
                    <input type="button" class="btn btn-warning btn" value="Add a medicine"
                    onclick="window.location.href=' . "'addmedicine.php'" . ';">
                    </div>';

            //}
            ?>
            <!-- <div class="container" style="width: 200%;"> -->
            <div class="col">
                <p>
                <h4>Medicines Stock</h4>
                </p>
                <!-- <div class="icon-box icon-box-cyan" -->
                <!-- style="align-self:center; min-height: 400px; max-height: auto; margin-bottom: 50px; max-width: auto;"> -->
                <!-- <p> -->

                <div class="">
                    <table class="table table-bordered" id="myTable" class="display"
                        style="min-height: auto; max-height: auto; margin-bottom: 10px; max-width: auto;">
                        <!-- min-height was 400px -->
                        <thead>
                            <tr>
                                <th style="text-align: center;">S. No.</th> <!---->
                                <th style="text-align: center;">Drug</th> <!--width="40%"-->
                                <th style="text-align: center;">Medicine</th> <!--width="10%"-->
                                <th style="text-align: center;">Type</th> <!--width="10%"-->
                                <th style="text-align: center;">Dose</th> <!--width="20%"-->
                                <th style="text-align: center;">Package</th> <!--width="10%"-->
                                <th style="text-align: center;">Quantity</th> <!--width="10%"-->
                                <th style="text-align: center;">Price </th> <!--width="10%"-->
                                <th style="text-align: center;">Discount </th> <!--width="10%"-->
                                <!-- <th style="text-align: center;">Total </th> -->
                                <!-- <th width="10%" >Risk </th> width="10%" -->
                                <!-- <th width="10%" >View Presciption</th> width="10%" -->
                                <!-- <th style="text-align: center;">Update</th>  -->
                                <!--width="10%"-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sno = 1;
                            while ($result = mysqli_fetch_assoc($data)) {
                                $rkstyle = ($result['totaldiscount'] != 0) ? " off on a purchase of " ."\u{20B9} ". $result['totaldiscount'] : "";
                                // $statstyle = ($result['stat'] === "Completed") ? "color: green;" : "color: red;";
                                // echo $style;
                                //pending row display
                                // if ($result['stat'] === "Pending") {
                                echo "<tr>
                                            <td>" . $sno . "</td>
                                            <td>" . $result['drug'] . "</td>
                                            <td>" . $result['medicine'] . "</td>
                                            <td>" . $result['type'] . "</td>
                                            <td>" . $result['dose'] . "</td>
                                            <td>" . $result['package'] . "</td>
                                            <td>" . $result['Quantity'] . "</td>
                                            <td>\u{20B9} " . $result['price'] . "</td>
                                            <td>" . $result['discount'] . "%" . $rkstyle. "</td>";
                                // style='" . "$statstyle" . "' --- for expertOpinion
                                // <td style='" . "$rkstyle" . "'>" . $result['risk'] . "</td>";
                                $sno++;
                                ?>
                                <?php
                                              // echo
                                    // '<td> <button class="edit btn btn-sm btn-primary" onclick='
                                    // . '"window.location.href=' . "'expert-options.php?id="
                                    // . $result['patientid'] . "';" . '">Select</button></a> </td>'
                            
                                    // .
                                              // '<td> <button class="edit btn btn-sm btn-primary" onclick='
                                              // . '"window.location.href=' . "'next.php?id="
                                              // . $result['Quantity'] . "';" . '">Click</button></a> </td>
                                              //     </tr>';
                                //completed row display
                                // } elseif ($result['stat'] === "Completed") {
                                //         echo "<tr>
                                // <td>" . $result['patientid'] . "</td>
                                // <td>" . $result['patientName'] . "</td>
                                // <td>" . $result['age'] . "</td>
                                // <td>" . $result['gender'] . "</td>
                                // <td>" . $result['date'] . "</td>
                                // <td>" . $result['time'] . "</td>
                                // <td>" . $result['presentation'] . "</td>
                                // <td style='" . "$statstyle" . "'>" . $result['stat'] . "</td>
                                // <td>" . $result['expertOpinion'] . "</td>";
                            
                                // <td>" . $result['risk'] . "</td>";
                            
                                ?>
                                <?php
                                //                  echo
                                //                     // '<td> <button class="edit btn btn-sm btn-primary" disabled onclick='
                                //                     // . '"window.location.href=' . "'expert-options.php?id="
                                //                     // . $result['patientid'] . "';" . '">Select</button></a></td>'
                            
                                //                     // .
                                //                     '<td> <button class="edit btn btn-sm btn-primary" onclick='
                                //                     . '"window.location.href=' . "'next-step.php?id="
                                //                     . $result['patientid'] . "';" . '">Click</button></a> </td>
                            
                                // </tr>';
                            
                            }
                            // }
                            // <td> <button class='edit btn btn-sm btn-primary'onclick='redirectToProforma()'>Select</button></a></td></tr>";
                            ?>
                        </tbody>
                    </table>
                </div>

                <br>







            </div>
        </div>
    </div>
    <!-- </section> -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <!-- <footer id="footer">
  <div class="container">
    <div class="copyright"> -->
    <!-- &copy; Copyright <strong><span>IBITF</span></strong>. All Rights Reserved -->
    <!-- </div>
    <div class="credits"> -->
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
    <script src="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });

    </script>






    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        function selectPatient(patientId) {
            // Here, you can perform any action when the select button is clicked
            // For example, you can redirect to a new page with the selected patient ID
            // Replace "expert-options.html" with the desired URL or page.
            window.location.href = "expert-options.html?patientid=" + patientId;
        }
    </script>


    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innertext;
                description = tr.getElementsByTagName("td")[1].innertext;
                console.log(title, description);
            })

        })
    </script>
    <script>
        function redirectToProforma(patientId) {
            // Redirect the user to the "proforma11.php" page with the patient ID as a parameter
            window.location.href = "expert-options.html?patientid=" + patientId;

        }
    </script>

    <script>
        setTimeout(function () {
            location.reload();
        }, 20000); // 5000 milliseconds = 5 seconds
    </script>

</body>

</html>