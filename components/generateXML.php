<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'countryByCurrency.php';

// Insert API key here
$API_KEY = "";
$exchange_rate_url = 'https://openexchangerates.org/api/latest.json?app_id=';

$json_data = file_get_contents($exchange_rate_url  . $API_KEY);
$data = json_decode($json_data, true);
$rates = array_slice($data, 4);
$xml = new SimpleXMLElement('<currencies/>');

foreach($rates as $keys => $values) {
  foreach($values as $key => $value) {
    // createList($key);
    $currency = $xml->addChild('currency');
    $currency->addAttribute('rate', $value);
    $currency->addAttribute('code', $key);
    $currency->addChild('name');
    $currency->addChild('locations');
  }
}

$xml->asXML("../data/currencies.xml");
