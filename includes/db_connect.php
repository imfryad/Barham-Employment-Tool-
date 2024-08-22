<?php
$host = 'localhost'; // or your database host
$dbname = 'barham_class';
$username = 'root'; // or your database username
$password = ''; // or your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'پەیوەندیەکە شکستی هێنا: ' . $e->getMessage();
}

