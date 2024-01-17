<?php

// Scan for files
$ignore = array(
    '.',
    '..',
    'README.md',
    '.git',
    'paras.txt',
    'updateTodo.php',
    'fonts',
    'img',
    'converted.md',
    'convertme.txt',
    'out.sql',
);

// Recursively look through directories and add files to an array while ignoring certain values.
function getFiles(&$files, $ignore, $path) {
    $dir = scandir($path);
    foreach ($dir as $f) {
        if(!in_array($f, $ignore)) {
            if(str_contains($f, '.')) {
                $files[] = $path.'/'.$f;
            } else {
                getFiles($files, $ignore, $path.'/'.$f);
            }
        }
    }
}

// Build array of key: filenames & value: array of TODO strings
function getTodo(&$todo, &$files) {
    foreach($files as $filename) {
        $file = fopen($filename, 'r');
        $contents = fread($file, filesize($filename));
        $i = 0;
        while($pos = strpos($contents, '// TODO:', $i)) {
            $i = $pos + 9;
            if(!array_key_exists($filename, $todo)) {
                $todo[$filename] = array();
            }
            $todo[$filename][] = substr($contents, $i, strpos($contents, "\n", $pos)-$i);
        }
        fclose($file);
    }

}

function buildTodoList($todo) {
    $todoList = '';
    foreach($todo as $filename => $todoStrings) {
        $todoList .= '- '.substr($filename, strpos($filename, '/')+1, strlen($filename))."\n";
        foreach($todoStrings as $s) {
            $todoList .= "\t- ".$s."\n";
        }
    }
    return $todoList;
}

$files = array();
getFiles($files, $ignore, '..');


// Search files for TODO
$todo = array();
getTodo($todo, $files);

// Build TODO list string
if(empty($todo))
    $todoList = 'Empty!';
else
    $todoList = buildTodoList($todo);

// Update README
$readmePath = '../README.md';
$file = fopen($readmePath, 'r');
$readme = fread($file, filesize($readmePath));
fclose($file);

if($pos = strpos($readme, 'TODO LIST:')) {
    $readme = substr($readme, 0, $pos);
}
$readme .= "TODO LIST:\n".$todoList;

$file = fopen($readmePath, 'w');
fwrite($file, $readme);
fclose($file);

echo 'TODO updated at '.date('h:i:s d/m/Y', time());

// TODO: Create button that runs page

?>