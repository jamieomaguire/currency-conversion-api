<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 600);
error_reporting(E_ALL);

include ('./components/functions.php');
require('./components/errors.php');
// currencyGrabber();

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

getCurrencyCodes();
?>
<form action="index.php" method="post">
    <label for="amount">Amount</label>
    <input type="text" name="amount">
    <label for="from">From</label>
    <select class="" name="from">
        <?php foreach($currencyCodeArray as $code) { ?>
            <option value=""><?php echo $code; ?></option>
        <?php } ?>
    </select>
    <label for="to">To</label>
    <select class="" name="to">
        <?php foreach($currencyCodeArray as $code) { ?>
            <option value=""><?php echo $code; ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="SEND">
</form>
