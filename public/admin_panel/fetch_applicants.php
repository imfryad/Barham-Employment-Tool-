<?php
// fetch_applicants.php

require '../../includes/db_connect.php'; // require the database connection

// Fetch applicants data
try {
    $applicantsStmt = $pdo->query("SELECT * FROM applicants");
    $applicants = $applicantsStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $applicantsError = $e->getMessage();
}
