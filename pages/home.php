<?php

include('api/boilerplate/head.php');
$head = new Head(
    'Home',
    'A startpage designed to fit my aesthetic and be friendly for evening use.'
);

$modules = array(
    'api/clock.php' => 'Clock',
    'api/bookmarks.php' => 'Bookmarks',
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
            ?>
        </div>
    </body>
</html>