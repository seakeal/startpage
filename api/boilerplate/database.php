<?php

$server = "localhost";
$user   = "seakeal";
$pass   = "zIywalsRGhYNoV4oL60Y";
$db     = "startpage";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($server, $user, $pass, $db);

?>