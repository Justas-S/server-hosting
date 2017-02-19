<?php 
require('util/servercfg.php');

if (sizeof($argv) != 3) {
    echo "Usage $argv[0] [username] [plugin url]".PHP_EOL;
    exit;
}

$username = $argv[1];
$url = $argv[2];
$filename = substr($url, strrpos($url, "/", -1) + 1); // -1 to ignore the last char of the string. +1 to not include the slash

exec("mkdir /home/$username/samp03/plugins");
exec("wget -O /home/$username/samp03/plugins/$filename $url");

$config = toArray(@file_get_contents("/home/$username/samp03/server.cfg"));
if ($config) {
    $config['plugins'][] = $filename;

    if (@file_put_contents("/home/$username/samp03/server.cfg", arrayToString($config))) {
        echo 1;
    } else {
        echo "write error";
    }

} else {
    echo "read error";
}
