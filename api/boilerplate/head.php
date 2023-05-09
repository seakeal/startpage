<?php

function buildScriptTags($scripts) {
    $htmlString = '';
    foreach($scripts as $name => $src) {
        $htmlString .= "<script src=\"{$src}\"></script>";
    }
    return $htmlString;
}

// Begin
$scripts = array(
    // 'Background'    => 'src/background.js',
    'Clock'         => 'src/clock.js',
    //'Memes'         => 'src/memes.js',
    'RSS'           => 'src/rss.js',
);

$description    = 'A startpage designed to fit my aesthetic and be friendly for evening use.';
$favicon        = 'img/favicon.ico';
$style          = 'styles/simple.css';
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


class Head {
    // Properties
    private $favicon;
    private $style;
    private $description;
    private $title;
    private $scripts = array();

    // Methods
    function __construct($title, $desc, $style='../styles/simple.css', $favicon='../img/favicon.ico') {
        $this->title = $title;
        $this->description = $desc;
        $this->style = $style;
        $this->favicon = $favicon;
    }
    function buildHtml() {
        echo "<head>
            <meta charset=\"utf-8\" />
            <meta name=\"description\" content=\"{$this->description}\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
            <!-- <link rel=\"manifest\" href=\"%PUBLIC_URL%/manifest.json\"> -->
            <link rel=\"stylesheet\" type=\"text/css\" href=\"{$this->style}\">
            <link rel=\"icon\" type=\"image/x-icon\" href=\"{$this->favicon}\">
            <title>{$this->title}</title>".
            $this->buildScriptTags($this->scripts).
            "</head>";
        }
    function addScripts(array $newScripts) {
        foreach ($newScripts as $s) {
            if (!in_array($s, $this->scripts)) {
                array_push($this->scripts, $s);
            }
        }
    }

    private function buildScriptTags($scripts) {
        $htmlString = '';
        foreach($scripts as $name => $src) {
            $htmlString .= "<script src=\"../$src\"></script>";
        }
        return $htmlString;
    } 
}

?>
