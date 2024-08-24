<?php
session_start([
    'cookie_lifetime' => 86400,  // 1 day
    'cookie_secure' => true,      // Only send cookies over HTTPS
    'cookie_httponly' => true,    // Prevent JavaScript access to session cookies
    'use_strict_mode' => true,    // Prevent session fixation
    'use_only_cookies' => true,   // Use only cookies for sessions
]);

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// require necessary files
require_once '../../includes/db_connect.php';