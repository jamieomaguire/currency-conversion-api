<?php

// Build the request uri
$URI = 'https://restcountries.eu/rest/v1/currency/';
$CURRENCY = 'USD';
$ENDPOINT = $URI.$CURRENCY;
$REQUEST = file_get_contents($ENDPOINT);

// format the response as an array
$responseArray = json_decode($REQUEST, true);

// iterate through the array to get the names of countries
for ($i = 0; $i < count($responseArray); $i++ ) {
    echo '<pre>';
    var_dump($responseArray[$i]["name"]);
    echo '</pre>';
}
