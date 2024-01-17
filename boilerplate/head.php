<?php

class Head {
    // Properties
    private $favicon;
    private $style;
    private $description;
    private $title;
    private $scripts = array();

    // Methods
    function __construct($title, $desc, $style='styles/simple.css', $favicon='img/favicon.ico') {
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
            $htmlString .= "<script src=\"$src\"></script>";
        }
        return $htmlString;
    } 
}

?>
