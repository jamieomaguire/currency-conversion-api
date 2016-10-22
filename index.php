<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 600);
error_reporting(E_ALL);

include ('./components/functions.php');
require('./components/errors.php');
// currencyGrabber();

// error handling
if(!empty($_GET['code'])){
    $code = $_GET['code'];
    $xml = simplexml_load_file('./data/currencies.xml');

    $match = false;

    for($i=0; $i < count($xml); $i++){
        if($xml->currency[$i]['code'] == $code) {
                $match = true;
            }
    }

    if($match == true){
        echo "Matches";
    } else {
        $error = simplexml_load_string($error1000);
        Header('Content-Type: text/xml');
        echo $error->asXml();
    }
}
