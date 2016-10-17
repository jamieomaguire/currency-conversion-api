<?php

// get currency name
function getCurrencyNames() {

    global $currency_name_data;

    $currency_url = 'https://openexchangerates.org/api/currencies.json';
    $currency_json = file_get_contents($currency_url);

    $currency_name_data = json_decode($currency_json, true);


    return $currency_name_data;

}
