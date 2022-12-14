<?php
    function buildBookmark($name, $details) {
        $link = $details["link"];
        $icon = $details["icon"];
        
        echo "
        <li>
            <a href=\"$link\" class=\"clink\" class=\"clink$name\" target=\"_blank\">
                <img class=\"clinkImg\" id=\"clinkImg$name\" src=\"$icon\" alt=\"$name logo not found\">
            </a>
        </li>
        ";
    }

    // Function start
    // TODO: Pull this from a config file or DB query
    $bookmarks = array(
        "Wikipedia"     => array(
            "link" => "https://www.wikipedia.org/",
            "icon" => "img/Wikipedia logo version 2.svg",
        ),
        "Gmail"         => array(
            "link" => "https://www.gmail.com/",
            "icon" => "img/Gmail_icon_(2020).svg",
        ),
        "Amazon"        => array(
            "link" => "https://smile.amazon.com/",
            "icon" => "img/Amazon_icon.svg",
        ),
        "Disney+"       => array(
            "link" => "https://www.disneyplus.com/",
            "icon" => "img/Disney+_logo.svg",
        ),
        "Netflix"       => array(
            "link" => "https://www.netflix.com/",
            "icon" => "img/Netflix_2015_N_logo.svg",
        ),
        "10FastFingers" => array(
            "link" => "https://10fastfingers.com/",
            "icon" => "img/10fastfingers.png",
        ),
    );

    $size = -1;
    $i = 0;
    $column = 1;
    foreach($bookmarks as $name => $link) {
        if ($i == 0)
            echo "<ul class=\"bookmarksList\" id=\"bm$column\" >";
        buildBookmark($name, $link);
        $i++;
        if ($i == $size) {
            echo "</ul>";
            $i = 0;
            $column++;
        }
    }
    if ($i <> 0) { echo "</ul>"; }
?>