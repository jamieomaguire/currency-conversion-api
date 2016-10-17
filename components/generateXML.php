<?php
include 'errors.php';
include 'countryByCurrency.php';
include 'currency_data.php';

// Insert API key here
$API_KEY = "139713b433354235a8574ffb0be05e72";
$exchange_rate_url = 'https://openexchangerates.org/api/latest.json?app_id=';

$json_data = file_get_contents($exchange_rate_url . $API_KEY);
$data = json_decode($json_data, true);
$rates = array_slice($data, 4);
$xml = new SimpleXMLElement('<currencies/>');



foreach($rates as $keys => $values) {
  foreach($values as $key => $value) {
    $currency = $xml->addChild('currency');
    $currency->addAttribute('rate', $value);
    $currency->addAttribute('code', $key);
    // add currency name
    getCurrencyNames();
    foreach($currency_name_data as $currencyKey => $currencyValue){
        if ($currencyKey == $key) {
            $currency->addChild('name', $currencyValue);
        }
    }
    createList($key);
    $locations = $currency->addChild('locations');
    foreach($countriesList as $country){
        $locations->addChild('location', $country);
    }

  }
}


$xml->asXML("../data/currencies.xml");
