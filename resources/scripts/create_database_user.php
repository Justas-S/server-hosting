<?php 
require('util/mysql.php');

if (sizeof($argv) != 4) {
    echo "Usage $argv[0] [username] [password] [database]".PHP_EOL;
    exit;
}

$db_name = "`".str_replace("`","``",$argv[3])."`";

$stmt = $db->prepare("FLUSH PRIVILEGES;CREATE USER ?@'%' IDENTIFIED BY ?");
if ($stmt->execute([ $argv[1], $argv[2] ])) {
    $stmt = $db->prepare("GRANT ALL PRIVILEGES ON $db_name.* TO ?@'%'");
    if ($stmt->execute([ $argv[1] ])) {
        echo 1;
    } else {
        echo 0;
    }
}
else 
    echo -1;

