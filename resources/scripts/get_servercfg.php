<?php 
require('util/servercfg.php');

if (sizeof($argv) != 2) {
    echo "Usage $argv[0] [username]".PHP_EOL;
    exit;
}

$username = $argv[1];

$servercfg = @file_get_contents("/home/$username/samp03/server.cfg");
if ($servercfg) {
    echo toJson($servercfg);
} else {
    echo "{ error: \"file does not exist\" }";
}