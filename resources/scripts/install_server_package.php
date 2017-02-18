<?php 

if (sizeof($argv) != 3) {
    echo "Usage $argv[0] [username] [package url]".PHP_EOL;
    exit;
}

$username = $argv[1];
$package_url = $argv[2];
$package_name = end(explode('/', $package_url));
$folder_name = substr($package_name, 0, strrpos($package_name, "."));

exec("wget $package_url");
exec("tar xzf $package_name");
echo (exec(" if test -d $folder_name; then echo 1; else echo 0; fi;")) ? 1 : 0;  