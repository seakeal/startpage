<?php

include('boilerplate/head.php');
$head = new Head(
    'Home',
    'A startpage designed to fit my aesthetic and be friendly for evening use.'
);

// path-to-mod => class-name
$modules = array(
    'mod/clock.php' => 'Clock',
    'mod/bookmarks.php' => 'Bookmarks',
    'mod/rss.php' =>  'RSS',
);

foreach($modules as $m => $class) {
    include_once($m);
    $mod = new $class;
    $head->addScripts($mod->scripts);
}

?>

<!DOCTYPE html>
<html>
    <?php $head->buildHtml(); ?>
    <body>
        <div id="mainContainer" class="mainContainer">
            <?php
            $clock = new Clock; $clock->buildHtml();
            $bookmarks = new Bookmarks; $bookmarks->buildHtml();
            $rss = new RSS; $rss->buildHtml();
            ?>
        </div>
    </body>
</html>