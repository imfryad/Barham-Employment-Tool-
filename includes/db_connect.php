<?php

$host = 'localhost'; // database host
$dbname = 'barham_class'; // database name
$username = 'root'; // database username
$password = ''; // database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle the exception
    echo 'پەیوەندیەکە شکستی هێنا: ' . $e->getMessage();
    exit; // Stop further execution if the connection fails
}
