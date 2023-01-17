<?php

function buildScriptTags($scripts) {
    $htmlString = '';
    foreach($scripts as $name => $src) {
        $htmlString .= "<script src=\"{$src}\"></script>";
    }
    return $htmlString;
}

$scripts = array(
    // 'Background'    => 'src/background.js',
    'Clock'         => 'src/clock.js',
    'Memes'         => 'src/memes.js',
    'RSS'           => 'src/rss.js',
);

$description    = 'A startpage designed to fit my aesthetic and be friendly for evening use.';
$favicon        = 'img/favicon.ico';
$style          = 'styles/style.css';
$title          = 'Startpage';


echo "<head>
    <meta charset=\"utf-8\" />
    <meta name=\"description\" content=\"{$description}\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- <link rel=\"manifest\" href=\"%PUBLIC_URL%/manifest.json\"> -->
    <link rel=\"stylesheet\" type=\"text/css\" href=\"{$style}\">
    <link rel=\"icon\" type=\"image/x-icon\" href=\"{$favicon}\">
    <title>{$title}</title>".
    buildScriptTags($scripts)
."</head>";
?>