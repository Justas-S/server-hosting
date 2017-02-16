<?php
require('util/servercfg.php');

if (sizeof($argv) != 3) {
    echo "Usage $argv[0] [username] [json]".PHP_EOL;
    exit;
}

$username = $argv[1];
$json = $argv[2];

$content = toString($json);

if (file_put_contents("/home/$username/samp03/server.cfg", $content) !== false) {
    echo 1;
} else {
    echo("{ error: \"failed to write data to file\" }");
}