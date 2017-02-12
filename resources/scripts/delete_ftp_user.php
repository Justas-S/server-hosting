<?php 

if (sizeof($argv) != 2) {
    echo "Usage $argv[0] [username]".PHP_EOL;
    exit;
}

$username = $argv[1];

exec("userdel --remove $username");
echo !is_numeric(exec("id -u ".$username)) ? 1 : 0;
