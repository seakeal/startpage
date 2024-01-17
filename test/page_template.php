<?php

include 'boilerplate/head.php';
$head = new Head(
    'Template',
    'This is a template page for reference.'
);

// path-to-mod => class-name
$modules = array(
    //'mod/modname.php' => 'ModName',
);

// Add required scripts for each mod
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
            // $mod = new ModName; $mod->buildHtml();
            ?>
        </div>
    </body>
</html>