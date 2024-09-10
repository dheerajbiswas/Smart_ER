<?php
session_start();

include_once("whatsapp.php");
include('connection.php'); //include_once was written
// require_once __DIR__ . "/vendor/autoload.php";

// --------- PHPMailer initialization ------------------
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = 3; //uncomment to see the debuging
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "emailid";
$mail->Password = "password";
// ---------- PHPMailer initialization over ---------------


if (isset($_SESSION['login']) || $_SESSION['login'] === "110010") {
    //do nothing
} else {
    $_SESSION['token'] = "001";
    header("Location: intro.php");
}


$pid = $_SESSION['pid'] ? $_SESSION['pid'] : "";

// fetching data for patient
if ($pid !== "") {
    $sql = "SELECT * FROM patientregistration WHERE patientid = '$pid'";
    $result = mysqli_query($conn, $sql) or die("Failed");
    $data = mysqli_fetch_array($result);
    $hear = $data['total'];
    $patientname = $data['patientName'];
    $patientid = $data['patientid'];
}

$query2 = "SELECT DISTINCT drug FROM medicines";
$medlist = mysqli_query($conn, $query2);
$medicinelist = mysqli_num_rows($medlist);


// fetching data for practitioner
// $field = $data['treated_by'];
// echo $field;
// if ($field !== "") {
//     $sql = "SELECT * FROM login WHERE Name = '$field'";
//     $pract = mysqli_query($conn, $sql) or die("Failed");
//     $pract_detail = mysqli_fetch_array($pract);
//     $pract_name = $pract_detail['Name'];
//     $pract_wno = $pract_detail['whatsapp_no'];
//     $pract_hosp = $pract_detail['hospital'];
//     $salutation = $pract_detail['salute'];
// }


// $medicines = array();
// $medicines = ['Aspirin 75 mg']; //, 'Clopitru 75mg', 'tenetase 20mg Vial', 'Heparin 25000iu Vial'];

$shoplist = array();

// $sql = "SELECT storename, location FROM medicallogin WHERE medicine = '$medicines[0]'";
// $medicals = mysqli_query($conn, $sql) or die("Failed");
// $medicals_detail = mysqli_fetch_assoc($medicals);

// Query to fetch table names from TableList
$sql = "SELECT shopno FROM medicallogin";
$result1 = mysqli_query($conn, $sql) or die("Failed");
// $shopTables = mysqli_fetch_all($result1);
// // print_r($result->fetch_assoc());
// if ($result) {
//     $unionQuery = "";

//     // Construct the UNION query dynamically
//     while ($row = mysqli_fetch_assoc($result)) {
//         $tableName = $row['shopno'];
//         $unionQuery .= "SELECT * FROM $tableName WHERE medicine = '$medicines[0]' UNION ALL ";
//     }
//     // Remove the trailing "UNION ALL" from the query
//     $unionQuery = rtrim($unionQuery, " UNION ALL ");
//     // $unionQuery .=  " WHERE drug = '$medicines[0]'" ;

//     echo $unionQuery;

//     // Execute the UNION query
//     // $finalResult = $mysqli->query($unionQuery);
//     $finalResult = mysqli_query($conn, $unionQuery) or die("Failed");
//     // print_r($finalResult);
//     if ($finalResult) {
//         // Process and display the results
//         // while ($row = mysqli_fetch_assoc($finalResult)) {
//         //     // Process and display row data
//         //     print_r($row);
//         //     echo "<br>";
//         // }
//     } else {
//         // echo "Error executing UNION query: " . $mysqli->error;
//     }
// } else {
//     // echo "Error fetching table names: " . $mysqli->error;
// }

// $med = 


























$medicines = explode(",", $data['medicines']); //['Alpyrin 75 mg'];

$shopTables = [];
while ($shops = mysqli_fetch_assoc($result1)) {
    $shopTables[] = $shops;
    // print_r($shops['shopno']);
}
// print_r($shopTables[0]['shopno']);
// List of shop-specific tables (modify this according to your database structure)
// $shopTables = ['shop1', 'shop2'];

// Initialize an array to store shop IDs that have all specified medicines
$commonShopIds = [];

// Loop through each shop's table
foreach ($shopTables as $shopTable) {
    $shop = $shopTable['shopno'];
    $shopHasAllMedicines = true;

    // Search for each medicine in the shop's table
    foreach ($medicines as $medicine) {
        $sql = "SELECT price, Quantity, discount, totaldiscount, COUNT(*) as count FROM $shop WHERE medicine = ?";
        // echo $sql;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $medicine);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $count = $row['count'];
        // var_dump($row);
        // If the medicine is not found in this shop's table, mark it as incomplete
        if ($count == 0) {
            $shopHasAllMedicines = false;
            break;
        }

        $stmt->close();
    }

    // If the shop has all specified medicines, add its ID to the commonShopIds array
    if ($shopHasAllMedicines) {
        // Extract shop ID from the table name (modify this according to your table naming convention)
        // $shopId = extractShopIdFromTableName($shopTable);
        $commonShopIds[] = $shopTable; //$shopId;
    }
}

// Retrieve shop information for the common shop IDs
// $commonShops = [];

// echo "<br>";
// var_dump($commonShopIds);



// Initialize an array to store results
$shopData = [];

foreach ($commonShopIds as $shopId) {
    $shopId = $shopId['shopno'];
    // Query to retrieve information for the current shop ID
    $sql = "SELECT * FROM `medicallogin` WHERE shopno = ?";

    // Prepare the SQL query
    $stmt = $conn->prepare($sql);

    // if (!$stmt) {
    //     die("Error in prepare statement: " . $conn->error);
    // }

    // Bind the shop ID as a parameter
    if (!$stmt->bind_param("s", $shopId)) {
        die("Error in bind_param: " . $stmt->error);
    }

    // Execute the query
    if (!$stmt->execute()) {
        die("Error in execute: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();

    // Fetch the data and add it to the array
    while ($row = $result->fetch_assoc()) {
        $shopData[] = $row;
    }

    // Close the statement for the current shop ID
    $stmt->close();
}


// var_dump($shopData);



// Close the database connection
// $conn->close();

// Convert the array to JSON
// $jsonData = json_encode($shopData);

// Return the JSON data
// echo $jsonData;




// if (!empty($commonShopIds)) {
//     $sql = "SELECT * FROM medicallogin WHERE shopno IN (" . implode(",", $commonShopIds) . ")";
//     echo $sql;
//     $result = $conn->query($sql);
// echo "<br>";

//     var_dump($result);
//     while ($row = $result->fetch_assoc()) {
//         $commonShops[] = $row;
//     }
// }

// Close the database connection
// $conn->close();

// Return the list of shops that have all the specified medicines
// echo json_encode($commonShops);

// Function to extract shop ID from table name (customize based on your table naming convention)
function extractShopIdFromTableName($tableName)
{
    // Implement the logic to extract the shop ID from the table name
    // For example, if the table name is 'shop1_medicine_shop', you can extract 'shop1'
    // return substr($tableName, 0, strpos($tableName, '_medicine_shop'));
    return $tableName;
}


























































// ----------------------------modal actions----------------------------
$target_dir = "uploads/" . $pid . "/";
// Check if directory already exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
} else {
    // echo "Directory does not exist.";
}

$prescExpert = $data['expert_presc_path'];
$prescField = $data['prescription_path'];
$img_path = $data['ecgpath'];

$presc = file_get_contents("uploads/" . $pid . "/" . $pid . ".txt");
// Convert newline characters to HTML line breaks
$presc = nl2br($presc);

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
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnsvsj322vl7MWNi-V_2vcqsZCfXKZa7I"></script> -->
    <!-- <script async defer scr="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnsvsj322vl7MWNi-V_2vcqsZCfXKZa7I&callback=myMapping&v=weekly"></script> -->

    <!-- =======================================================
  * Template Name: Moderna - v2.0.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <!-- this css is for background dull -->
    <style>
        .box {

            /* border: 2px solid; */
            border-radius: 0.3em;
            background-color: #fff;
            box-shadow: 2px 1px 4px;
            padding-top: 20px;
            padding-bottom: 20px;
            margin: 5px;
        }
    </style>

</head>

<body style="background-color: #eee;">
    <!-- #f3f8fa -->
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
                <h2>Patient Login</h2>
                <!-- <ol>
                    <li><
                    a href="index.html">Home</a></li>
                    <li>Practitioner Login</li>
                </ol> -->
            </div>
        </div>
    </section>
    <!-- header and breadcrum section -->

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
                <div class="col">
                    <div class="row">
                        <div class="col text-center">
                            <h4><strong>
                                    <p>
                                        <?php echo $data['patientName']; ?>
                                    </p>
                                    <p> Patient ID:
                                        <?php echo $data['patientid']; ?>
                                    </p>
                            </h4></strong>
                        </div>
                    </div>
                    <!-- <div class="row text-center">
                        <div class="col">
                            <h5 id="patientid" name="patientid" <?php // echo "readonly"; ?>><strong>Patient Id:
                                    <?php //echo $pid; ?>
                                </strong></h5>
                            <br>
                        </div>
                    </div>  
                    <br> -->

                    <div class="row">
                        <!-- column-1 -->
                        <!-- <div class="col-lg text-center box">
                           
                            
                        </div> -->


                        <!-- column-2 -->
                        <div class="col-lg text-center box">
                            <div class="row text-center" style="margin-top: 15px;">
                                <div class="col">
                                    <h5 id="patientid" name="patientid" <?php // echo "readonly"; ?>><strong>Documents
                                            <?php //echo $pid; ?>
                                        </strong>
                                    </h5>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="row"> -->
                            <!-- <div class="col"><label for="clinical">View clinical details:</label></div> -->
                            <!-- <div class="col">
                                    <input type="button" class="btn btn-primary" target="_blank"
                                        onclick="window.location.href='proforma-sum-expert.php?id=<?php echo !empty($pid) ? $pid : ''; ?>'"
                                        id="clinical" style="width: 250px; border-radius: 0.0em; margin-top: 10px;" value="View clinical details">
                                        <script>
                                            document.getElementById("clinical").onclick = function () {
                                                // Replace "https://www.example.com" with the URL of the page you want to open
                                                window.open("proforma-summary2.php?id=<?php echo !empty($pid) ? $pid : ''; ?>", "_blank");
                                                // proforma-sum-expert
                                            };
                                        </script>
                                </div>
                            </div> -->

                            <div class="row">
                                <!-- <div class="col"><label for="viewecg">View ECG:</label></div> -->
                                <div class="col">
                                    <input type="button" class="btn btn-primary" name="Click" id="viewecg"
                                        style="width: 250px; border-radius: 0.0em; margin-top: 10px;" value="View ECG">
                                    <!-- target="_blank" onclick="window.location.href='uploads/421/421.jpg'" -->
                                    <script>
                                        document.getElementById("viewecg").onclick = function () {
                                            window.open("<?php echo $img_path; ?>", "_blank");
                                            // window.open("<?php //echo "uploads/".$pid."/".$pid.".jpg" ?>", "_blank");
                                        };
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col"><label for="interview">View expert's prescription:</label></div> -->
                                <div class="col">
                                    <input type="button" class="btn btn-primary" id="expert_prescription"
                                        style="width: 250px; border-radius: 0.0em; margin-top: 10px;" target="_blank"
                                        <?php echo $data['expertOpinion'] !== "Completed" ? "disabled" : ""; ?>
                                        value="View expert's prescription">
                                    <script>
                                        document.getElementById("expert_prescription").onclick = function () {
                                            window.open("<?php echo $prescExpert; ?>", "_blank");
                                            // uploads/421/.pdf?id=
                                        };
                                    </script>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="col"><label for="interview">View your prescription:</label></div> -->
                                <div class="col">
                                    <!-- <input type="button" class="btn btn-primary" id="field_prescription" style="width: 250px; border-radius: 0.0em; margin-top: 10px;" target="_blank" 
                                        <?php //echo $data['stat'] === "Pending"? "disabled": "";?> value="View your prescription"> -->
                                    <!-- onclick="window.location.href='uploads/421/patientdetails.pdf'"  -->

                                    <!-- <script>
                                        document.getElementById("field_prescription").onclick = function () {
                                            window.open("<?php //echo $prescField; ?>", "_blank");
                                            // uploads/421/421_field.pdf?id=
                                        };
                                    </script> -->
                                </div>
                            </div>
                            <!-- <hr> -->



                        </div>



                        <!-- column-3 -->
                        <div class="col-lg text-center box">
                            <div class="row text-center" style="margin-top: 15px;">
                                <div class="col">
                                    <h5 id="patientid" name="patientid" <?php // echo "readonly"; ?>>
                                        <strong>Prescribed Medicines</strong>
                                    </h5>
                                </div>
                            </div>
                            <hr>

                            <form method="POST">
                                <p style="text-align: left;">
                                    <?php foreach ($medicines as $medicine) {
                                        echo "<br>" . $medicine;
                                    } ?>
                                    <!-- <hr> -->
                                    <!-- <input type="button" class="btn btn-warning" name="medicalstore" id="medicalstore"
                                        style="width: ;  margin-top: 0px;" value="Search medical store"> -->
                                </p>


                                <div class="row text-center" style="margin-top: 15px;">
                                    <div class="col">
                                        <h5 id="patientid" name="patientid" <?php // echo "readonly"; ?>>
                                            <strong>Direction</strong>
                                        </h5>
                                    </div>
                                </div>
                                <hr>
                                <p style="text-align: left;">
                                    <!-- <hr> -->
                                    <?php
                                    echo $presc;
                                    ?>
                                    <!-- <input type="button" class="btn btn-warning" name="medicalstore" id="medicalstore"
                                        style="width: ;  margin-top: 0px;" value="Search medical store"> -->
                                </p>


                                <!-- <p>
                            <h5><strong>Add medicines to pack</strong></h5>
                            <hr>
                            </p>
                            <form method="POST">
                                <div class="row">
                                    <div class="col" style="text-align: left;">
                                        <label for="drug">Select drug: </label>
                                        <select id="drug" name="drug" style="width: 100px;">
                                            <option value="" selected>Select</option>
                                            <?php


                                            // while ($med = mysqli_fetch_assoc($medlist)) {
                                            
                                            //     echo '<option value="' . $med['drug'] . '">' . $med['drug'] . '</option>';
                                            // }
                                            ?>
                                        </select>
                                    </div> -->
                                <!-- <div class="col" style="text-align: left;">
                                        <label for="medicineslist">Select medicine: </label>
                                        <select id="medicineslist" name="medicineslist" style="width: 100px;">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>

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
                                    </script> -->
                                <!-- </div>
                            </form>
                            <hr>
                            <p> -->
                                <!-- button for Add -->
                                <!-- <input type="button" id="addItem" name="addItem" class="btn btn-warning" value="Add">
                                <input type="button" id="clearItems" name="clearItems" class="btn btn-warning"
                                    value="Clear"> -->
                                <!-- <input type="button" id="searchShops" name="searchShops" class="btn btn-warning" value="Search"> -->
                                <!-- 
                            </p>
                            <hr>
                            <h5>Medicine pack</h5>
                            <ul id="selectedItems" style="text-align: left;">
                                <li>No medicines in the pack</li>
                            </ul>
                            <hr>
                            <p>
                                <input type="button" class="btn btn-warning" name="medicalstore" id="medicalstore"
                                    style="width: ;  margin-top: 0px;" value="Search medical store">
                            </p> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg text-center box">
                            <p>
                            <h5><strong>Medical Stores</strong></h5>
                            <hr>
                            </p>
                            <p style="text-align: left;">
                                <?php $sno = 1;

                                foreach ($shopData as $shops) {
                                    echo "<span class='stores' id='" . $shops['shopno'] . "'  style='color:black;' name='" . $shops['storename'] . "'
                                            onclick='showLabel(this);'><strong>" . $shops['storename'] . "</strong>, " . $shops['location'] . " | Phone No.: " . $shops['phone_no'] . "<br>" . "</span> <br>";
                                    // $sno += 1; "Cost: ". $shops['price']."Discount: ". $shops['discount'] .
                                }



                                // while($row = mysqli_fetch_assoc($medicals)) {
                                //     echo '<a href="#">' .$row['']. " Location Distance -> Search medicines " ."<br>".'</a>';
                                //     $sno += 1;
                                //  }
                                // print_r($row);
                                ?>
                            </p>

                            <style>
                                .stores {
                                    cursor: pointer;
                                    /* Set the cursor style to pointer */
                                }

                                .stores:hover {
                                    text-decoration: underline;
                                }

                                #shops {
                                    opacity: 1;
                                    transition: opacity 0.3s ease-in-out;
                                    /* Add transition property */
                                }
                            </style>
                        </div>

                        <div class="col-lg text-center box" id="shops">
                            <p>
                                <strong>
                                    <h5 id="shopname">Select a shop</h5>
                                </strong>
                                <hr>
                            </p>

                            <div id="medicineDetails">
                                Medicine Details
                            </div>

                            <p style="text-align: left;">
                            </p>
                        </div>
                    </div>






                    <div class="row">
                        <div class="col-lg text-center box">
                            <p>
                            <h5><strong>View Map</strong></h5>
                            </p>
                            <hr>

                            <div id="map" style="width: 100%; height: 600px;">
                            </div>

                            <!-- <script
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
                                defer></script>
                            <script>
                                function initMap() {
                                    const myLatLng = { lat: 21.218225297087145, lng: 81.6267935118028 };
                                    const map = new google.maps.Map(document.getElementById("map"), {
                                        zoom: 4,
                                        center: myLatLng
                                    });
                                }

                                initMap();
                            </script>
                            <script>
                                (g => { var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window; b = b[c] || (b[c] = {}); var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => { await (a = m.createElement("script")); e.set("libraries", [...r] + ""); for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]); e.set("callback", c + ".maps." + q); a.src = `https://maps.${c}apis.com/maps/api/js?` + e; d[q] = f; a.onerror = () => h = n(Error(p + " could not load.")); a.nonce = m.querySelector("script[nonce]")?.nonce || ""; m.head.append(a) })); d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)) })({
                                    key: "AIzaSyAnsvsj322vl7MWNi-V_2vcqsZCfXKZa7I",
                                    v: "weekly",
                                    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
                                    // Add other bootstrap parameters as needed, using camel case.
                                });
                            </script> -->












                            <!-- prettier-ignore -->
                            <script>(g => { var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window; b = b[c] || (b[c] = {}); var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => { await (a = m.createElement("script")); e.set("libraries", [...r] + ""); for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]); e.set("callback", c + ".maps." + q); a.src = `https://maps.${c}apis.com/maps/api/js?` + e; d[q] = f; a.onerror = () => h = n(Error(p + " could not load.")); a.nonce = m.querySelector("script[nonce]")?.nonce || ""; m.head.append(a) })); d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)) })
                                    ({ key: "AIzaSyAnsvsj322vl7MWNi-V_2vcqsZCfXKZa7I", v: "weekly" });</script>
                            <script>
                                let map;

                                async function initMap() {
                                    const { Map } = await google.maps.importLibrary("maps");

                                    map = new Map(document.getElementById("map"), {
                                        // center: { lat: 21.218416213989258, lng: 81.62674713134766 },
                                        center: { lat: 21.2181775, lng: 81.6267073 },
                                        zoom: 21,
                                    });
                                }
                                
                                initMap();
                            </script>









                            <!-- show markers of the medical stores and the remote clinic -->
                            <!-- <script>
                                // The following example creates five accessible and
                                // focusable markers.
                                async function initMap() {
                                    const map = new google.maps.Map(document.getElementById("map"), {
                                        zoom: 12,
                                        center: { lat: 34.84555, lng: -111.8035 },
                                    });
                                    // Set LatLng and title text for the markers. The first marker (Boynton Pass)
                                    // receives the initial focus when tab is pressed. Use arrow keys to
                                    // move between markers; press tab again to cycle through the map controls.
                                    const tourStops = [
                                        [{ lat: 34.8791806, lng: -111.8265049 }, "Boynton Pass"],
                                        [{ lat: 34.8559195, lng: -111.7988186 }, "Airport Mesa"],
                                        [{ lat: 34.832149, lng: -111.7695277 }, "Chapel of the Holy Cross"],
                                        [{ lat: 34.823736, lng: -111.8001857 }, "Red Rock Crossing"],
                                        [{ lat: 34.800326, lng: -111.7665047 }, "Bell Rock"],
                                    ];
                                    // Create an info window to share between markers.
                                    const infoWindow = new google.maps.InfoWindow();

                                    // Create the markers.
                                    tourStops.forEach(([position, title], i) => {
                                        const marker = new google.maps.Marker({
                                            position,
                                            map,
                                            title: `${i + 1}. ${title}`,
                                            label: `${i + 1}`,
                                            optimized: false,
                                        });

                                        // Add a click listener for each marker, and set up the info window.
                                        marker.addListener("click", () => {
                                            infoWindow.close();
                                            infoWindow.setContent(marker.getTitle());
                                            infoWindow.open(marker.getMap(), marker);
                                        });
                                    });
                                }

                                // window.initMap = initMap;
                                initMap1();

                            </script> -->







                            <!-- Calculating the distance between field hospital to multiple peripheral medical stores -->
                            <!-- <script
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnsvsj322vl7MWNi-V_2vcqsZCfXKZa7I&callback=initMap&v=weekly"
                                defer></script>
                            <script>
                                function initMap() {
                                    const bounds = new google.maps.LatLngBounds();
                                    const markersArray = [];
                                    const map = new google.maps.Map(document.getElementById("map"), {
                                        center: { lat: 55.53, lng: 9.4 },
                                        zoom: 10,
                                    });
                                    // initialize services
                                    const geocoder = new google.maps.Geocoder();
                                    const service = new google.maps.DistanceMatrixService();
                                    // build request
                                    const origin1 = { lat: 55.93, lng: -3.118 };
                                    const origin2 = "Greenwich, England";
                                    const destinationA = "Stockholm, Sweden";
                                    const destinationB = { lat: 50.087, lng: 14.421 };
                                    const request = {
                                        origins: [origin1, origin2],
                                        destinations: [destinationA, destinationB],
                                        travelMode: google.maps.TravelMode.DRIVING,
                                        unitSystem: google.maps.UnitSystem.METRIC,
                                        avoidHighways: false,
                                        avoidTolls: false,
                                    };

                                    // put request on page
                                    document.getElementById("request").innerText = JSON.stringify(
                                        request,
                                        null,
                                        2,
                                    );
                                    // get distance matrix response
                                    service.getDistanceMatrix(request).then((response) => {
                                        // put response
                                        document.getElementById("response").innerText = JSON.stringify(
                                            response,
                                            null,
                                            2,
                                        );

                                        // show on map
                                        const originList = response.originAddresses;
                                        const destinationList = response.destinationAddresses;

                                        deleteMarkers(markersArray);

                                        const showGeocodedAddressOnMap = (asDestination) => {
                                            const handler = ({ results }) => {
                                                map.fitBounds(bounds.extend(results[0].geometry.location));
                                                markersArray.push(
                                                    new google.maps.Marker({
                                                        map,
                                                        position: results[0].geometry.location,
                                                        label: asDestination ? "D" : "O",
                                                    }),
                                                );
                                            };
                                            return handler;
                                        };

                                        for (let i = 0; i < originList.length; i++) {
                                            const results = response.rows[i].elements;

                                            geocoder
                                                .geocode({ address: originList[i] })
                                                .then(showGeocodedAddressOnMap(false));

                                            for (let j = 0; j < results.length; j++) {
                                                geocoder
                                                    .geocode({ address: destinationList[j] })
                                                    .then(showGeocodedAddressOnMap(true));
                                            }
                                        }
                                    });
                                }

                                function deleteMarkers(markersArray) {
                                    for (let i = 0; i < markersArray.length; i++) {
                                        markersArray[i].setMap(null);
                                    }

                                    markersArray = [];
                                }

                                window.initMap = initMap;
                            </script> -->










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

                                    var searchShopsButton = document.getElementById("medicalstore");

                                    // Function to update the selected items list
                                    function updateSelectedItemsList() {
                                        // Clear the list
                                        selectedItemsList.innerHTML = "";

                                        // Add each item to the list
                                        selectedItems.forEach(function (item) {
                                            var listItem = document.createElement("li");
                                            listItem.textContent = item;
                                            selectedItemsList.appendChild(listItem);
                                        });
                                    }

                                    // Add a click event listener to the "Add" button
                                    addItemButton.addEventListener("click", function () {
                                        // Get the selected value from the dropdown
                                        var selectedItem = selectItem.value;

                                        // Check if the item is not already in the array
                                        if (selectedItem !== "" && !selectedItems.includes(selectedItem)) {
                                            // Remove the initial item if it's present
                                            if (selectedItems[0] === "No medicines in the pack") {
                                                selectedItems.shift(); // Remove the first item
                                            }

                                            // Add the selected item to the array
                                            selectedItems.push(selectedItem);

                                            // Update the selected items list
                                            updateSelectedItemsList();

                                            // Clear the dropdown selection
                                            selectItem.value = "";
                                        }
                                    });

                                    // Add a click event listener to the "Clear Items" button
                                    clearItemsButton.addEventListener("click", function () {
                                        // Clear the selected items array
                                        selectedItems = ["No medicines in the pack"];

                                        // Update the selected items list
                                        updateSelectedItemsList();
                                    });

                                    // Add a click event listener to the "Search Shops" button
                                    searchShopsButton.addEventListener("click", function () {
                                        // Create a JSON representation of the selected items
                                        var selectedItemsJSON = JSON.stringify(selectedItems);
                                        // console.log(selectedItems);

                                        // Send the JSON array to the PHP file for processing
                                        $.ajax({
                                            type: "POST",
                                            url: "searchshops.php", // Replace with the actual URL of your PHP script
                                            data: { selectedItems: selectedItemsJSON },
                                            success: function (response) {
                                                // Process the response from the PHP file
                                                console.log(response);
                                            },
                                            error: function () {
                                                alert("An error occurred while processing your request.");
                                            }
                                        });
                                    });


                                    // Initialize the selected items list
                                    updateSelectedItemsList();
                                });
                            </script>





                            <!-- to display shop and medicine details -->
                            <script>
                                // Get all elements with the class "label"
                                // var labels = document.querySelectorAll('.stores');
                                // var shopname =document.getElementById('shopname');

                                // Add a click event listener to each label
                                // labels.forEach(function (label) {
                                //     label.addEventListener('click', function () {
                                //         // Use 'this' to access the clicked label
                                //         // alert("You clicked on: " + this.textContent);
                                //         // shopname.textContent = labels.value;
                                //         console.log(labels.value);

                                //         // You can do more actions with 'this' here
                                //     });
                                // });


                                // Example shop name (replace with the actual shop name)
                                // var shopName = ;

                                function showLabel(label) {
                                    var id = label.id;

                                    var shopName = label.getAttribute('name');

                                    console.log(shopName);

                                    // var JSON = JSON.stringify(id);

                                    $.ajax({
                                        type: "POST",
                                        url: "calculate-med.php", // Replace with the actual URL of your PHP script
                                        data: { id },
                                        success: function (response) {
                                            // Process the response from the PHP file
                                            console.log(response);

                                            // Parse the JSON response data
                                            var responseData = JSON.parse(response);

                                            // Display shop details and medicine details when the response is received
                                            displayShopDetails(shopName);
                                            displayMedicineDetails(responseData);


                                        },
                                        error: function () {
                                            alert("An error occurred while processing your request.");
                                        }
                                    });





                                    // Function to display shop details
                                    // function displayShopDetails(shopName) {
                                    //     var shopDetails = document.getElementById("shopname");
                                    //     shopDetails.innerHTML = shopName;
                                    // }

                                    // Function to display shop details
                                    function displayShopDetails(shopName) {
                                        var shopDetails = document.getElementById("shopname");

                                        setTimeout(function () {
                                            // Apply fade-in effect
                                            shopDetails.innerHTML = shopName;

                                        }, 300);


                                        // Apply fade-out effect
                                        document.getElementById("shops").style.opacity = 0;

                                        // Use a timeout to apply the fade-in effect after a short delay (e.g., 300 milliseconds)
                                        setTimeout(function () {
                                            // Apply fade-in effect
                                            document.getElementById("shops").style.opacity = 1;
                                        }, 300);
                                    }

                                    // Rest of your JavaScript code...


                                    // Function to display medicine details
                                    function displayMedicineDetails(medicineData) {
                                        var genericMedicinesMessage = "";
                                        var alterMedicinesMessage = "";
                                        var medicineDetailsDiv = document.getElementById("medicineDetails");
                                        var html = "";

                                        //check if generic medicines are available or not
                                        if (Object.keys(medicineData.generic).length > 0) {
                                            // const genericMedicinesDiv = document.getElementById("genericMedicines");
                                            const genericMedicineList = [];

                                            for (const gen in medicineData.generic) {
                                                const generic = medicineData.generic[gen];

                                                genericMedicineList.push(`${generic.medicine} : Rs. ${generic.price}`);
                                            }
                                            genericMedicinesMessage = `Generic medicine is available:<br>\u2022 ${genericMedicineList.join("<br>\u2022 ")}`;
                                            // genericMedicinesDiv.textContent = genericMedicinesMessage;
                                            console.log(genericMedicinesMessage);

                                        }


                                        //check if generic medicines are available or not
                                        if (Object.keys(medicineData.alternatives).length > 0) {
                                            // const genericMedicinesDiv = document.getElementById("genericMedicines");
                                            const alterMedicineList = [];

                                            for (const alt in medicineData.alternatives) {
                                                const alter = medicineData.alternatives[alt];

                                                alterMedicineList.push(`${alter[0]} : ${alter[1]} : Rs. ${alter[2]}`);
                                            }
                                            alterMedicinesMessage = `Alternative medicine is available for:<br>\u2022 ${alterMedicineList.join("<br>\u2022 ")}`;
                                            // genericMedicinesDiv.textContent = alterMedicinesMessage;
                                            console.log(alterMedicinesMessage);
                                        }


                                        // Create an HTML table
                                        html += "<table border='1' width=100%>";
                                        if (parseFloat(medicineData.medicineDetails[0].totaldiscount) !== 0.0) {
                                            html += "<tr><th>Medicine</th><th>Quantity</th><th>Price</th><th>Discounted Price</th></tr>";
                                        } else {
                                            html += "<tr><th>Medicine</th><th>Quantity</th><th>Price</th><th>Off</th><th>Discounted Price</th></tr>";
                                        }

                                        var price = medicineData.totalData;

                                        if (parseFloat(medicineData.medicineDetails[0].totaldiscount) !== 0.0) {
                                            // Loop through the medicine details and add rows to the table
                                            for (var i = 0; i < medicineData.medicineDetails.length; i++) {
                                                var medicine = medicineData.medicineDetails[i];

                                                html += "<tr>";
                                                html += "<td>" + medicine.medicine + "</td>";
                                                html += "<td>" + medicine.quantity + "</td>";
                                                html += "<td>\u20B9" + medicine.price + "</td>";
                                                html += "<td>\u20B9" + medicine.discountedPrice + "</td>";
                                                html += "</tr>";
                                            }
                                            html += "<tr><td colspan = '2'><strong>Total</strong></td><td>\u20B9" + price.totalPrice2.toFixed(2) + "</td><td>\u20B9" + price.totalPrice.toFixed(2) + "</td></tr>";
                                            html += "</table>";
                                            html += "<p style='text-align:left; color: red;'>" + medicine.discount + "% off on purchase above \u20B9" + medicine.totaldiscount + "</p>";
                                            html += "<p style='text-align:left; color: green;'>You save \u20B9" + (price.totalPrice2 - price.totalPrice).toFixed(2) + "</p>";
                                            html += "<br><p style='text-align:left; color: green;'>" + genericMedicinesMessage + "</p>";
                                            html += "<br><p style='text-align: left;'>" + alterMedicinesMessage + "</p>";
                                            // Set the HTML content in the medicine details div
                                            setTimeout(function () {
                                                // Apply fade-in effect
                                                medicineDetailsDiv.innerHTML = html;
                                            }, 300);

                                        } else {
                                            // Loop through the medicine details and add rows to the table
                                            for (var i = 0; i < medicineData.medicineDetails.length; i++) {
                                                var medicine = medicineData.medicineDetails[i];
                                                html += "<tr>";
                                                html += "<td>" + medicine.medicine + "</td>";
                                                html += "<td>" + medicine.quantity + "</td>";
                                                html += "<td>\u20B9" + medicine.price + "</td>";
                                                html += "<td>" + medicine.discount + "%</td>";
                                                html += "<td>\u20B9" + medicine.discountedPrice + "</td>";
                                                html += "</tr>";
                                            }
                                            // html += "<td>\u20B9" + price + "</td>";

                                            html += "<tr><td colspan = '2'><strong>Total</strong></td><td>\u20B9" + price.totalPrice2.toFixed(2) + "</td><td></td><td>\u20B9" + price.totalPrice.toFixed(2) + "</td></tr>";
                                            html += "</table>";

                                            html += "<p style='text-align:left; color: green;'>You save \u20B9" + (price.totalPrice2 - price.totalPrice).toFixed(2) + "</p>";
                                            html += "<br><p style='text-align:left; color: green;'>" + genericMedicinesMessage + "</p>";
                                            html += "<br><p style='text-align: left;'>" + alterMedicinesMessage + "</p>";
                                            // Set the HTML content in the medicine details div
                                            setTimeout(function () {
                                                // Apply fade-in effect
                                                medicineDetailsDiv.innerHTML = html;
                                            }, 300);
                                        }
                                    }
                                }

                            </script>


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
                            </form>
                        </div>
                    </div>
                </div>

            </div>

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