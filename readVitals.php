<!-- # read vitals using google cloud api -->
<?php

// include("upload-ecg.php");

$file = isset($_GET['file']) ? $_GET['file'] : "";
$monitor = isset($_GET['monitor']) ? $_GET['monitor'] : "No";

// $output = shell_exec("python capture/imageOCR.py nihon"); // $output, $return_var);

$executor = "C:\Python312\python";
$location = ($monitor === "nihon") ? 'capture/imageOCR_nihon.py' : 'capture/imageOCR2.py';
$image_file = 'capture/' . $file;
$command = $executor . " " . $location . " " . $image_file;// . " 2>&1";
echo $command;
// $output = shell_exec('C:\Python312\python capture/imageOCR2.py capture/' . $file);
$output = shell_exec($command);
// $output = exec("python capture/imageOCR.py nihon", $output, $return_var);

// if($return_var === 0){
//     echo "Python script executed successfully. <br>";
//     echo "Output: <br>";
//     // echo "<pre>". implode("\n", $output)."</pre>";
//     echo $output;
// }else{
// echo "error";
// // echo implode("\n", $output);
// }

// print_r($output);
$arr = json_decode($output, true);
// var_dump($arr); //very useful to check what is the output of the json file


// $pulse = array();

for ($i = 0; $i < count($arr); $i++) {

    $x = explode(": ", $arr[$i]);
    // var_dump($x);

    $y = explode(", ", $x[0]);
    // var_dump($y);

    // echo "<br> x = ";
    $z1 = explode("[[", $y[0]);
    // var_dump($z1[1]);
    $x1 = $z1[1]; //x-coordinate

    // echo "<br> y = ";
    $z2 = explode("]", $y[1]);
    // var_dump($z2[0]);
    $y1 = $z2[0]; //y-coordinate
    // echo "$x1 $y1 <br>";

    // for nihon patient monitor
    // if ($x1 > 150)
    //     continue;
    // if ($x1 >= 20 && $x1 <= 25 && $y1 >= 90 && $y1 <= 110) {
    //     // echo $x[1];
    //     $pulse[] = $x[1];
    // }
    // if ($x1 >= 0 && $x1 <= 10 && $y1 >= 190 && $y1 <= 200) {
    //     // echo $x[1];
    //     $pulse[] = $x[1];
    // }
    // if ($x1 >= 85 && $x1 <= 95 && $y1 >= 320 && $y1 <= 325) {
    //     // echo $x[1];
    //     $pulse[] = $x[1];
    // }


    // for nihon patient monitor
    if ($monitor == "nihon") {
        // pulse rate
        if ($x1 >= 10 && $x1 <= 90 && $y1 >= 20 && $y1 <= 40) {
            // echo "<br> $x[1]"; // $pulse[] = $x[1];
            $pr = $x[1];

        }

        // bp
        if ($x1 >= 0 && $x1 <= 90 && $y1 >= 110 && $y1 <= 160) {
            // echo $x[1];
            if ($bp !== null){
                $bp .= $x[1];
            }
            $bp = $x[1];
        }

        //spo2
        if ($x1 >= 20 && $x1 <= 80 && $y1 >= 190 && $y1 <= 240) {
            // echo "<br> $x[1]";
            // $pulse[] = $x[1];
            $spo2 = $x[1];
        }
        // rr
        if ($x1 >= 20 && $x1 <= 80 && $y1 >= 240 && $y1 <= 300) {
            // echo "<br> $x[1]";
            // $pulse[] = $x[1];
            $rr = $x[1];
        }
        // $rr = "-"; //For demo at IITK only. Must be remove after that


    } else {     // for philp's vital monitor
        // pulse rate
        if ($x1 >= 140 && $x1 <= 180 && $y1 >= 180 && $y1 <= 220) {
            // echo "<br> $x[1]"; // $pulse[] = $x[1];
            $pr = $x[1];

        }

        // bp
        if ($x1 >= 200 && $x1 <= 400 && $y1 >= 190 && $y1 <= 270) {
            // echo $x[1];
            $bp = $x[1];
        }

        //spo2
        if ($x1 >= 10 && $x1 <= 145 && $y1 >= 160 && $y1 <= 260) {
            // echo "<br> $x[1]";
            // $pulse[] = $x[1];
            $spo2 = $x[1];
        }
        // rr
        if ($x1 >= 50 && $x1 <= 70 && $y1 >= 240 && $y1 <= 260) {
            // echo "<br> $x[1]";
            // $pulse[] = $x[1];
            $rr = $x[1];
        }
        $rr = "-"; //For demo at IITK only. Must be remove after that
    }
}


// echo $pulse;
// var_dump($pulse);
// $pr = rtrim($pulse[0], "<br>");

$pr = preg_replace('/[^0-9\/]/', '', $pr);
echo "<br>Pulse Rate: ";
echo !empty($pr == null) ? "<br>-" : "<br> $pr";

$rr = preg_replace('/[^0-9\/]/', '', $rr);
echo "<br>RR Interval: ";
echo !empty($rr == null) ? "<br>-" : "<br> $rr";

// if(preg_grep('/\s+/', $bp)) {
$bp = preg_replace('/\s/', "/", $bp, 1);
// }
$bp = preg_replace('/[^0-9\/]/', '', $bp);
echo "<br>BP: ";
echo !empty($bp == null) ? "<br>-" : "<br> $bp";

$spo2 = preg_replace('/[^0-9\/]/', '', $spo2);
$s = substr((string) $spo2, 0, 3);      // echo"<br> $s";
$spo2 = !empty((int) $s === 100) ? (int) $s : (int) (substr((string) $spo2, 0, 2));
echo "<br>SPO2: ";
echo !empty($spo2 == null) ? "<br>-" : "<br> $spo2";

// header("Location: chest-pain-proforma.php?id=$pid");
// header("Location: upload-ecg.php?id=");
// =[$pr,$bp,$rr,$spo2]");location
// foreach ($arr as $x) {
// if(x1 > 150) continue;

// if( x1 >= 90 && x1 <= 100 && y1 >= 50 && y1 <= 60)

// if( x1 >= 20 && x1 <= 25 && y1 >= 345 && y1 <= 355)

// if( x1 >= 85 && x1 <= 95 && y1 >= 320 && y1 <= 325)

// if( x1 >= 110 && x1 < 120 && y1 >= 495 && y1 <= 510)
?>