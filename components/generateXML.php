<?php
include 'errors.php';
include 'countryByCurrency.php';

// Insert API key here
$API_KEY = "18947b8fdda74706b676b4ab92faa09d";
$exchange_rate_url = 'https://openexchangerates.org/api/latest.json?app_id=';

$json_data = file_get_contents($exchange_rate_url  . $API_KEY);
$data = json_decode($json_data, true);
$rates = array_slice($data, 4);
$xml = new SimpleXMLElement('<currencies/>');


foreach($rates as $keys => $values) {
  foreach($values as $key => $value) {
    createList($key);
    $currency = $xml->addChild('currency');
    $currency->addAttribute('rate', $value);
    $currency->addAttribute('code', $key);
    $currency->addChild('name');
    $currency->addChild('locations', $countriesResult);
  }
}

$xml->asXML("../data/currencies.xml");
