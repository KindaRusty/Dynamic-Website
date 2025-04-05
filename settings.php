<?php
$host = 'localhost';
$dbname = 'eoi_database';
$username = 'root';
$password = ''; 

//Recommended to check the errors in the database connection (optitonal)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}
?>