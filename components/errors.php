<?php
// Currency type not recognised
$error1000=<<<XML
<conv>
    <error>
        <code>1000</code>
        <msg>Currency type not recognized</msg>
    </error>
</conv>
XML;

// Required params missing
$error1100=<<<XML
<conv>
    <error>
        <code>1100</code>
        <msg>Required parameter is missing</msg>
    </error>
</conv>
XML;

// Param not recognizes
$error1200=<<<XML
<conv>
    <error>
        <code>1200</code>
        <msg>Parameter is not recognized</msg>
    </error>
</conv>
XML;

// amount must be decimal
$error1300=<<<XML
<conv>
    <error>
        <code>1300</code>
        <msg>Currency amount must be a decimal number</msg>
    </error>
</conv>
XML;

// service error
$error1400=<<<XML
<conv>
    <error>
        <code>1400</code>
        <msg>Error in service</msg>
    </error>
</conv>
XML;
