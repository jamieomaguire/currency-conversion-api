<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Build the request uri
$URI = 'https://restcountries.eu/rest/v1/currency/';

// Any currency code can go here
$CURRENCY = 'GBP';

// Join the two components of the request
$ENDPOINT = $URI . $CURRENCY;
$REQUEST = file_get_contents($ENDPOINT);

// Format the response as an array
$responseArray = json_decode($REQUEST, true);

// Create the country list in a function
function createCountriesList($responseArray) {

    // Initialise array of countries
    $countriesList = [];

    global $countriesStringList;

    // Iterate through the array to get the names of countries
    for ($i = 0; $i < count($responseArray); $i++ ) {
        array_push($countriesList, $responseArray[$i]["name"]);
    }

    // Turn array into a string seperated by commas and spaces
    $countriesStringList = implode(', ', $countriesList);

    return $countriesStringList;

}

createCountriesList($responseArray);

// Echo out the list, for luls
echo '<p>' . $countriesStringList . '</p>';
