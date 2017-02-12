<?php 
require('util/mysql.php');

if (sizeof($argv) != 2) {
    echo "Usage $argv[0] [database name]".PHP_EOL;
    exit;
}
// Back it up perhaps?

$dbname = "`".str_replace("`","``",$argv[1])."`";
$stmt = $db->prepare("DROP DATABASE $dbname");
echo $stmt->execute() ? 1 : 0;