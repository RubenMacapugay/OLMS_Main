<?php
require _DIR_ . '/vendor/autoload.php';
    use Twilio\Rest\Client;
$account_sid = 'ACab26a1323570c11aa8a1af5708271d32';
        $auth_token = '3cec38418a95226f05748f97ab811688';

        $twilio_number = "+13853967889";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
            $number1= '+'.$_POST['countryCode'].$_POST['Number1'],
            array(
                'from' => $twilio_number,
                'body' => 'Good Day! Thank you for Applying at Holy Family Academy, Kindly Wait for Further Announcement with Regards to Your Application, May You Have A Good Day!'
    )
);
?>