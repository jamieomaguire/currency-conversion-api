<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 600);
error_reporting(E_ALL);

include ('./components/functions.php');
require('./components/errors.php');
// currencyGrabber();
getCurrencyCodes();

// error handling
if(!empty($_GET['from'])){
    $code = $_GET['from'];
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


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Currency Conversion Interface</title>
    <link rel="stylesheet" href="./css/app.css">
</head>
<body>
    <form class="interface-form" action="index.php" method="post">
        <div class="input-box">
            <label class="input-label" for="amount">Amount</label>
            <input class="input-text" type="text" name="amount">
        </div>
        <div class="input-box">
            <label class="input-label" for="from">From</label>
            <select class="input-select" name="from">
                <?php foreach($currencyCodeArray as $code) { ?>
                    <option value=""><?php echo $code; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="input-box">
            <label class="input-label" for="to">To</label>
            <select class="input-select" name="to">
                <?php foreach($currencyCodeArray as $code) { ?>
                    <option value=""><?php echo $code; ?></option>
                <?php } ?>
            </select>
        </div>

        <input class="input-submit" type="submit" value="SEND">

    </form>
</body>
</html>
