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

$_SESSION['token'] = "000";


$query2 = "SELECT DISTINCT drug FROM medicines";
$medlist = mysqli_query($conn, $query2);


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
                <!-- <h2>Field Login</h2> -->
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
            <div class="container" style="margin-top: 20px;">

                <h2 style="text-align: center;">Add medicines</h2>


            </div>
        </section>


        <section style="padding: 5px 5px;">
            <!--class="why-us section-bg> data-aos="fade-up" date-aos-delay="200"> -->
            <div class="container">
                <!-- Chest pain descriptors -->
                <form method="post">

                    <div class="row" style="margin-top: 10px;">

                        <!-- <div class="col"></div> -->
                        <!-- </div> -->
                        <div class="col">



                            <div class="col-lg text-center box">
                                <p>
                                <h5>Select medicines </h5>
                                <hr>
                                </p>
                                <!-- <form method="POST"> -->
                                <div class="row">

                                    <div class="col-8">

                                        <div class="row" style="margin: 2px;">
                                            <div class="col-4" style="text-align: left;">
                                                <label for="drug">Select drug:</label>
                                            </div>
                                            <div class="col-4">
                                                <select id="drug" name="drug" style="width: 200px;">
                                                    <option value="" selected>Select</option>
                                                    <?php


                                                    while ($med = mysqli_fetch_assoc($medlist)) {

                                                        echo '<option value="' . $med['drug'] . '">' . $med['drug'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row" style="margin: 2px;">
                                            <div class="col-4" style="text-align: left;">
                                                <label for="medicineslist">Select medicine: </label>
                                            </div>
                                            <div class="col-4">
                                                <select id="medicineslist" name="medicineslist" style="width: 200px;">
                                                    <option value="" selected>Select</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <div class="col" style="text-align: left;"> -->
                                    <!-- </div> -->

                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function () {
                                            $('#drug').change(function () {
                                                var selecteddrug = $(this).val();

                                                // Make an AJAX request to get specialists based on the selected drug
                                                $.ajax({
                                                    url: 'medicines.php', // Replace with your PHP script's URL
                                                    type: 'POST',
                                                    data: { drug: selecteddrug },
                                                    dataType: 'json',
                                                    success: function (data) {
                                                        var specialistDropdown = $('#medicineslist');
                                                        specialistDropdown.empty();

                                                        // Add an empty option to keep the "null" option
                                                        specialistDropdown.append($('<option>', {
                                                            value: '', // Empty value
                                                            text: 'Select' // Display text
                                                        }));

                                                        $.each(data, function (index, specialist) {
                                                            specialistDropdown.append($('<option>', {
                                                                value: specialist,
                                                                text: specialist
                                                            }));
                                                        });
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    <!-- </form> -->

                                    <div class="col-2" style="text-align: left; ">
                                        <div class="row" style="margin: 2px;">
                                            <!-- button for Add -->
                                            <input type="button" id="addItem" name="addItem" class="btn btn-warning"
                                                value="Add" style="width: 100px;">
                                        </div>
                                        <div class="row" style="margin: 2px;">

                                            <!-- button for clear -->
                                            <input type="button" id="clearItems" name="clearItems"
                                                class="btn btn-warning" value="Clear" style="width: 100px;">
                                            <!-- <input type="button" id="searchShops" name="searchShops" class="btn btn-warning" value="Search"> -->

                                        </div>
                                    </div>

                                </div>

                                <h5>List</h5>
                                <hr>

                                <!-- <ul id="selectedItems" style="text-align: left;">
                                            <li>No medicines in the pack</li>
                                        </ul> -->

                                <div class="row">
                                    <div class="col">
                                        <div class="row" id="medrow">
                                            <div class="col-7" id="selectedItems" style="text-align: left;">
                                                No medicines prescribed
                                            </div>
                                            <div class="col-3" style="text-align: left;" id="inputContainer">
                                                <input type="text">
                                            </div>
                                        </div>
                                    </div>


                                    <table class="table table-bordered" id="med_list"
                                        style="padding-left: 2px; padding-right: 2px;">
                                        <tr>
                                            <th>Drug</th>
                                            <th>Medicine</th>
                                            <th>gen</th>
                                            <th>type</th>
                                            <th>dose</th>
                                            <th>package</th>
                                            <th>quantity</th>
                                            <th>MRP</th>
                                            <th>Discount</th>
                                            <th>Discount on total cost</th>
                                            <th>Remove</th>
                                        </tr>
                                    </table>



                                    <script>
                                        $(document).ready(function () {
                                            var html = '<tr><td><input class="form-control" type="text" name="drug"></td>';
                                            html += '<td><input class="form-control" type="text" name="medicine"></td>';
                                            html += '<td><input class="form-control" type="text" name="gen"></td>';
                                            html += '<td><input class="form-control" type="text" name="type"></td>';
                                            html += '<td><input class="form-control" type="text" name="dose"></td>';
                                            html += '<td><input class="form-control" type="text" name="package"></td>';
                                            html += '<td><input class="form-control" type="text" name="quantity"></td>';
                                            html += '<td><input class="form-control" type="text" name="MRP"></td>';
                                            html += '<td><input class="form-control" type="text" name="discount"></td>';
                                            html += '<td><input class="form-control" type="text" name="totaldiscount"></td>';
                                            html += '<td><input class="form-control" type="text" name="" id="remove"></td>';
                                            html += '</tr>';

                                            // $("#addItem").click(function () {
                                            //     $("#med_list").append(html);
                                            // });
                                        });

                                        // $("#remove").click(function () {
                                        //     $("#med_list").shift();
                                        // });
                                    </script>
                                </div>
                                <!-- </form> -->

                                <p>
                                    <!-- <input type="button" class="btn btn-warning" name="medicalstore" id="medicalstore"
                                                    style="width: ;  margin-top: 0px;"  value="Search medical store"> -->
                                </p>
                            </div>
                            <!-- script for add items to the list -->
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    // Initialize an array with the initial item
                                    var selectedItems = ["No medicines in the pack"];

                                    // Get references to the HTML elements
                                    var selectItem = document.getElementById("medicineslist");
                                    var addItemButton = document.getElementById("addItem");
                                    var clearItemsButton = document.getElementById("clearItems");
                                    var selectedItemsList = document.getElementById("selectedItems");
                                    var med_list = document.getElementById("med_list");

                                    // var searchShopsButton = document.getElementById("medicalstore");

                                    // Function to update the selected items list
                                    function updateSelectedItemsList() {
                                        // Get references to the container elements
                                        var selectedItemsContainer = document.getElementById("selectedItems");
                                        var inputContainer = document.getElementById("inputContainer");

                                        // Clear the containers
                                        selectedItemsContainer.innerHTML = "";
                                        inputContainer.innerHTML = "";

                                        // Check if there are selected items
                                        if (selectedItems.length === 0) {
                                            // If there are no items, display "No medicines in the pack"
                                            selectedItemsContainer.textContent = "No medicines in the pack";
                                        } else {
                                            // Add each item and its input field
                                            selectedItems.forEach(function (item, index) {
                                                // Create a div for the item
                                                var itemDiv = document.createElement("div");
                                                itemDiv.textContent = item;

                                                // Create an input field
                                                var textField = document.createElement("input");
                                                textField.type = "text";
                                                textField.placeholder = "mention dosage";
                                                textField.id = "item_" + index;
                                                textField.name = "items[]";

                                                console.log(textField);
                                                // Append the item and input field to the respective containers
                                                selectedItemsContainer.appendChild(itemDiv);
                                                inputContainer.appendChild(textField);
                                            });
                                        }
                                    }





                                    // Function to update the selected items list
                                    function updateSelectedItemsList2() {
                                        // Get references to the container elements
                                        var selectedItemsContainer = document.getElementById("selectedItems");
                                        var inputContainer = document.getElementById("inputContainer");

                                        // Clear the containers
                                        selectedItemsContainer.innerHTML = "";
                                        inputContainer.innerHTML = "";

                                        // Check if there are selected items
                                        if (selectedItems.length === 0) {
                                            // If there are no items, display "No medicines in the pack"
                                            selectedItemsContainer.textContent = "No medicines in the pack";
                                        } else {
                                            // Add each item and its input field
                                            selectedItems.forEach(function (item, index) {
                                                // Create a div for the item
                                                var itemDiv = document.createElement("div");
                                                itemDiv.textContent = item;

                                                // Create an input field
                                                var textField = document.createElement("input");
                                                textField.type = "text";
                                                textField.placeholder = "mention dosage";
                                                textField.id = "item_" + index;
                                                textField.name = "items";

                                                // Create a table element
                                                var table = document.createElement("table");

                                                // Create table rows and cells
                                                for (var i = 0; i < numRows; i++) {
                                                    var row = table.insertRow(i);

                                                    for (var j = 0; j < numCols; j++) {
                                                        var cell = row.insertCell(j);
                                                        cell.textContent = "Row " + (i + 1) + ", Column " + (j + 1);
                                                    }
                                                }

                                                // Append the table to the DOM
                                                var container = document.getElementById("table-container"); // Replace "table-container" with the ID of the container where you want to append the table
                                                container.appendChild(table);



                                                // Append the item and input field to the respective containers
                                                // selectedItemsContainer.appendChild(itemDiv);
                                                // inputContainer.appendChild(textField);

                                            });
                                        }
                                    }







                                    // Add a click event listener to the "Add" button
                                    addItemButton.addEventListener("click", function () {
                                        // Get the selected value from the dropdown
                                        var selectedItem = selectItem.value;

                                        // $(document).ready(function () {
                                        // function medicineDetails() {
                                        var selecteddrug = selectedItem;//$(this).val();

                                        // Make an AJAX request to get specialists based on the selected drug
                                        $.ajax({
                                            url: 'allmedicines.php', // Replace with your PHP script's URL
                                            type: 'POST',
                                            data: { drug: selecteddrug },
                                            // dataType: 'json',
                                            success: function (response) {
                                                selectedItems = response[0];
                                                console.log(selectedItems);
                                            },
                                            error: function () {
                                                alert("An error occurred while processing your request.");
                                            }

                                            // var specialistDropdown = $('#medicineslist');
                                            // specialistDropdown.empty();

                                            // Add an empty option to keep the "null" option
                                            // specialistDropdown.append($('<option>', {
                                            //     value: '', // Empty value
                                            //     text: 'Select' // Display text
                                            // }));

                                            // $.each(data, function (index, specialist) {
                                            //     specialistDropdown.append($('<option>', {
                                            //         value: specialist,
                                            //         text: specialist
                                            //     }));
                                            // });

                                        });
                                        // }














                                        // Check if the item is not already in the array
                                        if (selectedItem !== "" && !selectedItems.includes(selectedItem)) {
                                            // Remove the initial item if it's present
                                            if (selectedItems[0] === "No medicines in the pack") {
                                                selectedItems.shift(); // Remove the first item
                                            }

                                            // Add the selected item to the array
                                            selectedItems.push(selectedItem);

                                            // Update the selected items list
                                            updateSelectedItemsList2();

                                            // Clear the dropdown selection
                                            selectItem.value = "";
                                        }
                                    });

                                    // Add a click event listener to the "Clear Items" button
                                    clearItemsButton.addEventListener("click", function () {
                                        // Clear the selected items array and the list
                                        clearSelectedItemsList();

                                        // Update the selected items list
                                        // updateSelectedItemsList();
                                    });

                                    // Function to clear the selected items list
                                    function clearSelectedItemsList() {
                                        // Clear the array
                                        selectedItems = [];
                                        inputContainer.innerHTML = "";
                                        // Clear the list
                                        selectedItemsList.innerHTML = "";

                                        // Create a list item for "No medicines in the pack" label
                                        var listItem = document.createElement("div");
                                        listItem.textContent = "No medicines in the pack";

                                        // Append the list item to the selected items list
                                        selectedItemsList.appendChild(listItem);
                                    }


                                    // Add a click event listener to the "Search Shops" button
                                    // searchShopsButton.addEventListener("click", function () {
                                    //     // Create a JSON representation of the selected items
                                    //     var selectedItemsJSON = JSON.stringify(selectedItems);
                                    //     // console.log(selectedItems);

                                    //     // Send the JSON array to the PHP file for processing
                                    //     $.ajax({
                                    //         type: "POST",
                                    //         url: "searchshops.php", // Replace with the actual URL of your PHP script
                                    //         data: { selectedItems: selectedItemsJSON },
                                    //         success: function (response) {
                                    //             // Process the response from the PHP file
                                    //             console.log(response);
                                    //         },
                                    //         error: function () {
                                    //             alert("An error occurred while processing your request.");
                                    //         }
                                    //     });
                                    // });


                                    // Initialize the selected items list
                                    updateSelectedItemsList2();
                                });
                            </script>




























                            <br>
                            <div class="row">
                                <div class=" col text-center">
                                    <button type="submit" id="saveAdvice" name="saveAdvice"
                                        class="btn btn-warning btn-lg" value="Save">Save</button>
                                    <!-- onclick="window.location.href='expert-advice-summary.php?id=<?php //echo $pid;?>';" -->
                                </div>
                            </div>



                            <!-- <div class="col"></div> -->

                </form>
            </div>
            </div>
            <!-- </div> -->

            <div class="container" style="margin: auto; padding-top: 30px">
                <!-- <div class="row align-items-center">
                    <div class="col text-center">
                        <input type="submit" class="btn btn-warning btn-lg" value="Submit" name="submit">
                    </div>
                </div> -->
            </div>

            </form>
            </div>


    </main>
    </section>
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