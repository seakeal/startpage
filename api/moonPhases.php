 <?php
    /* 
    Moon Phaser Demo
    By: Minkukel
    Date: 18-04-2020

    Modifications:
    - Nic Gill 14-12-2022
        Changed to work with EST & modified for web page
    */

// Use current UTC date and time for this demo
// NG 20221214 - Converted to EST
date_default_timezone_set('EST');
$thedate = date('Y-m-d H:i:s');
$unixdate = strtotime($thedate);

// The duration in days of a lunar cycle
$lunardays = 29.53058770576;
// Seconds in lunar cycle
$lunarsecs = $lunardays * (24 * 60 *60);
// Date time of first new moon in year 2000
// NG 20221214 - Converted to EST
$new2000 = strtotime("2000-01-06 13:14");

// Calculate seconds between date and new moon 2000
$totalsecs = $unixdate - $new2000;

// Calculate modulus to drop completed cycles
// Note: for real numbers use fmod() instead of % operator
$currentsecs = fmod($totalsecs, $lunarsecs);

// If negative number (date before new moon 2000) add $lunarsecs
if ( $currentsecs < 0 ) {
    $currentsecs += $lunarsecs;
}

// Calculate the fraction of the moon cycle
$currentfrac = $currentsecs / $lunarsecs;

// Calculate days in current cycle (moon age)
$currentdays = $currentfrac * $lunardays;

// Array with start and end of each phase
// In this array 'new', 'first quarter', 'full' and
// 'last quarter' each get a duration of 2 days.
$phases = array
    (
    array("new", 0, 1),
    array("waxing crescent", 1, 6.38264692644),
    array("first quarter", 6.38264692644, 8.38264692644),
    array("waxing gibbous", 8.38264692644, 13.76529385288),
    array("full", 13.76529385288, 15.76529385288),
    array("waning gibbous", 15.76529385288, 21.14794077932),
    array("last quarter", 21.14794077932, 23.14794077932),
    array("waning crescent", 23.14794077932, 28.53058770576),
    array("new", 28.53058770576, 29.53058770576),
    );

// Find current phase in the array
for ( $i=0; $i<9; $i++ ){
    if ( ($currentdays >= $phases[$i][1]) && ($currentdays <= $phases[$i][2]) ) {
        $thephase = $phases[$i][0];
        break;
    }
}

// Spit it out
// NG 20221214 - Converted to EST and modified for API
// echo "<h2>Moon Phaser Demo</h2>";
// echo "<p>Demo with date and time: ".date("l, j F Y H:i:s", $unixdate)." EST</p>";

// echo "<h2>Constants used</h2>";
// echo "<p>Duration of Lunar Cycle is: $lunardays days</p>";
// echo "<p>Date time of first new moon in 2000 is: 2000-01-06 13:14 EST</p>";

// echo "<h2>Calculated moon phase</h2>";
// echo "<p>Percentage of lunation: ".round((100*$currentfrac),3)."%</p>";
// echo "<p>The moon age is: ".round($currentdays,3)." days</p>";
// echo "<p>The moon phase is: $thephase</p>";

echo $thephase;

?> 