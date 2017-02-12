<?php 
require('util/mysql.php');
error_reporting(E_ALL);

if (sizeof($argv) != 2) {
    echo "Usage created_database.php [Database name]";
    exit;
}
$dbname = "`".str_replace("`","``",$argv[1])."`";
$stmt = $db->prepare("CREATE DATABASE $dbname");
echo $stmt->execute() ? 1 : 0;