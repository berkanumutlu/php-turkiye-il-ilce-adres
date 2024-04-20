<?php namespace App\Config\DB;

use PDO;
use PDOException;

$host = 'mysql';
$database = 'test';
$username = 'test_user';
$password = 'test_password';
$charset = 'UTF8';
try {
    $db = new PDO("mysql:host=$host;dbname=$database;charset=$charset", $username, $password);
} catch (PDOException $e) {
    echo('DB connection error: '.$e->getMessage());
    exit();
}