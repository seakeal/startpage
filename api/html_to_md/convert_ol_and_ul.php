<?php

// Get message from file
$path = 'convertme.txt';
$file = fopen($path, 'r');


$ol = 0;
$ol_active = FALSE;
$ul_active = FALSE;
$final = '';

while (!feof($file)) {
    $line = fgets($file);
    
    if (str_contains($line, '<ol>') > 0) {
        echo 'ol found';
        $ol_active = TRUE;
        $line = str_replace($line, '<ol>', '');
    }
    elseif (str_contains($line, '</ol>') > 0) {
        echo '/ol found';
        $ol_active = FALSE;
        $ol = 0;
        $line = str_replace($line, '</ol>', '');
    }
    elseif (str_contains($line, '<ul>') > 0) {
        echo 'ul found';
        $ul_active = TRUE;
        $line = str_replace($line, '<ul>', '');
    }
    elseif (str_contains($line, '</ul>') > 0){
        echo '/ul found';
        $ul_active = FALSE;
        $line = str_replace($line, '</ul>', '');
    } elseif (str_contains($line, '<li>') > 0) {
        if ($ol_active) {
            $ol += 1;
            echo "adding $ol to line";
            $line = str_replace('<li>', strval($ol).'. ', $line);
        } elseif ($ul_active) {
            echo 'adding * to line';
            $line = str_replace('<li>', '* ', $line);
        }
    }
    $final .= $line;
}
fclose($file);

$file = fopen('converted.md', 'w');
fwrite($file, $final);
fclose($file);

?>