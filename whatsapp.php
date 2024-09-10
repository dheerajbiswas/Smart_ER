<?php
    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    require_once './vendor/autoload.php';
    use Twilio\Rest\Client;

    $sid    = "SID";
    $token  = "TOKEN";
    $twilio = new Client($sid, $token);
// echo 'working';
    // $message = $twilio->messages
    //   ->create("whatsapp:+91", // to
    //     array(
    //       "from" => "whatsapp:+14",
    //       "body" => "Hello ma'am."
    //     )
    //   );

// print($message->sid);

?>