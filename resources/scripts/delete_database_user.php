<?php 
require('util/mysql.php');

if (sizeof($argv) != 2) {
    echo "Usage $argv[0] [username]".PHP_EOL;
    exit;
}


$stmt = $db->prepare("DROP USER ?");
echo $stmt->execute([ $argv[1] ]) ? 1 : 0;