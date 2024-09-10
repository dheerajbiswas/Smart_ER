<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset ($_SESSION['login']) || $_SESSION['login'] === "110010") {
  //do nothing
} else {
  $_SESSION['token'] = "001";
  header("Location: intro.php");
}

if ($_SESSION['token'] === "110") {
  echo '<script>alert("Prescription saved successfully.");</script>';
}
$_SESSION['token'] = "000";

include ("connection.php");
//error_reporting(0);
// if($_GET['role'] === "user") {
//   $doctor = $_GET['doc'];
//   $query = "SELECT * FROM patientregistration WHERE treated_by='$doctor'";
//   // echo $doctor . " <br> ". $query;
// } else
if (isset ($_GET['doc'])) {
  $doctor = $_GET['doc'];
  $query = "SELECT * FROM patientregistration WHERE expertname='$doctor' ORDER BY date DESC, time DESC";

  // $query = "SELECT * FROM patientregistration";
  $data = mysqli_query($conn, $query);

  $total = mysqli_num_rows($data);
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
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" /> -->

  <!-- datatable css -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap5.css">


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
        <h2 class="fluid">Expert Login</h2>
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

  <!-- <div class="row"> -->
  <!-- < php  -->
  <!-- //if ($_GET['role'] === "user") {
        //   echo '<div class="col" style="text-align: right;">
        //   <input type="button" class="btn btn-warning btn" value="New patient registration"
        //   onclick="window.location.href=' . "'patient-register.php'" . ';">
        // </div>';
        //}
        ?> -->
  <div class="container">
    <div class="row">
      <div class="col text-center m-5">
        <h4>List of Patients</h4>
      </div>
    </div>
    <!-- </div> -->
    <!-- <div class="icon-box icon-box-cyan" -->
    <!-- style="align-self:center; min-height: 400px; max-height: auto; margin-bottom: 50px; max-width: auto;"> -->
    <!-- <p> -->
    <!-- <div class="row ">
        <div class="col"> -->
    <div class="row justify-content-md-center">
      <div class="col-sm-12"></div>
      <!-- style="border:2px solid black; border-radius: 0.3em; padding:10px;" -->
      <table class="table table-striped table-bordered table-hover dataTable compact nowrap" id="myTable"
        style="width: 100%;">
        <!-- style="min-height: auto; max-height: auto; margin-bottom: 10px; "> -->
        <!-- min-height was 400px -->
        <thead>
          <tr>
            <th>Patient ID</th> <!---->
            <th>Patient Name</th> <!--width="40%"-->
            <th>Age</th> <!--width="10%"-->
            <th>Gender</th> <!--width="10%"-->
            <th>Date</th> <!--width="10%"-->
            <th>Time</th> <!--width="10%"-->
            <th>Presentation </th> <!--width="10%"-->
            <th>Status </th> <!--width="10%"-->
            <th>Risk </th> <!--width="10%"-->
            <th>Action</th> <!--width="10%"-->
            <th>View Presciption</th> <!--width="10%"-->
          </tr>
        </thead>
        <tbody>
          <?php

          while ($result = mysqli_fetch_assoc($data)) {
            $rkstyle = ($result['risk'] === "High risk") ? "color: red;" : "";
            $statstyle = ($result['expertOpinion'] === "Completed" || $result['expertOpinion'] === "Not Taken") ? "color: green;" : "color: red;";
            // echo $style;
            //pending row display
            if ($result['expertOpinion'] === "Pending") {
              echo "<tr>
                            <td>" . $result['patientid'] . "</td>
                            <td>" . $result['patientName'] . "</td>
                            <td>" . $result['age'] . "</td>
                            <td>" . $result['gender'] . "</td>
                            <td>" . $result['date'] . "</td>
                            <td>" . $result['time'] . "</td>
                            <td>" . $result['presentation'] . "</td>
                            <td style='" . "$statstyle" . "'>" . $result['expertOpinion'] . "</td>
                            <td style='" . "$rkstyle" . "'>" . $result['risk'] . "</td>";
              ?>
              <?php
              echo '<td> <button class="edit btn btn-sm btn-primary" onclick='
                . '"window.location.href=' . "'expert-options.php?id="
                . $result['patientid'] . "';" . '">Select</button></a> </td>'

                . '<td> <button class="edit btn btn-sm btn-primary" disabled onclick='
                . '"window.location.href=' . "'expertviewprescription.php?id="
                . $result['patientid'] . "';" . '">Click</button></a> </td>
                          </tr>';
              //completed row display
            } elseif ($result['expertOpinion'] === "Completed") {
              echo "<tr>
                            <td>" . $result['patientid'] . "</td>
                            <td>" . $result['patientName'] . "</td>
                            <td>" . $result['age'] . "</td>
                            <td>" . $result['gender'] . "</td>
                            <td>" . $result['date'] . "</td>
                            <td>" . $result['time'] . "</td>
                            <td>" . $result['presentation'] . "</td>
                            <td style='" . "$statstyle" . "'>" . $result['expertOpinion'] . "</td>
                            <td>" . $result['risk'] . "</td>";
              ?>
              <?php
              echo
                '<td> <button class="edit btn btn-sm btn-primary" disabled onclick='
                . '"window.location.href=' . "'expert-options.php?id="
                . $result['patientid'] . "';" . '">Select</button></a></td>'

                . '<td> <button class="edit btn btn-sm btn-primary" onclick='
                . '"window.location.href=' . "'expertviewprescription.php?id="
                . $result['patientid'] . "';" . '">Click</button></a> </td>

                            </tr>';

            }
          }
          // <td> <button class='edit btn btn-sm btn-primary'onclick='redirectToProforma()'>Select</button></a></td></tr>";
          ?>
        </tbody>
      </table>


      <br>
      <!-- </div> -->
      <!-- </div>
      </div> -->
      <!-- </div> -->
    </div>
  </div>
  <!-- </div> -->
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


  <!-- below two are older datatable libs -->
  <!-- <script src="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap5.js"></script>

  <script>
    // $(document).ready(function () {
    $('#myTable').DataTable({
      responsive: true
      ,
      columnDefs: [
        { responsivePriority: 1, targets: 8 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 4 },
        { responsivePriority: 4, targets: 5 }
      ],
      order: [
        [4, 'desc'],
        [5, 'desc']
      ]
    });
    // });
  </script>



  <script>
    setTimeout(function () {
      location.reload();
    }, 20000); // 5000 milliseconds = 5 seconds
  </script>




  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    function selectPatient(patientId) {
      // Here, you can perform any action when the select button is clicked
      // For example, you can redirect to a new page with the selected patient ID
      // Replace "expert-options.html" with the desired URL or page.
      // window.location.href = "expert-options.html?patientid=" + patientId;
    }


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
      // window.location.href = "expert-options.html?patientid=" + patientId;
    }
  </script>


</body>

</html>