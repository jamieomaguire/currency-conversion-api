<?php
include 'errors.php';

// Create the country list in a function
function createList($curCode) {

    global $countriesResult;

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

    // Turn array into a string seperated by commas and spaces
    $countriesResult = implode(", ", $countriesList);

    return $countriesResult;

}
