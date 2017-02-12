<?php 

$db = null;
try {
    $db = new PDO('mysql:host=localhost;charset=UTF8', 'root');
} catch (PDOException $e) {
    die($e);
}