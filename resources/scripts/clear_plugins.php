<?php 
require('util/servercfg.php');

if (sizeof($argv) != 2) {
    echo "Usage $argv[0] [username]".PHP_EOL;
    exit;
}

$username = $argv[1];

$plugins = scandir("/home/$username/samp03/plugins");
foreach ($plugins as $plugin) {
    if (!is_file($plugin)) continue;
    exec("rm /home/$username/samp03/plugins/$plugin");
}

$config = toArray(file_get_contents("/home/$username/samp03/server.cfg"));
if ($config) {
    $config['plugins'] = '';
    if (file_put_contents("/home/$username/samp03/server.cfg", arrayToString($config))) {
        echo 1;
    } else {
        echo 'write failed';
    }
} else {
    echo "read failed";
}