<?php 


if (sizeof($argv) != 3) {
    echo "Usage $argv[0] [username] [password]".PHP_EOL;
    exit;
}

$username = $argv[1];
$password = $argv[2];

if (isValidUser($username)) {
    echo "User already $username exists".PHP_EOL;
    exit;
}

exec("useradd -m -b /home -g sftponly -p $(mkpasswd --method=sha-512 $password) $username");
exec("setquota -u ".$username." 100 200 0 0 -a /");

if(isValidUser($username))
    echo 1;
else 
    echo 0;


function isValidUser($username) {
    return is_numeric(exec("id -u ".$username));
}