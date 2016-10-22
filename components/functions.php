<?php


// get currency name
function getCurrencyNames() {

    global $currency_name_data;

    $currency_url = 'https://openexchangerates.org/api/currencies.json';
    $currency_json = file_get_contents($currency_url);

    $currency_name_data = json_decode($currency_json, true);


    return $currency_name_data;

}

// Create the country list in a function
function createList($curCode) {

    global $countriesList;

    // Build the request uri
    $URI = 'https://restcountries.eu/rest/v1/currency/';

    // Join the two components of the request
    $ENDPOINT = $URI . $curCode;
    $REQUEST = file_get_contents($ENDPOINT);

    // Format the response as an array
    $responseArray = json_decode($REQUEST, true);

    // Initialise array of countries
    $countriesList = array();

    // Iterate through the array to get the names of countries
    for ($i = 0; $i < count($responseArray); $i++ ) {
        array_push($countriesList, $responseArray[$i]["name"]);
    }

    return $countriesList;

}

function currencyGrabber(){

    global $currency_name_data;
    global $countriesList;

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


    $xml->asXML("./data/currencies.xml");

}
