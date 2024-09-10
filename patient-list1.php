<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
//error_reporting(0);


$query = "SELECT * FROM patientregistration";
$data = mysqli_query($conn, $query);

$total = mysqli_num_rows($data);

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
                <h2>Expert Login</h2>
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
    <section class="services" style="margin-top: 0px;">
      <div class="container" >

        <div class="row">



          <div class="container text-center">
            <p>
            <h4>List of Patients</h4>
            </p>
            <div class="icon-box icon-box-cyan"
              style="align-self:center; min-height: 400px; max-height:  720px; margin-bottom: 50px;">
              <p>


              <table class="table table-bordered" id="myTable" class="display">
                <thead>
                  <tr>
                    <th width="10%">Patient Name</th>
                    <th width="10%">Age</th>
                    <th width="10%">Gender</th>
                    <th width="10%">Date</th>
                    <th width="10%">Time</th>
                    <th width="10%">Patient ID </th>
                    <th width="10%">Status </th>
                    <th width="10%">Sign </th>
                    <th width="10%">Presentation </th>
                    
                    <th width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($result = mysqli_fetch_assoc($data)) {
                    
                    echo "<tr>
                            <td>" . $result['patientName'] . "</td>
                            <td>" . $result['age'] . "</td>
                            <td>" . $result['gender'] . "</td>
                            <td>" . $result['date'] . "</td>
                            <td>" . $result['time'] . "</td>
                            <td>" . $result['patientid'] . "</td>
                            <td>" . $result['time'] . "</td>
                            <td>" . $result['time'] . "</td>
                            <td>" . $result['presentation'] . "</td>";
                            
                            ?>
                            <?php 
                            echo 
                            '<td> <button class="edit btn btn-sm btn-primary" onclick='
                            .'"window.location.href='."'expert-options.php?id="
                            .$result['patientid']."';".'">Select</button></a></td>
                            </tr>';
                           
                        
                  }
                  // <td> <button class='edit btn btn-sm btn-primary'onclick='redirectToProforma()'>Select</button></a></td></tr>";
                  ?>
                </tbody>
              </table>

             <!-- <div class="row text-center" style="padding-top: 150px;">
                <div class="col"></div>
                <div class="col">
                  <p>
                    <input type="button" id="evaluate" class="btn btn-warning btn-lg " value="Evaluate"
                      onclick="window.location.href='expert-options.html';">
                  </p>
                </div>
                <div class="col"></div>
              </div>
            </div>-->
            <!--<form class="post-form" action="<?php //$_SERVER['PHP_SELF']; ?>" method="post">
              <div class="form-group">
                <p>
                  <label for="patientid">Enter Patient Id:</label>
                  <input type="text" id="patientid" name="patientid" />
                </p>
              </div>
              <input class="submit" type="submit" name="showbtn" value="Show" />
            </form>
            <br><br><br>-->
            <?php

            // if (isset($_POST['showbtn'])) {
            //   $conn = mysqli_connect("localhost", "root", "", "patientdetails") or die("Connection Failed");

            //   $patientid = $_POST['patientid'];
            //   $patientid = mysqli_real_escape_string($conn, $_POST['patientid']);
            //   $sql = "SELECT * FROM patientregistration WHERE patientid = '$patientid'";

            //   $sql = "SELECT * FROM patientregistration where patientid = {$patientid}";
            //   $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

            //   if (mysqli_num_rows($result) > 0) {
            //     while ($row = mysqli_fetch_assoc($result)) {

                  ?>
<!-- 
                  <form class="post-form" action="show.php" method="post">
                    <div class="form-group">

                      <label for="">PatientName</label>
                      <input type="hidden" name="patientid" value="<?php //echo $row['patientid']; ?>" />
                      <input type="text" name="patientName" value="<?php //echo $row['patientName']; ?>" />
                    </div>

                    <div class="form-group">
                      <label>Age</label>
                      <input type="text" name="age" value="<?php //echo $row['age']; ?>" />
                    </div>

                    <div class="form-group">
                      <label>Gender</label>
                      <input type="text" name="gender" value="<?php //echo $row['gender']; ?>" />
                    </div>

                    <br><br><br> -->

                    <?php
            //     }
            //   }
            // }
            ?>


              <!-- ... Your footer and script tags ... -->
             












<!-- <div class="container"> -->
<!-- <div class="col">

              <div id="gap-383814002" class="gap-element clearfix"
                style="display:block; height:auto; padding-left: 50px;">
              </div> -->

<!-- <div class="icon-box icon-box-cyan" style="margin-bottom: 150px;">
                <div class="col">

                  <h4>Paste a Link</h4>
                  <input type="text" name="provideLink" id="provideLink" rows="1" cols="50">
                  <br><br>
                  <input disabled id="send" type="button" class="btn btn-warning btn-lg" value="Send"> -->
<!-- onclick="window.location.href='index.html';" > this was commented when surrounding codes are not commented -->
<!-- <br><br><br>
                  <hr>
                  <div>
                    <h4>Write a Prescription</h4>
                    <textarea id="prescribe" name="prescribe" rows="4" cols="50" ;></textarea>
                  </div>
                  <br>
                  <input disabled id="submit" type="button" onclick="window.location.href='index.html';"
                    class="btn btn-warning btn-lg" value="Submit"> style="margin-left: 200px"> -->
<!-- </div>

                <script type="text/javascript">
                  const submit = document.getElementById("submit");
                  const send = document.getElementById("send");
                  const pres = document.getElementById('prescribe');
                  const prov = document.getElementById('provideLink');

                  pres.addEventListener('keyup', (e) => {
                    const value = e.currentTarget.value;
                    submit.disabled = false;

                    if (value === "") {
                      submit.disabled = true;
                    }
                  });

                  prov.addEventListener('keyup', (e1) => {
                    const value1 = e1.currentTarget.value;
                    send.disabled = false;

                    if (value1 === "") {
                      send.disabled = true;
                    }
                  });
                </script>
              </div> -->
</div>

<br><br><br>




</section>

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
    $(document).ready ( function (){
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
    Array.from(edits).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        console.log("edit ",);
        tr=e.target.parentNode.parentNode;
        title=tr.getElementsByTagName("td")[0].innertext;
        description=tr.getElementsByTagName("td")[1].innertext;
        console.log(title,description);
      })

    })
    </script>
    <script>
function redirectToProforma(patientId) {
  // Redirect the user to the "proforma11.php" page with the patient ID as a parameter
  window.location.href = "expert-options.html?patientid=" + patientId;
  
}
</script>


</body>

</html>